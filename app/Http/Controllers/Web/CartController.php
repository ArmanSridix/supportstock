<?php
namespace App\Http\Controllers\Web;

//use Mail;
//validator is builtin class in laravel
use App\Models\Web\Cart;
use App\Models\Web\Index;
//for password encryption or hash protected
use App\Models\Web\Products;
use App\Models\Web\ShippingRate;

//for authenitcate login data
use Carbon;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Lang;
use Session;
use DB;

class CartController extends Controller
{

    public function __construct(
        Index $index,
        Products $products,
        Cart $cart,
        ShippingRate $ShippingRate
    ) {
        $this->index = $index;
        $this->products = $products;
        $this->cart = $cart;
        $this->ShippingRate = $ShippingRate;
        
        $this->theme = new ThemeController();

    }

    //myCart
    public function viewcart(Request $request)
    {

        if(Session::has('supportUserDetails')){
            $result = array();
            $data = array();
            $result['commonContent'] = $this->index->commonContent();
            // echo "<pre>";
            // print_r($result['commonContent']);exit;

            $result['cart'] = $this->cart->myCart($data);
            ///************ added by barun ************///
            $totalCartAmount=0;
            if(!empty($result['cart'])){
                foreach($result['cart'] as $cartAmount){
                    if ($cartAmount->prodDiscount!='') {
                        $totalCartAmount = $totalCartAmount+(($cartAmount->final_price-($cartAmount->final_price*$cartAmount->prodDiscount/100))*$cartAmount->customers_basket_quantity);
                    }else{
                        $totalCartAmount = $totalCartAmount+($cartAmount->final_price*$cartAmount->customers_basket_quantity);
                    }
                }
            }
            //echo $totalCartAmount;exit;
            ///************ added by barun ************///

            // $shipping_methods = DB::table('shipping_methods')
            //     ->leftJoin('shipping_description','shipping_description.table_name','=','shipping_methods.table_name')
            //     ->where('shipping_description.language_id','1')
            //     ->where('shipping_methods.isDefault','1')
            //     ->whereIn('shipping_methods_id',array(2,4))
            //     ->first();

            $flate_rate = 0;
            $shipping_rates =   $this->ShippingRate->getShippingRate(); //added by barun
            if(!empty($shipping_rates)){
                foreach($shipping_rates as $rates){
                    if($rates->amount_to==0){
                        if($totalCartAmount >= $rates->amount_from){
                            $flate_rate = $rates->shipping_rate;
                        }
                    }else{
                        if($totalCartAmount >= $rates->amount_from && $totalCartAmount <= $rates->amount_to ){
                            $flate_rate = $rates->shipping_rate;
                        }
                    }
                }
            }
              $shipping_detail = array('name' => "", 'rate' => $flate_rate, 'currencyCode' => 'INR', 'shipping_method' => 'flateRate');
              // echo "<pre>";
              // print_r($shipping_detail);exit;
            
            // $shipping_detail = array();
            // if ($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1') {
            //     $flateDetails = DB::table('flate_rate')->where('id', '=', '1')->get();
            //     $shipping_detail = array('name' => $shipping_methods->name, 'rate' => $flateDetails[0]->flate_rate, 'currencyCode' => $flateDetails[0]->currency, 'shipping_method' => 'flateRate');
            // }else if ($shipping_methods->methods_type_link == 'freeShipping' and $shipping_methods->status == '1') {
            //     $shipping_detail = array('name' => $shipping_methods->name, 'rate' => '0', 'currencyCode' => 'INR', 'shipping_method' => 'freeShipping');
            // }
            
            if (!empty($shipping_detail)) {
                session(['shipping_detail' => (object) $shipping_detail]);
            }

            //apply coupon
            if (session('coupon')) {
                $session_coupon_data = session('coupon');
                session(['coupon' => array()]);
                $response = array();
                if (!empty($session_coupon_data)) {
                    foreach ($session_coupon_data as $key => $session_coupon) {
                        $response = $this->cart->common_apply_coupon($session_coupon->code);
                    }
                }
            }
            
            return view("web.viewcart")->with(['result' => $result])->with('flate_rate', $flate_rate);
        }else{
            return redirect()->back()->with('middleWareloginError', "Not login");
        }

    }

    /**************** update quantity ****************/
    public function updateCartQuantity(Request $request)
    {

        $input = $request->all();
        $customers_basket_id = $input['customers_basket_id'];
        $products_id = $input['products_id'];
        $totalQty = $input['cart_quantity'];

        $data = array('page_number' => '0', 'type' => '', 'products_id' => $products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
        $detail = $this->products->products($data);

        /******* bulk price list *******/
        $BulkPrice = DB::table('product_bulk_price')
            ->orderBy('product_bulk_price_id', 'ASC')
            ->where('products_id','=',$products_id);

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
                    if (in_array($products_id, $userProductArray)) {
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

        // echo "<pre>";
        // print_r($BulkPriceList);exit;
        /******* bulk price list *******/


        $prDiscount = '';
        if (!empty($BulkPriceList)) {
            foreach ($BulkPriceList as $key => $value) {
                $minQnty = $value->minimum_quantity;
                $maxQnty = $value->maximum_quantity;

                if ($minQnty!='' && $maxQnty!='') {
                    if($totalQty>=$minQnty && $totalQty<=$maxQnty){
                        $prDiscount = $value->discount_rate;
                    }
                }else if ($minQnty=='' && $maxQnty!='') {
                    if($totalQty==$maxQnty){
                      $prDiscount = $value->discount_rate;
                    }
                }else if ($minQnty!='' && $maxQnty=='') {
                    if($totalQty>=$minQnty){
                      $prDiscount = $value->discount_rate;
                    }
                }else{
                    $prDiscount = $value->discount_rate;
                }
            }
        }else{
            $prDiscount = '';
        }

        DB::table('customers_basket')->where('customers_basket_id', '=', $customers_basket_id)->update(
            [
                'customers_basket_quantity' => $totalQty,
                'prodDiscount' => $prDiscount
            ]);

        return 1;
    }
    /**************** update quantity ****************/

    //eidtCart
    // public function editcart(Request $request, $id, $slug)
    // {

    //     $title = array('pageTitle' => Lang::get('website.Product Detail'));
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

    //     $products = $this->products->getProductsBySlug($slug);

    //     //category
    //     $category = $this->products->getCategoryByParent($products[0]->products_id);

    //     if (!empty($category)) {
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

    //     $i = 0;
    //     foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
    //         if ($i == 0) {
    //             $postCategoryId = $postCategory->categories_id;
    //             $i++;
    //         }
    //     }

    //     $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    //     $simliar_products = $this->products->products($data);
    //     $result['simliar_products'] = $simliar_products;

    //     $cart = '';
    //     $result['cartArray'] = $this->products->cartIdArray($cart);

    //     //liked products
    //     $result['liked_products'] = $this->products->likedProducts();

    //     $data = array('page_number' => '0', 'type' => 'topseller', 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);
    //     $top_seller = $this->products->products($data);
    //     $result['top_seller'] = $top_seller;

    //     $result['cart'] = $this->cart->myCart($id);

    //     return view("web.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

    // }

    //deleteCart
    public function deleteCart(Request $request)
    {
        //Session::forget('coupon_discount');

        $check = $this->cart->deleteCart($request);
        //apply coupon
        if (!empty(session('coupon')) and count(session('coupon')) > 0) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            if (count($session_coupon_data) == '2') {
                $response = array();
                if (!empty($session_coupon_data)) {
                    foreach ($session_coupon_data as $key => $session_coupon) {
                        $response = $this->cart->common_apply_coupon($session_coupon->code);
                    }
                }
            }
        }

        $message = Lang::get("website.Cart item has been deleted successfully");
        return redirect()->back()->with('message', $message);

        // if (!empty($request->type) and $request->type == 'header cart') {
        //     $result['commonContent'] = $this->index->commonContent();
        //     if (empty($check)) {
        //         $message = Lang::get("website.Cart item has been deleted successfully");
        //         return redirect('/')->with('message', $message);

        //     } else {
        //         $message = Lang::get("website.Cart item has been deleted successfully");
        //         $final_theme = $this->index->finalTheme();
        //         return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
        //     }
        // } else {
        //     if (empty($check)) {
        //         $message = Lang::get("website.Cart item has been deleted successfully");
        //         return redirect('/')->with('message', $message);

        //     } else {
        //         $message = Lang::get("website.Cart item has been deleted successfully");
        //         return redirect()->back()->with('message', $message);
        //     }
        // }
    }

    // //getCart
    // public function cartIdArray($request)
    // {
    //     $this->cart->cartIdArray($request);
    // }

    // //updatesinglecart
    // public function updatesinglecart(Request $request)
    // {
    //     $this->cart->updatesinglecart($request);
    //     $final_theme = $this->index->finalTheme();
    //     return view("web.headers.cartButtons.cartButton".$final_theme->header)->with('result', $result);
    // }

    //addToCart
    public function addToCart(Request $request)
    {   
        $productPincodeArray = array();
        $proPincode = DB::table('products')
            ->leftJoin('manufacturers_pincodes', 'manufacturers_pincodes.manufacturers_id', '=', 'products.manufacturers_id')
            ->select('manufacturers_pincodes.manufacturers_pincodes_id','manufacturers_pincodes.pincodes_id')
            ->groupBy('manufacturers_pincodes.manufacturers_pincodes_id')
            ->get();
        if (!empty($proPincode)) {
            foreach ($proPincode as $key => $value) {
                array_push($productPincodeArray, $value->pincodes_id);
            }
        }

        $user_pincode_id = '';
        if(Session::has('user_pincode_id')){
            $user_pincode_id = Session::get('user_pincode_id');
        }

        if(!Session::has('user_pincode_id')){
            return redirect()->back()->with('middleWarePincodeError', "No pincode");
        }else if(!in_array($user_pincode_id, $productPincodeArray)){            
            return redirect()->back()->with('ProductPincodeError', "Product not deliverable");
        }else{
             if(Session::has('supportUserDetails')){
                $result = $this->cart->addToCart($request);
                if (!empty($result['status']) && $result['status'] == 'exceed') {
                    //return $result;
                    return redirect()->back()->with('stockOut','Out Of Stock!');
                }
                
                return redirect('/viewcart');
            }else{
                return redirect()->back()->with('middleWareloginError', "Not login");
            }
        }
        
    }

    // //addToCartFixed
    // public function addToCartFixed(Request $request)
    // {
    //     $result['commonContent'] = $this->index->commonContent();        
    //     return view("web.headers.cartButtons.cartButtonFixed")->with('result', $result);
    // }

    // public function addToCartResponsive(Request $request)
    // {
    //     $result['commonContent'] = $this->index->commonContent();        
    //     return view("web.headers.cartButtons.cartButton")->with('result', $result);
    // }   

    // //updateCart
    // public function updateCart(Request $request)
    // {

    //     if (empty(session('customers_id'))) {
    //         $customers_id = '';
    //     } else {
    //         $customers_id = session('customers_id');
    //     }
    //     $session_id = Session::getId();
    //     foreach ($request->cart as $key => $customers_basket_id) {
    //         $this->cart->updateRecord($customers_basket_id, $customers_id, $session_id, $request->quantity[$key]);
    //     }

    //     $message = Lang::get("website.Cart has been updated successfully");
    //     return redirect()->back()->with('message', $message);

    // }

    // //apply_coupon
    public function apply_coupon(Request $request)
    {

        $result = array();
        $coupon_code = $request->coupon_code;
        $carts = $this->cart->myCart(array());
        if (count($carts) > 0) {
            $response = $this->cart->common_apply_coupon($coupon_code);
        // dd($response);
        } else {
            $response = array('success' => '0', 'message' => Lang::get("website.Coupon can not be apllied to empty cart"));
        }
        print_r(json_encode($response));
    }

    // //removeCoupon
    public function removeCoupon(Request $request)
    {
        $coupons_id = $request->id;

        $session_coupon_data = session('coupon');
        session(['coupon' => array()]);
        session(['coupon_discount' => 0]);
        $response = array();
        if (!empty($session_coupon_data)) {
            foreach ($session_coupon_data as $key => $session_coupon) {
                if ($session_coupon->coupans_id != $coupons_id) {
                    $response = $this->cart->common_apply_coupon($session_coupon->code);
                }
            }
        }

        $message = Lang::get("website.Coupon has been removed successfully");
        return redirect()->back()->with('message', $message);

    }

}
