<?php 
//echo testHelper();
login_checks();

$user = Session::get('supportUserDetails');
   //echo $user['id'];
?>

<div class="loader_bg">
   <div class="loader"></div>
</div>
<div class="navbar-top bg-success pt-1 pb-1">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 text-center">
            <!-- <a href="<?php echo e(URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=&best_seller=')); ?>" class="mb-0 text-white"> -->
            <a href="<?php echo e(URL::to('/todaysCoupon')); ?>" class="mb-0 text-white">
            <?php echo e($result['commonContent']['userCoupon'][0]->description); ?> | Code: <strong><span class="text-light"><?php echo e($result['commonContent']['userCoupon'][0]->code); ?> <span class="mdi mdi-tag-faces"></span></span> </strong>
            </a>
         </div>
      </div>
   </div>
</div>
<nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded osahan-menu">
   <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>"> <img src="<?php echo e(asset('frontEnd/images/logo.png')); ?>" alt="logo"> </a>


      <a class="location-top d-flex align-items-center headerSelectCity" href="javascript:void(0);">
         <i class="mdi mdi-map-marker-circle" aria-hidden="true"></i>
         <span class="delivery"> 
            <span class="pincode">
               <?php if($result['commonContent']['locationDetails']!=''){ ?>
                 <span><?php echo $result['commonContent']['locationDetails']->cities_name; ?> - <?php echo $result['commonContent']['locationDetails']->pincodes_val; ?> <i class='fa fa-angle-down' style="margin-left: 7px;"></i></span>
                <?php }else{ ?>
                    <strong>Choose location</strong>
                <?php } ?>
               <i class='mdi mdi-chevron-down' style="font-size: 18px;"></i>
            </span>
         </span>
      </a>


      <button class="navbar-toggler navbar-toggler-white mm-toggle-wrap" type="button">
      <span class="navbar-toggler-icon mm-toggle1" onclick="openNav()"></span>
      </button>
      <div class="navbar-collapse" id="navbarNavDropdown">
         <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
            <div class="top-categories-search">
               <div class="input-group" data-select2-id="5">
                  <span class="input-group-btn categories-dropdown">
                     <select class="form-control-select select2-hidden-accessible headerDropCatSelect"  id="js-example-basic-hide-search">
                        <option selected="selected" value="all" <?php if(app('request')->input('category')=='' || app('request')->input('category')=='all'): ?> selected <?php endif; ?> >All Categories</option>

                        <?php if(count($result['commonContent']['dropdownCategories'])>0): ?>
                           <?php $__currentLoopData = $result['commonContent']['dropdownCategories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$dropdownCategories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($dropdownCategories->id); ?>" <?php if(app('request')->input('category')==$dropdownCategories->id): ?> selected <?php endif; ?> ><?php echo e($dropdownCategories->name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                     </select>
                  </span>
                  <input class="form-control" placeholder="Search products by title" aria-label="Search products in Your City" type="text" id="headerSearchFld" value="<?php echo app('request')->input('search')?app('request')->input('search'):""; ?>" >
                  <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button" id="headerSearchBttn" ><i class="mdi mdi-file-find"></i> Search</button>
                  </span>
               </div>
            </div>
         </div>
         <div class="my-2 my-lg-0">
            <ul class="list-inline main-nav-right">
               <li class="list-inline-item hidden-xs">
                  <?php if($user): ?>
                  <a href="<?php echo e(URL::to('/profile')); ?>" class="btn btn-link">
                     <div class="signInIcon">
                        <i class="mdi mdi-account-circle"></i>
                     </div>
                     <div class="loginheading">
                        <!-- <div class="lightText naming">Sign In</div> -->
                        <div class="mediumText"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></div>
                        <!-- <span class="caret"><i class='mdi mdi-chevron-down' style="font-size: 18px; line-height: 0px;"></i></span> -->
                     </div>
                  </a>
                  <?php else: ?>
                  <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link">
                     <div class="signInIcon">
                        <i class="mdi mdi-account-circle"></i>
                     </div>
                     <div class="loginheading">
                        <div class="lightText naming">Sign In</div>
                        <div class="mediumText">My Account</div>
                        <span class="caret"><i class='mdi mdi-chevron-down' style="font-size: 18px; line-height: 0px;"></i></span>
                     </div>
                  </a>
                  <?php endif; ?>
               </li>
               <li class="list-inline-item hidden-xs">
                  <!-- <a href="#" data-target="#bx-example-modal" data-toggle="modal" class="btn btn-link">
                     <div class="trackIcon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                     </div>
                     <div class="trackHeading">
                        <span class="lightText">Track</span>
                        <span class="mediumText">Order</span>
                     </div>
                  </a> -->
                  <a href="<?php echo e(URL::to('/orders')); ?>" class="btn btn-link">
                     <div class="trackIcon">
                        <i class="fa fa-map-marker" aria-hidden="true" style="color: yellow;"></i>
                     </div>
                     <div class="trackHeading">
                        <span class="lightText">Track</span>
                        <span class="mediumText">Order</span>
                     </div>
                  </a>
               </li>

               	<li class="list-inline-item hidden-xs">
                  	<a href="javascript:void(0);" data-target="#sellOnModal" data-toggle="modal" class="btn btn-link">
                     	<div class="trackIcon">
                        	<i class="fa fa-handshake-o" aria-hidden="true"></i>
                     	</div>
                     	<div class="trackHeading">
                        	<span class="lightText">Sell on</span>
                        	<span class="mediumText">Supportstock</span>
                     	</div>
                  	</a>
               	</li>

               <li class="list-inline-item cart-btn">
                  <!-- <a href="#" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value">5</small></a> -->
                  <?php if(!Session::has('user_pincode_id')){ ?>
                     <a href="javascript:void(0);" onclick="headerCartPincodeCheck()" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart </a>
                  <?php }else{ ?>
                     <a href="<?php echo e(URL::to('/viewcart')); ?>" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart 
                        <?php if($result['commonContent']['cartCount']>0){ ?>
                           <small class="cart-value"><?php echo e($result['commonContent']['cartCount']); ?></small>
                        <?php } ?>
                     </a>
                  <?php } ?>

               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>
<div class="site hidden-xs">
   <header class="site__header d-lg-block d-none pb-2">
      <div class="site-header">
         <div class="site-header__nav-panel">
            <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
               <div class="nav-panel__container container-fluid">
                  <div class="nav-panel__row row">
                     <div class="col-md-3 pr-2">
                        <div class="nav-panel__departments">
                           <div class="departments" data-departments-fixed-by=".block-slideshow">
                              <div class="departments__body">
                                 <div class="departments__links-wrapper">
                                    <div class="departments__submenus-container"></div>

                                    <?php print_r($result['commonContent']['categories']); ?>

                                    



                                 </div>
                              </div>
                              <button class="departments__button">
                              <i class="fa fa-bars departments__button-icon" aria-hidden="true"></i>
                              Shop By Category
                              <i class="fa fa-chevron-down departments__button-arrow"></i>
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <div class="nav-panel__nav-links nav-links">
                           <ul class="nav-links__list">
                              <!-- <li class="nav-links__item">
                                 <a class="nav-links__item-link"  href="<?php echo e(URL::to('/shop')); ?>" >
                                 New Arrivals
                                 </a>
                              </li> -->
                              <li class="nav-links__item">
                                 <a class="nav-links__item-link"  href="<?php echo e(URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=&best_seller=1')); ?>" >
                                 Best Seller
                                 </a>
                              </li>
                              <li class="nav-links__item">
                                 <a class="nav-links__item-link"  href="<?php echo e(URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=1&best_seller=')); ?>" >
                                 Todays Deal
                                 </a>
                              </li>

                              <li class="nav-links__item">
                                 <a class="nav-links__item-link" href="<?php echo e(URL::to('/todaysCoupon')); ?>">
                                 Today's Coupons
                                 </a>
                              </li>

                              <li class="nav-links__item">
                                 <a class="nav-links__item-link" href="<?php echo e(URL::to('/sellerBenefits')); ?>">
                                 Seller Benefit's
                                 </a>
                              </li>

                              <li class="nav-links__item">
                                 <a class="nav-links__item-link" href="<?php echo e(URL::to('/corporateLoginBenefits')); ?>">
                                 Corporate Login Benefit's
                                 </a>
                              </li>
                              <!-- <li class="nav-links__item">
                                 <a class="nav-links__item-link"  href="<?php echo e(URL::to('/shop')); ?>" >
                                 Specials
                                 </a>
                              </li> -->
                              <li class="nav-links__item">
                                 <a class="nav-links__item-link" href="<?php echo e(URL::to('/aboutUs')); ?>">
                                 About Us
                                 </a>
                              </li>
                              
                              <li class="nav-links__item">
                                 <a class="nav-links__item-link" href="<?php echo e(URL::to('/contactUs')); ?>">
                                 Contact Us
                                 </a>
                              </li>                                                                                       
                              
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
</div>
<div id="mobile-menu">
   <ul>
      <li class="closemb">
         <div class="mm-toggle-wrapclose" onclick="closeNav()">
            <div class="mm-toggleclose"><i class="fa fa-times"></i></div>
         </div>
      </li>
      <li><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>


      <li>
         <a href="<?php echo e(URL::to('/')); ?>" >Categories</a>
         <?php print_r($result['commonContent']['mobileCategories']); ?>
         

      </li>

      <li><a href="<?php echo e(URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=&best_seller=1')); ?>">Best Seller</a></li>
      <li><a href="<?php echo e(URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=1&best_seller=')); ?>">Todays Deal</a></li>
      <li><a href="<?php echo e(URL::to('/todaysCoupon')); ?>">Today's Coupons</a></li>
      <li><a href="<?php echo e(URL::to('/sellerBenefits')); ?>">Seller Benefit's</a></li>
      <li><a href="<?php echo e(URL::to('/corporateLoginBenefits')); ?>">Corporate Login Benefit's</a></li>
      <li><a href="<?php echo e(URL::to('/aboutUs')); ?>">About us</a></li>
      <li><a href="<?php echo e(URL::to('/contactUs')); ?>">Contact Us</a></li>

      <?php if($user): ?>
         <li><a href="<?php echo e(URL::to('/profile')); ?>">My Profile</a></li>
         <li><a href="<?php echo e(URL::to('/logout')); ?>">Logout</a></li>
      <?php else: ?>
         <li><a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link">Signin</a></li>
      <?php endif; ?>
      
      
   </ul>
</div>
<div class="off_canvars_overlay"></div>

<!-- location modal -->
<div class="modal fade login-modal-main" id="locationModal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" id="loginCloseButton" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     
                        <div class="login-modal-right">
                           <div class="tab-content">

                              <div  >
                                 <h5 class="heading-design-h5">Please select your location</h5>
                                
                                 
                                    <select class="form-control" name="" id="webb_cities" onChange="pincodeByCity();">
                                       <option value="">Please select your city</option>
                                       <?php $__currentLoopData = $result['commonContent']['cityList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webCity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($webCity->cities_id); ?>"><?php echo e($webCity->cities_name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <select class="form-control mSelectDropdown" name="" id="webb_pincode" autocomplete="off">
                                       <option value="">Please select your Pincode</option>
                                    </select>

                                    <div style="margin: 0px;" >&nbsp;</div>

                                    <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;" id="pincodeErrDiv1">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       Please select city.
                                    </div>

                                    <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;" id="pincodeErrDiv2">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       Please select pincode.
                                    </div>

                                    <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;" id="pincodeErrDiv">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       Pincode not exist.
                                    </div>

                                    <fieldset class="form-group">
                                       <a href="javascript:void(0);" class="btn btn-lg btn-secondary btn-block" onclick="cityCheck()" >Search</a>
                                    </fieldset>
                                 
                              
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
<!-- location modal -->


<div class="modal fade login-modal-main" id="ProductPincodeErrorModal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" id="loginCloseButton" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     
                        <div class="login-modal-right">
                           <div class="tab-content">

                              <div >
                                 <h5 class="heading-design-h5">This product is not deliverable to this pincode.</h5>
                                 
                                 <fieldset class="form-group">
                                   <button type="button" class="btn btn-lg btn-secondary btn-block" data-dismiss="modal" aria-label="Close">Close</button>
                                </fieldset>
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


<div class="modal fade login-modal-main" id="sellOnSuccessModal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" id="loginCloseButton" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     
                        <div class="login-modal-right">
                           <div class="tab-content">

                              <div >
                                 <h5 class="heading-design-h5">Your request has been successfully send.</h5>
                                 
                              	<fieldset class="form-group">
                                   <button type="button" class="btn btn-lg btn-secondary btn-block" data-dismiss="modal" aria-label="Close">Close</button>
                                </fieldset>
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

<div class="modal fade login-modal-main" id="sellOnModal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" id="loginCloseButton" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     
                        <div class="login-modal-right">
                           <div class="tab-content">

                              <div  >
                                 <h5 class="heading-design-h5">Enter your details</h5>
                                
                                 <form action = "<?php echo e(url('sellOnSupportstock')); ?>" method = "POST" id="sellon_form" class="form-validate-sell" >
                                    <?php echo csrf_field(); ?>
                                    <fieldset class="form-group sellondiv">
                                       <label>Name*</label>
                                       <input type="text" class="form-control field-validate-sell" name="sName" id="sName" placeholder="Enter your Name" >
                                    </fieldset>
                                    <fieldset class="form-group sellondiv">
                                       <label>Email*</label>
                                       <input type="text" class="form-control email-validate-sell" name="sEmail" id="sEmail" placeholder="Enter your email-id" >
                                    </fieldset>
                                    <fieldset class="form-group sellondiv">
                                       <label>Phone*</label>
                                       <input type="text" class="form-control phone-validate-sell" name="sPhone" id="sPhone" placeholder="Enter your phone no" maxlength="10" >
                                    </fieldset>
                                    <fieldset class="form-group sellondiv">
                                       <label>Feedback*</label>
                                       <textarea id="sFeedback" class="form-control field-validate-sell" name="sFeedback" rows="4" cols="50" placeholder="Enter your feedback" ></textarea>
                                    </fieldset>

                                    <fieldset class="form-group" id="sellon_otpdiv" style="display: none;">
                                       <p>An OTP has been sent to your phone/email.</p>
                                       <label>OTP*</label>
                                       <input type="text" class="form-control" name="sOtp" id="sOtp" placeholder="Enter OTP" >
                                    </fieldset>

                                    <input type="hidden" name="" id="sell_send_otp" value="">
                                    <div class="alert alert-danger alert-dismissible" role="alert" id="sell_otp_error_div" style="display: none;" >
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       OTP not match..
                                    </div>

                                    <fieldset class="form-group" id="sellon_next">
                                       <button type="button" id="sellon_next_btn" class="btn btn-lg btn-secondary btn-block">Next</button>
                                    </fieldset>

                                    <fieldset class="form-group" id="sellon_submit" style="display: none;">
                                       <button type="button" id="sellon_submit_btn" class="btn btn-lg btn-secondary btn-block">Submit</button>
                                    </fieldset>
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



<div class="modal fade login-modal-main" id="bd-example-modal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" id="loginCloseButton" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     
                        <div class="login-modal-right">
                           <div class="tab-content">

                              <div  id="login">
                                 <h5 class="heading-design-h5">Login to your account</h5>
                                 <?php if(Session::has('loginError')): ?>
                                 <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                    <?php echo session('loginError'); ?>

                                 </div>
                                 <?php endif; ?>
                                 <form action = "<?php echo e(url('process-login')); ?>" method = "POST">
                                    <?php echo csrf_field(); ?>
                                    <fieldset class="form-group">
                                       <label>Enter Email/Mobile number</label>
                                       <input type="text" class="form-control" name="email" placeholder="+91 123 456 7890" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Password</label>
                                       <input type="password" class="form-control" name="password" placeholder="********" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Sign In</button>
                                    </fieldset>
                                 </form>
                                 <div class="login-with">
                                 <a href="login/google"  class="btn btn-google"><i class="fa fa-google-plus"></i>&nbsp;Google </a>
                                 <a href="login/facebook" class="btn btn-facebook"><i class="fa fa-facebook"></i>&nbsp;Facebook</a>
                                 </div>
                                 <div class="login-with-sites text-center">
                                    <p>
                                       <a href="javascript:void(0);" class="forget-btn"> Forgot Password? </a>
                                    </p>
                                 </div>
                                 <a class="btn btn-lg btn-secondary btn-block signup-btn" style="    background: #ececec none repeat scroll 0 0 !important;"> Not registered yet? Sign Up</a>
                              </div>
                             
                              <div  id="register">
                                 <h5 class="heading-design-h5">Register Now!</h5>
                                 <?php if(Session::has('SignupError')): ?>
                                 <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                    <?php echo session('SignupError'); ?>

                                 </div>
                                 <?php endif; ?>
                                 <form action = "<?php echo e(url('signupBefore')); ?>" method = "POST">
                                    <?php echo csrf_field(); ?>
                                    <fieldset class="form-group">
                                       <label>Enter First Name</label>
                                       <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Last Name</label>
                                       <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Mobile number</label>
                                       <input type="text" name="phone" class="form-control" placeholder="1234567890" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Email Address</label>
                                       <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Password</label>
                                       <input type="password" name="password" class="form-control" placeholder="********" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Enter Confirm Password </label>
                                       <input type="password" name="confirm_password" class="form-control" placeholder="********" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Create Your Account</button>
                                    </fieldset>
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck2" required>
                                       <label class="custom-control-label" for="customCheck2">I Agree with <a href="<?php echo e(URL::to('/termAndCondition')); ?>">Term and Conditions</a></label>
                                    </div>
                                 </form>
                                 <a class="btn btn-lg btn-secondary btn-block signin-btn" style="    background: #ececec none repeat scroll 0 0 !important;"> Already registered? Sign In</a>
                                 
                              </div>

                                <div  id="forgotpassword">
                                 <h5 class="heading-design-h5">Forgot Password</h5>
                                    <?php if(session()->has('fp_error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('fp_error')); ?>

                                        </div>
                                    <?php endif; ?>
                                 <form action = "<?php echo e(url('forgetPasswordOtp')); ?>" method = "POST">
                                    <?php echo csrf_field(); ?>
                                    <fieldset class="form-group">
                                       <label>Enter Email or Phone No.</label>
                                       <input type="text" name="email_phone" class="form-control" placeholder="" required>
                                    </fieldset>
                                 
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Submit</button>
                                    </fieldset>
                                 </form>
                                 <a class="btn btn-lg btn-secondary btn-block signin-btn" style="    background: #ececec none repeat scroll 0 0 !important;"> Already registered? Sign In</a>
                              </div>

                              <div  id="otp">
                                 <h5 class="heading-design-h5">Validate Otp</h5>
                                 <?php if(Session::has('OtpError')): ?>
                                 <div class="alert alert-danger" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                    <?php echo session('OtpError'); ?>

                                 </div>
                                 <?php endif; ?>
                                 <form action = "<?php echo e(url('process-signup')); ?>" method = "POST">
                                    <?php echo csrf_field(); ?>
                                    <fieldset class="form-group">
                                       <label>Enter Otp</label>
                                       <input name="signup_otp" type="text" placeholder="Enter OTP" class="form-control" required>
                                    </fieldset>
                                 
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Submit</button>
                                    </fieldset>
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


<div class="modal fade login-modal-main" id="bx-example-modal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                     <form>
                        <div class="login-modal-right">
                           <div class="tab-content">
                              <div class="tab-pane active" role="tabpanel">
                                 <h5 class="heading-design-h5">Track Your Order</h5>
                                 <fieldset class="form-group">
                                    <label>Your Email</label>
                                    <input type="text" class="form-control" placeholder="+91 123 456 7890">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <label>Your Order No</label>
                                    <input type="text" class="form-control" placeholder="+91 123 456 7890">
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <button type="submit" class="btn btn-lg btn-secondary btn-block">Track Order</button>
                                 </fieldset>
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

<div class="modal fade login-modal-main" id="otp-example-modal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                        <div class="login-modal-right">
                           <div class="tab-content">
                              <div class="tab-pane active" role="tabpanel">
                                 <h5 class="heading-design-h5">Verify OTP</h5>
                                 <?php if(session()->has('otp_error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('otp_error')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session()->has('otp_success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('otp_success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <form action="<?php echo e(url('forgetPasswordOtpVerify')); ?>" method="POST">
                                       <?php echo csrf_field(); ?>
                                    <input type="hidden" id="otp_user_id" name="user_id" >
                                    <fieldset class="form-group">
                                       <label>Enter OTP</label>
                                       <input type="text" name="f_pass_otp" class="form-control" placeholder="Enter OTP" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Verify</button>
                                    </fieldset>
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

<div class="modal fade login-modal-main" id="change-password-modal">
   <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="login-modal">
               <div class="row">
                  <div class="col-lg-12 pad-left-0">
                     <button type="button" class="close close-top-right" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                     <span class="sr-only">Close</span>
                     </button>
                        <div class="login-modal-right">
                           <div class="tab-content">
                              <div class="tab-pane active"  role="tabpanel">
                                 <h5 class="heading-design-h5">Update new password</h5>
                                 
                                 <?php if(session()->has('up_password_error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('up_password_error')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session()->has('up_password_success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('up_password_success')); ?>

                                        </div>
                                    <?php endif; ?>
                                 <form action = "<?php echo e(url('processPassword')); ?>" method = "POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" id="cp_user_id" name="user_id" >
                                    <fieldset class="form-group">
                                       <label>New Password</label>
                                       <input name="password" type="password" class="form-control" placeholder="********" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <label>Confirm Password</label>
                                       <input name="confirm_password" type="password" class="form-control" placeholder="********" required>
                                    </fieldset>
                                    <fieldset class="form-group">
                                       <button type="submit" class="btn btn-lg btn-secondary btn-block">Verify</button>
                                    </fieldset>
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

<script type="text/javascript">

   $(document).ready(function(){

   		<?php if(Session::get('sellSuccess')){ ?>
   			$('#sellOnSuccessModal').modal('show');
   		<?php } ?>

      $('#headerSearchBttn').click(function(){

         var headerDropCatSelect = $('.headerDropCatSelect').val();
         var headerSearchFld = $('#headerSearchFld').val();
         //alert(headerDropCatSelect+'  '+headerSearchFld);
         var qUrl = ""
         var base_url = '<?php echo url('/'); ?>';

         qUrl = '/shop?page=&limit=&search='+headerSearchFld+'&type=&category='+headerDropCatSelect+'&price=&today_deal=&best_seller=';
        
         var joinUrl = base_url+qUrl
         window.location.assign(joinUrl);

      });

   });
   
</script><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/common/header.blade.php ENDPATH**/ ?>