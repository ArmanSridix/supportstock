<header id="headerMobile" class="header-area header-mobile d-lg-none d-xl-none">
    <div class="header-mini bg-top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12">

            <nav id="navbar_0" class="navbar navbar-expand-md navbar-dark navbar-0">
              <div class="navbar-lang">

                <?php if(count($languages) > 1): ?>
                
                <div class="select-control">
                  <select class="form-control" onchange="myFunction1(this.options[this.selectedIndex].value)" >
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($language->languages_id); ?>" <?php if(Session::get('language_id')==$language->languages_id): ?> selected <?php endif; ?>><?php echo e($language->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <?php echo $__env->make('web.common.scripts.changeLanguage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                
                <?php if(count($currencies) > 1): ?>
                <div class="select-control currency" >
                  <select class="form-control " onchange="myFunction2(this.options[this.selectedIndex].value)">
                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php if(session('currency_title')==$currency->code): ?> selected <?php endif; ?> value="<?php echo e($currency->id); ?>">
                    
                    <?php echo e($currency->code); ?>

                      <?php if($currency->symbol_left != null): ?>
                      (<?php echo e($currency->symbol_left); ?>)</span>
                      <?php else: ?>
                      (<?php echo e($currency->symbol_right); ?>)
                      <?php endif; ?>
                      
                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select> 
                </div>
                <?php endif; ?>
                    <!-- END  Currency LANGUAGE CODE SECTION -->                
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="header-maxi bg-header-bar ">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-2 pr-0">
              <div class="navigation-mobile-container">
                  <a href="javascript:void(0)" class="navigation-mobile-toggler">
                      <span class="fas fa-bars"></span>
                  </a>
                  <nav id="navigation-mobile">
                      <div class="logout-main">
                          <div class="welcome">
                            <span><?php if(auth()->guard('customer')->check()){ ?><?php echo app('translator')->get('website.Welcome'); ?> <?php echo e(auth()->guard('customer')->user()->first_name); ?>&nbsp;! <?php }?> </span>
                          </div>
                          <?php if(auth()->guard('customer')->check()): ?>
                          <div class="logout">
                              <a href="<?php echo e(url('logout')); ?>" class=""><?php echo app('translator')->get('website.Logout'); ?></a>
                          </div>
                          <?php endif; ?>
                      </div>

                      <?php echo $result['commonContent']["menusRecursiveMobile"]; ?>

                     
                      <?php if(auth()->guard('customer')->check()){ ?>
                       <a href="<?php echo e(url('profile')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Profile'); ?></a>
                       <a href="<?php echo e(url('wishlist')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Wishlist'); ?><span class="total_wishlist"> (<?php echo e($result['commonContent']['total_wishlist']); ?>)</span></a>
                       <a href="<?php echo e(url('compare')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Compare'); ?>&nbsp;(<span id="compare"><?php echo e($count); ?></span>)</a>
                       <a href="<?php echo e(url('orders')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Orders'); ?></a>
                       <a href="<?php echo e(url('shipping-address')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Shipping Address'); ?></a>
                       <a href="<?php echo e(url('logout')); ?>" class="main-manu btn btn-primary"><?php echo app('translator')->get('website.Logout'); ?></a>
                      <?php }else{ ?>
                        <div class="nav-link"><?php echo app('translator')->get('website.Welcome'); ?>!</div>
                         <a href="<?php echo e(URL::to('/login')); ?>" class="main-manu btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<?php echo app('translator')->get('website.Login/Register'); ?></a>
                       <?php } ?>
                  </nav>
              </div>

          </div>



          <div class="col-8">
            <a href="<?php echo e(URL::to('/')); ?>" class="logo">
              <?php if($result['commonContent']['settings']['sitename_logo']=='name'): ?>
              <?=stripslashes($result['commonContent']['settings']['website_name'])?>
              <?php endif; ?>

              <?php if($result['commonContent']['settings']['sitename_logo']=='logo'): ?>
              <img class="img-fluid" src="<?php echo e(asset('').$result['commonContent']['settings']['website_logo']); ?>" alt="<?=stripslashes($result['commonContent']['settings']['website_name'])?>">
              <?php endif; ?>
           </a>
          </div>

          <div class="col-2 pl-0">              
              <ul class="pro-header-right-options" id="resposive-header-cart">
                <?php echo $__env->make('web.headers.cartButtons.cartButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </ul> 
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php echo $__env->make('web.common.HeaderCategories2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="header-navbar bg-menu-bar">
      <div class="container">
        <form class="form-inline" action="<?php echo e(URL::to('/shop')); ?>" method="get">
          <div class="search">
            <div class="select-control">
              <select class="form-control" name="category">
                <?php productCategories2(); ?>
              </select>
            </div>
            <input  type="search" name="search" placeholder="<?php echo app('translator')->get('website.Search entire store here'); ?>..."  value="<?php echo e(app('request')->input('search')); ?>">
            <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
</header>
<?php /**PATH D:\xampp\htdocs\adminpanel\resources\views/web/headers/mobile.blade.php ENDPATH**/ ?>