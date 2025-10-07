<?php

namespace App\Http\Controllers\Admin;

use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Events\PropertyFileDownloadEvent;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\PropertiesFields;
use App\FormTypesFields;
use App\PropertyGallery;
use App\PropertyTypes;
use App\ClaimListing;
use App\SubLocations;
use App\AgentEnquiry;
use App\SubCategory;
use App\Properties;
use App\Locations;
use App\FormTypes;
use App\Category;
use App\Visitor;
use ZipArchive;
use DataTables;
use App\Amenity;
use App\State;
use App\City;
use App\User;
use App\Otp;
use File;
use App\Models\PriceLabel;
use App\Models\PropertyStatus;
use App\Models\FurnishingStatus;
use App\Models\RegistrationStatus;

class PropertiesController extends AppController
{
	use GlobalTrait;

	public function pendinPropertyList()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		$property_types = PropertyTypes::all();
		return view('admin.properties.index', compact('location', 'sublocation', 'property_types'));
	}

	public function manageApprovedProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		$property_types = PropertyTypes::all();
		return view('admin.properties.manage_properties', compact('location', 'sublocation', 'property_types'));
	}

	public function managePublishedProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		$property_types = PropertyTypes::all();
		return view('admin.properties.published_property', compact('location', 'sublocation', 'property_types'));
	}

	public function manageCancelledProperties()
	{
		$location = Locations::all();
		$sublocation = SubLocations::all();
		$property_types = PropertyTypes::all();
		return view('admin.properties.cancelled_properties', compact('location', 'sublocation', 'property_types'));
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
					return $category ? $category->category_name : 'N/A';
				})
				->addColumn('sub_category', function ($datas) {
					$subcategory = SubCategory::find($datas->sub_category_id);
					return $subcategory ? $subcategory->sub_category_name : 'N/A';
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
				->rawColumns(['action', 'listing_id', 'owner_type'])
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
					return $category ? $category->category_name : 'N/A';
				})
				->addColumn('sub_category', function ($datas) {
					$subcategory = SubCategory::find($datas->sub_category_id);
					return $subcategory ? $subcategory->sub_category_name : 'N/A';
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
				->rawColumns(['action', 'listing_id', 'owner_type'])
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
					return $category ? $category->category_name : 'N/A';
				})
				->addColumn('sub_category', function ($datas) {
					$subcategory = SubCategory::find($datas->sub_category_id);
					return $subcategory ? $subcategory->sub_category_name : 'N/A';
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
				->addColumn('action', function ($datas) {
					if ($datas->status) {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Block Property"><i class="fa fa-check-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;

					} else {
						$button = '<ul class="action"><li><a style="cursor: pointer;" onclick="changeStatusProperty(' . $datas->id . ')" title="Change Property Status"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li><li><a style="cursor: pointer;" onclick="changeStatus(' . $datas->id . ')" title="Active Property"><i class="fa fa-times-circle" aria-hidden="true"></i></a></li><li><a href="' . url('master/property/detail') . '/' . $datas->id . '" title="View Property Details"><i class="fa fa-eye" aria-hidden="true"></i></a></li><li><a name="edit"  href="' . url('master/properties/' . base64_encode($datas->id) . '/edit') . '" title="Edit Property"><i class="fas fa-pencil-alt" style="cursor:pointer;"></i></a></li><li><a style="cursor:pointer;" title="Download Property Images" href="' . url('create/property-images/zip') . '/' . $datas->id . '"><i class="fa fa-download" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" title="Share Property" publish-status="' . $datas->publish_status . '" id="publish_status' . $datas->id . '" onclick="shareDocuments(' . $datas->id . ')"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li><li><a style="cursor:pointer;" onclick="delete_record(' . $datas->id . ')" title="Delete Property"><i class="fas fa-trash" ></i></a></li></ul>';
						return $button;
					}
				})
				->rawColumns(['action', 'listing_id', 'owner_type', 'trending', 'featured'])
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
					return $category ? $category->category_name : 'N/A';
				})
				->addColumn('sub_category', function ($datas) {
					$subcategory = SubCategory::find($datas->sub_category_id);
					return $subcategory ? $subcategory->sub_category_name : 'N/A';
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
				->rawColumns(['action', 'listing_id', 'owner_type'])
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
					return $category ? $category->category_name : 'N/A';
				})
				->addColumn('sub_category', function ($datas) {
					$subcategory = SubCategory::find($datas->sub_category_id);
					return $subcategory ? $subcategory->sub_category_name : 'N/A';
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
				->rawColumns(['action', 'listing_id', 'owner_type'])
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

		// Get all active Price Labels and Statuses
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

		return view('admin.properties.create', compact(
			'category',
			'locations',
			'form_type',
			'states',
			'amenities',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses',
		));
	}


	public function store(Request $request)
	{
		// dd($request->all());
		$rules = [
			'title' => 'required|unique:properties,title',
			'price' => "required|numeric",
			// "email" => "sometimes|required|unique:users,email",
			"mobile_number" => "required",
			"otp" => "required"
		];
		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if ($request->is_visitor) {
				$get_otp = Visitor::where(['mobile_number' => $request->mobile_number, 'otp' => $request->otp])->latest()->first();
				if (isset($get_otp)) {
					$get_otp->is_verified = "1";
					$get_otp->save();
				}
				if ($request->firstname) {
					$request['password'] = Hash::make(12345678);
					$request['auth_token'] = "";
					$create_user = User::create($request->all());
				}
			}

			if ($request->has('feature_image_file')) {
				$feature_image = $this->fileUpload($request, ['uploads/properties/feature_image/' => 'feature_image_file']);
			}

			$request['featured_image'] = isset($feature_image) ? $feature_image[0] : '';

			$request['sub_sub_category_id'] = 3;

			if ($request->has('price_label')) {
				$request['price_label'] = implode(',', $request->price_label);
			}
			// $request['listing_id'] = uniqid(7);
			// user data save into database ----
			$count = Properties::count();
			$final_digits = str_pad($count, 4, '0', STR_PAD_LEFT);
			$unique_id = 'PP-' . $final_digits;
			$request['listing_id'] = $unique_id;
			$request['state_id'] = $request->state;
			$request['city_id'] = $request->city;
			$request['construction_age'] = $request->construction_age;
			$request['location_id'] = implode(',', $request->location_id);
			$request['sub_location_name'] = $request->sub_location_name ?? null;
			$request['amenities'] = $request->has('amenity') ? implode(',', $request->amenity) : null;
			$listing = Properties::create($request->all());
			if ($listing->exists()) {
				$listing_features = json_decode($request->listing_features, true);
				$propertiesFields = '';
				foreach ($listing_features as $key => $value) {
					$propertiesFields = PropertiesFields::create(['property_id' => $listing->id, 'formtype_id' => $request->formtype_id, 'sub_feature_id' => $key, 'feature_value' => $value]);
				}

				if ($request->has('gallery_images_file')) {
					$gallery_images = $this->multipleFileUpload($request, ['uploads/properties/gallery_images/' => 'gallery_images_file']);
					foreach ($gallery_images as $key => $value) {
						PropertyGallery::create(['property_id' => $listing->id, 'image_path' => $value]);
					}
				}

				if ($propertiesFields) {
					$this->JsonResponse(200, 'Listing created successfully');
				}

			} else {
				$this->JsonResponse(400, 'An error occured.');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
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

		// Get all active Price Labels and Statuses
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

		return view('admin.properties.edit', compact(
			'property',
			'category',
			'locations',
			'states',
			'cities',
			'sub_locations',
			'amenities',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses',
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

		// Get all active Price Labels and Statuses
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();


		return view('admin.properties.preview', compact(
			'property',
			'category',
			'locations',
			'states',
			'cities',
			'sub_locations',
			'amenities',
			'id',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses'
		));
	}

	public function show($id)
	{
		$property = Properties::select('*', \DB::raw('DATE_FORMAT(published_date, "%d-%b-%Y") as publish_date'))->with('Category', 'SubCategory', 'Location', 'PropertyGallery', 'PropertyTypes')->findOrFail($id);
		$this->JsonResponse(200, 'Property found successfully', ['Property' => $property]);
	}


	public function update(Request $request)
	{
		try {
			// ✅ Validation
			$request->validate([
				'id' => 'required|exists:properties,id',
				'title' => 'required|max:200',
				'type_id' => 'nullable',
				'price' => 'required|numeric',
				'price_label.*' => 'nullable',
				'category_id' => 'required',
				'sub_category_id' => 'required',
				'construction_age' => 'nullable',
				'description' => 'required',
				'address' => 'required',
				'location_id' => 'required',
				'sub_location_name' => 'nullable|string|max:255',
				"gallery_images_file.*" => 'nullable|mimes:jpg,png,jpeg',
				"feature_image_file" => 'nullable|mimes:jpg,png,jpeg'
			]);

			$properties = Properties::findOrFail($request->id);

			// ✅ Multi-value fields
			$price_label = $request->has('price_label') ? implode(',', (array) $request->price_label) : null;
			$property_use_for = $request->has('property_use_for') ? implode(',', (array) $request->property_use_for) : null;
			$amenties_features = $request->has('amenties_features') ? implode(',', (array) $request->amenties_features) : null;
			$amenities = $request->has('amenity') ? implode(',', (array) $request->amenity) : null;

			// ✅ Handle feature image upload
			$featured_image = $properties->featured_image;
			if ($request->hasFile('feature_image_file')) {
				$feature_image = $this->fileUpload($request, [
					'uploads/properties/feature_image/' => 'feature_image_file'
				]);
				$featured_image = isset($feature_image) ? $feature_image[0] : $featured_image;
			}

			// ✅ Update property
			$properties->update([
				'title' => $request->title,
				'type_id' => $request->type_id,
				'price' => $request->price,
				'price_label' => $price_label,
				'price_label_second' => $request->price_label_second, // new
				'property_use_for' => $property_use_for,
				'amenties_features' => $amenties_features,
				'property_status' => $request->has('property_status') ? implode(',', (array) $request->property_status) : null,
				'property_status_second' => $request->property_status_second, // new
				'registration_status' => $request->has('registration_status') ? implode(',', (array) $request->registration_status) : null,
				'registration_status_second' => $request->registration_status_second, // new
				'furnishing_status' => $request->has('furnishing_status') ? implode(',', (array) $request->furnishing_status) : null,
				'furnishing_status_second' => $request->furnishing_status_second, // new
				'description' => $request->description,
				'category_id' => $request->category_id,
				'sub_category_id' => $request->sub_category_id,
				'address' => $request->address,
				'state_id' => $request->state,
				'city_id' => $request->city,
				'location_id' => implode(',', (array) $request->location_id),
				'sub_location_name' => $request->sub_location_name ?? null,
				'amenities' => $amenities,
				'additional_info' => $request->form_json,
				'construction_age' => $request->construction_age,
				'featured_image' => $featured_image,
			]);

			// ✅ Handle gallery images upload
			if ($request->has('gallery_images_file')) {
				$gallery_images = $this->multipleFileUpload($request, [
					'uploads/properties/gallery_images/' => 'gallery_images_file'
				]);
				foreach ($gallery_images as $value) {
					PropertyGallery::create([
						'property_id' => $properties->id,
						'image_path' => $value
					]);
				}
			}

			// ✅ Success response
			return $this->JsonResponse(200, 'Property updated successfully', [
				'listing' => $properties
			]);
		} catch (\Exception $e) {
			return $this->JsonResponse(500, $e->getMessage());
		}
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
		return view('property_final', compact('id'));
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
				return redirect('builder/properties')->with('success', 'Property Posted Successfully.');
			} else if (\Auth::user()->role == 'agent') {
				return redirect('agent/properties')->with('success', 'Property Posted Successfully.');
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

	public function claim_listing(Request $request, $id)
	{
		$check_property = Properties::find($id);
		if (empty($check_property)) {
			$data['message'] = 'Invalid Listing Data, Please After Some Time.';
			$data['responseCode'] = 200;
			$data['status'] = true;
			return $data;
		}
		try {
			$type = $this->checkValidDatatype($request->key);
			$otp = rand(100000, 999999);
			if ($type == 'email') {
				$user = User::where('email', $request->key)->first();
				if (!$user) {
					$data['message'] = 'No account exists with this email id.';
					$data['responseCode'] = 400;
					$data['status'] = true;
					return $data;
				}
				$picked = ClaimListing::where('property_id', $id)->where('user_id', $user->id)->first();
				if ($picked) {
					if ($picked->otp_verify == 'No') {
						$data['message'] = 'Your Claim Already Exist For This Property. Please Verify Your Claim, If You Already Verified, Ignore This Notification.';
						$data['responseCode'] = 200;
						$data['status'] = true;
						return $data;
					} else {
						$data['message'] = 'Your Claim Already Exist For This Property.';
						$data['responseCode'] = 400;
						$data['status'] = true;
						return $data;
					}
				}
				$emailOTPtemplate = EmailTemplate::where('id', 7)->first();
				$replaceOTPtemplate = array(
					'#NAME' => $user->firstname . ' ' . $user->lastname,
					'#OTP' => $otp
				);
				$this->__sendEmail($user, $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
			} else {
				$user = User::where('mobile_number', $request->key)->first();
				if (!$user) {
					$data['message'] = 'No account exists with this email id.';
					$data['responseCode'] = 400;
					$data['status'] = true;
					return $data;
				}
				$picked = ClaimListing::where('property_id', $id)->where('user_id', $user->id)->first();
				if ($picked) {
					if ($picked->otp_verify == 'No') {
						$data['message'] = 'Your Claim Already Exist For This Property. Please Verify Your Claim, If You Already Verified, Ignore This Notification.';
						$data['responseCode'] = 200;
						$data['status'] = true;
						return $data;
					} else {
						$data['message'] = 'Your Claim Already Exist For This Property.';
						$data['responseCode'] = 400;
						$data['status'] = true;
						return $data;
					}
				}
				$message = "Your one time password is  " . $otp . " %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
				$this->sendGlobalSMS($user->mobile_number, $message);
			}
			if ($user) {
				$data = ClaimListing::create(
					[
						'property_id' => $id,
						'user_id' => $user->id,
						'otp' => $otp
					]
				);
				\Session::put('claim_id', $data->id);
				$data['message'] = 'Please Verify OTP & Complete Your Claim Process.';
				$data['responseCode'] = 200;
				$data['status'] = true;
				return $data;
			} else {
				$data['message'] = 'Something Happned Wrong.';
				$data['responseCode'] = 400;
				$data['status'] = true;
				return $data;
			}

		} catch (\Exception $e) {
			$data['message'] = $e->getMessage();
			$data['responseCode'] = 500;
			$data['status'] = false;
			return $data;
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
			$datas = ClaimListing::orderBy('id', 'DESC')->get();
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
					$u = User::find($p->user_id);
					if ($u) {
						return $u->role;
					} else {
						return 'N/A';
					}
				})
				->addColumn('claim_by', function ($row) {
					$u = User::find($row->user_id);
					if ($u) {
						return '<span style="color:blue;cursor:pointer;" onclick="showOwnerInfo(' . $u->id . ')">' . ucfirst($u->firstname . ' ' . $u->lastname) . '</span>';
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