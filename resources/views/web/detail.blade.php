@extends('web.layout')
@section('content')



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
   .review {
    border: 1px solid #ccc;
    padding: 6px;
  /*  margin: 20px 0;*/
    border-radius: 10px;
  }

  .star-rating {
    color: #FFD700; /* Set star color to gold */
    font-size: 26px;
  }

  .star {
    display: inline-block;
    margin-right: 2px;
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

  <!-- location modal -->
<div class="modal fade login-modal-main" id="locationModals">
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
                               
                                
                                   <select class="form-control" name="" id="webb_citiess" >
                                      {{-- <option value="">Please select your city</option> --}}
                                      
                                      {{-- @foreach($result['commonContent']['cityList'] as $webCity) --}}
                                      
                                         {{-- <option value="{{ $webCity->cities_id}}">{{ $webCity->cities_name}}</option> --}}
                                         
                                         <option selected value="{{$city->cities_id}}">{{$city->cities_name}}</option>
                                      {{-- @endforeach --}}
                                   </select>

                                   <select class="form-control mt-2 mSelectDropdown"  name="" id="webb_pincodes" >
                                    <option value="">Please select your pincode</option>
                                    
                                    @foreach($pincodesVal as $pincodesValue)
                                    
                                       <option value="{{ $pincodesValue->pincodes_id}}">{{ $pincodesValue->pincodes_val}}</option>
                                       {{-- <option selected value="{{$city->cities_id}}">{{$city->cities_name}}</option> --}}
                                    @endforeach
                                 </select>

                                   {{-- <select class="form-control mSelectDropdown" name="" id="webb_pincode" autocomplete="off">
                                      <option value="">Please select your Pincode</option>
                                   </select> --}}

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
                                      <a href="javascript:void(0);" class="btn btn-lg btn-secondary btn-block" onclick="cityyCheck()" >Search</a>
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

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
     <div class="container">
        <div class="row">
           <div class="col-md-12">
              <a href="{{ URL::to('/')}}"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;">{{$result['detail']['product_data'][0]->products_name}}</a> <!-- <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> AirConditioner Spares </a> -->
           </div>
        </div>
     </div>
  </section>

  @if ($errMessage = Session::get('stockOut'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $errMessage }}</strong>
    </div>
  @endif

  @if ($errMessage = Session::get('reviewError'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $errMessage }}</strong>
    </div>
  @endif

  @if ($errMessage = Session::get('reviewSuccess'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
      <strong>{{ $errMessage }}</strong>
    </div>
  @endif


  <section class="shop-single section-padding pt-3">
     <div class="container-fluid">
        <div class="row">
           <div class="col-xl-4 col-lg-6 col-md-6">
              
              
              
              <div class="shop-detail-left">
                 <div class="containers">
                    <div class="exzoom hidden" id="exzoom">
                       <div class="exzoom_img_box">
                          <ul class='exzoom_img_ul'>

                            <li>
                              <img src="{{asset('').$result['detail']['product_data'][0]->image_path}}"/>
                            </li>
                            
                            @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                              @if($images->image_type == 'LARGE')
                                <li>
                                  <img src="{{asset('').$images->image_path}}"/>
                                </li>
                              @elseif($images->image_type == 'ACTUAL')
                                <li>
                                  <img src="{{asset('').$images->image_path}}"/>
                                </li>
                              @endif
                            @endforeach
                             
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


           <div class="col-md-6 col-lg-6 col-xl-5 p-1">
              <div class="shop-detail-right">
                <div class="d-flex justify-content-between">
                  <h2>{{$result['detail']['product_data'][0]->products_name}}</h2>
                  <div class="review">
                    <h6 style="font-weight: bolder">Ratings and Reviews</h6>
                    <div class="user-review">
                      <P style="font-weight: bolder">{{$result['averageRating']}} out of 5 stars.</P>
                      <div class="star-rating" style="color: #ff8d00">
                        <?php
                          $rating = round($result['averageRating']); // Round the average rating to the nearest integer
                          for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                              echo '<span class="star">&#9733;</span>';
                            } else {
                              echo '<span class="star">&#9734;</span>';
                            }
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                 </div>

                  <?php if($result['detail']['product_data'][0]->products_sku){ ?>
                    <h6><strong><span class="mdi mdi-approval"></span> SKU no</strong> - {{$result['detail']['product_data'][0]->products_sku}}</h6>
                  <?php } ?>

                 <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - {{$result['detail']['product_data'][0]->products_weight}} {{$result['detail']['product_data'][0]->products_weight_unit}}</h6>
                
                
                <?php if($result['detail']['product_data'][0]->ss_assured==1){ ?>
                  <div>
                    <img src="{{asset('').$result['detail']['product_data'][0]->ss_assured_image}}" style="width: 80px;" />
                    <?php if($result['commonContent']['locationDetails']!=''){ ?>
                      <span class="float-right"><i class="mdi mdi-map-marker ml-2" aria-hidden="true"></i> <?php echo $result['commonContent']['locationDetails']->pincodes_val; ?> <a class="badge headerSelectCityy pb-1" href="javascript:void(0);">Change</a></span>
                 
                    <?php } ?>
                    <!-- <p class="float-right">00000</p> -->
                  </div>
                <?php } ?>
                 
                
                 <div class="short-description mt-3">
                    <h5>
                    Quick Overview
                    <p class="float-right">Availability:
                      @if($result['detail']['product_data'][0]->products_type == 0)
                        <?php if($result['detail']['product_data'][0]->defaultStock>0){ ?>
                          <span class="badge">In Stock</span>
                        <?php }else{ ?>
                          <span class="badge-out">Out Of Stock</span>
                        <?php } ?>
                      @else
                      <span class="badge stock-cart" hidden>In Stock</span>
                      <span class="badge-out stock-out-cart" hidden>Out Of Stock</span>
                      @endif

                    </p>
                    </h5>
                    <p>
                      <?php
                      // $descriptions = strip_tags($result['detail']['product_data'][0]->products_description);
                      // $descriptions = substr($descriptions,0,300);
                      // echo stripslashes($descriptions);

                      //if($result['detail']['product_data'][0]->products_description!=''){

                      echo stripslashes($result['detail']['product_data'][0]->pro_quick_overview  );
                      if($result['detail']['product_data'][0]->pro_quick_overview!=''){
                      ?>
                      <span><a href="#DescriptionDiv" class="scrollTo">See more</a></span>
                      <?php } ?>

                  </p>
                   
                 </div>


                  <?php
                    if ($current_user_type=='Corporate') {

                      if ($current_user_details['assign_type']=='Category') {
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
                            $mPrc = $result['detail']['product_data'][0]->mrp_price;
                          }
                        }else{
                          $mPrc = $result['detail']['product_data'][0]->mrp_price;
                        }
                      }else if ($current_user_details['assign_type']=='Product') {
                        $userProductArray = $current_user_details->userProductArray;
                        $catCheck = 0;
                        if (in_array($result['detail']['product_data'][0]->products_id, $userProductArray)) {
                            $catCheck = 1;
                        }
                        //echo $catCheck;
                        if ($catCheck == 1) {
                          $mPrc = $result['detail']['product_data'][0]->corporate_products_price;
                        }else{
                          $mPrc = $result['detail']['product_data'][0]->mrp_price;
                        }
                      }else{
                        $mPrc = $result['detail']['product_data'][0]->mrp_price;
                      }                                  
                      
                    }else{
                      $mPrc = $result['detail']['product_data'][0]->mrp_price;
                    }
                  ?>



              <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data" id="add-Product-form" >
                @csrf

                <input type="hidden" name="products_price" id="products_price" value="{{$mPrc}}">


                 <input type="hidden" name="products_id" value="{{ $result['detail']['product_data'][0]->products_id }}" >
                  <input type="hidden" name="quantity" value="<?php if(!empty($result['cart'])){echo $result['cart'][0]->customers_basket_quantity;}else if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){echo $result['detail']['product_data'][0]->products_min_order;}else{echo 1;} ?>" id="cartQuantity" >
                  <input type="hidden" name="prodDiscount" value="" id="cartDiscount" >

                  <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

                  <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >

                  <input type="hidden" id="min_order" value="" >

                @if(count($result['detail']['product_data'][0]->attributes)>0)
                  <div class="pro-options row">
                  <?php
                      $index = 0;
                  ?>
                    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
                    <?php
                        $functionValue = 'function_'.$key++;
                    ?>
                    <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
                    <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
                    <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
                    <input id="attributeid_<?=$index?>" type="hidden" value="">
                    <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                    <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
                    
                      <div class="attributes col-12 col-md-4 box">
                          <label class="">{{ $attributes_data['option']['name'] }}</label>
                          <div class="select-control">
                          <select name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                            @if(!empty($result['cart']))
                              @php
                                $value_ids = array();
                                foreach($result['cart'][0]->attributes as $values){
                                    $value_ids[] = $values->options_values_id;
                                }
                              @endphp
                                @foreach($attributes_data['values'] as $values_data)
                                  @if(!empty($result['cart']))
                                  <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                                  @endif
                                @endforeach
                              @else
                                @foreach($attributes_data['values'] as $values_data)
                                  <option attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div> 
                        </div>                 
                    
                    @endforeach
                  </div>
                  @endif


              </form>



                  <!-- <h6 class="mb-3 mt-4">Check serviceability at your Pincode:</h6>
                  <form class="cart__coupon-form mt-3" style="width: 100%;">

                    <label for="input-coupon-code" class="sr-only"></label> <input type="text" class="form-control" id="input-coupon-code" placeholder="Enter your Pincode"> <button type="submit" class="btn btn-secondary">Check</button>
                  </form> -->

              <?php if(!empty($result['detail']['product_data'][0]->sellerDetails)){ ?>
                <h6 class="mb-3 mt-4">Seller Info :</h6>

                <div class="row">
                  <div class="col-md-2">
                    <h6 class="text-info" style="margin-top: 2px;" >Name</h6>
                  </div>
                  <div class="col-md-10">
                    <p class="seller-name">{{$result['detail']['product_data'][0]->sellerDetails[0]->manufacturer_name}}</p>
                  </div>

                  <div class="col-md-2">
                    <h6 class="text-info" style="margin-top: 2px;" >Phone</h6>
                  </div>
                  <div class="col-md-10">
                    <p class="seller-phone">{{$result['detail']['product_data'][0]->sellerDetails[0]->seller_phone}}</p>
                  </div>

                  <?php if($result['detail']['product_data'][0]->sellerDetails[0]->seller_address!=''){ ?>
                    <div class="col-md-2">
                      <h6 class="text-info" style="margin-top: 2px;" >Address</h6>
                    </div>
                    <div class="col-md-6">
                      <p class="seller-name">{{$result['detail']['product_data'][0]->sellerDetails[0]->seller_address}}</p>
                    </div>
                    <div class="col-md-4"></div>
                  <?php } ?>

                </div>

              <?php }else{ ?>
                <br>
              <?php } ?>

                <!-- ShareThis BEGIN -->
                {{-- <div class="sharethis-inline-share-buttons"></div> --}}
                <div class="sharethis-inline-share-buttons" data-title="{{$result['detail']['product_data'][0]->products_name}}" data-image="{{asset('').$result['detail']['product_data'][0]->image_path}}"></div>
                <!-- ShareThis END -->
                 
              </div>
           </div>
           <div class="col-md-12 col-lg-12 col-xl-3">
              <div class="left-side-tabs">

                 <div class="price-dtls mt-2">
                    <h2 class="price1 mb-3 total_price"> 
                      <?php
                        if ($current_user_type=='Corporate') {

                          if ($current_user_details['assign_type']=='Category') {
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
                          }else if ($current_user_details['assign_type']=='Product') {
                            $userProductArray = $current_user_details->userProductArray;
                            $catCheck = 0;
                            if (in_array($result['detail']['product_data'][0]->products_id, $userProductArray)) {
                                $catCheck = 1;
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
                        <span class="badge badge-success" id="percentShowOld" >{{(int)$percent}}% OFF</span>
                      <?php } ?>
                      <span class="badge badge-success" id="percentShowNew" style="display: none;" >10% OFF</span>

                    <p class="regular-price"><i class="mdi mdi-tag-outline"></i> MRP : ₹{{$result['detail']['product_data'][0]->mrp_price}}</p>

                 </div>

                 

                 <div class="price-qnty mt-2 pb-3 pt-3">
                     <div class="input-number">
                          <input class="form-control input-number__input" type="number" min="{{$result['detail']['product_data'][0]->products_min_order}}" max="{{$result['detail']['product_data'][0]->defaultStock}}" value="<?php if(!empty($result['cart'])){echo $result['cart'][0]->customers_basket_quantity;}else if($result['detail']['product_data'][0]->products_min_order>0 and $result['detail']['product_data'][0]->defaultStock > $result['detail']['product_data'][0]->products_min_order){echo $result['detail']['product_data'][0]->products_min_order;}else{echo 1;} ?>" readonly="" />
                          <div class="input-number__add"></div>
                          <div class="input-number__sub"></div>
                       </div>
                 </div>

                 <?php $bulkMaxQuant = 1; ?>

                 @if(count($result['detail']['product_data'][0]->BulkPriceList)>0)

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

                        @foreach(($result['detail']['product_data'][0]->BulkPriceList) as $BulkPriceList)

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
                                   <label><input type="radio" id='regular_<?php echo $bulkId; ?>' name="optradio" onclick="bulkSelect('<?php echo $BulkPriceList->minimum_quantity; ?>','<?php echo $BulkPriceList->maximum_quantity; ?>','<?php echo $BulkPriceList->discount_rate; ?>','<?php echo $bulkId; ?>',this);" ></label>
                                </div>
                             </td>
                             <td>
                                <div class="radiotext">
                                  <label for='regular'>
                                    <?php
                                      if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity!='') {
                                        $bulkMaxQuant = $BulkPriceList->maximum_quantity;
                                        echo $BulkPriceList->minimum_quantity." - ".$BulkPriceList->maximum_quantity;
                                      }else if ($BulkPriceList->minimum_quantity=='' && $BulkPriceList->maximum_quantity!='') {
                                        $bulkMaxQuant = $BulkPriceList->maximum_quantity;
                                        echo $BulkPriceList->maximum_quantity;
                                      }else if ($BulkPriceList->minimum_quantity!='' && $BulkPriceList->maximum_quantity=='') {
                                        $bulkMaxQuant = $BulkPriceList->minimum_quantity;
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
                                   <label for='regular'>{{$BulkPriceList->discount_rate}}%</label>
                                </div>
                             </td>
                              <td>
                                <div class="radiotext">
                                  <?php
                                  // $pPrice = $mPrc;

                                  // by arman
                                  $pPrice=$result['detail']['product_data'][0]->mrp_price;
                                  // 

                                  $discountPrice = ($pPrice*$BulkPriceList->discount_rate)/100;
                                  // dd($pPrice);
                                  $finalPrice = $pPrice-$discountPrice;

                                ?>

                                  {{--<input type="hidden" name="" id="discountHidden" value="{{$BulkPriceList->discount_rate}}">--}}
                                   <label for='regular' id="finalPriceLabel_<?php echo $bulkId; ?>">₹{{$finalPrice}}</label>
                                </div>
                             </td>
                          </tr>

                          <?php $bulkId++; ?>
                        @endforeach
                          
                       </form>
                    </tbody>
                  </table>

                  <div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#moreThanTenModal">
                      More than {{$bulkMaxQuant}} quantities? Get customized price
                    </a>
                  </div>

                  @endif

                     
                  @if($result['detail']['product_data'][0]->products_type == 0)

                    @if($result['detail']['product_data'][0]->defaultStock == 0)
                      <button type="button" class="btn btn-danger btn-lg w-100 mt-3"> Out of Stock</button>
                    @else
                      <a href="javascript:void(0);" onclick="add_to_cart()" ><div type="button" class="btn btn-secondarygreen btn-lg w-100 mt-3 bg-success"> Buy Now</div> </a>

                      <a href="javascript:void(0);" onclick="add_to_cart()" ><div type="button" class="btn btn-secondary btn-lg w-100 mt-3"> Add To Cart</div> </a>
                    @endif

                  @else

                    <div class="stock-cart" hidden>
                      <a href="javascript:void(0);" onclick="add_to_cart()" ><div type="button" class="btn btn-secondarygreen btn-lg w-100 mt-3 bg-success"> Buy Now</div> </a>

                      <a href="javascript:void(0);" onclick="add_to_cart()" ><div type="button" class="btn btn-secondary btn-lg w-100 mt-3"> Add To Cart</div> </a>
                    </div>
                    <div class="stock-out-cart" hidden>
                      <button type="button" class="btn btn-danger btn-lg w-100 mt-3"> Out of Stock</button>
                    </div>                    

                  @endif

                  
                 
                 
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
                        <h5 class="product_tab_title">{{$reviewCount}} Review For <span>{{$result['detail']['product_data'][0]->products_name}} ( {{$result['detail']['product_data'][0]->products_sku}} )</span></h5>
                        <ul class="list_none comment_list mt-4">

                          @foreach($result['detail']['product_data'][0]->reviewed_customers as $key=>$rev)
                          <li>
                            <div class="comment_img">
                              <img src="{{asset('frontEnd/images/dummy.jpg') }}" alt="user1">
                            </div>
                            <div class="comment_block">
                              <div class="rating_wrap">
                                  <div class="rating">
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 1?"checked":""; ?> " style="font-size: 20px;" ></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 2?"checked":""; ?> " style="font-size: 20px;" ></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 3?"checked":""; ?> " style="font-size: 20px;" ></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 4?"checked":""; ?> " style="font-size: 20px;" ></span>
                                    <span class="fa fa-star <?php echo $rev->reviews_rating >= 5?"checked":""; ?> " style="font-size: 20px;" ></span>
                                  </div>
                              </div>
                              <p class="customer_meta">
                                <span class="review_author">{{$rev->customers_name}}</span>
                                <span class="comment-date">{{date("F j, Y", strtotime($rev->created_at))}}</span>
                              </p>
                              <div class="description">
                                <p>{{$rev->reviews_text}}</p>
                              </div>
                            </div>
                          </li>
                          @endforeach
                            
                        </ul>
                      </div>
                      <?php } ?>

                      <div class="review_form field_form">
                          <h5>Add a review</h5>
                          <form class="row mt-3" action="{{url('reviews')}}" method="POST" enctype="multipart/form-data" >
                            @csrf

                            <input value="{{$result['detail']['product_data'][0]->products_id}}" type="hidden" name="products_id">

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
                {{--<a class="float-right text-secondary" href="{{ URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=1&best_seller=')}}" >View All</a>--}}
                </h5>
             </div>
             <div class="owl-carousel owl-carousel-deals owl-theme">

              @if(count($result['recentProducts']['product_data'])>0)
              @foreach(($result['recentProducts']['product_data']) as $recentProducts)
                <div class="item">
                   <div class="product">
                      <div class="product-header">
                         <div class="badges">
                          <?php
                            if ($current_user_type=='Corporate') {

                              if ($current_user_details['assign_type']=='Category') {
                                $userCategoryArray = $current_user_details->userCategoryArray;
                                $productCategory = $recentProducts->categories;
                                
                                if (!empty($productCategory)) {
                                  $catCheck = 0;
                                  foreach ($productCategory as $key => $value) {
                                    if (in_array($value->categories_id, $userCategoryArray)) {
                                      $catCheck = 1;
                                    }
                                  }
                                  //echo $catCheck;
                                  if ($catCheck == 1) {
                                    $mPrc = $recentProducts->corporate_products_price;
                                  }else{
                                    $mPrc = $recentProducts->products_price;
                                  }
                                }else{
                                  $mPrc = $recentProducts->products_price;
                                }
                              }else if ($current_user_details['assign_type']=='Product') {
                                $userProductArray = $current_user_details->userProductArray;
                                $catCheck = 0;
                                if (in_array($recentProducts->products_id, $userProductArray)) {
                                    $catCheck = 1;
                                }
                                //echo $catCheck;
                                if ($catCheck == 1) {
                                  $mPrc = $recentProducts->corporate_products_price;
                                }else{
                                  $mPrc = $recentProducts->products_price;
                                }
                              }else{
                                $mPrc = $recentProducts->products_price;
                              }                                  
                              
                            }else{
                              $mPrc = $recentProducts->products_price;
                            }
                            $mrp = $recentProducts->mrp_price;
                            $percent = (($mrp-$mPrc)/$mrp)*100;
                          ?>
                          
                          <?php if($recentProducts->BulkPercentActive==1){ ?>

                            <?php if($recentProducts->BulkPercentMin==$recentProducts->BulkPercentMax){ ?>
                              <span class="badge badge-success secnd-color">{{(int)$recentProducts->BulkPercentMin}}% OFF</span>
                            <?php }else{ ?>
                              <span class="badge badge-success secnd-color">{{(int)$recentProducts->BulkPercentMin}}% - {{(int)$recentProducts->BulkPercentMax}}% OFF</span>
                            <?php } ?>

                          <?php }else{ if($percent>0){ ?>

                            <span class="badge badge-success secnd-color">{{(int)$percent}}% OFF</span>

                          <?php }} ?>

                         </div>
                         <a href="{{ getproductdetailslink($recentProducts->products_id) }}" target="_blank">
                            <img class="img-fluid" src="{{asset('').$recentProducts->image_path}}" alt="">
                         </a>

                          <a href="javascript:void(0);" onclick="addWishList(<?php echo $recentProducts->products_id; ?>)">
                            <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $recentProducts->products_id; ?> <?php echo $recentProducts->isLiked==1?'liked':''; ?>" ></span>
                          </a>

                      </div>
                      <div class="product-body">
                         <a href="{{ getproductdetailslink($recentProducts->products_id) }}" target="_blank">
                            <h5>{{$recentProducts->products_name}} </h5>
                         </a>
                         <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                          <?php if($recentProducts->ss_assured==1){ ?>
                            <div>
                              <img src="{{asset('').$recentProducts->ss_assured_image}}" style="width: 50px;" />
                            </div>
                          <?php } ?>
                      </div>
                      <div class="product-footer">

                        @if($recentProducts->products_type==0)
                        <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data">
                          @csrf

                          <input type="hidden" name="products_id" value="{{ $recentProducts->products_id }}" >
                          <input type="hidden" name="quantity" value="1" >
                          <input type="hidden" name="prodDiscount" value="" >

                          <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                        </form>
                        @elseif($recentProducts->products_type==1)
                        <a href="{{ URL::to(preg_replace('/[^a-zA-Z0-9]+/', '-', preg_replace('/\s+/', ' ', $recentProducts->products_name)) . '-' . $recentProducts->products_id) }}" target="_blank" class="btn btn-secondary btn-sm float-right">View Detail</a>
                        @endif

                         <p class="offer-price mb-0">
                          ₹{{$mPrc}}
                          
                          <br><span class="regular-price">₹{{$recentProducts->mrp_price}}</span></p>
                      </div>
                   </div>
                </div>
              @endforeach
              @endif

                
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
                {{--<a class="float-right text-secondary" href="{{ URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=1&best_seller=')}}" >View All</a>--}}
                </h5>
             </div>
             <div class="owl-carousel owl-carousel-deals owl-theme">

              @if(count($result['simliar_trending_products']['product_data'])>0)
              @foreach(($result['simliar_trending_products']['product_data']) as $simliar_trending_products)
                <div class="item">
                   <div class="product">
                      <div class="product-header">
                         <div class="badges">
                          <?php
                            if ($current_user_type=='Corporate') {

                              if ($current_user_details['assign_type']=='Category') {
                                $userCategoryArray = $current_user_details->userCategoryArray;
                                $productCategory = $simliar_trending_products->categories;
                                
                                if (!empty($productCategory)) {
                                  $catCheck = 0;
                                  foreach ($productCategory as $key => $value) {
                                    if (in_array($value->categories_id, $userCategoryArray)) {
                                      $catCheck = 1;
                                    }
                                  }
                                  //echo $catCheck;
                                  if ($catCheck == 1) {
                                    $mPrc = $simliar_trending_products->corporate_products_price;
                                  }else{
                                    $mPrc = $simliar_trending_products->products_price;
                                  }
                                }else{
                                  $mPrc = $simliar_trending_products->products_price;
                                }
                              }else if ($current_user_details['assign_type']=='Product') {
                                $userProductArray = $current_user_details->userProductArray;
                                $catCheck = 0;
                                if (in_array($simliar_trending_products->products_id, $userProductArray)) {
                                    $catCheck = 1;
                                }
                                //echo $catCheck;
                                if ($catCheck == 1) {
                                  $mPrc = $simliar_trending_products->corporate_products_price;
                                }else{
                                  $mPrc = $simliar_trending_products->products_price;
                                }
                              }else{
                                $mPrc = $simliar_trending_products->products_price;
                              }                                  
                              
                            }else{
                              $mPrc = $simliar_trending_products->products_price;
                            }
                            $mrp = $simliar_trending_products->mrp_price;
                            $percent = (($mrp-$mPrc)/$mrp)*100;
                          ?>
                          
                          <?php if($simliar_trending_products->BulkPercentActive==1){ ?>

                            <?php if($simliar_trending_products->BulkPercentMin==$simliar_trending_products->BulkPercentMax){ ?>
                              <span class="badge badge-success secnd-color">{{(int)$simliar_trending_products->BulkPercentMin}}% OFF</span>
                            <?php }else{ ?>
                              <span class="badge badge-success secnd-color">{{(int)$simliar_trending_products->BulkPercentMin}}% - {{(int)$simliar_trending_products->BulkPercentMax}}% OFF</span>
                            <?php } ?>

                          <?php }else{ if($percent>0){ ?>

                            <span class="badge badge-success secnd-color">{{(int)$percent}}% OFF</span>

                          <?php }} ?>

                         </div>
                         <a href="{{ getproductdetailslink($simliar_trending_products->products_id) }}
                          " target="_blank">
                            <img class="img-fluid" src="{{asset('').$simliar_trending_products->image_path}}" alt="">
                         </a>

                          <a href="javascript:void(0);" onclick="addWishList(<?php echo $simliar_trending_products->products_id; ?>)">
                            <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $simliar_trending_products->products_id; ?> <?php echo $simliar_trending_products->isLiked==1?'liked':''; ?>" ></span>
                          </a>

                      </div>
                      <div class="product-body">
                         <a href="{{ getproductdetailslink($simliar_trending_products->products_id) }}" target="_blank">
                            <h5>{{$simliar_trending_products->products_name}} </h5>
                         </a>
                         <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                         <?php if($simliar_trending_products->ss_assured==1){ ?>
                            <div>
                              <img src="{{asset('').$simliar_trending_products->ss_assured_image}}" style="width: 50px;" />
                            </div>
                          <?php } ?>
                      </div>
                      <div class="product-footer">

                        @if($simliar_trending_products->products_type==0)

                        @if($simliar_trending_products->defaultStock==0)
                          <button type="button" class="btn btn-danger btn-sm float-right">Out of Stock</button>
                        @else
                          <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="products_id" value="{{ $simliar_trending_products->products_id }}" >
                            <input type="hidden" name="quantity" value="1"  >
                            <input type="hidden" name="prodDiscount" value=""  >

                            <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                          </form>
                        @endif
                        
                        @elseif($simliar_trending_products->products_type==1)
                        <a href="{{ getproductdetailslink($simliar_trending_products->products_id) }}" target="_blank" class="btn btn-secondary btn-sm float-right">View Detail</a>
                        @endif

                         <p class="offer-price mb-0">
                          ₹{{$mPrc}}
                          
                          <br><span class="regular-price">₹{{$simliar_trending_products->mrp_price}}</span></p>
                      </div>
                   </div>
                </div>
              @endforeach
              @endif

                
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
                  <form class="form-validate" method="post" action="{{url('addProductEnquiry')}}">
                    @csrf

                    <input type="hidden" name="enProductId" value="{{ $result['detail']['product_data'][0]->products_id }}">
                    
                    <div class="address-fieldset">
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Name*</label>
                            <input id="" name="enName" type="text" placeholder="Enter your Name" class="form-control input-md field-validate" >
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Email*</label>
                            <input id="" name="enEmail" type="text" placeholder="Enter your email-id" class="form-control input-md email-validate" >
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Phone*</label>
                            <input id="" name="enPhone" type="text" maxlength="10" placeholder="Enter your phone no" class="form-control input-md phone-validate" >
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Locality*</label>
                            <select name="enCity" id="Locality" class="form-control input-md field-validate" >
                              <option value="">Select City</option>
                              @foreach($result['cityList'] as $city)
                              <option value="{{$city->cities_id}}">{{$city->cities_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <label class="control-label">Pincode*</label>
                            <select name="enPincode" id="pincode" class="form-control input-md field-validate" >
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
                                  <input class="form-control input-number__input2 field-validate" type="number" min="{{$bulkMaxQuant+1}}" value="{{$bulkMaxQuant+1}}" name="enQuantity"  />
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
                            <input id="" name="enPrice" type="text" placeholder="Expected price per piece" class="form-control input-md price-validate" >
                          </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12">
                          <div class="form-group mb-0">
                            <div class="address-btns">
                              <button class="save-btn14 hover-btn" type="submit">Submit</button>
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

 <script>
  $(document).ready(function(){

   $(".headerSelectCityy").click(function() {
        $("#locationModals").modal('toggle');
    });

    <?php if(Session::has('middleWarePincodeError')){ ?>      
      $("#locationModals").modal('toggle');
    <?php } ?>
  });
 </script>



 <script>
  function cityyCheck(){
    
    var cities_id = $('#webb_citiess').val();
    console.log(cities_id);
    var pincodes_id = $('#webb_pincodes').val();
    //alert(cities_id);
    if (cities_id=='') {
     
      $('#pincodeErrDiv1').css('display','block');
    }else if (pincodes_id=='') {
      
      $('#pincodeErrDiv1').css('display','none');
      $('#pincodeErrDiv2').css('display','block');
    }else{
      $('#pincodeErrDiv1').css('display','none');
      $('#pincodeErrDiv2').css('display','none');
      $.ajax({

        type:'POST',
        url:'{{ url('checkPincodeExist') }}',
        data:{pincodes_id:pincodes_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          //console.log(data.pincode_exist);
          if (data.pincode_exist == 'yes') {
            $('#pincodeErrDiv').css('display','none');
            //window.location.href = "<?php //echo url('/'); ?>";
            location.reload();
          }
          if (data.pincode_exist == 'no') {
            $('#pincodeErrDiv').css('display','block');
          }
        }

      });

    }
  }
 </script>
 

 <script type="text/javascript">

jQuery(document).ready(function() {
    @if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
      getQuantity();
      cartPrice();
    @endif
});

    function cartPrice(){
      var i = 0;
      jQuery(".currentstock").each(function() {
        var value_price = jQuery('option:selected', this).attr('value_price');
        var attributes_value = jQuery('option:selected', this).attr('attributes_value');
        var prefix = jQuery('option:selected', this).attr('prefix');
        jQuery('#attributeid_' + i).val(value_price);
        jQuery('#attribute_sign_' + i++).val(prefix);

      });
    }

  //ajax call for add option value
  function getQuantity(){


    var attributeid = [];
    var i = 0;
    
    jQuery('.stock-cart').attr('hidden', true);

    jQuery(".currentstock").each(function() {
      var value_price = jQuery('option:selected', this).attr('value_price');
      var attributes_value = jQuery('option:selected', this).attr('attributes_value');
      jQuery('#function_' + i).val(value_price);
      jQuery('#attributeids_' + i++).val(attributes_value);
    });

    var formData = jQuery('#add-Product-form').serialize();
    jQuery.ajax({
      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
      url: '{{ URL::to("getquantity")}}',
      type: "POST",
      data: formData,
      dataType: "json",
      async: false,
      success: function (res) {
        var products_price = jQuery('#products_price').val();

        jQuery('#current_stocks').html(res.remainingStock);
        var min_level = 0;
        var max_level = 0;
        var inventory_ref_id = res.inventory_ref_id;
        

        if(res.minMax != ''){
          min_level = res.minMax[0].products_min_order;
          max_level = res.minMax[0].products_max_stock;
          
        }        
        
        
        if(min_level != 0){
          
          jQuery('#cartQuantity').attr('value',min_level);
          //jQuery('#cartQuantity').attr('min',min_level);

          jQuery('.input-number__input').attr('value',min_level);
          jQuery('.input-number__input').attr('min',min_level);
          jQuery('.input-number__input').attr('max',max_level);
        }else{
          min_level = 1;
          jQuery('#cartQuantity').attr('value',min_level);
          //jQuery('#cartQuantity').attr('min',min_level);

          jQuery('.input-number__input').attr('value',min_level);
          jQuery('.input-number__input').attr('min',min_level);
          jQuery('.input-number__input').attr('max',max_level);
        }

        jQuery('#min_order').val(min_level);
        jQuery('#max_order').val(max_level);

        var final_pri = products_price * min_level;
        if(res.remainingStock>0){
          jQuery('#min_max_setting').html("&nbsp; Min Order Limit:" + min_level);
          jQuery('.stock-cart').removeAttr('hidden');
          jQuery('.stock-out-cart').attr('hidden',true);
          var max_order = jQuery('#max_order').val();

          if(max_order.trim()!=0){
            if(max_order.trim()>=res.remainingStock){
              //jQuery('#cartQuantity').attr('max',res.remainingStock);

              jQuery('.input-number__input').attr('max',res.remainingStock);
              jQuery('#max_order').val(res.remainingStock);
            }else{
              //jQuery('#cartQuantity').attr('max',max_order);

              jQuery('.input-number__input').attr('max',max_order);
              jQuery('#max_order').val(max_order);
            }
          }else{
            //jQuery('#cartQuantity').attr('max',res.remainingStock);

            jQuery('.input-number__input').attr('max',res.remainingStock);
            jQuery('#max_order').val(res.remainingStock);
          }
        }else{
          jQuery('#min_max_setting').html("");
          jQuery('.stock-out-cart').removeAttr('hidden');
          jQuery('.stock-cart').attr('hidden',true);
          //jQuery('#cartQuantity').attr('max',0);
          jQuery('.input-number__input').attr('value',1);
          jQuery('.input-number__input').attr('min',1);
          
          jQuery('.input-number__input').attr('max',0);
          //document.getElementById("myCheck").click();
          jQuery('#max_order').val(1);
        }

      },
    });
  }



  jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
  function {{ $functionValue }}(){
      var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
      jQuery("#{{ $functionValue }}").val(value_price);
    }
    //change_options
  jQuery(document).on('change', '.{{ $functionValue }}', function(e){

        var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

        var old_sign = jQuery("#{{ $attribute_sign }}").val();

        var value_price = jQuery('option:selected', this).attr('value_price');
        var prefix = jQuery('option:selected', this).attr('prefix');
        var current_price = jQuery('#products_price').val();
        var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

        if(old_sign.trim()=='+'){
          var current_price = current_price - {{ $functionValue }};
        }

        if(old_sign.trim()=='-'){
          var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
        }

        if(prefix.trim() == '+' ){
          var total_price = parseFloat(current_price) + parseFloat(value_price);
        }
        if(prefix.trim() == '-' ){
          total_price = current_price - value_price;
        }

        jQuery("#{{ $functionValue }}").val(value_price);
        jQuery('#products_price').val(total_price);

        var qty = jQuery('.input-number__input').val();
        var products_price1 = parseFloat(jQuery('#products_price').val());
        var total_price1 = qty * products_price1;
        jQuery('.total_price').html('₹'+products_price1.toFixed(2)+" X "+qty+" = ₹"+total_price1.toFixed(2));

        var products_price = jQuery('#products_price').val();
    
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

            var finalPrice = products_price-((products_price*prodDiscount)/100);
            jQuery('#finalPriceLabel_'+indx).html('₹'+finalPrice.toFixed(2));

            

            indx = indx+1;
          });
        }

  });
  @endforeach
  getQuantity();
  calculateAttributePrice();
  function calculateAttributePrice(){
    var products_price = jQuery('#products_price').val();
    var qnty = jQuery('.input-number__input').val();
    //alert(qnty);
    jQuery(".currentstock").each(function() {
      var value_price  = jQuery('option:selected', this).attr('value_price');
      var prefix = jQuery('option:selected', this).attr('prefix');

      if(prefix.trim()=='+'){
        products_price = parseFloat(products_price) + parseFloat(value_price);
      }

      if(prefix.trim()=='-'){
        products_price = parseFloat(products_price) - parseFloat(value_price);
      }

    });
    jQuery('#products_price').val(products_price);
    var total_price = products_price*qnty;
    jQuery('.total_price').html('₹'+products_price.toFixed(2)+" X "+qnty+" = ₹"+total_price.toFixed(2));

    var products_price = jQuery('#products_price').val();
    
    
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

        var finalPrice = products_price-((products_price*prodDiscount)/100);
        jQuery('#finalPriceLabel_'+indx).html('₹'+finalPrice.toFixed(2));

        

        indx = indx+1;
      });
    }

  }

  @endif

});

   
 </script>

 <script type="text/javascript">

  function add_to_cart(){
    $('#add-Product-form').submit();
  }

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
    var max_order = parseInt($('#max_order').val());
    //alert(qnty);
    if (BulkPriceList.length != 0) {
      var indx = 1;
      $('input[type=radio][name=optradio]').prop("checked", false);
      $('#cartDiscount').val('');
      totalPriceWithDiscount(qnty,'');

      $.each(BulkPriceList, function(val, text) {
        var minQnty = text.minimum_quantity;
        var maxQnty = text.maximum_quantity;
        var prodDiscount = text.discount_rate;

        if (minQnty!=null && maxQnty!=null) {
          if(qnty>=minQnty && qnty<=maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
            totalPriceWithDiscount(qnty,prodDiscount);
          }
          if (minQnty>=max_order) {
            $('#regular_'+indx).attr('',true);
          }
        }else if (minQnty==null && maxQnty!=null) {
          if(qnty==maxQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
            totalPriceWithDiscount(qnty,prodDiscount);
          }
          if (minQnty>=max_order) {
            $('#regular_'+indx).attr('',true);
          }
        }else if (minQnty!=null && maxQnty==null) {
          if(qnty>=minQnty){
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
            totalPriceWithDiscount(qnty,prodDiscount);
          }
          if (minQnty>=max_order) {
            $('#regular_'+indx).attr('',true);
          }
        }else{
          $('#regular_'+indx).prop("checked", true);
          $('#cartDiscount').val(prodDiscount);
          totalPriceWithDiscount(qnty,prodDiscount);
          if (minQnty>=max_order) {
            $('#regular_'+indx).attr('',true);
          }
        }

        indx = indx+1;
      });
    }

    var crtDiscnt = parseInt($('#cartDiscount').val());
    if (crtDiscnt>0) {
      $('#percentShowOld').css('display','none');

      $('#percentShowNew').html(crtDiscnt+"% OFF");
      $('#percentShowNew').css('display','block');
    }else{
      $('#percentShowOld').css('display','block');
      $('#percentShowNew').css('display','none');
    }


    $('.input-number__add').click(function(){
      var qnty = $('.input-number__input').val();
      var BulkPriceList = <?php echo json_encode($result['detail']['product_data'][0]->BulkPriceList); ?>;
      // console.log(BulkPriceList.length);
      if (BulkPriceList.length != 0) {
        var indx = 1;
        $('input[type=radio][name=optradio]').prop("checked", false);
        $('#cartDiscount').val('');
        totalPriceWithDiscount(qnty,'');

        $.each(BulkPriceList, function(val, text) {
          var minQnty = text.minimum_quantity;
          var maxQnty = text.maximum_quantity;
          var prodDiscount = text.discount_rate;

          if (minQnty!=null && maxQnty!=null) {
            if(qnty>=minQnty && qnty<=maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else if (minQnty==null && maxQnty!=null) {
            if(qnty==maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else if (minQnty!=null && maxQnty==null) {
            if(qnty>=minQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else{
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
            totalPriceWithDiscount(qnty,prodDiscount);
          }

          indx = indx+1;
        });
      }else{
        totalPriceWithDiscount(qnty,'');
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
        totalPriceWithDiscount(qnty,'');

        $.each(BulkPriceList, function(val, text) {
          var minQnty = text.minimum_quantity;
          var maxQnty = text.maximum_quantity;
          var prodDiscount = text.discount_rate;

          if (minQnty!=null && maxQnty!=null) {
            if(qnty>=minQnty && qnty<=maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else if (minQnty==null && maxQnty!=null) {
            if(qnty==maxQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else if (minQnty!=null && maxQnty==null) {
            if(qnty>=minQnty){
              $('#regular_'+indx).prop("checked", true);
              $('#cartDiscount').val(prodDiscount);
              totalPriceWithDiscount(qnty,prodDiscount);
            }
          }else{
            $('#regular_'+indx).prop("checked", true);
            $('#cartDiscount').val(prodDiscount);
            totalPriceWithDiscount(qnty,prodDiscount);
          }

          indx = indx+1;
        });
      }else{
        totalPriceWithDiscount(qnty,'');
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

  function totalPriceWithDiscount(qnty,prodDiscount){
    var products_price1 = parseFloat(jQuery('#products_price').val());
    if (prodDiscount!='') {
      var discount1 = (products_price1*prodDiscount)/100;
      var products_price2 = products_price1-discount1;
      var total_price1 = qnty * products_price2;
      jQuery('.total_price').html('₹'+products_price2.toFixed(2)+" X "+qnty+" = ₹"+total_price1.toFixed(2));
    }else{
      var total_price1 = qnty * products_price1;
      jQuery('.total_price').html('₹'+products_price1.toFixed(2)+" X "+qnty+" = ₹"+total_price1.toFixed(2));
    }

    var crtDiscnt = parseInt($('#cartDiscount').val());
    if (crtDiscnt>0) {
      $('#percentShowOld').css('display','none');

      $('#percentShowNew').html(crtDiscnt+"% OFF");
      $('#percentShowNew').css('display','block');
    }else{
      $('#percentShowOld').css('display','block');
      $('#percentShowNew').css('display','none');
    }
    
  }



  function bulkSelect(minimum_quantity,maximum_quantity,discount_rate,bulkId,radio_id){

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

      var qty = jQuery('.input-number__input').val();
      var products_price1 = parseFloat(jQuery('#products_price').val());
      var discount1 = (products_price1*discount_rate)/100;
      var products_price2 = products_price1-discount1;
      var total_price1 = qty * products_price2;
      jQuery('.total_price').html('₹'+products_price2.toFixed(2)+" X "+qty+" = ₹"+total_price1.toFixed(2));

      var crtDiscnt = parseInt($('#cartDiscount').val());
      if (crtDiscnt>0) {
        $('#percentShowOld').css('display','none');

        $('#percentShowNew').html(crtDiscnt+"% OFF");
        $('#percentShowNew').css('display','block');
      }else{
        $('#percentShowOld').css('display','block');
        $('#percentShowNew').css('display','none');
      }

  }

  function clearSelection(){
    var qnty = 1;
    var min_order = jQuery('#min_order').val();
    if (min_order!='' || min_order>0) {
      var qnty = min_order;
    }
    
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

    var qty = jQuery('.input-number__input').val();
    var products_price1 = parseFloat(jQuery('#products_price').val());
    var total_price1 = qty * products_price1;
    jQuery('.total_price').html('₹'+products_price1.toFixed(2)+" X "+qty+" = ₹"+total_price1.toFixed(2));

    var crtDiscnt = parseInt($('#cartDiscount').val());
    if (crtDiscnt>0) {
      $('#percentShowOld').css('display','none');

      $('#percentShowNew').html(crtDiscnt+"% OFF");
      $('#percentShowNew').css('display','block');
    }else{
      $('#percentShowOld').css('display','block');
      $('#percentShowNew').css('display','none');
    }
  }
   
 </script>


@endsection
