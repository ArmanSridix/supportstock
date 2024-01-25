<?php $__env->startSection('content'); ?>

<section class="section-padding">

<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bill-detail card">
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h3>Order Id # <?php echo e($result['orders'][0]->orders_id); ?> <span style="float: right;">Date : <?php echo e(date('d/m/Y', strtotime($result['orders'][0]->date_purchased))); ?></span></h3>
                        </div>
                        <div class="bill-title">
                            <h4>Items</h4>
                        </div>
                        <?php $orderProdCnt = count($result['orders'][0]->products); ?>
                        <div class="bill-descp">
                            <div class="itm-ttl"><?php echo e($orderProdCnt); ?> items</div>
                            <div class="total-checkout-group p-0 border-top-0">
                                <?php $fnlTtlPrc = 0; ?>
                                <?php $__currentLoopData = $result['orders'][0]->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="">
                                    <?php 
                                        $ttlPr = $value2->products_price*$value2->products_quantity;
                                        $fnlTtlPrc = $fnlTtlPrc+$ttlPr; 
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <span>
                                                <?php echo e($key+1); ?>. 
                                                <?php echo e($value2->products_name); ?> x <?php echo e($value2->products_quantity); ?>


                                                <?php if($value2->products_sku){ ?>
                                                    <br>
                                                    SKU no - <?php echo e($value2->products_sku); ?>

                                                <?php } ?>

                                                <br>

                                                <?php if(count($value2->attributes) >0): ?>
                                                <small>
                                                    <ul>
                                                        <?php $__currentLoopData = $value2->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span><?php echo e($attributes->products_options); ?> : <span><?php echo e($attributes->products_options_values); ?> ,</span></span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </small>
                                                <?php endif; ?>

                                                <?php if($value2->cancel_return_status==1){ ?>
                                                    (Canceled) ( <?php echo e($value2->status_reason); ?> )
                                                <?php }else if($value2->cancel_return_status==2){ ?>
                                                    (Returned) ( <?php echo e($value2->status_reason); ?> )
                                                <?php } ?>
                                            </span>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-2">
                                            <?php echo e($ttlPr); ?>

                                        </div>
                                        <div class="col-lg-2 col-md-2 col-2">
                                            <?php
                                                if ($value2->bulk_discount!='') {
                                                    echo $value2->bulk_discount.'% off';
                                                }else{
                                                    echo "0% off";
                                                }
                                              ?>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-2">
                                            ₹<?php echo e($value2->final_price); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <span style="text-align: right;">Total</span>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-2">
                                        <?php echo e($fnlTtlPrc); ?>

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-4">
                                        You save ₹<?php echo e($fnlTtlPrc - ($result['orders'][0]->order_price + $result['orders'][0]->coupon_amount - $result['orders'][0]->shipping_cost - $result['orders'][0]->total_tax - $result['orders'][0]->cancelReturnPrice)); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Delivery Address</h4>
                        </div>
                        <div class="bill-descp">
                            <!-- <div class="itm-ttl">Home</div>
                            <p class="bill-address">#76/23, St No. 8, Shanmuga Nagar, MBD Mall, Chennai, 600033</p> -->
                            <p class="bill-address"><?php echo e($result['orders'][0]->delivery_name); ?></p>
                            <p class="bill-address"><?php echo e($result['orders'][0]->delivery_suburb); ?></p>
                            <p class="bill-address"><?php echo e($result['orders'][0]->delivery_street_address); ?></p>
                            <p class="bill-address"><?php echo e($result['orders'][0]->delivery_city); ?>, <?php echo e($result['orders'][0]->delivery_state); ?> <?php echo e($result['orders'][0]->delivery_postcode); ?>, <?php echo e($result['orders'][0]->delivery_country); ?></p>

                            <p class="bill-address">Phone: <?php echo e($result['orders'][0]->delivery_phone); ?></p>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Delivery Status</h4>
                        </div>
                        <div class="bill-descp">
                            <p class="bill-address"><?php echo e($result['orders'][0]->orders_status); ?></p>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Payment</h4>
                        </div>
                        <div class="bill-descp">
                            <div class="total-checkout-group p-0 border-top-0">
                                <div class="cart-total-dil">
                                    <h4>Subtotal</h4>
                                    <span>₹<?php echo e($result['orders'][0]->order_price + $result['orders'][0]->coupon_amount - $result['orders'][0]->shipping_cost - $result['orders'][0]->total_tax - $result['orders'][0]->cancelReturnPrice); ?></span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4>Total Tax</h4>
                                    <span>₹<?php echo e($result['orders'][0]->total_tax); ?></span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4>Dicount(Coupon)</h4>
                                    <span>₹<?php echo e($result['orders'][0]->coupon_amount); ?></span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4>Shipping Price</h4>
                                    <span>₹<?php echo e($result['orders'][0]->shipping_cost); ?></span>
                                </div>
                            </div>
                            <div class="main-total-cart pl-0 pr-0 pb-0 border-bottom-0">
                                <h2>Total</h2>
                                <span>₹<?php echo e($result['orders'][0]->order_price - $result['orders'][0]->cancelReturnPrice); ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Delivery Details</h4>
                        </div>
                        <div class="bill-descp">
                            <p class="bill-dt-sl"><b>Super Store</b> - <span class="dly-loc">Chennai</span> - <span class="dlr-ttl25">₹160</span></p>
                            <p class="bill-dt-sl">Order ID - <span class="descp-bll-dt">ORDER1245638</span></p>
                            <p class="bill-dt-sl">Items - <span class="descp-bll-dt">4</span></p>
                            <p class="bill-dt-sl">Timing - <span class="descp-bll-dt">26 May 2020 , Tuesday, 3.00PM - 5.00PM</span></p>
                        </div>
                    </div> -->
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Payment Option</h4>
                        </div>
                        <div class="bill-descp">
                            <p class="bill-dt-sl"><span class="dlr-ttl25 mr-1"><i class="uil uil-check-circle"></i></span><?php echo e($result['orders'][0]->payment_method); ?></p>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-bottom">
                            <div class="thnk-ordr">Thanks for Ordering</div>
                            <a class="print-btn hover-btn" href="javascript:window.print();">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/order_invoice.blade.php ENDPATH**/ ?>