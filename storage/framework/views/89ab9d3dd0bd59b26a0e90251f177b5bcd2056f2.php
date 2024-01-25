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
								<a href="<?php echo e(URL::to('/wishlist')); ?>" class="user-item"><i class="fa fa-heart-o"></i>My Wishlist</a>
								<a href="<?php echo e(URL::to('/myAddress')); ?>" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>
								<a href="<?php echo e(URL::to('/profile')); ?>" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

								<?php if($current_user_details->user_type=='Corporate'){ ?>
									<a href="<?php echo e(URL::to('/kycList')); ?>" class="user-item active"><i class="fa fa-upload"></i>Upload Kyc</a>
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
										
										<?php if(session()->has('message')): ?>
											<div class="alert alert-success" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<?php echo e(session()->get('message')); ?>

											</div>
										<?php endif; ?>

									</div>
								</div>
							</div>
							<div class="wishlistsec">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="pdpt-bg">
											<div class="pdpt-title1">
												<h4>KYC</h4>
											</div>
											<div class="address-body">
												<a href="#" class="add-address hover-btn" data-toggle="modal" data-target="#kyc_model"><i class="fa fa-plus-circle"></i> Upload KYC Docunment</a>

												<?php $__currentLoopData = $result['userKycList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userKyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="address-item">
													<div class="address-icon1">
														<i class="fa fa-file-image-o"></i>
													</div>

													<div class="address-dt-all detailed-address-div" style="justify-content: space-around;">
														
														<p class="detailed-address-id"><?php echo e($userKyc->kyc_title); ?></p>
														<a href="<?php echo e(asset('upload_file/kyc').'/'.$userKyc->kyc_file); ?>" target="_blank">
														<div class="order-dt-img" >
								                            <img src="<?php echo e(asset('upload_file/kyc').'/'.$userKyc->kyc_file); ?>" alt="">
								                        </div>
								                        </a>
														
														
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
</div>
</div>


<div id="kyc_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
	<div class="modal-dialog category-area" role="document">
		<div class="category-area-inner">
			<div class="modal-header">
				<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
				<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="category-model-content modal-content">
				<div class="cate-header">
					<h4>Upload Document</h4>
				</div>
				<div class="add-address-form">
					<div class="checout-address-step">
						<div class="row">
							<div class="col-lg-12">
								<form class="" method="post" action="<?php echo e(url('addKyc')); ?>" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<!-- Multiple Radios (inline) -->
									<div class="address-fieldset">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label class="control-label">Title*</label>
													<input id="kyc_title" name="kyc_title" type="text" placeholder="Document Name" class="form-control input-md" required>
												</div>
											</div>
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label class="control-label">Upload File*</label>
													<input id="kyc_file" name="kyc_file" type="file"  class="" required>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

		
		
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/my_kyc.blade.php ENDPATH**/ ?>