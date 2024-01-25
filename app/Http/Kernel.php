<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\Language::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],

		'vendor' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
      'web_installed' => \App\Http\Middleware\web_installed::class,
      'env' => \App\Http\Middleware\env::class,
      'admin' => \App\Http\Middleware\RedirectIfNotAdmin::class,
      'Customer' => \App\Http\Middleware\RedirectIfNotCustomer::class,
      'WebCustomer' => \App\Http\Middleware\WebCustomer::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'installer' => \App\Http\Middleware\Installation::class,
        'view_language' => \App\Http\Middleware\languages\view_language::class,
        'edit_language' => \App\Http\Middleware\languages\edit_language::class,
        'delete_language' => \App\Http\Middleware\languages\delete_language::class,
        'add_language' => \App\Http\Middleware\languages\add_language::class,
        'view_media' => \App\Http\Middleware\media\view_media::class,
        'edit_media' => \App\Http\Middleware\media\edit_media::class,
        'delete_media' => \App\Http\Middleware\media\delete_media::class,
        'add_media' => \App\Http\Middleware\media\add_media::class,
        'view_manufacturer' => \App\Http\Middleware\manufacturer\view_manufacturer::class,
        'edit_manufacturer' => \App\Http\Middleware\manufacturer\edit_manufacturer::class,
        'delete_manufacturer' => \App\Http\Middleware\manufacturer\delete_manufacturer::class,
        'add_manufacturer' => \App\Http\Middleware\manufacturer\add_manufacturer::class,
        'view_product' => \App\Http\Middleware\product\view_product::class,
        'edit_product' => \App\Http\Middleware\product\edit_product::class,
        'delete_product' => \App\Http\Middleware\product\delete_product::class,
        'add_product' => \App\Http\Middleware\product\add_product::class,
        'view_news' => \App\Http\Middleware\news\view_news::class,
        'edit_news' => \App\Http\Middleware\news\edit_news::class,
        'delete_news' => \App\Http\Middleware\news\delete_news::class,
        'add_news' => \App\Http\Middleware\news\add_news::class,
        'view_customer' => \App\Http\Middleware\customer\view_customer::class,
        'edit_customer' => \App\Http\Middleware\customer\edit_customer::class,
        'delete_customer' => \App\Http\Middleware\customer\delete_customer::class,
        'add_customer' => \App\Http\Middleware\customer\add_customer::class,
        'view_tax' => \App\Http\Middleware\tax\view_tax::class,
        'edit_tax' => \App\Http\Middleware\tax\edit_tax::class,
        'delete_tax' => \App\Http\Middleware\tax\delete_tax::class,
        'add_tax' => \App\Http\Middleware\tax\add_tax::class,
        'view_coupon' => \App\Http\Middleware\coupon\view_coupon::class,
        'edit_coupon' => \App\Http\Middleware\coupon\edit_coupon::class,
        'delete_coupon' => \App\Http\Middleware\coupon\delete_coupon::class,
        'add_coupon' => \App\Http\Middleware\coupon\add_coupon::class,
        'view_notification' => \App\Http\Middleware\notification\view_notification::class,
        'edit_notification' => \App\Http\Middleware\notification\edit_notification::class,
        'view_shipping' => \App\Http\Middleware\shipping\view_shipping::class,
        'edit_shipping' => \App\Http\Middleware\shipping\edit_shipping::class,
        'view_order' => \App\Http\Middleware\order\view_order::class,
        'edit_order' => \App\Http\Middleware\order\edit_order::class,
        'view_payment' => \App\Http\Middleware\payment\view_payment::class,
        'edit_payment' => \App\Http\Middleware\payment\edit_payment::class,
        'view_web_setting' => \App\Http\Middleware\web_setting\view_web_setting::class,
        'edit_web_setting' => \App\Http\Middleware\web_setting\edit_web_setting::class,
        'view_app_setting' => \App\Http\Middleware\app_setting\view_app_setting::class,
        'edit_app_setting' => \App\Http\Middleware\app_setting\edit_app_setting::class,
        'view_general_setting' => \App\Http\Middleware\general_setting\view_general_setting::class,
        'edit_general_setting' => \App\Http\Middleware\general_setting\edit_general_setting::class,
        'view_manage_admin' => \App\Http\Middleware\manage_admin\view_manage_admin::class,
        'edit_manage_admin' => \App\Http\Middleware\manage_admin\edit_manage_admin::class,
        'delete_manage_admin' => \App\Http\Middleware\manage_admin\delete_manage_admin::class,
        'add_manage_admin' => \App\Http\Middleware\manage_admin\add_manage_admin::class,
        'view_admin_type' => \App\Http\Middleware\admin_type\view_admin_type::class,
        'edit_admin_type' => \App\Http\Middleware\admin_type\edit_admin_type::class,
        'delete_admin_type' => \App\Http\Middleware\admin_type\delete_admin_type::class,
        'add_admin_type' => \App\Http\Middleware\admin_type\add_admin_type::class,
        'report' => \App\Http\Middleware\report\report::class,
        'dashboard' => \App\Http\Middleware\dashboard\dashboard::class,
        'manage_role' => \App\Http\Middleware\manage_role\manage_role::class,
        'view_vendor' => \App\Http\Middleware\vendors\view_vendor::class,
        'edit_vendor' => \App\Http\Middleware\vendors\edit_vendor::class,
        'delete_vendor' => \App\Http\Middleware\vendors\delete_vendor::class,
        'add_vendor' => \App\Http\Middleware\vendors\add_vendor::class,
        'cors' => \App\Http\Middleware\CORS::class,
        'edit_management' => \App\Http\Middleware\management\edit_management::class,
        'application_routes' => \App\Http\Middleware\app_setting\application_routes::class,
        'website_routes' => \App\Http\Middleware\web_setting\website_routes::class,

        'view_categories' => \App\Http\Middleware\categories\view_categories::class,
        'edit_categories' => \App\Http\Middleware\categories\edit_categories::class,
        'delete_categories' => \App\Http\Middleware\categories\delete_categories::class,
        'add_categories' => \App\Http\Middleware\categories\add_categories::class,
        'view_reviews' => \App\Http\Middleware\reviews\view_reviews::class,
        'edit_reviews' => \App\Http\Middleware\reviews\edit_reviews::class,
        
        'view_pincode' => \App\Http\Middleware\pincode\view_pincode::class,
        'create_pincode' => \App\Http\Middleware\pincode\create_pincode::class,
        'update_pincode' => \App\Http\Middleware\pincode\update_pincode::class,
        'delete_pincode' => \App\Http\Middleware\pincode\delete_pincode::class,

        'view_city' => \App\Http\Middleware\city\view_city::class,
        'create_city' => \App\Http\Middleware\city\create_city::class,
        'update_city' => \App\Http\Middleware\city\update_city::class,
        'delete_city' => \App\Http\Middleware\city\delete_city::class,

        'edit_contact_us' => \App\Http\Middleware\contact_us\edit_contact_us::class,

        'edit_about_us' => \App\Http\Middleware\about_us\edit_about_us::class,

        'view_assured_logo' => \App\Http\Middleware\assured_logo\view_assured_logo::class,
        'update_assured_logo' => \App\Http\Middleware\assured_logo\update_assured_logo::class,

        'view_corp_request' => \App\Http\Middleware\corporate_request\view_corp_request::class,
        'update_corp_request' => \App\Http\Middleware\corporate_request\update_corp_request::class,
        'delete_corp_request' => \App\Http\Middleware\corporate_request\delete_corp_request::class,

        'view_cms' => \App\Http\Middleware\cms\view_cms::class,
        'create_cms' => \App\Http\Middleware\cms\create_cms::class,
        'update_cms' => \App\Http\Middleware\cms\update_cms::class,
        'delete_cms' => \App\Http\Middleware\cms\delete_cms::class,

        'view_cod' => \App\Http\Middleware\cod\view_cod::class,
        'update_cod' => \App\Http\Middleware\cod\update_cod::class,

        'view_contact_comment' => \App\Http\Middleware\contact_comment\view_contact_comment::class,
        'update_contact_comment' => \App\Http\Middleware\contact_comment\update_contact_comment::class,
        'delete_contact_comment' => \App\Http\Middleware\contact_comment\delete_contact_comment::class,

        'view_product_enquery' => \App\Http\Middleware\product_enquery\view_product_enquery::class,
        'update_product_enquery' => \App\Http\Middleware\product_enquery\update_product_enquery::class,
        'delete_product_enquery' => \App\Http\Middleware\product_enquery\delete_product_enquery::class,

        'view_sell_on_ss' => \App\Http\Middleware\sell_on_ss\view_sell_on_ss::class,
        'update_sell_on_ss' => \App\Http\Middleware\sell_on_ss\update_sell_on_ss::class,
        'delete_sell_on_ss' => \App\Http\Middleware\sell_on_ss\delete_sell_on_ss::class,

    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given general_setting.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
