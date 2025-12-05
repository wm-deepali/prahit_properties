<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'Api'], function () {

	Route::get('/cities/search', function (Request $request) {
		$term = $request->get('query');
		$cities = App\City::where('name', 'LIKE', "%{$term}%")
			->limit(10)
			->get(['id', 'name']);
		return response()->json($cities);
	});


	// auth 
	Route::post('login', 'AuthController@login');
	Route::post('reset-password', 'AuthController@resetPassword');

	// authenticated
	Route::group(['middleware' => 'api.auth'], function () {
		Route::post('change_password', 'AuthController@change_password');
		Route::post('update_profile', 'AuthController@update_profile');
	});

	/* unauthenticated */

	// Categories
	Route::group(['prefix' => 'category'], function () {
		Route::get('/', 'CategoryController@index');
	});
	Route::get('category_tree', 'CategoryController@category_tree');
	Route::get('fetch_subcategories_by_cat_id/{id}', 'CategoryController@fetch_subcategories_by_cat_id')->name('fetch_subcategories_by_cat_id');
	Route::get('fetch_subsubcategories_by_subcat_id/{id}', 'CategoryController@fetch_subsubcategories_by_subcat_id')->name('fetch_subcategories_by_cat_id');

	// Locations
	Route::get('states', 'LocationController@state');
	Route::get('city/{id}', 'LocationController@city');
	Route::get('location/{id}', 'LocationController@show');
	Route::get('sub_location/{id}', 'LocationController@show_sublocation');
	Route::get('fetch_sublocations/{id}', 'LocationController@fetch_sublocations');
	Route::get('fetch_sublocation/{id}', 'LocationController@fetch_sublocation');
	Route::get('cities_states/{id}', 'LocationController@fetch_cities_states');

	// form type
	Route::get('fetch_form_type', 'FormTypeController@fetch_form_type');


	// owner
	Route::post('owner/', 'OwnersController@store');

	// property
	Route::group(['prefix' => 'property'], function () {
		Route::get('show/{slug}', 'PropertyController@show');
		Route::get('search', 'PropertyController@search_property');
		Route::get('my_properties', 'PropertyController@my_properties');
		Route::get('category/{id}', 'PropertyController@show_by_category');
		Route::post('claim_listing/{id}', 'PropertyController@claim_listing');
		Route::post('agent_enquiry', 'PropertyController@agent_enquiry');
		Route::post('feedback', 'PropertyController@feedback');
		Route::post('create_visitor_otp', 'PropertyController@create_visitor_otp');
	});
	// all resource routes
	Route::resource('location', 'LocationController');
	Route::resource('property', 'PropertyController');
});

