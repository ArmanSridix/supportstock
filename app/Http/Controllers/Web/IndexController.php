<?php
namespace App\Http\Controllers\Web;

use App\Models\Web\Currency;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\News;
use App\Models\Web\Order;
use App\Models\Web\Products;
use Auth;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Lang;
use View;
use DB;
use Cookie;
use Session;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\Web\AlertController;


class IndexController extends Controller
{

    public function __construct(
        Index $index,
        News $news,
        Languages $languages,
        Products $products,
        Currency $currency,
        Order $order
    ) {
        $this->index = $index;
        $this->order = $order;
        $this->news = $news;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        //$this->theme = new ThemeController();
    }

    public function index()
    {
        $title = array('pageTitle' => "Home");
        //$final_theme = $this->theme->theme();
        /*********************************************************************/
        /**                   GENERAL CONTENT TO DISPLAY                    **/
        /*********************************************************************/
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        // echo "<pre>";
        // print_r($result['commonContent']);exit;

        $currentDate = Carbon\Carbon::now();
        $currentDate = $currentDate->toDateTimeString();
        $carousel_id = 1;

        $slides = $this->index->slidesByCarousel($currentDate, $carousel_id);
        $result['slides'] = $slides;

        $userAssignCategory = array();
        if(Session::has('supportUserDetails')){
            $current_user_details = Session::get('supportUserDetails');
            if ($current_user_details['user_type']=='Corporate') {
                $userCategoryArray = $current_user_details->userCategoryArray;
                if (!empty($userCategoryArray)) {
                    $userAssignCategory = DB::table('categories')
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
                        ->whereIn('categories.categories_id', $userCategoryArray)
                        ->where('categories_description.language_id', '=', 1)
                        ->where('categories.categories_status', 1)
                        ->groupBy('categories.categories_id')
                        ->get();
                }
            }
        }
        $result['userAssignCategory'] = $userAssignCategory;
        // echo "<pre>";
        // print_r($userAssignCategory);exit;
        
        /********************************************************************/

        /*********************************************************************/
        /**                   GENERAL SETTINGS TO FETCH PRODUCTS           **/
        /*******************************************************************/

        /**  SET LIMIT OF PRODUCTS  **/
        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 5;
        }

        /**  MINIMUM PRICE **/
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        /**  MAXIMUM PRICE  **/
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }
        /*************************************************************************/
        /*********************************************************************/
        /**                     FETCH NEWEST PRODUCTS                       **/
        /*********************************************************************/

        $data = array('page_number' => '0', 'type' => '', 'limit' => 6, 'min_price' => $min_price, 'max_price' => $max_price, 'today_deal' => '1');
        $today_deal_products = $this->products->products($data);
        $result['today_deal_products'] = $today_deal_products;

        $data = array('page_number' => '0', 'type' => '', 'limit' => 6, 'min_price' => $min_price, 'max_price' => $max_price, 'best_seller' => '1');
        $best_seller_products = $this->products->products($data);
        $result['best_seller_products'] = $best_seller_products;

        // echo "<pre>";
        // print_r($result['best_seller_products']);exit;
        /*********************************************************************/
        
        /*********************************************************************/
        // $catDetails = DB::table('front_category')->where('front_category_id','=', 2)->first();
        // $catDetails = DB::table('categories')->where('parent_id','=', 0)->get();
        // // dd($catDetails);
        // $categories_ids = $catDetails->categories_ids;
        // $categories_ids_array = explode(",",$categories_ids);

        // $result['productByCategory'] = array();
        // if (!empty($categories_ids_array)) {
        //     foreach ($categories_ids_array as $key => $value) {
        //         $catDetail = DB::table('categories')
        //             ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
        //             ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
        //             ->where('categories.categories_id','=', $value)
        //             ->first();
        //         // dd($catDetail);
        //         // echo $value;
        //         // $items = DB::table('categories')
        //         //     ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
        //         //     ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
        //         //     ->where('categories.categories_id','>', 0)
        //         //     ->get();

        //         // $childs = array();
        //         // foreach($items as $item)
        //         //     $childs[$item->parent_id][] = $item;

        //         // foreach($items as $item) if (isset($childs[$item->categories_id]))
        //         //     $item->childs = $childs[$item->categories_id];

        //         // if(!empty($childs[0])) {
        //         //     $tree = $childs[0];
        //         // }else{
        //         //     $tree = $childs;
        //         // }

        //         // echo "<pre>";
        //         // print_r($tree);exit;
        //         if (!empty($catDetail)) {
        //             $data = array('page_number' => '0', 'type' => '', 'limit' => 6, 'min_price' => $min_price, 'max_price' => $max_price, 'categories_id' => $value);
        //             $product = $this->products->products($data);
        //             $product['categories_name'] = $catDetail->categories_name;
        //             $product['catIdArr'] = $value;
        //             array_push($result['productByCategory'], $product);
        //         }

        //     }
        //             // dd($result['productByCategory']);
        // }

        $catDetails = DB::table('categories')->where('parent_id','=', 0)->get();
        
        foreach($catDetails as $catDetailsval){
        // dd($catDetails);
        $categories_ids = $catDetailsval->categories_id;
        $categories_ids_array = explode(",",$categories_ids);
        // dd($categories_ids_array);
        $result['productByCategory'] = array();
        if (!empty($categories_ids_array)) {
            foreach ($categories_ids_array as $key => $value) {
                // $catDetail = DB::table('categories')
                //     ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                //     ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                //     ->where('categories.categories_id','=', $value)
                //     ->first();
                // dd($catDetail);
                // echo $value;
                $catDetail = DB::table('categories')
                    ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
                    ->where('categories.categories_id','<', 0)
                    ->first();

                // $childs = array();
                // foreach($items as $item)
                //     $childs[$item->parent_id][] = $item;

                // foreach($items as $item) if (isset($childs[$item->categories_id]))
                //     $item->childs = $childs[$item->categories_id];

                // if(!empty($childs[0])) {
                //     $tree = $childs[0];
                // }else{
                //     $tree = $childs;
                // }

                // echo "<pre>";
                // print_r($tree);exit;
                if (!empty($catDetail)) {
                    $data = array('page_number' => '0', 'type' => '', 'limit' => 6, 'min_price' => $min_price, 'max_price' => $max_price, 'categories_id' => $value);
                    $product = $this->products->products($data);
                    // dd($product);
                    $product['categories_name'] = $catDetail->categories_name;
                    $product['catIdArr'] = $value;
                    array_push($result['productByCategory'], $product);
                }

            }
        }
                   
     }

        // echo "<pre>";
        // print_r($result['productByCategory']);exit;
        /*********************************************************************/

        /***************************************************************/
        /**   CART ARRAY RECORDS TO CHECK WETHER OR NOT DISPLAYED--   **/
        /**  --PRODUCT HAS BEEN ALREADY ADDE TO CART OR NOT           **/
        /***************************************************************/
        // $cart = '';
        // $result['cartArray'] = $this->products->cartIdArray($cart);
        /**************************************************************/

        //special products
        // $data = array('page_number' => '0', 'type' => 'special', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        // $special_products = $this->products->products($data);
        // $result['special'] = $special_products;
//Flash sale

        // $data = array('page_number' => '0', 'type' => 'flashsale', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        // $flash_sale = $this->products->products($data);
        // $result['flash_sale'] = $flash_sale;
// //top seller
        // $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        // $top_seller = $this->products->products($data);
        // $result['top_seller'] = $top_seller;

//most liked
        // $data = array('page_number' => '0', 'type' => 'mostliked', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        // $most_liked = $this->products->products($data);
        // $result['most_liked'] = $most_liked;

//is feature
        // $data = array('page_number' => '0', 'type' => 'is_feature', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
        // $featured = $this->products->products($data);
        // $result['featured'] = $featured;

        // $data = array('page_number' => '0', 'type' => '', 'limit' => '15', 'is_feature' => 1);
        // $news = $this->news->getAllNews($data);
        // $result['news'] = $news;
//current time



        //liked products
        //$result['liked_products'] = $this->products->likedProducts();

        // $orders = $this->order->getOrders();
        // if (count($orders) > 0) {
        //     $allOrders = $orders;
        // } else {
        //     $allOrders = $this->order->allOrders();
        // }

        // $temp_i = array();
        // foreach ($allOrders as $orders_data) {
        //     $mostOrdered = $this->order->mostOrders($orders_data);
        //     foreach ($mostOrdered as $mostOrderedData) {
        //         $temp_i[] = $mostOrderedData->products_id;
        //     }
        // }
        // $detail = array();
        // $temp_i = array_unique($temp_i);
        // foreach ($temp_i as $temp_data) {
        //     $data = array('page_number' => '0', 'type' => 'topseller', 'products_id' => $temp_data, 'limit' => 7, 'min_price' => '', 'max_price' => '');
        //     $single_product = $this->products->products($data);
        //     if (!empty($single_product['product_data'][0])) {
        //         $detail[] = $single_product['product_data'][0];
        //     }
        // }

        // $result['weeklySoldProducts'] = array('success' => '1', 'product_data' => $detail, 'message' => "Returned all products.", 'total_record' => count($detail));
        
        // session(['paymentResponseData' => '']); 
            
        // session(['paymentResponse'=>'']);
        // session(['payment_json','']);
        
        //return view("web.index", ['title' => $title, 'final_theme' => $final_theme])->with(['result' => $result]);


        return view("web.index")->with(['result' => $result]);
    }


    public function pincodesByCity(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $cities_id = $input['cities_id'];

        $pincode_list = DB::table('pincodes')
            ->select('pincodes.*','manufacturers_pincodes.manufacturers_id')
            ->join('manufacturers_pincodes','manufacturers_pincodes.pincodes_id', '=', 'pincodes.pincodes_id')
            ->join('manufacturers','manufacturers.manufacturers_id', '=', 'manufacturers_pincodes.manufacturers_id')
            ->where('pincodes.pincodes_city_id',"=",$cities_id)
            ->where('manufacturers.is_active',"=",1)
            ->where('manufacturers.is_delete',"=",0)
            ->get();

        return response()->json(['pincode_list'=>$pincode_list]);

    }


    public function checkPincodeExist(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $pincodes_id = $input['pincodes_id'];

        $pincode_detail = DB::table('pincodes')
            ->where('pincodes_id',"=",$pincodes_id)
            ->get();
        if (count($pincode_detail)>0) {

            if(Session::has('supportUserDetails')){
                $current_user_details = Session::get('supportUserDetails');

                if ($current_user_details->web_pincod_id !=0 || $current_user_details->web_pincod_id !='') {
                    if ($current_user_details->web_pincod_id != $pincode_detail[0]->pincodes_id) {
                        DB::table('customers_basket')->where('customers_id', '=', $current_user_details->id)->where('is_order', '=', 0)->delete();
                    }
                }

                DB::table('users')
                    ->where('id', $current_user_details->id)
                    ->update(array(
                        'web_pincod_id' => $pincode_detail[0]->pincodes_id,
                    ));
            }

            $pincode_exist = 'yes';
            Session::put('user_pincode_id', $pincode_detail[0]->pincodes_id);
        }else{
            $pincode_exist = 'no';
        }

        return response()->json(['pincode_exist'=>$pincode_exist]);

    }

    

    public function maintance()
    {
        return view('errors.maintance');
    }

    public function error()
    {
        return view('errors.general_error', ['msg' => $msg]);
    }

    // public function logout()
    // {
    //     Auth::guard('customer')->logout();
    //     return redirect()->back();
    // }
    // public function test()
    // {
    //     $productcategories = $this->products->productCategories1();
    //     echo print_r($productcategories);

    // }

    // private function setHeader($header_id)
    // {
    //     $count = $this->order->countCompare();
    //     $languages = $this->languages->languages();
    //     $currencies = $this->currencies->getter();
    //     $productcategories = $this->products->productCategories();
    //     $title = array('pageTitle' => Lang::get("website.Home"));
    //     $result = array();
    //     $result['commonContent'] = $this->index->commonContent();

    //     if ($header_id == 1) {

    //         $header = (string) View::make('web.headers.headerOne', ['count' => $count, 'currencies' => $currencies, 'languages' => $languages, 'productcategories' => $productcategories, 'result' => $result])->render();
    //     } elseif ($header_id == 2) {
    //         $header = (string) View::make('web.headers.headerTwo');
    //     } elseif ($header_id == 3) {
    //         $header = (string) View::make('web.headers.headerThree')->render();
    //     } elseif ($header_id == 4) {
    //         $header = (string) View::make('web.headers.headerFour')->render();
    //     } elseif ($header_id == 5) {
    //         $header = (string) View::make('web.headers.headerFive')->render();
    //     } elseif ($header_id == 6) {
    //         $header = (string) View::make('web.headers.headerSix')->render();
    //     } elseif ($header_id == 7) {
    //         $header = (string) View::make('web.headers.headerSeven')->render();
    //     } elseif ($header_id == 8) {
    //         $header = (string) View::make('web.headers.headerEight')->render();
    //     } elseif ($header_id == 9) {
    //         $header = (string) View::make('web.headers.headerNine')->render();
    //     } else {
    //         $header = (string) View::make('web.headers.headerTen')->render();
    //     }
    //     return $header;
    // }

    // private function setBanner($banner_id)
    // {
    //     if ($banner_id == 1) {
    //         $banner = (string) View::make('web.banners.banner1')->render();
    //     } elseif ($banner_id == 2) {
    //         $banner = (string) View::make('web.banners.banner2')->render();
    //     } elseif ($banner_id == 3) {
    //         $banner = (string) View::make('web.banners.banner3')->render();
    //     } elseif ($banner_id == 4) {
    //         $banner = (string) View::make('web.banners.banner4')->render();
    //     } elseif ($banner_id == 5) {
    //         $banner = (string) View::make('web.banners.banner5')->render();
    //     } elseif ($banner_id == 6) {
    //         $banner = (string) View::make('web.banners.banner6')->render();
    //     } elseif ($banner_id == 7) {
    //         $banner = (string) View::make('web.banners.banner7')->render();
    //     } elseif ($banner_id == 8) {
    //         $banner = (string) View::make('web.banners.banner8')->render();
    //     } elseif ($banner_id == 9) {
    //         $banner = (string) View::make('web.banners.banner9')->render();
    //     } elseif ($banner_id == 10) {
    //         $banner = (string) View::make('web.banners.banner10')->render();
    //     } elseif ($banner_id == 11) {
    //         $banner = (string) View::make('web.banners.banner11')->render();
    //     } elseif ($banner_id == 12) {
    //         $banner = (string) View::make('web.banners.banner12')->render();
    //     } elseif ($banner_id == 13) {
    //         $banner = (string) View::make('web.banners.banner13')->render();
    //     } elseif ($banner_id == 14) {
    //         $banner = (string) View::make('web.banners.banner14')->render();
    //     } elseif ($banner_id == 15) {
    //         $banner = (string) View::make('web.banners.banner15')->render();
    //     } elseif ($banner_id == 16) {
    //         $banner = (string) View::make('web.banners.banner16')->render();
    //     } elseif ($banner_id == 17) {
    //         $banner = (string) View::make('web.banners.banner17')->render();
    //     } elseif ($banner_id == 18) {
    //         $banner = (string) View::make('web.banners.banner18')->render();
    //     } elseif ($banner_id == 19) {
    //         $banner = (string) View::make('web.banners.banner19')->render();
    //     } else {
    //         $banner = (string) View::make('web.banners.banner20')->render();
    //     }
    //     return $banner;
    // }

    // private function setFooter($footer_id)
    // {
    //     if ($footer_id == 1) {
    //         $footer = (string) View::make('web.footers.footer1')->render();
    //     } elseif ($footer_id == 2) {
    //         $footer = (string) View::make('web.footers.footer2')->render();
    //     } elseif ($footer_id == 3) {
    //         $footer = (string) View::make('web.footers.footer3')->render();
    //     } elseif ($footer_id == 4) {
    //         $footer = (string) View::make('web.footers.footer4')->render();
    //     } elseif ($footer_id == 5) {
    //         $footer = (string) View::make('web.footers.footer5')->render();
    //     } elseif ($footer_id == 6) {
    //         $footer = (string) View::make('web.footers.footer6')->render();
    //     } elseif ($footer_id == 7) {
    //         $footer = (string) View::make('web.footers.footer7')->render();
    //     } elseif ($footer_id == 8) {
    //         $footer = (string) View::make('web.footers.footer8')->render();
    //     } elseif ($footer_id == 9) {
    //         $footer = (string) View::make('web.footers.footer9')->render();
    //     } else {
    //         $footer = (string) View::make('web.footers.footer10')->render();
    //     }
    //     return $footer;
    // }
    // //page
    // public function page(Request $request)
    // {

    //     $pages = $this->order->getPages($request);
    //     if (count($pages) > 0) {
    //         $title = array('pageTitle' => $pages[0]->name);
    //         $final_theme = $this->theme->theme();
    //         $result['commonContent'] = $this->index->commonContent();
    //         $result['pages'] = $pages;
    //         return view("web.page", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    //     } else {
    //         return redirect()->intended('/');
    //     }
    // }
    // //myContactUs
    public function contactUs(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $contactDetails = DB::table('contact_us')->where('contact_us_id','=', 1)->first();
        $result['contactDetails'] = $contactDetails;

        //Session::forget('contact_otp_session');

        return view("web.contact_us")->with(['result' => $result]);
    }

    public function contactOtpSend(Request $request)
    {
        $input = $request->all();
        $data['contact_name'] = $input['contact_name'];
        $data['contact_phone'] = $input['contact_phone'];
        $data['contact_mail'] = $input['contact_mail'];
        $rand_otp = mt_rand(100000,999999);
        $data['rand_otp'] = $rand_otp;

        /************/
        $myVar = new AlertController();
        $alertSetting = $myVar->contactusOtpAlert($data);

        $phone = $data['contact_phone'];
        $msg = "Your New OTP ".$rand_otp." by Supportstock.";
        $template_id = '1707162071908056513';
        $mySms = new SmsController();
        $mySms->sendSms($phone,$msg,$template_id);
        /************/
        //session(['contact_otp_session' => $rand_otp]);

        return response()->json(['rand_otp'=>$rand_otp]);

    }

    public function contactUsMail(Request $request)
    {
        $contact_us_comments_id = DB::table('contact_us_comments')->insertGetId([
            'contact_name' => $request->contact_name,
            'contact_mail' => $request->contact_mail,
            'contact_phone' => $request->contact_phone,
            'contact_comment' => $request->contact_comment,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        //Session::forget('contact_otp_session');

        // $contactData = array(
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'subject' => $request->subject,
        //     'comments' => $request->comments,
        //     'date' => date('d-m-Y'),
        //     'toMail' => 'aryabhata16@gmail.com'
        // );

        // $myVar = new AlertController();
        // $alertSetting = $myVar->contact_us_mail($contactData);

        // $alertSetting = $myVar->contact_us_mail_user($contactData);

        $message = "Message has been sent successfully.";
        return redirect()->back()->withErrors([$message]);
    }

    public function aboutUs(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $aboutusDetails = DB::table('cms')->where('cms_id','=', 1)->first();
        $result['aboutusDetails'] = $aboutusDetails;

        return view("web.about_us")->with(['result' => $result]);
    }

    public function sellerBenefits(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $seller_benefits = DB::table('cms')->where('cms_id','=', 4)->first();
        $result['seller_benefits'] = $seller_benefits;

        return view("web.seller_benefits")->with(['result' => $result]);
    }

    public function corporateLoginBenefits(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $corporate_login_benefits = DB::table('cms')->where('cms_id','=', 5)->first();
        $result['corporate_login_benefits'] = $corporate_login_benefits;

        return view("web.corporate_login_benefits")->with(['result' => $result]);
    }

    public function termAndCondition(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $termsDetails = DB::table('cms')->where('cms_id','=', 2)->first();
        $result['termsDetails'] = $termsDetails;

        return view("web.term_condition")->with(['result' => $result]);
    }

    public function privacyPolicy(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 3)->first();
        $result['Details'] = $Details;

        return view("web.privacy_policy")->with(['result' => $result]);
    }

    public function faq(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $faq_list = DB::table('faq')
            ->select('faq.*')
            ->where('faq.faq_status', 1)
            ->orderBy('faq.faq_id', 'DESC')
            ->groupBy('faq.faq_id')
            ->get();
        $result['faq_list'] = $faq_list;
        
        return view("web.faq")->with(['result' => $result]);
    }
    // //processContactUs
    // public function processContactUs(Request $request)
    // {
    //     $name = $request->name;
    //     $email = $request->email;
    //     $subject = $request->subject;
    //     $message = $request->message;

    //     $result['commonContent'] = $this->index->commonContent();

    //     $data = array('name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message, 'adminEmail' => $result['commonContent']['setting'][3]->value);

    //     Mail::send('/mail/contactUs', ['data' => $data], function ($m) use ($data) {
    //         $m->to($data['adminEmail'])->subject(Lang::get("website.contact us title"))->getSwiftMessage()
    //             ->getHeaders()
    //             ->addTextHeader('x-mailgun-native-send', 'true');
    //     });

    //     return redirect()->back()->with('success', Lang::get("website.contact us message"));
    // }

    // //setcookie
    // public function setcookie(Request $request)
    // {
    //     Cookie::queue('cookies_data', 1, 4000);
    //     return json_encode(array('accept'=>'yes'));
    // }

    // //newsletter
    // public function newsletter(Request $request)
    // {
    //     if (!empty(auth()->guard('customer')->user()->id)) {
    //         $customers_id = auth()->guard('customer')->user()->id;  
    //         $existUser = DB::table('customers')
    //                       ->leftJoin('users','customers.customers_id','=','users.id')
    //                       ->where('customers.fb_id', '=', $customers_id)
    //                       ->first();

                      
    //         if($existUser){                
    //             DB::table('customers')->where('user_id','=',$customers_id)->update([
    //                 'customers_newsletter' => 1,
    //             ]);
    //         }else{
    //             DB::table('customers')->insertGetId([
    //                 'user_id' => $customers_id,
    //                 'customers_newsletter' => 1,
    //             ]);
    //         }
                                            
    //     }
    //     session(['newsletter' => 1]);
        
    //     return 'subscribed';
    // }


    // public function subscribeMail(Request $request){
    //     $settings = $this->index->commonContent();
    //     if(!empty($settings['setting'][122]->value) and !empty($settings['setting'][122]->value)){        
    //         $email = $request->email;

    //         $list_id = $settings['setting'][123]->value;
    //         $api_key = $settings['setting'][122]->value;
            
    //         $data_center = substr($api_key,strpos($api_key,'-')+1);
            
    //         $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';
            
    //         $json = json_encode([
    //             'email_address' => $email,
    //             'status'        => 'subscribed', //pass 'subscribed' or 'pending'
    //         ]);
            
    //         $ch = curl_init($url);
    //         curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //         $result = curl_exec($ch);
    //         $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //         curl_close($ch);
            
    //         if($status_code==200){
    //             //subscribed
    //             print '1';
    //         }elseif($status_code==400){
    //             print '2';
    //         }else{
    //             print '0';
    //         }
    //     }else{
    //         print '0';
    //     }
        
    // }

    // //setsession
    // public function setSession(Request $request){
    //     session(['device_id'=>$request->device_id]);
        
    // }

    public function sellOnSupportstock(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $sell_on_support_id = DB::table('sell_on_support')->insertGetId([
            'sName' => $request->sName,
            'sEmail' => $request->sEmail,
            'sPhone' => $request->sPhone,
            'sFeedback' => $request->sFeedback,
            'created_at' => date('y-m-d h:i:s')
        ]);

        $message = "Your request has been successfully send.";
        return redirect()->back()->with('sellSuccess', $message);
    }


    /******************/
    public function todaysCoupon(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $currentDate = date('Y-m-d 00:00:00', time());
        $couponList = DB::table('coupons')
            ->where([
                ['for_new_user', '=', 0],
                ['expiry_date', '>', $currentDate],
            ])
            ->get();
        $result['couponList'] = $couponList;

        return view("web.todays_coupon")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function payments(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 6)->first();
        $result['Details'] = $Details;

        return view("web.cms_payment")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function shipping(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 7)->first();
        $result['Details'] = $Details;

        return view("web.cms_shipping")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function cancellation_returns(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 8)->first();
        $result['Details'] = $Details;

        return view("web.cms_cancel_return")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function refunds(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 9)->first();
        $result['Details'] = $Details;

        return view("web.cms_refund")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function return_policy(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 10)->first();
        $result['Details'] = $Details;

        return view("web.cms_return_policy")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function security(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 11)->first();
        $result['Details'] = $Details;

        return view("web.cms_security")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function customer_service(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 12)->first();
        $result['Details'] = $Details;

        return view("web.cms_customer_service")->with(['result' => $result]);
    }
    /*********************/

    /*********************/
    public function copyright(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        $Details = DB::table('cms')->where('cms_id','=', 13)->first();
        $result['Details'] = $Details;

        return view("web.cms_copyright")->with(['result' => $result]);
    }
    /*********************/
    

}
