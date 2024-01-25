<?php $__env->startSection('content'); ?>

<section class="section-padding">

<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bill-detail card">
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Items</h4>
                        </div>
                        <div class="bill-descp">
                            <div class="itm-ttl">4 items</div>
                            <span class="item-prdct">Product Title 1</span>
                            <span class="item-prdct">Product Title 2</span>
                            <span class="item-prdct">Product Title 3</span>
                            <span class="item-prdct">Product Title 4</span>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Delivery Address</h4>
                        </div>
                        <div class="bill-descp">
                            <div class="itm-ttl">Home</div>
                            <p class="bill-address">#76/23, St No. 8, Shanmuga Nagar, MBD Mall, Chennai, 600033</p>
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
                                    <span>₹150</span>
                                </div>
                                <div class="cart-total-dil pt-3">
                                    <h4>Delivery Charges</h4>
                                    <span>₹10</span>
                                </div>
                            </div>
                            <div class="main-total-cart pl-0 pr-0 pb-0 border-bottom-0">
                                <h2>Total</h2>
                                <span>₹160</span>
                            </div>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Delivery Details</h4>
                        </div>
                        <div class="bill-descp">
                            <p class="bill-dt-sl"><b>Super Store</b> - <span class="dly-loc">Chennai</span> - <span class="dlr-ttl25">₹160</span></p>
                            <p class="bill-dt-sl">Order ID - <span class="descp-bll-dt">ORDER1245638</span></p>
                            <p class="bill-dt-sl">Items - <span class="descp-bll-dt">4</span></p>
                            <p class="bill-dt-sl">Timing - <span class="descp-bll-dt">26 May 2020 , Tuesday, 3.00PM - 5.00PM</span></p>
                        </div>
                    </div>
                    <div class="bill-dt-step">
                        <div class="bill-title">
                            <h4>Payment Option</h4>
                        </div>
                        <div class="bill-descp">
                            <p class="bill-dt-sl"><span class="dlr-ttl25 mr-1"><i class="uil uil-check-circle"></i></span>Cash on Delivery</p>
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

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/order_invoice.blade.php ENDPATH**/ ?>