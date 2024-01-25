
<?php $__env->startSection('content'); ?>

   




	<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="<?php echo e(URL::to('/')); ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;"> Cart </a>
               </div>
            </div>
         </div>
      </section>

        <?php if(session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session()->get('message')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>

      <section class="shop-single section-padding pt-3">
       <div class="cart block">
    <div class="container">


        <table class="cart__table cart-table">
            <thead class="cart-table__head">
                <tr class="cart-table__row">
                    <th class="cart-table__column cart-table__column--image">Image</th>
                    <th class="cart-table__column cart-table__column--product">Product</th>
                    <th class="cart-table__column cart-table__column--price">Price</th>
                    <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                    <th class="cart-table__column cart-table__column--price">Bulk Discount</th>
                    <th class="cart-table__column cart-table__column--total">Total</th>
                    <th class="cart-table__column cart-table__column--remove"></th>
                </tr>
            </thead>
            <tbody class="cart-table__body">

                <?php $finalProdDiscount = 0;
                $withoutDiscTotal = 0;
                $withDiscTotal = 0; ?>

                <?php if(count($result['cart'])>0): ?>
                  <?php $__currentLoopData = ($result['cart']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr class="cart-table__row">
                    <td class="cart-table__column cart-table__column--image">
                        <a href="<?php echo e(URL::to('/product-detail/'.$cart_products->products_id)); ?>"><img src="<?php echo e(asset('').$cart_products->image_path); ?>" alt="" /></a>
                    </td>
                    <td class="cart-table__column cart-table__column--product">
                        <a href="<?php echo e(URL::to('/product-detail/'.$cart_products->products_id)); ?>" class="cart-table__product-name"><?php echo e($cart_products->products_name); ?></a>
                       
                    </td>
                    <td class="cart-table__column cart-table__column--price" data-title="Price">₹<?php echo e($cart_products->final_price); ?></td>
                    <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                        <div class="input-number">
                            <input class="form-control input-number__input" type="number" min="1" value="<?php echo e($cart_products->customers_basket_quantity); ?>" id="cart_quantity_<?php echo $cart_products->customers_basket_id; ?>" />
                            <a class="input-number__add" onclick="editCartQuantity('<?php echo $cart_products->customers_basket_id; ?>','<?php echo $cart_products->products_id; ?>')" ></a>
                            <a class="input-number__sub" onclick="editCartQuantity('<?php echo $cart_products->customers_basket_id; ?>','<?php echo $cart_products->products_id; ?>')" ></a>
                        </div>
                    </td>
                    <td class="cart-table__column cart-table__column--price" data-title="Price">
                        <?php
                            if ($cart_products->prodDiscount!='') {
                                echo $cart_products->prodDiscount."%";
                            }else{
                                echo "N/A";
                            }
                        ?>
                    </td>
                    <td class="cart-table__column cart-table__column--total" data-title="Total">
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
                            echo "₹".$totalPrice;
                        ?>
                    </td>
                    <td class="cart-table__column cart-table__column--remove">
                        <a href="<?php echo e(URL::to('/deleteCart?id='.$cart_products->customers_basket_id)); ?>"  class="btn" >
                            <span class="fa fa-trash" style="color: red;"></span>
                        </a>
                    </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                    </tr>
                <?php endif; ?>
                
                
            </tbody>
        </table>

        <div class="cart__actions">
            <form class="cart__coupon-form">
                <!-- <label for="input-coupon-code" class="sr-only">Password</label> <input type="text" class="form-control" id="input-coupon-code" placeholder="Coupon Code" /> <button type="submit" class="btn btn-secondary">Apply Coupon</button> -->
            </form>
            <div class="cart__buttons"><a href="<?php echo e(URL::to('/')); ?>" class="btn btn-light">Continue Shopping</a> <!-- <a href="#" class="btn btn-secondary cart__update-button">Update Cart</a> --></div>
        </div>


        <div class="row justify-content-end pt-5">
            <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cart Totals</h3>
                        <table class="cart__totals">
                            <thead class="cart__totals-header">
                                <tr>
                                    <th>Subtotal</th>
                                    <td>₹<?php echo e($withoutDiscTotal); ?></td>
                                </tr>
                            </thead>
                            <tbody class="cart__totals-body">
                                <!-- <tr>
                                    <th>Shipping</th>
                                    <td>
                                        ₹25.00
                                        <div class="cart__calc-shipping"><a href="#">Calculate Shipping</a></div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <th>Discount</th>
                                    <td>₹<?php echo e($finalProdDiscount); ?></td>
                                </tr>
                            </tbody>
                            <tfoot class="cart__totals-footer">
                                <tr>
                                    <th>Total</th>
                                    <td>₹<?php echo e($withDiscTotal); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php if($withDiscTotal>0){ ?>
                            <a class="btn btn-secondary btn-lg btn-block cart__checkout-button" href="<?php echo e(URL::to('/checkout')); ?>">Proceed to checkout</a>
                        <?php }else{ ?>
                            <button class="btn btn-secondary btn-lg btn-block cart__checkout-button" disabled>Proceed to checkout</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

      </section>


    <script type="text/javascript">

        function editCartQuantity(customers_basket_id,products_id){
            var cart_quantity = $('#cart_quantity_'+customers_basket_id).val();
            //alert(cart_quantity);
            $.ajax({

                type:'POST',
                url:'<?php echo e(url('updateCartQuantity')); ?>',
                data:{customers_basket_id:customers_basket_id,products_id:products_id,cart_quantity:cart_quantity,"_token": "<?php echo e(csrf_token()); ?>"},
                success:function(data){
                  
                  location.reload();
                  
                }

            });

        }
        
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/viewcart.blade.php ENDPATH**/ ?>