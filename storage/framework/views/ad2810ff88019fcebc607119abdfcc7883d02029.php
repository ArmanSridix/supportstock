<?php $__env->startSection('content'); ?>
<?php 
	if(Session::has('supportUserDetails')){ 
		$user = Session::get('supportUserDetails'); 
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
								<a href="<?php echo e(URL::to('/myAddress')); ?>" class="user-item active"><i class="fa fa-map-marker"></i>My Address</a>
								<a href="<?php echo e(URL::to('/profile')); ?>" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

								<?php if($user->user_type=='Corporate'){ ?>
                                  <a href="<?php echo e(URL::to('/discountedCategory')); ?>" class="user-item "><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
                                <?php } ?>

								<?php if($user->user_type=='Corporate'){ ?>
									<a href="<?php echo e(URL::to('/kycList')); ?>" class="user-item"><i class="fa fa-upload"></i>Upload Kyc</a>
								<?php } ?>
								<?php if($user->user_type=='Normal'){ ?>
                                	<a href="<?php echo e(URL::to('/corporateRequest')); ?>" class="user-item"><i class="fa fa-cog"></i>Corporate Request</a>
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
										<h4><i class="fa fa-map-marker"></i>My Address</h4>
										
									</div>
								</div>
							</div>
							<div class="wishlistsec">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="pdpt-bg">
											<div class="pdpt-title1">
												<h4>My Address</h4>
											</div>
											<div class="address-body">
												<a href="#" class="add-address hover-btn" data-toggle="modal" data-target="#address_model"><i class="fa fa-plus-circle"></i> Add New Address</a>

												
												<?php $__currentLoopData = $result['userAddressList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="address-item">
													<div class="address-icon1">
														<i class="fa fa-home"></i>
													</div>
													<div class="address-dt-all detailed-address-div">
														
														<p class="detailed-address-id" hidden><?php echo e($Address->address_book_id); ?></p>
														<p class="detailed-address-city-id" hidden><?php echo e($Address->cities_id); ?></p>
														<p class="detailed-address"><?php echo e($Address->flat_no); ?>, <?php echo e($Address->entry_street_address); ?>, <?php echo e($Address->cities_name); ?>, <?php echo e($Address->pincodes_val); ?></p>
														<ul class="action-btns">
															<?php if($user->default_address_id == $Address->address_book_id): ?>
															<li><div class="address-icon1 mr-2" style="background-color: #51AA1B;" >Default</div></li>
															<?php endif; ?>
															<li><div class="action-btn edit_address" style="cursor: pointer;"  ><i class="fa fa-pencil"></i></div></li>
															<li><a href="<?php echo url('deleteaddress')."?address_book_id=".$Address->address_book_id; ?>" class="action-btn"><i class="fa fa-trash"></i></a></li>
														</ul>
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


<div id="address_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
			<div class="modal-dialog category-area" role="document">
				<div class="category-area-inner">
					<div class="modal-header">
						<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
						</button>
					</div>
					<div class="category-model-content modal-content">
						<div class="cate-header">
							<h4>Add New Address</h4>
						</div>
						<div class="add-address-form">
							<div class="checout-address-step">
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
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div id="editaddress_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
			<div class="modal-dialog category-area" role="document">
				<div class="category-area-inner">
					<div class="modal-header">
						<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-times"></i>
						</button>
					</div>
					<div class="category-model-content modal-content">
						<div class="cate-header">
							<h4>Add New Address</h4>
						</div>
						<div class="add-address-form">
							<div class="checout-address-step">
								<div class="row">
									<div class="col-lg-12">
										<form class="" method="post" action="<?php echo e(url('updateaddress')); ?>">
											<?php echo csrf_field(); ?>
											<input type="hidden" id="edit-address_book_id" name="address_book_id" value="" required="">
											<!-- Multiple Radios (inline) -->
											<div class="address-fieldset">
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<div class="form-group">
															<label class="control-label">Flat / House / Office No.*</label>
															<input id="edit-flat" name="flat" type="text" placeholder="Address" class="form-control input-md" value="" required="">
														</div>
													</div>
													<div class="col-lg-12 col-md-12">
														<div class="form-group">
															<label class="control-label">Street / Society / Office Name*</label>
															<input id="edit-street" name="street" type="text" placeholder="Street Address" value="" class="form-control input-md">
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label class="control-label">Locality*</label>
															<select name="Locality" id="edit-Locality" class="form-control input-md" required="">
																<option value="">Select City</option>
																<?php $__currentLoopData = $result['cityList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<option value="<?php echo e($city->cities_id); ?>" ><?php echo e($city->cities_name); ?></option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</select>
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label class="control-label">Pincode*</label>
															<select name="pincode" id="edit-pincode" class="form-control input-md" required="">
																<option value="">Select Pincode</option>
															</select>
															
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<input type="checkbox" id="edit-default-address" name="default_address" value="1">
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
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/my_address.blade.php ENDPATH**/ ?>