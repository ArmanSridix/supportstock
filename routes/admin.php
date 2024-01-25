<?php

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    // $exitCode = Artisan::call('config:cache');
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::group(['middleware' => ['installer']], function () {
    Route::get('/not_allowed', function () {
        return view('errors.not_found');
    });
    Route::group(['namespace' => 'AdminControllers', 'prefix' => 'admin'], function () {
        Route::get('/login', 'AdminController@login');
        Route::post('/checkLogin', 'AdminController@checkLogin');
    });

    Route::get('/home', function () {
        return redirect('/admin/languages/display');
    });
    Route::group(['namespace' => 'AdminControllers', 'middleware' => 'auth', 'prefix' => 'admin'], function () {
        Route::post('webPagesSettings/changestatus', 'ThemeController@changestatus');
        Route::post('webPagesSettings/setting/set', 'ThemeController@set');
        Route::post('webPagesSettings/reorder', 'ThemeController@reorder');
        Route::get('/home', function () {
            return redirect('/dashboard/{reportBase}');
        });
        Route::get('/generateKey', 'SiteSettingController@generateKey');

        //log out
        Route::get('/logout', 'AdminController@logout');
        Route::get('/webPagesSettings/{id}', 'ThemeController@index2');

        Route::get('/topoffer/display', 'ThemeController@topoffer');
        Route::post('/topoffer/update', 'ThemeController@updateTopOffer');
        

        Route::get('/dashboard/{reportBase}', 'AdminController@dashboard');
        //add adddresses against customers
        Route::get('/addaddress/{id}/', 'CustomersController@addaddress')->middleware('add_customer');
        Route::post('/addNewCustomerAddress', 'CustomersController@addNewCustomerAddress')->middleware('add_customer');
        Route::post('/editAddress', 'CustomersController@editAddress')->middleware('edit_customer');
        Route::post('/updateAddress', 'CustomersController@updateAddress')->middleware('edit_customer');
        Route::post('/deleteAddress', 'CustomersController@deleteAddress')->middleware('delete_customer');
        Route::post('/getZones', 'AddressController@getzones');

        //sliders
        Route::get('/sliders', 'AdminSlidersController@sliders')->middleware('edit_web_setting');
        Route::get('/addsliderimage', 'AdminSlidersController@addsliderimage')->middleware('edit_web_setting');
        Route::post('/addNewSlide', 'AdminSlidersController@addNewSlide')->middleware('edit_web_setting');
        Route::get('/editslide/{id}', 'AdminSlidersController@editslide')->middleware('edit_web_setting');
        Route::post('/updateSlide', 'AdminSlidersController@updateSlide')->middleware('edit_web_setting');
        Route::post('/deleteSlider/', 'AdminSlidersController@deleteSlider')->middleware('edit_web_setting');

        //constant banners
        Route::get('/constantbanners', 'AdminConstantController@constantBanners')->middleware('edit_web_setting');
        Route::get('/addconstantbanner', 'AdminConstantController@addconstantBanner')->middleware('edit_web_setting');
        Route::post('/addNewConstantBanner', 'AdminConstantController@addNewconstantBanner')->middleware('edit_web_setting');
        Route::get('/editconstantbanner/{id}', 'AdminConstantController@editconstantbanner')->middleware('edit_web_setting');
        Route::post('/updateconstantBanner', 'AdminConstantController@updateconstantBanner')->middleware('edit_web_setting');
        Route::post('/deleteconstantBanner/', 'AdminConstantController@deleteconstantBanner')->middleware('edit_web_setting');

        Route::get('/frontCategory', 'AdminConstantController@frontCategory')->middleware('edit_web_setting');
        Route::post('/updateFrontCategory', 'AdminConstantController@updateFrontCategory')->middleware('edit_web_setting');

        Route::get('/frontProductCategory', 'AdminConstantController@frontProductCategory')->middleware('edit_web_setting');
        Route::post('/updateFrontProductCategory', 'AdminConstantController@updateFrontProductCategory')->middleware('edit_web_setting');

        //web contact us
        Route::get('/editContactUs', 'AdminController@editContactUs')->middleware('view_cms');
        Route::post('/updateContactUs', 'AdminController@updateContactUs')->middleware('update_cms');

        //web about us
        Route::get('/editAboutUs', 'AdminController@editAboutUs')->middleware('view_cms');
        Route::post('/updateAboutUs', 'AdminController@updateAboutUs')->middleware('update_cms');

         //web Seller Benefit's
         Route::get('/editSellerBenefits', 'AdminController@editSellerBenefits')->middleware('view_cms');
         Route::post('/updateSellerBenefits', 'AdminController@updateSellerBenefits')->middleware('update_cms');

         //web Corporate Login Benefit's
         Route::get('/editCorporateLoginBenefits', 'AdminController@editCorporateLoginBenefits')->middleware('view_cms');
         Route::post('/updateCorporateLoginBenefits', 'AdminController@updateCorporateLoginBenefits')->middleware('update_cms');

        //web TERMS & CONDITIONS
        Route::get('/editTermsAndConditions', 'AdminController@editTermsAndConditions')->middleware('view_cms');
        Route::post('/updateTermsAndConditions', 'AdminController@updateTermsAndConditions')->middleware('update_cms');

        //web PRIVACY POLICY
        Route::get('/editPrivacyPolicy', 'AdminController@editPrivacyPolicy')->middleware('view_cms');
        Route::post('/updatePrivacyPolicy', 'AdminController@updatePrivacyPolicy')->middleware('update_cms');

        //web faq
        Route::get('/displayFaq', 'AdminController@displayFaq')->middleware('view_cms');
        Route::get('/addFaq', 'AdminController@addFaq')->middleware('create_cms');
        Route::post('/insertFaq', 'AdminController@insertFaq')->middleware('create_cms');
        Route::get('/editFaq/{faq_id}', 'AdminController@editFaq')->middleware('update_cms');
        Route::post('/updateFaq', 'AdminController@updateFaq')->middleware('update_cms');
        Route::post('/faqDelete', 'AdminController@faqDelete')->middleware('delete_cms');

        //web payment
        Route::get('/editPayment', 'AdminController@editPayment')->middleware('view_cms');
        Route::post('/updatePayment', 'AdminController@updatePayment')->middleware('update_cms');

        //web Shipping
        Route::get('/editShipping', 'AdminController@editShipping')->middleware('view_cms');
        Route::post('/updateShipping', 'AdminController@updateShipping')->middleware('update_cms');

        //web Cancellation & Returns
        Route::get('/editCancelReturn', 'AdminController@editCancelReturn')->middleware('view_cms');
        Route::post('/updateCancelReturn', 'AdminController@updateCancelReturn')->middleware('update_cms');

        //web Refunds
        Route::get('/editRefunds', 'AdminController@editRefunds')->middleware('view_cms');
        Route::post('/updateRefunds', 'AdminController@updateRefunds')->middleware('update_cms');

        //web Return Policy
        Route::get('/editReturnPolicy', 'AdminController@editReturnPolicy')->middleware('view_cms');
        Route::post('/updateReturnPolicy', 'AdminController@updateReturnPolicy')->middleware('update_cms');

        //web Security
        Route::get('/editSecurity', 'AdminController@editSecurity')->middleware('view_cms');
        Route::post('/updateSecurity', 'AdminController@updateSecurity')->middleware('update_cms');

        //web Customer Service
        Route::get('/editCustomerService', 'AdminController@editCustomerService')->middleware('view_cms');
        Route::post('/updateCustomerService', 'AdminController@updateCustomerService')->middleware('update_cms');

        //web Copyright
        Route::get('/editCopyright', 'AdminController@editCopyright')->middleware('view_cms');
        Route::post('/updateCopyright', 'AdminController@updateCopyright')->middleware('update_cms');



        Route::get('/contactComment', 'AdminController@contactComment')->middleware('view_contact_comment');
        Route::post('/contactCommentDelete', 'AdminController@contactCommentDelete')->middleware('delete_contact_comment');

        Route::get('/productEnquiry', 'AdminController@productEnquiry')->middleware('view_product_enquery');

        Route::get('/sellOnSupportStock', 'AdminController@sellOnSupportStock')->middleware('view_sell_on_ss');

        //ss assured logo
        Route::get('/editAssuredLogo', 'AdminController@editAssuredLogo')->middleware('view_assured_logo');
        Route::post('/updateAssuredLogo', 'AdminController@updateAssuredLogo')->middleware('update_assured_logo');

        //invoice logo
        Route::get('/invoiceLogo', 'AdminController@invoiceLogo')->middleware('view_assured_logo');
        Route::post('/updateInvoiceLogo', 'AdminController@updateInvoiceLogo')->middleware('update_assured_logo');
    });

    Route::group(['prefix' => 'admin/languages', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'LanguageController@display')->middleware('view_language');
        Route::post('/default', 'LanguageController@default')->middleware('edit_language');
        Route::get('/add', 'LanguageController@add')->middleware('add_language');
        Route::post('/add', 'LanguageController@insert')->middleware('add_language');
        Route::get('/edit/{id}', 'LanguageController@edit')->middleware('edit_language');
        Route::post('/update', 'LanguageController@update')->middleware('edit_language');
        Route::post('/delete', 'LanguageController@delete')->middleware('delete_language');
        Route::get('/filter', 'LanguageController@filter')->middleware('view_language');

    });

    Route::group(['prefix' => 'admin/media', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'MediaController@display')->middleware('view_media');
        Route::get('/add', 'MediaController@add')->middleware('add_media');
        Route::post('/updatemediasetting', 'MediaController@updatemediasetting')->middleware('edit_media');
        Route::post('/uploadimage', 'MediaController@fileUpload')->middleware('add_media');
        Route::post('/delete', 'MediaController@deleteimage')->middleware('delete_media');
        Route::get('/detail/{id}', 'MediaController@detailimage')->middleware('view_media');
        Route::get('/refresh', 'MediaController@refresh');
        Route::post('/regenerateimage', 'MediaController@regenerateimage')->middleware('add_media');
    });

    /************** city ***************/
    Route::group(['prefix' => 'admin/city', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CityController@display')->middleware('view_city');
        Route::get('/add', 'CityController@add')->middleware('create_city');
        Route::post('/add', 'CityController@insert')->middleware('create_city');
        Route::get('/edit/{id}', 'CityController@edit')->middleware('update_city');
        Route::post('/update', 'CityController@update')->middleware('update_city');
        Route::post('/delete', 'CityController@delete')->middleware('delete_city');
        Route::get('/filter', 'CityController@filter')->middleware('view_city');

    });
    /*************** city **************/

    /************** pincode ***************/
    Route::group(['prefix' => 'admin/pincode', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'PincodeController@display')->middleware('view_pincode');
        Route::get('/add', 'PincodeController@add')->middleware('create_pincode');
        Route::post('/add', 'PincodeController@insert')->middleware('create_pincode');
        Route::get('/edit/{id}', 'PincodeController@edit')->middleware('update_pincode');
        Route::post('/update', 'PincodeController@update')->middleware('update_pincode');
        Route::post('/delete', 'PincodeController@delete')->middleware('delete_pincode');
        Route::get('/filter', 'PincodeController@filter')->middleware('view_pincode');

    });
    /*************** pincode **************/

    Route::group(['prefix' => 'admin/theme', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/setting', 'ThemeController@index');
        Route::get('/setting/{id}', 'ThemeController@moveToBanners');
        Route::get('/setting/carousals/{id}', 'ThemeController@moveToSliders');
        Route::post('setting/set', 'ThemeController@set');
        Route::post('setting/setPages', 'ThemeController@setPages');
        Route::post('/setting/updatebanner', 'ThemeController@updatebanner');
        Route::post('/setting/carousals/updateslider', 'ThemeController@updateslider');
        Route::post('/setting/addbanner', 'ThemeController@addbanner');
        Route::post('/reorder', 'ThemeController@reorder');
        Route::post('/setting/changestatus', 'ThemeController@changestatus');
        Route::post('/setting/fetchlanguages', 'LanguageController@fetchlanguages')->middleware('view_language');

    });

    Route::group(['prefix' => 'admin/manufacturers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ManufacturerController@display')->middleware('view_manufacturer');
        Route::get('/add', 'ManufacturerController@add')->middleware('add_manufacturer');
        Route::post('/add', 'ManufacturerController@insert')->middleware('add_manufacturer');
        Route::get('/edit/{id}', 'ManufacturerController@edit')->middleware('edit_manufacturer');
        Route::post('/update', 'ManufacturerController@update')->middleware('edit_manufacturer');
        Route::post('/delete', 'ManufacturerController@delete')->middleware('delete_manufacturer');
        Route::get('/filter', 'ManufacturerController@filter')->middleware('view_manufacturer');
        Route::post('/pincodeByCity', 'ManufacturerController@pincodeByCity');
        Route::post('/pincodeByCityEdit', 'ManufacturerController@pincodeByCityEdit');
    });

    Route::group(['prefix' => 'admin/newscategories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NewsCategoriesController@display')->middleware('view_news');
        Route::get('/add', 'NewsCategoriesController@add')->middleware('add_news');
        Route::post('/add', 'NewsCategoriesController@insert')->middleware('add_news');
        Route::get('/edit/{id}', 'NewsCategoriesController@edit')->middleware('edit_news');
        Route::post('/update', 'NewsCategoriesController@update')->middleware('edit_news');
        Route::post('/delete', 'NewsCategoriesController@delete')->middleware('delete_news');
        Route::get('/filter', 'NewsCategoriesController@filter')->middleware('view_news');
    });

    Route::group(['prefix' => 'admin/news', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NewsController@display')->middleware('view_news');
        Route::get('/add', 'NewsController@add')->middleware('add_news');
        Route::post('/add', 'NewsController@insert')->middleware('add_news');
        Route::get('/edit/{id}', 'NewsController@edit')->middleware('edit_news');
        Route::post('/update', 'NewsController@update')->middleware('edit_news');
        Route::post('/delete', 'NewsController@delete')->middleware('delete_news');
        Route::get('/filter', 'NewsController@filter')->middleware('view_news');
    });

    Route::group(['prefix' => 'admin/categories', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CategoriesController@display')->middleware('view_categories');
        Route::get('/add', 'CategoriesController@add')->middleware('add_categories');
        Route::post('/add', 'CategoriesController@insert')->middleware('add_categories');
        Route::get('/edit/{id}', 'CategoriesController@edit')->middleware('edit_categories');
        Route::post('/update', 'CategoriesController@update')->middleware('edit_categories');
        Route::post('/delete', 'CategoriesController@delete')->middleware('delete_categories');
        Route::get('/filter', 'CategoriesController@filter')->middleware('view_categories');
        Route::get('/editAdds/{id}', 'CategoriesController@editAdds')->middleware('edit_categories');
        Route::post('/updateAdds', 'CategoriesController@updateAdds')->middleware('edit_categories');
        Route::post('/updateSortOrder', 'CategoriesController@updateSortOrder')->name('updateSortOrder')->middleware('edit_categories');
    });

    Route::group(['prefix' => 'admin/currencies', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CurrencyController@display')->middleware('view_general_setting');
        Route::get('/add', 'CurrencyController@add')->middleware('edit_general_setting');
        Route::post('/add', 'CurrencyController@insert')->middleware('edit_general_setting');
        Route::get('/edit/{id}', 'CurrencyController@edit')->middleware('edit_general_setting');
        Route::get('/edit/warning/{id}', 'CurrencyController@warningedit')->middleware('edit_general_setting');
        Route::post('/update', 'CurrencyController@update')->middleware('edit_general_setting');
        Route::post('/delete', 'CurrencyController@delete')->middleware('edit_general_setting');

        
    });

    Route::group(['prefix' => 'admin/products', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductController@display')->middleware('view_product');
        Route::get('/add', 'ProductController@add')->middleware('add_product');
        Route::post('/add', 'ProductController@insert')->middleware('add_product');
        Route::get('/edit/{id}', 'ProductController@edit')->middleware('edit_product');
        Route::post('/update', 'ProductController@update')->middleware('edit_product');
        Route::post('/delete', 'ProductController@delete')->middleware('delete_product');
        Route::get('/filter', 'ProductController@filter')->middleware('view_product');
        Route::group(['prefix' => 'inventory'], function () {
            Route::get('/display', 'ProductController@addinventoryfromsidebar')->middleware('view_product');
            // Route::post('/addnewstock', 'ProductController@addinventory')->middleware('view_product');
            Route::get('/ajax_min_max/{id}/', 'ProductController@ajax_min_max')->middleware('view_product');
            Route::get('/ajax_attr/{id}/', 'ProductController@ajax_attr')->middleware('view_product');
            Route::post('/addnewstock', 'ProductController@addnewstock')->middleware('add_product');
            Route::post('/addminmax', 'ProductController@addminmax')->middleware('add_product');
            Route::get('/addproductimages/{id}/', 'ProductController@addproductimages')->middleware('add_product');
        });
        Route::group(['prefix' => 'images'], function () {
            Route::get('/display/{id}/', 'ProductController@displayProductImages')->middleware('view_product');
            Route::get('/add/{id}/', 'ProductController@addProductImages')->middleware('add_product');
            Route::post('/insertproductimage', 'ProductController@insertProductImages')->middleware('add_product');
            Route::get('/editproductimage/{id}', 'ProductController@editProductImages')->middleware('edit_product');
            Route::post('/updateproductimage', 'ProductController@updateproductimage')->middleware('edit_product');
            Route::post('/deleteproductimagemodal', 'ProductController@deleteproductimagemodal')->middleware('edit_product');
            Route::post('/deleteproductimage', 'ProductController@deleteproductimage')->middleware('edit_product');
        });
        Route::group(['prefix' => 'attach/attribute'], function () {
            Route::get('/display/{id}', 'ProductController@addproductattribute')->middleware('view_product');
            Route::group(['prefix' => '/default'], function () {
                Route::post('/', 'ProductController@addnewdefaultattribute')->middleware('view_product');
                Route::post('/edit', 'ProductController@editdefaultattribute')->middleware('edit_product');
                Route::post('/update', 'ProductController@updatedefaultattribute')->middleware('edit_product');
                Route::post('/deletedefaultattributemodal', 'ProductController@deletedefaultattributemodal')->middleware('edit_product');
                Route::post('/delete', 'ProductController@deletedefaultattribute')->middleware('edit_product');
                Route::group(['prefix' => '/options'], function () {
                    Route::post('/add', 'ProductController@showoptions')->middleware('view_product');
                    Route::post('/edit', 'ProductController@editoptionform')->middleware('edit_product');
                    Route::post('/update', 'ProductController@updateoption')->middleware('edit_product');
                    Route::post('/showdeletemodal', 'ProductController@showdeletemodal')->middleware('edit_product');
                    Route::post('/delete', 'ProductController@deleteoption')->middleware('edit_product');
                    Route::post('/getOptionsValue', 'ProductController@getOptionsValue')->middleware('edit_product');
                    Route::post('/currentstock', 'ProductController@currentstock')->middleware('view_product');

                });

            });

        });

    });

    Route::group(['prefix' => 'admin/products/attributes', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductAttributesController@display')->middleware('view_product');
        Route::get('/add', 'ProductAttributesController@add')->middleware('view_product');
        Route::post('/insert', 'ProductAttributesController@insert')->middleware('view_product');
        Route::get('/edit/{id}', 'ProductAttributesController@edit')->middleware('view_product');
        Route::post('/update', 'ProductAttributesController@update')->middleware('view_product');
        Route::post('/delete', 'ProductAttributesController@delete')->middleware('view_product');

        Route::group(['prefix' => 'options/values'], function () {
            Route::get('/display/{id}', 'ProductAttributesController@displayoptionsvalues')->middleware('view_product');
            Route::post('/insert', 'ProductAttributesController@insertoptionsvalues')->middleware('edit_product');
            Route::get('/edit/{id}', 'ProductAttributesController@editoptionsvalues')->middleware('edit_product');
            Route::post('/update', 'ProductAttributesController@updateoptionsvalues')->middleware('edit_product');
            Route::post('/delete', 'ProductAttributesController@deleteoptionsvalues')->middleware('edit_product');
            Route::post('/addattributevalue', 'ProductAttributesController@addattributevalue')->middleware('edit_product');
            Route::post('/updateattributevalue', 'ProductAttributesController@updateattributevalue')->middleware('edit_product');
            Route::post('/checkattributeassociate', 'ProductAttributesController@checkattributeassociate')->middleware('edit_product');
            Route::post('/checkvalueassociate', 'ProductAttributesController@checkvalueassociate')->middleware('edit_product');
        });
    });

    Route::group(['prefix' => 'admin/admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/profile', 'AdminController@profile');
        Route::post('/update', 'AdminController@update');
        Route::post('/updatepassword', 'AdminController@updatepassword');
    });

    Route::group(['prefix' => 'admin/reviews', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ProductController@reviews')->middleware('view_reviews');
        Route::get('/edit/{id}/{status}', 'ProductController@editreviews')->middleware('edit_reviews');

    });
//customers
    Route::group(['prefix' => 'admin/customers', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CustomersController@display')->middleware('view_customer');
        Route::get('/add', 'CustomersController@add')->middleware('add_customer');
        Route::post('/add', 'CustomersController@insert')->middleware('add_customer');
        Route::get('/edit/{id}', 'CustomersController@edit')->middleware('edit_customer');
        Route::post('/update', 'CustomersController@update')->middleware('edit_customer');
        Route::post('/delete', 'CustomersController@delete')->middleware('delete_customer');
        Route::get('/filter', 'CustomersController@filter')->middleware('view_customer');
        Route::get('/viewKyc/{id}', 'CustomersController@viewKyc')->middleware('edit_customer');
        //add adddresses against customers
        Route::get('/address/display/{id}/', 'CustomersController@diplayaddress')->middleware('add_customer');
        Route::post('/addcustomeraddress', 'CustomersController@addcustomeraddress')->middleware('add_customer');
        Route::post('/editaddress', 'CustomersController@editaddress')->middleware('edit_customer');
        Route::post('/updateaddress', 'CustomersController@updateaddress')->middleware('edit_customer');
        Route::post('/deleteAddress', 'CustomersController@deleteAddress')->middleware('edit_customer');

        Route::post('/selectPincodeById', 'CustomersController@selectPincodeById');
    });

    Route::group(['prefix' => 'admin/corporateRequest', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        //Route::get('/display', 'CustomersController@corporateRequest')->middleware('view_corporate_request');
        Route::get('/display', 'CustomersController@corporateRequest')->middleware('view_corp_request');
      
    });

    Route::group(['prefix' => 'admin/countries', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/filter', 'CountriesController@filter')->middleware('view_tax');
        Route::get('/display', 'CountriesController@index')->middleware('view_tax');
        Route::get('/add', 'CountriesController@add')->middleware('add_tax');
        Route::post('/add', 'CountriesController@insert')->middleware('add_tax');
        Route::get('/edit/{id}', 'CountriesController@edit')->middleware('edit_tax');
        Route::post('/update', 'CountriesController@update')->middleware('edit_tax');
        Route::post('/delete', 'CountriesController@delete')->middleware('delete_tax');
    });

    Route::group(['prefix' => 'admin/zones', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'ZonesController@index')->middleware('view_tax');
        Route::get('/filter', 'ZonesController@filter')->middleware('view_tax');
        Route::get('/add', 'ZonesController@add')->middleware('add_tax');
        Route::post('/add', 'ZonesController@insert')->middleware('add_tax');
        Route::get('/edit/{id}', 'ZonesController@edit')->middleware('edit_tax');
        Route::post('/update', 'ZonesController@update')->middleware('edit_tax');
        Route::post('/delete', 'ZonesController@delete')->middleware('delete_tax');
    });

    Route::group(['prefix' => 'admin/tax', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {

        Route::group(['prefix' => '/taxclass'], function () {
            Route::get('/filter', 'TaxController@filtertaxclass')->middleware('view_tax');
            Route::get('/display', 'TaxController@taxindex')->middleware('view_tax');
            Route::get('/add', 'TaxController@addtaxclass')->middleware('add_tax');
            Route::post('/add', 'TaxController@inserttaxclass')->middleware('add_tax');
            Route::get('/edit/{id}', 'TaxController@edittaxclass')->middleware('edit_tax');
            Route::post('/update', 'TaxController@updatetaxclass')->middleware('edit_tax');
            Route::post('/delete', 'TaxController@deletetaxclass')->middleware('delete_tax');
        });

        Route::group(['prefix' => '/taxrates'], function () {
            Route::get('/display', 'TaxController@displaytaxrates')->middleware('view_tax');
            Route::get('/filter', 'TaxController@filtertaxrates')->middleware('view_tax');
            Route::get('/add', 'TaxController@addtaxrate')->middleware('add_tax');
            Route::post('/add', 'TaxController@inserttaxrate')->middleware('add_tax');
            Route::get('/edit/{id}', 'TaxController@edittaxrate')->middleware('edit_tax');
            Route::post('/update', 'TaxController@updatetaxrate')->middleware('edit_tax');
            Route::post('/delete', 'TaxController@deletetaxrate')->middleware('delete_tax');
        });

    });

    Route::group(['prefix' => 'admin/shippingmethods', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        //shipping setting
        Route::get('/display', 'ShippingMethodsController@display')->middleware('view_shipping');
        Route::get('/add', 'ShippingMethodsController@add');
        Route::post('/insert', 'ShippingMethodsController@insert');
        Route::get('/edit/{id}', 'ShippingMethodsController@edit');
        Route::post('/update', 'ShippingMethodsController@update');
        Route::post('/delete', 'ShippingMethodsController@delete');

        // Route::get('/upsShipping', 'ShippingMethodsController@upsShipping')->middleware('view_shipping');
        // Route::post('/updateupsshipping', 'ShippingMethodsController@updateupsshipping')->middleware('edit_shipping');
        // Route::get('/flateRate', 'ShippingMethodsController@flateRate')->middleware('view_shipping');
        // Route::post('/updateflaterate', 'ShippingMethodsController@updateflaterate')->middleware('edit_shipping');
        // Route::post('/defaultShippingMethod', 'ShippingMethodsController@defaultShippingMethod')->middleware('edit_shipping');
        // Route::get('/detail/{table_name}', 'ShippingMethodsController@detail')->middleware('edit_shipping');
        // Route::post('/update', 'ShippingMethodsController@update')->middleware('edit_shipping');

        // Route::get('/shppingbyweight', 'ShippingByWeightController@shppingbyweight')->middleware('view_shipping');
        // Route::post('/updateShppingWeightPrice', 'ShippingByWeightController@updateShppingWeightPrice')->middleware('edit_shipping');

    });

    Route::group(['prefix' => 'admin/paymentmethods', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/index', 'PaymentMethodsController@index')->middleware('view_payment');
        Route::get('/display/{id}', 'PaymentMethodsController@display')->middleware('view_payment');
        Route::post('/update', 'PaymentMethodsController@update')->middleware('edit_payment');
        Route::post('/active', 'PaymentMethodsController@active')->middleware('edit_payment');

        Route::get('/cashOnDelivery', 'PaymentMethodsController@cashOnDelivery')->middleware('view_cod');
        Route::get('/cashOnDelivery/edit/{id}', 'PaymentMethodsController@cashOnDeliveryEdit')->middleware('update_cod');
        Route::post('/updateCashOnDelivery', 'PaymentMethodsController@updateCashOnDelivery')->middleware('update_cod');
    });

    Route::group(['prefix' => 'admin/coupons', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'CouponsController@display')->middleware('view_coupon');
        Route::get('/add', 'CouponsController@add')->middleware('add_coupon');
        Route::post('/insert', 'CouponsController@insert')->middleware('add_coupon');
        Route::get('/edit/{id}', 'CouponsController@edit')->middleware('edit_coupon');
        Route::post('/update', 'CouponsController@update')->middleware('edit_coupon');
        Route::post('/delete', 'CouponsController@delete')->middleware('delete_coupon');
        Route::get('/filter', 'CouponsController@filter')->middleware('view_coupon');

        Route::get('/newUserCoupon', 'CouponsController@newUserCoupon')->middleware('view_coupon');
        Route::post('/updateUserCoupon', 'CouponsController@updateUserCoupon')->middleware('edit_coupon');
    });
    Route::group(['prefix' => 'admin/devices', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'NotificationController@devices')->middleware('view_notification');
        Route::get('/viewdevices/{id}', 'NotificationController@viewdevices')->middleware('view_notification');
        Route::post('/notifyUser/', 'NotificationController@notifyUser')->middleware('edit_notification');
        Route::get('/notifications/', 'NotificationController@notifications')->middleware('view_notification');
        Route::post('/sendNotifications/', 'NotificationController@sendNotifications')->middleware('edit_notification');
        Route::post('/customerNotification/', 'NotificationController@customerNotification')->middleware('view_notification');
        Route::post('/singleUserNotification/', 'NotificationController@singleUserNotification')->middleware('edit_notification');
        Route::post('/deletedevice/', 'NotificationController@deletedevice')->middleware('view_notification');
    });

    Route::group(['prefix' => 'admin/devices', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/', 'NotificationController@devices')->middleware('view_notification');
        Route::get('/viewdevices/{id}', 'NotificationController@viewdevices')->middleware('view_notification');
        Route::post('/notifyUser/', 'NotificationController@notifyUser')->middleware('edit_notification');
        Route::get('/notifications/', 'NotificationController@notifications')->middleware('view_notification');
        Route::post('/sendNotifications/', 'NotificationController@sendNotifications')->middleware('edit_notification');
        Route::post('/customerNotification/', 'NotificationController@customerNotification')->middleware('view_notification');
        Route::post('/singleUserNotification/', 'NotificationController@singleUserNotification')->middleware('edit_notification');
        Route::post('/deletedevice/', 'NotificationController@deletedevice')->middleware('view_notification');
    });

    Route::group(['prefix' => 'admin/orders', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/display', 'OrdersController@display')->middleware('view_order');
        Route::get('/vieworder/{id}', 'OrdersController@vieworder')->middleware('view_order');
        Route::post('/updateOrder', 'OrdersController@updateOrder')->middleware('edit_order');
        Route::post('/updateCoustomerNotes', 'OrdersController@updateCoustomerNotes')->middleware('edit_order');
        Route::post('/deleteOrder', 'OrdersController@deleteOrder')->middleware('edit_order');
        Route::get('/invoiceprint/{id}', 'OrdersController@invoiceprint')->middleware('view_order');
        Route::get('/orderstatus', 'SiteSettingController@orderstatus')->middleware('view_order');
        Route::get('/addorderstatus', 'SiteSettingController@addorderstatus')->middleware('edit_order');
        Route::post('/addNewOrderStatus', 'SiteSettingController@addNewOrderStatus')->middleware('edit_order');
        Route::get('/editorderstatus/{id}', 'SiteSettingController@editorderstatus')->middleware('edit_order');
        Route::post('/updateOrderStatus', 'SiteSettingController@updateOrderStatus')->middleware('edit_order');
        Route::post('/deleteOrderStatus', 'SiteSettingController@deleteOrderStatus')->middleware('edit_order');

        Route::get('/reasonOfCancelOrder', 'SiteSettingController@reasonOfCancelOrder')->middleware('view_order');
        Route::get('/addReasonOfCancelOrder', 'SiteSettingController@addReasonOfCancelOrder')->middleware('edit_order');
        Route::post('/insertReasonOfCancelOrder', 'SiteSettingController@insertReasonOfCancelOrder')->middleware('edit_order');
        Route::get('/editReasonOfCancelOrder/{id}', 'SiteSettingController@editReasonOfCancelOrder')->middleware('edit_order');
        Route::post('/updateReasonOfCancelOrder', 'SiteSettingController@updateReasonOfCancelOrder')->middleware('edit_order');
        Route::post('/deleteReasonOfCancelOrder', 'SiteSettingController@deleteReasonOfCancelOrder')->middleware('edit_order');

        Route::get('/reasonOfReturnOrder', 'SiteSettingController@reasonOfReturnOrder')->middleware('view_order');
        Route::get('/addReasonOfReturnOrder', 'SiteSettingController@addReasonOfReturnOrder')->middleware('edit_order');
        Route::post('/insertReasonOfReturnOrder', 'SiteSettingController@insertReasonOfReturnOrder')->middleware('edit_order');
        Route::get('/editReasonOfReturnOrder/{id}', 'SiteSettingController@editReasonOfReturnOrder')->middleware('edit_order');
        Route::post('/updateReasonOfReturnOrder', 'SiteSettingController@updateReasonOfReturnOrder')->middleware('edit_order');
        Route::post('/deleteReasonOfReturnOrder', 'SiteSettingController@deleteReasonOfReturnOrder')->middleware('edit_order');
    });

    Route::group(['prefix' => 'admin/banners', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/', 'BannersController@banners')->middleware('view_app_setting');
        Route::get('/add', 'BannersController@addbanner')->middleware('edit_app_setting');
        Route::post('/insert', 'BannersController@addNewBanner')->middleware('edit_app_setting');
        Route::get('/edit/{id}', 'BannersController@editbanner')->middleware('edit_app_setting');
        Route::post('/update', 'BannersController@updateBanner')->middleware('edit_app_setting');
        Route::post('/delete', 'BannersController@deleteBanner')->middleware('edit_app_setting');
        Route::get('/filter', 'BannersController@filterbanners')->middleware('edit_app_setting');

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {

        Route::get('/customers-orders-report', 'ReportsController@statsCustomers')->middleware('report');
        Route::get('/customer-orders-print', 'ReportsController@customerOrdersPrint')->middleware('report');

        Route::get('/statsproductspurchased', 'ReportsController@statsProductsPurchased')->middleware('report');
        Route::get('/statsproductsliked', 'ReportsController@statsProductsLiked')->middleware('report');
        Route::get('/outofstock', 'ReportsController@outofstock')->middleware('report');
        Route::get('/outofstockprint', 'ReportsController@outofstockprint')->middleware('report');
        Route::get('/lowinstock', 'ReportsController@lowinstock')->middleware('report');
        Route::get('/stockin', 'ReportsController@stockin')->middleware('report');
        Route::get('/stockinprint', 'ReportsController@stockinprint')->middleware('report');
        Route::post('/productSaleReport', 'ReportsController@productSaleReport')->middleware('report');
        Route::get('/couponreport', 'ReportsController@couponReport')->middleware('report');
        Route::get('/couponreport-print', 'ReportsController@couponReportPrint')->middleware('report');

        
        Route::get('/salesreport', 'ReportsController@salesreport')->middleware('report');
        // Route::get('/customer-orders-print', 'ReportsController@customerOrdersPrint')->middleware('report');
        
        Route::get('/inventoryreport', 'ReportsController@inventoryreport')->middleware('report');
        Route::get('/inventoryreportprint', 'ReportsController@inventoryreportprint')->middleware('report');

        
        Route::get('/minstock', 'ReportsController@minstock')->middleware('report');
        Route::get('/minstockprint', 'ReportsController@minstockprint')->middleware('report');
        
        Route::get('/maxstock', 'ReportsController@maxstock')->middleware('report');
        Route::get('/maxstockprint', 'ReportsController@maxstockprint')->middleware('report');

////////////////////////////////////////////////////////////////////////////////////
        //////////////     APP ROUTES
        ////////////////////////////////////////////////////////////////////////////////////
        //app pages controller
        Route::get('/pages', 'PagesController@pages')->middleware('view_app_setting', 'application_routes');
        Route::get('/addpage', 'PagesController@addpage')->middleware('edit_app_setting', 'application_routes');
        Route::post('/addnewpage', 'PagesController@addnewpage')->middleware('edit_app_setting', 'application_routes');
        Route::get('/editpage/{id}', 'PagesController@editpage')->middleware('edit_app_setting', 'application_routes');
        Route::post('/updatepage', 'PagesController@updatepage')->middleware('edit_app_setting', 'application_routes');
        Route::get('/pageStatus', 'PagesController@pageStatus')->middleware('edit_app_setting', 'application_routes');
        Route::get('/filterpages', 'PagesController@filterpages')->middleware('view_app_setting', 'application_routes');
        //manageAppLabel
        Route::get('/listingAppLabels', 'AppLabelsController@listingAppLabels')->middleware('view_app_setting', 'application_routes');
        Route::get('/addappkey', 'AppLabelsController@addappkey')->middleware('edit_app_setting', 'application_routes');
        Route::post('/addNewAppLabel', 'AppLabelsController@addNewAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::get('/editAppLabel/{id}', 'AppLabelsController@editAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::post('/updateAppLabel/', 'AppLabelsController@updateAppLabel')->middleware('edit_app_setting', 'application_routes');
        Route::get('/applabel', 'AppLabelsController@manageAppLabel')->middleware('view_app_setting', 'application_routes');

        Route::get('/admobSettings', 'SiteSettingController@admobSettings')->middleware('view_app_setting', 'application_routes');
        Route::get('/applicationapi', 'SiteSettingController@applicationApi')->middleware('view_app_setting', 'application_routes');
        Route::get('/appsettings', 'SiteSettingController@appSettings')->middleware('view_app_setting', 'application_routes');
 //login
 Route::get('/loginsetting', 'SiteSettingController@loginsetting')->middleware('view_general_setting');

////////////////////////////////////////////////////////////////////////////////////
        //////////////     SITE ROUTES
        ////////////////////////////////////////////////////////////////////////////////////
        
        // home page banners
        Route::get('/homebanners', 'HomeBannersController@display')->middleware('view_web_setting', 'website_routes');
        Route::post('/homebanners/insert', 'HomeBannersController@insert')->middleware('view_web_setting', 'website_routes');
        
        Route::get('/menus', 'MenusController@menus')->middleware('view_web_setting', 'website_routes');
        Route::get('/addmenus', 'MenusController@addmenus')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewmenu', 'MenusController@addnewmenu')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editmenu/{id}', 'MenusController@editmenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/updatemenu', 'MenusController@updatemenu')->middleware('edit_web_setting', 'website_routes');
        Route::get('/deletemenu/{id}', 'MenusController@deletemenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/deletemenu', 'MenusController@deletemenu')->middleware('edit_web_setting', 'website_routes');
        Route::post('/menuposition', 'MenusController@menuposition')->middleware('edit_web_setting', 'website_routes');
        Route::get('/catalogmenu', 'MenusController@catalogmenu')->middleware('edit_web_setting', 'website_routes');

        

        //site pages controller
        Route::get('/webpages', 'PagesController@webpages')->middleware('view_web_setting', 'website_routes');
        Route::get('/addwebpage', 'PagesController@addwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::post('/addnewwebpage', 'PagesController@addnewwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/editwebpage/{id}', 'PagesController@editwebpage')->middleware('edit_web_setting', 'website_routes');
        Route::post('/updatewebpage', 'PagesController@updatewebpage')->middleware('edit_web_setting', 'website_routes');
        Route::get('/pageWebStatus', 'PagesController@pageWebStatus')->middleware('view_web_setting', 'website_routes');

        Route::get('/webthemes', 'SiteSettingController@webThemes')->middleware('view_web_setting', 'website_routes');
        Route::get('/themeSettings', 'SiteSettingController@themeSettings')->middleware('edit_web_setting', 'website_routes');

        Route::get('/seo', 'SiteSettingController@seo')->middleware('view_web_setting', 'website_routes');
        Route::get('/customstyle', 'SiteSettingController@customstyle')->middleware('view_web_setting', 'website_routes');
        Route::post('/updateWebTheme', 'SiteSettingController@updateWebTheme')->middleware('edit_web_setting', 'website_routes');
        Route::get('/websettings', 'SiteSettingController@webSettings')->middleware('view_web_setting', 'website_routes');
        Route::get('/instafeed', 'SiteSettingController@instafeed')->middleware('view_web_setting', 'website_routes');
        Route::get('/newsletter', 'SiteSettingController@newsletter')->middleware('view_web_setting', 'website_routes');

/////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////
        //////////////     GENERAL ROUTES
        ////////////////////////////////////////////////////////////////////////////////////

//units
        Route::get('/units', 'SiteSettingController@units')->middleware('view_general_setting');
        Route::get('/addunit', 'SiteSettingController@addunit')->middleware('edit_general_setting');
        Route::post('/addnewunit', 'SiteSettingController@addnewunit')->middleware('edit_general_setting');
        Route::get('/editunit/{id}', 'SiteSettingController@editunit')->middleware('edit_general_setting');
        Route::post('/updateunit', 'SiteSettingController@updateunit')->middleware('edit_general_setting');
        Route::post('/deleteunit', 'SiteSettingController@deleteunit')->middleware('edit_general_setting');

        Route::get('/orderstatus', 'SiteSettingController@orderstatus')->middleware('view_general_setting');
        Route::get('/addorderstatus', 'SiteSettingController@addorderstatus')->middleware('edit_general_setting');
        Route::post('/addNewOrderStatus', 'SiteSettingController@addNewOrderStatus')->middleware('edit_general_setting');
        Route::get('/editorderstatus/{id}', 'SiteSettingController@editorderstatus')->middleware('edit_general_setting');
        Route::post('/updateOrderStatus', 'SiteSettingController@updateOrderStatus')->middleware('edit_general_setting');
        Route::post('/deleteOrderStatus', 'SiteSettingController@deleteOrderStatus')->middleware('edit_general_setting');

        Route::get('/facebooksettings', 'SiteSettingController@facebookSettings')->middleware('view_general_setting');
        Route::get('/instasettings', 'SiteSettingController@instasettings')->middleware('view_general_setting');
        Route::get('/googlesettings', 'SiteSettingController@googleSettings')->middleware('view_general_setting');
        //pushNotification
        Route::get('/pushnotification', 'SiteSettingController@pushNotification')->middleware('view_general_setting');
        Route::get('/alertsetting', 'SiteSettingController@alertSetting')->middleware('view_general_setting');
        Route::post('/updateAlertSetting', 'SiteSettingController@updateAlertSetting');
        Route::get('/setting', 'SiteSettingController@setting')->middleware('edit_general_setting');
        Route::post('/updateSetting', 'SiteSettingController@updateSetting')->middleware('edit_general_setting');

        Route::get('/shareThis', 'SiteSettingController@shareThis')->middleware('edit_general_setting');
        Route::post('/updateShareThis', 'SiteSettingController@updateShareThis')->middleware('edit_general_setting');

        Route::get('/socialLink', 'SiteSettingController@socialLink')->middleware('edit_general_setting');
        Route::post('/updateSocialLink', 'SiteSettingController@updateSocialLink')->middleware('edit_general_setting');

        //admin managements
        Route::get('/admins', 'AdminController@admins')->middleware('view_manage_admin');
        Route::get('/addadmins', 'AdminController@addadmins')->middleware('add_manage_admin');
        Route::post('/addnewadmin', 'AdminController@addnewadmin')->middleware('add_manage_admin');
        Route::get('/editadmin/{id}', 'AdminController@editadmin')->middleware('edit_manage_admin');
        Route::post('/updateadmin', 'AdminController@updateadmin')->middleware('edit_manage_admin');
        Route::post('/deleteadmin', 'AdminController@deleteadmin')->name('deleteadmin')->middleware('delete_manage_admin');

        //admin managements
        Route::get('/manageroles', 'AdminController@manageroles')->middleware('manage_role');
        Route::get('/addrole/{id}', 'AdminController@addrole')->middleware('manage_role');
        Route::post('/addnewroles', 'AdminController@addnewroles')->middleware('manage_role');
        Route::get('/addadmintype', 'AdminController@addadmintype')->middleware('add_admin_type');
        Route::post('/addnewtype', 'AdminController@addnewtype')->middleware('add_admin_type');
        Route::get('/editadmintype/{id}', 'AdminController@editadmintype')->middleware('edit_admin_type');
        Route::post('/updatetype', 'AdminController@updatetype')->middleware('edit_admin_type');
        Route::post('/deleteadmintype', 'AdminController@deleteadmintype')->middleware('delete_admin_type');

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    });

    Route::group(['prefix' => 'admin/managements', 'middleware' => 'auth', 'namespace' => 'AdminControllers'], function () {
        Route::get('/merge', 'ManagementsController@merge')->middleware('edit_management');
        Route::get('/backup', 'ManagementsController@backup')->middleware('edit_management');
        Route::post('/take_backup', 'ManagementsController@take_backup')->middleware('edit_management');
        Route::get('/import', 'ManagementsController@import')->middleware('edit_management');
        Route::post('/importdata', 'ManagementsController@importdata')->middleware('edit_management');
        Route::post('/mergecontent', 'ManagementsController@mergecontent')->middleware('edit_management');
        Route::get('/updater', 'ManagementsController@updater')->middleware('edit_management');
        Route::post('/checkpassword', 'ManagementsController@checkpassword')->middleware('edit_management');
        Route::post('/updatercontent', 'ManagementsController@updatercontent')->middleware('edit_management');
    });

});
