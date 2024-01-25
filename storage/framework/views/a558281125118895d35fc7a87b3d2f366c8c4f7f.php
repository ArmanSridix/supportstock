<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo e(trans('labels.navigation')); ?></li>
        <li class="treeview <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo e(trans('labels.header_dashboard')); ?></span>
          </a>
        </li>
      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->view_media == 1){
      ?>
      <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?>">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.media')); ?></span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php echo e(Request::is('admin/media/add') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/add')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.media')); ?> </span>
              </a>
          </li>

          <li class="treeview <?php echo e(Request::is('admin/media/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addimages') ? 'active' : ''); ?> <?php echo e(Request::is('admin/uploadimage/*') ? 'active' : ''); ?> ">
              <a href="<?php echo e(url('admin/media/display')); ?>">

                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Media Setings')); ?> </span>
              </a>
          </li>
        </ul>
      </li>

      <?php } ?>


      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->assured_logo_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/editAssuredLogo') ? 'active' : ''); ?>">
          <a  href="<?php echo e(URL::to('admin/editAssuredLogo')); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Assured Logo</span>
          </a>
        </li>

        <li class="treeview <?php echo e(Request::is('admin/invoiceLogo') ? 'active' : ''); ?>">
          <a  href="<?php echo e(URL::to('admin/invoiceLogo')); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Invoice Logo</span>
          </a>
        </li>
      <?php } ?>


      <?php
        // if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->language_view == 1){
      ?>

        

      <?php //} ?>
      <?php
        // if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

      
      <?php //} ?> 

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->website_setting_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/instafeed') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newsletter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/mailchimp') ? 'active' : ''); ?> <?php echo e(Request::is('admin/topoffer/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webPagesSettings/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/homebanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webpages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addwebpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editwebpage/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/websettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webthemes') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customstyle') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addconstantbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editconstantbanner/*') ? 'active' : ''); ?><?php echo e(Request::is('admin/frontCategory') ? 'active' : ''); ?><?php echo e(Request::is('admin/frontProductCategory') ? 'active' : ''); ?>" >
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> <?php echo e(trans('labels.link_site_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           
            <li class="<?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/sliders')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Sliders')); ?></a></li>
            
            <li class="<?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/constantbanners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Banners')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/frontCategory') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/frontCategory')); ?>"><i class="fa fa-circle-o"></i> Category </a></li>

            <li class="<?php echo e(Request::is('admin/frontProductCategory') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/frontProductCategory')); ?>"><i class="fa fa-circle-o"></i> Product Category</a></li>
           
          </ul>
        </li>
      <?php } ?>


      <!---- city ---->
      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->city_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/city/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/city/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/city/edit/*') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/city/display')); ?>">
            <i class="fa fa-map-pin" aria-hidden="true"></i> <span> <?php echo e(trans('labels.cityMaster')); ?> </span>
          </a>
        </li>

      <?php } ?>
      <!---- city ---->

      <!---- pincode ---->
      <?php
        if( $result['commonContent']['roles'] != null and $result['commonContent']['roles']->pincode_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/pincode/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/pincode/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/pincode/edit/*') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/pincode/display')); ?>">
            <i class="fa fa-map-pin" aria-hidden="true"></i> <span> <?php echo e(trans('labels.pincodeMaster')); ?> </span>
          </a>
        </li>

      <?php } ?>
      <!---- pincode ---->


      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->customers_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/customers/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/customers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/address/display/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers/filter') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/customers/display')); ?>">
            <i class="fa fa-users" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_customers')); ?></span>
          </a>
        </li>
      <?php } ?>

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->corp_request_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/corporateRequest/display') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/corporateRequest/display')); ?>">
            <i class="fa fa-users" aria-hidden="true"></i> <span><?php echo e(trans('labels.corporateRequest')); ?></span>
          </a>
        </li>
      <?php } ?>
   
      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1 or $result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1 ){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editattributes/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/editAdds/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo e(trans('labels.Catalog')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manufacturer_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/manufacturers/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manufacturers/edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/manufacturers/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manufacturer')); ?></a></li>
            <?php endif; ?>
            <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->categories_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/categories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/filter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/categories/editAdds/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/categories/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_main_categories')); ?></a></li>
            <?php endif; ?>

            <?php if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->products_view == 1): ?>
              <li class="<?php echo e(Request::is('admin/products/attributes/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/products/attributes/*') ? 'active' : ''); ?>" ><a href="<?php echo e(URL::to('admin/products/attributes/display' )); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.products_attributes')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/units') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addunit') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editunit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/units')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_units')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/products/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/products/attributes/add/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addinventory/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addproductimages/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_all_products')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/products/inventory/display') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/products/inventory/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.inventory')); ?></a></li>
            <?php endif; ?>
            <?php
              $status_check = DB::table('reviews')->where('reviews_read',0)->first();
              if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reviews_view == 1){
            ?>
              <li class="<?php echo e(Request::is('admin/reviews/display') ? 'active' : ''); ?>">
                <a href="<?php echo e(URL::to('admin/reviews/display')); ?>">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span><?php echo e(trans('labels.reviews')); ?></span><?php if($result['commonContent']['new_reviews']>0): ?><span class="label label-success pull-right"><?php echo e($result['commonContent']['new_reviews']); ?> <?php echo e(trans('labels.new')); ?></span><?php endif; ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->orders_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/reasonOfCancelOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/addReasonOfCancelOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/editReasonOfCancelOrder/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/reasonOfReturnOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/addReasonOfReturnOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/editReasonOfReturnOrder/*') ? 'active' : ''); ?> ">
          <a href="#" ><i class="fa fa-list-ul" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li class="<?php echo e(Request::is('admin/orderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addorderstatus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editorderstatus/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/orderstatus')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_order_status')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/orders/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/vieworder/*') ? 'active' : ''); ?>">
              <a href="<?php echo e(URL::to('admin/orders/display')); ?>" >
                <i class="fa fa-circle-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_orders')); ?></span>
              </a>
            </li>
            <li class="<?php echo e(Request::is('admin/orders/reasonOfCancelOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/addReasonOfCancelOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/editReasonOfCancelOrder/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/orders/reasonOfCancelOrder')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.reasonOfCancel')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/orders/reasonOfReturnOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/addReasonOfReturnOrder') ? 'active' : ''); ?> <?php echo e(Request::is('admin/orders/editReasonOfReturnOrder/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/orders/reasonOfReturnOrder')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.reasonOfReturn')); ?></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->reports_view == 1){
          ?>
        <li class="treeview <?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/inventoryreport') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers-orders-report') ? 'active' : ''); ?> <?php echo e(Request::is('admin/couponreport') ? 'active' : ''); ?> <?php echo e(Request::is('admin/salesreport') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
  <span><?php echo e(trans('labels.link_reports')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="<?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/lowinstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_low_stock')); ?></a></li> -->
            <li class="<?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/outofstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_out_of_stock_products')); ?></a></li>
           <li class="<?php echo e(Request::is('admin/stockin') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/stockin')); ?>"><i class="fa fa-circle-o"></i> Stock in Products</a></li>
           <!-- <li class="treeview <?php echo e(Request::is('admin/maxstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/minstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/inventoryreport') ? 'active' : ''); ?> <?php echo e(Request::is('admin/salesreport') ? 'active' : ''); ?> <?php echo e(Request::is('admin/couponreport') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customers-orders-report') ? 'active' : ''); ?> <?php echo e(Request::is('admin/outofstock') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductspurchased') ? 'active' : ''); ?> <?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?> <?php echo e(Request::is('admin/lowinstock') ? 'active' : ''); ?>"> -->
           <li class="<?php echo e(Request::is('admin/inventoryreport') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/inventoryreport')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Inventory Report')); ?></a></li>
            <!-- <li class="<?php echo e(Request::is('admin/minstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/minstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Min Stock Report')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/maxstock') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/maxstock')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Max Stock Report')); ?></a></li> -->
            <li class="<?php echo e(Request::is('admin/customers-orders-report') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/customers-orders-report')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_customer_orders_total')); ?></a></li>
            
            <!-- <li class="<?php echo e(Request::is('admin/statsproductsliked') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/statsproductsliked')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_products_liked')); ?></a></li> -->

            <li class="<?php echo e(Request::is('admin/couponreport') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/couponreport')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Coupon Report')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/salesreport') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/salesreport')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Sales Report')); ?></a></li>

          </ul>
        </li>
      <?php } ?>
     
  
      
      <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->tax_location_view == 1){
        ?>
          <li class="treeview <?php echo e(Request::is('admin/countries/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/countries/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/zones/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?>">
            <a href="#">
              <i class="fa fa-money" aria-hidden="true"></i>
              <span>Tax</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              
              <li class="<?php echo e(Request::is('admin/tax/taxclass/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxclass/edit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/tax/taxclass/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_class')); ?></a></li>
              <li class="<?php echo e(Request::is('admin/tax/taxrates/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/tax/taxrates/edit/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/tax/taxrates/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_tax_rates')); ?></a></li>
              </ul>
          </li>
        <?php } ?>
        <?php
          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->coupons_view ==1){
        ?>
        <li class="treeview <?php echo e(Request::is('admin/coupons/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/coupons/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editcoupons/*') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/coupons/display')); ?>" ><i class="fa fa-tablet" aria-hidden="true"></i> <span><?php echo e(trans('labels.link_coupons')); ?></span></a>
        </li>

        <li class="treeview <?php echo e(Request::is('admin/coupons/newUserCoupon') ? 'active' : ''); ?> ">
          <a href="<?php echo e(URL::to('admin/coupons/newUserCoupon')); ?>" ><i class="fa fa-tablet" aria-hidden="true"></i> <span>New User Coupon</span></a>
        </li>
      <?php } ?>
      <?php

        if($result['commonContent']['roles'] != null and $result['commonContent']['roles']->shipping_methods_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/shippingmethods/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/upsShipping/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shippingmethods/flateRate/display') ? 'active' : ''); ?>">
          <a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>"><i class="fa fa-truck" aria-hidden="true"></i> <span> <?php echo e(trans('labels.link_shipping_methods')); ?></span>
          </a>
        </li>
          <?php } ?>
          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->payment_methods_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/paymentmethods/index') ? 'active' : ''); ?> <?php echo e(Request::is('admin/paymentmethods/display/*') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/paymentmethods/index')); ?>"><i class="fa fa-credit-card" aria-hidden="true"></i> <span>
              <?php echo e(trans('labels.link_payment_methods')); ?></span>
              </a>
            </li>
          <?php } ?>
          <?php

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->news_view == 1){
      ?>
        <li class="treeview <?php echo e(Request::is('admin/newscategories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/edit/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/news/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/edit/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-database" aria-hidden="true"></i>
<span>      <?php echo e(trans('labels.Blog')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          	<li class="<?php echo e(Request::is('admin/newscategories/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/add') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newscategories/edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/newscategories/display')); ?>"><i class="fa fa-circle-o"></i><?php echo e(trans('labels.link_news_categories')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/news/display') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/add') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/news/edit/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/news/display')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_sub_news')); ?></a></li>
          </ul>
        </li>
      <?php } ?> 
      
        <?php
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->general_setting_view == 1){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/setting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/alertsetting') ? 'active' : ''); ?>  ">
        <li class="treeview <?php echo e(Request::is('admin/loginsetting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/firebase') ? 'active' : ''); ?> <?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/setting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/alertsetting') ? 'active' : ''); ?> <?php echo e(Request::is('admin/shareThis') ? 'active' : ''); ?> <?php echo e(Request::is('admin/socialLink') ? 'active' : ''); ?> ">  
        <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.link_general_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            
          
            <li class="<?php echo e(Request::is('admin/facebooksettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/facebooksettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_facebook')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/googlesettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/googlesettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_google')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/shareThis') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/shareThis')); ?>"><i class="fa fa-circle-o"></i> Share This</a></li>

            <li class="<?php echo e(Request::is('admin/socialLink') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/socialLink')); ?>"><i class="fa fa-circle-o"></i> Social Links</a></li>
            
            
            <!-- <li class="<?php echo e(Request::is('admin/loginsetting') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/loginsetting')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Login Setting')); ?></a></li> -->
            
          </ul>
        </li>
      <?php } ?>
      <?php

      $route =  DB::table('settings')
                 ->where('name','is_web_purchased')
                 ->where('value', 1)
                 ->first();
        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->website_setting_view == 1 and $route != null){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/instafeed') ? 'active' : ''); ?> <?php echo e(Request::is('admin/newsletter') ? 'active' : ''); ?> <?php echo e(Request::is('admin/menus') ? 'active' : ''); ?> <?php echo e(Request::is('admin/mailchimp') ? 'active' : ''); ?> <?php echo e(Request::is('admin/topoffer/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webPagesSettings/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/homebanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webpages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addwebpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editwebpage/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/websettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webthemes') ? 'active' : ''); ?> <?php echo e(Request::is('admin/customstyle') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addconstantbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editconstantbanner/*') ? 'active' : ''); ?>" >
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
            <span> <?php echo e(trans('labels.link_site_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview <?php echo e(Request::is('admin/topoffer/display') ? 'active' : ''); ?> <?php echo e(Request::is('admin/webPagesSettings/*') ? 'active' : ''); ?>">
              <a href="#">
                <i class="fa fa-picture-o"></i> <span><?php echo e(trans('labels.Theme Setting')); ?></span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview <?php echo e(Request::is('admin/topoffer/display') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/topoffer/display')); ?>">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Top Offer')); ?> </span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/1') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/1">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Home Page')); ?> </span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/8') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/8">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.login')); ?> </span>
                    </a>
                </li>
                
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/9') ? 'active' : ''); ?> ">
                  <a href="<?php echo e(url('admin/webPagesSettings')); ?>/9">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.News')); ?> </span>
                    </a>
                </li>

                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/5') ? 'active' : ''); ?> ">
                  <a href="<?php echo e(url('admin/webPagesSettings')); ?>/5">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Shop Page Settings')); ?> </span>
                  </a>
               </li>

                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/2') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/2">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Cart Page Settings')); ?> </span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/6') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/6">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Contact Page Settings')); ?></span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/7') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/7">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Colors Settings')); ?></span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/10') ? 'active' : ''); ?> ">
                  <a href="<?php echo e(url('admin/webPagesSettings')); ?>/10">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Banner Transition Settings')); ?> </span>
                  </a>
              </li>

              <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/11') ? 'active' : ''); ?> ">
                  <a href="<?php echo e(url('admin/webPagesSettings')); ?>/11">
                      <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Product Card Style')); ?> </span>
                  </a>
               </li>
               
                <li class="treeview <?php echo e(Request::is('admin/webPagesSettings/4') ? 'active' : ''); ?> ">
                    <a href="<?php echo e(url('admin/webPagesSettings')); ?>/4">
                        <i class="fa fa-picture-o" aria-hidden="true"></i> <span> <?php echo e(trans('labels.Product Page Settings')); ?> </span>
                    </a>
                </li>
              </ul>
            </li>
           
            <li class="<?php echo e(Request::is('admin/sliders') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addsliderimage') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editslide/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/sliders')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Sliders')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/homebanners') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/homebanners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.Parallax Banners')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/constantbanners/*') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/constantbanners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Banners')); ?></a></li>
           
            <li class="<?php echo e(Request::is('admin/menus') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addmenus') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editmenus/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/menus')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.menus')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/webpages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addwebpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editwebpage/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/webpages')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.content_pages')); ?></a></li>

            <!-- <li class="<?php echo e(Request::is('admin/webthemes') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/webthemes')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.website_themes')); ?></a></li> -->

            <li class="<?php echo e(Request::is('admin/seo') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/seo')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.seo content')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/customstyle') ? 'active' : ''); ?> "><a href="<?php echo e(URL::to('admin/customstyle')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.custom_style_js')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/newsletter') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/newsletter')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.mailchimp')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/instafeed') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/instafeed')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.instagramfeed')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/websettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/websettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_setting')); ?></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php
      $route =  DB::table('settings')
                 ->where('name','is_app_purchased')
                 ->where('value', 1)
                 ->first();

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->application_setting_view == 1 and $route != null){
      ?>

        <li class="treeview <?php echo e(Request::is('admin/banners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editbanner/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/pages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editpage/*') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/appSettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/admobSettings') ? 'active' : ''); ?> <?php echo e(Request::is('admin/applabel') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addappkey') ? 'active' : ''); ?> <?php echo e(Request::is('admin/applicationapi') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-gears" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.link_app_settings')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/banners') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addbanner') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editbanner/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/banners')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_Banners')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/pages') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/addpage') ? 'active' : ''); ?>  <?php echo e(Request::is('admin/editpage/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/pages')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.content_pages')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/admobSettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/admobSettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_admob')); ?></a></li>

            <li class="android-hide <?php echo e(Request::is('admin/applabel') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addappkey') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/applabel')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.labels')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/applicationapi') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/applicationapi')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.applicationApi')); ?></a></li>

            <li class="<?php echo e(Request::is('admin/appsettings') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/appsettings')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_setting')); ?></a></li>

          </ul>
        </li>
      <?php } ?>
     
      <?php

        if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->manage_admins_view == 1){
      ?>

         <li class="treeview <?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>">
          <a href="#">
            <i class="fa fa-users" aria-hidden="true"></i>
  <span> <?php echo e(trans('labels.Manage Admins')); ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>

          <ul class="treeview-menu">
            <li class="<?php echo e(Request::is('admin/admins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadmins') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadmin/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/admins')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_admins')); ?></a></li>
            <li class="<?php echo e(Request::is('admin/manageroles') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addadminType') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editadminType/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/manageroles')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans('labels.link_manage_roles')); ?></a></li>
          </ul>
        </li>
        <?php 
        }
        ?>

        <!-- CMS Management -->
        <?php

          if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->cms_view == 1){
        ?>

           <li class="treeview <?php echo e(Request::is('admin/editContactUs') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editAboutUs') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editTermsAndConditions') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editPrivacyPolicy') ? 'active' : ''); ?> <?php echo e(Request::is('admin/displayFaq') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addFaq') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editFaq/*') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editSellerBenefits') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editCorporateLoginBenefits') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editPayment') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editShipping') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editCancelReturn') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editRefunds') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editReturnPolicy') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editSecurity') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editCustomerService') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editCopyright') ? 'active' : ''); ?>">
            <a href="#">
              <i class="fa fa-users" aria-hidden="true"></i>
              <span> CMS Management</span> <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
              <li class="<?php echo e(Request::is('admin/editContactUs') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editContactUs')); ?>"><i class="fa fa-circle-o"></i> Contact Us</a></li>

              <li class="<?php echo e(Request::is('admin/editAboutUs') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editAboutUs')); ?>"><i class="fa fa-circle-o"></i> About Us</a></li>

              <li class="<?php echo e(Request::is('admin/editSellerBenefits') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editSellerBenefits')); ?>"><i class="fa fa-circle-o"></i> Seller Benefit's</a></li>

              <li class="<?php echo e(Request::is('admin/editCorporateLoginBenefits') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editCorporateLoginBenefits')); ?>"><i class="fa fa-circle-o"></i> Corporate Login Benefit's</a></li>

              <li class="<?php echo e(Request::is('admin/editTermsAndConditions') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editTermsAndConditions')); ?>"><i class="fa fa-circle-o"></i> Terms & Conditions</a></li>

              <li class="<?php echo e(Request::is('admin/editPrivacyPolicy') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editPrivacyPolicy')); ?>"><i class="fa fa-circle-o"></i> Privacy Policy</a></li>

              <li class="<?php echo e(Request::is('admin/displayFaq') ? 'active' : ''); ?> <?php echo e(Request::is('admin/addFaq') ? 'active' : ''); ?> <?php echo e(Request::is('admin/editFaq/*') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/displayFaq')); ?>"><i class="fa fa-circle-o"></i> Faq</a></li>

              <li class="<?php echo e(Request::is('admin/editPayment') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editPayment')); ?>"><i class="fa fa-circle-o"></i> Payment</a></li>

              <li class="<?php echo e(Request::is('admin/editShipping') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editShipping')); ?>"><i class="fa fa-circle-o"></i> Shipping</a></li>

              <li class="<?php echo e(Request::is('admin/editCancelReturn') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editCancelReturn')); ?>"><i class="fa fa-circle-o"></i> Cancellation & Returns</a></li>

              <li class="<?php echo e(Request::is('admin/editRefunds') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editRefunds')); ?>"><i class="fa fa-circle-o"></i> Refunds</a></li>

              <li class="<?php echo e(Request::is('admin/editReturnPolicy') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editReturnPolicy')); ?>"><i class="fa fa-circle-o"></i> Return Policy</a></li>

              <li class="<?php echo e(Request::is('admin/editSecurity') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editSecurity')); ?>"><i class="fa fa-circle-o"></i> Security</a></li>

              <li class="<?php echo e(Request::is('admin/editCustomerService') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editCustomerService')); ?>"><i class="fa fa-circle-o"></i> Customer Service</a></li>

              <li class="<?php echo e(Request::is('admin/editCopyright') ? 'active' : ''); ?>"><a href="<?php echo e(URL::to('admin/editCopyright')); ?>"><i class="fa fa-circle-o"></i> Copyright</a></li>
            </ul>
          </li>
          <?php 
          }
          ?>
          <!-- CMS Management -->

          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->cod_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/paymentmethods/cashOnDelivery') ? 'active' : ''); ?> <?php echo e(Request::is('admin/paymentmethods/display/*') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/paymentmethods/cashOnDelivery')); ?>"><i class="fa fa-money" aria-hidden="true"></i> <span>Cash On Delivery</span>
              </a>
            </li>
          <?php } ?>

          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->contact_comment_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/contactComment') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/contactComment')); ?>"><i class="fa fa-money" aria-hidden="true"></i> <span>Contact Us Comments</span>
              </a>
            </li>
          <?php } ?>


          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->product_enquery_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/productEnquiry') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/productEnquiry')); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Product Enquiry</span>
              </a>
            </li>
          <?php } ?>

          <?php
            if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->sell_on_ss_view == 1){
          ?>
            <li class="treeview <?php echo e(Request::is('admin/sellOnSupportStock') ? 'active' : ''); ?>">
              <a  href="<?php echo e(URL::to('admin/sellOnSupportStock')); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Sell on supportstock</span>
              </a>
            </li>
          <?php } ?>


        <?php
          //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1){
        ?>

          <!--------create middlewares -------->
        
        <?php //} ?>

        <?php
          //if($result['commonContent']['roles']!= null and $result['commonContent']['roles']->edit_management == 1){
        ?>

          <!--------create middlewares -------->
        
        <?php //} ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/common/sidebar.blade.php ENDPATH**/ ?>