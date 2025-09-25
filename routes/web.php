<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', 'AuthController@login');
Route::post('login', 'AuthController@login');  
Route::post('login_ajax', 'User\UserController@login_ajax')->name('login_ajax');
Route::post('forgot-password', 'AppController@forgot_password')->name('forgot_password');
Route::post('send-otp', 'AppController@visitor_otp')->name('send_otp');

Route::get('post-property', 'HomeController@create_property')->name('create_property'); 
Route::get('property/{title}', 'HomeController@property_detail')->name('property_detail');
Route::get('search/', 'HomeController@search_property')->name('search_property');
Route::get('search/grid/', 'HomeController@searchPropertyGrid')->name('grid.search_property');
Route::get('/{city?}', 'HomeController@home')->name('home');
Route::post('front/create-property', 'HomeController@createProperty')->name('create.property');

// Content Page Routes
Route::get('home/about-us', 'HomeController@aboutUs')->name('front.about');
Route::get('home/term-condition', 'HomeController@termCondition')->name('front.termCondition');
Route::get('home/privecy/policy', 'HomeController@privecyPolicy')->name('front.privecyPolicy');
Route::get('home/contact-us', 'HomeController@contactUs')->name('front.contactUs');
Route::get('home/testimonial', 'HomeController@testimonial')->name('front.testimonial');
Route::get('home/safety/health', 'HomeController@safetyHealth')->name('front.safetyHealth');
Route::get('home/summons/notice', 'HomeController@summonsNotice')->name('front.summonsNotice');
Route::post('send/summons/notice', 'HomeController@sendSummonsNotice')->name('front.sendSummonsNotice');
Route::get('home/career-with-us', 'HomeController@careerWithUs')->name('front.careerWithUs');
Route::get('home/job/detail/{id}', 'HomeController@jobdetail')->name('front.jobdetail');
Route::post('home/send/job/request', 'HomeController@sendJobRequest')->name('front.sendJobRequest');
Route::get('home/blog', 'HomeController@blog')->name('front.blog');
Route::get('home/blog/detail/{id}', 'HomeController@blogDetail')->name('front.blogDetail');
Route::post('home/create/testimonial', 'HomeController@createTestimonial')->name('front.createTestimonial');

Route::post('home/get/cities', 'HomeController@getCities')->name('front.getCities');
Route::post('home/get/locations', 'HomeController@getLocations')->name('front.getLocations');
Route::post('home/get/sub-locations', 'HomeController@getSubLocations')->name('front.getSubLocations');
Route::get('home/get/all/cities', 'HomeController@getAllCities')->name('front.getAllCities');
Route::get('home/get/all/cities/ancher', 'HomeController@getAllCitiesAncher')->name('front.getAllCitiesAncher');
Route::get('home/autocomplete-search', 'HomeController@autoSearch')->name('front.autoSearch');
Route::get('cookies/policy', 'HomeController@cookiesPolicy')->name('front.cookiesPolicy');
Route::get('refund-cancellation/policy', 'HomeController@cancellationPolicy')->name('front.cancellationPolicy');
Route::get('home/faq', 'HomeController@faq')->name('front.faq');
Route::get('adertisement/policy', 'HomeController@adertisementPolicy')->name('front.adertisementPolicy');
Route::get('home/agent/properties', 'HomeController@agentProperties')->name('front.agentProperties');
Route::get('home/builder/properties', 'HomeController@builderProperties')->name('front.builderProperties');
Route::get('home/builder/profile', 'HomeController@builderProfile')->name('front.builderProfile');

// Get Multiple Cities Based On Multiple States
Route::post('get/multiple/cities', 'Admin\FrontSectionContentController@getMultipleCities')->name('state.getMultipleCities');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin.check'], 'prefix' => 'master'], function() {
	Route::get('cities_states/{id}', 'LocationsController@fetch_cities_states')->name('cities_states');

	Route::group(['as' => 'admin.'], function() {

		// AJAX
		Route::get('fetch_form_type', 'FormTypeController@fetch_form_type')->name('fetch_form_type');

		Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
		Route::get('edit-profile', 'AdminController@edit_profile')->name('edit_profile');
		Route::post('update-edit-profile', 'AdminController@update_edit_profile')->name('update_edit_profile');
		Route::post('update-password', 'AdminController@update_password')->name('update_password');

		// Category 
		Route::group(['as' => 'category.'], function() {
			Route::get('fetch-category-tree', 'CategoryController@fetch_category_tree')->name('fetch_category_tree');
		});
		
		// Sub Category 
		Route::group(['as' => 'sub_category.'], function() {
			Route::get('fetch_subcategories_by_cat_id/{id}', 'SubCategoryController@fetch_subcategories_by_cat_id')->name('fetch_subcategories_by_cat_id');
			Route::get('fetch_multiple_subcategories_by_cat_id', 'SubCategoryController@fetch_multiple_subcategories_by_cat_id')->name('fetch_multiple_subcategories_by_cat_id');
		});

		Route::get('category_to_formtype_availablity/{cat_id}/{sub_cat_id}','FormTypeController@category_to_formtype_availablity')->name('category_to_formtype_availablity');


		Route::group(['prefix' => 'properties', 'as' => 'properties.'], function() {
			Route::get('apply_filters', 'PropertiesController@apply_filters')->name('apply_filters');
			
		});

		Route::post('property/change-status', 'PropertiesController@changeStatus')->name('property.changeStatus');
		Route::get('manage/properties', 'PropertiesController@manageProperties')->name('property.manageProperties');
		Route::post('approve/properties', 'PropertiesController@approveProperty')->name('property.approveProperty');
		Route::get('property/detail/{id}', 'PropertiesController@propertyDetail')->name('property.propertyDetail');

		// Sub Locations
		Route::get('sub-location/{id}', 'LocationsController@edit_sublocation')->name('edit_sublocation');
		Route::get('fetch_locations/{id}', 'LocationsController@fetch_locations')->name('fetch_locations');
		Route::get('fetch_sublocations/{id}', 'LocationsController@fetch_sublocations')->name('fetch_sublocations');
		Route::post('create_sublocation', 'LocationsController@create_sublocation')->name('create_sublocation');
		Route::post('update_sublocation', 'LocationsController@update_sublocation')->name('update_sublocation');
		Route::delete('delete_sublocation/{id}', 'LocationsController@delete_sublocation')->name('delete_sublocation');


		Route::get('fetch-subfeature/{id}', 'FeaturesController@show_subfeatures')->name('fetch_subfeature');
		Route::get('update-feature', 'FeaturesController@edit')->name('update_features');
		Route::post('create-subfeature', 'FeaturesController@create_subfeature')->name('create_subfeature');
		Route::post('update-subfeature/{id}', 'FeaturesController@update_subfeature')->name('update_subfeature');
		Route::get('edit-features-access', 'FeaturesController@edit_features_access')->name('features.edit_features_access');


		Route::post('update_property', 'PropertiesController@update')->name('properties.update_property');

		Route::get('sms-config','SmsApiController@edit_config')->name('sms_config');
		Route::post('update_sms_config','SmsApiController@update_config')->name('update_sms_config');

		Route::resource('category', 'CategoryController');
		Route::resource('sub-category', 'SubCategoryController');

		Route::resource('web-directory-category', 'WebDirectoryCategoryController');
		Route::resource('web-directory-sub-category', 'WebDirectorySubCategoryController'); 
		Route::get('edit/sub-directory/{id}', 'WebDirectorySubCategoryController@editView');
	
		Route::resource('sub-sub-category', 'SubSubCategoryController');
		Route::resource('features', 'FeaturesController');
		Route::resource('locations', 'LocationsController');
		Route::resource('owners', 'OwnersController'); 
		Route::resource('properties', 'PropertiesController'); 
		Route::get('preview/property/{id}', 'PropertiesController@previewProperty')->name('preview.property'); 
		Route::resource('formtype', 'FormTypeController');
		Route::resource('payment-gateway', 'PaymentGatewayController');
		Route::resource('email-integration', 'EmailIntegrationController');

		Route::resource('manage-enquiries','EnquiriesController');
		Route::resource('manage-complaints','FeedbackController');
		Route::resource('manage-ads','Ads\AdsManagementController');
		Route::resource('manage-audience','Ads\AudienceController');

		Route::group(['as' => 'complaints.'], function() {
			Route::get('apply_filters', 'FeedbackController@apply_filters')->name('apply_filters');
		});

		// Route::resource('manage-complaints','FeedbackController');

	});
});

// Builders Routes
Route::group(['middleware' => ['auth', 'admin.check']], function () {

	// Owner User Routes
	Route::post('master/create/owner', 'Admin\OwnersController@create')->name('owner.create');
	Route::get('master/update/owner/{id}', 'Admin\OwnersController@updateview')->name('owner.updateview');

	// Builder User Routes
	Route::get('master/manage/builders', 'Admin\BuilderController@index')->name('builder.index');
	Route::post('master/create/builders', 'Admin\BuilderController@create')->name('create.builder');
	Route::get('master/update/builders/{id}', 'Admin\BuilderController@updateview')->name('builder.updateview');

	// Agent User Routes
	Route::get('master/manage/agent', 'Admin\AgentController@index')->name('agent.index');
	Route::post('master/create/agent', 'Admin\AgentController@create')->name('agent.create');
	Route::get('master/update/agent/{id}', 'Admin\AgentController@updateview')->name('agent.updateview');

	// User Common Routes
	Route::post('master/update/user/profile', 'Admin\UserController@updateUserProfileCommon')->name('user.updateUserProfileCommon');
	Route::post('master/update/user/password', 'Admin\UserController@updateUserPasswordCommon')->name('user.updateUserPasswordCommon');
	Route::post('master/user/change-status', 'Admin\UserController@changeStatusCommon')->name('user.changeStatusCommon');
	Route::post('master/user/delete', 'Admin\UserController@deleteUserCommon')->name('user.deleteUserCommon');

	// Admin Form Builder Routes
	Route::post('master/custom/form/create', 'Admin\CustomFormController@create')->name('customform.create');
	Route::get('master/custom/form/view/{id}', 'Admin\CustomFormController@formView')->name('customform.formView');
	Route::get('master/custom/form/edit/{id}', 'Admin\CustomFormController@formEditView')->name('customform.formEditView');
	Route::post('master/custom/form/update', 'Admin\CustomFormController@customFormUpdate')->name('customform.customFormUpdate');
	Route::post('master/custom/form/delete', 'Admin\CustomFormController@deleteCustomForm')->name('customform.deleteCustomForm');
	Route::post('master/custom/form/change-status', 'Admin\CustomFormController@formChangeStatus')->name('customform.formChangeStatus');

	// Manage About Us Content
	Route::get('manage/about-us', 'Admin\ContentController@manageAboutContent')->name('manageAboutContent');
	Route::post('update/about-us', 'Admin\ContentController@updateAboutContent')->name('updateAboutContent');

	// Manage Term & Conditions
	Route::get('manage/terms', 'Admin\ContentController@manageTerms')->name('manageTerms');

	// Manage Vision & Mission Routes
	Route::get('manage/vision/mission', 'Admin\ContentController@manageVisionMission')->name('manageVisionMission');
	Route::post('create/vision/mission', 'Admin\ContentController@createVisionMission')->name('createVisionMission');
	Route::post('update/vision/mission', 'Admin\ContentController@updateVisionMission')->name('updateVisionMission');
	Route::delete('delete/vision/mission/{id}', 'Admin\ContentController@deleteVisionMission')->name('deleteVisionMission');
	Route::get('get/key/data/{id}', 'Admin\ContentController@getkeyData')->name('admin.getkeyData');

	// Contact Us Routes
	Route::get('manage/contact/info', 'Admin\ContentController@manageContactInfo')->name('admin.manageContactInfo');
	Route::post('create/contact/info', 'Admin\ContentController@createContactInfo')->name('admin.createContactInfo');
	Route::get('get/contact/info/{id}', 'Admin\ContentController@getContactInfo')->name('admin.getContactInfo');
	Route::post('update/contact/info', 'Admin\ContentController@updateContactInfo')->name('admin.updateContactInfo');
	Route::delete('delete/contact/info/{id}', 'Admin\ContentController@deleteContactInfo')->name('admin.deleteContactInfo');

	// Manage Policy Routes
	Route::get('manage/privecy-policy', 'Admin\ContentController@managePolicy')->name('managePolicy');

	// Manage Testimonials Routes
	Route::get('manage/testimonials', 'Admin\ContentController@manageTestimonial')->name('admin.manageTestimonial');
	Route::post('create/testimonials', 'Admin\ContentController@createTestimonial')->name('admin.createTestimonial');
	Route::get('get/testimonial/data/{id}', 'Admin\ContentController@getTestimonialData')->name('admin.getTestimonialData');
	Route::post('update/testimonials', 'Admin\ContentController@updateTestimonial')->name('admin.updateTestimonial');
	Route::delete('delete/testimonials/{id}', 'Admin\ContentController@deleteTestimonial')->name('admin.deleteTestimonial');
	Route::post('change-status/testimonials', 'Admin\ContentController@changeStatusTestimonial')->name('admin.changeStatusTestimonial');
	Route::post('show-on-front/testimonials', 'Admin\ContentController@showOnFrontTestimonial')->name('admin.showOnFrontTestimonial');

	// Safety Health Routes
	Route::get('manage/safety-health', 'Admin\ContentController@manageSafetyHealth')->name('admin.manageSafetyHealth');

	// Summons Reasons Routes
	Route::get('manage/summons/reasons', 'Admin\ContentController@manageSummonsReasons')->name('admin.manageSummonsReasons');
	Route::post('create/summons/reasons', 'Admin\ContentController@createSummonsReasons')->name('admin.createSummonsReasons');
	Route::get('get/summons/reasons/{id}', 'Admin\ContentController@getDataSummonsReasons')->name('admin.getDataSummonsReasons');
	Route::post('update/summons/reasons', 'Admin\ContentController@updateSummonsReasons')->name('admin.updateSummonsReasons');
	Route::delete('delete/summons/reasons/{id}', 'Admin\ContentController@deleteSummonsReasons')->name('admin.deleteSummonsReasons');

	// Support Center Routes
	Route::get('manage/support/query', 'Admin\EnquiriesController@manageSupportQuery')->name('admin.manageSupportQuery');
	Route::get('manage/support/query-datatable', 'Admin\EnquiriesController@manageSupportQueryDatatable')->name('admin.manageSupportQueryDatatable');
	Route::post('get/support/data', 'Admin\EnquiriesController@getSupportCenterData')->name('admin.getSupportCenterData');
	Route::post('reply/support/query', 'Admin\EnquiriesController@replySupportQuery')->name('admin.replySupportQuery');

	// Complaints Routes
	Route::get('manage/complaints', 'Admin\EnquiriesController@manageComplaints')->name('admin.manageComplaints');
	Route::get('manage/complaints-datatable', 'Admin\EnquiriesController@manageComplaintsDatatable')->name('admin.manageComplaintsDatatable');
	Route::get('get/complaint/data/{id}', 'Admin\EnquiriesController@getComplaintData')->name('admin.getComplaintData');
	Route::post('reply/complaint/query', 'Admin\EnquiriesController@replyComplaintQuery')->name('admin.replyComplaintQuery');

	// Carrier With Us Routes
	Route::get('manage/career-with-us', 'Admin\ContentController@manageCarrerWithUs')->name('admin.manageCarrerWithUs');
	Route::post('update/career-with-us', 'Admin\ContentController@updateCareerWithUsContent')->name('admin.updateCareerWithUsContent');

	// Job Category Routes
	Route::get('manage/job/categories', 'Admin\JobController@manageJobCategories')->name('admin.manageJobCategories');
	Route::post('store/job/categories', 'Admin\JobController@storeJobCategories')->name('admin.storeJobCategories');
	Route::post('change-status/job/categories', 'Admin\JobController@changeStatusJobCategories')->name('admin.changeStatusJobCategories');
	Route::get('info/job/category/{id}', 'Admin\JobController@getCategoryInfo')->name('admin.getCategoryInfo');
	Route::post('update/job/categories', 'Admin\JobController@updateJobCategories')->name('admin.updateJobCategories');
	Route::delete('delete/job/categories/{id}', 'Admin\JobController@deleteJobCategories')->name('admin.deleteJobCategories');

	// Manage Job Technologies
	Route::get('manage/job/technologies', 'Admin\JobController@manageJobTechnologies')->name('admin.manageJobTechnologies');
	Route::post('store/job/technologies', 'Admin\JobController@storeJobTechnologies')->name('admin.storeJobTechnologies');
	Route::post('update/job/technologies', 'Admin\JobController@updateJobTechnologies')->name('admin.updateJobTechnologies');
	Route::get('info/job/technologies/{id}', 'Admin\JobController@getTechnologyInfo')->name('admin.getTechnologyInfo');
	Route::post('change-status/job/technologies', 'Admin\JobController@changeStatusTechnology')->name('admin.changeStatusTechnology');
	Route::delete('delete/job/technologies/{id}', 'Admin\JobController@deleteJobTechnology')->name('admin.deleteJobTechnology');

	// Manage Job Routes
	Route::get('manage/jobs', 'Admin\JobController@manageJobs')->name('admin.manageJobs');
	Route::get('create/jobs', 'Admin\JobController@createJobView')->name('admin.createJobView');
	Route::post('create/jobs', 'Admin\JobController@createJob')->name('admin.createJob');
	Route::get('info/jobs/{id}', 'Admin\JobController@jobInfo')->name('admin.jobInfo');
	Route::post('change-status/jobs', 'Admin\JobController@jobChangeStatus')->name('admin.jobChangeStatus');
	Route::get('edit/job/{id}', 'Admin\JobController@editJob')->name('admin.editJob');
	Route::post('update/job', 'Admin\JobController@updateJob')->name('admin.updateJob');
	Route::get('delete/job/{id}', 'Admin\JobController@deleteJob')->name('admin.deleteJob');

	// Manage Blog Category Routes
	Route::get('manage/blog/categories', 'Admin\BlogController@manageBlogCategories')->name('admin.manageBlogCategories');
	Route::post('store/blog/categories', 'Admin\BlogController@storeBlogCategories')->name('admin.storeBlogCategories');
	Route::post('change-status/blog/categories', 'Admin\BlogController@changeStatusBlogCategories')->name('admin.changeStatusBlogCategories');
	Route::get('info/blog/category/{id}', 'Admin\BlogController@getBlogCategoryInfo')->name('admin.getBlogCategoryInfo');
	Route::post('update/blog/categories', 'Admin\BlogController@updateBlogCategories')->name('admin.updateBlogCategories');
	Route::delete('delete/blog/categories/{id}', 'Admin\BlogController@deleteBlogCategories')->name('admin.deleteBlogCategories');

	// Manage Blog Routes
	Route::get('manage/blogs', 'Admin\BlogController@manageBlogs')->name('admin.manageBlogs');
	Route::get('create/blog', 'Admin\BlogController@createBlogView')->name('admin.createBlogView');
	Route::post('create/blog', 'Admin\BlogController@createBlog')->name('admin.createBlog');
	Route::post('update/feature/blog', 'Admin\BlogController@updateFeatureBlog')->name('admin.updateFeatureBlog');
	Route::get('info/blogs/{id}', 'Admin\BlogController@blogInfo')->name('admin.blogInfo');
	Route::post('change-status/blog', 'Admin\BlogController@blogChangeStatus')->name('admin.blogChangeStatus');
	Route::get('edit/blog/{id}', 'Admin\BlogController@editBlog')->name('admin.editBlog');
	Route::post('update/blog', 'Admin\BlogController@updateBlog')->name('admin.updateBlog');
	Route::delete('delete/blog/{id}', 'Admin\BlogController@deleteBlog')->name('admin.deleteBlog');

	// Manage State Routes
	Route::get('manage/states', 'Admin\StateController@manageStates')->name('admin.manageStates');
	Route::get('manage/states/datatable', 'Admin\StateController@manageStateDatatable')->name('admin.manageStateDatatable');
	Route::post('create/state', 'Admin\StateController@createState')->name('admin.createState');
	Route::post('update/state', 'Admin\StateController@updateState')->name('admin.updateState');
	Route::get('state/info/{id}', 'Admin\StateController@stateInfo')->name('admin.stateInfo');
	Route::post('delete/state', 'Admin\StateController@deleteState')->name('admin.deleteState');

	// Manage City Routes
	Route::get('manage/city/{id?}', 'Admin\StateController@manageCities')->name('admin.manageCities');
	Route::get('manage/city/datatable/{id?}', 'Admin\StateController@manageCitiesDatatable')->name('admin.manageCitiesDatatable');
	Route::post('create/city', 'Admin\StateController@createCity')->name('admin.createCity');
	Route::get('city/info/{id}', 'Admin\StateController@cityInfo')->name('admin.cityInfo');
	Route::post('update/city', 'Admin\StateController@updateCity')->name('admin.updateCity');
	Route::post('delete/city', 'Admin\StateController@deleteCity')->name('admin.deleteCity');

	// Manage Amenities Routes
	Route::get('manage/amenities', 'Admin\AmenityController@manageAmenities')->name('admin.manageAmenities');
	Route::post('create/amenities', 'Admin\AmenityController@createAmenities')->name('admin.createAmenities');
	Route::get('amenities/{id}', 'Admin\AmenityController@getAmenitiesData')->name('admin.getAmenitiesData');
	Route::post('update/amenities', 'Admin\AmenityController@updateAmenities')->name('admin.updateAmenities');
	Route::post('change-status/amenities', 'Admin\AmenityController@chnageStatusAmenities')->name('admin.chnageStatusAmenities');
	Route::delete('delete/amenities/{id}', 'Admin\AmenityController@deleteAmenities')->name('admin.deleteAmenities');

	// Email Templates Routes
	Route::get('manage/email-template', 'Admin\EmailTemplateController@index')->name('admin.email-template.index');
	Route::get('email-template/create', 'Admin\EmailTemplateController@create')->name('admin.email-template.create');
	Route::post('email-template/store', 'Admin\EmailTemplateController@store')->name('admin.email-template.store');
	Route::get('email-template/edit/{id}', 'Admin\EmailTemplateController@edit')->name('admin.email-template.edit');
	Route::get('email-template/show/{id}', 'Admin\EmailTemplateController@show')->name('admin.email-template.show');
	Route::post('email-template/update/{id}', 'Admin\EmailTemplateController@update')->name('admin.email-template.update');
	Route::post('change-email-template-status', 'Admin\EmailTemplateController@changestatus')->name('admin.change-email-template-status');

	// Manage Popular Cities
	Route::get('manage/popular/cities', 'Admin\AdminController@managePopularCities')->name('admin.popular.cities');
	Route::get('popular/city/get/content/{id}', 'Admin\AdminController@popularCityGetContent')->name('admin.popularCityGetContent');
	Route::post('popular/city/create', 'Admin\AdminController@createPopularCity')->name('admin.createPopularCity');
	Route::post('popular/city/update', 'Admin\AdminController@updatePopularCity')->name('admin.updatePopularCity');
	Route::delete('popular/city/delete/{id}', 'Admin\AdminController@deletePopularCity')->name('admin.deletePopularCity');

	// Manage Feature Content
	Route::get('manage/feature/content', 'Admin\ContentController@manageFeatureContent')->name('admin.manageFeatureContent');
	Route::post('create/feature/content', 'Admin\ContentController@createFeatureContent')->name('admin.createFeatureContent');
	Route::post('update/feature/content', 'Admin\ContentController@updateFeatureContent')->name('admin.updateFeatureContent');
	Route::get('get/feature/content/{id}', 'Admin\ContentController@getFeatureContent')->name('admin.getFeatureContent');
	Route::delete('delete/feature/content/{id}', 'Admin\ContentController@deleteFeatureContent')->name('admin.deleteFeatureContent');
	Route::post('change-status/feature/content', 'Admin\ContentController@changeStatusFeatureContent')->name('admin.changeStatusFeatureContent');

	// Manage Help Content
	Route::get('manage/help/content', 'Admin\ContentController@manageHelpContent')->name('admin.manageHelpContent');
	Route::post('update/help/content', 'Admin\ContentController@updateHelpContent')->name('admin.updateHelpContent');

	// Manage Social Media
	Route::get('manage/social-media', 'Admin\ContentController@manageSocialMedia')->name('admin.manageSocialMedia');
	Route::post('update/social-media', 'Admin\ContentController@updateSocialMedia')->name('admin.updateSocialMedia');

	// Manage Footer Content Route
	Route::get('manage/footer/content', 'Admin\ContentController@manageFooterContent')->name('admin.manageFooterContent');
	Route::post('update/footer/content', 'Admin\ContentController@updateFooterContent')->name('admin.updateFooterContent');

	// Property Routes
	Route::get('manage/pending/properties', 'Admin\PropertiesController@pendinPropertyList')->name('admin.pendinPropertyList');
	Route::get('get/user/info/{id}', 'Admin\PropertiesController@getUserInfo')->name('admin.getUserInfo');

	Route::get('manage/approved/properties', 'Admin\PropertiesController@manageApprovedProperties')->name('admin.manageApprovedProperties');
	Route::get('manage/approved/properties/datatable', 'Admin\PropertiesController@manageApprovedPropertiesDatatable')->name('admin.manageApprovedPropertiesDatatable');
	Route::get('get/user/info/{id}', 'Admin\PropertiesController@getUserInfo')->name('admin.getUserInfo');
	Route::get('manage/published/properties', 'Admin\PropertiesController@managePublishedProperties')->name('admin.managePublishedProperties');
	Route::get('manage/published/properties/datatable', 'Admin\PropertiesController@managePublishedPropertiesDatatable')->name('admin.managePublishedPropertiesDatatable');
	Route::post('published/properties', 'Admin\PropertiesController@publishedProperty')->name('admin.publishedProperty');
	Route::get('manage/cancelled/properties', 'Admin\PropertiesController@manageCancelledProperties')->name('admin.manageCancelledProperties');
	Route::get('manage/cancelled/properties/datatable', 'Admin\PropertiesController@manageCancelledPropertiesDatatable')->name('admin.manageCancelledPropertiesDatatable');

	// Create Zip Of Property Images And Downlaod
	Route::get('create/property-images/zip/{id}', 'Admin\PropertiesController@createPropertyImagesZip')->name('admin.createPropertyImagesZip');

	// Send Email By Admin
	Route::post('send/email', 'Admin\EnquiriesController@sendEmail')->name('admin.sendEmail');

	// Send SMS By Admin
	Route::post('send/sms', 'Admin\EnquiriesController@sendSMS')->name('admin.sendSMS');

	// Trending Properties Routes
	Route::post('property/trending/status', 'Admin\PropertiesController@manageTrendingStatus')->name('admin.manageTrendingStatus');
	// Manage Featured Status
	Route::post('property/featured/status', 'Admin\PropertiesController@manageFeaturedStatus')->name('admin.manageFeaturedStatus');

	// Property Feedback
	Route::get('master/property/feedback', 'Admin\FeedbackController@propertyFeedbacks')->name('admin.propertyFeedbacks');
	Route::post('master/change-status/feedback', 'Admin\FeedbackController@changeStatusPropertyFeedbacks')->name('admin.changeStatusPropertyFeedbacks');

	// CLaim Routes

	Route::get('master/manage/claims', 'Admin\PropertiesController@manageClaims')->name('admin.manageClaims');
	Route::get('master/manage/claims/datatable', 'Admin\PropertiesController@manageClaimsDatatable')->name('admin.manageClaimsDatatable');
	Route::post('master/assign/claim', 'Admin\PropertiesController@assignPropertyClaim')->name('admin.assignPropertyClaim');

	// Verify Email And Mobile Number
	Route::post('verify/email/and/mobile', 'Admin\OwnersController@verifyEmailMobile')->name('admin.verifyEmailMobile');

	// Front Section Controller 
	Route::resource('manage/front/content', 'Admin\FrontSectionContentController');
});

Route::group(['middleware' => ['auth', 'owner.check']], function () {
	Route::get('user/dashboard', 'User\UserController@dashboard')->name('user.dashboard');
	Route::get('user/properties', 'User\UserController@all_properties')->name('user.properties');
	Route::get('user/profile', 'User\UserController@see_profile')->name('user.see_profile');
	Route::post('user/update_profile','User\UserController@update_profile')->name('user.update_profile');
	Route::post('user/update_password','User\UserController@update_password')->name('user.update_password');
	Route::post('user/logout','User\UserController@userlogout')->name('user.userlogout');
});
Route::post('user/upload_avatar','User\UserController@upload_avatar')->name('user.upload_avatar');

Route::group(['middleware' => ['auth', 'builder.check']], function () {
	Route::get('builder/dashboard', 'User\UserController@builderDashboard')->name('builder.builderDashboard');
	Route::get('builder/properties', 'User\UserController@builderAllProperties')->name('builder.builderAllProperties');
	Route::get('builder/profile', 'User\UserController@seeBuilderProfile')->name('builder.seeBuilderProfile');
	Route::post('builder/update_profile','User\UserController@update_profile')->name('builder.update_profile');
	Route::post('builder/update_password','User\UserController@update_password')->name('builder.update_password');
	Route::post('builder/logout','User\UserController@userlogout')->name('builder.userlogout');
});

Route::group(['middleware' => ['auth', 'agent.check']], function () {
	Route::get('agent/dashboard', 'User\UserController@agentDashboard')->name('agent.agentDashboard');
	Route::get('agent/properties', 'User\UserController@agentAllProperties')->name('agent.agentAllProperties');
	Route::get('agent/profile', 'User\UserController@seeAgentProfile')->name('agent.seeAgentProfile');
	Route::post('agent/update_profile','User\UserController@update_profile')->name('agent.update_profile');
	Route::post('agent/update_password','User\UserController@update_password')->name('agent.update_password');
	Route::post('agent/logout','User\UserController@userlogout')->name('agent.userlogout');
});

// After Login Common Routes
Route::group(['middleware' => ['auth']], function () {
	Route::get('update/property/{id}', 'HomeController@editPropertyView')->name('property.editPropertyView');
	Route::get('user/property/preview/{id}', 'HomeController@userPreviewPropertyView')->name('property.userPreviewPropertyView');
	Route::post('update/property', 'HomeController@updateProperty')->name('property.updateProperty');
	Route::post('delete/property/images', 'HomeController@deleteGalleryImages')->name('property.deleteGalleryImages');
	Route::post('delete/property', 'HomeController@deleteProperty')->name('property.delete');
	
	Route::get('post/property/final/{id}', 'Admin\PropertiesController@postPropertyFinalView')->name('property.postPropertyFinalView');
	Route::post('post/property/final', 'Admin\PropertiesController@postPropertyFinal')->name('property.postPropertyFinal');

	// User Profile Routes
	Route::get('user/profile/{id}', 'Admin\OwnersController@viewUserProfile')->name('view.viewUserProfile');
	// Get Total Property 
	Route::get('total/properties/datatable', 'Admin\PropertiesController@getTotalProperties')->name('admin.getTotalProperties');

	// Verify Email & Mobile Number
	Route::get('user/verify/email', 'HomeController@userVerifyEmail')->name('user.verifyEmail');
	Route::get('user/verify/mobile', 'HomeController@userVerifyMobile')->name('user.userVerifyMobile');
	Route::post('user/email-mobile/verify/otp', 'HomeController@emailMobileOtpVerification')->name('user.emailMobileOtpVerification');
});

//Enquery Routes 
Route::post('send/enquery', 'HomeController@agent_enquiry')->name('enquery.agent_enquiry');

Route::post('master/property/feedback/create', 'Admin\FeedbackController@createFeedback')->name('admin.createFeedback');

Route::post('contactus/send/query', 'Admin\ContentController@sendUserQuery')->name('contactus.sendUserQuery');
Route::post('get/categories', 'Admin\CategoryController@getAllCategories')->name('getAllCategories');
Route::post('get/locations', 'Admin\CategoryController@getAllLocations')->name('getAllLocations');
Route::post('get/property/types', 'Admin\CategoryController@getAllPropertyTypes')->name('getAllPropertyTypes');
Route::post('property/data/filter', 'Admin\PropertiesController@propertyDataFilter')->name('propertyDataFilter');
Route::post('get/all/amenities', 'Admin\PropertiesController@getAllAmenities')->name('getAllAmenities');
Route::get('get/sub-categories/{category_id}', 'HomeController@getSubCategories')->name('getSubCategories');

// Without Login Common Routes
Route::post('category/related-form', 'Admin\CustomFormController@categoryRelatedForm')->name('category.related-form');

// Send Login OTP
Route::post('login/send/otp', 'HomeController@sendLoginOtp')->name('user.send-login-otp');

// Claim Listing Routes
Route::post('property/claim/{id}', 'Admin\PropertiesController@claim_listing')->name('admin.apply.claim');
Route::post('claim/verified', 'Admin\PropertiesController@verifyClaim')->name('admin.verifyClaim');
Route::get('claim/resend/otp', 'Admin\PropertiesController@resendOTPProperty')->name('admin.resendOTPProperty');



Auth::routes();

// Social Login Routes

Route::get('login/{provider}', 'SocialController@redirect');
Route::get('login/{provider}/callback','SocialController@Callback');

Route::get('signup/{provider}', 'SocialController@redirectSignup');
Route::get('login/google/callback','SocialController@googleCallback');

