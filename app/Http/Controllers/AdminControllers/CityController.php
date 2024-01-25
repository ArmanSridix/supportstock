<?php

namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
//use App\Models\Core\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Models\Core\Setting;

class CityController extends Controller
{

    public function __construct(Setting $setting)
    {

        //$this->cities = $cities;
        $this->Setting = $setting;

    }

    //languages
    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingAllPincodes"));
        $result = array();
        //$cities = $this->cities->paginator();
        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->paginate(20);
        $result['cities'] = $cities;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.cities.index", $title)->with('result', $result);
    }

    //addLanguages
    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPincode"));
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.cities.add", $title)->with('result', $result);
    }

    //addNewLanguages
    public function insert(Request $request)
    {
        $cityExist = DB::table('cities')
            ->where('cities_name','=', $request->cities_name)
            ->get();
        if (count($cityExist)>0) {
            $errorMessage = Lang::get("labels.CityExist");
            return redirect()->back()->with('errorMessage', $errorMessage);
        }

        $city = DB::table('cities')->insert([
            'cities_name' => $request->cities_name
        ]);
        $message = Lang::get("labels.CityAddedMessage");
        return redirect()->back()->with('message', $message);
    }

    //editOrderStatus
    public function edit(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditPincode"));
        $cities = DB::table('cities')
            ->where('cities_id','=', $request->id)
            ->get();
        $result['cities'] = $cities;        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.cities.edit", $title)->with('result', $result);
    }

    //updateLanguageStatus
    public function update(Request $request)
    {

        $cityExist = DB::table('cities')
            ->where('cities_name','=', $request->cities_name)
            ->get();
        if (count($cityExist)>0) {
            if ($cityExist[0]->cities_id != $request->cities_id) {
                $errorMessage = Lang::get("labels.CityExist");
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
        }

        $orders_status = DB::table('cities')
            ->where('cities_id','=', $request->cities_id)
            ->update([
                'cities_name' => $request->cities_name
            ]);
        $message = Lang::get("labels.CityEditMessage");
        return redirect()->back()->with('message', $message);
    }

    //deletelanguage
    // public function delete(Request $request)
    // {
    //     $pincodes = $this->pincode->getter();
    //     $deletePincode = $this->pincode->deleteRecord($request);
    //     return redirect()->back()->withErrors([Lang::get("labels.pincodeDeleteMessage")]);
    // }


    public function filter(Request $request)
    {

        $filter = $request->FilterBy;
        $parameter = $request->parameter;

        $title = array('pageTitle' => Lang::get("labels.ListingCity"));

        $result = array();

        $pincodes = null;
        switch ($filter) {
            case 'city':

                $cities = DB::table('cities')
                    ->orderBy('cities_id', 'DESC')
                    ->select('cities.*')
                    ->where('cities.cities_name', 'LIKE', '%' . $parameter . '%')
                    ->paginate(20);
                break;

            default:
                $cities = DB::table('cities')
                    ->orderBy('cities_id', 'DESC')
                    ->select('cities.*')
                    ->paginate(20);

                break;

        }

        $result['cities'] = $cities;        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.cities.index", $title)->with('result', $result)->with('filter', $filter)->with('parameter', $parameter);

    }

}
