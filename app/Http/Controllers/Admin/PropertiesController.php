<?php

namespace App\Http\Controllers\Admin;

use File;
use App\City;
use App\User;
use App\State;
use App\Amenity;
use ZipArchive;
use DataTables;
use App\Category;
use App\Locations;
use App\FormTypes;
use App\Properties;
use App\SubSubCategory;
use App\PropertyGallery;
use App\PropertyTypes;
use App\ClaimListing;
use App\SubLocations;
use App\AgentEnquiry;
use App\SubCategory;
use App\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\PriceLabel;
use App\Models\PropertyStatus;
use App\Models\FurnishingStatus;
use App\Models\RegistrationStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Http\Controllers\AppController;
use Illuminate\Support\Str;

class PropertiesController extends AppController
{
	use GlobalTrait;

	public function pendinPropertyList()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		return view('admin.properties.pending_properties', compact('location', 'sublocation', ));
	}

	public function manageApprovedProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		return view('admin.properties.approved_properties', compact('location', 'sublocation',));
	}

	public function managePublishedProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		return view('admin.properties.published_property', compact('location', 'sublocation',));
	}

	public function manageCancelledProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		return view('admin.properties.cancelled_properties', compact('location', 'sublocation',));
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$get_values = $_GET;
			$filters = [];
			$min_price = 0;
			$max_price = 0;
			$from = null;
			$to = null;
			$ownership = null;
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if ($new_key == 'min_price') {
						$min_price = $min_price + $value;
					}
					if ($new_key == 'max_price') {
						$max_price = $max_price + $value;
					}
					if ($new_key == 'form_date') {
						$from = $value;
					}
					if ($new_key == 'to_date') {
						$to = $value;
					}
					if ($new_key == 'ownership') {
						$ownership = $value;
					}
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
						$filters[$new_key] = $value;
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
						$filters[$new_key] = $value;
					}
				}
			}
			$user_ids = [];
			$users = User::where('role', $ownership)->get();
			if ($users) {
				foreach ($users as $user) {
					array_push($user_ids, $user->id);
				}
			}

			if (count($filters) > 0) {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where($filters)->where('approval', 'Pending')->where('publish_status', 'Unpublish')->latest()->get();
				}
			} else {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Pending')
						->where('publish_status', 'Unpublish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where('approval', 'Pending')->where('publish_status', 'Unpublish')->latest()->get();
				}

			}
			return \Yajra\DataTables\DataTables::of($datas)
				->addColumn('date_time', function ($datas) {
					$dt = new \DateTime($datas->created_at);
					$tz = new \DateTimeZone('Asia/Kolkata');
					$dt->setTimezone($tz);
					$dateTime = $dt->format('d.m.Y h:i A');
					return $dateTime;
				})
				->addColumn('category', function ($datas) {
					$category = Category::find($datas->category_id);
					$subcategory = SubCategory::find($datas->sub_category_id);
					$subsubcategory = SubSubCategory::find($datas->sub_sub_category_id); // adjust model & field name as needed
	
					$categoryName = $category ? $category->category_name : 'N/A';
					$subcategoryName = $subcategory ? $subcategory->sub_category_name : '';
					$subsubcategoryName = $subsubcategory ? $subsubcategory->sub_sub_category_name : '';

					// Combine with <br> for line breaks
					return $categoryName . '<br>' . $subcategoryName . '<br>' . $subsubcategoryName;
				})
				->addColumn('city', function ($datas) {
					return $datas->getCity->name;
				})
				->addColumn('status', function ($datas) {
					$status = $datas->status == 1 ? 'Active' : 'Inactive';
					return $status;
				})
				->addColumn('listing_id', function ($datas) {
					$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $datas->id . ')" name="edit">' . $datas->listing_id . '</a>';
					return $listing_id;
				})
				->addColumn('owner_type', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $user->id . ')">' . ucfirst($user->role) . '</span>' : 'N/A';
				})
				->addColumn('added_by', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
				})
				->addColumn('total_enquiry', function ($datas) {
					$count = AgentEnquiry::where('property_id', $datas->id)->count();
					return $count;
				})
				->addColumn('price', function ($datas) {
					return '₹' . $datas->price;
				})
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="approveProperty(' . $datas->id . ')" title="Approved & Publish Property"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="approveProperty(' . $datas->id . ')" title="Approved & Publish Property"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'category'])
				->make(true);
		}

	}

	public function manageApprovedPropertiesDatatable(Request $request)
	{
		if ($request->ajax()) {
			$get_values = $_GET;
			$filters = [];
			$min_price = 0;
			$max_price = 0;
			$from = null;
			$to = null;
			$ownership = null;
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if ($new_key == 'min_price') {
						$min_price = $min_price + $value;
					}
					if ($new_key == 'max_price') {
						$max_price = $max_price + $value;
					}
					if ($new_key == 'form_date') {
						$from = $value;
					}
					if ($new_key == 'to_date') {
						$to = $value;
					}
					if ($new_key == 'ownership') {
						$ownership = $value;
					}
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
						$filters[$new_key] = $value;
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
						$filters[$new_key] = $value;
					}
				}
			}
			$user_ids = [];
			$users = User::where('role', $ownership)->get();
			if ($users) {
				foreach ($users as $user) {
					array_push($user_ids, $user->id);
				}
			}

			if (count($filters) > 0) {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where($filters)->where('approval', 'Approved')->where('publish_status', 'Unpublish')->latest()->get();
				}
			} else {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where('approval', 'Approved')
						->where('publish_status', 'Unpublish')->latest()->get();
				}

			}
			return DataTables::of($datas)
				->addColumn('date_time', function ($datas) {
					$dt = new \DateTime($datas->created_at);
					$tz = new \DateTimeZone('Asia/Kolkata');
					$dt->setTimezone($tz);
					$dateTime = $dt->format('d.m.Y h:i A');
					return $dateTime;
				})
				->addColumn('category', function ($datas) {
					$category = Category::find($datas->category_id);
					$subcategory = SubCategory::find($datas->sub_category_id);
					$subsubcategory = SubSubCategory::find($datas->sub_sub_category_id); // adjust model & field name as needed
	
					$categoryName = $category ? $category->category_name : 'N/A';
					$subcategoryName = $subcategory ? $subcategory->sub_category_name : '';
					$subsubcategoryName = $subsubcategory ? $subsubcategory->sub_sub_category_name : '';

					// Combine with <br> for line breaks
					return $categoryName . '<br>' . $subcategoryName . '<br>' . $subsubcategoryName;
				})
				->addColumn('city', function ($datas) {
					return $datas->getCity->name;
				})

				->addColumn('status', function ($datas) {
					$status = $datas->status == 1 ? 'Active' : 'Inactive';
					return $status;
				})
				->addColumn('listing_id', function ($datas) {
					$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $datas->id . ')" name="edit">' . $datas->listing_id . '</a>';
					return $listing_id;
				})
				->addColumn('owner_type', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $user->id . ')">' . ucfirst($user->role) . '</span>' : 'N/A';
				})
				->addColumn('added_by', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
				})
				->addColumn('total_enquiry', function ($datas) {
					$count = AgentEnquiry::where('property_id', $datas->id)->count();
					return $count;
				})
				->addColumn('price', function ($datas) {
					return '₹' . $datas->price;
				})
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="publishedProperty(' . $datas->id . ')" title="Published Property"><i class="fa fa-check" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" href="' . url('create/property-images/zip') . '/' . $datas->id . '" title="Download Property Images"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" id="publish_status' . $datas->id . '" publish-status="' . $datas->publish_status . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="publishedProperty(' . $datas->id . ')" title="Published Property"><i class="fa fa-check" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a href="' . url('create/property-images/zip') . '/' . $datas->id . '" style="cursor:pointer;" title="Download Property Images"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'category'])
				->make(true);
		}

	}

	public function managePublishedPropertiesDatatable(Request $request)
	{
		if ($request->ajax()) {
			$get_values = $_GET;
			$filters = [];
			$min_price = 0;
			$max_price = 0;
			$from = null;
			$to = null;
			$ownership = null;
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if ($new_key == 'min_price') {
						$min_price = $min_price + $value;
					}
					if ($new_key == 'max_price') {
						$max_price = $max_price + $value;
					}
					if ($new_key == 'form_date') {
						$from = $value;
					}
					if ($new_key == 'to_date') {
						$to = $value;
					}
					if ($new_key == 'ownership') {
						$ownership = $value;
					}
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
						$filters[$new_key] = $value;
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
						$filters[$new_key] = $value;
					}
				}
			}
			$user_ids = [];
			$users = User::where('role', $ownership)->get();
			if ($users) {
				foreach ($users as $user) {
					array_push($user_ids, $user->id);
				}
			}

			if (count($filters) > 0) {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where($filters)->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where($filters)->where('approval', 'Approved')->where('publish_status', 'Publish')->latest()->get();
				}
			} else {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where('approval', 'Approved')
						->where('publish_status', 'Publish')
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where('approval', 'Approved')
						->where('publish_status', 'Publish')->latest()->get();
				}
			}

			return DataTables::of($datas)
				->addColumn('date_time', function ($datas) {
					$dt = new \DateTime($datas->created_at);
					$tz = new \DateTimeZone('Asia/Kolkata');
					$dt->setTimezone($tz);
					$dateTime = $dt->format('d.m.Y h:i A');
					return $dateTime;
				})
				->addColumn('category', function ($datas) {
					$category = Category::find($datas->category_id);
					$subcategory = SubCategory::find($datas->sub_category_id);
					$subsubcategory = SubSubCategory::find($datas->sub_sub_category_id); // adjust model & field name as needed
	
					$categoryName = $category ? $category->category_name : 'N/A';
					$subcategoryName = $subcategory ? $subcategory->sub_category_name : '';
					$subsubcategoryName = $subsubcategory ? $subsubcategory->sub_sub_category_name : '';

					// Combine with <br> for line breaks
					return $categoryName . '<br>' . $subcategoryName . '<br>' . $subsubcategoryName;
				})
				->addColumn('city', function ($datas) {
					return $datas->getCity->name;
				})
				->addColumn('status', function ($datas) {
					$status = $datas->status == 1 ? 'Active' : 'Inactive';
					return $status;
				})
				->addColumn('listing_id', function ($datas) {
					$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $datas->id . ')" name="edit">' . $datas->listing_id . '</a>';
					return $listing_id;
				})
				->addColumn('owner_type', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $user->id . ')">' . ucfirst($user->role) . '</span>' : 'N/A';
				})
				->addColumn('added_by', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
				})
				->addColumn('total_enquiry', function ($datas) {
					$count = AgentEnquiry::where('property_id', $datas->id)->count();
					return $count;
				})
				->addColumn('price', function ($datas) {
					return '₹' . $datas->price;
				})
				->addColumn('trending', function ($datas) {
					if ($datas->trending == 'Yes') {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageTrendingStatus(' . $datas->id . ')" checked>
							  <span class="slider round"></span>
							</label>';
					} else {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageTrendingStatus(' . $datas->id . ')">
							  <span class="slider round"></span>
							</label>';
					}
				})
				->addColumn('featured', function ($datas) {
					if ($datas->featured == 'Yes') {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageFeaturedStatus(' . $datas->id . ')" checked>
							  <span class="slider round"></span>
							</label>';
					} else {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageFeaturedStatus(' . $datas->id . ')">
							  <span class="slider round"></span>
							</label>';
					}
				})
				->addColumn('verified', function ($datas) {
					if ($datas->verified == 'Yes') {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageVerifiedStatus(' . $datas->id . ')" checked>
							  <span class="slider round"></span>
							</label>';
					} else {
						return '<label class="switch">
							  <input type="checkbox" onclick="manageVerifiedStatus(' . $datas->id . ')">
							  <span class="slider round"></span>
							</label>';
					}
				})
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Block Property"><i class="fa fa-check-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Active Property"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'trending', 'featured', 'category', 'verified'])
				->make(true);
		}
	}

	public function getTotalProperties(Request $request)
	{
		if ($request->ajax()) {
			if ($request->input('listing_type')) {
				$datas = Properties::where('user_id', $request->input('user_id'))->where('listing_type', $request->input('listing_type'))->orderBy('id', 'DESC')->get();
			} else {
				$datas = Properties::where('user_id', $request->input('user_id'))->orderBy('id', 'DESC')->get();
			}

			return DataTables::of($datas)
				->addColumn('date_time', function ($datas) {
					$dt = new \DateTime($datas->created_at);
					$tz = new \DateTimeZone('Asia/Kolkata');
					$dt->setTimezone($tz);
					$dateTime = $dt->format('d.m.Y h:i A');
					return $dateTime;
				})
				->addColumn('category', function ($datas) {
					$category = Category::find($datas->category_id);
					$subcategory = SubCategory::find($datas->sub_category_id);
					$subsubcategory = SubSubCategory::find($datas->sub_sub_category_id); // adjust model & field name as needed
	
					$categoryName = $category ? $category->category_name : 'N/A';
					$subcategoryName = $subcategory ? $subcategory->sub_category_name : '';
					$subsubcategoryName = $subsubcategory ? $subsubcategory->sub_sub_category_name : '';

					// Combine with <br> for line breaks
					return $categoryName . '<br>' . $subcategoryName . '<br>' . $subsubcategoryName;
				})
				->addColumn('city', function ($datas) {
					return $datas->getCity->name;
				})
				->addColumn('status', function ($datas) {
					$status = $datas->status == 1 ? 'Active' : 'Inactive';
					return $status;
				})
				->addColumn('listing_id', function ($datas) {
					$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $datas->id . ')" name="edit">' . $datas->listing_id . '</a>';
					return $listing_id;
				})
				->addColumn('owner_type', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $user->id . ')">' . ucfirst($user->role) . '</span>' : 'N/A';
				})
				->addColumn('added_by', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
				})
				->addColumn('total_enquiry', function ($datas) {
					$count = AgentEnquiry::where('property_id', $datas->id)->count();
					return $count;
				})
				->addColumn('price', function ($datas) {
					return '₹' . $datas->price;
				})
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Block Property"><i class="fa fa-check-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Active Property"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'category'])
				->make(true);
		}
	}

	public function manageCancelledPropertiesDatatable(Request $request)
	{
		if ($request->ajax()) {
			$get_values = $_GET;
			$filters = [];
			$min_price = 0;
			$max_price = 0;
			$from = null;
			$to = null;
			$ownership = null;
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if ($new_key == 'min_price') {
						$min_price = $min_price + $value;
					}
					if ($new_key == 'max_price') {
						$max_price = $max_price + $value;
					}
					if ($new_key == 'form_date') {
						$from = $value;
					}
					if ($new_key == 'to_date') {
						$to = $value;
					}
					if ($new_key == 'ownership') {
						$ownership = $value;
					}
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
						$filters[$new_key] = $value;
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
						$filters[$new_key] = $value;
					}
				}
			}
			$user_ids = [];
			$users = User::where('role', $ownership)->get();
			if ($users) {
				foreach ($users as $user) {
					array_push($user_ids, $user->id);
				}
			}

			if (count($filters) > 0) {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where(function ($q) {
						$q->where('approval', 'Cancelled')
							->orWhere('approval', 'Rejected');
					})
						->where($filters)
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where($filters)->latest()->get();
				}
			} else {
				if ($min_price != 0 && $max_price != 0 && $from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0 && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($min_price != 0 && $max_price != 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->where('price', '>=', $min_price)
						->where('price', '<=', $max_price)
						->latest()->get();
				} else if ($from && $to && count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else if ($from && $to) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->whereDate('created_at', '>=', $from)
						->whereDate('created_at', '<=', $to)
						->latest()->get();
				} else if (count($user_ids) > 0) {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')
						->where(function ($q) {
							$q->where('approval', 'Cancelled')
								->orWhere('approval', 'Rejected');
						})
						->whereIn('user_id', $user_ids)
						->latest()->get();
				} else {
					$datas = Properties::with('Category', 'Category.Subcategory', 'Location')->where('approval', 'Cancelled')->orWhere('approval', 'Rejected')->latest()->get();
				}
			}
			return DataTables::of($datas)
				->addColumn('date_time', function ($datas) {
					$dt = new \DateTime($datas->created_at);
					$tz = new \DateTimeZone('Asia/Kolkata');
					$dt->setTimezone($tz);
					$dateTime = $dt->format('d.m.Y h:i A');
					return $dateTime;
				})
				->addColumn('category', function ($datas) {
					$category = Category::find($datas->category_id);
					$subcategory = SubCategory::find($datas->sub_category_id);
					$subsubcategory = SubSubCategory::find($datas->sub_sub_category_id); // adjust model & field name as needed
	
					$categoryName = $category ? $category->category_name : 'N/A';
					$subcategoryName = $subcategory ? $subcategory->sub_category_name : '';
					$subsubcategoryName = $subsubcategory ? $subsubcategory->sub_sub_category_name : '';

					// Combine with <br> for line breaks
					return $categoryName . '<br>' . $subcategoryName . '<br>' . $subsubcategoryName;
				})
				->addColumn('city', function ($datas) {
					return $datas->getCity->name;
				})
				->addColumn('status', function ($datas) {
					$status = $datas->status == 1 ? 'Active' : 'Inactive';
					return $status;
				})
				->addColumn('listing_id', function ($datas) {
					$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $datas->id . ')" name="edit">' . $datas->listing_id . '</a>';
					return $listing_id;
				})
				->addColumn('owner_type', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $user->id . ')">' . ucfirst($user->role) . '</span>' : 'N/A';
				})
				->addColumn('added_by', function ($datas) {
					$user = User::find($datas->user_id);
					return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
				})
				->addColumn('total_enquiry', function ($datas) {
					$count = AgentEnquiry::where('property_id', $datas->id)->count();
					return $count;
				})
				->addColumn('price', function ($datas) {
					return '₹' . $datas->price;
				})
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor:poniter;" onclick="viewReason(' . $datas->id . ')" title="View Reason"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor:poniter;" onclick="viewReason(' . $datas->id . ')" title="View Reason"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'category'])
				->make(true);
		}
	}

	public function create()
	{
		$category = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields', 'FormTypesFields.SubFeatures')->where('id', 1)->get();
		$states = State::where('country_id', 101)->get();
		$amenities = Amenity::where('status', 'Yes')->get();

		return view('admin.properties.create', compact(
			'category',
			'locations',
			'form_type',
			'states',
			'amenities',
		));
	}


	public function store(Request $request)
	{
		// -------------------------------------------------
		// AUTH USER (MANDATORY)
		// -------------------------------------------------
		$user = Auth::user();

		if (!$user) {
			return response()->json([
				'status' => 'error',
				'message' => 'Unauthorized access.'
			], 401);
		}

		// -------------------------------------------------
		// VALIDATION
		// -------------------------------------------------
		$validator = Validator::make($request->all(), [
			'title' => 'required|string|max:200|unique:properties,title',
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'sub_sub_category_id' => 'nullable',
			'description' => 'required',
			'address' => 'required',
			'state' => 'required',
			'city' => 'required',
			'location_id' => 'required',
			'custom_location_input' => 'nullable|string|max:255',

			'sub_location_id' => 'nullable|array',
			'sub_location_id.*' => 'nullable|string',

			'landmark' => 'nullable|string|max:255',
			'pincode' => 'nullable|digits:6',

			'gallery_images_file' => 'required|array|min:1',
			'gallery_images_file.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

			'default_image_index' => 'nullable|integer|min:0',

			'property_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 'error',
				'message' => 'Validation failed',
				'errors' => $validator->errors()
			], 422);
		}

		// -------------------------------------------------
		// CUSTOM LOCATION HANDLING
		// -------------------------------------------------
		$locationId = $request->location_id;

		if ($locationId === 'other') {
			if (!$request->custom_location_input) {
				return response()->json([
					'status' => 'error',
					'message' => 'Please enter custom location.'
				], 422);
			}

			$location = Locations::create([
				'state_id' => $request->state,
				'city_id' => $request->city,
				'location' => ucwords(strtolower($request->custom_location_input)),
				'status' => 1,
			]);

			$locationId = $location->id;
		}

		// -------------------------------------------------
		// SUB LOCATIONS (TAGGING SUPPORT)
		// -------------------------------------------------
		$subLocationIds = [];

		if ($request->sub_location_id) {
			foreach ($request->sub_location_id as $value) {

				if (ctype_digit($value)) {
					$subLocationIds[] = $value;
				} else {
					$name = ucwords(strtolower($value));
					$existing = SubLocations::where([
						'location_id' => $locationId,
						'sub_location_name' => $name
					])->first();

					if ($existing) {
						$subLocationIds[] = $existing->id;
					} else {
						$newSub = SubLocations::create([
							'location_id' => $locationId,
							'sub_location_name' => $name,
						]);
						$subLocationIds[] = $newSub->id;
					}
				}
			}
		}


		/* ================= EXTRACT PRICE FROM ADDITIONAL INFO ================= */

		$price = null;
		$price =
			// Sale price
			$this->getValueFromAdditionalInfo($request->additional_info, [
				'Expected Price',
				'Exclusive Price',
				'Offer Price',
				'Starting Price',
			])

			// Rent (flat / office / shop)
			?? $this->getValueFromAdditionalInfo($request->additional_info, [
				'Monthly Rent',
			])

			// PG / Hostel
			?? $this->getValueFromAdditionalInfo($request->additional_info, [
				'Rent Per Bed',
				'Rent Per Person',
				'PG Rent',
			]);


		// -------------------------------------------------
		// CREATE PROPERTY
		// -------------------------------------------------
		$property = Properties::create([
			'user_id' => $user->id,
			'slug' => Str::slug($request->title),
			'listing_id' => 'PP-' . strtoupper(Str::random(8)),

			'title' => $request->title,
			'description' => $request->description,

			'category_id' => $request->category_id,
			'sub_category_id' => $request->sub_category_id,
			'sub_sub_category_id' => $request->sub_sub_category_id,

			'address' => $request->address,
			'state_id' => $request->state,
			'city_id' => $request->city,
			'location_id' => $locationId,
			'sub_location_id' => !empty($subLocationIds) ? implode(',', $subLocationIds) : null,

			'landmark' => $request->landmark,
			'pincode' => $request->pincode,

			'amenities' => $request->has('amenity')
				? implode(',', $request->amenity)
				: null,

			'additional_info' => $request->additional_info,

			'latitude' => $request->latitude,
			'longitude' => $request->longitude,

			// Owner info
			'owner_firstname' => $user->firstname,
			'owner_lastname' => $user->lastname,
			'owner_email' => $user->email,
			'owner_mobile' => $user->mobile_number,
			'price' => $price,
		]);

		// -------------------------------------------------
		// PROPERTY VIDEO
		// -------------------------------------------------
		if ($request->hasFile('property_video')) {
			$video = $request->file('property_video');
			$videoName = uniqid('video_') . '.' . $video->getClientOriginalExtension();
			$video->move(public_path('uploads/properties/videos'), $videoName);

			$property->property_video = 'uploads/properties/videos/' . $videoName;
			$property->save();
		}

		// -------------------------------------------------
		// GALLERY IMAGES + DEFAULT IMAGE
		// -------------------------------------------------
		$defaultIndex = (int) ($request->default_image_index ?? 0);

		foreach ($request->file('gallery_images_file') as $index => $file) {

			$imageName = uniqid('img_') . '.' . $file->getClientOriginalExtension();
			$file->move(public_path('uploads/properties/gallery_images'), $imageName);

			PropertyGallery::create([
				'property_id' => $property->id,
				'image_path' => 'uploads/properties/gallery_images/' . $imageName,
				'is_default' => $index === $defaultIndex ? 1 : 0,
			]);
		}

		// -------------------------------------------------
		// RESPONSE
		// -------------------------------------------------
		return response()->json([
			'status' => 'success',
			'message' => 'Property created successfully',
			'data' => [
				'listing' => $property
			]
		], 200);
	}


	public function edit($id)
	{
		$property = Properties::findOrFail(base64_decode($id));
		// $form_type = FormTypes::with('FormTypesFields','FormTypesFields.SubFeatures','FormTypesFields.SubFeatures')->where('id',1)->get();
		$category = Category::all();
		$locations = Locations::all();
		$states = State::where('country_id', 101)->get();
		$cities = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$amenities = Amenity::where('status', 'Yes')->get();


		return view('admin.properties.edit', compact(
			'property',
			'category',
			'locations',
			'states',
			'cities',
			'sub_locations',
			'amenities',
		));
	}

	public function previewProperty($id)
	{
		$property = Properties::findOrFail($id);
		$category = Category::all();
		$locations = Locations::all();
		$states = State::where('country_id', 101)->get();
		$cities = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$amenities = Amenity::where('status', 'Yes')->get();

		return view('admin.properties.preview', compact(
			'property',
			'category',
			'locations',
			'states',
			'cities',
			'sub_locations',
			'amenities',
			'id',
		));
	}

	public function show($id)
	{
		$property = Properties::select('*', \DB::raw('DATE_FORMAT(published_date, "%d-%b-%Y") as publish_date'))->with('Category', 'SubCategory', 'SubSubCategory', 'Location', 'PropertyGallery', 'PropertyTypes')->findOrFail($id);
		$this->JsonResponse(200, 'Property found successfully', ['Property' => $property]);
	}


	public function update(Request $request)
	{

		try {

			/* ================= VALIDATION ================= */
			$request->validate([
				'id' => 'required|exists:properties,id',
				'title' => 'required|max:200',
				'category_id' => 'required',
				'description' => 'required',
				'address' => 'required',
				'location_id' => 'required',

				'sub_location_id' => 'nullable|array',
				'sub_location_id.*' => 'nullable|string',

				'gallery_images_file.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',

				'property_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
			]);


			/* ================= PROPERTY ================= */
			$property = Properties::findOrFail($request->id);

			$amenities = $request->has('amenity')
				? implode(',', (array) $request->amenity)
				: null;

			/* ================= LOCATION (OTHER) ================= */
			$locationId = $request->location_id;
			if ($locationId === 'other') {
				$name = trim($request->custom_location_input);
				if (!$name) {
					return response()->json([
						'status' => 'error',
						'message' => 'Please enter custom location name'
					], 422);
				}

				$newLocation = \App\Locations::create([
					'state_id' => $request->state,
					'city_id' => $request->city,
					'location' => ucwords(strtolower($name)),
					'status' => 1
				]);
				$locationId = $newLocation->id;
			}

			/* ================= SUB LOCATIONS ================= */
			$resolvedSubLocationIds = [];
			if ($request->filled('sub_location_id')) {
				foreach ($request->sub_location_id as $value) {

					if (ctype_digit($value)) {
						$resolvedSubLocationIds[] = $value;
						continue;
					}

					$new = \App\SubLocations::create([
						'location_id' => $locationId,
						'sub_location_name' => ucwords(strtolower($value))
					]);
					$resolvedSubLocationIds[] = $new->id;
				}
			}



			/* ================= EXTRACT PRICE FROM ADDITIONAL INFO ================= */

			$price = null;
			$price =
				// Sale price
				$this->getValueFromAdditionalInfo($request->additional_info, [
					'Expected Price',
					'Exclusive Price',
					'Offer Price',
					'Starting Price',
				])

				// Rent (flat / office / shop)
				?? $this->getValueFromAdditionalInfo($request->additional_info, [
					'Monthly Rent',
				])

				// PG / Hostel
				?? $this->getValueFromAdditionalInfo($request->additional_info, [
					'Monthly Rent per bed',
					'Rent Per Person',
					'PG Rent',
					'Rent Per Bed'
				]);


			/* ================= UPDATE PROPERTY ================= */
			$property->update([
				'title' => $request->title,
				'slug' => Str::slug($request->title),
				'description' => $request->description,
				'category_id' => $request->category_id,
				'sub_category_id' => $request->sub_category_id,
				'sub_sub_category_id' => $request->sub_sub_category_id,
				'address' => $request->address,
				'state_id' => $request->state,
				'city_id' => $request->city,
				'location_id' => $locationId,
				'sub_location_id' => $resolvedSubLocationIds
					? implode(',', $resolvedSubLocationIds)
					: null,
				'amenities' => $amenities,
				'additional_info' => $request->additional_info,
				'latitude' => $request->latitude,
				'longitude' => $request->longitude,
				'price' => $price,
			]);

			/* ================= PROPERTY VIDEO ================= */
			if ($request->hasFile('property_video')) {
				if ($property->property_video && file_exists(public_path($property->property_video))) {
					@unlink(public_path($property->property_video));
				}

				$video = $request->file('property_video');
				$name = uniqid('video_') . '.' . $video->getClientOriginalExtension();
				$path = $video->storeAs('uploads/properties/videos', $name, 'public');

				$property->property_video = 'storage/' . $path;
				$property->save();
			}

			/* ================= RESET DEFAULT IMAGE ================= */
			PropertyGallery::where('property_id', $property->id)
				->update(['is_default' => 0]);

			/* ================= EXISTING DEFAULT IMAGE ================= */
			if ($request->filled('default_image_id')) {
				PropertyGallery::where('id', $request->default_image_id)
					->where('property_id', $property->id)
					->update(['is_default' => 1]);
			}

			/* ================= NEW GALLERY IMAGES ================= */
			if ($request->hasFile('gallery_images_file')) {

				$uploadedImages = $this->multipleFileUpload($request, [
					'uploads/properties/gallery_images/' => 'gallery_images_file'
				]);

				foreach ($uploadedImages as $index => $path) {

					PropertyGallery::create([
						'property_id' => $property->id,
						'image_path' => $path,
						'is_default' =>
							$request->filled('default_image_index')
							&& $request->default_image_index == $index
							? 1
							: 0
					]);
				}
			}

			/* ================= SUCCESS ================= */
			return response()->json([
				'status' => 'success',
				'message' => 'Property updated successfully',
				'data' => [
					'listing' => $property
				]
			]);

		} catch (\Exception $e) {
			return response()->json([
				'status' => 'error',
				'message' => $e->getMessage()
			], 500);
		}
	}


	private function getValueFromAdditionalInfo($additionalInfoJson, array $labels)
	{
		if (!$additionalInfoJson) {
			return null;
		}

		$fields = json_decode($additionalInfoJson, true);

		if (!is_array($fields)) {
			return null;
		}

		foreach ($fields as $field) {

			if (!isset($field['label'], $field['userData'][0])) {
				continue;
			}

			$label = trim(strip_tags($field['label']));

			if (in_array($label, $labels, true)) {
				return (float) str_replace(',', '', $field['userData'][0]);
			}
		}

		return null;
	}


	public function destroy($id)
	{
		$property = Properties::findOrFail($id);
		$property->status = "0";
		if ($property->save()) {
			$this->JsonResponse(200, 'Property deleted successfully!', []);
		} else {
			$this->JsonResponse(400, 'An error occured');
		}
	}

	public function apply_filters(Request $request)
	{
		try {

			$get_values = $_GET;
			$filters = [];
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
					}
					$filters[$new_key] = $value;
				}
			}
			$properties = Properties::with('Category', 'Category.Subcategory', 'Location')->latest()->where($filters)->get();

			if ($request->ajax()) {
				$all_data = $this->datatable_records($properties);
				return $all_data;
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function datatable_records($records)
	{
		// $data = Sample_data::latest()->get();
		foreach ($records as $key => $value) {
			if ($value->category) {
				$cat = Category::find($value->category_id);
				$value['category_id'] = $cat->category_name;
			}
			if ($value->category->subcategory) {
				$subcat = SubCategory::find($value->sub_category_id);
				$value['sub_category_id'] = $subcat->sub_category_name;
			}
			if ($value->location) {
				$value['location_id'] = $value->location->location;
			}
			$value['package'] = "Basic";
			$value['dealer'] = "Admin";
			if ($value->status == "0") {
				$value['status'] = "Inactive";
			} else {
				$value['status'] = "Active";
			}
		}

		return DataTables::of($records)
			->addColumn('date_time', function ($records) {
				$dt = new \DateTime($records->created_at);
				$tz = new \DateTimeZone('Asia/Kolkata');
				$dt->setTimezone($tz);
				$dateTime = $dt->format('d.m.Y h:i A');
				return $dateTime;
			})
			->addColumn('listing_id', function ($records) {
				$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $records->id . ')" name="edit">' . $records->listing_id . '</a>';
				return $listing_id;
			})
			->addColumn('owner_type', function ($records) {
				$user = User::find($records->user_id);
				return $user ? ucfirst($user->role) : 'N/A';
			})
			->addColumn('added_by', function ($records) {
				$user = User::find($records->user_id);
				return $user ? $user->firstname . ' ' . $user->lastname : 'N/A';
			})
			->addColumn('total_enquiry', function ($records) {
				$count = AgentEnquiry::where('property_id', $records->id)->count();
				return $count;
			})
			->addColumn('price', function ($records) {
				return '₹' . $records->price;
			})
			->addColumn('action', function ($records) {
				if ($records->status) {
					$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="approveProperty(' . $records->id . ')" title="Approved Property"><i class="fa fa-check-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $records->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="properties/' . base64_encode($records->id) . '/edit"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $records->id . ')"><i class="fas fa-trash" ></i></a></li></ul>';
					return $button;

				} else {
					$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="approveProperty(' . $records->id . ')"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $records->id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="properties/' . base64_encode($records->id) . '/edit"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $records->id . ')"><i class="fas fa-trash" ></i></a></li></ul>';
					return $button;
				}
			})
			->rawColumns(['action', 'listing_id'])
			->make(true);
	}

	public function changeStatus(Request $request)
	{
		$picked = Properties::find($request->id);
		$status = $picked->status == '1' ? '0' : '1';
		$picked->update(
			[
				'status' => $status
			]
		);
		return 'Status Changed Successfully.';
	}

	public function approveProperty(Request $request)
	{
		$picked = Properties::find($request->id);
		if ($request->has('publish')) {
			$publish_status = $picked->publish_status == 'Publish' ? 'Unpublish' : 'Publish';
			$publish_date = \Carbon\Carbon::now()->toDateTimeString();
		} else {
			$publish_status = $picked->publish_status;
			$publish_date = $picked->published_date;
		}
		$status = $request->status ? $request->status : $picked->approval;
		if ($status == 'Pending') {
			$publish_status = 'Unpublish';
		} else {
			$publish_status = $publish_status;
		}
		$picked->update(
			[
				'approval' => $status,
				'publish_status' => $publish_status,
				'published_date' => $publish_date,
				'reason' => $request->reason
			]
		);
		return redirect()->back()->with('success', 'Property Status Updated Successfully.');
	}

	public function publishedProperty(Request $request)
	{
		$picked = Properties::find($request->id);
		$status = $picked->publish_status == 'Unpublish' ? 'Publish' : 'Unpublish';
		$publish_date = \Carbon\Carbon::now()->toDateTimeString();
		if ($status == 'Publish') {
			$picked->update(
				[
					'approval' => 'Approved',
					'publish_status' => $status,
					'published_date' => $publish_date
				]
			);
			$msg = 'Property Published Successfully.';
		} else {
			$picked->update(
				[
					'approval' => 'Approved',
					'publish_status' => $status,
				]
			);
			$msg = 'Property Unpublished Successfully.';
		}
		return $msg;
	}

	public function propertyDetail($id)
	{
		$data = Properties::find($id);
		$amenities = Amenity::whereIn('id', explode(',', $data->amenities))->get();
		return view('admin.properties.view', compact('data', 'amenities'));
	}

	public function propertyDataFilter(Request $request)
	{
		$properties = Properties::with([
			'PropertyTypes',
			'PropertyGallery',
			'Category',
			'Category.SubCategory',
			'Location',
			'getUser',
			'getCity',
			'getState'
		])->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'));
		if ($request->has('categories')) {
			if ($request->short_filter) {
				if ($request->short_filter == 'price-old') {
					$properties = $properties->whereIn('category_id', $request->categories)->orderBy('price', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'price-high') {
					$properties = $properties->whereIn('category_id', $request->categories)->orderBy('price', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'old') {
					$properties = $properties->whereIn('category_id', $request->categories)->orderBy('created_at', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'new') {
					$properties = $properties->whereIn('category_id', $request->categories)->orderBy('created_at', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				}
			} else {
				$properties = $properties->whereIn('category_id', $request->categories)->orderBy('created_at', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
			}
			return $properties;
		}
		if ($request->has('locations')) {
			$property_ids = [];
			$locations = $request->locations;
			$get_properties = Properties::where('approval', 'Approved')->get();
			foreach ($get_properties as $p) {
				for ($i = 0; $i < count($locations); $i++) {
					if (in_array($locations[$i], explode(',', $p->location_id))) {
						array_push($property_ids, $p->id);
					}
				}
			}
			if ($request->short_filter) {
				if ($request->short_filter == 'price-old') {
					$properties = $properties->whereIn('id', $property_ids)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('price', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'price-high') {
					$properties = $properties->whereIn('id', $property_ids)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('price', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'old') {
					$properties = $properties->whereIn('id', $property_ids)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'new') {
					$properties = $properties->whereIn('id', $property_ids)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				}
			} else {
				$properties = $properties->whereIn('id', $property_ids)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
			}
			return $properties;
		}
		if ($request->has('types')) {
			if ($request->short_filter) {
				if ($request->short_filter == 'price-old') {
					$properties = $properties->whereIn('type_id', $request->types)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('price', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'price-high') {
					$properties = $properties->whereIn('type_id', $request->types)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('price', 'DESC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'old') {
					$properties = $properties->whereIn('type_id', $request->types)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'ASC')->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'new') {
					$properties = $properties->whereIn('type_id', $request->types)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'DESC')->where('publish_status', 'Publish')->where('approval', 'Approved')->paginate(10);
				}
			} else {
				$properties = $properties->whereIn('type_id', $request->types)->select('*', \DB::raw('DATE_FORMAT(created_at, "%d %M, %Y") as formatted_date'))->orderBy('created_at', 'DESC')->where('publish_status', 'Publish')->where('approval', 'Approved')->paginate(10);
			}
			return $properties;
		}
		if (!$request->has('categories') && !$request->has('locations') && !$request->has('types')) {
			$ids = [];
			$location = $request->p;
			$type = $request->t;
			$min_price = $request->min;
			$max_price = $request->max;
			$states = State::where('name', 'LIKE', '%' . $location . '%')->get();
			$cities = City::where('name', 'LIKE', '%' . $location . '%')->get();
			$locations = Locations::where('location', 'LIKE', '%' . $location . '%')->get();
			if (count($states) > 0 && count($cities) == 0 && count($locations) == 0) {
				foreach ($states as $state) {
					array_push($ids, $state->id);
				}
				$properties = $properties->whereIn('state_id', $ids);
			} else if (count($states) == 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$properties = $properties->whereIn('city_id', $ids);

			} else if (count($states) > 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$properties = $properties->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) > 0 && count($locations) > 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$properties = $properties->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) == 0 && count($locations) > 0) {
				$property_ids = [];
				$get_properties = Properties::where('approval', 'Approved')->where('publish_status', 'Publish')->get();
				foreach ($get_properties as $p) {
					foreach ($locations as $location) {
						if (in_array($location->id, explode(',', $p->location_id))) {
							array_push($property_ids, $p->id);
						}
					}
				}
				$properties = $properties->whereIn('id', $property_ids);
			} else {
				$properties = $properties->whereIn('state_id', []);
			}
			if ($request->short_filter) {
				if ($request->short_filter == 'price-old') {
					$properties = $properties->where('type_id', $type)->where('price', '>', $min_price)
						->where('price', '<', $max_price)->where('approval', 'Approved')->orderBy('price', 'ASC')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'price-high') {
					$properties = $properties->where('type_id', $type)->where('price', '>', $min_price)
						->where('price', '<', $max_price)->where('approval', 'Approved')->orderBy('price', 'DESC')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'old') {
					$properties = $properties->where('type_id', $type)->where('price', '>', $min_price)
						->where('price', '<', $max_price)->where('approval', 'Approved')->orderBy('created_at', 'ASC')->where('publish_status', 'Publish')->paginate(10);
				} else if ($request->short_filter == 'new') {
					$properties = $properties->where('type_id', $type)->where('price', '>', $min_price)
						->where('price', '<', $max_price)->where('approval', 'Approved')->orderBy('created_at', 'DESC')->where('publish_status', 'Publish')->paginate(10);
				}
			} else {
				$properties = $properties->where('type_id', $type)
					->where('price', '>', $min_price)
					->where('price', '<', $max_price)->where('approval', 'Approved')->where('publish_status', 'Publish')->paginate(10);
			}
			return $properties;
		}
	}

	public function getAllAmenities(Request $request)
	{
		$features = Amenity::whereIn('id', explode(',', $request->ids))->get();
		return $features;
	}

	public function postPropertyFinalView($id)
	{
		$id = base64_decode($id);
		$picked = Properties::find($id);
		$approval = \Auth::user()->role == 'admin' ? 'Approved' : 'Pending';
		$picked->update(
			[
				'listing_type' => 'Paid',
				'approval' => $approval
			]
		);
		if (\Auth::user()->role == 'admin') {
			return redirect('manage/approved/properties')->with('success', 'Property Posted Successfully.');
		} else {
			return redirect('user/properties')->with('success', 'Property Posted Successfully.');
		}
	}

	public function postPropertyFinal(Request $request)
	{
		$picked = Properties::find($request->property_id);
		$approval = \Auth::user()->role == 'admin' ? 'Approved' : 'Pending';
		$picked->update(
			[
				'listing_type' => $request->listing_type,
				'approval' => $approval
			]
		);
		if (\Auth::user()->role == 'admin') {
			return redirect('manage/approved/properties')->with('success', 'Property Posted Successfully.');
		} else {
			if (\Auth::user()->role == 'owner') {
				return redirect('user/properties')->with('success', 'Property Posted Successfully.');
			} else if (\Auth::user()->role == 'builder') {
				return redirect('user/properties')->with('success', 'Property Posted Successfully.');
			} else if (\Auth::user()->role == 'agent') {
				return redirect('user/properties')->with('success', 'Property Posted Successfully.');
			}
		}

	}

	public function getUserInfo($id)
	{
		$user = User::with('getProperties')->find($id);
		return $user;
	}

	public function createPropertyImagesZip($id)
	{
		$images = PropertyGallery::where('property_id', $id)->get();
		$p_files = [];
		$names = [];
		if (count($images) > 0) {
			foreach ($images as $image) {
				$path = public_path('') . '/' . $image->image_path;
				array_push($p_files, $path);
				array_push($names, basename($image->image_path));
				$success = \File::copy($path, base_path('public\zipfiles/' . basename($image->image_path)));
			}
			$zip = new ZipArchive;
			$filename = 'propertyfiles.zip';
			if ($zip->open(public_path($filename), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
				$files = File::files(public_path('zipfiles'));
				foreach ($files as $key => $value) {
					$relativeFileName = basename($value);
					$zip->addFile($value, $relativeFileName);
				}
				$zip->close();
			}
			for ($i = 0; $i < count($names); $i++) {
				$file_path = public_path() . '/zipfiles/' . $names[$i];
				if (File::exists($file_path)) {
					File::delete($file_path);
				}
			}
			return response()->download(public_path($filename));
		} else {
			$msg['status'] = 'error';
			$msg['msg'] = 'Zip not created, because images not found of this property.';
			return $msg;
		}
	}

	public function manageTrendingStatus(Request $request)
	{
		$picked = Properties::find($request->id);
		$status = $picked->trending == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->trending == 'Yes' ? 'De-Activated' : 'Activated';
		$picked->update(
			[
				'trending' => $status
			]
		);
		return $msg;
	}

	public function manageFeaturedStatus(Request $request)
	{
		$picked = Properties::find($request->id);
		$status = $picked->featured == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->featured == 'Yes' ? 'De-Activated' : 'Activated';
		$picked->update(
			[
				'featured' => $status
			]
		);
		return $msg;
	}

	public function manageVerifiedStatus(Request $request)
	{
		$picked = Properties::find($request->id);
		$status = $picked->verified == 'Yes' ? 'No' : 'Yes';
		$msg = $picked->verified == 'Yes' ? 'De-Activated' : 'Activated';
		$picked->update(
			[
				'verified' => $status
			]
		);
		return $msg;
	}

	public function claim_listing(Request $request, $id)
	{
		$check_property = Properties::find($id);
		if (empty($check_property)) {
			return [
				'message' => 'Invalid Listing Data, Please Try After Some Time.',
				'responseCode' => 200,
				'status' => true
			];
		}

		try {
			$type = $this->checkValidDatatype($request->key);
			$otp = rand(100000, 999999);
			$user = null;

			if ($type == 'email') {
				$user = User::where('email', $request->key)->first();
				if (!$user) {
					// ✅ Create guest user with email
					$user = User::create([
						'firstname' => 'Guest',
						'lastname' => 'User',
						'email' => $request->key,
						'password' => bcrypt('123456'), // default password
						'role' => 'user',
						'status' => 1,
						'is_verified' => 1,
					]);

				}
			} else { // mobile
				$user = User::where('mobile_number', $request->key)->first();
				if (!$user) {
					// ✅ Create guest user with mobile
					$user = User::create([
						'firstname' => 'Guest',
						'lastname' => 'User',
						'mobile_number' => $request->key,
						'password' => bcrypt('123456'), // default password
						'role' => 'user',
						'status' => 1,
						'mobile_verified' => 1,
						'is_verified' => 1,
					]);
				}
			}

			// Check if claim already exists
			$picked = ClaimListing::where('property_id', $id)->where('user_id', $user->id)->first();
			if ($picked) {
				if ($picked->otp_verify == 'No') {
					return [
						'message' => 'Your Claim Already Exists For This Property. Please Verify Your Claim, If Already Verified, Ignore This Notification.',
						'responseCode' => 200,
						'status' => true
					];
				} else {
					return [
						'message' => 'Your Claim Already Exists For This Property.',
						'responseCode' => 400,
						'status' => true
					];
				}
			}

			// Send OTP
			if ($type == 'email') {
				$emailOTPtemplate = EmailTemplate::where('id', 7)->first();
				$replaceOTPtemplate = [
					'#NAME' => $user->firstname . ' ' . $user->lastname,
					'#OTP' => $otp
				];
				$this->__sendEmail($user, $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
			} else {
				// Simulate sending SMS (replace with actual SMS API)
				$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo. This OTP is usable only once and is valid for 10 min. PLS DO NOT SHARE THE OTP WITH ANYONE.";
				$response = \App\Helpers\Helper::sendOtp($request->key, $message);
				if (!$response) {
					return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
				}
			}

			// Save claim
			$data = ClaimListing::create([
				'property_id' => $id,
				'user_id' => $user->id,
				'otp' => $otp
			]);
			\Session::put('claim_id', $data->id);

			return [
				'message' => 'Please Verify OTP & Complete Your Claim Process.',
				'responseCode' => 200,
				'status' => true
			];

		} catch (\Exception $e) {
			return [
				'message' => $e->getMessage(),
				'responseCode' => 500,
				'status' => false
			];
		}
	}


	public function verifyClaim(Request $request)
	{
		$claim_id = \Session::get('claim_id');
		try {
			$picked = ClaimListing::where('id', $claim_id)->where('otp', $request->otp)->first();
			if ($picked) {
				$picked->update(
					[
						'otp_verify' => 'Yes',
						'otp' => null
					]
				);
				$data['message'] = 'Your Claim Successfully Verified.';
				$data['responseCode'] = 200;
				$data['status'] = true;
				return $data;
			} else {
				$data['message'] = 'Invalid OTP, Please Enter Correctly.';
				$data['responseCode'] = 400;
				$data['status'] = true;
				return $data;
			}

		} catch (\Exception $e) {
			$data['message'] = $e->getMessage();
			$data['responseCode'] = 500;
			$data['status'] = true;
			return $data;
		}
	}

	public function resendOTPProperty(Request $request)
	{
		try {
			$claim_id = \Session::get('claim_id');
			$picked = ClaimListing::where('id', $claim_id)->first();
			$otp = rand(100000, 999999);
			if ($picked) {
				$user = User::find($picked->user_id);
				if ($user) {
					$message = "Your one time password is  " . $otp . " %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
					$this->sendGlobalSMS($user->mobile_number, $message);
					$picked->update(
						[
							'otp' => $otp
						]
					);
					$data['message'] = 'OTP Successfully Send On Your Registered Mobile Number';
					$data['responseCode'] = 200;
					$data['status'] = true;
					return $data;
				} else {
					$data['message'] = 'OTP Sending Failed, Please Check Your Mobile Number.';
					$data['responseCode'] = 500;
					$data['status'] = true;
					return $data;
				}
			}
		} catch (\Exception $e) {
			$data['message'] = $e->getMessage();
			$data['responseCode'] = 500;
			$data['status'] = true;
			return $data;
		}
	}

	public function manageClaims()
	{
		return view('admin.manage_claim');
	}

	public function manageClaimsDatatable(Request $request)
	{
		if ($request->ajax()) {
			$datas = ClaimListing::whereHas('user')->orderBy('id', 'DESC')->get();
			return Datatables::of($datas)
				->addIndexColumn()
				->addColumn('property_id', function ($row) {
					$picked = Properties::find($row->property_id);
					if ($picked) {
						$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $picked->id . ')" name="View Property">' . $picked->listing_id . '</a>';
						return $listing_id;

					} else {
						return 'N/A';
					}
				})
				->addColumn('posted_by', function ($row) {
					$p = Properties::find($row->property_id);
					$u = User::find($p->user_id ?? 0);
					if ($u) {
						return $u->role;
					} else {
						return 'N/A';
					}
				})
				->addColumn('claim_by', function ($row) {
					$u = User::find($row->user_id ?? 0);
					if ($u) {
						$name = ucfirst($u->firstname . ' ' . $u->lastname);
						$mobile = $u->mobile_number ?? 'N/A';
						$email = $u->email ?? 'N/A';

						return '<span style="color:blue; cursor:pointer;" onclick="showOwnerInfo(' . $u->id . ')">'
							. $name . '</span><br>'
							. '<small>Mobile: ' . $mobile . '</small><br>'
							. '<small>Email: ' . $email . '</small>';
					} else {
						return 'N/A';
					}
				})

				->addColumn('action', function ($row) {
					if ($row->approval_status == 'Assigned') {
						return '';
					} else {
						return '<ul class="action">
                				<li><a style="cursor:pointer;" onclick="assignClaim(' . $row->id . ')" title="Assign Claim"><i class="fa fa-check" aria-hidden="true"></i></a></li>
							</ul>';
					}

				})
				->rawColumns(['action', 'property_id', 'claim_by'])
				->make(true);
		}
	}

	public function assignPropertyClaim(Request $request)
	{
		$picked = ClaimListing::find($request->id);
		$picked_property = Properties::find($picked->property_id);
		if ($picked_property) {
			$picked_property->update(
				[
					'user_id' => $picked->user_id
				]
			);
			$picked->update(
				[
					'approval_status' => 'Assigned'
				]
			);
			return 'Property Assigned Successfully/';
		} else {
			return 'Property Not Found.';
		}
	}

}