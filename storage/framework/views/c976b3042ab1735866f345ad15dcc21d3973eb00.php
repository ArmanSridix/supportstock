<?php $__env->startSection('content'); ?>

<?php if(count($result['cartList'])>0): ?>

  <?php $finalProdDiscount = 0;
  $withoutDiscTotal = 0;
  $withDiscTotal = 0; ?>


  <?php $__currentLoopData = ($result['cartList']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <?php
      if ($cart_products->prodDiscount!='') {
          $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
          $disc = (($cart_products->final_price*$cart_products->prodDiscount)/100)*$cart_products->customers_basket_quantity;
          $totalPrice = $tPrice-$disc;
      }else{
          $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
          $disc = 0;
          $totalPrice = $tPrice-$disc;
      }
      $withoutDiscTotal = $withoutDiscTotal+$tPrice;
      $finalProdDiscount = $finalProdDiscount+$disc;
      $withDiscTotal = $withDiscTotal + $totalPrice;
      
  ?>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;">Cart</a> <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Checkout </a>
               </div>
            </div>
         </div>
      </section>

      <?php if(session()->has('outStockMessage')): ?>
            <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo e(session()->get('outStockMessage')); ?>

            </div>
          <?php endif; ?>

      <section class="shop-single section-padding pt-3">
   <div class="checkout block">
    <div class="container">
        <div class="row">
            <!-- <div class="col-12 mb-3">
                <div class="alert alert-lg alert-primary">Returning customer? <a href="#">Click here to login</a></div>
            </div> -->
            <div class="col-12 col-lg-6 col-xl-7">
                <div id="checkout_wizard" class="checkout accordion left-chck145 card mb-lg-0">
                <div class="checkout-step">
                  <div class="checkout-card" id="headingOne">
                    <span class="checkout-step-number">1</span>
                    <h4 class="checkout-step-title">
                    <button class="wizard-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Delivery Address</button>
                    </h4>
                  </div>
                  <div id="collapseOne" class="in collapse show" data-parent="#checkout_wizard" style="">
                    <div class="checkout-step-body">
                      <div class="row">
                        <div class="col-md-12">

                          <div class="form-group">

                            <?php
                              $user_default_address_id='';
                              $user_default_pincode='';
                              $counter = 1;
                            ?>
                            <?php if(count($result['userAddress'])>0): ?>
                            <?php $__currentLoopData = $result['userAddress']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$Address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $fullAdddress = '';
                              if ($Address->flat_no!='') {
                                $fullAdddress = $fullAdddress.$Address->flat_no.", ";
                              }
                              if ($Address->entry_street_address!='') {
                                $fullAdddress = $fullAdddress.$Address->entry_street_address.", ";
                              }
                              if ($Address->cities_name!='') {
                                $fullAdddress = $fullAdddress.$Address->cities_name.", ";
                              }
                              if ($Address->pincodes_val!='') {
                                $fullAdddress = $fullAdddress.$Address->pincodes_val.", ";
                              }
                              // if ($Address->entry_postcode!='') {
                              //   $fullAdddress = $fullAdddress.$Address->entry_postcode.".";
                              // }

                              
                              
                              if(Session::has('user_default_address')){
                                $user_default_address = Session::get('user_default_address');
                                $user_default_address_id = $user_default_address->address_book_id;
                                $user_default_pincode=$user_default_address->pincodes_val;
                              }
                            ?>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" id="address_<?php echo $counter; ?>" name="shipping" type="radio" <?php if($user_default_address_id==$Address->address_book_id){echo "checked";} ?> value="<?php echo $Address->address_book_id; ?>" onclick="selectDefaultAddress('<?php echo $Address->address_book_id; ?>')">
                              <label class="custom-control-label text-body" for="address_<?php echo $counter; ?>">#<?php echo $fullAdddress; ?></label>
                            </div>
                            <?php $counter++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                          </div>

                        </div>
                      </div>
                      <p class="phn145"> <a class="" data-toggle="collapse" href="#edit-number" aria-expanded="true"><span>Ship to a different address?</span></a></p>
                      <div class="collapse show" id="edit-number" style="">
                        <div class="row">
                          <div class="col-lg-12">

                            <form class="" method="post" action="<?php echo e(url('addAddress')); ?>">
                              <?php echo csrf_field(); ?>
                              <!-- Multiple Radios (inline) -->
                              <div class="address-fieldset">
                                <div class="row">
                                  <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Flat / House / Office No.*</label>
                                      <input id="flat" name="flat" type="text" placeholder="Address" class="form-control input-md" required="">
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Street / Society / Office Name*</label>
                                      <input id="street" name="street" type="text" placeholder="Street Address" class="form-control input-md">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Locality*</label>
                                      <select name="Locality" id="Locality" class="form-control input-md" required="">
                                        <option value="">Select City</option>
                                        <?php $__currentLoopData = $result['cityList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->cities_id); ?>"><?php echo e($city->cities_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Pincode*</label>
                                      <select name="pincode" id="pincode" class="form-control input-md" required="">
                                        <option value="">Select Pincode</option>
                                      </select>
                                      
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                      <input type="checkbox" id="default_address" name="default_address" value="1">
                                      <label class="control-label">Default Address</label>        
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-md-12">
                                    <div class="form-group mb-0">
                                      <div class="address-btns">
                                        <button class="save-btn14 hover-btn">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>

                            <!-- <a class="ml-auto next-btn16 hover-btn collapsed" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseThree" aria-expanded="false"> Next </a> -->

                          </div>
                        </div>
                      </div>

                      <div class="address-btns">
                        <a class="collapsed ml-auto next-btn16 hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" href="#collapseThree"> Next </a>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="checkout-step">
                  <div class="checkout-card" id="headingThree">
                    <span class="checkout-step-number">2</span>
                    <h4 class="checkout-step-title">
                    <button class="wizard-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Delivery Time </button>
                    </h4>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#checkout_wizard" style="">
                    <div class="checkout-step-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">

                            <?php
                              $timeCounter = 1;
                            ?>
                            <?php if(count($result['slot_list'])>0): ?>
                            <?php $__currentLoopData = $result['slot_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slot_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $current_time = date("H:i:s");
                              $tody = date("d/m/yy");
                              $afterTime = date('H:i:s', strtotime($current_time.'+6 hour'));
                              if ($afterTime>$slot_list->delivery_time_from) {
                                $minDate = '+1d';
                                $maxDate = '+5d';
                              }else{
                                $minDate = '0';
                                $maxDate = '+4d';
                              }                             
                            ?>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" id="time_<?php echo $slot_list->delivery_slots_id; ?>" name="delivery_time" type="radio" onclick="chooseTime('<?php echo $timeCounter; ?>','<?php echo $minDate; ?>','<?php echo $maxDate; ?>','<?php echo $slot_list->delivery_slots_id; ?>')" >
                              <label class="custom-control-label text-body text-nowrap" for="time_<?php echo $slot_list->delivery_slots_id; ?>"><?php echo date("h:ia",strtotime($slot_list->delivery_time_from)); ?> - <?php echo date("h:ia",strtotime($slot_list->delivery_time_to)); ?></label>
                              <!-- <label id="deliveryDateDisplay_<?php //echo $slot_list->delivery_slots_id; ?>"></label> -->
                              
                              <!-- <input type="" name="" id="DateDisplayHidden_<?php //echo $timeCounter; ?>" placeholder="Select Date"> -->
                            </div>
                            <?php $timeCounter++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                            
                          </div>
                        </div>
                      </div>
                      <a class="next-btn16 hover-btn collapsed" role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="false"> Proccess to payment </a>
                    </div>
                  </div>
                </div>
                <div class="checkout-step">
                  <div class="checkout-card" id="headingFour">
                    <span class="checkout-step-number">3</span>
                    <h4 class="checkout-step-title">
                    <button class="wizard-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Payment</button>
                    </h4>
                  </div>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#checkout_wizard" style="">
                    <div class="checkout-step-body">
                      <div class="payment_method-checkout">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="rpt100">
                              <ul class="radio--group-inline-container_1">
                                <li>
                                  <div class="radio-item_1">
                                    <input id="cashondelivery1" value="cashondelivery" name="paymentmethod" type="radio" data-minimum="50.0" checked>
                                    <label for="cashondelivery1" class="radio-label_1">Cash on Delivery</label>
                                  </div>
                                </li>
                                <li>
                                  <div class="radio-item_1">
                                    <input id="card1" value="card" name="paymentmethod" type="radio" data-minimum="50.0">
                                    <label for="card1" class="radio-label_1">Credit / Debit Card</label>
                                  </div>
                                </li>
                              </ul>
                            </div>


                            <div class="form-group return-departure-dts" data-method="cashondelivery" style="display: block;">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="pymnt_title">
                                    <h4>Cash on Delivery</h4>
                                    <!-- <p>Cash on Delivery will not be available if your order value exceeds ₹10.</p> -->
                                  </div>
                                </div>
                              </div>

                                <a href="javascript:void(0);" class="next-btn16 hover-btn" onclick="orderCashOnDelivery()">Place Order</a>

                                <form method="POST" action="<?php echo e(url('cashOnDeliveryOrder')); ?>" id="cashOnDeliveryForm">
                                  <?php echo csrf_field(); ?>
                                  <input type="hidden" name="pincode_val" id="cod_pincode_val" >
                                  <input type="hidden" name="products_price" id="cod_products_price" >
                                  <input type="hidden" name="payment_method" value="cash_on_delivery">
                                  <input type="hidden" name="address_book_id" id="cod_address_book_id">
                                  <input type="hidden" name="coupon_id" id="cod_coupon_id">
                                  <input type="hidden" name="coupon_discount" id="cod_coupon_discount">
                                  <input type="hidden" name="timeIdHidden" id="cod_timeIdHidden">
                                  <input type="hidden" name="deliveryDateHidden" id="cod_deliveryDateHidden">
                                </form>

                                <div class="alert alert-danger alert-block" id="order_error_div" style="margin-top: 10px;display: none;">
                                  <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong id="order_error_msg"></strong>
                                </div>

                              
                            </div>



                            <div class="form-group return-departure-dts" data-method="card" style="display: none;">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="pymnt_title mb-4">
                                    <h4>Credit / Debit Card</h4>
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Holder Name*</label>
                                    <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="">
                                  </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Card Number*</label>
                                    <input id="email1" name="email1" type="text" placeholder="Email Address" class="form-control input-md" required="">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-4 col-md-12">
                                  <div class="form-group custom-select1">
                                    <label class="control-label">Expiration Month*</label>
                                    <select class="custom-select form-control" id="checkoutPaymentMonth">
                                      <option>January</option>
                                      <option>February</option>
                                      <option>March</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                  <div class="form-group custom-select1">
                                    <label class="control-label">Expiration Year*</label>
                                    <select class="custom-select form-control" id="checkoutPaymentCardYear">
                                      <option>2017</option>
                                      <option>2018</option>
                                      <option>2019</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                  <div class="form-group custom-select1">
                                    <label class="control-label">CVV*</label>
                                    <input id="email1" name="email1" type="text" placeholder="CVV" class="form-control input-md" required="">
                                  </div>
                                </div>
                              </div>

                              <form method="POST" action="<?php echo e(url('onlineOrderPayment')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="address_id_hidden" value="<?php echo $user_default_address_id; ?>" id="address_id_hidden" >
                                <input type="hidden" name="pincode_hidden" value="<?php echo $user_default_pincode; ?>" id="pincode_hidden" >
                                <input type="hidden" name="finalOrderTotal" id="finalOrderTotal" value="<?php echo $withDiscTotal;?>">
                                <input type="hidden" name="coupans_id" id="coupans_id">
                                <input type="hidden" name="coupon_discount_amount" id="coupon_discount_amount">
                                <input type="hidden" name="timeIdHidden" id="timeIdHidden">
                                <input type="hidden" name="deliveryDateHidden" id="deliveryDateHidden">

                                <!-- <button type="submit" class="next-btn16 hover-btn" >Place Order</button> -->
                              </form>


                            </div>
                            <!-- <a routerlink="/Orderplaced" class="next-btn16 hover-btn">Place Order</a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                <div class="card mb-0">
                    <div class="card-body">
                        <h3 class="card-title">Your Order</h3>
                        <table class="checkout__totals">
                            <thead class="checkout__totals-header">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <?php if(count($result['cartList'])>0): ?>
                            <tbody class="checkout__totals-products">

                              <?php $finalProdDiscount = 0;
                              $withoutDiscTotal = 0;
                              $withDiscTotal = 0; ?>

                              
                                <?php $__currentLoopData = ($result['cartList']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td>
                                      <?php echo e($cart_products->products_name); ?> × <?php echo e($cart_products->customers_basket_quantity); ?>

                                      <?php
                                          if ($cart_products->prodDiscount!='') {
                                              echo "( Bulk Discount - ".$cart_products->prodDiscount."% )";
                                          }
                                      ?>
                                    </td>
                                    <td>
                                      <?php
                                        if ($cart_products->prodDiscount!='') {
                                            $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
                                            $disc = (($cart_products->final_price*$cart_products->prodDiscount)/100)*$cart_products->customers_basket_quantity;
                                            $totalPrice = $tPrice-$disc;
                                        }else{
                                            $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
                                            $disc = 0;
                                            $totalPrice = $tPrice-$disc;
                                        }
                                        $withoutDiscTotal = $withoutDiscTotal+$tPrice;
                                        $finalProdDiscount = $finalProdDiscount+$disc;
                                        $withDiscTotal = $withDiscTotal + $totalPrice;
                                        echo "₹".$totalPrice;
                                    ?>
                                    </td>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </tbody>
                            <tbody class="checkout__totals-subtotals">
                                <tr>
                                    <th>Subtotal</th>
                                    <td>₹<?php echo e($withoutDiscTotal); ?></td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>₹<?php echo e($finalProdDiscount); ?></td>
                                </tr>
                                <!-- <tr>
                                    <th>Shipping</th>
                                    <td>₹25.00</td>
                                </tr> -->
                            </tbody>
                            <tfoot class="checkout__totals-footer">
                                <tr>
                                    <th>Total</th>
                                    <td>₹<?php echo e($withDiscTotal); ?></td>
                                </tr>
                            </tfoot>
                                <?php endif; ?>

                        </table>
                  
                        <!-- <div class="checkout__agree form-group">
                            <div class="form-check">
                                <span class="form-check-input input-check">
                                    <span class="input-check__body">
                                        <input class="input-check__input" type="checkbox" id="checkout-terms" /> <span class="input-check__box"></span>
                                       
                                    </span>
                                </span>
                                <label class="form-check-label" for="checkout-terms">I have read and agree to the website <a target="_blank" href="<?php echo e(URL::to('/termAndCondition')); ?>">terms and conditions</a>*</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-xl btn-block">Place Order</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


      </section>



  <script type="text/javascript">

      function applyCouponCode(){
        var couponCode = $('#couponCode').val();
        //alert(couponCode);
        $.ajax({

          type:'POST',
          url:'<?php echo e(url('apply_coupon_web')); ?>',
          data:{couponCode:couponCode,"_token": "<?php echo e(csrf_token()); ?>"},
          success:function(data){
            console.log(data.returnData);
            if (data.returnData.isLogin == 'no') {
              window.location.href = "<?php echo url('userLogin'); ?>";
            }else{
              if (data.returnData.status == false) {
                $('#promo_error_div').css('display','block');
                $('#promo_error_msg').html(data.returnData.message);
              }else{
                $('#promo_error_div').css('display','none');
              }
              if (data.returnData.status == true) {
                $('#promo_success_div').css('display','block');
                $('#promo_success_msg').html(data.returnData.message);
                $('#coupans_id').val(data.returnData.couponReturn['coupans_id']);
                $('#coupon_discount_amount').val(data.returnData.couponReturn['coupon_discount_amount']);

                $('#displayCouponDiscountDiv').css('display','block');
                $('#displayCouponDiscountVal').html('₹'+data.returnData.couponReturn['coupon_discount_amount']);

                var subtotal = $('#orderTotal').val();
                var total = subtotal-data.returnData.couponReturn['coupon_discount_amount'];
                $('#finalOrderTotal').val(total);
                $('#displayTotalDiv').html(total);
              }else{
                $('#promo_success_div').css('display','none');
                $('#displayCouponDiscountDiv').css('display','none');
              }
            }
          }

        });
      }

      $(document).ready( function () {
        
        $( "#DateDisplayHidden_1" ).attr("disabled", true);
        $( "#DateDisplayHidden_2" ).attr("disabled", true);
        $( "#DateDisplayHidden_3" ).attr("disabled", true);
        $( "#timeIdHidden" ).val('');        
        
      });

      function chooseTime(timeCounter,minDate,maxDate,delivery_slots_id){
        //alert(delivery_slots_id+' '+minDate+' '+maxDate);timeIdHidden_
        $( "#timeIdHidden" ).val(delivery_slots_id);
        var minDate = minDate;
        var maxDate = maxDate;
        for (var i = 1; i <= 3; i++) {
          if (timeCounter==i) {
            $( "#DateDisplayHidden_"+i ).attr("disabled", false);
          }else{
            $( "#DateDisplayHidden_"+i ).attr("disabled", true);
            $( "#DateDisplayHidden_"+i ).val('');
            $( "#deliveryDateHidden" ).val('');
          }
        }
        
        // $( "#DateDisplayHidden_"+timeCounter ).datepicker({
        //   dateFormat: 'dd/mm/yy',
        //   minDate: minDate,
        //   maxDate: maxDate,
        //   changeMonth: true,
        //   changeYear: true,
        //   // yearRange: "-90:+00"
        //   onClose: function( selectedDate ) {
        //     $( "#deliveryDateHidden" ).val(selectedDate);
        //   }
        // });
      }

      function selectDefaultAddress(address_book_id){
        $.ajax({

          type:'POST',
          url:'<?php echo e(url('session_address')); ?>',
          data:{address_book_id:address_book_id,"_token": "<?php echo e(csrf_token()); ?>"},
          success:function(data){
            console.log(data.userAddress);
            $('#address_id_hidden').val(data.userAddress.address_book_id);
            $('#pincode_hidden').val(data.userAddress.pincodes_val);
            
          }

        });
      }

      
      function orderCashOnDelivery(){
        //alert('couponCode');
        //var pincode_session = '<?php //echo $result['user_pincode']->pincodes_val; ?>';
        var pincode_hidden = $( "#pincode_hidden" ).val();
        var products_price = $('#finalOrderTotal').val();
        var payment_method = 'cash_on_delivery';
        var address_book_id = $( "#address_id_hidden" ).val();
        var coupon_id = $( "#coupans_id" ).val();
        var coupon_discount = $( "#coupon_discount_amount" ).val();
        var timeIdHidden = $( "#timeIdHidden" ).val();
        //var deliveryDateHidden = $( "#deliveryDateHidden" ).val();
        
        if (address_book_id=='') {
          $('#order_error_div').css('display','block');
          $('#order_error_msg').html('Please select delivery address.');
          return false;
        }
        // else if (pincode_session!=pincode_hidden) {
        //   $('#order_error_div').css('display','block');
        //   $('#order_error_msg').html('Pincode not match.');
        //   return false;
        // }
        else if (products_price==''||products_price==0) {
          $('#order_error_div').css('display','block');
          $('#order_error_msg').html('Order price can not be 0.');
          return false;
        }else if (timeIdHidden=='') {
          $('#order_error_div').css('display','block');
          $('#order_error_msg').html('Please select delivery time.');
          return false;
        }
        // else if (deliveryDateHidden=='') {
        //   $('#order_error_div').css('display','block');
        //   $('#order_error_msg').html('Please select delivery date.');
        //   return false;
        // }
        else{
          $('#order_error_div').css('display','none');
          //alert('orederjvbhbjh');
          //$('#cod_pincode_val').val(pincode_hidden);
          $('#cod_products_price').val(products_price);
          $('#cod_address_book_id').val(address_book_id);
          $('#cod_coupon_id').val(coupon_id);
          $('#cod_coupon_discount').val(coupon_discount);
          $('#cod_timeIdHidden').val(timeIdHidden);
          //$('#cod_deliveryDateHidden').val(deliveryDateHidden);

          $('#cashOnDeliveryForm').submit();

          
        }      

      }



      function orderOnlineStockCheck(){
        $('#online_order_error_div').css('display','none');
        $('#onlinePaymentDiv').css('display','none');
        //alert('orederjvbhbjh');
        //var pincode_session = '<?php //echo $result['user_pincode']->pincodes_val; ?>';
        var pincode_hidden = $( "#pincode_hidden" ).val();
        var products_price = $('#finalOrderTotal').val();
        var payment_method = 'cash_on_delivery';
        var address_book_id = $( "#address_id_hidden" ).val();
        var coupon_id = $( "#coupans_id" ).val();
        var coupon_discount = $( "#coupon_discount_amount" ).val();
        var timeIdHidden = $( "#timeIdHidden" ).val();
        var deliveryDateHidden = $( "#deliveryDateHidden" ).val();
        
        if (address_book_id=='') {
          $('#online_order_error_div').css('display','block');
          $('#online_order_error_msg').html('Please select delivery address.');
          return false;
        }else if (pincode_session!=pincode_hidden) {
          $('#online_order_error_div').css('display','block');
          $('#online_order_error_msg').html('Pincode not match.');
          return false;
        }else if (products_price==''||products_price==0) {
          $('#online_order_error_div').css('display','block');
          $('#online_order_error_msg').html('Order price can not be 0.');
          return false;
        }else if (timeIdHidden=='') {
          $('#online_order_error_div').css('display','block');
          $('#online_order_error_msg').html('Please select delivery time.');
          return false;
        }else if (deliveryDateHidden=='') {
          $('#online_order_error_div').css('display','block');
          $('#online_order_error_msg').html('Please select delivery date.');
          return false;
        }else{
          $('#online_order_error_div').css('display','none');
          //alert('orederjvbhbjh');
          $.ajax({

            type:'POST',
            url:'<?php echo e(url('onlineStockCheck')); ?>',
            data:{pincode_val:pincode_hidden,products_price:products_price,payment_method:payment_method,address_book_id:address_book_id,coupon_id:coupon_id,coupon_discount:coupon_discount,timeIdHidden:timeIdHidden,deliveryDateHidden:deliveryDateHidden,"_token": "<?php echo e(csrf_token()); ?>"},
            success:function(data){
              console.log(data.returnData);
              if (data.returnData.isLogin=='no') {
                window.location.href = "<?php echo url('userLogin'); ?>";
              }else{
                if (data.returnData.out_of_stock=='Yes') {
                  $('#online_order_error_div').css('display','block');
                  $('#online_order_error_msg').html("<b>"+data.returnData.out_of_stock_product.products_name+"</b> is out of stock.");
                }else{
                  $('#onlinePaymentDiv').css('display','block');
                }               
              }
            }

          });
        }

      }



    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/checkout.blade.php ENDPATH**/ ?>