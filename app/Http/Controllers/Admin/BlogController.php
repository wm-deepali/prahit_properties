<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BlogCategory;
use App\Blog;

class BlogController extends Controller
{
	public function manageBlogCategories()
	{
		$categories = BlogCategory::orderBy('id')->get();
		return view('admin.blog.blog_category', compact('categories'));
	}

	public function storeBlogCategories(Request $request)
	{
		$request->validate(
			[
				'category_name' => 'required|max:150',
				'category_meta_title' => 'required',
				'category_meta_description' => 'required',
				'category_keywords' => 'required'
			]
		);

		BlogCategory::create(
			[
				'name' => $request->category_name,
				'meta_title' => $request->category_meta_title,
				'meta_description' => $request->category_meta_description,
				'meta_keywords' => $request->category_keywords,
			]
		);
		return redirect()->back()->with('success', 'Category Added Successfully.');
	}

	public function changeStatusBlogCategories(Request $request)
	{
		$picked = BlogCategory::find($request->id);
		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->status == 'Yes' ? 'Category Deactivated Successfully.' : 'Category Activated Successfully.';
		$picked->update(
			[
				'status' => $status
			]
		);
		return $msg;
	}

	public function getBlogCategoryInfo($id)
	{
		try {
			$picked = BlogCategory::find($id);
			if ($picked) {
				$this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function updateBlogCategories(Request $request)
	{
		$request->validate(
			[
				'category_name' => 'required|max:150',
				'category_meta_title' => 'required',
				'category_meta_description' => 'required',
				'category_keywords' => 'required'
			]
		);
		$picked = BlogCategory::find($request->category_id);
		$picked->update(
			[
				'name' => $request->category_name,
				'meta_title' => $request->category_meta_title,
				'meta_description' => $request->category_meta_description,
				'meta_keywords' => $request->category_keywords,
			]
		);
		return redirect()->back()->with('success', 'Category Updated Successfully.');
	}

	public function deleteBlogCategories($id)
	{
		try {
			$picked = BlogCategory::find($id)->delete();
			if ($picked) {
				$this->JsonResponse(200, 'Category deleted successfully');
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function manageBlogs()
	{
		$blogs = Blog::orderBy('id', 'DESC')->get();
		return view('admin.blog.manage_blogs', compact('blogs'));
	}

	public function createBlogView()
	{
		$blog_categories = BlogCategory::where('status', 'Yes')->get();
		return view('admin.blog.create_blog', compact('blog_categories'));
	}

	public function createBlog(Request $request)
	{
		$request->validate([
			'blog_category' => 'required',
			'heading' => 'required|max:150',
			'image' => 'required|mimes:jpg,png,jpeg,svg',
			'description' => 'required',
			'image_alt' => 'required|max:150',
			'meta_title' => 'nullable|max:150',
			'meta_keywords' => 'nullable|max:255',
			'meta_description' => 'nullable|max:255'
		]);

		$path = null;
		if ($request->hasFile('image')) {
			$path = $request->image->store('blogs');
		}

		Blog::create([
			'category_id' => $request->blog_category,
			'heading' => $request->heading,
			'image' => $path,
			'image_alt' => $request->image_alt,
			'description' => $request->description,
			'meta_title' => $request->meta_title,
			'meta_keywords' => $request->meta_keywords,
			'meta_description' => $request->meta_description,
			// 'featured' => 0,
			// 'status' => 1
		]);

		return redirect()->route('admin.manageBlogs')->with('success', 'Blog Posted Successfully.');
	}

	public function updateFeatureBlog(Request $request)
	{
		$picked = Blog::find($request->id);
		$status = $picked->featured == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->featured == 'Yes' ? 'Blog Unfeatured Successfully.' : 'Blog Featured Successfully.';
		$picked->update(
			[
				'featured' => $status
			]
		);
		return $msg;
	}

	public function blogInfo($id)
	{
		try {
			$picked = Blog::find($id);
			if ($picked) {
				$this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function blogChangeStatus(Request $request)
	{
		$picked = Blog::find($request->id);
		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->status == 'Yes' ? 'Blog Deactivated Successfully.' : 'Blog Activated Successfully.';
		$picked->update(
			[
				'status' => $status
			]
		);
		return $msg;
	}

	public function editBlog($id)
	{
		$picked = Blog::find($id);
		$blog_categories = BlogCategory::where('status', 'Yes')->get();
		return view('admin.blog.update_blog', compact('picked', 'blog_categories'));
	}

	public function updateBlog(Request $request)
	{
		$request->validate([
			'blog_category' => 'required',
			'heading' => 'required|max:150',
			'image' => 'nullable|mimes:jpg,png,jpeg,svg',
			'description' => 'required',
			'image_alt' => 'required|max:150',
			'meta_title' => 'nullable|max:150',
			'meta_keywords' => 'nullable|max:255',
			'meta_description' => 'nullable|max:255'
		]);

		$picked = Blog::find($request->id);

		if ($request->hasFile('image')) {
			$path = $request->image->store('blogs');
			// Delete old image
			\Storage::delete($picked->image);
		} else {
			$path = $picked->image;
		}

		$picked->update([
			'category_id' => $request->blog_category,
			'heading' => $request->heading,
			'image' => $path,
			'image_alt' => $request->image_alt,
			'description' => $request->description,
			'meta_title' => $request->meta_title,
			'meta_keywords' => $request->meta_keywords,
			'meta_description' => $request->meta_description
		]);

		return redirect()->route('admin.manageBlogs')->with('success', 'Blog Updated Successfully.');
	}


	public function deleteBlog($id)
	{
		try {
			$picked = Blog::find($id)->delete();
			if ($picked) {
				$this->JsonResponse(200, 'Blog deleted successfully');
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}
}
