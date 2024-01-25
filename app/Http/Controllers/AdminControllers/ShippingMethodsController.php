<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Languages;
use App\Models\Core\Setting;
use App\Models\Core\Shipping_method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;

class ShippingMethodsController extends Controller
{
    //
    public function __construct(Shipping_method $shipping_method, Setting $setting, Languages $languages)
    {
        $this->Shipping_method = $shipping_method;
        $this->Setting = $setting;
        $this->Languages = $languages;
    }

    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ShippingMethods"));

        $shipping_rate = DB::table('shipping_rate')->get();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.shippingmethods.index", $title)->with('shipping_rate', $shipping_rate)->with('result', $result);

    }

    /************** add ****************/
		public function add(){
            $title = array('pageTitle' => Lang::get("labels.ShippingMethods"));

            $result['commonContent'] = $this->Setting->commonContent();
            return view("admin/shippingmethods/add")->with('result', $result);
            }
            /************** add ****************/
        
            /************** insert ****************/
            public function insert(Request $request){
            
            $subscriptionsInsert = DB::table('shipping_rate')->insert([
                'amount_from'	=>	$request->amount_from,
                'amount_to'	=>	$request->amount_to,
                'shipping_rate'=>	$request->shipping_rate,
                ]);
            $message = "Added successfully";
            return redirect()->back()->withErrors([$message]);
            }
            /************** add  ****************/
        
            /************** edit  ****************/
            public function edit(Request $request){
                
                $shipping_rate = DB::table('shipping_rate')->where('id','=',$request->id)->first();
                $result['commonContent'] = $this->Setting->commonContent();
                return view("admin/shippingmethods/edit")->with('shipping_rate', $shipping_rate)->with('result', $result);
                }
                /************** edit ****************/
        
                /************** update ****************/
                public function update(Request $request){
                    // echo "<pre>"; print_r($request->all());exit;
                    
                
                $shipping_rate_data = array();
                if($request->amount_from){
                    $shipping_rate_data['amount_from'] = $request->amount_from;
                }
                if($request->amount_to){
                    $shipping_rate_data['amount_to'] = $request->amount_to;
                }
                if($request->shipping_rate){
                    $shipping_rate_data['shipping_rate'] = $request->shipping_rate;
                }
                DB::table('shipping_rate')->where('id','=',$request->id)
                    ->update($shipping_rate_data);
        
                    $message = "Updated successfully";
                    return redirect()->back()->withErrors([$message]);
        
                }
                /************** update ****************/
        
                /************** delete ****************/
                public function delete(Request $request){
                DB::table('shipping_rate')->where('id','=',$request->id)->delete();
        
                $message = "Shipping Rate Successfully deleted";
                return redirect()->back()->withErrors([$message]);
        
            }
            /************** delete ****************/
}
