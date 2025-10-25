<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('category')->latest()->get();
        $categories = FaqCategory::all(); // Fetch all FAQ categories
        $faqTypes = ['Buyers FAQ', 'Seller FAQ']; // Example types
// dd($faqs->toArray());
        return view('admin.faq.index', compact('faqs', 'categories', 'faqTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            // 'type' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|in:Published,Draft',
        ]);

        Faq::create($validated);

        return response()->json(['success' => true, 'message' => 'FAQ added successfully!']);
    }

    public function edit($id)
    {
        $faq = Faq::with('category')->findOrFail($id);
        // dd($faq->toArray());
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            // 'type' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required|in:Published,Draft',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validated);

        return response()->json(['success' => true, 'message' => 'FAQ updated successfully.']);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
    }

}
