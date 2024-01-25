@extends('web.layout')
@section('content')

  <?php
    if(Session::has('supportUserDetails')){
      $current_user_details = Session::get('supportUserDetails');
      $current_user_type = $current_user_details['user_type'];
    }else{
      $current_user_type = '';
    }
  ?>

  <div class="site__body">
     <section  class="block-slideshow block-slideshow--layout--with-departments block carousel-slider-main text-center bg-grey mt-0">
        <div class="container-fluid">
           <div class="row">
              
              <div class="col-12 col-lg-12 p-0">
                 <div class="owl-carousel owl-carousel-slider owl-theme">
                  @foreach($result['slides'] as $key=>$slides_data)
                  @if($slides_data->type == 'category')
                    <div class="item">
                       <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$slides_data->url.'&price=&today_deal=&best_seller=')}}" target="_blank" ><img class="img-fluid" src="{{asset('').$slides_data->path}}" alt="First slide"></a>
                    </div>
                  @endif
                  @if($slides_data->type == 'product')
                    <div class="item">
                       <a href="{{ URL::to('/product-detail/'.$slides_data->url)}}" target="_blank" ><img class="img-fluid" src="{{asset('').$slides_data->path}}" alt="First slide"></a>
                    </div>
                  @endif
                  @endforeach
                  
                 </div>
              </div>
           </div>
        </div>
     </section>
     <section class="product-items-slider section-padding pt-0" style="border-top: 8px solid #f4f5f7;">
      @if(count($result['commonContent']['allcategories'])>0)
        <div class="owl-carousel owl-carousel-category owl-theme">

          @foreach($result['commonContent']['allcategories'] as $key=>$allcategories)
            <div class="item">
              <div class="category-item">
                 <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$allcategories->id.'&price=&today_deal=&best_seller=')}}" >
                    <img class="img-fluid" src="{{asset('').$allcategories->iconpath}}" alt="">
                    <h6>{{$allcategories->name}}</h6>
                    <p>Shop Now</p>
                    <!-- <div class="new-label">
                       <div class="text">15% OFF</div>
                    </div>
                    <div class="tag-off"><span>NEW</span></div> -->
                 </a>
              </div>
            </div>
          @endforeach
           
        </div>
      @endif
     </section>
     <section class="banners-content section-padding">
        <div class="banner-three">
           <div class="container-fluid">
              <div class="group-banners">
                 <div class="row">
                    <div class="col-12 col-md-4 padd-r-10">
                      @if(count($result['commonContent']['homeBanners'])>0)
                      @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                        @if($homeBanners->type==7)

                        @if($homeBanners->navigate_type == 'category')
                        <figure class="banner-image">
                          <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in" target="_blank"><img class="img-fluid first-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                        </figure>
                        @endif
                        @if($homeBanners->navigate_type == 'product')
                        <figure class="banner-image">
                          <a href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in" target="_blank"><img class="img-fluid first-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                        </figure>
                        @endif

                        @endif
                      @endforeach
                      @endif
                    </div>
                    <div class="col-12 col-md-8">
                       <div class="row">
                          <div class="col-12 col-md-6 padd-l-0">
                            @if(count($result['commonContent']['homeBanners'])>0)
                            @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                              @if($homeBanners->type==8)

                              @if($homeBanners->navigate_type == 'category')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in" target="_blank"><img class="img-fluid second-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif
                              @if($homeBanners->navigate_type == 'product')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in" target="_blank"><img class="img-fluid second-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif

                              @endif
                            @endforeach
                            @endif
                          </div>
                          <div class="col-12 col-md-6 plt-5 padd-l-0">
                            @if(count($result['commonContent']['homeBanners'])>0)
                            @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                              @if($homeBanners->type==9)

                              @if($homeBanners->navigate_type == 'category')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in" target="_blank"><img class="img-fluid second-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif
                              @if($homeBanners->navigate_type == 'product')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in" target="_blank"><img class="img-fluid second-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif

                              @endif
                            @endforeach
                            @endif
                          </div>
                       </div>
                       <div class="row">
                          <div class="col-12 col-md-12 plt-0">
                            @if(count($result['commonContent']['homeBanners'])>0)
                            @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                              @if($homeBanners->type==6)

                              @if($homeBanners->navigate_type == 'category')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in" target="_blank"><img class="img-fluid third-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif
                              @if($homeBanners->navigate_type == 'product')
                              <figure class="banner-image">
                                <a href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in" target="_blank"><img class="img-fluid third-image" src="{{asset('').$homeBanners->path}}" alt=""></a>
                              </figure>
                              @endif

                              @endif
                            @endforeach
                            @endif
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>


     {{--@if(count($result['userAssignCategory'])>0)
     <section class="product-items-slider section-padding">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-12">
                 <div class="section-header">
                    <h5 class="heading-design-h5">Discounted Categories for you 
                    
                    </h5>
                 </div>
                 <div class="owl-carousel owl-carousel-category owl-theme">

                   @foreach($result['userAssignCategory'] as $key=>$allcategories)
                    <div class="item">
                      <div class="category-item">
                         <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$allcategories->id.'&price=&today_deal=&best_seller=')}}" >
                            <img class="img-fluid" src="{{asset('').$allcategories->iconpath}}" alt="">
                            <h6>{{$allcategories->name}}</h6>
                            <p>Shop Now</p>
                            <!-- <div class="new-label">
                               <div class="text">15% OFF</div>
                            </div>
                            <div class="tag-off"><span>NEW</span></div> -->
                         </a>
                      </div>
                    </div>
                  @endforeach

                </div>
                 
              </div>
           </div>
        </div>
     </section>
     @endif--}}


     <section class="product-items-slider section-padding">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-12">
                 <div class="section-header">
                    <h5 class="heading-design-h5">Todays Deals
                    <a class="float-right text-secondary" href="{{ URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=1&best_seller=')}}" >View All</a>
                    </h5>
                 </div>
                 <div class="owl-carousel owl-carousel-deals owl-theme">

                  @if(count($result['today_deal_products']['product_data'])>0)
                  @foreach(($result['today_deal_products']['product_data']) as $today_deal_products)
                    <div class="item">
                       <div class="product">
                          <div class="product-header">
                             <div class="badges">
                              <?php
                                if ($current_user_type=='Corporate') {

                                  if ($current_user_details['assign_type']=='Category') {
                                    $userCategoryArray = $current_user_details->userCategoryArray;
                                    $productCategory = $today_deal_products->categories;
                                    
                                    if (!empty($productCategory)) {
                                      $catCheck = 0;
                                      foreach ($productCategory as $key => $value) {
                                        if (in_array($value->categories_id, $userCategoryArray)) {
                                          $catCheck = 1;
                                        }
                                      }
                                      //echo $catCheck;
                                      if ($catCheck == 1) {
                                        $mPrc = $today_deal_products->corporate_products_price;
                                      }else{
                                        $mPrc = $today_deal_products->products_price;
                                      }
                                    }else{
                                      $mPrc = $today_deal_products->products_price;
                                    }
                                  }else if ($current_user_details['assign_type']=='Product') {
                                    $userProductArray = $current_user_details->userProductArray;
                                    $catCheck = 0;
                                    if (in_array($today_deal_products->products_id, $userProductArray)) {
                                        $catCheck = 1;
                                    }
                                    //echo $catCheck;
                                    if ($catCheck == 1) {
                                      $mPrc = $today_deal_products->corporate_products_price;
                                    }else{
                                      $mPrc = $today_deal_products->products_price;
                                    }
                                  }else{
                                    $mPrc = $today_deal_products->products_price;
                                  }                                  
                                  
                                }else{
                                  $mPrc = $today_deal_products->products_price;
                                }
                                $mrp = $today_deal_products->mrp_price;
                                $percent = (($mrp-$mPrc)/$mrp)*100;
                              ?>

                              <?php if($today_deal_products->BulkPercentActive==1){ ?>

                                <?php if($today_deal_products->BulkPercentMin==$today_deal_products->BulkPercentMax){ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$today_deal_products->BulkPercentMin}}% OFF</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$today_deal_products->BulkPercentMin}}% - {{(int)$today_deal_products->BulkPercentMax}}% OFF</span>
                                <?php } ?>

                              <?php }else{ if($percent>0){ ?>

                                <span class="badge badge-success secnd-color">{{(int)$percent}}% OFF</span>

                              <?php }} ?>

                             </div>
                             <a href="{{ getproductdetailslink($today_deal_products->products_id) }}" target="_blank">
                                <img class="img-fluid" src="{{asset('').$today_deal_products->image_path}}" alt="">
                             </a>

                              <a href="javascript:void(0);" onclick="addWishList(<?php echo $today_deal_products->products_id; ?>)">
                                <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $today_deal_products->products_id; ?> <?php echo $today_deal_products->isLiked==1?'liked':''; ?>" ></span>
                              </a>

                          </div>
                          <div class="product-body">
                             <a href="{{ getproductdetailslink($today_deal_products->products_id) }}" target="_blank">
                                <h5>{{$today_deal_products->products_name}} </h5>
                             </a>
                             <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                            <?php if($today_deal_products->ss_assured==1){ ?>
                              <div>
                                <img src="{{asset('').$today_deal_products->ss_assured_image}}" style="width: 50px;" />
                              </div>
                            <?php } ?>
                          </div>
                          <div class="product-footer">

                            @if($today_deal_products->products_type==0)

                              @if($today_deal_products->defaultStock==0)
                                <button type="button" class="btn btn-danger btn-sm float-right">Out of Stock</button>
                              @else
                                <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  <input type="hidden" name="products_id" value="{{ $today_deal_products->products_id }}" >
                                  <input type="hidden" name="quantity" value="1" id="" >
                                  <input type="hidden" name="prodDiscount" value="" id="" >

                                  <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                                </form>
                              @endif
                            
                            @elseif($today_deal_products->products_type==1)
                            <a href="{{ getproductdetailslink($today_deal_products->products_id) }}" target="_blank" class="btn btn-secondary btn-sm float-right">View Detail</a>
                            @endif

                             <p class="offer-price mb-0">
                              ₹<?php echo $mPrc; ?>
                              
                              <br><span class="regular-price">₹{{$today_deal_products->mrp_price}}</span></p>
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
                    <h5 class="heading-design-h5">Best Seller
                    <a class="float-right text-secondary" href="{{ URL::to('/shop?page=&limit=&search=&type=&category=&price=&today_deal=&best_seller=1')}}" >View All</a>
                    </h5>
                 </div>
                 <div class="owl-carousel owl-carousel-bestseller owl-theme">

                  @if(count($result['best_seller_products']['product_data'])>0)
                  @foreach(($result['best_seller_products']['product_data']) as $best_seller_products)
                    <div class="item">
                       <div class="product">
                          <div class="product-header">
                             <div class="badges">
                               <?php
                                if ($current_user_type=='Corporate') {

                                  if ($current_user_details['assign_type']=='Category') {
                                    $userCategoryArray = $current_user_details->userCategoryArray;
                                    $productCategory = $best_seller_products->categories;
                                    
                                    if (!empty($productCategory)) {
                                      $catCheck = 0;
                                      foreach ($productCategory as $key => $value) {
                                        if (in_array($value->categories_id, $userCategoryArray)) {
                                          $catCheck = 1;
                                        }
                                      }
                                      //echo $catCheck;
                                      if ($catCheck == 1) {
                                        $mPrc = $best_seller_products->corporate_products_price;
                                      }else{
                                        $mPrc = $best_seller_products->products_price;
                                      }
                                    }else{
                                      $mPrc = $best_seller_products->products_price;
                                    }
                                  }else if ($current_user_details['assign_type']=='Product') {
                                    $userProductArray = $current_user_details->userProductArray;
                                    $catCheck = 0;
                                    if (in_array($best_seller_products->products_id, $userProductArray)) {
                                        $catCheck = 1;
                                    }
                                    //echo $catCheck;
                                    if ($catCheck == 1) {
                                      $mPrc = $best_seller_products->corporate_products_price;
                                    }else{
                                      $mPrc = $best_seller_products->products_price;
                                    }
                                  }else{
                                    $mPrc = $best_seller_products->products_price;
                                  }                                  
                                  
                                }else{
                                  $mPrc = $best_seller_products->products_price;
                                }
                                $mrp = $best_seller_products->mrp_price;
                                $percent = (($mrp-$mPrc)/$mrp)*100;
                              ?>
                              
                              <?php if($best_seller_products->BulkPercentActive==1){ ?>

                                <?php if($best_seller_products->BulkPercentMin==$best_seller_products->BulkPercentMax){ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$best_seller_products->BulkPercentMin}}% OFF</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$best_seller_products->BulkPercentMin}}% - {{(int)$best_seller_products->BulkPercentMax}}% OFF</span>
                                <?php } ?>

                              <?php }else{ if($percent>0){ ?>

                                <span class="badge badge-success secnd-color">{{(int)$percent}}% OFF</span>

                              <?php }} ?>
                               <!-- <span class="badge badge-info dark-color">New</span> -->
                             </div>
                             <a href="{{ getproductdetailslink($best_seller_products->products_id) }}" target="_blank">
                                <img class="img-fluid" src="{{asset('').$best_seller_products->image_path}}" alt="">
                             </a>

                              <a href="javascript:void(0);" onclick="addWishList(<?php echo $best_seller_products->products_id; ?>)">
                                <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $best_seller_products->products_id; ?> <?php echo $best_seller_products->isLiked==1?'liked':''; ?>" ></span>
                              </a>


                          </div>
                          <div class="product-body">
                             <a href="{{ getproductdetailslink($best_seller_products->products_id) }}" target="_blank">
                                <h5>{{$best_seller_products->products_name}} </h5>
                             </a>
                             <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                            <?php if($best_seller_products->ss_assured==1){ ?>
                              <div>
                                <img src="{{asset('').$best_seller_products->ss_assured_image}}" style="width: 50px;" />
                              </div>
                            <?php } ?>
                          </div>
                          <div class="product-footer">

                            @if($best_seller_products->products_type==0)

                              @if($best_seller_products->defaultStock==0)
                                <button type="button" class="btn btn-danger btn-sm float-right">Out of Stock</button>
                              @else
                                <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  <input type="hidden" name="products_id" value="{{ $best_seller_products->products_id }}" >
                                  <input type="hidden" name="quantity" value="1" id="" >
                                  <input type="hidden" name="prodDiscount" value="" id="" >

                                  <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                                </form>
                              @endif
                              
                            @elseif($best_seller_products->products_type==1)
                              <a href="{{ getproductdetailslink($best_seller_products->products_id) }}" target="_blank" class="btn btn-secondary btn-sm float-right">View Detail</a>
                            @endif

                             <p class="offer-price mb-0">
                             ₹<?php echo $mPrc; ?>
                              <br><span class="regular-price">₹{{$best_seller_products->mrp_price}}</span></p>
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


      

     <section  class="common-banner bg-white section-padding">
        <div class="container-fluid">
           <div class="row">
              <div class="col-lg-6 mb-30">
                @if(count($result['commonContent']['homeBanners'])>0)
                @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                  @if($homeBanners->type==19)

                  @if($homeBanners->navigate_type == 'category')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif
                  @if($homeBanners->navigate_type == 'product')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif

                  @endif
                @endforeach
                @endif                 
              </div>
              <div class="col-lg-6 mb-30">
                @if(count($result['commonContent']['homeBanners'])>0)
                @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                  @if($homeBanners->type==20)

                  @if($homeBanners->navigate_type == 'category')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif
                  @if($homeBanners->navigate_type == 'product')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif

                  @endif
                @endforeach
                @endif
              </div>
           </div>
        </div>
     </section>


    @if(count($result['productByCategory'])>0)
      <?php $productByCategoryCount = count($result['productByCategory']); ?>
      @foreach(($result['productByCategory']) as $key => $productByCategory)

      <section class="product-items-slider section-padding">
        <div class="container-fluid">
           <div class="row">

            <?php if($key == $productByCategoryCount-1){ ?>
              <div class="col-lg-12" style="margin-bottom: 30px;">
                @if(count($result['commonContent']['homeBanners'])>0)
                @foreach(($result['commonContent']['homeBanners']) as $homeBanners)
                  @if($homeBanners->type==83)

                  @if($homeBanners->navigate_type == 'category')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$homeBanners->banners_url.'&price=&today_deal=&best_seller=')}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif
                  @if($homeBanners->navigate_type == 'product')
                  <div class="banner-thumb common-bthumb1">
                    <a  href="{{ URL::to('/product-detail/'.$homeBanners->banners_url)}}" class="zoom-in d-block overflow-hidden" target="_blank">
                       <img src="{{asset('').$homeBanners->path}}" alt="banner-thumb-naile">
                    </a>
                  </div>
                  @endif

                  @endif
                @endforeach
                @endif
              </div>
            <?php } ?>

              <div class="col-md-12">
                 <div class="section-header">
                    <h5 class="heading-design-h5">{{ $productByCategory['categories_name'] }}
                    <a class="float-right text-secondary" href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$productByCategory['catIdArr'].'&price=&today_deal=&best_seller=')}}" >View All</a>
                    </h5>
                 </div>
                 <div class="owl-carousel owl-carousel-categorypro owl-theme">

                  @if(count($productByCategory['product_data'])>0)
                    @foreach(($productByCategory['product_data']) as $product_data)

                    <div class="item">
                       <div class="product">
                          <div class="product-header">
                             <div class="badges">
                                <?php
                                if ($current_user_type=='Corporate') {

                                  if ($current_user_details['assign_type']=='Category') {
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
                                  }else if ($current_user_details['assign_type']=='Product') {
                                    $userProductArray = $current_user_details->userProductArray;
                                    $catCheck = 0;
                                    if (in_array($product_data->products_id, $userProductArray)) {
                                        $catCheck = 1;
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
                              ?>
                              
                              <?php if($product_data->BulkPercentActive==1){ ?>

                                <?php if($product_data->BulkPercentMin==$product_data->BulkPercentMax){ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$product_data->BulkPercentMin}}% OFF</span>
                                <?php }else{ ?>
                                  <span class="badge badge-success secnd-color">{{(int)$product_data->BulkPercentMin}}% - {{(int)$product_data->BulkPercentMax}}% OFF</span>
                                <?php } ?>

                              <?php }else{ if($percent>0){ ?>

                                <span class="badge badge-success secnd-color">{{(int)$percent}}% OFF</span>

                              <?php }} ?>

                             </div>
                             <a href="{{ getproductdetailslink($product_data->products_id) }}" target="_blank">
                                <img class="img-fluid" src="{{asset('').$product_data->image_path}}" alt="">
                             </a>
                            
                            <a href="javascript:void(0);" onclick="addWishList(<?php echo $product_data->products_id; ?>)">
                              <span class="veg mdi mdi-heart-outline pro_wish_<?php echo $product_data->products_id; ?> <?php echo $product_data->isLiked==1?'liked':''; ?> " ></span>
                            </a>

                              
                          </div>
                          <div class="product-body">
                             <a href="{{ getproductdetailslink($product_data->products_id) }}" target="_blank">
                                <h5>{{$product_data->products_name}} </h5>
                             </a>
                             <!-- <h6><strong><span class="mdi mdi-approval"></span> Available in</strong> - 500 gm</h6> -->
                            <?php if($product_data->ss_assured==1){ ?>
                              <div>
                                <img src="{{asset('').$product_data->ss_assured_image}}" style="width: 50px;" />
                              </div>
                            <?php } ?>
                          </div>
                          <div class="product-footer">
                            
                            @if($product_data->products_type==0)

                              @if($product_data->defaultStock==0)
                                <button type="button" class="btn btn-danger btn-sm float-right">Out of Stock</button>
                              @else
                                <form action="{{url('addToCart')}}" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  <input type="hidden" name="products_id" value="{{ $product_data->products_id }}" >
                                  <input type="hidden" name="quantity" value="1" id="" >
                                  <input type="hidden" name="prodDiscount" value="" id="" >

                                  <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>

                                </form>
                              @endif
                              
                            @elseif($product_data->products_type==1)
                              <a href="{{ getproductdetailslink($product_data->products_id) }}" target="_blank" class="btn btn-secondary btn-sm float-right">View Detail</a>
                            @endif

                             <p class="offer-price mb-0">
                             ₹<?php echo $mPrc; ?>
                              <br><span class="regular-price">₹{{$product_data->mrp_price}}</span></p>
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

      @endforeach
    @endif

      

  </div>
  
@endsection
