@extends('web.layout')
@section('content')
<?php $user = Session::get('supportUserDetails');
   //echo $user['id'];
?>
	<div class="sec-padd">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="left-side-tabs">
							<div class="dashboard-left-links">
								<a href="{{ URL::to('/orders')}}"  class="user-item"><i class="fa fa-cube"></i>My Orders</a>
								<a href="{{ URL::to('/wishlist')}}" class="user-item"><i class="fa fa-heart-o"></i>My Wishlist</a>
								<a href="{{ URL::to('/myAddress')}}" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>						
								<a href="{{ URL::to('/profile')}}" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

								<?php if($user->user_type=='Corporate'){ ?>
                                  <a href="{{ URL::to('/discountedCategory')}}" class="user-item "><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
                                <?php } ?>

								<?php if($user->user_type=='Corporate'){ ?>
                                  <a href="{{ URL::to('/kycList')}}" class="user-item "><i class="fa fa-upload"></i>Upload Kyc</a>
                                <?php } ?>

								<?php if($user->user_type=='Normal'){ ?>
                                <a href="{{ URL::to('/corporateRequest')}}" class="user-item active"><i class="fa fa-cog"></i>Corporate Request</a>
								<?php } ?>
								<a href="{{ URL::to('/logout')}}" class="user-item"><i class="fa fa-sign-out"></i>Logout</a>
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
											<h4>Corporate Request</h4>
											{{--@if(session()->has('message'))
											<div class="alert alert-success">
												{{ session()->get('message') }}
											</div>
										@endif--}}
										</div>
										<div class="address-body">
											<div class="col-12">
											<?php if($user->user_type=='Normal'){ ?>

												<?php if($user->corporate_request==1){ ?>
													<div class="alert alert-success">
														Your Request has been sent successfully. Please wait for admin response.
													</div>
												<?php }else{ ?>
													<a href="{{ URL::to('/updateCorporateRequest')}}" class="btn btn-secondary act-btn">Send Request</a>
												<?php } ?>

											<?php }else{ ?>
												<p>You are a Corporate User</p>
											<?php } ?>
												
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

@endsection
