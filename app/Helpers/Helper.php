<?php

namespace App\Helpers;

use App\Category;
use App\Subcategory;
use App\SubSubcategory;
use App\Properties;
use Illuminate\Support\Collection;

class Helper
{
    /**
     * Get sub-subcategories under 'ALL RESIDENTIAL' and 'ALL COMMERCIAL' for the given category name.
     *
     * @param string $categoryName
     * @return Collection
     */
    public static function getSubSubcategoriesByCategoryName(string $categoryName): array
    {
        $residentialSubs = collect();
        $commercialSubs = collect();

        $category = Category::where('category_name', $categoryName)->first();

        if ($category) {
            $residentialSubcat = Subcategory::where('sub_category_name', 'ALL RESIDENTIAL')
                ->where('category_id', $category->id)
                ->first();

            $commercialSubcat = Subcategory::where('sub_category_name', 'ALL COMMERCIAL')
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


    public static function getPropertiesByCategoryAndSubcategory(string $categoryName, string $subCategoryName): \Illuminate\Support\Collection
    {
        $category = Category::where('category_name', $categoryName)->first();
        if (!$category) {
            return collect();
        }
        
        $subcategory = Subcategory::where('sub_category_name', $subCategoryName)
        ->where('category_id', $category->id)
        ->first();
      
        if (!$subcategory) {
            return collect();
        }

        $properties = Properties::where('approval', 'Approved')
			->where('publish_status', 'Publish')
            ->where('sub_category_id', $subcategory->id)
            ->get();

        return $properties;
    }

}
