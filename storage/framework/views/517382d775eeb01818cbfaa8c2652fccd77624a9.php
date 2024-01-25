<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="setInvoiceName(); window.print();window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      <div class="col-xs-12">
      
      </div>

      
      <div class="row">
        <div class="col-xs-12">
          <div style="width: 100%;text-align: center;">
            <?php if(!empty($logoDetails)){ ?>
              <img src="<?php echo e(asset($logoDetails[0]->iconpath)); ?>" alt="logo" style="width: 100%;" >
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
            <i class="fa fa-globe"></i> <?php echo e(trans('labels.OrderID')); ?># <?php echo e($data['orders_data'][0]->orders_id); ?>

            <small class="pull-right"><?php echo e(trans('labels.OrderedDate')); ?>: <?php echo e(date('m/d/Y', strtotime($data['orders_data'][0]->date_purchased))); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <?php echo e(trans('labels.CustomerInfo')); ?>:
          <address>
            <strong><?php echo e($data['orders_data'][0]->customers_name); ?></strong><br>
            <?php echo e($data['orders_data'][0]->customers_suburb); ?> <br>
            <?php echo e($data['orders_data'][0]->customers_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->customers_city); ?>, <?php echo e($data['orders_data'][0]->customers_state); ?> <?php echo e($data['orders_data'][0]->customers_postcode); ?>, <?php echo e($data['orders_data'][0]->customers_country); ?><br>
            <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data['orders_data'][0]->customers_telephone); ?><br>
            <?php echo e(trans('labels.Email')); ?>: <?php echo e($data['orders_data'][0]->email); ?>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <?php echo e(trans('labels.ShippingInfo')); ?>

          <address>
            <strong><?php echo e($data['orders_data'][0]->delivery_name); ?></strong><br>
            <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data['orders_data'][0]->delivery_phone); ?><br>
            <?php echo e($data['orders_data'][0]->delivery_suburb); ?> <br>
            <?php echo e($data['orders_data'][0]->delivery_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->delivery_city); ?>, <?php echo e($data['orders_data'][0]->delivery_state); ?> <?php echo e($data['orders_data'][0]->delivery_postcode); ?>, <?php echo e($data['orders_data'][0]->delivery_country); ?><br>
           <strong> <?php echo e(trans('labels.ShippingMethod')); ?>:</strong> <?php echo e($data['orders_data'][0]->shipping_method); ?> <br>
           <strong> <?php echo e(trans('labels.ShippingCost')); ?>:</strong> <?php if(!empty($data['orders_data'][0]->shipping_cost)): ?> 
           
           <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['orders_data'][0]->shipping_cost); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
            <?php else: ?> --- <?php endif; ?> <br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <?php echo e(trans('labels.BillingInfo')); ?> 
          <address>
            <strong><?php echo e($data['orders_data'][0]->billing_name); ?></strong><br>
            <?php echo e(trans('labels.Phone')); ?>: <?php echo e($data['orders_data'][0]->billing_phone); ?><br>
            <?php echo e($data['orders_data'][0]->billing_suburb); ?> <br>
            <?php echo e($data['orders_data'][0]->billing_street_address); ?> <br>
            <?php echo e($data['orders_data'][0]->billing_city); ?>, <?php echo e($data['orders_data'][0]->billing_state); ?> <?php echo e($data['orders_data'][0]->billing_postcode); ?>, <?php echo e($data['orders_data'][0]->billing_country); ?><br>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th><?php echo e(trans('labels.Qty')); ?></th>
              <th><?php echo e(trans('labels.ProductName')); ?></th>
              <th><?php echo e(trans('labels.ProductModal')); ?></th>
              <th>Cancel/Return Status </th>
              <th><?php echo e(trans('labels.Options')); ?></th>
              <th>MRP</th>
              <th>Discount</th>
              <th><?php echo e(trans('labels.Price')); ?></th>
            </tr>
            </thead>
            <tbody>
            
            <?php $fnlTtlPrc = 0; ?>
            <?php $__currentLoopData = $data['orders_data'][0]->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php 
                $ttlPr = $products->products_price*$products->products_quantity;
                $fnlTtlPrc = $fnlTtlPrc+$ttlPr; 
            ?>
            	
            <tr>
                <td><?php echo e($products->products_quantity); ?></td>
                <td  width="30%">
                    <?php echo e($products->products_name); ?><br>
                </td>
                <td>
                    <?php echo e($products->products_model); ?>

                </td>

                <td>
                  <?php if($products->cancel_return_status==1): ?>
                    <span class="label label-danger">Cancel</span>
                  <?php endif; ?>

                  <?php if($products->cancel_return_status==2): ?>
                    <span class="label label-danger">Return</span>
                  <?php endif; ?>
                  <?php
                    if ($products->status_reason) {
                      echo "( ".$products->status_reason." )";
                    }
                  ?>
                </td>

                <td>
                <?php $__currentLoopData = $products->attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                	<b><?php echo e(trans('labels.Name')); ?>:</b> <?php echo e($attributes->products_options); ?><br>
                    <b><?php echo e(trans('labels.Value')); ?>:</b> <?php echo e($attributes->products_options_values); ?><br>
                    

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>

                <td><?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($ttlPr); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>

                <td><?php
                    if ($products->bulk_discount!='') {
                        echo $products->bulk_discount.'% off';
                    }else{
                        echo "0% off";
                    }
                  ?></td>
                
                <td><?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($products->final_price); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>

             </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->

        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6">
            <div class="col-lg-6 col-md-6">
                <span style="text-align: right;">Total</span>
            </div>
            <div class="col-lg-2 col-md-2">
                ₹<?php echo e($fnlTtlPrc); ?>

            </div>
            <div class="col-lg-4 col-md-4">
                You save ₹<?php echo e($fnlTtlPrc - ($data['orders_data'][0]->order_price + $data['orders_data'][0]->coupon_amount - $data['orders_data'][0]->shipping_cost - $data['orders_data'][0]->total_tax - $data['orders_data'][0]->cancelReturnPrice)); ?>

            </div>
          </div>
        </div>
        <br>
        
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-7">
          <p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.PaymentMethods')); ?>:</p>
          <p class="text-muted well well-sm no-shadow" style="text-transform:capitalize">
           	<?php echo e(str_replace('_',' ', $data['orders_data'][0]->payment_method)); ?>

          </p>
          <?php if(!empty($data['orders_data'][0]->coupon_code)): ?>
              <p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.Coupons')); ?>:</p>
                <table class="text-muted well well-sm no-shadow stripe-border table table-striped" style="text-align: center; ">
                	<tr>
                        <th style="text-align: center; "><?php echo e(trans('labels.Code')); ?></th>
                        <th style="text-align: center; "><?php echo e(trans('labels.Amount')); ?></th>
                    </tr>
                	<?php $__currentLoopData = json_decode($data['orders_data'][0]->coupon_code); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $couponData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<tr>
                        	<td><?php echo e($couponData->code); ?></td>
                            <td><?php echo e($couponData->amount); ?> 
                            	
                                <?php if($couponData->discount_type=='percent_product'): ?>
                                    (<?php echo e(trans('labels.Percent')); ?>)
                                <?php elseif($couponData->discount_type=='percent'): ?>
                                    (<?php echo e(trans('labels.Percent')); ?>)
                                <?php elseif($couponData->discount_type=='fixed_cart'): ?>
                                    (<?php echo e(trans('labels.Fixed')); ?>)
                                <?php elseif($couponData->discount_type=='fixed_product'): ?>
                                    (<?php echo e(trans('labels.Fixed')); ?>)
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>                
          <?php endif; ?>
          
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <!--<p class="lead"></p>-->

          <div class="table-responsive ">
            <table class="table order-table">
              <tr>
                <th style="width:50%"><?php echo e(trans('labels.Subtotal')); ?>:</th>
                <td>
                  <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['subtotal'] - $data['orders_data'][0]->cancelReturnPrice); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?>
                  </td>
              </tr>
              <tr>
                <th><?php echo e(trans('labels.Tax')); ?>:</th>
                <td>
                  <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['orders_data'][0]->total_tax); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?>
                  </td>
              </tr>
              <tr>
                <th><?php echo e(trans('labels.ShippingCost')); ?>:</th>
                <td>
                  <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['orders_data'][0]->shipping_cost); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?><?php endif; ?>
                  </td>
              </tr>
              <?php if(!empty($data['orders_data'][0]->coupon_code)): ?>
              <tr>
                <th><?php echo e(trans('labels.DicountCoupon')); ?>:</th>
                <td>                  
                  <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['orders_data'][0]->coupon_amount); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
              </tr>
              <?php endif; ?>
              <tr>
                <th><?php echo e(trans('labels.Total')); ?>:</th>
                <td>
                  <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($data['orders_data'][0]->order_price - $data['orders_data'][0]->cancelReturnPrice); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
                  </td>
              </tr>
            </table>
          </div>
              
        </div>     
        <div class="col-xs-12">
        	<p class="lead" style="margin-bottom:10px"><?php echo e(trans('labels.Orderinformation')); ?>:</p>
        	<p class="text-muted well well-sm no-shadow" style="text-transform:capitalize; word-break:break-all;">
            <?php if(trim($data['orders_data'][0]->order_information) != '[]' and !empty($data['orders_data'][0]->order_information)): ?>
           		<?php echo e($data['orders_data'][0]->order_information); ?>

            <?php else: ?>
           		---
            <?php endif; ?>
            </p>
        </div>  
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

     
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

<script>
function setInvoiceName() {
    var orderID = "<?php echo e($data['orders_data'][0]->orders_id); ?>"; // Get order ID from Blade template
    var invoiceName = orderID + ".pdf"; // Set the invoice name with order ID
    document.title = invoiceName; // Set the document title (will be used as the file name when saving as PDF)
}
</script>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/Orders/invoiceprint.blade.php ENDPATH**/ ?>