<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\SmsController;
use App\Http\Controllers\Web\AlertController;
use App\Models\Web\Cart;
use App\Models\Web\Currency;
use App\Models\Web\Customer;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Lang;
use Session;
use Socialite;
use Validator;
use Hash;

class CustomersController extends Controller
{

    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Customer $customer,
        Cart $cart
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->customer = $customer;
        $this->cart = $cart;
        $this->theme = new ThemeController();
    }

    // public function signup(Request $request)
    // {
    //     $final_theme = $this->theme->theme();
    //     if (auth()->guard('customer')->check()) {
    //         return redirect('/');
    //     } else {
    //         $title = array('pageTitle' => Lang::get("website.Sign Up"));
    //         $result = array();
    //         $result['commonContent'] = $this->index->commonContent();
    //         return view("login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    //     }
    // }

    // public function login(Request $request)
    // {
    //     $result = array();
    //     if (auth()->guard('customer')->check()) {
    //         return redirect('/');
    //     } else {
    //         $result['cart'] = $this->cart->myCart($result);

    //         if (count($result['cart']) != 0) {
    //             $result['checkout_button'] = 1;
    //         } else {
    //             $result['checkout_button'] = 0;

    //         }
    //         $previous_url = Session::get('_previous.url');

    //         $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    //         $ref = rtrim($ref, '/');

    //         session(['previous' => $previous_url]);

    //         $title = array('pageTitle' => Lang::get("website.Login"));
    //         $final_theme = $this->theme->theme();

    //         $result['commonContent'] = $this->index->commonContent();
    //         return view("auth.login", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    //     }

    // }

    public function signupBefore(Request $request)
    {
        if($request->password != $request->confirm_password){
            return redirect()->back()->with('SignupError', "confirm password not match.");
        }
        //        //validation start
        $validator = Validator::make(
            array(
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'password'      => $request->password,
            ), array(
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required | email',
                'phone'         => 'required',
                'password'      => 'required',
            )
        );
        if ($validator->fails()) {
            return redirect()->back()->with('SignupError', $validator);
        } else {
            $existUser = DB::table('users')->where('users.email', $request->email)->orWhere('users.phone', $request->phone)->get();
            
            if (count($existUser) > 0) {
                return redirect()->back()->with('SignupError', "User already exist.");
            } else {
                $rand_otp = mt_rand(100000,999999);

                $signUpData = array(
                    'first_name'    => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->email,
                    'phone'         => $request->phone,
                    'password'      => $request->password,
                    'otp'           => $rand_otp
                );

                /************/
                $myVar = new AlertController();
                $alertSetting = $myVar->createOtpAlert($signUpData);

                $msg = "Your New OTP ".$rand_otp." by Supportstock.";
                $template_id = '1707162071908056513';
                $mySms = new SmsController();
                $mySms->sendSms($request->phone,$msg,$template_id);
                /************/ 

                DB::table('otp')->insertGetId([
                    'otp'=>	$rand_otp
                  ]);
                Session::put('signUpData', $signUpData);
                return redirect()->back();
            }          

        }

    }
    public function processSignup(Request $request)
    {
        $signUpData = Session::get('signUpData');
        // echo "<pre>";
        // print_r($signUpData);exit;
        
        if ($request->signup_otp!=$signUpData['otp']) {
            return redirect()->back()->with('OtpError',"OTP not match.");
        }else{
            $date   = date('y-m-d h:i:s');
            $newUser_id = DB::table('users')->insertGetId([
                'first_name'=>	$signUpData['first_name'],
                'last_name'	=>	$signUpData['last_name'],
                'phone'		=>	$signUpData['phone'],
                'email'	    =>	$signUpData['email'],
                'role_id'   =>  2,
                'user_type' =>  'Normal',
                'password'  =>	Hash::make($signUpData['password']),
                'created_at'=>  $date
              ]);
            if ($newUser_id) {
                $request->session()->forget('signUpData');
                $customerInfo = array("email" => $signUpData['email'], "password" => $signUpData['password']);
                if (auth()->guard('customer')->attempt($customerInfo)) {
                    $customer = auth()->guard('customer')->user();
                    Session::put('supportUserDetails', $customer);
                    return redirect()->back();
                }else {
                    return redirect()->back()->with('loginError', "Login not completed");
                }
            }else{
                $request->session()->forget('signUpData');
                return redirect()->back()->with('SignupError', "Please try again!");
          }

        }
    }
    
    public function processLogin(Request $request)
    {
        $old_session = Session::getId();

        $result = array();
        $input = $request->all();
        
        //check authentication of email and password
        if(filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
            $customerInfo = array("email" => $input['email'], "password" => $input['password']);
          }
          else {
            $customerInfo = array("phone" => $input['email'], "password" => $input['password']);
          }
        // $customerInfo = array("email" => $request->email, "password" => $request->password);

        if (auth()->guard('customer')->attempt($customerInfo)) {
            $customer = auth()->guard('customer')->user();
            // echo $customer->status;exit;
            if ($customer->status == 0) {
                return redirect()->back()->with('loginError', "You are not allowed to log in");
            }elseif ($customer->role_id == 2) {
                // echo "<pre>";print_r($customer);exit;

                $toDay = date('Y-m-d 00:00:00');
                if ($customer->subscription_start != '' && $customer->subscription_end != '') {
                	if ($toDay>=$customer->subscription_start && $toDay<=$customer->subscription_end) {
                		DB::table('users')->where('id', $customer->id)
                			->update(['user_type' => 'Corporate']);
                		$customer->user_type = 'Corporate';
                	}else{
                		DB::table('users')->where('id', $customer->id)
                			->update([
                				'user_type' => 'Normal',
                				'assign_type' => NULL,
                				'subscription_start' => NULL,
                				'subscription_end' => NULL
                			]);
                		$customer->user_type = 'Normal';

                		DB::table('user_to_category')->where([
			              'user_id' => $customer->id,
			            ])->delete();

			            DB::table('user_to_product')->where([
			              'user_id' => $customer->id,
			            ])->delete();
                	}
                }else{
            		DB::table('users')->where('id', $customer->id)
            			->update([
            				'user_type' => 'Normal',
            				'assign_type' => NULL,
            				'subscription_start' => NULL,
            				'subscription_end' => NULL
            			]);
            		$customer->user_type = 'Normal';

            		DB::table('user_to_category')->where([
		              'user_id' => $customer->id,
		            ])->delete();

		            DB::table('user_to_product')->where([
		              'user_id' => $customer->id,
		            ])->delete();
            	}

                $userCategory = DB::table('user_to_category')
                    ->where('user_id','=', $customer->id)
                    ->get();
                $userCategoryArray = array();
                if (!empty($userCategory)) {
                    foreach ($userCategory as $key => $value) {
                        array_push($userCategoryArray, $value->categories_id);
                    }
                }
                $customer->userCategoryArray = $userCategoryArray;

                $userProduct = DB::table('user_to_product')
                    ->where('user_id','=', $customer->id)
                    ->get();
                $userProductArray = array();
                if (!empty($userProduct)) {
                    foreach ($userProduct as $key1 => $value1) {
                        array_push($userProductArray, $value1->products_id);
                    }
                }
                $customer->userProductArray = $userProductArray;
                //echo "<pre>";print_r($customer);exit;

                /********/
                if(Session::has('user_pincode_id')){
                    $user_pincode_id = Session::get('user_pincode_id');

                    if ($customer->web_pincod_id !=0 || $customer->web_pincod_id !='') {
                        if ($customer->web_pincod_id != $user_pincode_id) {
                            DB::table('customers_basket')->where('customers_id', '=', $customer->id)->where('is_order', '=', 0)->delete();
                        }
                    }

                    DB::table('users')
                        ->where('id', $customer->id)
                        ->update(array(
                            'web_pincod_id' => $user_pincode_id,
                        ));
                    $customer->web_pincod_id = $user_pincode_id;
                }
                /********/

                Session::put('supportUserDetails', $customer);
                return redirect()->back();
            }else{
                // echo "error1";exit;
                return redirect()->back()->with('loginError', "auth error");
            }
            // echo "<pre>";print_r($customer);exit;
            // if ($customer->role_id != 2) {
            //     $record = DB::table('settings')->where('id', 94)->first();
            //     if ($record->value == 'Maintenance' && $customer->role_id == 1) {
            //         auth()->attempt($customerInfo);
            //     } else {
            //         Auth::guard('customer')->logout();
            //         return redirect('/')->with('loginError', Lang::get("website.You Are Not Allowed With These Credentials!"));
            //     }
            // }
            // $result = $this->customer->processLogin($request, $old_session);
            // if (!empty(session('previous'))) {
            //     return Redirect::to(session('previous'));
            // } else {
                
            //     Session::forget('guest_checkout');
            //     return redirect('/')->with('result', $result);
            // }
        } else {
            // echo "error2";exit;
            return redirect()->back()->with('loginError', "Email or password is incorrect");
        }
        // }
    }


    /************** social login *******************/
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleSocialLoginCallback($social)
    {
        $result = $this->customer->handleSocialLoginCallback($social);
        if (!empty($result)) {
            return redirect('/')->with('result', $result);
        }
    }
    /************** social login *******************/


    public function forgetPasswordOtp(Request $request)
    {
        $validator = Validator::make(
            array(
                'email_phone' => $request->email_phone
            ), array(
                'email_phone' => 'required'
            )
        );
        if ($validator->fails()) {
            return redirect()->back()->with('fp_error', $validator);
        } else {
            $email_phone = $request->email_phone;
            $userExist = DB::table('users')
                ->where('email','=', $email_phone)
                ->orWhere('phone','=', $email_phone)
                ->get();
            // echo "<pre>";
            // print_r($userExist);exit;

            if ($userExist->isEmpty()) {
                return redirect()->back()->with('fp_error', "Email address or phone no does not exist.");
            } else {
                $rand_otp = mt_rand(100000,999999);
                $userExist[0]->rand_otp = $rand_otp;
                
                DB::table('users')->where('id', $userExist[0]->id)->update(['f_pass_otp' => $rand_otp]);
                
                /************/
                $myVar = new AlertController();
                $alertSetting = $myVar->fPasswordOtpAlert($userExist);

                $phone = $userExist[0]->phone;
                $msg = "Your New OTP ".$rand_otp." by Supportstock.";
                $template_id = '1707162071908056513';
                $mySms = new SmsController();
                $mySms->sendSms($phone,$msg,$template_id);
                /************/

                return redirect()->back()->with('otp_success', "An otp has been sent to your email address and phone no.")->with('user_id', $userExist[0]->id );
            }
        }
    }
    public function forgetPasswordOtpVerify(Request $request)
    {
        

        $validator = Validator::make(
            array(
                'f_pass_otp' => $request->f_pass_otp
            ), array(
                'f_pass_otp' => 'required'
            )
        );
        if ($validator->fails()) {
            return redirect()->back()->with('otp_error', $validator);
        } else {
            $f_pass_otp = $request->f_pass_otp;
            $user_id = $request->user_id;

            $userExist = DB::table('users')
                ->where('f_pass_otp','=', $f_pass_otp)
                ->where('id','=', $user_id)
                ->get();
                print_r($userExist);
                

            if (count($userExist) > 0) {
                return redirect()->back()->with('up_password_success', "otp matched. Please generate new password.")->with('user_id', $userExist[0]->id );
            } else {
                return redirect()->back()->with('otp_error', "OTP not match. Please try again.")->with('user_id', $user_id );
            }
        }
    }
    public function processPassword(Request $request)
    {
        $password = $request->password;
        $confirm_password = $request->confirm_password;
        $user_id = $request->user_id;

        if ($password!=$confirm_password) {
            return redirect()->back()->with('up_password_error', "Confirm password not match. Please try again.")->with('user_id', $user_id );
            
        } else {
            $hash_pass = Hash::make($password);
            DB::table('users')->where('id', $user_id)->update(['password' => $hash_pass]);
            return redirect()->back()->with('loginError', "Password has been updated.");
        }
    }
    // public function addToCompare(Request $request)
    // {
    //     $cartResponse = $this->customer->addToCompare($request);
    //     return $cartResponse;
    // }

    // public function DeleteCompare($id)
    // {
    //     $Response = $this->customer->DeleteCompare($id);
    //     return redirect()->back()->with($Response);
    // }

    // public function Compare()
    // {
    //     $result = array();
    //     $final_theme = $this->theme->theme();
    //     $result['commonContent'] = $this->index->commonContent();
    //     $compare = $this->customer->Compare();
    //     $results = array();
    //     foreach ($compare as $com) {
    //         $data = array('products_id' => $com->product_ids, 'page_number' => '0', 'type' => 'compare', 'limit' => '15', 'min_price' => '', 'max_price' => '');
    //         $newest_products = $this->products->products($data);
    //         array_push($results, $newest_products);
    //     }
    //     $result['products'] = $results;
    //     return view('web.compare', ['result' => $result, 'final_theme' => $final_theme]);
    // }
    public function corporateRequest()
    {
        if(Session::has('supportUserDetails')){
            $title = array('pageTitle' => Lang::get("website.corporateRequest"));
            $result['commonContent'] = $this->index->commonContent();
            return view('web.corporate_request', ['result' => $result, 'title' => $title ]);
        }
        return redirect()->back();
       
    }
    public function updateCorporateRequest()
    {
        if(Session::has('supportUserDetails')){
            $current_user_details = Session::get('supportUserDetails');
            $customers_id = $current_user_details->id;
            if($current_user_details->user_type != 'Corporate'){
                $user = DB::table('users')->where('id', $customers_id)->update(array(
                    'corporate_request' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ));
                $userData = auth()->guard('customer')->user();
                Session::put('supportUserDetails', $userData);
                $message    = "Corporate Request has been sent successfully.";
                return redirect()->back()->with('message', $message);
            }else{
                $message    = "You are a Corporate user.";
                return redirect()->back()->with('message', $message);
            }
            
        }else{
            return redirect()->back();
        }

    }
    public function profile()
    {
        if(Session::has('supportUserDetails')){
            $title = array('pageTitle' => Lang::get("website.Profile"));
            $result['commonContent'] = $this->index->commonContent();
            // $final_theme = $this->theme->theme();
            // return view('web.profile', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme]);
            return view('web.profile', ['result' => $result, 'title' => $title ]);
        }
        return redirect()->back();
       
    }

    public function updateMyProfile(Request $request)
    {
        if(Session::has('supportUserDetails')){
            $current_user_details = Session::get('supportUserDetails');
            // echo "<pre>"; print_r($current_user_details);exit;
            $input = $request->all();
            $customers_id = $current_user_details->id;
            $customer_data = array();
            if(!empty($input['first_name'])){
                $customer_data['first_name'] = $input['first_name'];
            }
            if(!empty($input['last_name'])){
                $customer_data['last_name'] = $input['last_name'];
            }
            if(!empty($input['email'])){
                $customer_data['email'] = $input['email'];
            }
            if(!empty($input['phone'])){
                $customer_data['phone'] = $input['phone'];
            }
            if(!empty($input['current_password']) && !empty($input['new_password'])){
                if (!Hash::check($input['current_password'],$current_user_details->password )){
                    $message    = "current password dose not match.";
                    return redirect()->back()->with('message', $message);
                }else{
                    $customer_data['password'] =  bcrypt($input['new_password']);
                }
            }
            if(!empty($customer_data)){
                $customer_data['updated_at'] = date('Y-m-d H:i:s');
                $user = DB::table('users')->where('id', $customers_id)->update($customer_data);
                $userData = auth()->guard('customer')->user();
                Session::put('supportUserDetails', $userData);
                $message    = "Profile has been updated successfully.";
                return redirect()->back()->with('message', $message);
            }
        }else{
            return redirect()->back();
        }

    }

    // public function changePassword()
    // {
    //     $title = array('pageTitle' => Lang::get("website.Change Password"));
    //     $result['commonContent'] = $this->index->commonContent();
    //     $final_theme = $this->theme->theme();
    //     return view('web.changepassword', ['result' => $result, 'title' => $title, 'final_theme' => $final_theme]);
    // }

    // public function updateMyPassword(Request $request)
    // {
    //     $password = Auth::guard('customer')->user()->password;
    //     if (Hash::check($request->current_password, $password)) {
    //         $message = $this->customer->updateMyPassword($request);
    //         return redirect()->back()->with('success', $message);
    //     }else{
    //         return redirect()->back()->with('error', lang::get("website.Current password is invalid"));
    //     }
    // }

    public function logout(REQUEST $request)
    {
        Auth::guard('customer')->logout();
        session()->flush();
        $request->session()->forget('customers_id');
        $request->session()->forget('supportUserDetails');
        $request->session()->regenerate();
        return redirect('/');
    }


    /**************** add web wishlist ****************/
    public function addWishlistWeb(Request $request)
    {

        $input = $request->all();
        $products_id = $input['products_id'];

        if(Session::has('supportUserDetails')){
            $returnData['isLogin'] = 'yes';

            $current_user_details = Session::get('supportUserDetails');
            $customers_id = $current_user_details['id'];
            $input['customers_id'] = $customers_id;
            $input['products_id'] = $products_id;

            $cartResponse = $this->customer->likeMyProduct($input);
            $returnData['cartResponse'] = $cartResponse;
        }else{
            $returnData['isLogin'] = 'no';
        }

        return response()->json(['returnData'=>$returnData]);
    }
    /**************** add web wishlist ****************/

    

    // public function createRandomPassword()
    // {
    //     $pass = substr(md5(uniqid(mt_rand(), true)), 0, 8);
    //     return $pass;
    // }

    // public function likeMyProduct(Request $request)
    // {
    //     $cartResponse = $this->customer->likeMyProduct($request);
    //     return $cartResponse;
    // }

    // public function unlikeMyProduct(Request $request, $id)
    // {

    //     if (!empty(auth()->guard('customer')->user()->id)) {
    //         $this->customer->unlikeMyProduct($id);
    //         $message = Lang::get("website.Product is unliked");
    //         return redirect()->back()->with('success', $message);
    //     } else {
    //         return redirect('login')->with('loginError', 'Please login to like product!');
    //     }

    // }

    public function wishlist(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();

        if(Session::has('supportUserDetails')){
            
            if (!empty($request->limit)) {
                $limit = $request->limit;
            } else {
                $limit = 20;
            }

            $data = array('page_number' => 0, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
            $products = $this->products->products($data);
            $result['products'] = $products;
            $cart = '';
            $result['cartArray'] = $this->products->cartIdArray($cart);

            //liked products
            $result['liked_products'] = $this->products->likedProducts();
            if ($limit > $result['products']['total_record']) {
                $result['limit'] = $result['products']['total_record'];
            } else {
                $result['limit'] = $limit;
            }

            // echo "<pre>";
            // print_r($result);exit;

            return view("web.wishlist")->with(['result' => $result]);
            
        }else{
            return redirect('/');
        }

    }

    public function myAddress(Request $request)
    {
        
        if(Session::has('supportUserDetails')){
            $result['commonContent'] = $this->index->commonContent();
            $user_details = Session::get('supportUserDetails');
            
            $result['userAddressList'] = DB::table('address_book')
            ->where('customers_id', $user_details->id)
            ->join('pincodes', 'pincodes.pincodes_id', '=', 'address_book.entry_postcode')
            ->join('cities', 'cities.cities_id', '=', 'address_book.entry_city')
            ->get();
            $result['default_address_id'] = $user_details->default_address_id;
            // echo "<pre>";
            // print_r($user_details);exit;
            $result['cityList'] = DB::table('cities')->get();
            return view("web.my_address")->with(['result' => $result]);
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
        
    }
    public function pincodeList(Request $request)
    {
        $input = $request->all();
        $cities_id = $input['cities_id'];

        $returnData['pincodeList'] = DB::table('pincodes')->select('pincodes_id','pincodes_val')
        ->where('pincodes_city_id','=', $cities_id)->get();
        return response()->json(['returnData'=>$returnData]);
    }
    public function addAddress(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        if(Session::has('supportUserDetails')){
            $input = $request->all();
            $default_address = 0;
            $user_details = Session::get('supportUserDetails');
            if($user_details->default_address_id == 0){
                $default_address = 1;
            }
            if(empty($input['flat'])){
                $message    = "Please enter flat no.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['street'])){
                $message    = "Please enter street.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['Locality'])){
                $message    = "Please enter Locality.";
                return redirect()->back()->with('message', $message);
            }else if(empty($input['pincode'])){
                $message    = "Please enter pincode.";
                return redirect()->back()->with('message', $message);
            }else{
                if(isset($input['default_address'])){
                    $default_address = $input['default_address'];
                }
                $address_data = array(
                'customers_id'         => $user_details->id,
                'flat_no'              => $input['flat'],
                'entry_street_address' => $input['street'],
                'entry_city'           => $input['Locality'],
                'entry_postcode'       => $input['pincode'],
                'entry_country_id'       => 99,
              );
              
                $id = DB::table('address_book')->insertGetId($address_data);

                if($default_address == 1){
                    $result = DB::table('users')
                        ->where('id', $user_details->id)
                        ->update(array(
                            'default_address_id' => $id,
                        ));
                    $userData = auth()->guard('customer')->user();
                    Session::put('supportUserDetails', $userData);
                }
                $message    = "Address successfully added.";
                return redirect()->back()->with('message', $message);
            }
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
    }
    public function updateaddress(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        if(Session::has('supportUserDetails')){
            $user_details = Session::get('supportUserDetails');
            $input = $request->all();
            $default_address = 0;
            $customer_data = array();
            if(!empty($input['flat'])){
                $customer_data['flat_no'] = $input['flat'];
            }
            if(!empty($input['street'])){
                $customer_data['entry_street_address'] = $input['street'];
            }
            if(!empty($input['Locality'])){
                $customer_data['entry_city'] = $input['Locality'];
            }
            if(!empty($input['pincode'])){
                $customer_data['entry_postcode'] = $input['pincode'];
            }
            if(!empty($customer_data)){
                DB::table('address_book')
                    ->where('address_book_id', $input['address_book_id'])
                    ->update($customer_data);
            }
            if(isset($input['default_address'])){
                $default_address = $input['default_address'];
            }
            if($default_address == 1){
                DB::table('users')
                    ->where('id', $user_details->id)
                    ->update(array(
                        'default_address_id' => $input['address_book_id'],
                    ));
                $userData = auth()->guard('customer')->user();
                Session::put('supportUserDetails', $userData);
            }
            
            $message    = "Address successfully updated.";
            return redirect()->back()->with('message', $message);
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
    }
    public function deleteaddress(Request $request)
    {

        if(Session::has('supportUserDetails')){
            $user_data = Session::get('supportUserDetails');
            if($user_data->default_address_id == $request->address_book_id){
                $message    = "You can not delete a default address.";
                return redirect()->back()->with('message', $message);
            }
            DB::table('address_book')
                ->where('address_book_id', '=', $request->address_book_id)
                ->delete();
            $message    = "Address successfully deleted.";
            return redirect()->back()->with('message', $message);
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
    }

    public function loadMoreWishlist(Request $request)
    {

        $limit = $request->limit;

        $data = array('page_number' => $request->page_number, 'type' => 'wishlist', 'limit' => $limit, 'categories_id' => '', 'search' => '', 'min_price' => '', 'max_price' => '');
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $myVar = new CartController();
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;

        $result['commonContent'] = $this->index->commonContent();

        return view("web.wishlistproducts")->with('result', $result);

    }

    // public function forgotPassword()
    // {
    //     if (auth()->guard('customer')->check()) {
    //         return redirect('/');
    //     } else {

    //         $title = array('pageTitle' => Lang::get("website.Forgot Password"));
    //         $final_theme = $this->theme->theme();
    //         $result = array();
    //         $result['commonContent'] = $this->index->commonContent();
    //         return view("web.forgotpassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    //     }
    // }

    // public function processPassword(Request $request)
    // {
    //     $title = array('pageTitle' => Lang::get("website.Forgot Password"));

    //     $password = $this->createRandomPassword();

    //     $email = $request->email;
    //     $postData = array();

    //     //check email exist
    //     $existUser = $this->customer->ExistUser($email);
    //     if (count($existUser) > 0) {
    //         $this->customer->UpdateExistUser($email, $password);
    //         $existUser[0]->password = $password;

    //         $myVar = new AlertController();
    //         $alertSetting = $myVar->forgotPasswordAlert($existUser);

    //         return redirect('login')->with('success', Lang::get("website.Password has been sent to your email address"));
    //     } else {
    //         return redirect('forgotPassword')->with('error', Lang::get("website.Email address does not exist"));
    //     }

    // }

    // public function recoverPassword()
    // {
    //     $title = array('pageTitle' => Lang::get("website.Forgot Password"));
    //     $final_theme = $this->theme->theme();
    //     return view("web.recoverPassword", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    // }

    // public function subscribeNotification(Request $request)
    // {

    //     $setting = $this->index->commonContent();

    //     /* Desktop */
    //     $type = 3;

    //     session(['device_id' => $request->device_id]);

    //     if (auth()->guard('customer')->check()) {

    //         $device_data = array(
    //             'device_id' => $request->device_id,
    //             'device_type' => $type,
    //             'created_at' => time(),
    //             'updated_at' => time(),
    //             'ram' => '',
    //             'status' => '1',
    //             'processor' => '',
    //             'device_os' => '',
    //             'location' => '',
    //             'device_model' => '',
    //             'user_id' => auth()->guard('customers')->user()->id,
    //             'manufacturer' => '',
    //         );

    //     } else {

    //         $device_data = array(
    //             'device_id' => $request->device_id,
    //             'device_type' => $type,
    //             'created_at' => time(),
    //             'updated_at' => time(),
    //             'ram' => '',
    //             'status' => '1',
    //             'processor' => '',
    //             'device_os' => '',
    //             'location' => '',
    //             'device_model' => '',
    //             'manufacturer' => '',
    //         );

    //     }
    //     $this->customer->updateDevice($request, $device_data);
    //     print 'success';
    // }

    // public function signupProcess(Request $request)
    // {
    //     $old_session = Session::getId();

    //     $firstName = $request->firstName;
    //     $lastName = $request->lastName;
    //     $gender = $request->gender;
    //     $email = $request->email;
    //     $password = $request->password;
    //     $date = date('y-md h:i:s');
    //     //        //validation start
    //     $validator = Validator::make(
    //         array(
    //             'firstName' => $request->firstName,
    //             'lastName' => $request->lastName,
    //             'customers_gender' => $request->gender,
    //             'email' => $request->email,
    //             'password' => $request->password,
    //             're_password' => $request->re_password,

    //         ), array(
    //             'firstName' => 'required ',
    //             'lastName' => 'required',
    //             'customers_gender' => 'required',
    //             'email' => 'required | email',
    //             'password' => 'required',
    //             're_password' => 'required | same:password',
    //         )
    //     );
    //     if ($validator->fails()) {
    //         return redirect('login')->withErrors($validator)->withInput();
    //     } else {

    //         $res = $this->customer->signupProcess($request);
    //         //eheck email already exit
    //         if ($res['email'] == "true") {
    //             return redirect('/login')->withInput($request->input())->with('error', Lang::get("website.Email already exist"));
    //         } else {
    //             if ($res['insert'] == "true") {
    //                 if ($res['auth'] == "true") {
    //                     $result = $res['result'];
    //                     Session::forget('guest_checkout');
    //                     return redirect('/')->with('result', $result);
    //                 } else {
    //                     return redirect('login')->with('loginError', Lang::get("website.Email or password is incorrect"));
    //                 }
    //             } else {
    //                 return redirect('/login')->with('error', Lang::get("website.something is wrong"));
    //             }
    //         }

    //     }
    // }

    public function addProductEnquiry(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $enquiry_products_id = DB::table('enquiry_products')->insertGetId([
            'enProductId' => $request->enProductId,
            'enName' => $request->enName,
            'enEmail' => $request->enEmail,
            'enPhone' => $request->enPhone,
            'enCity' => $request->enCity,
            'enPincode' => $request->enPincode,
            'enQuantity' => $request->enQuantity,
            'enPrice'=> $request->enPrice,
            'created_at' => date('y-m-d h:i:s')
        ]);

        $message    = "Your request has been successfully send.";
        return redirect()->back()->with('reviewSuccess', $message);
    }

    /********* KYC *************/
    public function kycList(Request $request)
    {
        
        if(Session::has('supportUserDetails')){
            $result['commonContent'] = $this->index->commonContent();
            $user_details = Session::get('supportUserDetails');
            
            $result['userKycList'] = DB::table('corporate_kyc')
                ->where('user_id', $user_details->id)
                ->get();
            
            return view("web.my_kyc")->with(['result' => $result]);
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
        
    }

    public function addKyc(Request $request)
    {
        if(Session::has('supportUserDetails')){
            $user_details = Session::get('supportUserDetails');

            if($request->hasFile('kyc_file')){

                $kyc_file_name = $user_details->id.'_'.time().'_'.rand().'.'.request()->kyc_file->getClientOriginalExtension();

                request()->kyc_file->move(public_path('upload_file/kyc'), $kyc_file_name);

            }else{
                $kyc_file_name = '';
            }
            
            $corporate_kyc_id = DB::table('corporate_kyc')->insertGetId([
                'user_id' => $user_details->id,
                'kyc_title' => $request->kyc_title,
                'kyc_file' => $kyc_file_name,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $message    = "File uploaded successfully.";
            return redirect()->back()->with('message', $message);
        }else{
            return redirect('/')->with('loginError', "Please Login!");
        }
    }
    /********* KYC *************/


    public function discountedCategory(Request $request)
    {
        $result['commonContent'] = $this->index->commonContent();

        if(Session::has('supportUserDetails')){
            
            $userAssignCategory = array();
            $userAssignProduct = array();
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

                $userProductArray = $current_user_details->userProductArray;
                if (!empty($userProductArray)) {
                    $userAssignProduct = DB::table('products')
                        ->leftJoin('manufacturers', 'manufacturers.manufacturers_id', '=', 'products.manufacturers_id')
                        ->leftJoin('manufacturers_info', 'manufacturers.manufacturers_id', '=', 'manufacturers_info.manufacturers_id')
                        ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
                        ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
                        ->select('products.*', 'image_categories.path as image_path', 'products_description.*', 'manufacturers.*')
                        ->whereIn('products.products_id', $userProductArray)
                        ->groupBy('products.products_id')
                        ->get();
                }
            }

            $result['userAssignCategory'] = $userAssignCategory;
            $result['userAssignProduct'] = $userAssignProduct;

            return view("web.discounted_category")->with(['result' => $result]);
            
        }else{
            return redirect('/');
        }

    }



}
