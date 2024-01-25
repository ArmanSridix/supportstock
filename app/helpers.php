<?php


use App\Models\Web\Cart;

function testHelper(){
   
    return 'test helper';

}

function login_checks(){

	if(Session::has('supportUserDetails')){
		$customer = Session::get('supportUserDetails');
		// echo "<pre>";
		// print_r($customer);
		$userDetails = DB::table('users')->where('id', $customer->id)
	    			->first();

		$toDay = date('Y-m-d 00:00:00');
	    if ($userDetails->subscription_start != '' && $userDetails->subscription_end != '') {
	    	if ($toDay>=$userDetails->subscription_start && $toDay<=$userDetails->subscription_end) {
	    		DB::table('users')->where('id', $customer->id)
	    			->update(['user_type' => 'Corporate']);
	    		$customer->user_type = 'Corporate';
	    		$customer->assign_type = $userDetails->assign_type;
	    		$customer->subscription_start = $userDetails->subscription_start;
	    		$customer->subscription_end = $userDetails->subscription_end;
	    	}else{
	    		//echo "string111";
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
//echo $customer->web_pincod_id.",".$user_pincode_id;exit;
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
	}
    
}



function getproductdetailslink($product_id=0){
	if($product_id==0)
		return '#';
	$products = DB::table('products_description')->where('products_id', $product_id)->first();
	
	if(is_null($products))
		return '#';
	return URL::to('product-detail/'.strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', preg_replace('/\s+/', ' ', $products->products_name))) . '-' . $product_id);
}









?>