<?php
// if(file_exists(storage_path('installed'))){
// 	$check = DB::table('settings')->where('id', 94)->first();
// 	if($check->value == 'Maintenance'){
// 		$middleware = ['installer','env'];
// 	}
// 	else{
// 		$middleware = ['installer'];
// 	}
// }
// else{
// 	$middleware = ['installer'];
// }
Route::get('/maintance','Web\IndexController@maintance');

Route::group(['namespace' => 'Web'], function () {
	Route::get('/login', 'CustomersController@login');
	Route::post('/process-login', 'CustomersController@processLogin');
	Route::post('/forgetPasswordOtp','CustomersController@forgetPasswordOtp');
	Route::post('/forgetPasswordOtpVerify','CustomersController@forgetPasswordOtpVerify');
	Route::post('/processPassword','CustomersController@processPassword');
	Route::post('/signupBefore','CustomersController@signupBefore');
	Route::post('/process-signup', 'CustomersController@processSignup');
	// Route::post('/validate-otp', 'CustomersController@validateOtp');
	//Route::get('/logout', 'CustomersController@logout')->middleware('Customer');
	Route::get('/logout', 'CustomersController@logout');

	Route::get('login/{social}', 'CustomersController@socialLogin');
	Route::get('login/{social}/callback', 'CustomersController@handleSocialLoginCallback');
});
Route::group(['namespace' => 'Web'], function () {
	Route::get('general_error/{msg}', function($msg) {
		return view('errors.general_error',['msg' => $msg]);
	});

	Route::get('/','IndexController@index');
	Route::post('/pincodesByCity','IndexController@pincodesByCity');
	Route::post('/checkPincodeExist','IndexController@checkPincodeExist');

	Route::get('/shop', 'ProductsController@shop');	
	Route::get('/product-detail/{products_id}', 'ProductsController@productDetail');
	Route::post('/reviews', 'ProductsController@reviews')->middleware('WebCustomer');
	Route::post('/getquantity', 'ProductsController@getquantity');

	Route::get('/viewcart', 'CartController@viewcart')->middleware('WebCustomer');
	Route::post('/addToCart', 'CartController@addToCart')->middleware('WebCustomer');
	Route::post('/updateCartQuantity', 'CartController@updateCartQuantity');
	Route::get('/deleteCart', 'CartController@deleteCart');
	Route::post('/apply_coupon', 'CartController@apply_coupon');
	Route::get('/removeCoupon/{id}', 'CartController@removeCoupon')->middleware('WebCustomer');

	Route::get('/checkout', 'OrdersController@checkout')->middleware('WebCustomer');
	Route::post('/session_address', 'OrdersController@session_address');
	Route::post('/cashOnDeliveryOrder', 'OrdersController@cashOnDeliveryOrder');

	Route::post('/onlineOrderPayment','OrdersController@onlineOrderPayment');
	Route::post('/onlinePaymentReturn','OrdersController@onlinePaymentReturn');

	Route::get('/orders', 'OrdersController@orders')->middleware('WebCustomer');
	Route::post('/updateOrderProductStatus', 'OrdersController@updateOrderProductStatus')->middleware('WebCustomer');
	Route::post('/updateOrderStatus', 'OrdersController@updateOrderStatus')->middleware('WebCustomer');
	Route::get('/orderInvoice/{id}', 'OrdersController@orderInvoice')->middleware('WebCustomer');

	Route::get('/wishlist', 'CustomersController@wishlist')->middleware('WebCustomer');
	Route::get('/myAddress', 'CustomersController@myAddress');
	Route::post('/pincodeList', 'CustomersController@pincodeList');
	Route::post('/addAddress', 'CustomersController@addAddress');
	Route::post('/updateaddress','CustomersController@updateaddress');
	Route::get('/deleteaddress','CustomersController@deleteaddress');
	Route::get('/profile', 'CustomersController@profile')->middleware('WebCustomer');
	Route::get('/corporateRequest', 'CustomersController@corporateRequest')->middleware('WebCustomer');
	Route::get('/updateCorporateRequest', 'CustomersController@updateCorporateRequest');
	Route::post('/updateMyProfile', 'CustomersController@updateMyProfile');
	Route::post('/addWishlistWeb', 'CustomersController@addWishlistWeb');
	Route::get('/kycList', 'CustomersController@kycList')->middleware('WebCustomer');
	Route::post('/addKyc','CustomersController@addKyc');
	Route::get('/discountedCategory', 'CustomersController@discountedCategory')->middleware('WebCustomer');

	Route::post('/addProductEnquiry', 'CustomersController@addProductEnquiry');

	Route::get('/contactUs', 'IndexController@contactUs');
	Route::post('/contactOtpSend','IndexController@contactOtpSend');
	Route::post('/contactUsMail','IndexController@contactUsMail');
	Route::get('/aboutUs', 'IndexController@aboutUs');
	Route::get('/sellerBenefits', 'IndexController@sellerBenefits');
	Route::get('/corporateLoginBenefits', 'IndexController@corporateLoginBenefits');
	Route::get('/termAndCondition', 'IndexController@termAndCondition');
	Route::get('/privacyPolicy', 'IndexController@privacyPolicy');
	Route::get('/faq', 'IndexController@faq');
	Route::post('/sellOnSupportstock','IndexController@sellOnSupportstock');

	Route::get('/todaysCoupon', 'IndexController@todaysCoupon');

	Route::get('/payments', 'IndexController@payments');
	Route::get('/shipping', 'IndexController@shipping');
	Route::get('/cancellation_returns', 'IndexController@cancellation_returns');
	Route::get('/refunds', 'IndexController@refunds');
	Route::get('/return_policy', 'IndexController@return_policy');
	Route::get('/security', 'IndexController@security');
	Route::get('/customer_service', 'IndexController@customer_service');
	Route::get('/copyright', 'IndexController@copyright');

	
});

	//Route::get('/test', 'Web\IndexController@test1');

