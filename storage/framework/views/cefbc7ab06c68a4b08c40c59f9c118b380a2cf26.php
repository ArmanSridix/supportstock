<?php $__env->startSection('content'); ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="<?php echo e(URL::to('/')); ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Today's Coupons </a>
               </div>
            </div>
         </div>
      </section>
<div id="page_container">
     <section class="section-padding">
<div class="section-title text-center mb-4 mt-4">
<h2>Today's Coupons</h2>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

	<table class="cart__table cart-table">
      <thead class="cart-table__head">
          <tr class="cart-table__row">
              <th class="cart-table__column cart-table__column--price"><b>#</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Code</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Description</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Type</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Amount</b></th>
          </tr>
      </thead>
      <tbody class="cart-table__body">

        <?php if(count($result['couponList'])>0): ?>
            <?php $__currentLoopData = ($result['couponList']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $couponList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr class="cart-table__row">
              <td class="cart-table__column cart-table__column--price" data-title="#">
                  <?php echo e($key+1); ?>

              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Code">
                <?php echo e($couponList->code); ?>

              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Description">
                <?php echo e($couponList->description); ?>

              </td>
            
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Type">
                <?php echo e(str_replace('_', ' ', $couponList->discount_type)); ?>

              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Amount">
                <?php if($couponList->discount_type=='fixed_product' or $couponList->discount_type=='fixed_cart'): ?>
                  ₹<?php echo e($couponList->amount); ?> 
                <?php else: ?>
                  <?php echo e($couponList->amount); ?>%
                <?php endif; ?>
              </td>
          </tr>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
              <tr class="cart-table__row">
                  <td class="cart-table__column cart-table__column--price" data-title="#">
                      
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Code">
                    
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Description">
                    
                  </td>
                
                  <td class="cart-table__column cart-table__column--price" data-title="Coupon Type">
                    
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Coupon Amount">
                    
                  </td>
              </tr>
              <tr>
                  <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
              </tr>              
          <?php endif; ?>
          
       
      </tbody>
  </table>
	
</div>


</div>

</div>
</section>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/todays_coupon.blade.php ENDPATH**/ ?>