<?php $__env->startSection('content'); ?>

   <?php
    if(Session::has('supportUserDetails')){
      $current_user_details = Session::get('supportUserDetails');
      $current_user_type = $current_user_details['user_type'];
    }else{
      $current_user_type = '';
    }
  ?>

	<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;">Shop</a>
               </div>
            </div>
         </div>
      </section>
      <section class="shop-list section-padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-3">
                  <div class="card mb-2">
                     <div class="card-header">
                        <h6>Filter by Price</h6>
                     </div>
                     <div class="product-bar">
  
                      <?php
                        
                          $minVal = 0;
                          $maxVal = $result['filters']['maxPrice'];
                        
                      ?>
                        
                        <input type="text" id="amount" readonly="" value="<?php echo e($minVal); ?>-<?php echo e($maxVal); ?>">
                        <input type="hidden" id="amountRangeHidden" >
                        <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                           <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                           <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                     </div>
                  </div>
                  <div class="card mb-2">
                     <div class="card-header">
                        <h6>Filter by Categories</h6>
                     </div>
                     <div class="product-bar">
                        
                        <div class="product-bar-content">
                           <div id="jquery-accordion-menu" class="jquery-accordion-menu">
                              <?php print_r($result['option']); ?>
                              
                           </div>
                           
                           
                           
                        </div>
                     </div>
                     
                  </div>

                  <form enctype="multipart/form-data" name="filters" id="test" method="get">

                    <input type="hidden" name="page" value="<?php echo e(app('request')->input('page')); ?>">
                    
                    <input type="hidden" name="limit" value="<?php echo e(app('request')->input('limit')); ?>">
                    
                    <input type="hidden" name="search" value="<?php echo e(app('request')->input('search')); ?>">
                    
                    <input type="hidden" name="type" value="<?php echo e(app('request')->input('type')); ?>">
                    
                    <input type="hidden" name="category" value="<?php echo e(app('request')->input('category')); ?>">
                    
                    <input type="hidden" name="price" value="<?php echo e(app('request')->input('price')); ?>">
                    
                    <input type="hidden" name="today_deal" value="<?php echo e(app('request')->input('today_deal')); ?>">
                    
                    <input type="hidden" name="best_seller" value="<?php echo e(app('request')->input('best_seller')); ?>">
                    

                    <?php if(app('request')->input('filters_applied')==1): ?>
                      <input type="hidden" name="filters_applied" id="filters_applied" value="1">
                      <input type="hidden" name="options" id="options" value="<?php echo implode(',',$result['filter_attribute']['options'])?>">
                      <input type="hidden" name="options_value" id="options_value" value="<?php echo implode(',',$result['filter_attribute']['option_values'])?>">
                    <?php else: ?>
                      <input type="hidden" name="filters_applied" id="filters_applied" value="0">
                    <?php endif; ?>

                    <?php if(count($result['filters']['attr_data'])>0): ?>
                      <?php $__currentLoopData = $result['filters']['attr_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attr_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="color-range-main">
                          <h2 <?php if(count($result['filters']['attr_data'])==$key+1): ?> last <?php endif; ?>><?php echo e($attr_data['option']['name']); ?></h2>
                          <div class="block">
                            <div class="card-body">
                              <ul class="list" style="list-style:none; padding: 0px;">
                                <?php $__currentLoopData = $attr_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li >
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input class="form-check-input filters_box" name="<?php echo e($attr_data['option']['name']); ?>[]" type="checkbox" value="<?php echo e($values['value']); ?>"                                   <?php
                                         if(!empty($result['filter_attribute']['option_values']) and in_array($values['value_id'],$result['filter_attribute']['option_values'])) print 'checked';
                                         ?>>
                                         <?php echo e($values['value']); ?>

                                      </label>
                                    </div>
                                  </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </ul>
                            </div>
                          </div>
    
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </form>


                  <div class="card mb-2">
                    <div class="left-ad">
                      <img class="img-fluid" src="<?php echo e(asset('frontEnd/images/01.jpg')); ?>" alt="">
                    </div>
                  </div>
                  
               </div>
               <div class="col-md-9">
                  <a href="javascript:;"><img class="img-fluid mb-3" src="<?php echo e(asset('frontEnd/images/shop.jpg')); ?>" alt=""></a>
                  <div class="shop-head">
                     
                     <div class="btn-group float-right mb-2">
                        <div class="toolbar toolbar-products">
                            <div class="toolbar-sorter sorter">
                                <label class="sorter-label" for="sorter">Sort By</label>
                                <select id="sorter" data-role="sorter" class="sorter-options" onchange="selectSortBy(this.value)" >
                                    <option value=""> Select Option </option>
                                    <option value="lowtohigh" <?php if(app('request')->input('type')=='lowtohigh'): ?> selected <?php endif; ?> >Price Low to High </option>
                                    <option value="hightolow" <?php if(app('request')->input('type')=='hightolow'): ?> selected <?php endif; ?> >Price High to Low </option>
                                    <option value="atoz" <?php if(app('request')->input('type')=='atoz'): ?> selected <?php endif; ?> >A-Z (Product name) </option>
                                    <option value="ztoa" <?php if(app('request')->input('type')=='ztoa'): ?> selected <?php endif; ?> >Z-A (Product name)  </option>
                                </select>
                            </div>
                        </div>
                     </div>
                     <h5 class="mb-3">Shop</h5>
                     
                     <?php if($errMessage = Session::get('stockOut')): ?>
                         <div class="alert alert-danger alert-block">
                           <button type="button" class="close" data-dismiss="alert">×</button> 
                           <strong><?php echo e($errMessage); ?></strong>
                         </div>
                       <?php endif; ?>

                  </div>
                  <div class="row no-gutters">

                  <?php if(count($result['products']['product_data'])>0): ?>
                  <?php $__currentLoopData = ($result['products']['product_data']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="col-md-3">
                        <div class="product">
                           <div class="product-header">
                              <div class="badges">
                                 <?php
                                  if ($current_user_type=='Corporate') {
                                    
                                    $userCategoryArray = $current_user_details->userCategoryArray;
                                    $productCategory = $product_data->categories;
                                    
                                    if (!empty($productCategory)) {
                                      $catCheck = 0;
                                      foreach ($productCategory as $key => $value) {
                                        if (in_array($value->categories_id, $userCategoryArray)) {
                                          $catCheck = 1;
                                        }
                                      }
                                      //echo $catCheck;
                                      if ($catCheck == 1) {
                                        $mPrc = $product_data->corporate_products_price;
                                      }else{
                                        $mPrc = $product_data->products_price;
                                      }
                                    }else{
                                      $mPrc = $product_data->products_price;
                                    }

                                  }else{
                                    $mPrc = $product_data->products_price;
                                  }
                                  $mrp = $product_data->mrp_price;
                                  $percent = (($mrp-$mPrc)/$mrp)*100;
                                  if($percent>0){
                                ?>
                                  <span class="badge badge-success secnd-color"><?php echo e((int)$percent); ?>% OFF</span>
                                <?php } ?>
                              </div>
                              <a href="<?php echo e(URL::to('/product-detail/'.$product_data->products_id)); ?>" target="_blank">
                                 <img class="img-fluid" src="<?php echo e(asset('').$product_data->image_path); ?>" alt="">
                              </a>
                              
                              <a href="javascript:void(0);" onclick="addWishList(<?php echo $product_data->products_id; ?>)">
                                 <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $product_data->products_id; ?> <?php echo $product_data->isLiked==1?'liked':''; ?>" ></span>
                              </a>


                           </div>
                           <div class="product-body">
                              <a href="<?php echo e(URL::to('/product-detail/'.$product_data->products_id)); ?>" target="_blank">
                                 <h5><?php echo e($product_data->products_name); ?> </h5>
                              </a>
                              <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                           </div>
                           <div class="product-footer">
                              <form action="<?php echo e(url('addToCart')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="products_id" value="<?php echo e($product_data->products_id); ?>" >
                                <input type="hidden" name="quantity" value="1" id="cartQuantity" >
                                <input type="hidden" name="prodDiscount" value="" id="cartDiscount" >

                                <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                              </form>
                              <p class="offer-price mb-0">
                                 ₹<?php echo $mPrc; ?>
                               <br><span class="regular-price">₹<?php echo e($product_data->mrp_price); ?></span></p>
                           </div>
                        </div>
                     </div>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>

                     

                  </div>
                  
                  <!-- <nav>
                     <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                           <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
                        <li class="page-item active">
                           <span class="page-link">
                              2
                              <span class="sr-only">(current)</span>
                           </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                        <li class="page-item">
                           <a class="page-link" href="javascript:;">Next</a>
                        </li>
                     </ul>
                  </nav> -->
               </div>
            </div>
         </div>
      </section>


   <script type="text/javascript">

    $(function() {

      $('input:checkbox.filters_box').change(function () {
        if ($('input:checkbox.filters_box:checked').length > 0) {
          $('#filters_applied').val(1);
          $('#apply_options_btn').removeAttr('disabled');          
        } else {
          $('#filters_applied').val(0);
          $('#apply_options_btn').attr('disabled',true);
        }
        $('#test').submit();
      });
      
      //jQuery('#load_products_form').submit();
      

    });

      $(function() {

         <?php if(app('request')->input('price')!=''){ ?>
            var pVal = '<?php echo app('request')->input('price'); ?>';
            var minVal = pVal.split("-")[0];
            var maxVal = pVal.split("-")[1];
         <?php }else{ ?>
            var minVal = 0;
            var maxVal = <?php if($result['filters']['maxPrice']){echo $result['filters']['maxPrice'];}else{echo '20000';} ?>;
         <?php } ?>
         //alert(minVal);
         $("#slider-range").slider({
             range: true,
             min: 0,
             max: <?php if($result['filters']['maxPrice']){echo $result['filters']['maxPrice'];}else{echo '20000';} ?>,
             values: [minVal, maxVal],
             slide: function(event, ui) {
                 $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                 $("#amountRangeHidden").val(ui.values[0] + "-" + ui.values[1]);
             }
         });
         $("#amount").val("₹" + $("#slider-range").slider("values", 0) + " - ₹" + $("#slider-range").slider("values", 1));



         $( "#slider-range" ).on( "slidechange", function( event, ui ) {
            //alert($("#amountRangeHidden").val());
               var price = $("#amountRangeHidden").val();
               var qUrl = ""
               var current_url = window.location.href;
               var base_url = current_url.split("?")[0];
               var hashes = current_url.split("?")[1];
               var hash = hashes.split('&');
               for (var i = 0; i < hash.length; i++) {
                  params=hash[i].split("=");
                  if (params[0]=='price') {
                     params[1] = price;
                  }
                  paramJoin=params.join("="); 
                  qUrl = ""+qUrl+paramJoin+"&";   
               }
               if (qUrl!='') {
                  qUrl = qUrl.substr(0, qUrl.length - 1);
               }
              
               var joinUrl = base_url+"?"+qUrl
               //alert("My favourite sports are: " + joinUrl);
               window.location.assign(joinUrl);

         });

     });

      function selectSortBy(sort_val){
           //alert(sort_val);
           var qUrl = ""
           var current_url = window.location.href;
           var base_url = current_url.split("?")[0];
           var hashes = current_url.split("?")[1];
           var hash = hashes.split('&');
           for (var i = 0; i < hash.length; i++) {
             params=hash[i].split("=");
             if (params[0]=='type') {
               params[1] = sort_val;
             }
             paramJoin=params.join("="); 
             qUrl = ""+qUrl+paramJoin+"&";   
           }
           if (qUrl!='') {
             qUrl = qUrl.substr(0, qUrl.length - 1);
           }
           
           var joinUrl = base_url+"?"+qUrl
           //alert("My favourite sports are: " + joinUrl);
           window.location.assign(joinUrl);
       }
      
   </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/shop.blade.php ENDPATH**/ ?>