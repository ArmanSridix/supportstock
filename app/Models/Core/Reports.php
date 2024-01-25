<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Reports extends Model
{
    use Sortable;
    public $sortable = ['reviews_id', 'products_id', 'customers_id', 'customers_name', 'reviews_rating', 'reviews_status', 'reviews_read', 'created_at', 'updated_at'];
    public function customersReport($request)
    {

        $language_id = '1';
        $report = DB::table('orders');

        if (isset($request->orderid)) {
            $report->where('orders_id', $request->orderid);
        }

        if (isset($request->customers_id)) {
            $report->where('customers_id', $request->customers_id);
        }

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

       
        if (isset($request->orders_status_id)) {

            $orders_status_id = $request->orders_status_id;
            $report->LeftJoin('orders_status_history', function ($join) use ($orders_status_id) {
                $join->on('orders_status_history.orders_id', '=', 'orders.orders_id')
                    ->orderby('orders_status_history.date_added', 'DESC')->limit(1);
            });

        }

        $report->select('orders.*')->where('customers_id', '!=', '')->orderby('orders.orders_id', 'DESC')->groupby('orders.orders_id');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }
        
        $total_orders_price = $report->sum('order_price');
       
        // dd($total_orders_price);
        $index = 0;
        $total_price = 0;

        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_data->orders_id)->sum('final_price');

            $orders[$index]->total_price = $orders_products;
            $total_price += $orders_products;

            $orders_status = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status.role_id', '<=', 2);
            if (isset($request->orders_status_id)) {
                $orders_status->where('orders_status_history.orders_status_id', $orders_status_id);
            }

            $orders_status_history = $orders_status->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

            // $current_boy = DB::table('users')
            //     ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
            //     ->leftjoin('orders_to_delivery_boy', 'orders_to_delivery_boy.deliveryboy_id', '=', 'users.id')
            // ->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status')
            //     ->where('orders_to_delivery_boy.orders_id', '=', $orders_data->orders_id)
            //     ->where('users.role_id', 4)
            //     ->where('is_current', 1)
            //     ->first();

            // if ($current_boy) {
            //     $orders[$index]->deliveryboy_name = $current_boy->first_name . ' ' . $current_boy->last_name;
            // } else {
            //     $orders[$index]->deliveryboy_name = '';
            // }

            if(count($orders_status_history) > 0){
                $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
            }else{
                unset($orders[$index]);
            }
            $index++;

        }

        $result = array('orders' => $orders, 'total_price' => $total_orders_price);
        return $result;
    }

    public function couponReport($request)
    {
        $report = DB::table('orders');

        if (isset($request->couponcode)) {
            $report->where('coupon_text', $request->couponcode);
        }

        if (isset($request->dateRange)) {
            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

        $report->select('orders.*')->where('customers_id', '!=', '')->where('coupon_text', '!=', '')->orderby('orders.orders_id', 'DESC')->groupby('orders.orders_id');
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        $total_orders_price = $report->sum('order_price');

        $index = 0;
        $total_price = 0;

        $result = array('orders' => $orders);
        return $result;
    }

    public function customersReportTotal($request)
    {   
        $report = DB::table('orders');

        if (isset($request->orderid)) {
            $report->where('orders_id', $request->orderid);
        }

        if (isset($request->customers_id)) {
            $report->where('customers_id', $request->customers_id);
        }

        if (isset($request->dateRange)) {

            $range = explode('-', $request->dateRange);

            $startdate = trim($range[0]);
            $enddate = trim($range[1]);

            $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
            $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
            $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        }

        

        if (isset($request->orders_status_id)) {

            $orders_status_id = $request->orders_status_id;
            // dd($orders_status_id);
            // $report->LeftJoin('orders_status_history', function ($join) use ($orders_status_id) {
            //     $join->on('orders_status_history.orders_id', '=', 'orders.orders_id')
            //         ->orderby('orders_status_history.date_added', 'DESC')->limit(1);
            // });
            $report->leftJoin('orders_status_history', 'orders.orders_id', '=', 'orders_status_history.orders_id')
            ->where('orders_status_history.orders_status_id', '=', [$orders_status_id]);

        }

        // $report->groupBy('orders.orders_id');
        $prices = $report->sum('order_price');
        // $prices = $report->toSql();
        // dd($prices);
        return ($prices);
    }

    public function allorderstatuses()
    {
        $statuses = DB::table('orders_status')
            ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
            ->LeftJoin('languages', 'languages.languages_id', '=', 'orders_status_description.language_id')
            ->where('orders_status_description.language_id', '=', '1')
        // ->where('orders_status.role_id', '=', 2)
            ->orderby('role_id')
            ->get();

        return $statuses;
    }

    public function salesreport($request)
    {

        // if (isset($request->dateRange)) {
        //     $range = explode('-', $request->dateRange);

        //     $startdate = trim($range[0]);
        //     $enddate = trim($range[1]);

        //     $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
        //     $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
        //     // $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        // } else {
        //     // $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
        //     // $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));

        //     //start date
        //     $dateFrom = DB::table('orders')->orderby('date_purchased', 'ASC')->first();
        //     $dateTo = DB::table('orders')->orderby('date_purchased', 'DESC')->first();
        // }

        // $report = DB::table('orders');

        // // if (isset($request->dateRange)) {
        // //     $range = explode('-', $request->dateRange);

        // //     $startdate = trim($range[0]);
        // //     $enddate = trim($range[1]);

        // //     $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
        // //     $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
        // //     $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
        // // }

        // $report->whereBetween('date_purchased', [$dateFrom->date_purchased, $dateTo->date_purchased])
        //     ->select('orders.*')->where('customers_id', '!=', '')
        //     ->orderby('orders.orders_id', 'ASC')->groupby('orders.orders_id');

        // if ($request->page and $request->page == 'invioce') {
        //     $orders = $report->get();
        // } else {
        //     $orders = $report->paginate(50);
        // }

        // //dd($orders);

        // $total_orders_price = $report->sum('order_price');
        // // dd($total_orders_price);
        // $index = 0;
        // $total_price = 0;

        // foreach ($orders as $orders_data) {
        //     $language_id = 1;
        //     //orders total
        //     $orders_products = DB::table('orders_products')->where('orders_id', '=', $orders_data->orders_id)->sum('final_price');

        //     //products total

        //     $orders[$index]->total_price = $orders_products;
        //     $total_price += $orders_products;

        //     $orders_status = DB::table('orders_status_history')
        //         ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
        //         ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
        //         ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
        //         ->where('orders_status_description.language_id', '=', $language_id)
        //         ->where('orders_id', '=', $orders_data->orders_id)
        //         ->where('orders_status.role_id', '<=', 2);
        //     if (isset($request->orders_status_id)) {
        //         $orders_status->where('orders_status_history.orders_status_id', $orders_status_id);
        //     }

        //     $orders_status_history = $orders_status->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

        //     $current_boy = DB::table('users')
        //         ->leftjoin('deliveryboy_info', 'users.id', '=', 'deliveryboy_info.users_id')
        //         ->leftjoin('orders_to_delivery_boy', 'orders_to_delivery_boy.deliveryboy_id', '=', 'users.id')
        //     //->select('users.id', 'users.first_name', 'users.last_name', 'deliveryboy_info.availability_status')
        //         ->where('orders_to_delivery_boy.orders_id', '=', $orders_data->orders_id)
        //         ->where('users.role_id', 4)
        //         ->where('is_current', 1)
        //         ->first();

        //     if ($current_boy) {
        //         $orders[$index]->deliveryboy_name = $current_boy->first_name . ' ' . $current_boy->last_name;
        //     } else {
        //         $orders[$index]->deliveryboy_name = '';
        //     }

        //     $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
        //     $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
        //     $index++;

        // }

//         select date_purchased, count(orders.orders_id) as total_orders ,count(orders_products.products_id) as total_products from orders
// left join orders_products on orders_products.orders_id = orders.orders_id 
// where date_purchased between (CURDATE() - INTERVAL (select count(orders_id) from orders) DAY)
// and (CURDATE() - INTERVAL 1 DAY) group by DATE(date_purchased)

        

        $report = DB::table('orders')
                    ->leftjoin('orders_products', 'orders_products.orders_id', '=', 'orders.orders_id')
                    ->selectRaw("date_purchased, count('orders.orders_id') as total_orders, count('orders_products.orders_id') as total_products, sum(order_price) as total_price");
                    if (isset($request->dateRange)) {
                        $range = explode('-', $request->dateRange);
            
                        $startdate = trim($range[0]);
                        $enddate = trim($range[1]);
            
                        $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                        $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                        $report->whereBetween('date_purchased', [$dateFrom, $dateTo]);
                    }

                    $report->whereRaw("date_purchased between (CURDATE() - INTERVAL (select count(orders_id) from orders) DAY)
                    and (CURDATE() - INTERVAL 1 DAY) group by DATE(date_purchased)");

                    $report->orderby('orders.date_purchased', 'DESC');


        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        $total_orders_price = DB::table('orders')
                    ->sum('order_price');
        
        $result = array('orders' => $orders, 'total_price' => $total_orders_price);
        return $result;
    }

    public function inventoryreport($request)
    {
        $report = DB::table('inventory')
            ->leftjoin('manage_min_max', 'manage_min_max.products_id', '=', 'manage_min_max.products_id')
            ->select('inventory.*', 'manage_min_max.min_level', 'manage_min_max.max_level')->orderby('created_at','desc');
        // dd($report);
        if (isset($request->products_id)) {
            $report->where('inventory.products_id', $request->products_id);

            if (isset($request->dateRange)) {
                $range = explode('-', $request->dateRange);

                $startdate = trim($range[0]);
                $enddate = trim($range[1]);

                $dateFrom = date('Y-m-d ' . '00:00:00', strtotime($startdate));
                $dateTo = date('Y-m-d ' . '23:59:59', strtotime($enddate));
                $report->whereBetween('created_at', [$dateFrom, $dateTo]);
            }

        } else {
            $report->where('inventory.inventory_ref_id', '');
        }

        if ($request->page and $request->page == 'invioce') {
            $reports = $report->get();
        } else {
            $reports = $report->paginate(50);
        }

        $index = 0;
        foreach ($reports as $data) {
            // dd($reports);
            //current stock
            $prev_stock_in = DB::table('inventory')
                // ->where('inventory_ref_id', '<=', $data->inventory_ref_id)
                ->where('stock_type', 'in')
                ->where('inventory.products_id', $request->products_id)
                ->sum('stock');
            // dd($prev_stock_in);
            $prev_stock_out = DB::table('inventory')
                ->where('inventory_ref_id', '<=', $data->inventory_ref_id)
                ->where('stock_type', 'out')
                ->where('inventory.products_id', $request->products_id)
                ->sum('stock');
            // dd($prev_stock_out);
            if ($prev_stock_out > 0) {
                $reports[$index]->current_stock = abs($prev_stock_in - $prev_stock_out);
            } else {
                $reports[$index]->current_stock = $prev_stock_in;
            }
            $index++;

        }

        return $reports;

    }

    public function minstock($request)
    {
        $report = DB::table('inventory')
            ->leftjoin('manage_min_max', 'manage_min_max.products_id', '=', 'inventory.products_id')
            ->leftjoin('products_description', 'products_description.products_id', '=', 'inventory.products_id')
            ->select('inventory.products_id', 'products_description.products_name', 'manage_min_max.min_level', DB::raw("( SUM(IF(stock_type = 'in', stock, 0)) -
                    SUM(IF(stock_type = 'out', stock, 0)) ) as 'stocks'", DB::raw("having ( SUM(IF(stock_type = 'in', stock, 0)) -
                    SUM(IF(stock_type = 'out', stock, 0)) )")))
            ->where('manage_min_max.min_level', '>', '0')
            ->where('language_id', 1)
            ->groupby('inventory.products_id');
        //->having(DB::raw("SUM(IF(stock_type = 'in', stock, 0)) - SUM(IF(stock_type = 'out', stock, 0))"))

        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        return $orders;

    }

    public function maxstock($request)
    {
        $report = DB::table('inventory')
            ->leftjoin('manage_min_max', 'manage_min_max.products_id', '=', 'inventory.products_id')
            ->leftjoin('products_description', 'products_description.products_id', '=', 'inventory.products_id')
            ->select('inventory.products_id', 'products_description.products_name', 'manage_min_max.max_level', DB::raw("( SUM(IF(stock_type = 'in', stock, 0)) -
                    SUM(IF(stock_type = 'out', stock, 0)) ) as 'stocks'", DB::raw("having ( SUM(IF(stock_type = 'in', stock, 0)) -
                    SUM(IF(stock_type = 'out', stock, 0)) )")))
            ->where('manage_min_max.max_level', '>', '0')
            ->where('language_id', 1)
            ->groupby('inventory.products_id');
            // dd($report);
            // ->having(DB::raw("(SUM(IF(stock_type = 'in', stock, 0)) - SUM(IF(stock_type = 'out', stock, 0))) >= 123"))
        if ($request->page and $request->page == 'invioce') {
            $orders = $report->get();
        } else {
            $orders = $report->paginate(50);
        }

        return $orders;

    }

    

    public function outofstock($request)
    {
        $outStockProArray = array();
        $report = DB::table('inventory')
            ->leftjoin('products_description', 'products_description.products_id' ,'=' ,'inventory.products_id')
            ->leftjoin('products', 'products.products_id' ,'=' ,'inventory.products_id')
            ->select('products.products_type','products_description.products_id', 'products_description.products_name')
            ->where('products_description.language_id', 1)
            ->where('products.products_type','!=', 1)
            ->groupby('inventory.products_id')
            ->havingRaw("SUM(IF(stock_type = 'in', stock, 0)) - SUM(IF(stock_type = 'out', stock, 0)) = 0")->get();

        if (!empty($report)) {
            foreach ($report as $key => $value) {
                $reportArr = array( 
                    "products_id" => $value->products_id,
                    "products_type" => $value->products_type,
                    "products_name" => $value->products_name,
                    "productAttribute" => '',
                    "productAttributeDetails" => array(),
                    "inInventory" => "Yes"
                );
                array_push($outStockProArray, (object)$reportArr);
            }
        }
        
        $variableProduct = DB::select(DB::raw("SELECT inventory_detail.*,products_description.products_name , SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END) AS instocksum,SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END) AS outstocksum,
        (SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END)-SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END)) as finalstock FROM `inventory` 
            LEFT JOIN products on products.products_id = inventory.products_id 
            LEFT JOIN inventory_detail on inventory.inventory_ref_id = inventory_detail.inventory_ref_id 
            LEFT JOIN products_description ON products_description.products_id = inventory_detail.products_id
            WHERE products.products_type = 1
            GROUP by attribute_id DESC HAVING finalstock=0"));

        if (!empty($variableProduct)) {
            foreach($variableProduct as $vproduct){
                if($vproduct->finalstock <= 0){
                    $attArr = explode(",",$vproduct->attribute_id);
                    
                    $productAttributeDetailsArray = array();
                    foreach ($attArr as $attribute) {
                        $productsAttributes = DB::table('products_attributes')
                            ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                            ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                            ->select('products_attributes.products_attributes_id', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                            ->where('products_attributes_id', $attribute)->get();

                        array_push($productAttributeDetailsArray, $productsAttributes[0]);
                    }

                    $varProArr = array( 
                        "products_id" => $vproduct->products_id,
                        "products_type" => 1,
                        "products_name" => $vproduct->products_name,
                        "productAttribute" => $vproduct->attribute_id,
                        "productAttributeDetails" => $productAttributeDetailsArray,
                        "inInventory" => "Yes"
                    );
                    array_push($outStockProArray, (object)$varProArr);
                }
            }
        }        

        $notInsertedinInentory = DB::select(DB::raw('SELECT products.products_id,products.products_type,products_description.products_name FROM `products` LEFT JOIN products_description ON products_description.products_id = products.products_id WHERE products_description.language_id = 1 AND products.products_id NOT IN (SELECT products_id FROM inventory GROUP BY products_id)'));
        
        if (!empty($notInsertedinInentory)) {
            foreach ($notInsertedinInentory as $key1 => $value1) {
                $reportArr1 = array( 
                    "products_id" => $value1->products_id,
                    "products_type" => $value1->products_type,
                    "products_name" => $value1->products_name,
                    "productAttribute" => '',
                    "productAttributeDetails" => array(),
                    "inInventory" => "No"
                );
                array_push($outStockProArray, (object)$reportArr1);
            }
        }

        if ($request->page and $request->page == 'invioce') {
            $orders = $outStockProArray;
        } else {
            $orders = $this->paginate($outStockProArray,30,'',['path' => url('admin/outofstock')]);
        }

        return $orders;

    }

    public function stockin($request)
    {
        $inStockProArray = array();
        $report = DB::table('inventory')
            ->leftjoin('products_description', 'products_description.products_id' ,'=' ,'inventory.products_id')
            ->leftjoin('products', 'products.products_id' ,'=' ,'inventory.products_id')
            ->select('products.products_type','products_description.products_id', 'products_description.products_name')
            ->where('products_description.language_id', 1)
            ->where('products.products_type','!=', 1)
            ->groupby('inventory.products_id')
            ->havingRaw("SUM(IF(stock_type = 'in', stock, 0)) - SUM(IF(stock_type = 'out', stock, 0)) != 0")
            ->get();
        
        if (!empty($report)) {
            foreach ($report as $key => $value) {
                $reportArr = array( 
                    "products_id" => $value->products_id,
                    "products_type" => $value->products_type,
                    "products_name" => $value->products_name,
                    "productAttribute" => '',
                    "productAttributeDetails" => array(),
                    "inInventory" => "Yes"
                );

                array_push($inStockProArray, (object)$reportArr);
            }
        }
        
        $variableProduct = DB::select(DB::raw("SELECT inventory_detail.*,products_description.products_name , SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END) AS instocksum,SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END) AS outstocksum,
        (SUM(CASE WHEN stock_type = 'in' THEN stock ELSE 0 END)-SUM(CASE WHEN stock_type = 'out' THEN stock ELSE 0 END)) as finalstock FROM `inventory` 
            LEFT JOIN products on products.products_id = inventory.products_id 
            LEFT JOIN inventory_detail on inventory.inventory_ref_id = inventory_detail.inventory_ref_id 
            LEFT JOIN products_description ON products_description.products_id = inventory_detail.products_id
            WHERE products.products_type = 1
            GROUP by attribute_id DESC HAVING finalstock != 0"));
        // dd($variableProduct);
        if (!empty($variableProduct)) {
            foreach($variableProduct as $vproduct){
                if($vproduct->finalstock <= 0){
                    $attArr = explode(",",$vproduct->attribute_id);
                    
                    $productAttributeDetailsArray = array();
                    foreach ($attArr as $attribute) {
                        $productsAttributes = DB::table('products_attributes')
                            ->leftJoin('products_options', 'products_options.products_options_id', '=', 'products_attributes.options_id')
                            ->leftJoin('products_options_values', 'products_options_values.products_options_values_id', '=', 'products_attributes.options_values_id')
                            ->select('products_attributes.products_attributes_id', 'products_options.products_options_name as options_name', 'products_options_values.products_options_values_name as options_values')
                            ->where('products_attributes_id', $attribute)->get();

                        array_push($productAttributeDetailsArray, $productsAttributes[0]);
                    }

                    $varProArr = array( 
                        "products_id" => $vproduct->products_id,
                        "products_type" => 1,
                        "products_name" => $vproduct->products_name,
                        "productAttribute" => $vproduct->attribute_id,
                        "productAttributeDetails" => $productAttributeDetailsArray,
                        "inInventory" => "Yes"
                    );
                    array_push($inStockProArray, (object)$varProArr);
                }
            }
        }        

        $notInsertedinInentory = DB::select(DB::raw('SELECT products.products_id,products.products_type,products_description.products_name FROM `products` LEFT JOIN products_description ON products_description.products_id = products.products_id WHERE products_description.language_id = 1 AND products.products_id NOT IN (SELECT products_id FROM inventory GROUP BY products_id)'));
        
        if (!empty($notInsertedinInentory)) {
            foreach ($notInsertedinInentory as $key1 => $value1) {
                $reportArr1 = array( 
                    "products_id" => $value1->products_id,
                    "products_type" => $value1->products_type,
                    "products_name" => $value1->products_name,
                    "productAttribute" => '',
                    "productAttributeDetails" => array(),
                    "inInventory" => "No"
                );
                array_push($inStockProArray, (object)$reportArr1);
            }
        }

        if ($request->page and $request->page == 'invioce') {
            $orders = $inStockProArray;
        } else {
            $orders = $this->paginate($inStockProArray,30,'',['path' => url('admin/stockin')]);
        }

        return $orders;

    }

    public function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

   
}
