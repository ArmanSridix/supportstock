<?php

namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Core\Pincode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Models\Core\Setting;

class PincodeController extends Controller
{

    public function __construct(Pincode $pincode, Setting $setting)
    {

        $this->pincode = $pincode;
        $this->Setting = $setting;

    }

    //languages
    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingAllPincodes"));
        $result = array();
        $pincodes = $this->pincode->paginator();
        // echo "<pre>";
        // print_r($pincodes);exit;
        $result['pincodes'] = $pincodes;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pincodes.index", $title)->with('result', $result);
    }

    //addLanguages
    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddPincode"));
        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->get();
        $result['cities'] = $cities;
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pincodes.add", $title)->with('result', $result);
    }

    //addNewLanguages
    public function insert(Request $request)
    {
        $pincodes = $this->pincode->getter();

        $pincodeExist = DB::table('pincodes')
            ->where('pincodes_val','=', $request->pincodes_val)
            ->get();
        if (count($pincodeExist)>0) {
            $errorMessage = Lang::get("labels.PincodeExist");
            return redirect()->back()->with('errorMessage', $errorMessage);
        }

        $pincodes = $this->pincode->insert($request);
        $message = Lang::get("labels.pincodeAddedMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //editOrderStatus
    public function edit(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditPincode"));
        $cities = DB::table('cities')
            ->orderBy('cities_id', 'DESC')
            ->select('cities.*')
            ->get();
        $result['cities'] = $cities;

        $pincodes = $this->pincode->edit($request);
        $result['pincodes'] = $pincodes;        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pincodes.edit", $title)->with('result', $result);
    }

    //updateLanguageStatus
    public function update(Request $request)
    {

        $pincodeExist = DB::table('pincodes')
            ->where('pincodes_val','=', $request->pincodes_val)
            ->get();
        if (count($pincodeExist)>0) {
            if ($pincodeExist[0]->pincodes_id != $request->pincodes_id) {
                $errorMessage = Lang::get("labels.PincodeExist");
                return redirect()->back()->with('errorMessage', $errorMessage);
            }
        }

        $pincodes = $this->pincode->getter();
        $this->pincode->updateRecord($request);
        $message = Lang::get("labels.pincodeEditMessage");
        return redirect()->back()->withErrors([$message]);
    }

    //deletelanguage
    public function delete(Request $request)
    {
        $pincodes = $this->pincode->getter();
        $deletePincode = $this->pincode->deleteRecord($request);
        return redirect()->back()->withErrors([Lang::get("labels.pincodeDeleteMessage")]);
    }


    public function filter(Request $request)
    {

        $filter = $request->FilterBy;
        $parameter = $request->parameter;

        $title = array('pageTitle' => Lang::get("labels.ListingPincode"));

        $result = array();

        $pincodes = null;
        switch ($filter) {
            case 'pincode':

                $pincodes = Pincode::sortable(['pincodes_id'=>'desc'])
                    ->select('pincodes.*','cities.cities_name')
                    ->leftJoin('cities','cities.cities_id', '=', 'pincodes.pincodes_city_id')
                    ->where('pincodes.pincodes_val', 'LIKE', '%' . $parameter . '%')
                    ->paginate(20);
                break;

            default:
                $pincodes = Pincode::sortable(['pincodes_id'=>'desc'])
                    ->select('pincodes.*','cities.cities_name')
                    ->leftJoin('cities','cities.cities_id', '=', 'pincodes.pincodes_city_id')
                    ->paginate(20);

                break;

        }

        $result['pincodes'] = $pincodes;        
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.pincodes.index", $title)->with('result', $result)->with('filter', $filter)->with('parameter', $parameter);

    }

}
