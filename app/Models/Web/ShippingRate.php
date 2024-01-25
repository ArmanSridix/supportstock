<?php

namespace App\Models\Web;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Session;

class ShippingRate extends Model
{

    public function getShippingRate()
    {
        $items = DB::table('shipping_rate')->get();
        return $items;
    }
   

}
