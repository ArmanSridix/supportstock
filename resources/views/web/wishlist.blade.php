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
								<a href="{{ URL::to('/wishlist')}}" class="user-item active"><i class="fa fa-heart-o"></i>My Wishlist</a>
								<a href="{{ URL::to('/myAddress')}}" class="user-item"><i class="fa fa-map-marker"></i>My Address</a>
								<a href="{{ URL::to('/profile')}}" class="user-item"><i class="fa fa-cog"></i>Account Setting</a>

                                <?php if($current_user_details->user_type=='Corporate'){ ?>
                                  <a href="{{ URL::to('/discountedCategory')}}" class="user-item "><i class="fa fa-tasks"></i>Wholesale/Factory price category for you</a>
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

            	@if(count($result['products']['product_data'])>0)
                  @foreach(($result['products']['product_data']) as $product_data)

                <tr class="cart-table__row" id="wishlist_<?php echo $product_data->products_id; ?>">
                    <td class="cart-table__column cart-table__column--image">
                        <a href="javascript:void(0);"><img src="{{asset('').$product_data->image_path}}" alt=""></a>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="{{ URL::to('/product-detail/'.$product_data->products_id)}}" class="cart-table__product-name">{{$product_data->products_name}}</a>
                       
                    </td>
                    <td class="cart-table__column cart-table__column--price" data-title="Price">₹{{$product_data->products_price}}</td>
                  
                    <td class="cart-table__column cart-table__column--total" data-title="Total"><a href="{{ URL::to('/product-detail/'.$product_data->products_id)}}" class="btn btn-secondary addu-button">View Details</a></td>
                    <td class="cart-table__column cart-table__column--remove">
                       <a href="javascript:void(0);" onclick="removeWishList(<?php echo $product_data->products_id; ?>)" ><i class="fa fa-trash-o"></i></a>
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
						</div>
					
		            </div>
		
		
	</div>
</div>
</div>

<script type="text/javascript">

	function removeWishList(products_id){
      //alert(products_id);
      $.ajax({

        type:'POST',
        url:'{{ url('addWishlistWeb') }}',
        data:{products_id:products_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          
          //location.reload();
          $('#wishlist_'+products_id).hide();
          
        }

      });
    }
	
</script>

@endsection
