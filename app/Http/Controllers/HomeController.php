<?php

namespace App\Http\Controllers;

use Http;
use App\Otp;
use App\Job;
use App\Blog;
use App\User;
use App\City;
use App\State;
use Location;
use Exception;
use App\Cities;
use App\Amenity;
use App\Feature;
use App\Category;
use App\Feedback;
use App\Complaint;
use App\Locations;
use App\JobRequest;
use App\FormTypes;
use App\HelpContent;
use App\BlogCategory;
use App\ContactInfo;
use App\AgentEnquiry;
use App\Properties;
use App\SubCategory;
use App\Technology;
use App\Testimonial;
use App\JobCategory;
use App\EmailTemplate;
use App\SummonsReason;
use App\PropertyTypes;
use App\SubLocations;
use App\PropertyGallery;
use App\HomePageContent;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Drivers\Driver;
use App\Notifications\GlobalNotification;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\WelcomeEmailNotification;

class HomeController extends AppController {

	use GlobalTrait;

	public function home(Request $request, $city = null) {
		try {			
			$listings = Properties::with(['Category','Category.Subcategory','Location','PropertyTypes', 'PropertyGallery'])
						->where('approval', 'Approved')->where('publish_status', 'Publish');
			if($request->input('category')) {
				$listings->where('category_id', decrypt($request->category));
			}
			if(is_null($city)) {
				$ip = \Request::ip();
				$location = Location::get($ip);
				$city = isset($location->cityName) ? strtolower($location->cityName) : 'Lucknow';
				$city_id = Cache::get('location-id');
				$listings->where('city_id', $city_id);
				return redirect("/$city");
			}else { 
				$picked_city = City::where('name', $city)->first();
				if($picked_city) {
				    Cache::flush();
					Cache::put('location-name', $picked_city->name);
					Cache::put('location-id', $picked_city->id);
					Cache::put('state-id', $picked_city->state_id);
					$listings->where('city_id', $picked_city->id);
				}else {
				    $listings->where('city_id', null);
				}
			}
			$listings       = $listings->latest()->get();
			$category       = Category::all();
			$property_types = PropertyTypes::all();
			$feedback       = Feedback::where('is_feedback', "1")->get();
			$testimonials   = Testimonial::where('status', 'Yes')->where('show_on_front', 'Yes')->get();
			$features       = Feature::where('status', 'Yes')->get();
			$help_content   = HelpContent::first(); 
			return view('front.home', compact('listings','feedback','category','property_types', 'testimonials', 'features', 'help_content'));
		} catch (\Exception $e) {
			abort(500,$e->getMessage());
		}

	}

	public function create_property() { 
		$category  = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields','FormTypesFields.SubFeatures')->where('id',1)->get();
		$states    = State::where('country_id', 101)->get();
		$amenities = Amenity::where('status', 'Yes')->get();
		return view('front.create_property', compact('category','locations','form_type','states', 'amenities'));
	}

	public function property_detail($slug) {
		$property = Properties::with([
			'Location',
			'PropertyGallery',
			'PropertyFeatures',
			'PropertyFeatures',
			'PropertyFeatures.SubFeatures',
			'PropertyTypes',
			'getState',
			'getCity'
		])->where('slug', $slug)->first();
		$property_detail = $property; 
		$amenities       = Amenity::whereIn('id', explode(',', $property_detail->amenities))->get();
		return view('front.property_detail', compact('property_detail', 'amenities')); 
	}

	public function search_property(Request $request) { 
		try {
			$location = $request->input('property');
			$type     = $request->input('type');
			$min_price= $request->input('min_price');
			$max_price= $request->input('max_price');
			$states = State::where('name', 'LIKE', '%'.$location.'%')->get();
			$cities = City::where('name', 'LIKE', '%'.$location.'%')->get();
			$locations = Locations::where('location', 'LIKE', '%'.$location.'%')->get();
			$ids = [];
			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory',
				'Location',
				'getUser'
			]);
			if(count($states) > 0 && count($cities) == 0 && count($locations) == 0) {
				foreach ($states as $state) {
					array_push($ids, $state->id);
				}
				$property = $property->whereIn('state_id', $ids);
			}else if(count($states) == 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			}else if (count($states) > 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);
				
			}else if (count($states) == 0 && count($cities) > 0 && count($locations) > 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);
				
			}else if (count($states) == 0 && count($cities) == 0 && count($locations) > 0) {
				$property_ids = [];
				$get_properties = Properties::where('approval', 'Approved')->get();
				foreach ($get_properties as $p) {
					foreach ($locations as  $location) {
						if(in_array($location->id, explode(',', $p->location_id))) {
							array_push($property_ids, $p->id);
						}
					}
				}
				$property = $property->whereIn('id', $property_ids);
			}else {
				$property = $property->whereIn('state_id', []);
			}
			$properties = $property->where('type_id', $type)
				->where('price', '>', $min_price)
				->where('price', '<', $max_price)
				->where('approval', 'Approved')
				->where('publish_status', 'Publish')
				->paginate(10);
			$categories = Category::all();
			$location_datas = Locations::all();
			return view('front.search', compact('categories','location_datas', 'properties'));
		} catch (\Exception $e) {
			abort(500, $e->getMessage());
		}
	}

	public function searchPropertyGrid(Request $request) {
				try {
			$location = $request->input('property');
			$type     = $request->input('type');
			$min_price= $request->input('min_price');
			$max_price= $request->input('max_price');
			$states = State::where('name', 'LIKE', '%'.$location.'%')->get();
			$cities = City::where('name', 'LIKE', '%'.$location.'%')->get();
			$locations = Locations::where('location', 'LIKE', '%'.$location.'%')->get();
			$ids = [];
			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory',
				'Location',
				'getUser'
			]);
			if(count($states) > 0 && count($cities) == 0 && count($locations) == 0) {
				foreach ($states as $state) {
					array_push($ids, $state->id);
				}
				$property = $property->whereIn('state_id', $ids);
			}else if(count($states) == 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			}else if (count($states) > 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);
				
			}else if (count($states) == 0 && count($cities) > 0 && count($locations) > 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);
				
			}else if (count($states) == 0 && count($cities) == 0 && count($locations) > 0) {
				$property_ids = [];
				$get_properties = Properties::where('approval', 'Approved')->get();
				foreach ($get_properties as $p) {
					foreach ($locations as  $location) {
						if(in_array($location->id, explode(',', $p->location_id))) {
							array_push($property_ids, $p->id);
						}
					}
				}
				$property = $property->whereIn('id', $property_ids);
			}else {
				$property = $property->whereIn('state_id', []);
			}
			$properties = $property->where('type_id', $type)
				->where('price', '>', $min_price)
				->where('price', '<', $max_price)
				->where('approval', 'Approved')
				->where('publish_status', 'Publish')
				->paginate(10);
			$categories = Category::all();
			$location_datas = Locations::all();
			return view('front.search_grid', compact('categories','location_datas', 'properties'));
		} catch (\Exception $e) {
			abort(500, $e->getMessage());
		}
	}

public function createProperty(Request $request) {
		$request->validate(
			[
				'title'             => 'required|max:200',
				'type_id'           => 'required',
				'price'             => 'required|numeric',
				'price_label.*'     => 'required',
				'category_id'       => 'required',
				'sub_category_id'   => 'required',
				'construction_age'  => 'required',
				'description'       => 'required',
				'address'           => 'required',
				'location_id'       => 'required',
				'sub_location_id'   => 'nullable',
				'owner_type'        => 'required',
				'firstname'         => 'required',
				'lastname'          => 'required',
				'email'             => 'required|email',
				'mobile_number'     => 'required|numeric|digits:10',
				'otp'               => 'required',
				"gallery_images_file.*" => 'required|mimes:jpg,png,jpeg',
			]
		);
		$user = User::where('email', $request->email)->where('mobile_number', $request->mobile_number)->first();
		$otp_check = Otp::where('otp', $request->otp)->first();
		if(!$otp_check) {
			return back()->withErrors(['OTP Failed', 'Otp does not exist or may be expired.']);
		}
		$otp_check->delete();
		if(!$user) {
			$pass = rand(10000, 99999);
			$show_pass = $pass;
			if($request->owner_type == 1) {
				$role = 'owner';
			}else if($request->owner_type == 2) {
				$role = 'builder';
			}elseif ($request->owner_type == 3) {
				$role = 'agent';
			}
			$request->validate(
				[
					'email'         => 'required|unique:users,email',
					'mobile_number' => 'required|unique:users,mobile_number'
				]
			);
			$user = User::create(
				[
					'role'          => $role,
					'firstname'     => $request->firstname,
					'lastname'      => $request->lastname,
					'email'         => $request->email,
					'mobile_number' => $request->mobile_number,
					'address'       => $request->address,
					'state_id'      => $request->state_id,
					'city_id'       => $request->city_id,
					'password'      => \Hash::make($pass)
				]
			); 
			$sms = "Dear ".$user->firstname." ".$user->lastname."%0aThank you for joining with us, your login password is ".$pass."%0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
			$this->sendSMSInformtaion($user->mobile_number, $sms);
			$subject = 'Registration Done.';
			$message = 'Thank you for joining with us, your login password is '.$pass;
			$otp_check->delete();
			try {
				$emailtemplate    = EmailTemplate::where('id',1)->first();
		        $ordertemplate = $emailtemplate->template;
		        $replacetemplate = Array(
		        	'#NAME'     => $user->firstname.' '.$user->lastname,
		            '#EMAIL'    => $user->email,
		            '#PASSWORD' => $show_pass,
		        );
		        foreach($replacetemplate as $agr_key => $agr_text) {
		            $ordertemplate = str_replace($agr_key, $agr_text, $ordertemplate);
		        }
		        $finaltemplate = $ordertemplate; 
		        $user->notify(New WelcomeEmailNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
				// $user->notify(new GlobalNotification($user, $subject, $message));
			}catch (\Exception $e) {
				return redirect()->back()->with('error', $e->getMessage());
	        }
		}
		$count        = Properties::count();
	    $final_digits = str_pad($count, 4, '0', STR_PAD_LEFT);
	    $unique_id    = 'PP-'.$final_digits;
		$title_slug = str_replace(' ', '-', $request->title);
		$new_slug = str_replace('/', '-', $title_slug);
		$slug = $new_slug;
		$price_label = $request->has('price_label') ? implode(',', $request->price_label) : null;
		$property = Properties::create(
			[
				'user_id'         => $user->id,
				'title'           => $request->title,
				'listing_id'      => $unique_id,
				'slug'            => $slug,
				'type_id'         => $request->type_id,
				'price'           => $request->price,
				'price_label'     => $price_label,
				'description'     => $request->description,
				'category_id'     => $request->category_id,
				'sub_category_id' => $request->sub_category_id,
				'address'         => $request->address,
				'state_id'        => $request->state,
				'city_id'         => $request->city,
				'location_id'     => implode(',', $request->location_id),
				'sub_location_id' => $request->has('sub_location_id') ? implode(',', $request->sub_location_id) : null,
				'amenities'       => $request->has('amenity') ? implode(',', $request->amenity) : null,
				'additional_info' => $request->form_json,
				'construction_age'=> $request->construction_age
			]
		);
		if($request->has('gallery_images_file')) {
			$gallery_images = $this->multipleFileUpload($request, ['uploads/properties/gallery_images/' => 'gallery_images_file']);
			foreach ($gallery_images as $key => $value) {
				PropertyGallery::create(['property_id' => $property->id, 'image_path' => $value]);					
			}
		}
		return redirect('user/property/preview/'.$property->id)->with('success', 'Property Posted Successfully.');
	}

	public function editPropertyView($id) {
		$category  = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields','FormTypesFields.SubFeatures')->where('id',1)->get();
		$property  = Properties::find($id);
		$states    = State::where('country_id', 101)->get();
		$cities    = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$property_images = PropertyGallery::where('property_id', $id)->get();
		$subcategories = SubCategory::where('category_id', $property->category_id)->get();
		$amenities = Amenity::where('status', 'Yes')->get();
		return view('front.edit_property', compact('category','locations','form_type','states', 'cities', 'locations', 'sub_locations', 'property', 'property_images', 'subcategories', 'amenities'));
	}

	public function userPreviewPropertyView($id) {
		$category  = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields','FormTypesFields.SubFeatures')->where('id',1)->get();
		$property  = Properties::find($id);
		$states    = State::where('country_id', 101)->get();
		$cities    = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$property_images = PropertyGallery::where('property_id', $id)->get();
		$subcategories = SubCategory::where('category_id', $property->category_id)->get();
		$amenities = Amenity::where('status', 'Yes')->get();
		return view('front.preview_property', compact('category','locations','form_type','states', 'cities', 'locations', 'sub_locations', 'property', 'property_images', 'subcategories', 'amenities', 'id'));
	}

	public function updateProperty(Request $request) {
		$request->validate(
			[
				'title'             => 'required|max:200',
				'type_id'           => 'required',
				'price'             => 'required|numeric',
				'price_label.*'     => 'required',
				'category_id'       => 'required',
				'sub_category_id'   => 'required',
				'construction_age'  => 'required',
				'description'       => 'required',
				'address'           => 'required',
				'location_id'       => 'required',
				'sub_location_id'   => 'nullable',
				"gallery_images_file.*" => 'nullable|mimes:jpg,png,jpeg',
			]
		);
		$picked = Properties::find($request->id);
		$price_label = $request->has('price_label') ? implode(',', $request->price_label) : null;
		$picked->update(
			[
				'title'           => $request->title,
				'type_id'         => $request->type_id,
				'price'           => $request->price,
				'price_label'     => $price_label,
				'description'     => $request->description,
				'category_id'     => $request->category_id,
				'sub_category_id' => $request->sub_category_id,
				'address'         => $request->address,
				'state_id'        => $request->state,
				'city_id'         => $request->city,
				'location_id'     => implode(',', $request->location_id),
				'sub_location_id' => $request->has('sub_location_id') ? implode(',', $request->sub_location_id) : null,
				'amenities'       => $request->has('amenity') ? implode(',', $request->amenity) : null,
				'additional_info' => $request->form_json,
				'construction_age'=> $request->construction_age
			]
		);
		if($request->has('gallery_images_file')) {
			$gallery_images = $this->multipleFileUpload($request, ['uploads/properties/gallery_images/' => 'gallery_images_file']);
			foreach ($gallery_images as $key => $value) {
				PropertyGallery::create(['property_id' => $picked->id, 'image_path' => $value]);					
			}
		}

		if($request->from) {
			return redirect('user/property/preview/'.$picked->id);
		}else {
			if(\Auth::user()->role == 'owner') {
				return redirect('user/properties')->with('success', 'Property Content Updated Successfully.');
			}else if(\Auth::user()->role == 'builder') {
				return redirect('builder/properties')->with('success', 'Property Content Updated Successfully.');
			}else if(\Auth::user()->role == 'agent') {
				return redirect('agent/properties')->with('success', 'Property Content Updated Successfully.');
			}
		}
	}

	public function deleteGalleryImages(Request $request) {
		$picked = PropertyGallery::find($request->id);
		$this->imageDeleteFromFolder('uploads/properties/gallery_images/', $picked->image_path);
		$picked->delete();
		return 'Image Deleted Successfully.';
	}

	public function deleteProperty(Request $request) {
		$picked = Properties::find($request->id);
		$images = PropertyGallery::where('property_id', $picked->id)->get();
		if(count($images) > 0) {
			foreach ($images as $key => $value) {
				$this->imageDeleteFromFolder('uploads/properties/gallery_images/', $value->image_path);
				PropertyGallery::find($value->id)->delete();
			}
		}
		$picked->delete();
		return 'Package Deleted Successfully.';
	}
	
	public function agent_enquiry(Request $request) {
		$rules = [
			"property_id" => "required",
			"name" => "required",
			"email" => "required|email",
			"mobile_number" => "required|numeric",
			"interested_in" => "required"
		];
		$this->checkValidate($request, $rules); 
		
		try {
			$claim = AgentEnquiry::create($request->all());
			return redirect()->back()->with('alert-success', 'Your Query Successfully Submitted.');
		} catch(\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function aboutUs() {
		$about  = HomePageContent::where('slug', 'about')->first();
		$vision = HomePageContent::where('slug', 'vision')->first();
        $keys   = HomePageContent::where('slug', 'vision-keys')->get();
		return view('front.about_us', compact('about', 'vision', 'keys'));
	}

	public function termCondition() {
		$term = HomePageContent::where('slug', 'terms')->first();
		return view('front.terms', compact('term'));
	}

	public function privecyPolicy() {
		$policy = HomePageContent::where('slug', 'policy')->first();
		return view('front.policy', compact('policy'));
	}

	public function contactUs() {
		$infos = ContactInfo::get();
		$map_link  = HomePageContent::where('slug', 'map-link')->first();
		return view('front.contact_us', compact('infos', 'map_link'));
	}

	public function testimonial() {
		$picked = HomePageContent::where('slug', 'testimonial')->first();
		$testimonials = Testimonial::where('status', 'Yes')->get();
		return view('front.testimonial', compact('testimonials', 'picked'));
	}

	public function safetyHealth() {
		$picked = HomePageContent::where('slug', 'safety')->first();
		return view('front.safety-guide', compact('picked')); 
	}

	public function summonsNotice() {
		$reasons = SummonsReason::get();
		return view('front.summons-notice', compact('reasons')); 
	}

	public function sendSummonsNotice(Request $request) {
		$request->validate(
			[
				'name'         => 'required|max:200',
				'email'        => 'required|max:200|email',
				'phone_number' => 'required|max:200',
				'link'         => 'nullable|url',
				'file'         => 'nullable|mimes:jpg,png,jpeg,svg,pdf|max:2000',
			]
		);
		$reasons = $request->has('reason') ? implode(',', $request->reason) : null;
		if($request->hasFile('file')){
            $path = $request->file->store('complaints');
        }else {
            $path = null;
        }
		Complaint::create(
			[
				'name'           => $request->name,
				'email'          => $request->email,
				'mobile_number'  => $request->phone_number,
				'link'           => $request->link,
				'reasons'        => $reasons,
				'other'          => $request->has('other') ? 'Yes' : 'No',
				'other_reason'   => $request->other_reason,
				'message'        => $request->message,
				'file'           => $path
			]
		);
		return redirect()->back()->with('success', 'Your Complaint successfully send, please wait for our response.');
	}

	public function careerWithUs() {
		$picked     = HomePageContent::where('slug', 'career')->first();
		$categories = JobCategory::with('getRealatedJobs')->where('status', 'Yes')->get();
		return view('front.career-with-us', compact('picked', 'categories'));
	}

	public function jobdetail($id) {
		$job          = Job::find($id);
		$skills       = Technology::whereIn('id', explode(',', $job->skills))->get();
		$related_jobs = Job::where('category_id', $job->category_id)->whereNotIn('id', [ $job->id ])->get();
		return view('front.job-detail', compact('job', 'skills', 'related_jobs'));
	}

	public function sendJobRequest(Request $request) {
		$request->validate(
			[
				'name'          => 'required|max:150',
				'email'         => 'required|email',
				'mobile_number' => 'required|digits:10',
				'file'          => 'required|mimes:pdf|max:2000'
			]
		);
		if($request->hasFile('file')){
            $path = $request->file->store('resume');
        }
        JobRequest::create(
        	[
        		'job_id'        => $request->job_id,
				'name'          => $request->name,
				'email'         => $request->email,
				'mobile_number' => $request->mobile_number,
				'resume'        => $path
        	]
        );
        return redirect()->back()->with('success', 'Your Query Successfully Submitted, Please Wait For Our Response.');
	}

	public function blog() {
		$featured        = Blog::where('featured', 'Yes')->get();
		$blog_categories = BlogCategory::where('status', 'Yes')->get();
		return view('front.blog', compact('featured', 'blog_categories'));
	}

	public function blogDetail($id) {
		$blog_detail = Blog::find($id);
		$related_blogs = Blog::where('category_id', $blog_detail->category_id)->whereNotIn('id', [$blog_detail->id])->where('status', 'Yes')->get();
		return view('front.blog-detail', compact('blog_detail', 'related_blogs'));
	}

	public function createTestimonial(Request $request) {
        $request->validate(
            [
                'name'        => 'required|max:200',
                'email'       => 'required|email',
                'designation' => 'required|max:200',
                'description' => 'required',
                'image'       => 'required|mimes:jpg,png,jpeg|max:200'
            ]
        );
        if($request->hasFile('image')){
            $path = $request->image->store('testimonials');
        }else {
            $path = null;
        }
        Testimonial::create(
            [
                'name'         => $request->name,
                'email'        => $request->email,
                'mobile_number'=> $request->mobile_number,
                'image'        => $path,
                'designation'  => $request->designation,
                'description'  => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Your Feedback Successfully Submitted.');
    }

    public function getCities(Request $request) {
    	$cities = City::where('state_id', $request->state_id)->get();
    	return $cities;
    }

    public function getLocations(Request $request) {
    	$locations = Locations::where('city_id', $request->city_id)->get();
    	return $locations;
    }	

    public function getSubLocations(Request $request) {
    	$sub_locations = SubLocations::whereIn('location_id', $request->location_id)->get();
    	return $sub_locations;
    }

    public function getAllCities(Request $request) {
    	$states = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
    	$cities = City::where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(500);
    	return view('layouts.front.cities-modal', compact('cities', 'states'))->render();
    }

    public function getAllCitiesAncher(Request $request) {
    	if($request->input('search')){
    		$cities = City::where('name', 'LIKE', "%$request->search%")->where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(100);
    	}else{
    		$cities = City::where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(100);
    	}
    	return view('layouts.front.cities-ancher', compact('cities'))->render();
    }

    public function autoSearch(Request $request) {
    	$search = $request->input('query');
    	$data = City::select("id","name")
            ->where("name","LIKE",'%' .$search . '%')
            ->orderby('name','asc')
            ->get();
        return response()->json($data);
    }

    public function getSubCategories($category_id) {
        try {
			$findSubCategories = SubCategory::where('category_id', $category_id)->get();
			$data['status'] = 200;
			$data['subcategories'] = $findSubCategories;
			return $data;
		} catch(\Exception $e) {
		    $data['status'] = 500;
			$data['subcategories'] = $e->getMessage();
			return $data;
		}
    }

    public function sendLoginOtp(Request $request) {
    	$check_input_type = $this->checkValidLoginType($request->email);
    	if($check_input_type == 'email'){
    		$picked = User::where('email', $request->email)->first();
    	}else if($check_input_type == 'mobile') {
    		$picked = User::where('mobile_number', $request->email)->first();
    	}
    	if(!$picked) {
    		$data['status'] = 500;
			$data['data']   = null;
			$data['msg']    = 'User not exist, for this email or mobile number';
			return $data;
    	}
    	$otp = rand(100000, 999999);
    	Otp::create(
    		[
    			'otp'     => $otp,
    			'user_id' => $picked->id
    		]
    	);
    	$emailOTPtemplate = EmailTemplate::where('id',4)->first();
    	$replaceOTPtemplate = Array(
        	'#NAME'    => $picked->firstname.' '.$picked->lastname,
        	'#OTP'     => $otp
        );
        $this->__sendEmail($picked, $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
        // Send SMS
		$message = "Your one time password is  ".$otp." %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
    	$this->sendGlobalSMS($picked->mobile_number, $message);
    	$data['status'] = 200;
		$data['data']   = null;
		$data['msg']    = 'OTP Successfully Send On User Email & Mobile Number.';
		return $data;
    }

    public function userVerifyEmail() {
    	$otp = rand(100000, 999999);
    	Otp::create(
    		[
    			'otp'     => $otp,
    			'user_id' => \Auth::id()
    		]
    	);
    	$emailOTPtemplate = EmailTemplate::where('id',7)->first();
    	$replaceOTPtemplate = Array(
        	'#NAME'    => \Auth::user()->firstname.' '.\Auth::user()->lastname,
        	'#OTP'     => $otp
        );
        $this->__sendEmail(\Auth::user(), $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
        return 'OTP Successfully Send On Your Registered Email Id.';
    }

    public function userVerifyMobile() {
    	$otp = rand(100000, 999999);
    	Otp::create(
    		[
    			'otp'     => $otp,
    			'user_id' => \Auth::id()
    		]
    	);
    	$message = "Your one time password is  ".$otp." %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
    	$this->sendGlobalSMS(\Auth::user()->mobile_number, $message);
    	return 'OTP Successfully Send On Your Registered Mobile Number.';
    }

    public function emailMobileOtpVerification(Request $request) {
    	$picked = \Auth::user();
    	$otp = Otp::where('otp', $request->otp)->first();
    	if(!$otp) {
    		return redirect()->back()->with('error', 'Invalid OTP, Please Enter Correct OTP.');
    	}
    	if($otp->user_id != \Auth::id()) {
    		return redirect()->back()->with('error', 'Invalid User.');
    	}	
		$msg;
		if($request->input('type') == 'email') {
			$status = '1';
			$msg    = 'Email Verified Successfully.';
			$picked->update(
				[
					'is_verified' => $status
				]
			);
		}else if($request->input('type') == 'mobile') {
			$status = '1';
			$msg    = 'Mobile Number Verified Successfully.';
			$picked->update(
				[
					'mobile_verified' => $status
				]
			);
		}
		$otp->delete();
		return redirect()->back()->with('success', $msg);
    }
    
    public function cookiesPolicy() {
        return view('front.cookies_policy');
    }
    
    public function cancellationPolicy() {
        return view('front.cancellation_policy');
    }
    
    public function faq() {
        return view('front.faq');
    }
    
    public function adertisementPolicy() {
        return view('front.adertisement_policy');
    }
    
    public function agentProperties() {
        return view('front.agent_properties');
    }
    
    public function builderProperties() {
        return view('front.builder_properties');
    }
    
    public function builderProfile() {
        return view('front.builder_profile');
    }

}

