<?php

namespace App\Models\Web;

use App;
use App\Models\Core\Categories;
use App\Models\Web\Cart;
use App\Models\Web\News;
use DB;
use Illuminate\Database\Eloquent\Model;
use Session;

class Index extends Model
{

    public function slides($currentDate)
    {
        $slides = DB::table('sliders_images')
            ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'type',
                'sliders_title as title',
                'image_categories.path'
            )
            ->where('status', '=', '1')
            ->where('image_categories.image_type', '=', 'actual')
            ->where('languages_id', '=', session('language_id'))
            ->get();

        if (empty($slides) or count($slides) == 0) {

            $slides = DB::table('sliders_images')
                ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
                ->select('sliders_id as id',
                    'sliders_title as title',
                    'sliders_url as url',
                    'sliders_image as image',
                    'type',
                    'sliders_title as title',
                    'image_categories.path'
                )
                ->where('status', '=', '1')
                ->where('image_categories.image_type', '=', 'THUMBNAIL')
                ->where('languages_id', '=', 1)
                ->get();
        }

        return $slides;
    }

    public function slidesByCarousel($currentDate, $carousel_id)
    {
        $slides = DB::table('sliders_images')
            ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
            ->select('sliders_id as id',
                'sliders_title as title',
                'sliders_url as url',
                'sliders_image as image',
                'type',
                'sliders_title as title',
                'image_categories.path'
            )
            ->where('status', '=', '1')
            ->where('carousel_id', '=', $carousel_id)
            ->where('image_categories.image_type', '=', 'actual')
            ->where('languages_id', '=', 1)
            ->get();

        if (empty($slides) or count($slides) == 0) {
            $slides = DB::table('sliders_images')
                ->leftJoin('image_categories', 'sliders_images.sliders_image', '=', 'image_categories.image_id')
                ->select('sliders_id as id',
                    'sliders_title as title',
                    'sliders_url as url',
                    'sliders_image as image',
                    'type',
                    'sliders_title as title',
                    'image_categories.path'
                )
                ->where('status', '=', '1')
                ->where('image_categories.image_type', '=', 'THUMBNAIL')
                ->where('carousel_id', '=', $carousel_id)
                ->where('languages_id', '=', 1)
                ->get();
        }
        return $slides;
    }

    public function compareCount()
    {
        $count = DB::table('compare')->where('customer_id', auth()->guard('customer')->user()->id)->count();
        return $count;
    }

    public function finalTheme()
    {
        $data = DB::table('current_theme')->first();
        return $data;
    }

    public function commonContent()
    {
        $languages = DB::table('languages')
            ->leftJoin('image_categories', 'languages.image', 'image_categories.image_id')
            ->select('languages.*', 'image_categories.path as image_path')
            ->where('languages.is_default', '1')
            ->get();

        $currency = DB::table('currencies')
            ->where('is_default', 1)
            ->where('is_current', 1)
            ->first();

        if (empty(Session::get('currency_id'))) {
            session(['currency_id' => $currency->id]);
        }
        if (empty(Session::get('currency_title'))) {
            session(['currency_title' => $currency->code]);
        }
        if (empty(Session::get('symbol_right')) && empty(Session::get('symbol_left'))) {
            session(['symbol_right' => $currency->symbol_right]);
        }
        if (empty(Session::get('symbol_left')) && empty(Session::get('symbol_right'))) {
            session(['symbol_left' => $currency->symbol_left]);
        }
        if (empty(Session::get('currency_code'))) {
            session(['currency_code' => $currency->code]);
        }

        if (empty(Session::get('currency_value'))) {
            session(['currency_value' => $currency->value]);
        }

        if (empty(Session::get('language_id'))) {
            session(['language_id' => $languages[0]->languages_id]);
        }
        if (empty(Session::get('language_image'))) {
            session(['language_image' => $languages[0]->image_path]);
        }
        if (empty(Session::get('language_name'))) {
            session(['language_name' => $languages[0]->name]);
        }

        if (!Session::has('custom_locale')) {
            $locale = $languages[0]->code;
            session()->put('language_id', $languages[0]->languages_id);
            session()->put('direction', $languages[0]->direction);
            session()->put('locale', $languages[0]->code);
            session()->put('language_name', $languages[0]->name);
            session()->put('language_image', $languages[0]->image_path);
            App::setLocale($locale);
        }

        $result = array();
        $result['currency'] = $currency;


        /*****/
        $userCoupon = DB::table('coupons')
            ->where('coupons.coupans_id','=','7')
            ->get();
        $result['userCoupon'] = $userCoupon;

        $social_link_details = DB::table('social_links')->where('social_links_id',1)->first();
        $result['social_link_details'] = $social_link_details;
        /************/
        $cityList = array();

        $cityList = DB::table('cities')
            ->where('city_active','=', 1)
            ->where('is_delete','=', 0)
            ->get();
        $result['cityList'] = $cityList;

        $locationDetails = '';

        if(Session::has('user_pincode_id')){
            $pincodes_id = Session::get('user_pincode_id');

            $location = DB::table('pincodes')
                ->leftJoin('cities','cities.cities_id', '=', 'pincodes.pincodes_city_id')
                ->select('pincodes.pincodes_id','pincodes.pincodes_val','pincodes.pincodes_city_id','cities.cities_name')
                ->where('pincodes.pincodes_id','=',$pincodes_id)
                ->get();
            if (count($location)>0) {
                $locationDetails = $location[0];
            }
        }
        $result['locationDetails'] = $locationDetails;
        /************/


        $top_offers = DB::table('top_offers')
            ->where('language_id', Session::get('language_id'))
            ->first();

        $result['top_offers'] = $top_offers;

        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', '=', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->groupBy('menus.id')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }

            $result["menus"] = $menus;
        } else {

            $result["menus"] = array();
        }

        $result["menusRecursive"] = $this->menusRecursive();
        $result["menusRecursiveMobile"] = $this->menusRecursiveMobile();
        //dd($result["menus"]);
        $data = array();
        $categories = DB::table('news_categories')
            ->LeftJoin('news_categories_description', 'news_categories_description.categories_id', '=', 'news_categories.categories_id')
            ->select('news_categories.categories_id as id',
                'news_categories.categories_image as image',
                'news_categories.news_categories_slug as slug',
                'news_categories_description.categories_name as name'
            )
            ->where('news_categories_description.language_id', '=', Session::get('language_id'))->get();

        if (count($categories) > 0) {
            foreach ($categories as $categories_data) {
                $categories_id = $categories_data->id;
                $news = DB::table('news_categories')
                    ->LeftJoin('news_to_news_categories', 'news_to_news_categories.categories_id', '=', 'news_categories.categories_id')
                    ->LeftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
                    ->select('news_categories.categories_id', DB::raw('COUNT(DISTINCT news.news_id) as total_news'))
                    ->where('news_categories.categories_id', '=', $categories_id)
                    ->get();

                $categories_data->total_news = $news[0]->total_news;
                array_push($data, $categories_data);
            }
        }
        $result['newsCategories'] = $data;

        $myVar = new News();
        $data = array('page_number' => 0, 'type' => '', 'is_feature' => '1', 'limit' => 5, 'categories_id' => '', 'load_news' => 0);
        $featuredNews = $myVar->getAllNews($data);
        $result['featuredNews'] = $featuredNews;
        $data = array('type' => 'header');

        if(Session::has('supportUserDetails')){
            $cart = $this->cart($data);
        } else {
            $cart = array();
        }
        
        $result['cart'] = $cart;
        $result['cartCount'] = count($cart);
        if (count($result['cart']) == 0) {
            session(['step' => '0']);
            session(['coupon' => array()]);
            session(['coupon_discount' => array()]);
            session(['billing_address' => array()]);
            session(['shipping_detail' => array()]);
            session(['payment_method' => array()]);
            session(['braintree_token' => array()]);
            session(['order_comments' => '']);
        }

        $result['setting'] = DB::table('settings')->orderby('id', 'ASC')->get();

        
        $settings = array();
        
        foreach($result['setting'] as $key=>$value){
          $settings[$value->name]=$value->value;
        }

        $result['settings'] = $settings;

        //home banners

        $homeBanners = DB::table('constant_banners')
            ->leftJoin('image_categories', 'constant_banners.banners_image', '=', 'image_categories.image_id')
            ->select('constant_banners.*', 'image_categories.path')
            ->where('languages_id', session('language_id'))
            ->groupBy('constant_banners.banners_id')
            ->orderby('type', 'ASC')
            ->get();

        $result['homeBanners'] = $homeBanners;

        $result['pages'] = DB::table('pages')
            ->leftJoin('pages_description', 'pages_description.page_id', '=', 'pages.page_id')
            ->where([['type', '2'], ['status', '1'], ['pages_description.language_id', session('language_id')]])
            ->orderBy('pages_description.name', 'ASC')->get();

        //product categories
        $result['categories'] = $this->categories();
        $result['allcategories'] = $this->allcategories();
        $result['dropdownCategories'] = $this->dropdownCategories();

        $result['mobileCategories'] = $this->mobileCategories();

        $manufacturers = DB::table('manufacturers')
            ->leftJoin('manufacturers_info', 'manufacturers_info.manufacturers_id', 'manufacturers.manufacturers_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'manufacturers.manufacturer_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('manufacturers.*', 'manufacturers_info.*', 'image_categories.path as manufacturer_image')
            ->get();

        $result['manufacturers'] = $manufacturers;

        //liked_products
        $total_wishlist = 0;
        if (!empty(session('customers_id'))) {
            $total_wishlist = DB::table('liked_products')
                ->leftjoin('products', 'products.products_id', '=', 'liked_products.liked_products_id')
                ->where('products_status', '1')
                ->where('liked_customers_id', '=', session('customers_id'))->count();
        }

        $result['total_wishlist'] = $total_wishlist;

        $homepagebanners = DB::table('home_banners')
            ->leftJoin('image_categories', 'home_banners.image', 'image_categories.image_id')
            ->select('home_banners.*', 'image_categories.path as image_path')
            ->where('language_id', 1)
            ->where('image_type', 'ACTUAL')
            ->orderby('banner_name', 'ASC')
            ->get();

        $result['homepagebanners'] = $homepagebanners;
        return $result;
    }

    private function allcategories()
    {
        $catDetails = DB::table('front_category')->where('front_category_id','=', 1)->first();
        $categories_ids = $catDetails->categories_ids;
        $categories_ids_array = explode(",",$categories_ids);

        $categories = DB::table('categories')
            ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('categories.categories_id as id',
                'categories.categories_image as image',
                'categories.categories_icon as icon',
                'categories.sort_order as order',
                'categories.categories_slug as slug',
                'categories.parent_id',
                'categories_description.categories_name as name',
                'categoryTable.path as imgpath','iconTable.path as iconpath',
                'categories.sort_order'
            )
            ->whereIn('categories.categories_id', $categories_ids_array)
            ->where('categories_description.language_id', '=', 1)
            ->where('categories.categories_status', 1)
            // ->orderBy('categories.sort_order','ASC')
            ->groupBy('categories.categories_id')
            ->get();
        // dd($categories);
        $result = array();
        $result['categories'] = $categories;
        $comma_categories = array();

        foreach ($categories as $category) {
            $comma_categories[] = $category->slug;
            $comma_categories[] = $category->name;
        }

        $result['comma_categories'] = implode(',', $comma_categories);
        return $categories;
    }

    private function dropdownCategories()
    {

        $categories = DB::table('categories')
            ->LeftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('categories.categories_id as id',
                'categories.categories_image as image',
                'categories.categories_icon as icon',
                'categories.sort_order as order',
                'categories.categories_slug as slug',
                'categories.parent_id',
                'categories_description.categories_name as name',
                'categoryTable.path as imgpath','iconTable.path as iconpath'
            )
            ->where('categories.categories_id','>',0)
            ->where('categories_description.language_id', '=', 1)
            ->where('categories.categories_status', 1)
            ->groupBy('categories.categories_id')
            ->get();

        $result = array();
        $result['categories'] = $categories;
        $comma_categories = array();

        foreach ($categories as $category) {
            $comma_categories[] = $category->slug;
            $comma_categories[] = $category->name;
        }

        $result['comma_categories'] = implode(',', $comma_categories);
        return $categories;
    }

    private function categories()
    {

        $categories = $this->recursivecategories();
        // echo "<pre>";
        // print_r($categories);exit;

        $parent_id = array();
        $option = '<ul class="departments__links" id="scrolls">';

        foreach ($categories as $parents) {

            // if (in_array($parents->categories_id, $parent_id)) {
            //     $checked = 'checked';
            // } else {
            //     $checked = '';
            // }
            if (isset($parents->childs)) {
                $arrowClass = "fa fa-chevron-right departments__item-arrow";
            }else{
                $arrowClass = "";
            }

            if (isset($parents->childs)) {
                $option .= '<li class="departments__item"><a class="departments__item-link" href='.url("/shop?page=&limit=&search=&type=&category=".$parents->categories_id."&price=&today_deal=&best_seller=").' >' . $parents->categories_name . '<i class="'.$arrowClass.'"></i></a>';
            }else{
                $option .= '<li class="departments__item"><a class="departments__item-link" href='.url("/shop?page=&limit=&search=&type=&category=".$parents->categories_id."&price=&today_deal=&best_seller=").' >' . $parents->categories_name . '</a>';
            }            

            if (isset($parents->childs)) {
                $option .= '<div class="departments__submenu departments__submenu--type--menu">
                                <div class="menu menu--layout--classic">
                                    <div class="menu__submenus-container"></div>
                                        <ul class="menu__list">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</ul>
                                </div>
                            </div>';
            }

            $option .= '</li>';
        }
        $option .= '</li></ul>';

        return  $option;

    }

    private function mobileCategories()
    {

        $categories = $this->recursivecategories();
        // echo "<pre>";
        // print_r($categories);exit;

        $parent_id = array();
        $option = '<ul>';

        foreach ($categories as $parents) {

            $option .= '<li><a href='.url("/shop?page=&limit=&search=&type=&category=".$parents->categories_id."&price=&today_deal=&best_seller=").' ><span>' . $parents->categories_name . '</span></a>';            

            if (isset($parents->childs)) {
                $option .= '<ul>';
                $option .= $this->mobileChildcat($parents->childs, $parent_id);
                $option .= '</ul>';
            }

            $option .= '</li>';
        }
        $option .= '</ul>';

        return  $option;

    }

    public function mobileChildcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            $contents .= '<li><a href='.url("/shop?page=&limit=&search=&type=&category=".$child->categories_id."&price=&today_deal=&best_seller=").' ><span>' . $child->categories_name . '</span></a>';

            if (isset($child->childs)) {
                $contents .= '<ul>';
                $contents .= $this->mobileChildcat($child->childs, $parent_id);
                $contents .= "</ul>";
            }

            $contents .= '</li>';

        }
        return $contents;
    }

    public function recursivecategories(){
      $items = DB::table('categories')
          ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
          ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id','categories.sort_order')
          ->where('language_id','=', 1)
          ->where('categories_status', '1')
          ->where('categories.categories_id','>', 0)
          ->orderBy('categories.sort_order','ASC')
          ->get();

          $childs = array();
          foreach($items as $item)
              $childs[$item->parent_id][] = $item;

          foreach($items as $item) if (isset($childs[$item->categories_id]))
              $item->childs = $childs[$item->categories_id];

          if(!empty($childs[0])) {
            $tree = $childs[0];
          }else{
            $tree = $childs;
          }

          return  $tree;
    }

    public function childcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            // if (in_array($child->categories_id, $parent_id)) {
            //     $checked = 'checked';
            // } else {
            //     $checked = '';
            // }
            if (isset($child->childs)) {
                $arrowClass = "fa fa-chevron-right departments__item-arrow";
            }else{
                $arrowClass = "";
            }

            if (isset($child->childs)) {
                $contents .= '<li class="menu__item">
                    <div class="menu__item-submenu-offset"></div>
                    <a class="menu__item-link" href="'.url("/shop?page=&limit=&search=&type=&category=".$child->categories_id."&price=&today_deal=&best_seller=").'"  >' . $child->categories_name . '<i class="' . $arrowClass . '"></i></a>';
            }else{
                $contents .= '<li class="menu__item">
                    <div class="menu__item-submenu-offset"></div>
                    <a class="menu__item-link" href="'.url("/shop?page=&limit=&search=&type=&category=".$child->categories_id."&price=&today_deal=&best_seller=").'"  >' . $child->categories_name . '</a>';
            }

            if (isset($child->childs)) {
                $contents .= '<div class="menu__submenu">
                                <div class="menu menu--layout--classic">
                                    <div class="menu__submenus-container"></div>
                                        <ul class="menu__list">
                                            <li class="menu__item">
                                                <div class="menu__item-submenu-offset"></div>';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</li>
                                    </ul>
                                 </div>
                              </div>";
            }

            $contents .= '</li>';

        }
        return $contents;
    }

    public function cart($request)
    {

        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('customers_basket.*', 'products.products_model as model', 'image_categories.path as image', 'image_categories.image_id as products_image',
                'products_description.products_name as products_name', 'products.products_quantity as quantity',
                'products.products_price as price', 'products.products_weight as weight',
                'products.products_weight_unit as unit')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', 1);


        if(Session::has('supportUserDetails')){
            $current_user_details = Session::get('supportUserDetails');
            $customers_id = $current_user_details['id'];
            $cart->where('customers_basket.customers_id', '=', $customers_id);
        } else {
            $cart->where('customers_basket.session_id', '=', Session::getId());
        }

        $baskit = $cart->get();
        $result = array();
        foreach ($baskit as $baskit_data) {
            //products_image
            $default_images = DB::table('image_categories')
                ->where('image_id', '=', $baskit_data->products_image)
                ->where('image_type', 'THUMBNAIL')
                ->first();

            if ($default_images) {
                $baskit_data->image = $default_images->path;
            } else {
                $default_images = DB::table('image_categories')
                    ->where('image_id', '=', $baskit_data->products_image)
                    ->where('image_type', 'MEDIUM')
                    ->first();

                if ($default_images) {
                    $baskit_data->image = $default_images->path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('image_id', '=', $baskit_data->products_image)
                        ->where('image_type', 'ACTUAL')
                        ->first();
                    $baskit_data->image = $default_images->path;
                }

            }
            array_push($result, $baskit_data);
        }

        return ($result);

    }

    public function menusRecursive()
    {

        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', 1)
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }

            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $div = 0;
                foreach ($menus as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'dropdown-toggle';
                    } else {
                        $dropright = '';
                    }
                    
                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                    } elseif ($parents->type == 1) {
                        $link = ' href="' . url($parents->link) . '"';
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . $parents->link . '"';
                    }else{
                        $link = '#';
                    }

                    $ul .= '<li class="nav-item dropdown "><a class="nav-link  ' . $dropright . '" ' . $link . ' >
                ' . $parents->name . '
                </a>';

                    if (isset($parents->childs)) {
                        $i = 1;
                        $ul .= '<div class="dropdown-menu" >';
                        $ul .= $this->childMenu($parents->childs, $i, $parent_id, $div);
                        $ul .= '</div>';
                        $ul .= '</li>';
                    } else {
                        $ul .= '</li>';
                    }

                }
               
            }

            return $ul;
        }

    }

    private function childMenu($childs, $i, $parent_id, $div)
    {
        $contents = '';
        foreach ($childs as $key => $child) {
            

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . url($child->link) . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail/') . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }

            $contents .= '
                <a class="dropdown-item" ' . $link . '>
                    ' .$child->name . '
                </a>
            ';
            if (isset($child->childs)) {
                $contents .= '
                <div class="dropdown-menu">';
                // $contents .= '
                // <div class="dropdown-submenu submenu1">';

                $k = $i + 1;
                $contents .= $this->childMenu($child->childs, $k, $parent_id, 1);
                $contents .= '</div></div>';
            } elseif ($i > 0) {
                $contents .= '</div>';
            }

        }
        return $contents;
    }


    public function menusRecursiveMobile(){
        $items = DB::table('menus')
            ->leftJoin('menu_translation', 'menus.id', '=', 'menu_translation.menu_id')
            ->select('menus.*', 'menu_translation.menu_name as name', 'menus.parent_id')
            ->where('menu_translation.language_id', '=', Session::get('language_id'))
            ->where('menus.status', 1)
            ->orderBy('menus.sort_order', 'ASC')
            ->get();
        if ($items->isNotEmpty()) {
            $childs = array();
            foreach ($items as $item) {
                $childs[$item->parent_id][] = $item;
            }

            foreach ($items as $item) {
                if (isset($childs[$item->id])) {
                    $item->childs = $childs[$item->id];
                }
            }

            if (!empty($childs[0])) {
                $menus = $childs[0];
            } else {
                $menus = $childs;
            }
            
            $ul = '';
            if ($menus) {
                $parent_id = 0;
                $ul = '';
                $i = 1;
                foreach ($menus as $parents) {
                    if (isset($parents->childs)) {
                        $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
                    } else {
                        $dropright = '';
                    }
                    
                    if ($parents->type == 0) {
                        $link = ' target="_blank" href="' . $parents->link . '"';
                    } elseif ($parents->type == 1) {
                        $link = ' href="' . $parents->link . '"';
                    } elseif ($parents->type == 2) {
                        $link = ' href="' . url('page?name=') . $parents->link . '"';
                    } elseif ($parents->type == 3) {
                        $link = ' href="' . url('shop?category=') . $parents->link . '"';
                    } elseif ($parents->type == 4) {
                        $link = ' href="' . url('product-detail/') . $parents->link . '"';
                    } elseif ($parents->type == 5) {
                        $link = ' href="' . url('') . $parents->link . '"';
                    }else{
                        $link = '#';
                    }

                    $ul .= '<a class="main-manu btn btn-primary"'  . $dropright . ' ' . $link  .' >
                ' . $parents->name;
                    if (isset($parents->childs)) {
                        $ul .= '<span><i class="fas fa-chevron-down"></i></span>
                            <span><i class="fas fa-chevron-up"></i></span>';
                    }
                    $ul .='</a>';

                    if (isset($parents->childs)) {
                        $ul .= '<div class="sub-manu collapse multi-collapse" id="shoppages'.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $ul .= $this->childMenuMobile($parents->childs, $i);
                        $ul .= '</li></ul>
                        </div>';
                        $i++;
                    } 

                }
               
            }

            return $ul;
        }
    }

    private function childMenuMobile($childs, $i)
    {
        $contents = '';
        foreach ($childs as $key => $child) {

            if (isset($child->childs)) {
                $i++;
                $dropright = 'data-toggle="collapse" href="#shoppages'.$i.'" role="button" aria-expanded="false" aria-controls="shoppages'.$i.'"';
            } else {
                $dropright = '';
            }

             $contents .= '
                <div class="dropdown-submenu submenu1">';

            if ($child->type == 0) {
                $link = ' target="_blank" href="' . $child->link . '"';
            } elseif ($child->type == 1) {
                $link = ' href="' . $child->link . '"';
            } elseif ($child->type == 2) {
                $link = ' href="' . url('page?name=') . $child->link . '"';
            } elseif ($child->type == 3) {
                $link = ' href="' . url('shop?category=') . $child->link . '"';
            } elseif ($child->type == 4) {
                $link = ' href="' . url('product-detail/') . $child->link . '"';
            } elseif ($child->type == 5) {
                $link = ' href="' . url('') . $child->link . '"';
            }
            $contents .= '<a class="main-manu btn btn-primary"'  . $dropright . ' ' . $link  .' >
            ' . $child->name;
                if (isset($child->childs)) {
                    $contents .= '<span><i class="fas fa-chevron-down"></i></span>
                        <span><i class="fas fa-chevron-up"></i></span>';
                }
            $contents .='</a>';

            if (isset($child->childs)) {

                $contents .= '<div class="sub-manu collapse multi-collapse" id="shoppages'.$i.'">
                        <ul class="unorder-list"><li class="">';
                        $contents .= $this->childMenuMobile($child->childs, $i);
                        $contents .= '</li></ul>
                        </div>';
            } 

        }
        return $contents;
    }
}
