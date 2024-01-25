<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

use DB;

class ManufacturerController extends Controller
{

    public function __construct(Manufacturers $manufacturer, Languages $language, Images $images, Setting $setting)
    {
        $this->manufacturers = $manufacturer;
        $this->language = $language;
        $this->images = $images;
        $this->Setting = $setting;
    }

    public function display()
    {
        $title = array('pageTitle' => Lang::get("labels.Manufacturers"));
        $manufacturers = $this->manufacturers->paginator(20);        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.manufacturers.index")->with('manufacturers', $manufacturers)->with('result', $result);
    }

    public function add(Request $request)
    {
        $allimage = $this->images->getimages();
        $title = array('pageTitle' => Lang::get("labels.AddManufacturer"));
        $result['commonContent'] = $this->Setting->commonContent();

        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->where('city_active','=', 1)
            ->where('is_delete','=', 0)
            ->get();
        $result['cities'] = $cities;

        return view("admin.manufacturers.add", $title)->with('allimage', $allimage)->with('result', $result);
    }

    public function insert(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddManufacturer"));
        $this->manufacturers->insert($request);
        return redirect()->back()->with('update', 'Content has been created successfully!');
    }

    public function edit(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditManufacturers"));
        $manufacturers_id = $request->id;
        $editManufacturer = $this->manufacturers->edit($manufacturers_id);
        $allimage = $this->images->getimages();        
        $result['commonContent'] = $this->Setting->commonContent();

        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->where('city_active','=', 1)
            ->where('is_delete','=', 0)
            ->get();
        $result['cities'] = $cities;
        $result['manufacturureEdit'] = 'yes';
        
        return view("admin.manufacturers.edit", $title)->with('result', $result)->with('editManufacturer', $editManufacturer)->with('allimage', $allimage);
    }

    public function update(Request $request)
    {
        $messages = 'update is not successfull';
        $title = array('pageTitle' => Lang::get("labels.EditManufacturers"));
        $this->validate($request, [
            'id' => 'required',
            //'oldImage' => 'required',
            'slug' => 'required',
            'name' => 'required',
           // 'manufacturers_url' => 'required',

        ]);
        $this->manufacturers->updaterecord($request);
        return redirect()->back()->with('update', 'Content has been created successfully!');

    }

    //delete Manufacturers
    public function delete(Request $request)
    {

        $this->manufacturers->destroyrecord($request);
        return redirect()->back()->withErrors([Lang::get("labels.manufacturersDeletedMessage")]);
    }

    public function filter(Request $request)
    {

        $name = $request->FilterBy;
        $param = $request->parameter;
        $title = array('pageTitle' => Lang::get("labels.Manufacturers"));
        $manufacturers = $this->manufacturers->filter($name, $param);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.manufacturers.index", $title)->with('result', $result)->with('manufacturers', $manufacturers)->with('name', $name)->with('param', $param);
    }


    /******************************/
    public function pincodeByCity(Request $request)
    {
        $input = $request->all();
        $cities_id = $input['cities_id'];
        $pincodes_ids = array();

        $pincodes = DB::table('pincodes')
            ->where('pincodes_city_id',"=",$cities_id)
            ->orderBy('pincodes_id', 'DESC')
            ->get();

        $manufacturers_pincodes = DB::table('manufacturers_pincodes')
           ->select('manufacturers_pincodes.pincodes_id')
           ->get();
        $usedPincodes = array();
        if (!empty($manufacturers_pincodes)) {
          foreach ($manufacturers_pincodes as $key => $value) {
            array_push($usedPincodes, $value->pincodes_id);
          }
        }

        $view = view("admin.manufacturers.pincode_view",compact('pincodes','pincodes_ids','usedPincodes'))->render();

        return response()->json(['html'=>$view]);

    }
    /******************************/

    /******************************/
    public function pincodeByCityEdit(Request $request)
    {
        $input = $request->all();
        $seller_id = $input['seller_id'];
        $cities_id = $input['cities_id'];

        $pincodes_ids = array();
        $manufacturers_pincodes = DB::table('manufacturers_pincodes')
           ->select('manufacturers_pincodes.pincodes_id')
           ->where('manufacturers_id','=', $seller_id)->get();

        if (!empty($manufacturers_pincodes)) {
          foreach ($manufacturers_pincodes as $key => $value) {
            array_push($pincodes_ids, $value->pincodes_id);
          }
        }

        $pincodes = DB::table('pincodes')
            ->where('pincodes_city_id',"=",$cities_id)
            ->orderBy('pincodes_id', 'DESC')
            ->get();

        $manufacturer_pincode = DB::table('manufacturers_pincodes')
           ->select('manufacturers_pincodes.pincodes_id')
           ->where('manufacturers_id',"!=",$seller_id)
           ->get();
        $usedPincodes = array();
        if (!empty($manufacturer_pincode)) {
          foreach ($manufacturer_pincode as $key => $value) {
            array_push($usedPincodes, $value->pincodes_id);
          }
        }

        $view = view("admin.manufacturers.pincode_view",compact('pincodes','pincodes_ids','usedPincodes'))->render();

        return response()->json(['html'=>$view]);

    }
    /******************************/

}
