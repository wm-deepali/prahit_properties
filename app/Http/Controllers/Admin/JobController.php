<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobCategory;
use App\Technology;
use App\Country;
use App\Job;
use App\JobRequest;

class JobController extends Controller
{
	public function manageJobCategories()
	{
		$categories = JobCategory::orderBy('id')->get();
		return view('admin.job.manage_job_category', compact('categories'));
	}

	public function storeJobCategories(Request $request)
	{
		$request->validate(
			[
				'category_name' => 'required|max:150',
				'category_meta_title' => 'required',
				'category_meta_description' => 'required',
				'category_keywords' => 'required'
			]
		);

		JobCategory::create(
			[
				'name' => $request->category_name,
				'meta_title' => $request->category_meta_title,
				'meta_description' => $request->category_meta_description,
				'meta_keywords' => $request->category_keywords,
			]
		);
		return redirect()->back()->with('success', 'Category Added Successfully.');
	}

	public function changeStatusJobCategories(Request $request)
	{
		$picked = JobCategory::find($request->id);
		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->status == 'Yes' ? 'Category Deactivated Successfully.' : 'Category Activated Successfully.';
		$picked->update(
			[
				'status' => $status
			]
		);
		return $msg;
	}

	public function getCategoryInfo($id)
	{
		try {
			$picked = JobCategory::find($id);
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

	public function updateJobCategories(Request $request)
	{
		$request->validate(
			[
				'category_name' => 'required|max:150',
				'category_meta_title' => 'required',
				'category_meta_description' => 'required',
				'category_keywords' => 'required'
			]
		);
		$picked = JobCategory::find($request->category_id);
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

	public function deleteJobCategories($id)
	{
		try {
			$picked = JobCategory::find($id)->delete();
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

	public function manageJobTechnologies()
	{
		$technologies = Technology::orderBy('id')->get();
		return view('admin.job.technologies', compact('technologies'));
	}

	public function storeJobTechnologies(Request $request)
	{
		$request->validate(
			[
				'name' => 'required|max:150'
			]
		);
		Technology::create(
			[
				'name' => $request->name
			]
		);
		return redirect()->back()->with('success', 'Technology Created Successfully.');
	}

	public function getTechnologyInfo($id)
	{
		try {
			$picked = Technology::find($id);
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

	public function changeStatusTechnology(Request $request)
	{
		$picked = Technology::find($request->id);
		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->status == 'Yes' ? 'Technology Deactivated Successfully.' : 'Technology Activated Successfully.';
		$picked->update(
			[
				'status' => $status
			]
		);
		return $msg;
	}

	public function updateJobTechnologies(Request $request)
	{
		$request->validate(
			[
				'name' => 'required|max:150'
			]
		);
		$picked = Technology::find($request->category_id);
		$picked->update(
			[
				'name' => $request->name
			]
		);
		return redirect()->back()->with('success', 'Technology Updated Successfully.');
	}

	public function deleteJobTechnology($id)
	{
		try {
			$picked = Technology::find($id)->delete();
			if ($picked) {
				$this->JsonResponse(200, 'Technology deleted successfully');
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function manageJobs()
	{
		$jobs = Job::orderBy('id')->get();
		return view('admin.job.manage_jobs', compact('jobs'));
	}

	public function createJobView()
	{
		$job_categories = JobCategory::where('status', 'Yes')->get();
		$technologies = Technology::where('status', 'Yes')->get();
		$countries = Country::get();
		return view('admin.job.create_job', compact('job_categories', 'technologies', 'countries'));
	}

	public function createJob(Request $request)
	{
		$request->validate(
			[
				'job_category' => 'required',
				'heading' => 'required|max:150',
				'tag_line' => 'required|max:150',
				'country' => 'required',
				'state' => 'required|max:150',
				'city' => 'required|max:150',
				'skills' => 'required',
				'requirements' => 'required',
				'description' => 'required'
			]
		);
		Job::create(
			[
				'category_id' => $request->job_category,
				'heading' => $request->heading,
				'tag_line' => $request->tag_line,
				'skills' => implode(',', $request->skills),
				'requirements' => $request->requirements,
				'description' => $request->description,
				'country' => $request->country,
				'state' => $request->state,
				'city' => $request->city
			]
		);
		return redirect()->route('admin.manageJobs')->with('success', 'Job Posted Successfully.');
	}

	public function jobInfo($id)
	{
		try {
			$picked = Job::find($id);
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

	public function jobChangeStatus(Request $request)
	{
		$picked = Job::find($request->id);
		$status = $picked->status == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->status == 'Yes' ? 'Job Deactivated Successfully.' : 'Job Activated Successfully.';
		$picked->update(
			[
				'status' => $status
			]
		);
		return $msg;
	}

	public function editJob($id)
	{
		$picked = Job::find($id);
		$job_categories = JobCategory::where('status', 'Yes')->get();
		$technologies = Technology::where('status', 'Yes')->get();
		$countries = Country::get();
		return view('admin.job.edit_job', compact('picked', 'job_categories', 'technologies', 'countries'));
	}

	public function updateJob(Request $request)
	{
		$request->validate(
			[
				'job_category' => 'required',
				'heading' => 'required|max:150',
				'tag_line' => 'required|max:150',
				'country' => 'required',
				'state' => 'required|max:150',
				'city' => 'required|max:150',
				'skills' => 'required',
				'requirements' => 'required',
				'description' => 'required'
			]
		);
		$picked = Job::find($request->id);
		$picked->update(
			[
				'category_id' => $request->job_category,
				'heading' => $request->heading,
				'tag_line' => $request->tag_line,
				'skills' => implode(',', $request->skills),
				'requirements' => $request->requirements,
				'description' => $request->description,
				'country' => $request->country,
				'state' => $request->state,
				'city' => $request->city
			]
		);
		return redirect()->route('admin.manageJobs')->with('success', 'Job Updated Successfully.');
	}

	public function deleteJob($id)
	{
		try {
			$picked = Job::find($id)->delete();
			if ($picked) {
				$this->JsonResponse(200, 'Job deleted successfully');
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function jobRequests()
	{
		$requests = JobRequest::whereHas('job')->latest()->get();

		return view('admin.job.requests', compact('requests'));
	}

	public function deleteJobRequest(Request $request)
	{
		$request->validate([
			'id' => 'required|exists:job_requests,id'
		]);

		try {
			$jobRequest = JobRequest::findOrFail($request->id);

			// Delete the resume file if exists
			if ($jobRequest->resume && \Storage::exists($jobRequest->resume)) {
				\Storage::delete($jobRequest->resume);
			}

			$jobRequest->delete();

			return response()->json([
				'status' => 200,
				'message' => 'Job Request deleted successfully.'
			]);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 400,
				'message' => 'Failed to delete Job Request.'
			]);
		}
	}

}
