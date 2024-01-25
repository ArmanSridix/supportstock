<?php
namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Customers;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Setting;
use App\Models\Core\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Kyslik\ColumnSortable\Sortable;

class CustomersController extends Controller
{
    //
    public function __construct(Customers $customers, Setting $setting, Categories $category)
    {
        $this->Customers = $customers;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->Setting = $setting;
        $this->category = $category;
    }

    public function display()
    {
        $title = array('pageTitle' => Lang::get("labels.ListingCustomers"));
        $language_id = '1';

        $customers = $this->Customers->paginator();

        $result = array();
        $index = 0;
        foreach($customers as $customers_data){
            array_push($result, $customers_data);

            $devices = DB::table('devices')->where('user_id','=',$customers_data->id)->orderBy('created_at','DESC')->take(1)->get();

            $result[$index]->devices = $devices;
            $index++;
        }

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['result'] = $customers;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.customers.index", $title)->with('customers', $customerData)->with('result', $result);
    }





    public function corporateRequest()
    {
     
        $title = array('pageTitle' => Lang::get("Admin Panel | Corporate Request"));
        $language_id = '1';

        $customers = $this->Customers->getCorporateRequest();

        $result = array();
        $index = 0;
        foreach($customers as $customers_data){
            array_push($result, $customers_data);

            $devices = DB::table('devices')->where('user_id','=',$customers_data->id)->orderBy('created_at','DESC')->take(1)->get();
            $result[$index]->devices = $devices;
            $index++;
        }

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['result'] = $customers;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.customers.corporateRequest", $title)->with('customers', $customerData)->with('result', $result);
    }

    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddCustomer"));
        $images = new Images;
        $allimage = $images->getimages();
        $language_id = '1';
        $customerData = array();
        $message = array();
        $errorMessage = array();
        $customerData['countries'] = $this->Customers->countries();
        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $result['commonContent'] = $this->Setting->commonContent();

        $categories = $this->category->recursivecategories($request);

        $parent_id = array();
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
            <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class="  categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
          ' . $parents->categories_name . '
          </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
          <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }
        $option .= '</ul>';

        $result['categories'] = $option;

        $products = DB::table('products')
            ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->select('products_description.products_name', 'products.products_id', 'products.products_model', 'products.products_sku')->get();
        $result['products'] = $products;

        return view("admin.customers.add", $title)->with('customers', $customerData)->with('allimage',$allimage)->with('result', $result);
    }

    public function childcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            if (in_array($child->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $contents .= '<label> <input id="categories_' . $child->categories_id . '" parents_id="' . $child->parent_id . '"  type="checkbox" name="categories[]" class=" sub_categories categories sub_categories_' . $child->parent_id . '" value="' . $child->categories_id . '" ' . $checked . '> ' . $child->categories_name . '</label>';

            if (isset($child->childs)) {
                $contents .= '<ul class="list-group">
        <li class="list-group-item">';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</li></ul>";
            }

        }
        return $contents;
    }


    //add addcustomers data and redirect to address
    public function insert(Request $request)
    {

        $language_id = '1';
        //get function from other controller
        $images = new Images;
        $allimage = $images->getimages();

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //check email already exists
        $existEmail = $this->Customers->email($request);
        $existPhone = $this->Customers->phone($request);
        $this->validate($request, [
            'customers_firstname' => 'required',
            'customers_lastname' => 'required',
           
            'customers_telephone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'isActive' => 'required',
        ]);


        if (count($existEmail)> 0 ) {
            $messages = Lang::get("labels.Email address already exist");
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }else if (count($existPhone)> 0 ) {
            $messages = "Phone no already exist";
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        } else {
            $customers_id = $this->Customers->insert($request);
            // dd($customers_id);
            return redirect('admin/customers/address/display/' . $customers_id)->with('update', 'Customer has been created successfully!');
        }
    }

    public function diplayaddress(Request $request){

        $title = array('pageTitle' => Lang::get("labels.AddAddress"));

        $language_id                =   '1';
        $id                         =   $request->id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        $customer_addresses = $this->Customers->addresses($id);
        $countries = $this->Customers->country();

        $customerData['message'] = $message;
        $customerData['errorMessage'] = $errorMessage;
        $customerData['customer_addresses'] = $customer_addresses;
        $customerData['countries'] = $countries;
        $customerData['user_id'] = $id;

        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->get();
        $customerData['cities'] = $cities;

        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.customers.address.index",$title)->with('data', $customerData)->with('result', $result);
    }

    public function selectPincodeById(Request $request)
    {
        //print_r($request->all());exit;
        $input = $request->all();
        $entry_city = $input['entry_city'];

        $pincode_list = DB::table('pincodes')
            ->where('pincodes_city_id',"=",$entry_city)
            ->get();

        return response()->json(['pincode_list'=>$pincode_list]);

    }


    //add Customer address
    public function addcustomeraddress(Request $request){
      $customer_addresses = $this->Customers->addcustomeraddress($request);
      return $customer_addresses;
    }

    public function editaddress(Request $request){

      $user_id                 =   $request->user_id;
      $address_book_id         =   $request->address_book_id;

      $customer_addresses = $this->Customers->addressBook($address_book_id);
      $countries = $this->Customers->countries();;
      $zones = $this->Customers->zones($customer_addresses);
      $customers = $this->Customers->checkdefualtaddress($address_book_id);

      $customerData['user_id'] = $user_id;
      $customerData['customer_addresses'] = $customer_addresses;
      $customerData['countries'] = $countries;
      $customerData['zones'] = $zones;
      $customerData['customers'] = $customers;

      $cities = DB::table('cities')
          ->orderBy('cities_id', 'DESC')
          ->select('cities.*')
          ->get();
      $customerData['cities'] = $cities;
      
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin/customers/address/editaddress")->with('data', $customerData)->with('result', $result);
    }

    //update Customers address
    public function updateaddress(Request $request){
      $customer_addresses = $this->Customers->updateaddress($request);
      return ($customer_addresses);
    }

    public function deleteAddress(Request $request){
      $customer_addresses = $this->Customers->deleteAddresses($request);
      return redirect()->back()->withErrors([Lang::get("labels.Delete Address Text")]);
    }

    //editcustomers data and redirect to address
    public function edit(Request $request){

      $images           = new Images;
      $allimage         = $images->getimages();
      $title            = array('pageTitle' => Lang::get("labels.EditCustomer"));
      $language_id      =   '1';
      $id               =   $request->id;

      $customerData = array();
      $message = array();
      $errorMessage = array();
      $customers = $this->Customers->edit($id);

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['countries'] = $this->Customers->countries();
      $customerData['customers'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      $categories = $this->category->recursivecategories($request);

      $u_categories = DB::table('user_to_category')
        ->leftJoin('categories', 'categories.categories_id', '=', 'user_to_category.categories_id')
        ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
        ->where('user_id', '=', $id)->where('categories_description.language_id', '=', $language_id)
        ->where('categories_status', '1')
        ->get();

      $categories_array = array();
      foreach($u_categories as $category){
          $categories_array[] = $category->categories_id;
      }

      $parent_id = $categories_array;
      $option = '<ul class="list-group list-group-root well">';

      foreach ($categories as $parents) {

          if (in_array($parents->categories_id, $parent_id)) {
              $checked = 'checked';
          } else {
              $checked = '';
          }

          $option .= '<li href="#" class="list-group-item">
      <label style="width:100%">
        <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class="  categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
      ' . $parents->categories_name . '
      </label></li>';

          if (isset($parents->childs)) {
              $option .= '<ul class="list-group">
      <li class="list-group-item">';
              $option .= $this->childcat($parents->childs, $parent_id);
              $option .= '</li></ul>';
          }
      }

      $option .= '</ul>';
      $result['categories'] = $option;

      $products = DB::table('products')
          ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
          ->select('products_description.products_name', 'products.products_id', 'products.products_model', 'products.products_sku')->get();
      $result['products'] = $products;

      $userProduct = DB::table('user_to_product')
          ->where('user_id', '=', $id)->get();
      $userProductArray = array();
      if (count($userProduct)>0) {
        foreach ($userProduct as $key => $value) {
          array_push($userProductArray, $value->products_id);
        }
      }

      return view("admin.customers.edit",$title)->with('data', $customerData)->with('result', $result)->with('allimage', $allimage)->with('userProductArray', $userProductArray);
    }

    //add addcustomers data and redirect to address
    public function update(Request $request){
      // echo "<pre>";
      // print_r($request->all());
      // exit;
        $language_id  =   '1';
        $user_id  = $request->customers_id;

        $customerData = array();
        $message = array();
        $errorMessage = array();

        //check email already exists
        $existEmail = $this->Customers->emailEdit($request);
        $existPhone = $this->Customers->phoneEdit($request);

        if (count($existEmail)> 0 ) {
            $messages = Lang::get("labels.Email address already exist");
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }else if (count($existPhone)> 0 ) {
            $messages = "Phone no already exist";
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }else{
            //get function from other controller
            // if($request->image_id!==null){
            //     $customers_picture = $request->image_id;
            // }   else{
            //     $customers_picture = $request->oldImage;
            // }

            // if($request->image_id){
            //     $uploadImage = $request->image_id;
            //     $uploadImage = DB::table('image_categories')->where('image_id',$uploadImage)->select('path')->first();
            //     $customers_picture = $uploadImage->path;
            // }   else{
            //     $customers_picture = $request->oldImage;
            // }

          // if ($request->user_type=='Corporate') {
          //   if ($request->subscription_start_date!='' && $request->subscription_end_date!='' ) {
          //   //  echo "string";exit;
          //     // $subscription_period = $request->subscription_period;
          //     $subscription_start = date('Y-m-d H:i:s',strtotime($request->subscription_start_date));
          //     $subscription_end = date('Y-m-d H:i:s',strtotime($request->subscription_end_date));
          //   }
          // }

            $user_data = array(
                //'gender'            =>   $request->gender,
                'user_type' =>   $request->user_type,               
                'assign_type' => $request->assign_type,
                'first_name'        =>   $request->first_name,
                'last_name'         =>   $request->last_name,
                'company_name' => $request->company_name,
                //'dob'                     =>     $request->dob,
                'email' => $request->email,
                'phone'           =>     $request->phone,
                'status'            =>   $request->status,
                'updated_at'    => date('Y-m-d H:i:s'),
            );
           
           

            // if ($request->subscription_start_date!='' && $request->subscription_end_date!='') {
            //   // $user_data['subscription_period'] = $subscription_period;
            //   echo $subscription_end;exit;
            //   $user_data['subscription_start'] = $subscription_start;
            //   $user_data['subscription_end'] = $subscription_end;
            // }
            if ($request->user_type=='Corporate') {
              if ($request->subscription_start_date!='' && $request->subscription_end_date!='' ) {
                
                $subscription_start_date = str_replace('/', '-', $request->subscription_start_date);
                $subscription_end_date = str_replace('/', '-', $request->subscription_end_date);
                $user_data['subscription_start'] = date('Y-m-d H:i:s',strtotime($subscription_start_date));
                $user_data['subscription_end'] = date('Y-m-d H:i:s',strtotime($subscription_end_date));
                $user_data['corporate_request'] =0;
              }
            }else{
              $user_data['subscription_start'] = null;
              $user_data['subscription_end'] = null;
              $user_data['corporate_request'] =0;
            }

            $customer_data = array(
              'customers_newsletter'            =>   0,
              'updated_at'    => date('Y-m-d H:i:s'),
            );

            if($request->changePassword == 'yes'){
                $user_data['password'] = Hash::make($request->password);
            }

            $this->Customers->updaterecord($customer_data,$user_id,$user_data);

            DB::table('user_to_category')->where([
              'user_id' => $user_id,
            ])->delete();

            DB::table('user_to_product')->where([
              'user_id' => $user_id,
            ])->delete();

            if ($request->user_type=='Corporate') {

              if ($request->assign_type=='Category') {
                foreach($request->categories as $categories){
                  DB::table('user_to_category')
                    ->insert([
                      'user_id' => $user_id,
                      'categories_id' => $categories
                  ]);
                }
              }

              if ($request->assign_type=='Product') {
                foreach($request->product_ids as $product_ids){
                  DB::table('user_to_product')
                    ->insert([
                      'user_id' => $user_id,
                      'products_id' => $product_ids
                  ]);
                }
              }
              
            }

            return redirect('admin/customers/address/display/'.$user_id);
        }        
        
    }

    public function delete(Request $request){
      $this->Customers->destroyrecord($request->users_id);
      return redirect()->back()->withErrors([Lang::get("labels.DeleteCustomerMessage")]);
    }

    public function filter(Request $request){
      $filter    = $request->FilterBy;
      $parameter = $request->parameter;
      
      $title = array('pageTitle' => Lang::get("labels.ListingCustomers"));
      $customers  = $this->Customers->filter($request);
      // echo "<pre>";
      // print_r($request->all());
      // print_r($customers);
      // exit;
      $result = array();
      $index = 0;
      foreach($customers as $customers_data){
          array_push($result, $customers_data);

          $devices = DB::table('devices')->where('user_id','=',$customers_data->id)->orderBy('created_at','DESC')->take(1)->get();
          $result[$index]->devices = $devices;
          $index++;
      }

      $customerData = array();
      $message = array();
      $errorMessage = array();

      $customerData['message'] = $message;
      $customerData['errorMessage'] = $errorMessage;
      $customerData['result'] = $customers;
      $result['commonContent'] = $this->Setting->commonContent();

      return view("admin.customers.index",$title)->with('result', $result)->with('customers', $customerData)->with('filter',$filter)->with('parameter',$parameter);
    }


    /******** kyc **********/
    public function viewKyc(Request $request){
      
      $id = $request->id;

      $result['commonContent'] = $this->Setting->commonContent();

      $allKyc = DB::table('corporate_kyc')
        ->where('user_id', '=', $id)
        ->get();
      $result['allKyc'] = $allKyc;

      // echo "<pre>";
      // print_r($result);exit;

      return view("admin.customers.view_kyc")->with('result', $result);
    }
}
