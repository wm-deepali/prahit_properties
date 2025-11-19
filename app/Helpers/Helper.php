<?php

namespace App\Helpers;

use App\Category;
use App\Models\FormFeatureSetting;
use App\Models\PropertyStatus;
use App\SubCategory;
use App\SubSubCategory;
use App\Properties;
use App\BusinessListing;
use App\Models\FurnishingStatus;
use Carbon\Carbon;
use App\Form;

class Helper
{
    // -------------------------------
    // Constants
    // -------------------------------
    const POSTED_BY = ['Owner', 'Builder', 'Agent'];

    const BUY_BUDGETS = [
        ['label' => 'Under 50 Lakh', 'query' => 'under-50-lakh'],
        ['label' => '50 Lakh - 1 CR', 'query' => '50-lakh-1-cr'],
        ['label' => '1 CR - 3 CR', 'query' => '1-cr-3-cr'],
        ['label' => '3 CR - 5 CR', 'query' => '3-cr-5-cr'],
        ['label' => '5 CR & Above', 'query' => 'above-5-cr'],
    ];

    const RENT_BUDGETS = [
        ['label' => 'Under 10K', 'query' => 'under-10k'],
        ['label' => '10,000 - 25,000', 'query' => '10k-25k'],
        ['label' => '25,001 - 35,000', 'query' => '25k1-35k'],
        ['label' => '35,001 - 50,000', 'query' => '35k1-50k'],
        ['label' => '50,000 & Above', 'query' => 'above-50k'],
    ];

    const PLOT_LAND_BUDGETS = [
        ['label' => 'Under 25 Lakh', 'query' => 'under-25-lakh'],
        ['label' => '25 Lakh - 50 Lakh', 'query' => '25-50-lakh'],
        ['label' => '50 Lakh - 1 CR', 'query' => '50-lakh-1-cr'],
        ['label' => '1 CR - 2 CR', 'query' => '1-cr-2-cr'],
        ['label' => '2 CR & Above', 'query' => 'above-2-cr'],
    ];

    const PG_BUDGETS = [
        ['label' => 'Below ₹5,000', 'query' => '0-5000'],
        ['label' => '₹5,000 - ₹10,000', 'query' => '5000-10000'],
        ['label' => '₹10,000+', 'query' => '10000+'],
    ];

    const PG_AVAILABLE_FOR = ['Boys', 'Girls', 'Family', 'Anyone'];
    const PG_POSTED_BY = ['Owner', 'Broker', 'Builder'];

    /**
     * Get sub-subcategories under 'ALL RESIDENTIAL' and 'ALL COMMERCIAL' for the given category name.
     */
    public static function getSubSubcategoriesByCategoryName(string $categoryName): array
    {
        $residentialSubs = collect();
        $commercialSubs = collect();

        $category = Category::where('category_name', $categoryName)->first();

        if ($category) {
            $residentialSubcat = Subcategory::where('sub_category_name', 'RESIDENTIAL')
                ->where('category_id', $category->id)
                ->first();

            $commercialSubcat = Subcategory::where('sub_category_name', 'COMMERCIAL')
                ->where('category_id', $category->id)
                ->first();

            $residentialSubs = $residentialSubcat
                ? SubSubcategory::where('sub_category_id', $residentialSubcat->id)->get()
                : collect();

            $commercialSubs = $commercialSubcat
                ? SubSubcategory::where('sub_category_id', $commercialSubcat->id)->get()
                : collect();
        }

        return [
            'residential' => $residentialSubs,
            'commercial' => $commercialSubs,
        ];
    }

    /**
     * Get properties by category and subcategory, fallback to random if none found.
     */
    public static function getPropertiesByCategoryAndSubcategory(string $categoryName, string $subCategoryId, $city_id = null, $limit = 6): \Illuminate\Support\Collection
    {
        $category = Category::where('category_name', $categoryName)->first();
        if (!$category) {
            return collect();
        }

        $subcategory = Subcategory::where('id', $subCategoryId)
            ->where('category_id', $category->id)
            ->first();

        if (!$subcategory) {
            return collect();
        }

        $query = Properties::where('approval', 'Approved')
            ->where('publish_status', 'Publish')
            ->where('sub_category_id', $subcategory->id)
            ->where('status', '1');

        if (!empty($city_id)) {
            $query->where('city_id', $city_id);
        }

        $properties = $query->orderBy('id', 'DESC')->get();

        // Fallback: if no data found for city, get random from anywhere
        if ($properties->isEmpty()) {
            $properties = Properties::where('approval', 'Approved')
                ->where('publish_status', 'Publish')
                ->where('sub_category_id', $subcategory->id)
                ->where('status', '1')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        return $properties;
    }

    /**
     * Get properties by category, fallback to random if none found.
     */
    public static function getPropertiesByCategory(string $categoryName, $city_id = null, $limit = 6): \Illuminate\Support\Collection
    {
        $category = Category::where('category_name', $categoryName)->first();
        if (!$category) {
            return collect();
        }

        $query = Properties::where('approval', 'Approved')
            ->where('publish_status', 'Publish')
            ->where('category_id', $category->id)
            ->where('status', '1');

        if (!empty($city_id)) {
            $query->where('city_id', $city_id);
        }

        $properties = $query->orderBy('id', 'DESC')->get();

        // Fallback: if no data found for city, get random from anywhere
        if ($properties->isEmpty()) {
            $properties = Properties::where('approval', 'Approved')
                ->where('publish_status', 'Publish')
                ->where('category_id', $category->id)
                ->where('status', '1')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        return $properties;
    }

    /**
     * Get all active business listings.
     */

    public static function getAllBusinessListings(): \Illuminate\Support\Collection
    {
        // Get all active business listings and eager load user + subscription + package
        $listings = BusinessListing::where('Status', 'Active')
            ->with(['user.activeSubscription.package']) // eager load user subscription and package
            ->get();

        // Map badge info
        return $listings->map(function ($listing) {
            $subscription = $listing->user->activeSubscription ?? null;
            $isValid = false;

            if ($subscription) {
                // Consider subscription valid if it's active and end_date is in the future
                $isValid = $subscription->is_active && Carbon::parse($subscription->end_date)->gte(Carbon::now());
            }
            return $listing;
        });
    }


    /**
     * Get trending projects by city.
     * Falls back to random trending projects if city has none.
     */
    public static function getTrendingProjectsByCity($city_id = null, $limit = 6): \Illuminate\Support\Collection
    {
        $query = Properties::where('publish_status', 'Publish')
            ->where('approval', '!=', 'Rejected')
            ->where('trending', 'Yes')
            ->where('status', '1');

        if (!empty($city_id)) {
            $query->where('city_id', $city_id);
        }

        $projects = $query->orderBy('id', 'DESC')->get();

        if ($projects->isEmpty()) {
            $projects = Properties::where('publish_status', 'Publish')
                ->where('approval', '!=', 'Rejected')
                ->where('trending', 'Yes')
                ->where('status', '1')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        return $projects;
    }

    /**
     * Get featured projects by city.
     * Falls back to random featured projects if city has none.
     */
    public static function getFeaturedProjectsByCity($city_id = null, $limit = 6): \Illuminate\Support\Collection
    {
        $query = Properties::where('publish_status', 'Publish')
            ->where('approval', '!=', 'Rejected')
            ->where('featured', 'Yes')
            ->where('status', '1');

        if (!empty($city_id)) {
            $query->where('city_id', $city_id);
        }

        $featured = $query->orderBy('id', 'DESC')->get();

        if ($featured->isEmpty()) {
            $featured = Properties::where('publish_status', 'Publish')
                ->where('approval', '!=', 'Rejected')
                ->where('featured', 'Yes')
                ->where('status', '1')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        return $featured;
    }


    /**
     * Get subcategories and sub-subcategories for a category
     * Optional filter array to search sub-subcategory names
     */
    private static function getSubCategoriesAndTypes(int $categoryId, array $filter = null): array
    {
        $subCategories = Subcategory::where('category_id', $categoryId)
            ->get(['id', 'sub_category_name']);

        $query = SubSubcategory::whereIn('sub_category_id', $subCategories->pluck('id'));

        if ($filter) {
            $query->where(function ($q) use ($filter) {
                foreach ($filter as $term) {
                    $q->orWhere('sub_sub_category_name', 'like', "%$term%");
                }
            });
        }

        $subSubCategories = $query->get(['id', 'sub_sub_category_name', 'sub_category_id']);

        return [$subCategories, $subSubCategories];
    }

    // -------------------------------
    // Filter Data Methods
    // -------------------------------

    public static function getBuyFilterData(): array
    {
        $sellCategoryId = Category::where('category_name', 'Sell')->value('id');
        [$categories, $types] = self::getSubCategoriesAndTypes($sellCategoryId);

        return [
            'categories' => $categories,
            'types' => $types,
            'budgets' => self::BUY_BUDGETS,
            'possession' => PropertyStatus::all(['id', 'name']),
            'posted_by' => self::POSTED_BY,
        ];
    }

    public static function getRentalFilterData(): array
    {
        $rentCategoryId = Category::where('category_name', 'Rent')->value('id');
        [$categories, $types] = self::getSubCategoriesAndTypes($rentCategoryId);

        return [
            'categories' => $categories,
            'types' => $types,
            'budgets' => self::RENT_BUDGETS,
            'furnishing' => FurnishingStatus::all(['id', 'name']),
            'posted_by' => self::POSTED_BY,
        ];
    }

    public static function getPgHostelFilterData(): array
    {
        return [
            'budgets' => self::PG_BUDGETS,
            'available_for' => self::PG_AVAILABLE_FOR,
            'posted_by' => self::PG_POSTED_BY,
        ];
    }

    public static function getExclusiveLaunchFilterData(): array
    {
        $exclusiveCategoryId = Category::where('category_name', 'Exclusive Launch')->value('id');
        [$categories, $types] = self::getSubCategoriesAndTypes($exclusiveCategoryId);

        return [
            'categories' => $categories,
            'types' => $types,
            'budgets' => self::BUY_BUDGETS,
            'status' => PropertyStatus::all(['id', 'name']),
            'posted_by' => self::POSTED_BY,
        ];
    }

    public static function getPlotLandFilterData(): array
    {
        $filter = ['Plot', 'Land'];
        $types = SubSubcategory::where(function ($q) use ($filter) {
            foreach ($filter as $term) {
                $q->orWhere('sub_sub_category_name', 'like', "%$term%");
            }
        })->get(['id', 'sub_sub_category_name']);

        return [
            'types' => $types,
            'budgets' => self::PLOT_LAND_BUDGETS,
            'posted_by' => self::POSTED_BY,
        ];
    }

    /**
     * Format price in Indian format (Lakh, CR)
     */
    public static function formatIndianPrice($price): string
    {
        if (!$price || $price <= 0) {
            return '0';
        }

        $price = (float) $price;

        // Convert to crores if >= 1 crore
        if ($price >= 10000000) {
            $crores = $price / 10000000;
            return number_format($crores, 1) . ' CR';
        }

        // Convert to lakhs if >= 1 lakh
        if ($price >= 100000) {
            $lakhs = $price / 100000;
            return number_format($lakhs, 1) . ' Lakh';
        }

        // For amounts less than 1 lakh, show in thousands
        if ($price >= 1000) {
            $thousands = $price / 1000;
            return number_format($thousands, 0) . 'K';
        }

        // For amounts less than 1000, show as is
        return number_format($price, 0);
    }

    /**
     * Get properties suitable for businesses
     */
    public static function getBusinessProperties($city_id = null, $businessType = null, $limit = 6): \Illuminate\Support\Collection
    {
        $query = Properties::where('approval', 'Approved')
            ->where('publish_status', 'Publish')
            ->where('status', '1');

        if (!empty($city_id)) {
            $query->where('city_id', $city_id);
        }

        $query->where(function ($q) use ($businessType) {

            // If a business type (tab) is provided, filter by that only
            if (!empty($businessType)) {
                $q->Where(function ($subQ) use ($businessType) {
                    $subQ->where('additional_info', 'LIKE', '%"Ideal For Businesses"%')
                        ->where('additional_info', 'LIKE', "%\"$businessType\"%");
                });
            }
        });

        $properties = $query->orderBy('id', 'DESC')->limit($limit)->get();

        // dd($businessType, $properties->toArray());
        // Fallback if no results found
        if ($properties->isEmpty()) {
            $query = Properties::where('approval', 'Approved')
                ->where('publish_status', 'Publish')
                ->where('status', '1');

            $query->where(function ($q) use ($businessType) {

                if (!empty($businessType)) {
                    $q->orWhere(function ($subQ) use ($businessType) {
                        $subQ->where('additional_info', 'LIKE', '%"Ideal For Businesses"%')
                            ->where('additional_info', 'LIKE', "%\"$businessType\"%");
                    });
                }
            });

            $properties = $query->orderBy('id', 'DESC')->limit($limit)->get();
        }

        return $properties;
    }

    public static function sendOtp($mobile, $message)
    {
        // Fetch settings
        $authKey = env('SMS_AUTH_KEY', '133780APe3PZcx5850ea44');
        $sender = env('SMS_SENDER_ID', 'WMINGO');
        $peId = env('SMS_PE_ID', '1301160576431389865');

        $templateId = env('SMS_DLT_ID', '1307161465983326774');

        $request_parameter = [
            'authkey' => $authKey,
            'mobiles' => $mobile,
            'sender' => $sender,
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }

        if ($templateId) {
            $url .= 'DLT_TE_ID=' . $templateId . '&';
        }
        if ($peId) {
            $url .= 'PE_ID=' . $peId . '&';
        }

        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get Form ID based on property's category → subcategory → sub-subcategory
     */
    public static function getFormIdByProperty($property)
    {
        // 1️⃣ Match Sub-Sub-Category
        if ($property->sub_sub_category_id) {
            $form = Form::whereRaw("FIND_IN_SET(?, sub_sub_category_id)", [$property->sub_sub_category_id])->first();
            if ($form)
                return $form->id;
        }

        // 2️⃣ Match Sub-Category
        if ($property->sub_category_id) {
            $form = Form::whereRaw("FIND_IN_SET(?, sub_category_id)", [$property->sub_category_id])->first();
            if ($form)
                return $form->id;
        }

        // 3️⃣ Match Category
        if ($property->category_id) {
            $form = Form::whereRaw("FIND_IN_SET(?, category_id)", [$property->category_id])->first();
            if ($form)
                return $form->id;
        }

        return null;
    }


    /**
     * Get only filtered + sorted features with values
     */
    public static function getPropertyFeatureData($property)
    {
        $formId = self::getFormIdByProperty($property);

        if (!$formId) {
            return [];
        }

        // Load selected features
        $settings = FormFeatureSetting::where('form_id', $formId)
            ->where('show_in_front', 1)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('field_key');

        $info = json_decode($property->additional_info ?? '[]', true);

        // -----------------------------------------
        // 1️⃣ FALLBACK WHEN ADMIN HAS NOT SET ANY FEATURES
        // -----------------------------------------
        if ($settings->isEmpty()) {

            $iconMap = [
                'Bedroom' => 'fas fa-bed',
                'Balconies' => 'fas fa-sun',
                'Bathrooms' => 'fas fa-bath',
                'Furnished Status' => 'fas fa-couch',
                'Total Floors' => 'fas fa-layer-group',
                'Floors allowed for construction' => 'fas fa-layer-group',
                'No of open sides' => 'fas fa-door-open',
                'Carpet Area' => 'fas fa-expand',
                'Super Area' => 'fas fa-expand-arrows-alt',
                'Plot Area' => 'fas fa-border-all',
                'Plot Length' => 'fas fa-ruler-horizontal',
                'Plot Breadth' => 'fas fa-ruler-combined',
                'Is this a corner plot?' => 'fas fa-map',
                'Width of road facing the plot' => 'fas fa-road',
            ];

            $fallback = [];
            $count = 0;

            foreach ($info as $field) {

                if ($count >= 6)
                    break;

                if (!isset($field['type']) || !isset($field['label']))
                    continue;

                // clean label
                $label = strip_tags($field['label']);
                $label = preg_replace('/\s*\([^)]*\)/', '', $label);
                $label = trim($label);

                // skip headers / paragraphs
                if (in_array($field['type'], ['header', 'paragraph']))
                    continue;

                $value = $field['userData'][0] ?? '';
                if ($value === '')
                    continue;

                // convert radio-group values
                if ($field['type'] === 'radio-group' && isset($field['values'])) {
                    foreach ($field['values'] as $v) {
                        if ($v['value'] == $value) {
                            $value = $v['label'];
                            break;
                        }
                    }
                }

                // match icon
                $icon = $iconMap[$label] ?? 'fas fa-info-circle';

                $fallback[] = [
                    'label' => $label,
                    'value' => $value,
                    'icon' => $icon
                ];

                $count++;
            }

            return $fallback;
        }

        // -----------------------------------------
        // 2️⃣ ADMIN-SELECTED FEATURES
        // -----------------------------------------
        $final = [];

        foreach ($info as $field) {

            $key = $field['name'] ?? $field['label'] ?? null;
            if (!$key)
                continue;

            if (!isset($settings[$key]))
                continue;

            $setting = $settings[$key];

            $label = preg_replace('/\s*\([^)]*\)/', '', strip_tags($setting->label_to_show));
            $value = $field['userData'][0] ?? '';

            if ($value === '')
                continue;

            if ($field['type'] === 'radio-group' && isset($field['values'])) {
                foreach ($field['values'] as $v) {
                    if ($v['value'] == $value) {
                        $value = $v['label'];
                        break;
                    }
                }
            }

            $final[] = [
                'label' => $label,
                'value' => $value,
                'icon' => $setting->icon_class ?? 'fas fa-info-circle'
            ];
        }

        return $final;
    }

}