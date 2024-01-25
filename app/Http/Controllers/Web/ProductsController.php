<?php
namespace App\Http\Controllers\Web;

//validator is builtin class in laravel
use App\Models\Web\Currency;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Languages;

//for authenitcate login data
use App\Models\Web\Products;
use Auth;

//for requesting a value
use DB;
//for Carbon a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lang;
use Session;
use \stdClass;
//email

class ProductsController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->theme = new ThemeController();
    }

    public function reviews(Request $request)
    {
        if(Session::has('supportUserDetails')){
            $current_user_details = Session::get('supportUserDetails');
            $customers_id = $current_user_details['id'];

            $check = DB::table('reviews')
                ->where('customers_id', $customers_id)
                ->where('products_id', $request->products_id)
                ->first();

            if ($check) {
                return redirect()->back()->with('reviewError', "You Have Already Given The Comment. Thanks");
            }
            $id = DB::table('reviews')->insertGetId([
                'products_id' => $request->products_id,
                'reviews_rating' => $request->rating,
                'customers_id' => $customers_id,
                'customers_name' => $current_user_details['first_name']." ".$current_user_details['last_name'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            DB::table('reviews_description')
                ->insert([
                    'review_id' => $id,
                    'language_id' => 1,
                    'reviews_text' => $request->reviews_text,
                ]);
            return redirect()->back()->with('reviewSuccess', "Thanks For Your Time And Considration For Providing FeedBack For This Product");
        } else {
            return redirect()->back()->with('middleWareloginError', "Not login");
        }
    }

    //shop
    public function shop(Request $request)
    {
        
        $result = array();

        $result['left_add_details'] = new \stdClass();
        $result['top_add_details'] = new \stdClass();
        $result['bottom_add_details'] = new \stdClass();
        $result['commonContent'] = $this->index->commonContent();
        
        if (!empty($request->page)) {
            $page_number = $request->page;
        } else {
            $page_number = 0;
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 40;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }

        //min_max_price
        if (!empty($request->price)) {
            $d = explode("-", $request->price);
            $min_price = $d[0];
            $max_price = $d[1];
        } else {
            $min_price = '';
            $max_price = '';
        }
        $exist_category = '1';
        $categories_status = 1;
        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            
            if(!empty($category) and count($category)>0){
                $categories_id = $category[0]->categories_id;
                //for main
                if ($category[0]->parent_id == 0) {
                    $category_name = $category[0]->categories_name;
                    $sub_category_name = '';
                    $category_slug = '';
                    $categories_status = $category[0]->categories_status;
                } else {
                    //for sub
                    $main_category = $this->products->getMainCategories($category[0]->parent_id);

                    $category_slug = $main_category[0]->categories_slug;
                    $category_name = $main_category[0]->categories_name;
                    $sub_category_name = $category[0]->categories_name;
                    $categories_status = $category[0]->categories_status;
                }
            }else{
                $categories_id = '';
                $category_name = '';
                $sub_category_name = '';
                $category_slug = '';
                $categories_status = 0;
            }
                            

        } else {
            $categories_id = '';
            $category_name = '';
            $sub_category_name = '';
            $category_slug = '';
            $categories_status = 1;
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['categories_status'] = $categories_status;

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();

            $option = $this->products->getOptions();

            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);

                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }

            $filters['options_count'] = count($options);

            $filters['options'] = implode(',',$options);
            $filters['option_value'] = implode(',',$option_values);

            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;

            $result['filter_attribute']['options'] = $options;
            $result['filter_attribute']['option_values'] = $option_values;
        }

        if (!empty($request->today_deal)) {
            $today_deal = 1;
        } else {
            $today_deal = '';
        }

        if (!empty($request->best_seller)) {
            $best_seller = 1;
        } else {
            $best_seller = '';
        }

        $data = array('page_number' => $page_number, 'type' => $type, 'limit' => $limit,
            'categories_id' => $categories_id, 'search' => $search,
            'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'today_deal' => $today_deal, 'best_seller' => $best_seller);

        $products = $this->products->products($data);        
        $result['products'] = $products;

        // echo "<pre>";
        // print_r($result['products']);exit;

        $data = array('limit' => $limit, 'categories_id' => $categories_id);
        $filters = $this->filters($data);
        $result['filters'] = $filters;

        $categories = $this->recursivecategories();

        $parent_id = array();
        $option = '<ul class="mtree transit">';

        foreach ($categories as $parents) {

            if (isset($parents->childs)) {
                $option .= '<li><a href="javascript:;" >' . $parents->categories_name . '</a>';
            }else{
                $option .= '<li><a href='.url("/shop?page=&limit=&search=&type=&category=".$parents->categories_id."&price=&today_deal=&best_seller=").' >' . $parents->categories_name . '</a>';
            }            

            if (isset($parents->childs)) {
                $option .= '<ul class="submenu">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</ul>';
            }

            $option .= '</li>';
        }
        $option .= '</ul>';
        $result['option'] = $option;

        if ($categories_id!='') {
            $adds_details = DB::table('categories_adds')
                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'categories_adds.adds_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                ->select('categories_adds.*', 'image_categories.path as imgpath')
                ->where('categories_adds.categories_id','=', $categories_id)
                ->get();              
        }else{
            $adds_details = DB::table('categories_adds')
                ->LeftJoin('image_categories', function ($join) {
                    $join->on('image_categories.image_id', '=', 'categories_adds.adds_image')
                        ->where(function ($query) {
                            $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                                ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                                ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                        });
                })
                ->select('categories_adds.*', 'image_categories.path as imgpath')
                //->select('categories_adds.*')
                ->get();
        }
        // $result['adds_details'] = $adds_details;
        $leftCnt = 0;
        $topCnt = 0;
        $bottomCnt = 0;
        if(count($adds_details)>0){
            foreach ($adds_details as $key=>$value) {
                if($value->adds_position == 'left'){
                    if ($leftCnt == 0) {
                        $result['left_add_details'] = $adds_details[$key];
                        $leftCnt = 1;
                    }
                }else if($value->adds_position == 'top'){
                    if ($topCnt == 0) {
                        $result['top_add_details'] = $adds_details[$key];
                        $topCnt = 1;
                    }
                }else if($value->adds_position == 'bottom'){
                    if ($bottomCnt == 0) {
                        $result['bottom_add_details'] = $adds_details[$key];
                        $bottomCnt = 1;
                    }
                }
              }
        }
        // echo "<pre>";print_r($result['left_add_details']);print_r($result['top_add_details']);print_r($result['bottom_add_details']);exit;
        // $cart = '';
        // $result['cartArray'] = $this->products->cartIdArray($cart);

        if ($limit > $result['products']['total_record']) {
            $result['limit'] = $result['products']['total_record'];
        } else {
            $result['limit'] = $limit;
        }

        // //liked products
        // $result['liked_products'] = $this->products->likedProducts();
        // $result['categories'] = $this->products->categories();

        $result['min_price'] = $min_price;
        $result['max_price'] = $max_price;

        // echo "<pre>";
        // print_r($result);exit;

        return view("web.shop")->with(['result' => $result]);

    }

    public function recursivecategories(){
      $items = DB::table('categories')
          ->leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
          ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
          ->where('language_id','=', 1)
          ->where('categories_status', '1')
          ->where('categories.categories_id','>', 0)
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

            if (isset($child->childs)) {
                $contents .= '<li>
                    <a href="javascript:;"  >' . $child->categories_name . '</a>';
            }else{
                $contents .= '<li>
                    <a href="'.url("/shop?page=&limit=&search=&type=&category=".$child->categories_id."&price=&today_deal=&best_seller=").'"  >' . $child->categories_name . '</a>';
            }

            if (isset($child->childs)) {
                $contents .= '<ul class="submenu">';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</ul>";
            }

            $contents .= '</li>';

        }
        return $contents;
    }

    // public function filterProducts(Request $request)
    // {

    //     //min_price
    //     if (!empty($request->min_price)) {
    //         $min_price = $request->min_price;
    //     } else {
    //         $min_price = '';
    //     }

    //     //max_price
    //     if (!empty($request->max_price)) {
    //         $max_price = $request->max_price;
    //     } else {
    //         $max_price = '';
    //     }

    //     if (!empty($request->limit)) {
    //         $limit = $request->limit;
    //     } else {
    //         $limit = 15;
    //     }

    //     if (!empty($request->type)) {
    //         $type = $request->type;
    //     } else {
    //         $type = '';
    //     }

    //     //if(!empty($request->category_id)){
    //     if (!empty($request->category) and $request->category != 'all') {
    //         $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->where('categories_slug', $request->category)->where('language_id', Session::get('language_id'))->get();

    //         $categories_id = $category[0]->categories_id;
    //     } else {
    //         $categories_id = '';
    //     }

    //     //search value
    //     if (!empty($request->search)) {
    //         $search = $request->search;
    //     } else {
    //         $search = '';
    //     }

    //     //min_price
    //     if (!empty($request->min_price)) {
    //         $min_price = $request->min_price;
    //     } else {
    //         $min_price = '';
    //     }

    //     //max_price
    //     if (!empty($request->max_price)) {
    //         $max_price = $request->max_price;
    //     } else {
    //         $max_price = '';
    //     }

    //     if (!empty($request->filters_applied) and $request->filters_applied == 1) {
    //         $filters['options_count'] = count($request->options_value);
    //         $filters['options'] = $request->options;
    //         $filters['option_value'] = $request->options_value;
    //     } else {
    //         $filters = array();
    //     }

    //     $data = array('page_number' => $request->page_number, 'type' => $type, 'limit' => $limit, 'categories_id' => $categories_id, 'search' => $search, 'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    //     $products = $this->products->products($data);
    //     $result['products'] = $products;

    //     $cart = '';
    //     $result['cartArray'] = $this->products->cartIdArray($cart);
    //     $result['limit'] = $limit;
    //     $result['commonContent'] = $this->index->commonContent();
    //     return view("web.filterproducts")->with('result', $result);

    // }

    // public function ModalShow(Request $request)
    // {
    //     $result = array();
    //     $result['commonContent'] = $this->index->commonContent();
    //     $final_theme = $this->theme->theme();
    //     //min_price
    //     if (!empty($request->min_price)) {
    //         $min_price = $request->min_price;
    //     } else {
    //         $min_price = '';
    //     }

    //     //max_price
    //     if (!empty($request->max_price)) {
    //         $max_price = $request->max_price;
    //     } else {
    //         $max_price = '';
    //     }

    //     if (!empty($request->limit)) {
    //         $limit = $request->limit;
    //     } else {
    //         $limit = 15;
    //     }

    //     $products = $this->products->getProductsById($request->products_id);

    //     $products = $this->products->getProductsBySlug($products[0]->products_slug);
    //     //category
    //     $category = $this->products->getCategoryByParent($products[0]->products_id);

    //     if (!empty($category) and count($category) > 0) {
    //         $category_slug = $category[0]->categories_slug;
    //         $category_name = $category[0]->categories_name;
    //     } else {
    //         $category_slug = '';
    //         $category_name = '';
    //     }
    //     $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

    //     if (!empty($sub_category) and count($sub_category) > 0) {
    //         $sub_category_name = $sub_category[0]->categories_name;
    //         $sub_category_slug = $sub_category[0]->categories_slug;
    //     } else {
    //         $sub_category_name = '';
    //         $sub_category_slug = '';
    //     }

    //     $result['category_name'] = $category_name;
    //     $result['category_slug'] = $category_slug;
    //     $result['sub_category_name'] = $sub_category_name;
    //     $result['sub_category_slug'] = $sub_category_slug;

    //     $isFlash = $this->products->getFlashSale($products[0]->products_id);

    //     if (!empty($isFlash) and count($isFlash) > 0) {
    //         $type = "flashsale";
    //     } else {
    //         $type = "";
    //     }

    //     $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    //     $detail = $this->products->products($data);
    //     $result['detail'] = $detail;
    //     $postCategoryId = '';
    //     if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
    //         $i = 0;
    //         foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
    //             if ($i == 0) {
    //                 $postCategoryId = $postCategory->categories_id;
    //                 $i++;
    //             }
    //         }
    //     }

    //     $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    //     $simliar_products = $this->products->products($data);
    //     $result['simliar_products'] = $simliar_products;

    //     $cart = '';
    //     $result['cartArray'] = $this->products->cartIdArray($cart);

    //     //liked products
    //     $result['liked_products'] = $this->products->likedProducts();
    //     return view("web.common.modal1")->with('result', $result);
    // }

    // //access object for custom pagination
    // public function accessObjectArray($var)
    // {
    //     return $var;
    // }

     //productDetail
     public function productDetail(Request $request)
     {
         $result = array();
         $result['commonContent'] = $this->index->commonContent();

         // echo "<pre>";
         // print_r($result['commonContent']);exit;

         $result['cityList'] = DB::table('cities')->get();
         
         //min_price
         if (!empty($request->min_price)) {
             $min_price = $request->min_price;
         } else {
             $min_price = '';
         }
 
         //max_price
         if (!empty($request->max_price)) {
             $max_price = $request->max_price;
         } else {
             $max_price = '';
         }
 
         if (!empty($request->limit)) {
             $limit = $request->limit;
         } else {
             $limit = 15;
         }
 
         $request->products_id = last(explode('-',$request->products_id));
         $products = $this->products->getProductsById($request->products_id);
         if(!empty($products) and count($products)>0){
             
             //category
             $category = $this->products->getCategoryByParent($products[0]->products_id);
 
             if (!empty($category) and count($category) > 0) {
                 $category_slug = $category[0]->categories_slug;
                 $category_name = $category[0]->categories_name;
             } else {
                 $category_slug = '';
                 $category_name = '';
             }
             $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);
 
             if (!empty($sub_category) and count($sub_category) > 0) {
                 $sub_category_name = $sub_category[0]->categories_name;
                 $sub_category_slug = $sub_category[0]->categories_slug;
             } else {
                 $sub_category_name = '';
                 $sub_category_slug = '';
             }
 
             $result['category_name'] = $category_name;
             $result['category_slug'] = $category_slug;
             $result['sub_category_name'] = $sub_category_name;
             $result['sub_category_slug'] = $sub_category_slug;
 
             $isFlash = $this->products->getFlashSale($products[0]->products_id);
 
             if (!empty($isFlash) and count($isFlash) > 0) {
                 $type = "flashsale";
             } else {
                 $type = "";
             }
             $postCategoryId = '';
             $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             $detail = $this->products->products($data);

            // echo "<pre>";
            // print_r($detail);exit;
            $sellerDetails = array();
            if ($detail['product_data'][0]->manufacturers_id!='') {
                $sellerDetails = DB::table('manufacturers')
                    ->where('manufacturers_id', $detail['product_data'][0]->manufacturers_id)
                    ->get();
            }
            $detail['product_data'][0]->sellerDetails = $sellerDetails;
            
            /******* bulk price list *******/
            $BulkPrice = DB::table('product_bulk_price')
                ->orderBy('product_bulk_price_id', 'ASC')
                ->where('products_id','=',$detail['product_data'][0]->products_id);

            if(Session::has('supportUserDetails')){

                $current_user_details = Session::get('supportUserDetails');
                if ($current_user_details['user_type']=='Corporate') {

                    if ($current_user_details['assign_type']=='Category') {

                        $userCategoryArray = $current_user_details->userCategoryArray;
                        $productCategory = $detail['product_data'][0]->categories;
                      
                        if (!empty($productCategory)) {
                            $catCheck = 0;
                            foreach ($productCategory as $key => $value) {
                                if (in_array($value->categories_id, $userCategoryArray)) {
                                    $catCheck = 1;
                                }
                            }
                            
                            if ($catCheck == 1) {
                                $BulkPrice->where('user_type','=','Corporate');
                            }else{
                                $BulkPrice->where('user_type','=','Normal');
                            }
                        }else{
                            $BulkPrice->where('user_type','=','Normal');
                        }

                    }else if ($current_user_details['assign_type']=='Product') {

                        $userProductArray = $current_user_details->userProductArray;
                        $catCheck = 0;
                        if (in_array($detail['product_data'][0]->products_id, $userProductArray)) {
                            $catCheck = 1;
                        }
                        if ($catCheck == 1) {
                            $BulkPrice->where('user_type','=','Corporate');
                        }else{
                            $BulkPrice->where('user_type','=','Normal');
                        }

                    }else{
                        $BulkPrice->where('user_type','=','Normal');
                    }                    
                    
                }else{
                    $BulkPrice->where('user_type','=','Normal');
                }

            }else{
                $BulkPrice->where('user_type','=','Normal');
            }

            $BulkPriceList = $BulkPrice->get();

            $detail['product_data'][0]->BulkPriceList = $BulkPriceList;
            /******* bulk price list *******/
            
            $result['detail'] = $detail;

            // echo "<pre>";
            // print_r($result['detail']);exit;

             if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
                 $i = 0;
                 foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                     if ($i == 0) {
                         $postCategoryId = $postCategory->categories_id;
                         $i++;
                     }
                 }
             }
             
 
             $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => '10', 'min_price' => $min_price, 'max_price' => $max_price, 'trending_product' => '1');
             $simliar_trending_products = $this->products->products($data);
             $result['simliar_trending_products'] = $simliar_trending_products;

            //  echo "<pre>";
            // print_r($result['simliar_trending_products']);exit;

             //Rencently added products
            $data = array('page_number' => '0', 'type' => '', 'categories_id' => '', 'limit' => '10', 'min_price' => $min_price, 'max_price' => $max_price);
             $recentProducts = $this->products->products($data);
             $result['recentProducts'] = $recentProducts;
 
             // $cart = '';
             // $result['cartArray'] = $this->products->cartIdArray($cart);
 
             //liked products
             // $result['liked_products'] = $this->products->likedProducts();
 
             // $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
             // $top_seller = $this->products->products($data);
             // $result['top_seller'] = $top_seller;		
         }else{
             $products = '';
             $result['detail']['product_data'] = '';
         }
        $rating = DB::table('reviews')->select('reviews_rating')->where('products_id',$products[0]->products_id)->get();

        $averageRating = DB::table('reviews')->where('products_id', $products[0]->products_id)
                 ->whereNotNull('reviews_rating')
                 ->avg('reviews_rating');
        $averageRating = number_format($averageRating, 0);
        // dd($averageRating);
         
        $result['rating'] = $rating;
        $result['averageRating'] = $averageRating;

        
        // New By Arman
             $cityId = $sellerDetails[0]->seller_city_id;
            $city = DB::table('cities')->where('cities_id', $cityId)->first();

            $manufacturerId = $sellerDetails[0]->manufacturers_id;
            

        $pincodesVal = DB::table('manufacturers_pincodes')
        ->join('pincodes', 'manufacturers_pincodes.pincodes_id', '=', 'pincodes.pincodes_id')
        ->where('manufacturers_pincodes.manufacturers_id',$manufacturerId)
        ->select('pincodes.*')
        ->get();

    // select `pincodes`.`pincodes_val` from `manufacturers_pincodes` inner join `pincodes` on `manufacturers_pincodes`.`manufacturers_pincodes_id` = `pincodes`.`pincodes_id` where `manufacturers_pincodes`.`manufacturers_id` = ?



// Now $pincodesVal contains the value you're looking for




        return view("web.detail")->with(['result' => $result,'city'=>$city,'pincodesVal'=>$pincodesVal]);
     }

    // //filters
    public function filters($data)
    {
        $response = $this->products->filters($data);
        return ($response);
    }

    // //getquantity
    public function getquantity(Request $request)
    {
       
        $data = array();
        $data['products_id'] = $request->products_id;
        $data['attributes'] = $request->attributeid;

        $result = $this->products->productQuantity($data);
        print_r(json_encode($result));
    }

}
