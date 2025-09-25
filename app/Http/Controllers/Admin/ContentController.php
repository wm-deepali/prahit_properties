<?php

namespace App\Http\Controllers\Admin;

use DataTables; 
use App\Feature;
use App\SocialMedia;
use App\ContactInfo;
use App\Testimonial;
use App\HelpContent;
use App\FooterContent;
use App\SummonsReason;
use App\SupportCenter;
use App\HomePageContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function manageAboutContent() {
    	$picked = HomePageContent::where('slug', 'about')->first();
    	return view('admin.manage_about', compact('picked'));
    }

    public function updateAboutContent(Request $request) {
    	$request->validate(
    		[
    			'heading'     => 'required|max:200',
    			'description' => 'required',
                'images'      => 'nullable|mimes:jpg,png,jpeg:max:2000',
    		]
    	);
    	$picked = HomePageContent::find($request->id);
        if($request->hasFile('images')){
            $path = $request->images->store('content');
            Storage::delete($picked->images);
        }else {
            $path = $picked->images;
        }
    	$picked->update(
    		[
    			'heading'     => $request->heading,
    			'description' => $request->description,
                'images'      => $path
    		]
    	);
    	return redirect()->back()->with('success', 'Content updated successfully');
    }

    public function manageTerms() {
    	$picked = HomePageContent::where('slug', 'terms')->first();
    	return view('admin.manage_terms', compact('picked'));
    }

    public function managePolicy() {
    	$picked = HomePageContent::where('slug', 'policy')->first();
    	return view('admin.manage_policy', compact('picked'));
    }

    public function manageVisionMission() {
        $picked = HomePageContent::where('slug', 'vision')->first();
        $keys   = HomePageContent::where('slug', 'vision-keys')->get();
        return view('admin.vision.index', compact('picked', 'keys'));
    }

    public function createVisionMission(Request $request) {
        $request->validate(
            [
                'heading'     => 'required|max:200',
                'description' => 'required'
            ]
        );
        HomePageContent::create(
            [
                'slug'        => 'vision-keys',
                'heading'     => $request->heading,
                'description' => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Vision & mission keys added successfully');
    }

    public function getkeyData($id) {
        try {
            $picked = HomePageContent::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Category updated successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateVisionMission(Request $request) {
        $request->validate(
            [
                'heading'     => 'required|max:200',
                'description' => 'required'
            ]
        );
        $picked = HomePageContent::find($request->id);
        $picked->update(
            [
                'heading'     => $request->heading,
                'description' => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Content updated successfully');
    }


    public function deleteVisionMission($id) {
        try {
            $picked = HomePageContent::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'data delete successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function manageContactInfo() {
        $infos = ContactInfo::get();
        $map_link  = HomePageContent::where('slug', 'map-link')->first();
        return view('admin.contact.manage_contact', compact('infos', 'map_link'));
    }

    public function createContactInfo(Request $request) {
        $request->validate(
            [
                'icon'          => 'required|max:200',
                'title'         => 'required|max:200',
                'email'         => 'required|max:200',
                'mobile_number' => 'required|max:200',
                'address'       => 'required|max:200',
            ]
        );
        ContactInfo::create(
            [
                'icon'          => $request->icon,
                'title'         => $request->title,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'address'       => $request->address,
            ]
        );
        return redirect()->back()->with('success', 'Address added successfully');
    }

    public function getContactInfo($id) {
        try {
            $picked = ContactInfo::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Data foound successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateContactInfo(Request $request) {
        $request->validate(
            [
                'icon'          => 'required|max:200',
                'title'         => 'required|max:200',
                'email'         => 'required|max:200',
                'mobile_number' => 'required|max:200',
                'address'       => 'required|max:200',
            ]
        );
        $picked = ContactInfo::find($request->id);
        $picked->update(
            [
                'icon'          => $request->icon,
                'title'         => $request->title,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'address'       => $request->address,
            ]
        );
        return redirect()->back()->with('success', 'Address updated successfully');
    }

    public function deleteContactInfo($id) {
        try {
            $picked = ContactInfo::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'Address Info deleted successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function sendUserQuery(Request $request) {
        SupportCenter::create(
            [
                'name'          => $request->name,
                'email'         => $request->email,
                'mobile_number' => $request->phone_number,
                'subject'       => $request->msg_subject,
                'message'       => $request->message
            ]
        );
        return redirect()->back()->with('success', 'Your Query Successfully Submitted.');
    }

    public function manageTestimonial() {
        $picked = HomePageContent::where('slug', 'testimonial')->first();
        $testimonials   = Testimonial::orderBy('id', 'DESC')->paginate(10);
        return view('admin.testimonial.index', compact('picked', 'testimonials'));
    }

    public function createTestimonial(Request $request) {
        $request->validate(
            [
                'name'        => 'required|max:200',
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
                'image'        => $path,
                'designation'  => $request->designation,
                'description'  => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Testimonial added successfully');
    }

    public function getTestimonialData($id) {
        try {
            $picked = Testimonial::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateTestimonial(Request $request) {
        $request->validate(
            [
                'name'        => 'required|max:200',
                'designation' => 'required|max:200',
                'up_description' => 'required',
                'image'       => 'nullable|mimes:jpg,png,jpeg|max:200'
            ]
        );
        $picked = Testimonial::find($request->id);
        if($request->hasFile('image')){
            $path = $request->image->store('testimonials');
            Storage::delete($picked->image);
        }else {
            $path = $picked->image;
        }
        $picked->update(
            [
                'name'         => $request->name,
                'image'        => $path,
                'designation'  => $request->designation,
                'description'  => $request->up_description
            ]
        );
        return redirect()->back()->with('success', 'Testimonial updated successfully');
    }

    public function deleteTestimonial($id) {
        try {
            $picked = Testimonial::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'Testimonial deleted successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function changeStatusTestimonial(Request $request) {
        $picked = Testimonial::find($request->id);
        $status = $picked->status == 'Yes' ? 'No' : 'Yes';
        $msg    = $picked->status == 'Yes' ? 'Testimonial Blocked Successfully.' : 'Testimonial Activated Successfully.';
        $picked->update(
            [
                'status' => $status
            ]
        );
        return $msg;
    } 

    public function showOnFrontTestimonial(Request $request) {
        $picked = Testimonial::find($request->id);
        $status = $picked->show_on_front == 'Yes' ? 'No' : 'Yes';
        $msg    = $picked->show_on_front == 'Yes' ? 'Testimonial Hide From Front Successfully.' : 'Testimonial Show On Front Successfully.';
        $picked->update(
            [
                'show_on_front' => $status
            ]
        );
        return $msg;
    }

    public function manageSafetyHealth(Request $request) {
        $picked = HomePageContent::where('slug', 'safety')->first();
        return view('admin.manage_safety_health', compact('picked'));
    }

    public function manageSummonsReasons(Request $request) {
        $reasons = SummonsReason::orderBy('id', 'DESC')->paginate(10);
        return view('admin.manage_summons_reasons', compact('reasons'));
    }

    public function createSummonsReasons(Request $request) {
        SummonsReason::create(
            [
                'reason' => $request->description
            ]
        );
        return redirect()->back()->with('success', 'Reason added successfully');
    }

    public function getDataSummonsReasons($id) {
        try {
            $picked = SummonsReason::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateSummonsReasons(Request $request) {
        $picked = SummonsReason::find($request->id);
        $picked->update(
            [
                'reason' => $request->up_description
            ]
        );
        return redirect()->back()->with('success', 'Reason updated successfully');
    }

    public function deleteSummonsReasons($id) {
        try {
            $picked = SummonsReason::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'Reason delete successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function manageCarrerWithUs() {
        $picked = HomePageContent::where('slug', 'career')->first();
        return view('admin.manage_career_with_us', compact('picked'));
    }

    public function updateCareerWithUsContent(Request $request) {
        $request->validate(
            [
                'banner_heading' => 'required|max:200',
                'heading'        => 'required|max:200',
                'description'    => 'required',
                'banner_description'    => 'required',
                'images'         => 'nullable|mimes:jpg,png,jpeg:max:2000',
            ]
        );
        $picked = HomePageContent::find($request->id);
        if($request->hasFile('images')){
            $path = $request->images->store('content');
            Storage::delete($picked->images);
        }else {
            $path = $picked->images;
        }
        $picked->update(
            [
                'heading'         => $request->heading,
                'heading_more'    => $request->banner_heading,
                'description'     => $request->description,
                'sub_description' => $request->banner_description,
                'images'          => $path
            ]
        );
        return redirect()->back()->with('success', 'Content updated successfully');
    }

    public function manageFeatureContent() {
        $features = Feature::orderBy('id', 'DESC')->paginate(10);
        return view('admin.manage_feature_content', compact('features'));
    }

    public function createFeatureContent(Request $request) {
        $request->validate(
            [
                'heading'     => 'required|max:200',
                'image'       => 'required|mimes:jpg,png,jpeg,svg',
                'description' => 'required',
            ]
        );
        $count = Feature::count();
        if($count == 4 || $count > 4) {
            return redirect()->back()->with('error', 'You can not add more then 4 features.');
        }
        $path = $request->image->store('features');
        Feature::create(
            [
                'heading'     => $request->heading,
                'image'       => $path,
                'description' => $request->description,
            ]
        );
        return redirect()->back()->with('success', 'Feature Created Successfully.');
    }

    public function getFeatureContent($id) {
        try {
            $picked = Feature::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateFeatureContent(Request $request) {
        $request->validate(
            [
                'heading'     => 'required|max:200',
                'image'       => 'nullable|mimes:jpg,png,jpeg,svg',
                'up_description' => 'required',
            ]
        );
        $picked = Feature::find($request->id);
        if($request->has('image')) {
            $path = $request->image->store('features');
            Storage::delete($picked->image);
        }else {
            $path = $picked->image;
        }
        $picked->update(
            [
                'heading'     => $request->heading,
                'image'       => $path,
                'description' => $request->up_description,
            ]
        );
        return redirect()->back()->with('success', 'Feature Updated Successfully.');
    }

    public function deleteFeatureContent($id) {
        try {
            $picked = Feature::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'Feature deleted successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function changeStatusFeatureContent(Request $request) {
        $picked = Feature::find($request->id);
        $status = $picked->status == 'Yes' ? 'No' : 'Yes';
        $msg    = $picked->status == 'Yes' ? 'Feature Blocked Successfully.' : 'Feature Activated Successfully.';
        $picked->update(
            [
                'status' => $status
            ]
        );
        return $msg;
    } 

    public function manageHelpContent() {
        $content = HelpContent::first();
        return view('admin.manage_help_content', compact('content'));
    }

    public function updateHelpContent(Request $request) {
        $request->validate(
            [
                'heading' => 'required|max:200'
            ]
        );
        $picked = HelpContent::find($request->id);
        $picked->update(
            [
                'heading'       => $request->heading,
                'content_one'   => $request->description_one,
                'content_two'   => $request->description_two,
                'content_three' => $request->description_three
            ]
        );
        return redirect()->back()->with('success', 'Content Updated Successfully.');
    }

    public function manageSocialMedia() {
        $media = SocialMedia::first();
        return view('admin.manage_social_media', compact('media'));
    }

    public function updateSocialMedia(Request $request) {
        $request->validate(
            [
                'facebook' => 'required|url',
                'twitter'  => 'required|url',
                'insta'    => 'required|url',
                'youtube'  => 'required|url'
            ]
        );
        $picked = SocialMedia::find($request->id);
        $picked->update(
            [
                'facebook' => $request->facebook,
                'twitter'  => $request->twitter,
                'insta'    => $request->insta,
                'youtube'  => $request->youtube
            ]
        );
        return redirect()->back()->with('success', 'Links Updated Successfully.');
    }

    public function manageFooterContent() {
        $data['app']    = FooterContent::where('slug', 'app')->first();
        $data['footer'] = FooterContent::where('slug', 'footer')->first();
        return view('admin.manage_footer_content', compact('data'));
    }

    public function updateFooterContent(Request $request) {
        $request->validate(
            [
                'key_one'   => 'nullable|max:100',
                'key_two'   => 'nullable|max:100',
                'key_three' => 'nullable|max:100',
                'image'     => 'nullable|mimes:jpg,jpeg,png'
            ]
        );
        $picked = FooterContent::find($request->id);
        if($request->has('image')) {
            $path = $request->image->store('content');
            Storage::delete($picked->image);
        }else {
            $path = $picked->image;
        }
        $picked->update(
            [
                'heading'      => $request->has('heading') ? $request->heading : $picked->heading,
                'title'        => $request->has('title') ? $request->title : $picked->title,
                'description'  => $request->has('description') ? $request->description : $picked->description,
                'key_one'      => $request->has('key_one') ? $request->key_one : $picked->key_one,
                'key_two'      => $request->has('key_two') ? $request->key_two : $picked->key_two,
                'key_three'    => $request->has('key_three') ? $request->key_three : $picked->key_three,
                'image'        => $path
            ]
        );
        return redirect()->back()->with('success', 'Content Updated Successfully.');
    }
}
