<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Payments_setting;
use App\Models\Core\Setting;
use App\Models\Core\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class PaymentMethodsController extends Controller
{
    //

    public function __construct(Payments_setting $payments_setting,Setting $setting, Languages $languages)
    {
        $this->Payments_setting = $payments_setting;
        $this->Setting = $setting;
        $this->Languages = $languages;
    }

    public function index(Request $request){
        $title = array('pageTitle' => Lang::get("labels.PaymentSetting"));
        $result = array();
        $result['methods'] = $this->Payments_setting->paymentmethods();
        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.paymentmethods.index", $title)->with('result', $result);
    }

    public function display($id){
        $title = array('pageTitle' => Lang::get("labels.PaymentSetting"));
        $result = array();
        $result['methods'] = $this->Payments_setting->display($id);
        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.paymentmethods.display", $title)->with(['result' => $result,'id'=> $id]);
    }

    public function update(Request $request){
      $this->Payments_setting->updaterecord($request);
      $message = Lang::get("labels.InformationUpdatedMessage");
      return redirect()->back()->withErrors([$message]);
    }

    public function active(Request $request){

      $this->Payments_setting->active($request);
      $message = Lang::get("labels.InformationUpdatedMessage");
      return redirect()->back()->withErrors([$message]);

    }


    public function cashOnDelivery(Request $request){
        $title = array('pageTitle' => "Cash On Delivery");
        $result = array();
        $result['cod_list'] = DB::table('cash_on_delivery_limit')->orderBy('cod_limit_id','ASC')->get();

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.paymentmethods.cass_on_delivery", $title)->with('result', $result);
    }

    public function cashOnDeliveryEdit($id){
        $title = array('pageTitle' => 'Cash on delivery');
        $result = array();
        
        $result['cod_details'] = DB::table('cash_on_delivery_limit')->where('cod_limit_id','=',$id)->get();

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.paymentmethods.cass_on_delivery_edit", $title)->with(['result' => $result,'id'=> $id]);
    }

    public function updateCashOnDelivery(Request $request){
        $contact_update = DB::table('cash_on_delivery_limit')->where('cod_limit_id','=',$request->id)
            ->update([
                'cod_min_price'  =>  $request->cod_min_price,
                'cod_max_price'     =>  $request->cod_max_price
            ]);

        $message = Lang::get("labels.contactuseditText");
        return redirect()->back()->withErrors([$message]);

    }


}
