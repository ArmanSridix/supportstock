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
                <a href="{{ URL::to('/orders')}}"  class="user-item active"><i class="fa fa-cube"></i>My Orders</a>
                <a href="{{ URL::to('/wishlist')}}" class="user-item"><i class="fa fa-heart-o"></i>My Wishlist</a>
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
              <div class="row">
                <div class="col-md-12">
                  <div class="main-title-tab">
                    <h4><i class="fa fa-cube"></i>My Orders</h4>
                    {{--@if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif--}}
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="pdpt-bg1">
                    <!-- <div class="pdpt-title">
                      <h6>Delivery Timing 10 May, 3.00PM - 6.00PM</h6>
                    </div> -->

                    @foreach($result['orderList'] as $value)
                    <div class="order-body10" style="border-bottom: 8px solid #938c8c;">
                      <?php $fnlTtlPrc = 0; ?>
                      @foreach($value->products as $value2)

                      <ul class="order-dtsll row d-flex align-items-center">
                        <li class="col-auto">
                          <div class="order-dt-img">
                            <img src="{{asset('').$value2->image}}" alt="">
                          </div>
                        </li>
                        <li class="col-auto">
                          <div class="order-dt47">
                            <h4>
                              <?php if($value2->products_status==1){ ?>
                                <a href="{{ URL::to('/product-detail/'.$value2->products_id)}}" target="_blank">
                              <?php }else{ ?>
                                <a href="javascript:void(0);">
                              <?php } ?>
                                {{ $value2->products_name }} x {{ $value2->products_quantity }} </a>

                              <?php if($value2->products_sku){ ?>
                                <br>
                                <span style="font-weight: 400;font-size: 14px;color: #888;">SKU no - {{$value2->products_sku}}</span>
                              <?php } ?>
                              <br>
                              <small>
                                @if(count($value2->attributes) >0)
                                  <ul>
                                    @foreach($value2->attributes as $attributes)
                                        <li>{{$attributes->products_options}} : <span>{{$attributes->products_options_values}} ,</span></li>
                                    @endforeach
                                  </ul>
                                @endif
                              </small>
                            </h4>

                            <div class="">
                              <div class="order-bill-slip">
                                @if($value->orders_status_id == 1 || $value->orders_status_id == 5)

                                  <?php if($value2->cancel_return_status==1){ ?>
                                    <span class="label label-Danger" style="color: red;">
                                      Canceled
                                    </span>
                                    <span class="label">
                                      ( {{$value2->status_reason}} )
                                    </span>
                                  <?php }else if($value2->cancel_return_status==2){ ?>
                                    <span class="label label-Danger" style="color: red;">
                                      Returned
                                    </span>
                                    <span class="label">
                                      ( {{$value2->status_reason}} )
                                    </span>
                                  <?php 
                                    }else{ 
                                      $today = date('Y-m-d H:i:s');
                                      $cancelDate = date('Y-m-d H:i:s', strtotime($value->date_purchased .' +'.$value2->cancelation_period.' days'));
                                      if($today<=$cancelDate){
                                  ?>
                                    <a style="padding: 5px;" data-toggle="tooltip" data-placement="bottom" id="cancelReason" orders_products_id ="{{ $value2->orders_products_id }}" class="bill-btn5 hover-btn">Cancel</a>
                                  <?php }} ?>

                                  
                                @elseif($value->orders_status_id == 2)

                                  <?php if($value2->cancel_return_status==1){ ?>
                                    <span class="label label-Danger">
                                      Canceled
                                    </span>
                                  <?php }else if($value2->cancel_return_status==2){ ?>
                                    <span class="label label-Danger">
                                      Returned
                                    </span>
                                  <?php 
                                    }else{ 
                                      $today = date('Y-m-d H:i:s');
                                      $returnDate = date('Y-m-d H:i:s', strtotime($value->date_purchased .' +'.$value2->return_period.' days'));
                                      if($today<=$returnDate){
                                  ?>
                                    <a style="padding: 5px;" data-toggle="tooltip" data-placement="bottom" id="returnReason" orders_products_id ="{{ $value2->orders_products_id }}" class="bill-btn5 hover-btn">Return</a>
                                  <?php }} ?>

                                  
                                @endif
                                
                              </div>
                            </div>
                            
                          </div>
                        </li>
                        <li class="col-auto">
                          <div class="order-dt47">
                            <h4 style="text-align: right;word-break:break-word;">
                              <?php $ttlPr = $value2->products_price*$value2->products_quantity;
                              $fnlTtlPrc = $fnlTtlPrc+$ttlPr; ?>
                            ₹{{ $ttlPr }}</h4></div>
                        </li>
                        <li class="col-auto text-right">
                          <div class="order-dt47">
                            <h4 style="text-align: right;">
                              <?php
                                if ($value2->bulk_discount!='') {
                                    echo $value2->bulk_discount.'% off';
                                }else{
                                    echo "0% off";
                                }
                              ?>
                            </h4></div>
                        </li>
                        <li class="col-auto text-right">
                          <div class="order-dt47">
                            <h4 style="text-align: right;">₹{{ $value2->final_price }}</h4>
                          </div>
                        </li>
                        
                      </ul>

                      @endforeach

                      <ul class="order-dtsll row d-flex align-items-center justify-content-center">
                        <li class="col-auto">
                          <div class="order-dt47">
                            <h4 style="text-align: right;">Total</h4>
                          </div>
                        </li>
                        <li class="col-auto">
                          <div class="order-dt47">
                            <h4 style="text-align: right;">₹{{ $fnlTtlPrc }}</h4>
                          </div>
                        </li>
                        <li class="col-auto">
                          <div class="order-dt47">
                            <h4>You save ₹{{ $fnlTtlPrc - ($value->order_price + $value->coupon_amount - $value->shipping_cost - $value->total_tax - $value->cancelReturnPrice) }}</h4>
                          </div>
                        </li>
                      </ul>

                      <div class="total-dt">
                        <div class="total-checkout-group1">
                          <div class="cart-total-dil">
                            <h4>Sub Total</h4>
                            <span>₹{{ $value->order_price + $value->coupon_amount - $value->shipping_cost - $value->total_tax - $value->cancelReturnPrice }}</span>
                          </div>
                          <div class="cart-total-dil pt-2">
                            <h4>Total Tax : </h4>
                            <span>₹{{ $value->total_tax }}</span>
                          </div>
                          <div class="cart-total-dil pt-2">
                            <h4>Dicount(Coupon) : </h4>
                            <span>₹{{ $value->coupon_amount }}</span>
                          </div>
                          <div class="cart-total-dil pt-2">
                            <h4>Shipping Price : </h4>
                            <span>₹{{ $value->shipping_cost }}</span>
                          </div>
                        </div>
                        <div class="main-total-cart">
                          <h2>Total</h2>
                          <span>₹{{ $value->order_price - $value->cancelReturnPrice }}</span>
                        </div>
                      </div>

                      <div class="track-order">
                        <h4>Track Order</h4>
                        <div class="bs-wizard" style="border-bottom:0;">

                          @if($value->orders_status == 'Pending' || $value->orders_status == 'Package' || $value->orders_status == 'Shipped' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
                            <div class="bs-wizard-step stepplaced complete">
                              <div class="text-center bs-wizard-stepnum">Pending</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @endif

                          @if($value->orders_status == 'Package' || $value->orders_status == 'Shipped' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
                            <div class="bs-wizard-step steppacked complete"> <!-- complete -->
                              <div class="text-center bs-wizard-stepnum">Package</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @else
                            <div class="bs-wizard-step steppacked"> <!-- complete -->
                              <div class="text-center bs-wizard-stepnum">Package</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @endif

                          @if($value->orders_status == 'Shipped' || $value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
                            <div class="bs-wizard-step stepontheway complete"><!-- complete -->
                              <div class="text-center bs-wizard-stepnum">Shipped</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @else
                            <div class="bs-wizard-step stepontheway"><!-- complete -->
                              <div class="text-center bs-wizard-stepnum">Shipped</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @endif
                          
                          @if($value->orders_status == 'Delivered' || $value->orders_status == 'Cancel' || $value->orders_status == 'Return')
                            <div class="bs-wizard-step stepdelivered complete "><!-- active -->
                              <div class="text-center bs-wizard-stepnum">Delivered</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @else
                            <div class="bs-wizard-step stepdelivered "><!-- active -->
                              <div class="text-center bs-wizard-stepnum">Delivered</div>
                              <div class="progress"><div class="progress-bar"></div></div>
                              <a href="javascript:void(0);" class="bs-wizard-dot"></a>
                            </div>
                          @endif

                        </div>
                      </div>

                @if($value->coustomer_notes != null || $value->coustomer_notes != '')
                <div class="total-dt">
                  <div class="total-checkout-group1">
                    <div class="cart-total-dil">
                      <span style="margin-left: inherit;"> <?php echo stripslashes($value->coustomer_notes); ?> </span>
                    </div>
                  </div>
                </div>
                @endif
                
                <div class="call-bill">
                  <div class="order-bill-slip">
                    <a href="{{ URL::to('/orderInvoice/'.$value->orders_id)}}" target="_blank" class="bill-btn5 hover-btn">View Bill</a>
                  </div>
                </div>
              </div>

              @endforeach
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    
  </div>
</div>
</div>

<!-- CancelModal -->
<div class="modal fade" id="CancelModal" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="">{{ trans('labels.reasonOfCancel') }}</h4>
          </div>
          {!! Form::open(array('url' =>'updateOrderProductStatus', 'name'=>'deleteOrderStatus', 'id'=>'deleteOrderStatus', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
          {!! Form::hidden('orders_products_id',  '', array('class'=>'form-control', 'id'=>'cancel_orders_products_id')) !!}
          {!! Form::hidden('cancel_return_status',  '1', array('class'=>'form-control')) !!}
          
          <div class="modal-body">
            <div class="form-group">
                  @foreach($result['orders_status_reasons'] as $reason)
                      @if($reason->reason_type == 1)
                        <input type="radio" name="cancel_return_reason" id="{{$reason->reason_id }}" value="{{$reason->reason_id }}">
                        <label for="{{$reason->reason_id }}">{{$reason->status_reason}}</label><br>
                        @else
                      @endif
                  @endforeach
                  
                </div>
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
              <button type="submit" class="btn btn-primary" id="">{{ trans('labels.submit') }}</button>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>

            <!-- ReturnModal -->
<div class="modal fade" id="ReturnModal" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="">{{ trans('labels.reasonOfReturn') }}</h4>
          </div>
          {!! Form::open(array('url' =>'updateOrderProductStatus', 'name'=>'deleteOrderStatus', 'id'=>'deleteOrderStatus', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
          {!! Form::hidden('orders_products_id',  '', array('class'=>'form-control', 'id'=>'return_orders_products_id')) !!}
          {!! Form::hidden('cancel_return_status',  '2', array('class'=>'form-control')) !!}
          <div class="modal-body">
            <div class="form-group">
                  @foreach($result['orders_status_reasons'] as $reason)
                      @if($reason->reason_type == 2)
                        <input type="radio" name="cancel_return_reason" id="{{$reason->reason_id }}" value="{{$reason->reason_id }}">
                        <label for="{{$reason->reason_id }}">{{$reason->status_reason}}</label><br>
                        @else
                      @endif
                  @endforeach
                </div>
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
              <button type="submit" class="btn btn-primary" id="">{{ trans('labels.submit') }}</button>
          </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
@endsection
