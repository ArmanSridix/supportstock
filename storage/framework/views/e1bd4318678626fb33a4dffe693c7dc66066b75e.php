<?php

session_start();
use Razorpay\Api\Api;

$keyId = $payments_setting['RAZORPAY_KEY']->value;
$keySecret = $payments_setting['RAZORPAY_SECRET']->value;
$displayCurrency = 'INR';

$api = new Api($keyId, $keySecret);

//$displayCurrency = 'INR';
//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
//$input['finalOrderTotal'] = 1;
$orderData = [
    'receipt'         => rand(100000,999999),
    'amount'          => $input['products_price'] * 100, // 1 rupees in paise
    'currency'        => 'INR'
  //  'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}



$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Supportstock",
    "description"       => "Test",
    "image"             => $input['logo_img'],
    "prefill"           => [
    "name"              => $input['firstname']." ".$input['lastname'],
    "email"             => $input['customers_mail'],
    "contact"           => $input['delivery_phone'],
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

?>


  
  <?php $__env->startSection('content'); ?>

    <section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;">Cart</a> <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Checkout </a><span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Razor Pay </a>
          </div>
        </div>
      </div>
    </section>

    <section class="shop-single section-padding pt-3">
      <div class="checkout block">
        <div class="container">
          <div class="row">

            <!-- <div class="flex-center position-ref full-height" style="width: 40%; text-align: center;"> -->
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <div class="pdpt-bg mt-10" style="margin-bottom: 20px;">
                  <div class="pdpt-title checkouttle">
                    <h4>Order Summary</h4>
                  </div>

                  <div class="main-total-cart">
                    <h2>Name</h2>
                    <span id="order_total_div"><span id="displayTotalDiv"><?php echo $input['firstname']." ".$input['lastname']; ?></span></span>
                  </div>

                  <div class="main-total-cart">
                    <h2>Email</h2>
                    <span id="order_total_div"><span id="displayTotalDiv"><?php echo $input['customers_mail']; ?></span></span>
                  </div>

                  <div class="main-total-cart">
                    <h2>Phone</h2>
                    <span id="order_total_div"><span id="displayTotalDiv"><?php echo $input['delivery_phone']; ?></span></span>
                  </div>

                  <div class="main-total-cart">
                    <h2>Total</h2>
                    <span id="order_total_div">₹<span id="displayTotalDiv"><?php echo $input['products_price']; ?></span></span>
                  </div>
                  
                </div>

                <div class="row" style="margin-bottom: 20px;">
                  <div class="col-3">
                    <a href="<?php echo e(url('checkout')); ?>" class="next-btn16 hover-btn" >Back</a>
                  </div>
                  <div class="col-6"></div>

                  <div class="col-3 text-right">
                    <form action="<?php echo e(url('onlinePaymentReturn')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                        <script
                          src="https://checkout.razorpay.com/v1/checkout.js"
                          data-key="<?php echo $data['key']?>"
                          data-amount="<?php echo $data['amount']?>"
                          data-currency="INR"
                          data-name="<?php echo $data['name']?>"
                          data-image="<?php echo $data['image']?>"
                          data-description="<?php echo $data['description']?>"
                          data-prefill.name="<?php echo $data['prefill']['name']?>"
                          data-prefill.email="<?php echo $data['prefill']['email']?>"
                          data-prefill.contact="<?php echo $data['prefill']['contact']?>"
                          data-notes.shopping_order_id="<?php echo rand(1000,9999)?>"
                          data-order_id="<?php echo $data['order_id']?>"
                          <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
                          <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
                        >
                        </script>
                        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                        <input type="hidden" name="shopping_order_id" value="<?php echo rand(1000,9999);?>">

                        <input type="hidden" name="customers_id" value="<?php echo $input['customers_id']; ?>">
                        <input type="hidden" name="customers_mail" value="<?php echo $input['customers_mail']; ?>">
                        <input type="hidden" name="firstname" value="<?php echo $input['firstname']; ?>">
                        <input type="hidden" name="lastname" value="<?php echo $input['lastname']; ?>">
                        <input type="hidden" name="delivery_phone" value="<?php echo $input['delivery_phone']; ?>">
                        <input type="hidden" name="products_price" value="<?php echo $input['products_price']; ?>">
                        <input type="hidden" name="order_comments" value="<?php echo $input['order_comments']; ?>">
                        <input type="hidden" name="payment_method" value="<?php echo $input['payment_method']; ?>">
                        <input type="hidden" name="paymentResponseData" value="<?php echo $input['paymentResponseData']; ?>">
                        <input type="hidden" name="address_book_id" value="<?php echo $input['address_book_id']; ?>">
                        <!-- <input type="hidden" name="coupon_id" value="<?php //echo $input['coupon_id']; ?>">
                        <input type="hidden" name="coupon_discount" value="<?php //echo $input['coupon_discount']; ?>"> -->
                        <input type="hidden" name="timeIdHidden" value="<?php echo $input['timeIdHidden']; ?>">
                        <input type="hidden" name="deliveryDateHidden" value="<?php echo $input['deliveryDateHidden']; ?>">
                        <input type="hidden" name="pincode_val" value="<?php echo $input['pincode_val']; ?>">
                    </form>
                  </div>

                </div>


              </div>
            <!-- </div> -->

          </div>
        </div>
      </div>
    </section>

  <?php $__env->stopSection(); ?>
    
    

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/payWithRazorpay.blade.php ENDPATH**/ ?>