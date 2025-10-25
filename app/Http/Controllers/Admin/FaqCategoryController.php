<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::latest()->paginate(10);
        return view('admin.faq-categories.index')->with([
            'categories' => $categories
        ]);
    }


    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.faq-categories.create')->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }


    public function store(Request $request)
    {
        $requestData = $request->all();

        // Generate slug from the input slug or name
        $slug = Str::slug($request->input('slug') ?: $request->input('name'), '-');
        $requestData['slug'] = $slug;

        // Replace slug key if necessary (your model uses 'slug', not 'url')
        $request->merge(['slug' => $slug]);

        // Validate input
        $validator = Validator::make($requestData, [
            'name' => 'required|unique:faq_categories,name|max:255',
            'slug' => 'required|unique:faq_categories,slug|max:255',
            'status' => 'required|in:Published,Draft',
        ]);

        if ($validator->passes()) {
            try {
                FaqCategory::create([
                    'name' => $request->input('name'),
                    'slug' => $slug,
                    'status' => $request->input('status'),
                ]);

                return response()->json([
                    'success' => true,
                    'msgText' => 'FAQ Category Created Successfully',
                ]);
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }


    public function edit($id)
    {
        try {
            $category = FaqCategory::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.faq-categories.edit')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => ["required", Rule::unique('faq_categories')->ignore($id), "max:255"],
            'slug' => ["required", Rule::unique('faq_categories')->ignore($id), "max:255"], 
        ]);
        if ($validator->passes()) {
            try {
                $category = FaqCategory::findOrFail($id);
                $data = array(
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'status' => $request->status,
                );

                $category->update($data);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Faq Updated',
                ]);
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }


    public function destroy($id)
    {
        try {
            $category = FaqCategory::findOrFail($id);



            $category->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}
