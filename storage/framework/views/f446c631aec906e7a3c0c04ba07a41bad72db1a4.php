<section class="section-padding footer bg-dark border-top mt-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-3">
            <h4 class="mb-5 mt-0"><a class="logo" href="<?php echo e(URL::to('/')); ?>"><img src="<?php echo e(asset('frontEnd/images/logo.png')); ?>" alt="Groci"></a></h4>
            <p class="mb-0"><a class="" href="#"><i class="mdi mdi-phone"></i> +61 525 240 310</a></p>
            <p class="mb-0"><a class="" href="#"><i class="mdi mdi-cellphone-iphone"></i> 12345 67890, 56847-98562</a></p>
            <p class="mb-0"><a class="" href="#"><i class="mdi mdi-email"></i> info@supportstock.com, sptstock001@gmail.com</a></p>
         </div>
         <div class="col-lg-2 col-md-2">
            <h6 class="mb-4">HELP </h6>
            <ul>
               <li><a href="<?php echo e(URL::to('/payments')); ?>">Payments</a></li>
               <li><a href="<?php echo e(URL::to('/shipping')); ?>">Shipping</a></li>
               <li><a href="<?php echo e(URL::to('/cancellation_returns')); ?>">Cancellation & Returns</a></li>
               <li><a href="<?php echo e(URL::to('/refunds')); ?>">Refunds</a></li>
               <li><a href="<?php echo e(URL::to('/faq')); ?>">Faq's</a></li>
            <ul></ul>
         </ul>
      </div>
      <div class="col-lg-2 col-md-2">
         <h6 class="mb-4">POLICY</h6>
         <ul>
            <li><a href="<?php echo e(URL::to('/return_policy')); ?>">Return Policy</a></li>
            <li><a href="<?php echo e(URL::to('/termAndCondition')); ?>">Terms & Conditions</a></li>
            <li><a href="<?php echo e(URL::to('/security')); ?>">Security</a></li>
            <li><a href="<?php echo e(URL::to('/privacyPolicy')); ?>">Privacy Policy</a></li>
          <li><a href="<?php echo e(URL::to('/copyright')); ?>">Copyright</a></li>
         <ul></ul>
      </ul>
   </div>
   <div class="col-lg-2 col-md-2">
      <h6 class="mb-4">ABOUT US</h6>
      <ul>
         <li><a href="<?php echo e(URL::to('/aboutUs')); ?>">About Us</a></li>
         <li><a href="<?php echo e(URL::to('/contactUs')); ?>">Contact Us</a></li>
         <li><a href="<?php echo e(URL::to('/customer_service')); ?>">Customer Service</a></li>
         <li><a href="<?php echo e(URL::to('/faq')); ?>">Frequently Asked Questions</a></li>
         <li><a href="<?php echo e(URL::to('/copyright')); ?>">Copyright</a></li>
      <ul></ul>
   </ul>
</div>
<div class="col-lg-3 col-md-3">
   <h6 class="mb-4">GET IN TOUCH</h6>
   <div class="footer-social">

      <a class="btn-youtube" href="<?php echo e($result['commonContent']['social_link_details']->youtube_link); ?>" target="_blank"><i class="mdi mdi-youtube"></i></a>
      <a class="btn-facebook" href="<?php echo e($result['commonContent']['social_link_details']->facebook_link); ?>" target="_blank"><i class="mdi mdi-facebook"></i></a>
      <a class="btn-twitter" href="<?php echo e($result['commonContent']['social_link_details']->twitter_link); ?>" target="_blank"><i class="mdi mdi-twitter"></i></a>
      <a class="btn-instagram" href="<?php echo e($result['commonContent']['social_link_details']->instagram_link); ?>" target="_blank"><i class="mdi mdi-instagram"></i></a>
      <!-- <a class="btn-whatsapp" href="#"><i class="mdi mdi-whatsapp"></i></a> -->
 
   </div>
   <h6 class="mb-2 mt-4">PAYMENTS <span><img src="<?php echo e(asset('frontEnd/images/razorpay.png')); ?>" alt="" style="width: 140px;"></span> </h6>
   <div class="app">
      <a href="#"><img src="<?php echo e(asset('frontEnd/images/payments.png')); ?>" alt=""></a>
   </div>
</div>
</div>
</div>
</section>
<section class="pt-2 pb-2 footer-bottom">
<div class="container">
<div class="row no-gutters">
<div class="col-lg-12 col-sm-12 text-center">
   <p class="mt-1 mb-0">© Copyright <?php echo date("Y"); ?> <strong style="color:#e96125;">Support<span style="color:#fff;">stock</span></strong>. All Rights Reserved<br>
   </p>
</div>
</div>
</div>
</section>


<!-- <div class="cart-sidebar">
<div class="cart-sidebar-header">
<h5>
My Cart <span class="text-success">(5 item)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
</a>
</h5> </div>
<div class="cart-sidebar-body">
<div class="cart-list-product"> <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a> <img class="img-fluid" src="<?php echo e(asset('frontEnd/images/item/1.jpg')); ?>" alt=""> <span class="badge badge-success">50% OFF</span>
<h5><a href="#">Product Title Here</a></h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
<p class="offer-price mb-0">₹450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">₹800.99</span></p>
</div>
<div class="cart-list-product"> <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a> <img class="img-fluid" src="<?php echo e(asset('frontEnd/images/item/2.jpg')); ?>" alt=""> <span class="badge badge-success">50% OFF</span>
<h5><a href="#">Product Title Here</a></h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
<p class="offer-price mb-0">₹450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">₹800.99</span></p>
</div>
<div class="cart-list-product"> <a class="float-right remove-cart" href="#"><i class="mdi mdi-close"></i></a> <img class="img-fluid" src="<?php echo e(asset('frontEnd/images/item/3.jpg')); ?>" alt=""> <span class="badge badge-success">50% OFF</span>
<h5><a href="#">Product Title Here</a></h5>
<h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6>
<p class="offer-price mb-0">₹450.99 <i class="mdi mdi-tag-outline"></i> <span class="regular-price">₹800.99</span></p>
</div>


</div>
<div class="cart-sidebar-footer">
<div class="cart-store-details">
<p>Sub Total <strong class="float-right">₹900.69</strong></p>
<p>Delivery Charges <strong class="float-right text-danger">+ ₹29.69</strong></p>
<h6>Your total savings <strong class="float-right text-danger">₹55 (42.31%)</strong></h6> </div>
<a href="<?php echo e(URL::to('/viewcart')); ?>">
<button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> View Cart </span><span class="float-right"><strong>₹1200.69</strong> <span class="mdi mdi-chevron-right"></span></span>
</button>

</a>
</div>
</div> -->


<a href="#" id="toTop"><span id="toTopHover" style="opacity: 0;"></span></a><?php /**PATH C:\xampp7432\htdocs\suportstock\resources\views/web/common/footer.blade.php ENDPATH**/ ?>