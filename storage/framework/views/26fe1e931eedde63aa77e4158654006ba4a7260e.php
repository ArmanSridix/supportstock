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
								<a href="<?php echo e(URL::to('/orders')); ?>"  class="user-item"><i class="fa fa-cube"></i>My Orders</a>
								<a href="<?php echo e(URL::to('/wishlist')); ?>" class="user-item active"><i class="fa fa-heart-o"></i>My Wishlist</a>
								<a href="<?php echo e(URL::to('/myAddress')); ?>" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>
								<a href="<?php echo e(URL::to('/profile')); ?>" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

                                <?php if($current_user_details->user_type=='Corporate'){ ?>
                                  <a href="<?php echo e(URL::to('/discountedCategory')); ?>" class="user-item "><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
                                <?php } ?>

                                <?php if($current_user_details->user_type=='Corporate'){ ?>
                                  <a href="<?php echo e(URL::to('/kycList')); ?>" class="user-item "><i class="fa fa-upload"></i>Upload Kyc</a>
                                <?php } ?>
                <?php if($current_user_details->user_type=='Normal'){ ?>
                  <a href="<?php echo e(URL::to('/corporateRequest')); ?>" class="user-item"><i class="fa fa-cog"></i>Corporate Request</a>
								<?php } ?>
								<a href="<?php echo e(URL::to('/logout')); ?>" class="user-item"><i class="fa fa-sign-out"></i>Logout</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">

						<div class="dashboard-right">
							
							<div class="wishlistsec">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<table class="cart__table cart-table">
            <thead class="cart-table__head">
                <tr class="cart-table__row">
                    <th class="cart-table__column cart-table__column--image">Image</th>
                    <th class="cart-table__column cart-table__column--product">Product</th>
                    <th class="cart-table__column cart-table__column--price">Price</th>
                  
                    <th class="cart-table__column cart-table__column--total"></th>
                    <th class="cart-table__column cart-table__column--remove"></th>
                </tr>
            </thead>
            <tbody class="cart-table__body">

            	<?php if(count($result['products']['product_data'])>0): ?>
                  <?php $__currentLoopData = ($result['products']['product_data']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr class="cart-table__row" id="wishlist_<?php echo $product_data->products_id; ?>">
                    <td class="cart-table__column cart-table__column--image">
                        <a href="javascript:void(0);"><img src="<?php echo e(asset('').$product_data->image_path); ?>" alt=""></a>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="<?php echo e(URL::to('/product-detail/'.$product_data->products_id)); ?>" class="cart-table__product-name"><?php echo e($product_data->products_name); ?></a>
                       
                    </td>
                    <td class="cart-table__column cart-table__column--price" data-title="Price">₹<?php echo e($product_data->products_price); ?></td>
                  
                    <td class="cart-table__column cart-table__column--total" data-title="Total"><a href="<?php echo e(URL::to('/product-detail/'.$product_data->products_id)); ?>" class="btn btn-secondary addu-button">View Details</a></td>
                    <td class="cart-table__column cart-table__column--remove">
                       <a href="javascript:void(0);" onclick="removeWishList(<?php echo $product_data->products_id; ?>)" ><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                    </tr>
                <?php endif; ?>
                
             
            </tbody>
        </table>
									</div>
								</div>
							</div>
						</div>
					
		            </div>
		
		
	</div>
</div>
</div>

<script type="text/javascript">

	function removeWishList(products_id){
      //alert(products_id);
      $.ajax({

        type:'POST',
        url:'<?php echo e(url('addWishlistWeb')); ?>',
        data:{products_id:products_id,"_token": "<?php echo e(csrf_token()); ?>"},
        success:function(data){
          
          //location.reload();
          $('#wishlist_'+products_id).hide();
          
        }

      });
    }
	
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/wishlist.blade.php ENDPATH**/ ?>