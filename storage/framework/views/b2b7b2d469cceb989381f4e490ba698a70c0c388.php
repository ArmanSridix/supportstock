<?php $__env->startSection('content'); ?>

<?php 
  if(Session::has('supportUserDetails')){ 
    $current_user_details = Session::get('supportUserDetails'); 
  } 
?>

<div class="sec-padd">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <div class="left-side-tabs">
              <div class="dashboard-left-links">
                <a href="<?php echo e(URL::to('/orders')); ?>"  class="user-item active"><i class="fa fa-cube"></i>My Orders</a>
                <a href="<?php echo e(URL::to('/wishlist')); ?>" class="user-item"><i class="fa fa-heart-o"></i>My Wishlist</a>
                <a href="<?php echo e(URL::to('/myAddress')); ?>" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>
                <a href="<?php echo e(URL::to('/profile')); ?>" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

                <?php if($current_user_details->user_type=='Corporate'){ ?>
                  <a href="<?php echo e(URL::to('/kycList')); ?>" class="user-item "><i class="fa fa-upload"></i>Upload Kyc</a>
                <?php } ?>

                <a href="<?php echo e(URL::to('/logout')); ?>" class="user-item"><i class="fa fa-sign-out"></i>Logout</a>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-md-8">
            <div class="dashboard-right">
              <div class="row">
                <div class="col-md-12">
                  <div class="main-title-tab">
                    <h4><i class="fa fa-cube"></i>My Orders</h4>
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="pdpt-bg1">
                    <!-- <div class="pdpt-title">
                      <h6>Delivery Timing 10 May, 3.00PM - 6.00PM</h6>
                    </div> -->

                    <?php $__currentLoopData = $result['orderList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="order-body10">

                      <?php $__currentLoopData = $value->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <ul class="order-dtsll row d-flex align-items-center">
                        <li class="col-lg-2 col-md-2">
                          <div class="order-dt-img">
                            <img src="<?php echo e(asset('').$value2->image); ?>" alt="">
                          </div>
                        </li>
                        <li class="col-lg-7 col-md-7">
                          <div class="order-dt47">
                            <h4><a href="productdetails.php"><?php echo e($value2->products_name); ?> x <?php echo e($value2->products_quantity); ?> </a></h4>
                            
                          </div>
                        </li>
                        <li class="col-lg-3 col-md-3 text-right">
                          <div class="order-dt47">
                            <h4 style="text-align: right;">₹<?php echo e($value2->final_price); ?></h4>
                            
                            
                          </div>
                        </li>
                        
                      </ul>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      <div class="total-dt">
                        <div class="total-checkout-group1">
                          <div class="cart-total-dil">
                            <h4>Sub Total</h4>
                            <span>₹<?php echo e($value->order_price - $value->shipping_cost - $value->total_tax); ?></span>
                          </div>
                          <div class="cart-total-dil pt-2">
                            <h4>Delivery Charges</h4>
                            <span>Free</span>
                          </div>
                        </div>
                        <div class="main-total-cart">
                          <h2>Total</h2>
                          <span>₹<?php echo e($value->order_price); ?></span>
                        </div>
                      </div>
                      <div class="track-order">
                        <h4>Track Order</h4>
                        <div class="bs-wizard" style="border-bottom:0;">
                          <div class="bs-wizard-step stepplaced complete">
                            <div class="text-center bs-wizard-stepnum">Placed</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="bs-wizard-dot"></a>
                          </div>
                          <div class="bs-wizard-step steppacked complete"> <!-- complete -->
                          <div class="text-center bs-wizard-stepnum">Packed</div>
                          <div class="progress"><div class="progress-bar"></div></div>
                          <a href="#" class="bs-wizard-dot"></a>
                        </div>
                        <div class="bs-wizard-step stepontheway active"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum">On the way</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                      </div>
                      <div class="bs-wizard-step stepdelivered"><!-- active -->
                      <div class="text-center bs-wizard-stepnum">Delivered</div>
                      <div class="progress"><div class="progress-bar"></div></div>
                      <a href="#" class="bs-wizard-dot"></a>
                    </div>
                  </div>
                </div>
                <div class="call-bill">
                  
                  <div class="order-bill-slip">
                    <a href="<?php echo e(URL::to('/orderInvoice')); ?>" class="bill-btn5 hover-btn">View Bill</a>
                  </div>
                </div>
              </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    
  </div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/orders.blade.php ENDPATH**/ ?>