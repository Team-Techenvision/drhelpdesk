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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return redirect('admin');
});


//login with social 

Route::get('/auth/redirect/{provider}', 'UI\UserController@redirect');
  Route::get('/callback/{provider}', 'UI\UserController@callback');
 
Route::get('chat-mobile-view/{id}', 'UI\MainController@chatMobileView');
Route::get('search', 'UI\MainController@index')->name('search');
Route::get('home-search-data','UI\MainController@searchData'); 
Route::post('home-search-data','UI\MainController@searchData'); 
Route::get('get-prod-list','UI\MainController@getProductList');
Route::get('contact','UI\MainController@appContactUs');
Route::get('return-policies','UI\MainController@appReturnPolicy');

Route::get('privacy-policies','UI\MainController@appPrivacyPolicy');
Route::get('term-condition','UI\MainController@appTermCondition');
Route::get('blog-detail/{id}','UI\MainController@blogDetails');
Route::get('block', 'UI\UserController@logout')->middleware('auth');
Route::get('coming-soon', 'UI\MainController@comingSoonPage');
//new code 
Route::get('logout', 'UI\MainController@logout');

Route::post('/checkaddress', 'UI\MainController@checkaddress');
Route::post('/checkcheckoutaddress', 'UI\MainController@checkcheckoutaddress');

Route::post('/setlocation', 'UI\MainController@setlocation');

	// Main Controller ROUTES
	Route::get('/', 'UI\MainController@homePage');
	Route::get('/product-detail/{products_id}', 'UI\MainController@productDetail');
	
	Route::get('/product-detail/{products_id}/{product_name}', 'UI\MainController@productDetail');
	
	//get attributes details by ajax
	Route::get('/product-attribute-detail', 'UI\MainController@getattributeinfo');
	Route::get('/product-module-detail', 'UI\MainController@getproductdetailinmodel');

	// Route::get('/product-list', 'UI\MainController@productListing');
	// Route::get('filter-categories/{categories_id}','UI\MainController@productFilter');  
	// Route::get('filter-subcategories/{categories_id}/{subcategories}','UI\MainController@productFilter1');  
	// Route::get('filter-subsubcategories/{categories_id}/{subcategories}/{subsubcategories}','UI\MainController@productFilter2');  
	
	// product by brand 
		Route::get('product-by-brand/{categories_id}','UI\MainController@productByBrand')->name('filtersubbrand.show');  
		Route::post('product-by-brand/{categories_id}','UI\MainController@productByBrand')->name('filterbrand.show'); 
	Route::get('filter-category/{categories_id}/{subcategories?}/{subsubcategories?}/{subsubsubcategories?}','UI\MainController@productFilter3')->name('filtersubcategory.show'); 
	Route::post('filter-category/{categories_id}/{subcategories?}/{subsubcategories?}/{subsubsubcategories?}','UI\MainController@productFilter3')->name('filtercategory.show'); 
	Route::get('about-us','UI\MainController@aboutUs');
	Route::get('contact-us','UI\MainController@contactUs');
	Route::get('user-invoice/{order_id}','UI\MainController@userInvoice');
	Route::get('download-user-invoice/{order_id}','UI\MainController@downloadUserInvoice');
	Route::post('submit-contact-us','UI\MainController@submitContactUs')->name('submit_contact_us');
	Route::post('home-submit-contact-us','UI\MainController@homesubmitContactUs')->name('home-submit-contact-us');
	Route::get('blog','UI\MainController@blog');
	Route::get('privacy-policy','UI\MainController@privacyPolicy');
	Route::get('brands','UI\MainController@brands');
	Route::get('delivery-Information','UI\MainController@deliveryInfo');
	Route::get('store-location','UI\MainController@storeLocation');
	Route::post('save-newslatter','UI\MainController@submitNewslatter')->name('save_newslatter');
    Route::get('disclaimer','UI\MainController@disclaimer');
	Route::get('term-conditions','UI\MainController@termCondition');
	Route::get('refund-policy','UI\MainController@refundPolicy');
	//User Controller Routes
	Route::get('/registration', 'UI\UserController@userRegistration');
	Route::get('/login-user', 'UI\UserController@userLogin');
	Route::get('thank-you-reg', 'UI\UserController@thankYouPage');
    // 	Route::post('user-registration','UI\UserController@userRegistrationSubmit');
    Route::get('/otp', 'UI\UserController@otp'); 
    Route::get('/resendotp', 'UI\UserController@otpresend');
	//Route::post('user-registration','UI\UserController@userRegistrationSubmit'); 
	Route::post('otp-submit','UI\UserController@otpSubmit1'); 
	Route::post('user-registration','UI\UserController@otpSubmit'); 
	Route::post('user-login','UI\UserController@userLoginSubmit');
	Route::get('/guest-user', 'UI\UserController@guestLogin');
	Route::post('/guest-login','UI\UserController@isExists'); 
	Route::get('dashboard','UI\UserController@dashboard'); 
	Route::get('cart-details/{products_id}/{attribute_id}/{cat_id}','UI\UserController@addtoCart');
	Route::get('cart','UI\UserController@addtoCart1');
    Route::get('package-add-cart/{products_id}','UI\UserController@packageAddtToCart');
	Route::get('my-cart','UI\UserController@userMyCart');
    Route::post('my-cart-ajax','UI\UserController@userMyCartOnAjax');
    Route::post('set_default_address','UI\UserController@userSetDefaultAddress');
	Route::get('cart-update','UI\UserController@cartUpdate');
	Route::get('remove-product','UI\UserController@removeProduct'); 
	Route::get('checkout','UI\UserController@userCheckout');
	Route::post('payment','RazorpayController@payment')->name('payment');
	Route::get('confirm-order/{order_id}','RazorpayController@confirm')->name('confirm.order');
	Route::get('razor-order','RazorpayController@createOrder')->name('razor.order');
	Route::get('checkout1/{id}/{prescription_id}','UI\UserController@userCheckout1');
	Route::post('user-address-submit','UI\UserController@userAddressSubmit');
	Route::get('user-address-delete/{id}','UI\UserController@userAddressDelete'); 
	Route::get('user-address-edit/{id}','UI\UserController@userAddressEdit'); 
	Route::post('checkout-submit','UI\UserController@checkoutSubmit');
	Route::get('order-suceess/{order_id}','UI\UserController@orderSuccessPage');
	Route::get('ip','UI\MainController@get_ip_detail');
	Route::get('upload-prescription/{type}','UI\MainController@uploadPrescription');
	Route::post('prescription-submit','UI\UserController@prescription');
	Route::post('prescription-checkout','UI\MainController@addPrescTocheckout');
    Route::get('get-payment/{order_id}','UI\PaymentController@showPayment');
    Route::get('order-fail/{order_id}','UI\UserController@orderFailPage');
	//new prescription url
	Route::post('upload-new-prescription','UI\UserController@addaddress_new');
	
	Route::post('prescription-final-submit','UI\UserController@prescriptionsubmit');

	Route::get('my-prescription','UI\UserController@userMyprescription');

	Route::get('my-notification','UI\UserController@usernotification');
	
	Route::get('order_tracking', 'UI\UserController@order_tracking');
	Route::get('giftcardlist', 'UI\UserController@giftcardlist');
	Route::get('giftcardsend', 'UI\UserController@giftcardsend');
	
	
	//Wishlist

	Route::get('add-wishlist/{products_id}/{attribute_id}/{user_id}','UI\UserController@addtoWishlist');
	Route::get('my-wishlist','UI\UserController@userMyWishlist');
	Route::get('remove-wishlist','UI\UserController@RemoveWishlist'); 
	

	Route::post('remove-coupon','UI\UserController@removeCoupon');
    Route::post('remove-my-cart-coupon','UI\UserController@removeMyCartCoupon');

	Route::get('payment-success','UI\PaymentController@paymentSucccess')->name('payment_success');
	Route::get('payment-succes','UI\PaymentController@paymentSucccess')->name('payment_success');
	Route::get('payment-fail','UI\PaymentController@paymentFail')->name('payment_fail');
	
    Route::post('user-payment','UI\PaymentController@showUserPaymet');
    
	Route::get('payment-user-succes','UI\PaymentController@paymentUserSucccess');
	Route::get('payment-user-fail','UI\PaymentController@paymentUserFail');

	Route::post('product-review-submit','UI\UserController@addReviewComment'); 

	// User Dashboard routes
	   Route::get('user-dashboard','UI\UserController@userDashboard'); 
	   Route::get('user-order-detail/{id}','UI\UserController@userOrderDetail');
	   Route::get('user-profile','UI\UserController@userProfile'); 
	   Route::get('user-order-history','UI\UserController@userOrderHistory');
	   Route::get('user-wallet-history','UI\UserController@userWalletHistory');
	   Route::get('user-booking','UI\UserController@userMyBooking');
	   Route::get('user-address','UI\UserController@userAddress');
	   Route::get('user-password','UI\UserController@userPassword');
	   Route::post('user-profile-submit','UI\UserController@userProfileSubmit'); 
	   Route::post('order-status-update','UI\UserController@orderCancelOrder');
	   Route::post('shippingorder-status-update','UI\UserController@shippingorderCancelOrder');
	   Route::get('user-booking-detail/{id}','UI\UserController@userBookingDetails');
	   Route::get('user-change-password','UI\UserController@changePassword');
	   Route::post('user-change-password-submit','UI\UserController@changePasswordSubmit');
	   
	   //repeat Order 
	   Route::get('repeat-order/{id}','UI\UserController@repeatOrder');
       
       Route::get('user-checkout-address/{is_checkout?}','UI\UserController@userCheckoutAddress');
       
	     Route::post('trackorder','UI\UserController@trackorder');
	// Doctor Controller 
	   	//Doctor Dashboard routes
	   	Route::post('doctor-education-submit','UI\DoctorController@doctoreducation');
	    Route::post('doctor-experiance-submit','UI\DoctorController@doctorexperiance');
         Route::post('doctor-award-submit','UI\DoctorController@doctoraward');
          Route::post('doctor-ragistration-submit','UI\DoctorController@doctorragistration');
          
           Route::get('/delete-experiance-detail/{id}', 'UI\DoctorController@deleteexperiance');
            Route::get('/delete-award-detail/{id}', 'UI\DoctorController@deleteaward');
             Route::get('/delete-registration-detail/{id}', 'UI\DoctorController@deleteragistration');
              Route::get('/delete-education-detail/{id}', 'UI\DoctorController@deleteeducation');
             
	   	Route::post('doctor-list-ajax','UI\DoctorController@doctorLisetAjax');
	   	Route::post('submit-review-ajax','UI\DoctorController@submitReviewAjax');
	   Route::get('doctor-appointment','UI\DoctorController@doctorAppointment');
	   Route::get('doctor-change-password','UI\DoctorController@doctorChangePassword');
	   Route::get('doctor-chat','UI\DoctorController@doctorChatDoctor');
	   Route::get('doctor-dashboard','UI\DoctorController@doctorDashboard');
	   Route::get('doctor-invoices','UI\DoctorController@doctorInvoices');
	   Route::get('doctor-profile-setting','UI\DoctorController@doctorProfileSettings');
	   Route::get('doctor-clinic-setting','UI\DoctorController@doctorClinicSettings');
	   Route::get('doctor-review','UI\DoctorController@doctorReviews');
	   Route::get('doctor-schedule-timing','UI\DoctorController@doctorScheduleTimings'); 
           Route::get('doctor-sub-list/{categories_id}/{subcategories}','UI\DoctorController@doctorSubListing');

	   Route::get('doctor-list/{categories_id}/{subcategories?}','UI\DoctorController@doctorListing')->name('doctorlist.show');
	   Route::post('doctor-list/{categories_id}/{subcategories?}','UI\DoctorController@doctorListing')->name('doctorlist.view'); 
	   Route::get('doctor-details/{id}','UI\DoctorController@doctorDetails');
	   Route::get('doctor-dashboard','UI\DoctorController@doctorDashboard');
	   Route::post('appointment','UI\DoctorController@doctorAppointmentSubmit');
	   Route::post('feedback','UI\DoctorController@doctorFeedback'); 
	   Route::post('doctor-detail-submit','UI\DoctorController@doctorDetailsSubmit'); 
	   Route::post('clinic-detail-submit','UI\DoctorController@clinicDetailsSubmit'); 
	   Route::get('/delete-patient-detail/{id}', 'UI\DoctorController@deletePatientData');
	   Route::get('/delete-profile-detail/{id}', 'UI\DoctorController@deleteProfileData');
	   Route::get('toggle-patient-status/{status}/{id}', 'UI\DoctorController@togglePatientActiveStatus');
	   Route::post('change-password','UI\DoctorController@changePassword');   
	   
	   Route::get('doctor-consult-history/{user_id}','UI\DoctorController@doctorConsultHistory');
	   Route::get('doctor-credit-history/{user_id}','UI\DoctorController@doctorCreditHistory');
	   //forget Password website
        Route::get('forget-password','UI\UserController@forgetPasswordView');
        Route::post('forget-password-submit','UI\UserController@forgotPasswordSubmit');
        //password reset
        Route::get('passwordreset/{id}','UI\UserController@forgetPassword');
        Route::post('submit','UI\UserController@submit');
		Route::get('thanku','UI\UserController@thanku');
		
		Route::get('/payment-initiate',function(){
			return view('UI/components/pay');
		});
		
		// for Initiate the order
		Route::post('/payment-initiate-request','RazorpayController@Initiate');
		
		// for Payment complete
		Route::post('/payment-complete','RazorpayController@Complete');
      
        
        //Lab Test Controller
        	Route::get('lab-tests','UI\LabTestController@popularPackages'); 
        	Route::get('lab-test','UI\LabTestController@allTest'); 
        	Route::get('lab-test-detail/{id}','UI\LabTestController@testDetail'); 
        	Route::get('all-package','UI\LabTestController@allPackage'); 
			Route::get('package-detail/{id}','UI\LabTestController@packageDetail'); 
            Route::post('wallet','UI\MainController@saveWallet')->name('wallet');
            Route::post('calling', 'UI\MainController@callToConnect')->name('calling');
            Route::post('cunsult-now', 'UI\MainController@cunsultNow')->name('cunsult_now');
            
            Route::get('start-chat','UI\ChatController@startChat')->name('start_chat');
            Route::get('start-doc-chat','UI\ChatController@startDocChat')->name('start_doc_chat'); 
            
            Route::get('contacts','UI\ChatController@getList');

			  //get city by state ajax
        Route::get('getCity1','UI\UserController@getCityList');
            
Auth::routes(); 
Route::middleware(['admin','auth'])->group(function() {
	Route::get('/admin', 'admin\DashboardController@admin'); 
	Route::get('/vendor', 'admin\DashboardController@vendor'); 
	
	Route::get('/send-offer-view', 'admin\AdminController@sendOfferView');
    Route::post('/send-offers', 'admin\AdminController@sendOffers');
	Route::get('/add-categories', 'admin\AdminController@addCategories');
	Route::get('/view-categories', 'admin\AdminController@viewCategories');
	Route::get('/edit-categories/{id}', 'admin\AdminController@editCategories');
	Route::get('/edit-save-more-categories/{id}', 'admin\AdminController@editSaveMoreCategories');
	Route::get('/edit-covid-categories/{id}', 'admin\AdminController@editCovidCategories');

	Route::get('/delete-categories/{id}', 'admin\AdminController@deleteCategories');
	Route::post('/categories-submit', 'admin\AdminController@categoriesSubmit');
	Route::get('toggle-categories-status/{status}/{id}', 'admin\AdminController@toggleCategoriesActiveStatus');


	Route::get('/add-sub-categories', 'admin\AdminController@addSubCategories');
	Route::get('/view-sub-categories', 'admin\AdminController@viewSubCategories');
	Route::get('/edit-sub-categories/{id}', 'admin\AdminController@editSubCategories');
	Route::get('/delete-sub-categories/{id}', 'admin\AdminController@deleteSubCategories');
	Route::post('/sub-categories-submit', 'admin\AdminController@subCategoriesSubmit');
	Route::get('toggle-sub-categories-status/{status}/{id}', 'admin\AdminController@toggleSubCategoriesActiveStatus');


	Route::get('/add-user-categories', 'admin\AdminController@addUserCategories');
	Route::get('/view-user-categories', 'admin\AdminController@viewUserCategories');
	Route::get('/edit-user-categories/{id}', 'admin\AdminController@editUserCategories');
	Route::get('/delete-user-categories/{id}', 'admin\AdminController@deleteUserCategories');
	Route::post('/user-categories-submit', 'admin\AdminController@userCategoriesSubmit');
	Route::get('toggle-user-categories-status/{status}/{id}', 'admin\AdminController@toggleUserCategoriesActiveStatus');


	Route::get('/add-user-sub-categories', 'admin\AdminController@addUserSubCategories');
	Route::get('/view-user-sub-categories', 'admin\AdminController@viewUserSubCategories');
	Route::get('/edit-user-sub-categories/{id}', 'admin\AdminController@editUserSubCategories');
	Route::get('/delete-user-sub-categories/{id}', 'admin\AdminController@deleteUserSubCategories');
	Route::post('/user-sub-categories-submit', 'admin\AdminController@userSubCategoriesSubmit');
	Route::get('toggle-user-sub-categories-status/{status}/{id}', 'admin\AdminController@toggleUserSubCategoriesActiveStatus');

	Route::get('/add-banner', 'admin\AdminController@addBanner');
	Route::get('/view-banner', 'admin\AdminController@viewBanner');
	Route::get('/edit-banner/{id}', 'admin\AdminController@editBanner');
	Route::get('/delete-banner/{id}', 'admin\AdminController@deleteBanner');
	Route::post('/banner-submit', 'admin\AdminController@bannerSubmit');
	Route::get('toggle-banner-status/{status}/{id}', 'admin\AdminController@toggleBannerActiveStatus');
	 
    Route::get('/add-coupon', 'admin\AdminController@addCoupon');
    Route::get('/view-coupon', 'admin\AdminController@viewCoupon');
    Route::get('/edit-coupon/{id}', 'admin\AdminController@editCoupon');
    Route::get('/delete-coupon/{id}', 'admin\AdminController@deleteCoupon');
    Route::post('/coupon-submit', 'admin\AdminController@couponSubmit');
    Route::get('toggle-coupon-status/{status}/{id}', 'admin\AdminController@toggleCouponActiveStatus');
    

	Route::get('/add-role', 'admin\AdminController@addRole');
	Route::get('/view-role', 'admin\AdminController@viewRole');
	Route::get('/edit-role/{id}', 'admin\AdminController@editRole');
	Route::get('/delete-role/{id}', 'admin\AdminController@deleteRole');
	Route::post('/role-submit', 'admin\AdminController@roleSubmit');
	Route::get('toggle-role-status/{status}/{id}', 'admin\AdminController@toggleRoleActiveStatus');

	Route::get('/add-language', 'admin\AdminController@addLanguage');
	Route::get('/view-language', 'admin\AdminController@viewLanguage');
	Route::get('/edit-language/{id}', 'admin\AdminController@editLanguage');
	Route::get('/delete-language/{id}', 'admin\AdminController@deleteLanguage');
	Route::post('/language-submit', 'admin\AdminController@languageSubmit');
	Route::get('toggle-language-status/{status}/{id}', 'admin\AdminController@toggleLanguageActiveStatus');

	Route::get('/add-user-details', 'admin\AdminController@addUserDetails');
	Route::get('/view-user-details/{id}', 'admin\AdminController@viewUserDetails');
	Route::get('/edit-user-details/{id}', 'admin\AdminController@editUserDetails');
	Route::get('/delete-user-details/{id}', 'admin\AdminController@deleteUserDetails');
	Route::post('/user-details-submit', 'admin\AdminController@userDetailsSubmit');
	Route::get('toggle-user-details-status/{status}/{id}', 'admin\AdminController@toggleUserDetailsActiveStatus');

	Route::get('/profile', 'admin\AdminController@adminProfile');
	Route::post('/profile', 'admin\AdminController@editProfile');

	// user data route
	Route::get('/view-user-data', 'admin\UserController@viewUserData');
	Route::get('/delete-user-data/{id}', 'admin\UserController@deleteUserData');
	Route::get('block-account/{id}','admin\UserController@blockAccount');
	Route::get('un-block-account/{id}','admin\UserController@unBlockAccount');
    Route::get('approval/{id}','admin\UserController@approvenow'); 
	Route::get('/view-contact-us-detail', 'admin\UserController@viewContactUsFormDetail');
	Route::get('/view-news-letter-detail', 'admin\UserController@viewNewsLatterDetail');

	Route::get('/add-vendors', 'admin\VendorController@addVendors');
	Route::get('/view-vendors', 'admin\VendorController@viewVendors');
	Route::get('/edit-vendors/{id}', 'admin\VendorController@editVendors');
	Route::get('/delete-vendors/{id}', 'admin\VendorController@deleteVendors');
	Route::post('/vendors-submit', 'admin\VendorController@vendorsSubmit');
	Route::get('toggle-vendors-status/{status}/{id}', 'admin\VendorController@toggleVendorsActiveStatus');
	
	Route::get('/add-delivery-boy', 'admin\DeliveryBoyController@addDeliveryBoy');
	Route::get('/view-delivery-boy', 'admin\DeliveryBoyController@viewDeliveryBoy');
	Route::get('/edit-delivery-boy/{id}', 'admin\DeliveryBoyController@editDeliveryBoy');
	Route::get('/delete-delivery-boy/{id}', 'admin\DeliveryBoyController@deleteDeliveryBoy');
	Route::post('/delivery-boy-submit', 'admin\DeliveryBoyController@deliveryBoySubmit');
	Route::get('toggle-delivery-boy-status/{status}/{id}', 'admin\DeliveryBoyController@toggleDeliveryBoyActiveStatus');


	Route::get('/add-blogs', 'admin\VendorController@addBlogs');
	Route::get('/view-blogs', 'admin\VendorController@viewBlogs');
	Route::get('/edit-blogs/{id}', 'admin\VendorController@editBlogs');
	Route::get('/delete-blogs/{id}', 'admin\VendorController@deleteBlogs');
	Route::post('/blogs-submit', 'admin\VendorController@blogsSubmit');
	Route::get('toggle-blogs-status/{status}/{id}', 'admin\VendorController@toggleBlogsActiveStatus');

	Route::get('/add-product', 'admin\VendorController@addProduct');
	Route::get('/view-product', 'admin\VendorController@viewProduct');
	Route::get('/product/in-stock/{id}', 'admin\VendorController@inStock');
	Route::get('/edit-product/{id}', 'admin\VendorController@editProduct');
	Route::get('/delete-product/{id}', 'admin\VendorController@deleteProduct');
	Route::post('/products-submit', 'admin\VendorController@productSubmit');
	Route::get('toggle-product-status/{status}/{id}', 'admin\VendorController@toggleProductActiveStatus');
	Route::get('/delete-product-images/{id}', 'admin\VendorController@deleteProductImages');
	Route::get('/view-product-review', 'admin\VendorController@viewProductReview');
	Route::post('/save-product-review', 'admin\VendorController@saveProductReview');

	// Product Attributes
	Route::get('/add-product-attributes/{products_id}', 'admin\VendorController@addProductattribute');
	Route::get('/product-attribute-list/{products_id}', 'admin\VendorController@viewProductattribute');
    Route::post('/products-attribute-submit', 'admin\VendorController@productattributeSubmit');
	Route::get('/edit-product-attribute/{id}/{products_id}', 'admin\VendorController@editProductattribute');
	Route::get('/delete-product-attribute/{id}', 'admin\VendorController@deleteProductattribute');
	Route::get('toggle-product-attribute-status/{status}/{id}', 'admin\VendorController@toggleProduct_attr_ActiveStatus');
	Route::post('/products-attribute-update', 'admin\VendorController@productattributeupdate');

	//assign barcode

	Route::get('/assign_barcode', 'admin\VendorController@assign_barcode');

	Route::get('/add-location', 'admin\VendorController@addLocation');
	Route::get('/view-location', 'admin\VendorController@viewLocation');
	Route::get('/edit-location/{id}', 'admin\VendorController@editLocation');
	Route::get('/delete-location/{id}', 'admin\VendorController@deleteLocation');
	Route::post('/location-submit', 'admin\VendorController@locationSubmit');
	Route::get('toggle-location-status/{status}/{id}', 'admin\VendorController@toggleLocationActiveStatus');
	
	Route::get('/view-lab-location', 'admin\VendorController@viewLabLocation');
	Route::get('/add-lab-location', 'admin\VendorController@addLabLocation');
	Route::post('/lab-location-submit', 'admin\VendorController@LabLocationSubmit');
	Route::get('/edit-lab-location/{id}', 'admin\VendorController@editLabLocation');
	Route::get('/delete-lab-location/{id}', 'admin\VendorController@deleteLabLocation');
	Route::get('toggle-lab-location-status/{status}/{id}', 'admin\VendorController@toggleLabLocationActiveStatus');

	Route::get('/add-testimonials', 'admin\VendorController@addTestimonial');
	Route::get('/view-testimonials', 'admin\VendorController@viewTestimonial');
	Route::get('/edit-testimonials/{id}', 'admin\VendorController@editTestimonial');
	Route::get('/delete-testimonials/{id}', 'admin\VendorController@deleteTestimonial');
	Route::post('/testimonials-submit', 'admin\VendorController@testimonialSubmit');
	Route::get('toggle-testimonials-status/{status}/{id}', 'admin\VendorController@toggleTestimonialActiveStatus');

	Route::get('/add-packages', 'admin\VendorController@addPackages');
	Route::get('/view-packages', 'admin\VendorController@viewPackages');
	Route::get('/edit-packages/{id}', 'admin\VendorController@editPackages');
	Route::get('/delete-packages/{id}', 'admin\VendorController@deletePackages');
	Route::post('/packages-submit', 'admin\VendorController@packagessubmit');
	Route::get('toggle-packages-status/{status}/{id}', 'admin\VendorController@togglePackagesActiveStatus');
	Route::get('package-status/{status}/{id}', 'admin\VendorController@popularPackageCreate');

	Route::get('/labs', 'admin\LabsController@labs');

	Route::get('/add-brand', 'admin\VendorController@addBrand');
	Route::get('/view-brand', 'admin\VendorController@viewBrand');
	Route::get('/edit-brand/{id}', 'admin\VendorController@editBrand');
	Route::get('/delete-brand/{id}', 'admin\VendorController@deleteBrand');
	Route::post('/brand-submit', 'admin\VendorController@brandSubmit');
	Route::get('toggle-brand-status/{status}/{id}', 'admin\VendorController@toggleBrandActiveStatus'); 
	Route::get('show-brand-home-page/{status}/{id}', 'admin\VendorController@homePageBrandShow');

	// order related routes in admin
	Route::get('/view-order', 'admin\OrderController@viewOrder');
	Route::get('/view-order-tester', 'admin\OrderController@viewOrderTester');
	Route::get('/view-order-details/{id}', 'admin\OrderController@viewOrderDetail');
	Route::get('/view-order-details-tester/{id}', 'admin\OrderController@viewOrderDetailTester');
	Route::post('/order-status-change', 'admin\OrderController@orderStatusUpdate');
	Route::post('/order-status-cancle', 'admin\OrderController@orderStatuscancle');
	Route::post('/vendor-assign', 'admin\OrderController@vendorAssign');
	Route::post('/delivery-boy-assign', 'admin\OrderController@deliveryBoyAssign');


	Route::post('import', 'admin\ExcelController@importproduct')->name('import');
    //start social icon route 
	Route::get('edit-social-icon', 'admin\VendorController@editSocialIcon');
	Route::post('update-social-icon', 'admin\VendorController@updateSocialIcon'); 
	//end social icon route 
    Route::post('testing-report-submit','admin\OrderController@testingReportUploaded');
    Route::post('awb-number-update','admin\OrderController@awbNumberUpdate');
	//
	Route::get('edit-header-marquee/{id}', 'admin\AdminController@editHeaderMarquee');
	Route::post('update-header-marquee', 'admin\AdminController@editHeaderMarqueeSubmit'); 

	//review 
	Route::get('view-review', 'admin\AdminController@viewReview');
	Route::post('reply-review', 'admin\AdminController@viewReplyReview');
	Route::post('save-reply-review', 'admin\AdminController@saveReplyReview');
	Route::post('edit-review', 'admin\AdminController@editReplyReview');
	Route::post('save-edit-review', 'admin\AdminController@saveEditReview');
	Route::get('/delete-review/{id}', 'admin\AdminController@deleteReview');
	
	//prescription 
	Route::get('view-prescription', 'admin\AdminController@viewPrescription');
	Route::post('toggle-prescription-status/{status}/{id}/{user_id}', 'admin\AdminController@toggleprescriptionActiveStatus');
	
	Route::post('generate-slug', 'admin\AdminController@generateSlug');

    //start social icon route 
	Route::get('get-shipping-settings', 'admin\VendorController@getShippingSettings');
	Route::post('update-shipping-settings', 'admin\VendorController@updateShippingSettings'); 

	//size list
	Route::get('get-size-list', 'admin\VendorController@size_list');
	Route::get('add-size', 'admin\VendorController@add_size');
	Route::post('save-size', 'admin\VendorController@save_size');
	Route::get('edit-size/{id}', 'admin\VendorController@edit_size');
	Route::post('update-size', 'admin\VendorController@update_size');
	Route::get('delete-size/{id}', 'admin\VendorController@delete_size');

	
	Route::get('csv_file/export', 'admin\AdminController@export')->name('export'); 

		// new code rahul
		Route::get('add_shop', 'admin\AdminController@add_shop');
		Route::post('submit_shop', 'admin\AdminController@submit_shop');
		Route::get('add_shop_manager', 'admin\AdminController@addshopmanager');
		Route::post('add-shop-manager', 'admin\AdminController@add_shop_manager');
		// new new code 
		Route::post('submit-shop-manager', 'admin\AdminController@submit_shop_manager');


		// =================
		Route::get('delete-shop/{shop_id}', 'admin\AdminController@delete_shop');
		Route::get('increment_tax', 'admin\AdminController@Increment_Tax');
		// =============================================================
		Route::post('month-increment_tax', 'admin\AdminController@Month_Increment_Tax');		
		// =============================================================

		Route::get('add_stock_manager', 'admin\AdminController@add_stock_manager');
		Route::post('submit_stock_manager', 'admin\AdminController@submit_stock_manager');
		Route::get('get-stock-manager-detail/{user_id}', 'admin\AdminController@get_stock_manager_detail');
		Route::post('update-stock-manager', 'admin\AdminController@update_stock_manager');
		Route::get('delete-stock-manager/{shop_id}', 'admin\AdminController@delete_stock_manager');

		Route::get('get-shop-detail/{shop_id}', 'admin\AdminController@get_shop_detail');
		Route::post('update-shop-info', 'admin\AdminController@update_shop_info');

		Route::get('delete-shop-stock/{stock_id}', 'admin\AdminController@delete_shop_stock');
		Route::get('add_stock', 'admin\AdminController@add_stock');
		Route::post('submit-stock', 'admin\AdminController@submit_stock');
		Route::get('Fetch-Attibutes/{id}', 'admin\VendorController@fetch_attributes');
		

});



Route::group(['middleware' => 'IsProduct'], function () {
    Route::get('{slug}', 'UI\MainController@productDetailSlug')->name('slug');
});


Route::get('category/{slug}/{slug1?}/{slug2?}/{slug3?}', 'UI\MainController@productFilterSlug')->name('cat');
Route::post('category/{slug}/{slug1?}/{slug2?}/{slug3?}', 'UI\MainController@productFilterSlug')->name('cat');
Route::get('blogs/{slug}', 'UI\MainController@blogDetailsSlug')->name('slug');
Route::get('packages/{slug}','UI\LabTestController@packageDetailSlug');

//
Route::post('share/product','UI\UserController@createShareLink');
