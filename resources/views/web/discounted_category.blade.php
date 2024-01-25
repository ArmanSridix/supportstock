@extends('web.layout')
@section('content')

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
								<a href="{{ URL::to('/orders')}}"  class="user-item"><i class="fa fa-cube"></i>My Orders</a>
								<a href="{{ URL::to('/wishlist')}}" class="user-item "><i class="fa fa-heart-o"></i>My Wishlist</a>
								<a href="{{ URL::to('/myAddress')}}" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>
								<a href="{{ URL::to('/profile')}}" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

                <?php if($current_user_details->user_type=='Corporate'){ ?>
                  <a href="{{ URL::to('/discountedProCat')}}" class="user-item active"><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
                <?php } ?>

                <?php if($current_user_details->user_type=='Corporate'){ ?>
                  <a href="{{ URL::to('/kycList')}}" class="user-item "><i class="fa fa-upload"></i>Upload Kyc</a>
                <?php } ?>
                <?php if($current_user_details->user_type=='Normal'){ ?>
                  <a href="{{ URL::to('/corporateRequest')}}" class="user-item"><i class="fa fa-cog"></i>Corporate Request</a>
								<?php } ?>    
								<a href="{{ URL::to('/logout')}}" class="user-item"><i class="fa fa-sign-out"></i>Logout</a>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8">

						<div class="dashboard-right">
              <div class="row">
                <div class="col-md-12">
                  <div class="main-title-tab">
                    <h4><i class="fa fa-cube"></i>Discounted 
                      <?php 
                        if($current_user_details->assign_type=='Category'){
                          echo "Categories";
                        }else if($current_user_details->assign_type=='Product'){
                          echo "Products";
                        }
                      ?>
                    </h4>
                    {{--@if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif--}}
                  </div>
                </div>
              </div>

              <?php if($current_user_details->assign_type=='Category'){ ?>

                <div class="wishlistsec">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <table class="cart__table cart-table">
                        <thead class="cart-table__head">
                          <tr class="cart-table__row">
                            <th class="cart-table__column cart-table__column--image">Image</th>
                            <th class="cart-table__column cart-table__column--product">Category</th>                              
                            <th class="cart-table__column cart-table__column--total"></th>
                            <th class="cart-table__column cart-table__column--remove"></th>
                          </tr>
                        </thead>
                        <tbody class="cart-table__body">

                          @if(count($result['userAssignCategory'])>0)
                              @foreach($result['userAssignCategory'] as $key=>$allcategories)

                            <tr class="cart-table__row" >
                                <td class="cart-table__column cart-table__column--image">
                                    <a href="javascript:void(0);"><img src="{{asset('').$allcategories->iconpath}}" alt=""></a>
                                </td>
                                <td class="cart-table__column cart-table__column--product">
                                    <a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$allcategories->id.'&price=&today_deal=&best_seller=')}}" class="cart-table__product-name">{{$allcategories->name}}</a>
                                   
                                </td>
                              
                                <td class="cart-table__column cart-table__column--total" data-title="Total"><a href="{{ URL::to('/shop?page=&limit=&search=&type=&category='.$allcategories->id.'&price=&today_deal=&best_seller=')}}" class="btn btn-secondary addu-button">View Details</a></td>
                                <td class="cart-table__column cart-table__column--remove">
                                   
                                </td>
                            </tr>

                            @endforeach
                            @else
                                <tr>
                                    <td colspan="4">{{ trans('labels.NoRecordFound') }}</td>
                                </tr>
                            @endif                           
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
              <?php  } 
              if($current_user_details->assign_type=='Product'){ ?>

                <div class="wishlistsec">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <table class="cart__table cart-table">
                        <thead class="cart-table__head">
                          <tr class="cart-table__row">
                            <th class="cart-table__column cart-table__column--image">Image</th>
                            <th class="cart-table__column cart-table__column--product">Product</th>
                            <th class="cart-table__column cart-table__column--price">Price</th>
                          
                            <th class="cart-table__column cart-table__column--total"></th>
                            <th class="cart-table__column cart-table__column--remove"></th>
                          </tr>
                        </thead>
                        <tbody class="cart-table__body">

                          @if(count($result['userAssignProduct'])>0)
                              @foreach(($result['userAssignProduct']) as $product_data)

                            <tr class="cart-table__row" >
                                <td class="cart-table__column cart-table__column--image">
                                    <a href="javascript:void(0);"><img src="{{asset('').$product_data->image_path}}" alt=""></a>
                                </td>
                                <td class="cart-table__column cart-table__column--product">
                                    <a href="{{ URL::to('/product-detail/'.$product_data->products_id)}}" class="cart-table__product-name">{{$product_data->products_name}}</a>
                                   
                                </td>
                                <td class="cart-table__column cart-table__column--price" data-title="Price">₹{{$product_data->corporate_products_price}}</td>
                              
                                <td class="cart-table__column cart-table__column--total" data-title="Total"><a href="{{ URL::to('/product-detail/'.$product_data->products_id)}}" class="btn btn-secondary addu-button">View Details</a></td>
                                <td class="cart-table__column cart-table__column--remove">
                                  
                                </td>
                            </tr>

                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
                                </tr>
                            @endif
                            
                         
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

              <?php } ?>


						</div>
					
		            </div>
		
		
	</div>
</div>
</div>


@endsection
