<?php $__env->startSection('content'); ?>
<?php $user = Session::get('supportUserDetails');
   //echo $user['id'];
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
								<a href="<?php echo e(URL::to('/profile')); ?>" class="user-item active"><i class="fa fa-cog"></i>Account Setting</a>

								<?php if($user->user_type=='Corporate'){ ?>
                                  <a href="<?php echo e(URL::to('/discountedCategory')); ?>" class="user-item "><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
                                <?php } ?>

								<?php if($user->user_type=='Corporate'){ ?>
                                  <a href="<?php echo e(URL::to('/kycList')); ?>" class="user-item "><i class="fa fa-upload"></i>Upload Kyc</a>
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
							
							<div class="wishlistsec">
								<div class="row">
									<div class="col-lg-12 col-md-12">
									<div class="pdpt-bg">
										<div class="pdpt-title1">
											<h4>Account Setting</h4>
											
										</div>
										<div class="address-body">
											<form class="submit-page" action="<?php echo e(url('updateMyProfile')); ?>" method="POST">
												<?php echo csrf_field(); ?>
                                                <div class="row">
                                                
                                                    <div class="col-12 col-md-6">
                                                      <div class="form-group">
                                                        <label>First Name</label>
                                                        <input class="form-control" type="text" name="first_name" placeholder="Name *" value="<?php echo e($user->first_name); ?>" required="">
                                                      </div>
                                                    </div>

													<div class="col-12 col-md-6">
														<div class="form-group">
														  <label>Last Name</label>
														  <input class="form-control" type="text" name="last_name" placeholder="Name *" value="<?php echo e($user->last_name); ?>" required="">
														</div>
													  </div>
                                                
                                                    <div class="col-12 col-md-6">
                                                      <div class="form-group">
                                                        <label>Phone Number *</label>
                                                        <input class="form-control" type="text" name="phone" placeholder="Phone Number *" value="<?php echo e($user->phone); ?>" required="">
                                                      </div>
        
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>Email *</label>
                                                            <input class="form-control" type="email" name="email" placeholder="Email *" value="<?php echo e($user->email); ?>" required="">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-12 col-md-6">
                                                        <!-- Password -->
                                                        <div class="form-group">
                                                            <label>Current Password</label>
                                                            <input class="form-control" type="password" name="current_password" placeholder="Current Password">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-12 col-md-6">
                                                        <!-- Password -->
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input class="form-control" type="password" name="new_password" placeholder="New Password">
                                                        </div>
                                                    </div>
                                                
                                                   
                                                
                                                  
                                                    
                                                    <div class="col-12">
                                                      <button class="btn btn-secondary act-btn" type="submit">Save Changes</button>
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
										<form class="">
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
															<label class="control-label">Pincode*</label>
															<input id="pincode" name="pincode" type="text" placeholder="Pincode" class="form-control input-md" required="">
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label class="control-label">Locality*</label>
															<input id="Locality" name="locality" type="text" placeholder="Enter City" class="form-control input-md" required="">
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

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/profile.blade.php ENDPATH**/ ?>