<?php $__env->startSection('content'); ?>

<style>
   * {box-sizing: border-box;}
   .img-zoom-container {
   position: relative;
   }
   .img-zoom-lens {
   position: absolute;
   border: 1px solid #d4d4d4;
   /*set the size of the lens:*/
   width: 40px;
   height: 40px;
   }
   .img-zoom-result {
   border: 1px solid #d4d4d4;
   /*set the size of the result div:*/
   width: 300px;
   height: 300px;
   }
</style>

<?php
    if(Session::has('supportUserDetails')){
      $current_user_details = Session::get('supportUserDetails');
      $current_user_type = $current_user_details['user_type'];
    }else{
      $current_user_type = '';
    }
  ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;"><?php echo e($result['detail']['product_data'][0]->products_name); ?></a> <!-- <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> AirConditioner Spares </a> -->
           </div>
        </div>
     </div>
  </section>

  <?php if($errMessage = Session::get('stockOut')): ?>
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong><?php echo e($errMessage); ?></strong>
    </div>
  <?php endif; ?>

  <?php if($errMessage = Session::get('reviewError')): ?>
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong><?php echo e($errMessage); ?></strong>
    </div>
  <?php endif; ?>

  <?php if($errMessage = Session::get('reviewSuccess')): ?>
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong><?php echo e($errMessage); ?></strong>
    </div>
  <?php endif; ?>


  <section class="shop-single section-padding pt-3">
     <div class="container-fluid">
        <div class="row">
           <div class="col-md-4">
              
              
              
              <div class="shop-detail-left">
                 <div class="containers">
                    <div class="exzoom hidden" id="exzoom">
                       <div class="exzoom_img_box">
                          <ul class='exzoom_img_ul'>
                             <li><img src="<?php echo e(asset('').$result['detail']['product_data'][0]->image_path); ?>"/></li>
                             <!-- <li><img src="<?php echo e(asset('frontEnd/images/item/1.jpg')); ?>"/></li>
                             <li><img src="<?php echo e(asset('frontEnd/images/item/9.jpg')); ?>"/></li>
                             <li><img src="<?php echo e(asset('frontEnd/images/item/10.jpg')); ?>"/></li>
                             <li><img src="<?php echo e(asset('frontEnd/images/item/6.jpg')); ?>"/></li> -->
                             
                          </ul>
                       </div>
                       <div class="exzoom_nav"></div>
                       <p class="exzoom_btn">
                          <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                          <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                       </p>
                    </div>
                 </div>
                 
              </div>
           </div>
           <div class="col-md-5 p-1">
              <div class="shop-detail-right">
                 
                 <h2><?php echo e($result['detail']['product_data'][0]->products_name); ?></h2>

                  <?php if($result['detail']['product_data'][0]->products_sku){ ?>
                    <h6><strong><span class="mdi mdi-approval"></span> SKU no</strong> - <?php echo e($result['detail']['product_data'][0]->products_sku); ?></h6>
                  <?php } ?>

                 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - <?php echo e($result['detail']['product_data'][0]->products_weight); ?> <?php echo e($result['detail']['product_data'][0]->products_weight_unit); ?></h6>
                
              
                 
                
                 <div class="short-description mt-3">
                    <h5>
                    Quick Overview
                    <p class="float-right">Availability:
                      <?php if($result['detail']['product_data'][0]->defaultStock>0){ ?>
                        <span class="badge badge-success">In Stock</span>
                      <?php }else{ ?>
                        <span class="badge badge-danger">Out Of Stock</span>
                      <?php } ?>
                    </p>
                    </h5>
                    <p>
                      <?php
                      $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
                      $descriptions = substr($descriptions,0,100);
                      echo stripslashes($descriptions);
                      ?>
                    ....<span><a href="#DescriptionDiv" class="scrollTo">See more</a></span></p>
                   
                 </div>


                <?php if(count($result['detail']['product_data'][0]->attributes)>0): ?>
                  <div class="pro-options row">
                  <?php
                      $index = 0;
                  ?>
                    <?php $__currentLoopData = $result['detail']['product_data'][0]->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $functionValue = 'function_'.$key++;
                    ?>
                    <input type="hidden" name="option_name[]" value="<?php echo e($attributes_data['option']['name']); ?>" >
                    <input type="hidden" name="option_id[]" value="<?php echo e($attributes_data['option']['id']); ?>" >
                    <input type="hidden" name="<?php echo e($functionValue); ?>" id="<?php echo e($functionValue); ?>" value="0" >
                    <input id="attributeid_<?=$index?>" type="hidden" value="">
                    <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                    <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
                    
                      <div class="attributes col-12 col-md-4 box">
                          <label class=""><?php echo e($attributes_data['option']['name']); ?></label>
                          <div class="select-control">
                          <select name="<?php echo e($attributes_data['option']['id']); ?>" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "<?php echo e($attributes_data['option']['id']); ?>">
                            <?php if(!empty($result['cart'])): ?>
                              <?php
                                $value_ids = array();
                                foreach($result['cart'][0]->attributes as $values){
                                    $value_ids[] = $values->options_values_id;
                                }
                              ?>
                                <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if(!empty($result['cart'])): ?>
                                  <option <?php if(in_array($values_data['id'],$value_ids)): ?> selected <?php endif; ?> attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </select>
                          </div> 
                        </div>                 
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <?php endif; ?>



                  <h6 class="mb-3 mt-4">Check serviceability at your Pincode:</h6>
                  <form class="cart__coupon-form mt-3" style="width: 100%;">

                    <label for="input-coupon-code" class="sr-only"></label> <input type="text" class="form-control" id="input-coupon-code" placeholder="Enter your Pincode"> <button type="submit" class="btn btn-secondary">Check</button>
                  </form>

              <?php if(!empty($result['detail']['product_data'][0]->sellerDetails)){ ?>
                <h6 class="mb-3 mt-4">Seller Info :</h6>

                <div class="row">
                  <div class="col-md-4">
                    <div class="feature-box">
                      <h6 class="text-info">Name</h6>
                      <p class="seller-name"><?php echo e($result['detail']['product_data'][0]->sellerDetails[0]->manufacturer_name); ?></p>
                      <p class="seller-phone"><?php echo e($result['detail']['product_data'][0]->sellerDetails[0]->seller_phone); ?></p>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <?php if($result['detail']['product_data'][0]->sellerDetails[0]->seller_address!=''){ ?>
                    <div class="feature-box">
                      <h6 class="text-info">Address</h6>
                      <p><?php echo e($result['detail']['product_data'][0]->sellerDetails[0]->seller_address); ?></p>
                    </div>
                    <?php } ?>
                  </div>
                </div>

              <?php }else{ ?>
                <br>
              <?php } ?>

                <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons"></div>
                <!-- ShareThis END -->
                 
              </div>
           </div>
           <div class="col-md-3">
              <div class="left-side-tabs">

                 <div class="price-dtls mt-2">
                    <h2 class="price1 mb-3"> 
                      <?php
                        if ($current_user_type=='Corporate') {
                          
                          $userCategoryArray = $current_user_details->userCategoryArray;
                          $productCategory = $result['detail']['product_data'][0]->categories;
                          
                          if (!empty($productCategory)) {
                            $catCheck = 0;
                            foreach ($productCategory as $key => $value) {
                              if (in_array($value->categories_id, $userCategoryArray)) {
                                $catCheck = 1;
                              }
                            }
                            //echo $catCheck;
                            if ($catCheck == 1) {
                              $mPrc = $result['detail']['product_data'][0]->corporate_products_price;
                            }else{
                              $mPrc = $result['detail']['product_data'][0]->products_price;
                            }
                          }else{
                            $mPrc = $result['detail']['product_data'][0]->products_price;
                          }

                        }else{
                          $mPrc = $result['detail']['product_data'][0]->products_price;
                        }
                        $mrp = $result['detail']['product_data'][0]->mrp_price;
                        $percent = (($mrp-$mPrc)/$mrp)*100;
                      ?>

                      ₹<?php echo $mPrc; ?>
                       <span>(GST inclusive price)</span></h2>

                      <?php
                        if($percent>0){
                      ?>
                        <span class="badge badge-success"><?php echo e((int)$percent); ?>% OFF</span>
                      <?php } ?>

                    <p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : ₹<?php echo e($result['detail']['product_data'][0]->mrp_price); ?></p>

                 </div>

                 <div class="price-qnty mt-2 pb-3 pt-3">
                     <div class="input-number">
                          <input class="form-control input-number__input" type="number" min="1" value="1" readonly="" />
                          <div class="input-number__add"></div>
                          <div class="input-number__sub"></div>
                       </div>
                 </div>

                 <?php if(count($result['detail']['product_data'][0]->BulkPriceList)>0): ?>

                 <h6 class="mb-3 mt-3">Bulk quantity Discounts!! </h6> 

                 <div style="display: none;text-align: right;" id="clearSelectionDiv">
                   <a href="javascript:void(0);" onclick="clearSelection()">
                     Clear Selection
                   </a>
                 </div>                
                 
                 <table class="table table-responsive mt-2" >
                    <thead>
                       <tr>
                          <th>Select</th>
                          <th>Quantity</th>
                          <th>Discount</th>
                          <th>Price per piece</th>
                       </tr>
                    </thead>
                    <tbody>
                       <form>

                        <?php $bulkId = 1; ?>

                        <?php $__currentLoopData = ($result['detail']['product_data'][0]->BulkPriceList); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $BulkPriceList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                          <tr>
                             <td>
                                <div class="radio">
                                  <?php
                                    $check = '';
                                    if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity!='') {
                                      if ($BulkPriceList->minimum_quantity<=1 && $BulkPriceList->maximum_quantity>=1) {
                                        $check = 'checked';
                                      }
                                    }else if ($BulkPriceList->minimum_quantity=='' && $BulkPriceList->maximum_quantity!='') {
                                      if ($BulkPriceList->maximum_quantity>=1) {
                                        $check = 'checked';
                                      }
                                    }else if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity=='') {
                                      if ($BulkPriceList->minimum_quantity<=1) {
                                        $check = 'checked';
                                      }
                                    }else{
                                      $check = 'checked';
                                    }
                                  ?>
                                   <label><input type="radio" id='regular_<?php echo $bulkId; ?>' name="optradio" onclick="bulkSelect('<?php echo $BulkPriceList->minimum_quantity; ?>','<?php echo $BulkPriceList->maximum_quantity; ?>','<?php echo $BulkPriceList->discount_rate; ?>');" <?php echo $check; ?> ></label>
                                </div>
                             </td>
                             <td>
                                <div class="radiotext">
                                  <label for='regular'>
                                    <?php
                                      if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity!='') {
                                        echo $BulkPriceList->minimum_quantity." - ".$BulkPriceList->maximum_quantity;
                                      }else if ($BulkPriceList->minimum_quantity=='' && $BulkPriceList->maximum_quantity!='') {
                                        echo $BulkPriceList->maximum_quantity;
                                      }else if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity=='') {
                                        echo $BulkPriceList->minimum_quantity."+";
                                      }else{
                                        echo "1+";
                                      }
                                    ?>
                                  </label>
                                </div>
                             </td>
                              <td>
                                <div class="radiotext">
                                   <label for='regular'><?php echo e($BulkPriceList->discount_rate); ?>%</label>
                                </div>
                             </td>
                              <td>
                                <div class="radiotext">
                                  <?php
                                    if ($current_user_type=='Corporate') {
                                      $pPrice = $result['detail']['product_data'][0]->corporate_products_price;
                                    }else{
                                      $pPrice = $result['detail']['product_data'][0]->products_price;
                                    }

                                    $discountPrice = ($pPrice*$BulkPriceList->discount_rate)/100;
                                    $finalPrice = $pPrice-$discountPrice;
                                  ?>
                                   <label for='regular'>₹<?php echo e($finalPrice); ?></label>
                                </div>
                             </td>
                          </tr>

                          <?php $bulkId++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                       </form>
                    </tbody>
                  </table>

                  <div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#moreThanTenModal">
                      More than 10 quantities? Get customized price
                    </a>
                  </div>

                  <?php endif; ?>

                  <form action="<?php echo e(url('addToCart')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="products_id" value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>" >
                    <input type="hidden" name="quantity" value="1" id="cartQuantity" >
                    <input type="hidden" name="prodDiscount" value="" id="cartDiscount" >

                    <button type="submit" class="btn btn-secondarygreen btn-lg w-100 mt-3 bg-success"> Buy Now</button>

                    <button type="submit" class="btn btn-secondary btn-lg w-100 mt-3"> Add To Cart</button>

                  </form>

                  <!-- <a href="checkout.html"><div type="button" class="btn btn-secondarygreen btn-lg w-100 mt-3 bg-success"> Buy Now</div> </a>

                  <a href="checkout.html"><div type="button" class="btn btn-secondary btn-lg w-100 mt-3"> Add To Cart</div> </a> -->
                 
                 
              </div>
           </div>
        </div>
     </div>
  </section>

<?php $reviewCount = count($result['detail']['product_data'][0]->reviewed_customers); ?>

<section class="section-padding pt-3" id="DescriptionDiv">
     <div class="container-fluid">
  <div class="row">
     <div class="col-12">
           <div class="tab-style3">
           <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                 <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                    </li>
                    <!-- <li class="nav-item">
                       <a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                    </li> -->
                    <li class="nav-item">
                       <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews <?php echo $reviewCount>0?"(".$reviewCount.")":""; ?> </a>
                    </li>
                </ul>
              <div class="tab-content shop_info_tab mt-4">
                    <div class="tab-pane fade active show" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                      
                      <?=stripslashes($result['detail']['product_data'][0]->products_description)?>

                    </div>

                    <!-- <div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                       <table class="table table-bordered">
                          <tbody><tr>
                             <td>Capacity</td>
                             <td>5 Kg</td>
                          </tr>
                            <tr>
                                <td>Color</td>
                                <td>Black, Brown, Red,</td>
                            </tr>
                            <tr>
                                <td>Water Resistant</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td>Artificial Leather</td>
                            </tr>
                       </tbody></table>
                    </div> -->


                    <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">

                      <?php if($reviewCount>0){ ?>
                      <div class="comments">
                        <h5 class="product_tab_title"><?php echo e($reviewCount); ?> Review For <span><?php echo e($result['detail']['product_data'][0]->products_name); ?></span></h5>
                        <ul class="list_none comment_list mt-4">

                          <?php $__currentLoopData = $result['detail']['product_data'][0]->reviewed_customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$rev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                            <div class="comment_img">
                              <img src="<?php echo e(asset('frontEnd/images/dummy.jpg')); ?>" alt="user1">
                            </div>
                            <div class="comment_block">
                              <div class="rating_wrap">
                                  <div class="rating">
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 1?"checked":""; ?> "></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 2?"checked":""; ?> "></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 3?"checked":""; ?> "></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 4?"checked":""; ?> "></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 5?"checked":""; ?> "></span>
                                  </div>
                              </div>
                              <p class="customer_meta">
                                <span class="review_author"><?php echo e($rev->customers_name); ?></span>
                                <span class="comment-date"><?php echo e(date("F j, Y", strtotime($rev->created_at))); ?></span>
                              </p>
                              <div class="description">
                                <p><?php echo e($rev->reviews_text); ?></p>
                              </div>
                            </div>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </ul>
                      </div>
                      <?php } ?>

                      <div class="review_form field_form">
                          <h5>Add a review</h5>
                          <form class="row mt-3" action="<?php echo e(url('reviews')); ?>" method="POST" enctype="multipart/form-data" >
                            <?php echo csrf_field(); ?>

                            <input value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>" type="hidden" name="products_id">

                              <div class="form-group col-12">
                                <div class="ratings">

                                  <div class="starrating risingstar d-flex justify-content-end flex-row-reverse">
                                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
                                  </div>                                 

                                </div>
                              </div>
                              <div class="form-group col-12">
                                  <textarea required="required" placeholder="Your review *" class="form-control" name="reviews_text" rows="4"></textarea>
                              </div>
                              <!-- <div class="form-group col-md-6">
                                  <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                               </div>
                              <div class="form-group col-md-6">
                                  <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                              </div> -->
                             
                              <div class="form-group col-12">
                                  <button type="submit" class="btn btn-secondary btn-lg mt-3" name="submit" value="Submit">Submit Review</button>
                              </div>
                          </form>
                      </div>
                    </div>


              </div>
            </div>
        </div>
    </div>
     </div>
  </section>

  <section class="product-items-slider section-padding">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="section-header">
                <h5 class="heading-design-h5">Recently Added Products 
                
                </h5>
             </div>
             <div class="owl-carousel owl-carousel-deals owl-theme">

              <?php if(count($result['recentProducts']['product_data'])>0): ?>
              <?php $__currentLoopData = ($result['recentProducts']['product_data']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentProducts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                   <div class="product">
                      <div class="product-header">
                         <div class="badges">
                          <?php
                            if ($current_user_type=='Corporate') {
                              $mPrc = $recentProducts->corporate_products_price;
                            }else{
                              $mPrc = $recentProducts->products_price;
                            }
                            $mrp = $recentProducts->mrp_price;
                            $percent = (($mrp-$mPrc)/$mrp)*100;
                            if($percent>0){
                          ?>
                            <span class="badge badge-success secnd-color"><?php echo e((int)$percent); ?>% OFF</span>
                          <?php } ?>
                         </div>
                         <a href="<?php echo e(URL::to('/product-detail/'.$recentProducts->products_id)); ?>" target="_blank">
                            <img class="img-fluid" src="<?php echo e(asset('').$recentProducts->image_path); ?>" alt="">
                         </a>

                          <a href="javascript:void(0);" onclick="addWishList(<?php echo $recentProducts->products_id; ?>)">
                            <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $recentProducts->products_id; ?> <?php echo $recentProducts->isLiked==1?'liked':''; ?>" ></span>
                          </a>

                      </div>
                      <div class="product-body">
                         <a href="<?php echo e(URL::to('/product-detail/'.$recentProducts->products_id)); ?>" target="_blank">
                            <h5><?php echo e($recentProducts->products_name); ?> </h5>
                         </a>
                         <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                      </div>
                      <div class="product-footer">

                        <form action="<?php echo e(url('addToCart')); ?>" method="POST" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>

                          <input type="hidden" name="products_id" value="<?php echo e($recentProducts->products_id); ?>" >
                          <input type="hidden" name="quantity" value="1" id="cartQuantity" >
                          <input type="hidden" name="prodDiscount" value="" id="cartDiscount" >

                          <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                        </form>

                         <p class="offer-price mb-0">
                          ₹<?php echo $current_user_type=='Corporate'?$recentProducts->corporate_products_price:$recentProducts->products_price; ?>
                          
                          <br><span class="regular-price">₹<?php echo e($recentProducts->mrp_price); ?></span></p>
                      </div>
                   </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

                
             </div>
          </div>
       </div>
    </div>
  </section>

  <section class="product-items-slider section-padding">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="section-header">
                <h5 class="heading-design-h5">Trending Products
                
                </h5>
             </div>
             <div class="owl-carousel owl-carousel-deals owl-theme">

              <?php if(count($result['simliar_trending_products']['product_data'])>0): ?>
              <?php $__currentLoopData = ($result['simliar_trending_products']['product_data']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $simliar_trending_products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                   <div class="product">
                      <div class="product-header">
                         <div class="badges">
                          <?php
                            if ($current_user_type=='Corporate') {
                              $mPrc = $simliar_trending_products->corporate_products_price;
                            }else{
                              $mPrc = $simliar_trending_products->products_price;
                            }
                            $mrp = $simliar_trending_products->mrp_price;
                            $percent = (($mrp-$mPrc)/$mrp)*100;
                            if($percent>0){
                          ?>
                            <span class="badge badge-success secnd-color"><?php echo e((int)$percent); ?>% OFF</span>
                          <?php } ?>
                         </div>
                         <a href="<?php echo e(URL::to('/product-detail/'.$simliar_trending_products->products_id)); ?>" target="_blank">
                            <img class="img-fluid" src="<?php echo e(asset('').$simliar_trending_products->image_path); ?>" alt="">
                         </a>

                          <a href="javascript:void(0);" onclick="addWishList(<?php echo $simliar_trending_products->products_id; ?>)">
                            <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $simliar_trending_products->products_id; ?> <?php echo $simliar_trending_products->isLiked==1?'liked':''; ?>" ></span>
                          </a>

                      </div>
                      <div class="product-body">
                         <a href="<?php echo e(URL::to('/product-detail/'.$simliar_trending_products->products_id)); ?>" target="_blank">
                            <h5><?php echo e($simliar_trending_products->products_name); ?> </h5>
                         </a>
                         <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                      </div>
                      <div class="product-footer">

                        <form action="<?php echo e(url('addToCart')); ?>" method="POST" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>

                          <input type="hidden" name="products_id" value="<?php echo e($simliar_trending_products->products_id); ?>" >
                          <input type="hidden" name="quantity" value="1" id="cartQuantity" >
                          <input type="hidden" name="prodDiscount" value="" id="cartDiscount" >

                          <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                        </form>

                         <p class="offer-price mb-0">
                          ₹<?php echo $current_user_type=='Corporate'?$simliar_trending_products->corporate_products_price:$simliar_trending_products->products_price; ?>
                          
                          <br><span class="regular-price">₹<?php echo e($simliar_trending_products->mrp_price); ?></span></p>
                      </div>
                   </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

                
             </div>
          </div>
       </div>
    </div>
 </section>


  <!-- Modal -->
  <div id="moreThanTenModal" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
    <div class="modal-dialog category-area" role="document">
      <div class="category-area-inner">
        <div class="modal-header">
          <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="category-model-content modal-content">
          <div class="cate-header">
            <h4>Enter your requirement details</h4>
          </div>
          <div class="add-address-form">
            <div class="checout-address-step">
              <div class="row">
                <div class="col-lg-12">
                  <form class="" method="post" action="<?php echo e(url('addProductEnquiry')); ?>">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="enProductId" value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">
                    
                    <div class="address-fieldset">
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Name*</label>
                            <input id="" name="enName" type="text" placeholder="Enter your Name" class="form-control input-md" required>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Email*</label>
                            <input id="" name="enEmail" type="text" placeholder="Enter your email-id" class="form-control input-md" required>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Phone*</label>
                            <input id="" name="enPhone" type="text" placeholder="Enter your phone no" class="form-control input-md" required>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Locality*</label>
                            <select name="enCity" id="Locality" class="form-control input-md" required>
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
                            <select name="enPincode" id="pincode" class="form-control input-md" required>
                              <option value="">Select Pincode</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Select Quantity*</label>
                            </div>
                            <div class="col-md-6">
                              <div class="price-qnty mt-2 pb-3 pt-3">
                                <div class="input-number">
                                  <input class="form-control input-number__input2" type="number" min="11" value="11" name="enQuantity" readonly />
                                  <div class="input-number__add2"></div>
                                  <div class="input-number__sub2"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Expected price per piece*</label>
                            <input id="" name="enPrice" type="number" placeholder="Expected price per piece" class="form-control input-md" required>
                          </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group mb-0">
                            <div class="address-btns">
                              <button class="save-btn14 hover-btn">Submit</button>
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


  <script type="text/javascript">
      $('.containers').imagesLoaded( function() {
      $("#exzoom").exzoom({
      autoPlay: false,
      });
      $("#exzoom").removeClass('hidden')
      });
 </script>

 <script type="text/javascript">

  $(document).ready(function(){

    $(".scrollTo").on('click', function(e) {
       e.preventDefault();
       var target = $(this).attr('href');
       $('html, body').animate({
         scrollTop: ($(target).offset().top)
       }, 2000);
    });

    var qnty = $('.input-number__input').val();
    var BulkPriceList = <?php echo json_encode($result['detail']['product_data'][0]->BulkPriceList); ?>;
    //alert(qnty);
    if (BulkPriceList.length != 0) {
      var indx = 1;
      $('input[type=radio][name=optradio]').prop("checked", false);
      $('#cartDiscount').val('');

      $.each(BulkPriceList, function(val, text) {
        var minQnty = text.minimum_quantity;
        var maxQnty = text.maximum_quantity;
        var prodDiscount = text.discount_rate;

        if (minQnty!=null && maxQnty!=null) {
          if(qnty>=minQnty && qnty<=maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else if (minQnty==null && maxQnty!=null) {
          if(qnty==maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else if (minQnty!=null && maxQnty==null) {
          if(qnty>=minQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else{
          $('#regular_'+indx).prop("checked", true);
          $('#cartDiscount').val(prodDiscount);
        }

        indx = indx+1;
      });
    }

    $('.input-number__add').click(function(){
      var qnty = $('.input-number__input').val();
      var BulkPriceList = <?php echo json_encode($result['detail']['product_data'][0]->BulkPriceList); ?>;
      //alert(qnty);
      if (BulkPriceList.length != 0) {
        var indx = 1;
        $('input[type=radio][name=optradio]').prop("checked", false);
        $('#cartDiscount').val('');

        $.each(BulkPriceList, function(val, text) {
          var minQnty = text.minimum_quantity;
          var maxQnty = text.maximum_quantity;
          var prodDiscount = text.discount_rate;

          if (minQnty!=null && maxQnty!=null) {
            if(qnty>=minQnty && qnty<=maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else if (minQnty==null && maxQnty!=null) {
            if(qnty==maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else if (minQnty!=null && maxQnty==null) {
            if(qnty>=minQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else{
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }

          indx = indx+1;
        });
      }

      $('#cartQuantity').val(qnty);

      if (qnty>1) {
        $('#clearSelectionDiv').css('display','block');
      }else{
        $('#clearSelectionDiv').css('display','none');
      }

    });

    $('.input-number__sub').click(function(){
      var qnty = $('.input-number__input').val();
      var BulkPriceList = <?php echo json_encode($result['detail']['product_data'][0]->BulkPriceList); ?>;
      //alert(qnty);
      if (BulkPriceList.length != 0) {
        var indx = 1;
        $('input[type=radio][name=optradio]').prop("checked", false);
        $('#cartDiscount').val('');

        $.each(BulkPriceList, function(val, text) {
          var minQnty = text.minimum_quantity;
          var maxQnty = text.maximum_quantity;
          var prodDiscount = text.discount_rate;

          if (minQnty!=null && maxQnty!=null) {
            if(qnty>=minQnty && qnty<=maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else if (minQnty==null && maxQnty!=null) {
            if(qnty==maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else if (minQnty!=null && maxQnty==null) {
            if(qnty>=minQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
            }
          }else{
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }

          indx = indx+1;
        });
      }

      $('#cartQuantity').val(qnty);

      if (qnty>1) {
        $('#clearSelectionDiv').css('display','block');
      }else{
        $('#clearSelectionDiv').css('display','none');
      }

    });



    $('.input-number__add2').click(function(){
      var qnty = parseInt($('.input-number__input2').val());
      var addQty = qnty+1;
      if (addQty>=11) {
        $('.input-number__input2').val(addQty);
      }
    });

    $('.input-number__sub2').click(function(){
      var qnty = parseInt($('.input-number__input2').val());
      var subQty = qnty-1;
      if (subQty>=11) {
        $('.input-number__input2').val(subQty);
      }
    });

  });

  function bulkSelect(minimum_quantity,maximum_quantity,discount_rate){
    var crtQnt = 1;
    if (minimum_quantity!='' && maximum_quantity!='') {
      crtQnt = minimum_quantity;
    }else if (minimum_quantity=='' && maximum_quantity!='') {
      crtQnt = maximum_quantity;
    }else if (minimum_quantity!='' && maximum_quantity=='') {
      crtQnt = minimum_quantity;
    }else{
      crtQnt = 1;
    }

    $('.input-number__input').val(crtQnt);
    $('#cartQuantity').val(crtQnt);
    $('#cartDiscount').val(discount_rate);

    if (crtQnt>1) {
      $('#clearSelectionDiv').css('display','block');
    }else{
      $('#clearSelectionDiv').css('display','none');
    }

  }

  function clearSelection(){
    var qnty = 1;
    var BulkPriceList = <?php echo json_encode($result['detail']['product_data'][0]->BulkPriceList); ?>;
    //alert(qnty);
    if (BulkPriceList.length != 0) {
      var indx = 1;
      $('input[type=radio][name=optradio]').prop("checked", false);
      $('#cartDiscount').val('');

      $.each(BulkPriceList, function(val, text) {
        var minQnty = text.minimum_quantity;
        var maxQnty = text.maximum_quantity;
        var prodDiscount = text.discount_rate;

        if (minQnty!=null && maxQnty!=null) {
          if(qnty>=minQnty && qnty<=maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else if (minQnty==null && maxQnty!=null) {
          if(qnty==maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else if (minQnty!=null && maxQnty==null) {
          if(qnty>=minQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
          }
        }else{
          $('#regular_'+indx).prop("checked", true);
          $('#cartDiscount').val(prodDiscount);
        }

        indx = indx+1;
      });
    }

    $('.input-number__input').val(qnty);
    $('#cartQuantity').val(qnty);

    $('#clearSelectionDiv').css('display','none');
  }
   
 </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/detail.blade.php ENDPATH**/ ?>