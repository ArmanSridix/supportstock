<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Pincode extends Model
{

    use Sortable;

    // public function images(){
    //     return $this->belongsTo('App\Images');
    // }

    public $sortable = ['pincodes_id'];


        public function paginator(){
          $pincodes = Pincode::sortable(['pincodes_id'=>'desc'])
              ->select('pincodes.*','cities.cities_name')
              ->leftJoin('cities','cities.cities_id', '=', 'pincodes.pincodes_city_id')
              ->paginate(20);
             return $pincodes;
        }

        public function getter(){
          $pincodes = Pincode::sortable(['pincodes_id'=>'desc'])
              ->select('pincodes.*','cities.cities_name')
              ->leftJoin('cities','cities.cities_id', '=', 'pincodes.pincodes_city_id')
              ->groupby('pincodes_id')->get();
          return $pincodes;
        }

    public function insert($request){

      $pincode = DB::table('pincodes')->insert([
          'pincodes_val'     =>   $request->pincodes_val,
          'pincodes_city'     =>   '',
          'pincodes_city_id'     =>   $request->pincodes_city_id
      ]);
      return $pincode;

    }

    public function edit($request){

        $pincodes = DB::table('pincodes')
           ->select('pincodes.*')
           ->where('pincodes_id','=', $request->id)->get();

        return $pincodes;

    }

    public function updateRecord($request){

        $orders_status = DB::table('pincodes')
          ->where('pincodes_id','=', $request->pincodes_id)
          ->update([
            'pincodes_val'			=>	$request->pincodes_val,
            'pincodes_city'     =>   '',
            'pincodes_city_id'     =>   $request->pincodes_city_id
          ]);


        return 'success';
    }

    public function deleteRecord($request){
      DB::table('pincodes')->where('pincodes_id', $request->id)->delete();
      return 'success';
    }
     


}
