@extends('web.layout')
@section('content')

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="{{ URL::to('/')}}"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Today's Coupons </a>
               </div>
            </div>
         </div>
      </section>
<div id="page_container">
     <section class="section-padding">
<div class="section-title text-center mb-4 mt-4">
<h2>Today's Coupons</h2>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

	<table class="cart__table cart-table">
      <thead class="cart-table__head">
          <tr class="cart-table__row">
              <th class="cart-table__column cart-table__column--price"><b>#</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Code</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Description</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Type</b></th>
              <th class="cart-table__column cart-table__column--price"><b>Coupon Amount</b></th>
          </tr>
      </thead>
      <tbody class="cart-table__body">

        @if(count($result['couponList'])>0)
            @foreach(($result['couponList']) as $key => $couponList)

            <tr class="cart-table__row">
              <td class="cart-table__column cart-table__column--price" data-title="#">
                  {{$key+1}}
              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Code">
                {{$couponList->code}}
              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Description">
                {{$couponList->description}}
              </td>
            
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Type">
                {{ str_replace('_', ' ', $couponList->discount_type) }}
              </td>
              <td class="cart-table__column cart-table__column--price" data-title="Coupon Amount">
                @if($couponList->discount_type=='fixed_product' or $couponList->discount_type=='fixed_cart')
                  ₹{{ $couponList->amount }} 
                @else
                  {{ $couponList->amount }}%
                @endif
              </td>
          </tr>

          @endforeach
          @else
              <tr class="cart-table__row">
                  <td class="cart-table__column cart-table__column--price" data-title="#">
                      
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Code">
                    
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Description">
                    
                  </td>
                
                  <td class="cart-table__column cart-table__column--price" data-title="Coupon Type">
                    
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Coupon Amount">
                    
                  </td>
              </tr>
              <tr>
                  <td colspan="5">{{ trans('labels.NoRecordFound') }}</td>
              </tr>              
          @endif
          
       
      </tbody>
  </table>
	
</div>


</div>

</div>
</section>
</div>

@endsection
