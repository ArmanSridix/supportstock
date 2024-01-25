@extends('web.layout')
@section('content') 

    <style type="text/css">
        .input-number a.disabled {
          pointer-events: none;
          cursor: default;
        }
    </style>


	<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="{{ URL::to('/')}}"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;"> Cart </a>
               </div>
            </div>
         </div>
      </section>

        {{--@if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif--}}

      <section class="shop-single section-padding pt-3">
       <div class="cart block">
    <div class="container">


        <table class="cart__table cart-table">
            <thead class="cart-table__head">
                <tr class="cart-table__row">
                    <th class="cart-table__column cart-table__column--image">Image</th>
                    <th class="cart-table__column cart-table__column--product">Product</th>
                    <th class="cart-table__column cart-table__column--price">Price</th>
                    <th class="cart-table__column cart-table__column--price">Bulk Discount</th>
                    <th class="cart-table__column cart-table__column--price">Final Price</th>
                    <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                    {{--<th class="cart-table__column cart-table__column--price">Bulk Discount</th>--}}
                    <th class="cart-table__column cart-table__column--total">Total</th>
                    <th class="cart-table__column cart-table__column--total">Tax</th>
                    <th class="cart-table__column cart-table__column--remove"></th>
                </tr>
            </thead>
            <tbody class="cart-table__body">

                <?php $finalProdDiscount = 0;
                $withoutDiscTotal = 0;
                $withDiscTotal = 0;
                $totalTax = 0; ?>

                @if(count($result['cart'])>0)
                  @foreach(($result['cart']) as $cart_products)

                <tr class="cart-table__row">
                    <td class="cart-table__column cart-table__column--image">
                        <a href="{{ URL::to('/product-detail/'.$cart_products->products_id)}}"><img src="{{asset('').$cart_products->image_path}}" alt="" /></a>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="{{ URL::to('/product-detail/'.$cart_products->products_id)}}" class="cart-table__product-name" target="_blank" >{{$cart_products->products_name}}</a>
                        
                        <div class="item-attributes">
                            @if(isset($cart_products->attributes))
                                @foreach($cart_products->attributes as $attributes)
                                    <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                @endforeach
                            @endif
                        </div>
                    </td>

                    <td class="cart-table__column cart-table__column--price" data-title="Total Price">
                        ₹{{$cart_products->final_price}}
                    </td>

                    <td class="cart-table__column cart-table__column--price" data-title="Discount Percentage">
                        <?php
                            if ($cart_products->prodDiscount!='') {
                                echo $cart_products->prodDiscount.'%';
                            }else{
                                echo "N/A";
                            }
                        ?>
                    </td>

                    <td class="cart-table__column cart-table__column--price" data-title="Discount Price">
                        <?php
                            if ($cart_products->prodDiscount!='') {
                                $discnt = (($cart_products->final_price*$cart_products->prodDiscount)/100);
                            }else{
                                $discnt = 0;
                            }
                        ?>
                        ₹{{$cart_products->final_price-$discnt}}
                    </td>
                    <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                        <div class="input-number">
                            <input class="form-control input-number__input" type="number" min="{{$cart_products->min_order}}" max="{{$cart_products->max_order}}" value="{{$cart_products->customers_basket_quantity}}" id="cart_quantity_<?php echo $cart_products->customers_basket_id; ?>" readonly/>
                            <a class="input-number__add <?php echo $cart_products->customers_basket_quantity==$cart_products->max_order?"disabled":""; ?> " onclick="editCartQuantity('<?php echo $cart_products->customers_basket_id; ?>','<?php echo $cart_products->products_id; ?>')" ></a>
                            <a class="input-number__sub <?php echo $cart_products->customers_basket_quantity==$cart_products->min_order?"disabled":""; ?> " onclick="editCartQuantity('<?php echo $cart_products->customers_basket_id; ?>','<?php echo $cart_products->products_id; ?>')" ></a>
                        </div>
                    </td>
                    
                    <td class="cart-table__column cart-table__column--total" data-title="Grand Total">
                        <?php
                            if ($cart_products->prodDiscount!='') {
                                $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
                                $disc = (($cart_products->final_price*$cart_products->prodDiscount)/100)*$cart_products->customers_basket_quantity;
                                $totalPrice = $tPrice-$disc;
                            }else{
                                $tPrice = $cart_products->final_price * $cart_products->customers_basket_quantity;
                                $disc = 0;
                                $totalPrice = $tPrice-$disc;
                            }
                            $withoutDiscTotal = $withoutDiscTotal+$tPrice;
                            $finalProdDiscount = $finalProdDiscount+$disc;
                            $withDiscTotal = $withDiscTotal + $totalPrice;

                            if ($cart_products->taxRate!='') {
                                $taxVal = ($totalPrice*$cart_products->taxRate)/100;
                            }else{
                                $taxVal = 0;
                            }                            
                            $totalTax = $totalTax + $taxVal;

                            echo "₹".$totalPrice;
                        ?>
                    </td>

                    <td class="cart-table__column cart-table__column--price" data-title="Tax Percentage">
                        <?php
                            if ($cart_products->taxRate!='') {
                                echo $cart_products->taxRate.'%';
                            }else{
                                echo "N/A";
                            }
                        ?>
                    </td>

                    <td class="cart-table__column cart-table__column--remove">
                        <a href="{{ URL::to('/deleteCart?id='.$cart_products->customers_basket_id)}}"  class="btn" >
                            <span class="fa fa-trash" style="color: red;"></span>
                        </a>
                    </td>
                </tr>

                @endforeach
                @else
                    <tr>
                        <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                    </tr>
                @endif
                
                
            </tbody>
        </table>

        @if(!empty(session('coupon')))
            <div class="form-group">
                @foreach(session('coupon') as $coupons_show)

                    <div class="alert alert-success">
                        <a href="{{ URL::to('/removeCoupon/'.$coupons_show->coupans_id)}}" class="close" style="font-size: 36px;line-height: 23px;color: red;border: 1px solid red;" ><span aria-hidden="true">&times;</span></a>
                      @lang('website.Coupon Applied') {{$coupons_show->code}}.@lang('website.If you do not want to apply this coupon just click cross button of this alert.')
                    </div>

                @endforeach
            </div>
        @endif

        <div class="cart__actions">
            
            <form class="cart__coupon-form form-validate" id="apply_coupon">
                @if(count($result['cart'])>0)
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" /> 
                <button type="submit" class="btn btn-secondary" id="coupon-code">Apply Coupon</button>
                @endif
            </form>
            

            <div class="cart__buttons"><a href="{{ URL::to('/')}}" class="btn btn-light">Continue Shopping</a> <!-- <a href="#" class="btn btn-secondary cart__update-button">Update Cart</a> --></div>

        </div>

        <div class="row">
            <div id="coupon_error" class="help-block" style="display: none;color:red;"></div>
            <div  id="coupon_require_error" class="help-block" style="display: none;color:red;">@lang('website.Please enter a valid coupon code')</div>
        </div>

        @if(count($result['cart'])>0)
        <div class="row justify-content-end pt-5">
            <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cart Totals</h3>
                        <table class="cart__totals">
                            <thead class="cart__totals-header">
                                <tr>
                                    <th>Subtotal</th>
                                    <td>₹{{$withDiscTotal}}</td>
                                </tr>
                            </thead>
                            <tbody class="cart__totals-body">
                                <?php
                                    if(!empty(session('coupon_discount'))){
                                      $coupon_amount = 1 * session('coupon_discount');  
                                    }else{
                                      $coupon_amount = 0;
                                    }

                                    // if(!empty(session('shipping_detail'))){
                                    //     $shipping_price = session('shipping_detail')->rate;
                                    //     $shipping_name = session('shipping_detail')->name;
                                    // }else{
                                    //     $shipping_price = 0;
                                    //     $shipping_name = '';
                                    // }
                                    $shipping_price = 0;
                                    if ($flate_rate) {
                                        $shipping_price = $flate_rate;
                                    }
                                ?>

                                <tr>
                                    <th>Discount (Coupon)</th>
                                    <td>
                                        ₹{{number_format((float)$coupon_amount, 2, '.', '')+0}}
                                    </td>
                                </tr>
                                {{--<tr>
                                    <th>Bulk Discount</th>
                                    <td>₹{{$finalProdDiscount}}</td>
                                </tr>--}}
                                <tr>
                                    <th>Total Tax</th>
                                    <td>₹{{number_format((float)$totalTax, 2, '.', '')}}</td>
                                </tr>

                                <tr>
                                    <th>Shipping Price</th>
                                    <td>₹{{$shipping_price}}</td>
                                </tr>
                            </tbody>
                            <tfoot class="cart__totals-footer">
                                <tr>
                                    <th>Total</th>
                                    <td>₹{{$withDiscTotal + number_format((float)$totalTax, 2, '.', '') + $shipping_price-number_format((float)$coupon_amount, 2, '.', '')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php if($withDiscTotal>0){ ?>
                            <a class="btn btn-secondary btn-lg btn-block cart__checkout-button" href="{{ URL::to('/checkout')}}">Proceed to checkout</a>
                        <?php }else{ ?>
                            <button class="btn btn-secondary btn-lg btn-block cart__checkout-button" disabled>Proceed to checkout</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

      </section>


    <script type="text/javascript">

        //apply_coupon_cart
        jQuery(document).on('submit', '#apply_coupon', function(e){
            jQuery('#coupon_code').remove('error');
            jQuery('#coupon_require_error').hide();
            jQuery('#loader').show();

            if(jQuery('#coupon_code').val().length > 0){
                var formData = jQuery(this).serialize();
                jQuery.ajax({
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                    url: '{{ URL::to("/apply_coupon")}}',
                    type: "POST",
                    data: formData,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        var message = obj.message;
                        jQuery('#loader').hide();
                        if(obj.success==0){
                            jQuery("#coupon_error").html(message).show();
                            return false;
                        }else if(obj.success==2){
                            jQuery("#coupon_error").html(message).show();
                            return false;
                        }else if(obj.success==1){
                            window.location.reload(true);
                        }
                    },
                });
            }else{
                jQuery('#loader').css('display','none');
                jQuery('#coupon_code').addClass('error');
                jQuery('#coupon_require_error').show();
                return false;
            }
            jQuery('#loader').hide();
            return false;
        });
        //coupon_code
        jQuery(document).on('keyup', '#coupon_code', function(e){
            jQuery("#coupon_error").hide();
            if(jQuery(this).val().length >0){
                jQuery('#coupon_code').removeClass('error');
                jQuery('#coupon_require_error').hide();
            }else{
                jQuery('#coupon_code').addClass('error');
                jQuery('#coupon_require_error').show();
            }

        });


        function editCartQuantity(customers_basket_id,products_id){
            var cart_quantity = $('#cart_quantity_'+customers_basket_id).val();
            //alert(cart_quantity);
            $.ajax({

                type:'POST',
                url:'{{ url('updateCartQuantity') }}',
                data:{customers_basket_id:customers_basket_id,products_id:products_id,cart_quantity:cart_quantity,"_token": "{{ csrf_token() }}"},
                success:function(data){
                  
                  location.reload();
                  
                }

            });

        }
        
    </script>

@endsection
