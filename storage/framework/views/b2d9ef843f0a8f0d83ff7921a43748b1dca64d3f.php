<?php $__env->startSection('content'); ?>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 10px;
}
</style>
<?php 
$length = 10;    
$sku = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length).$result['prev_product_id']->products_id;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.AddProduct')); ?> <small><?php echo e(trans('labels.AddProduct')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-database"></i> <?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.AddProduct')); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(trans('labels.AddNewProduct')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <?php if( count($errors) > 0): ?>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                            <?php echo e($error); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php echo Form::open(array('url' =>'admin/products/add', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Product Type')); ?><span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                                            <option value=""><?php echo e(trans('labels.Choose Type')); ?></option>
                                                            <option value="0"><?php echo e(trans('labels.Simple')); ?></option>
                                                            <option value="1"><?php echo e(trans('labels.Variable')); ?></option>
                                                            
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.Product Type Text')); ?>.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Manufacturers')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate" name="manufacturers_id">
                                                            <option value=""><?php echo e(trans('labels.ChooseManufacturers')); ?></option>
                                                            <?php $__currentLoopData = $result['manufacturer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($manufacturer->id); ?>"><?php echo e($manufacturer->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ChooseManufacturerText')); ?>.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-2 control-label"><?php echo e(trans('labels.Category')); ?><span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-9">
                                                        <?php print_r($result['categories']); ?>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ChooseCatgoryText')); ?>.</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="today_deal">Todays Deals</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="today_deal" name="today_deal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">&nbsp;</div>
                                        </div>

                                        <div class="row" id="todayDealDiv" style="display: none;">

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Start Date </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('deal_start_date',  '', array('class'=>'form-control datepicker', 'id'=>'deal_start_date', 'readonly'=>'readonly')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter start date</span>
                                                        <span class="help-block hidden">Please enter start date</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">End Date </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('deal_end_date',  '', array('class'=>'form-control datepicker', 'id'=>'deal_end_date', 'readonly'=>'readonly')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter end date</span>
                                                        <span class="help-block hidden">Please enter end date</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="flexCheckDefault2">Best Seller</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault2" name="best_seller">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="flexCheckDefault3">Trending Product</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault3" name="trending_product">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="flexCheckDefault4">Supportstock Assured</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault4" name="ss_assured">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <h2>Product Price</h2>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">MRP Price<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-5">
                                                    <?php echo Form::text('mrp_price', '', array('class'=>'form-control number-validate', 'id'=>'mrp_price')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        <?php echo e(trans('labels.ProductPriceText')); ?>

                                                    </span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.ProductPriceText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <h3>Normal User</h3>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductsPrice')); ?><span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('products_price', '', array('class'=>'form-control number-validate', 'id'=>'products_price')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductPriceText')); ?>

                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.ProductPriceText')); ?></span>
                                                    </div>
                                                </div>

                            <!------- product cost ------->
                        
                        <div class="row" style="padding-left: 7px;padding-right: 7px;">
                            <div class="col-xs-12">

                              <div class="row" style="border-bottom: 2px black;">
                                <div class="col-sm-4"><h4> Minimum Quantity </h4></div>
                                <div class="col-sm-4"> <h4> Maximum Quantity </h4></div>
                                <!-- <div class="col-sm-3"> <h4> Price </h4></div> -->
                                <div class="col-sm-4"> <h4> Discount(%) </h4></div>
                              </div>

                              <div class="row input_sec" id='NormalPriceGroup'>
                                <div class="col-lg-12" id="NormalPriceDiv1">  

                                  <div class="row" style="margin-bottom: 4px;">
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="minimum_quantity[]" id="minimum_quantity1" >
                                      </div>
                                    </div>
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="maximum_quantity[]" id="maximum_quantity1" >
                                      </div>
                                    </div>
                                     
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control field-validate" name="discount_rate[]" id="discount_rate1" >
                                      </div>
                                    </div>               
                                  </div>

                                </div> 
                              </div>

                              <br>
                              <button class="btn btn-success" style="border-radius: 100%;" type='button' value='Add' id='addButton'> <i class="fa fa-plus"></i> </button>                  
                              <button class="btn btn-danger" style="border-radius: 100%;"  type='button' value='Remove' id='removeButton' > <i class="fa fa-minus"></i> </button>
                                
                            </div>
                        </div>
                        <!------- product cost ------->

                        </div>

                        <div class="col-xs-12 col-md-6">
                            <h3>Corporate User</h3>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductsPrice')); ?><span style="color:red;">*</span></label>
                                <div class="col-sm-10 col-md-8">
                                    <?php echo Form::text('corporate_products_price', '', array('class'=>'form-control number-validate', 'id'=>'corporate_products_price')); ?>

                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                        <?php echo e(trans('labels.ProductPriceText')); ?>

                                    </span>
                                    <span class="help-block hidden"><?php echo e(trans('labels.ProductPriceText')); ?></span>
                                </div>
                            </div>

                        <!------- product cost ------->
                        
                        <div class="row" style="padding-left: 7px;padding-right: 7px;">
                            <div class="col-xs-12">

                              <div class="row" style="border-bottom: 2px black;">
                                <div class="col-sm-4"><h4> Minimum Quantity </h4></div>
                                <div class="col-sm-4"> <h4> Maximum Quantity </h4></div>
                                <!-- <div class="col-sm-3"> <h4> Price </h4></div> -->
                                <div class="col-sm-4"> <h4> Discount(%) </h4></div>
                              </div>

                              <div class="row input_sec" id='CorporatePriceGroup'>
                                <div class="col-lg-12" id="CorporatePriceDiv1">  

                                  <div class="row" style="margin-bottom: 4px;">
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="corp_minimum_quantity[]" id="corp_minimum_quantity1" >
                                      </div>
                                    </div>
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="corp_maximum_quantity[]" id="corp_maximum_quantity1" >
                                      </div>
                                    </div>
                                    
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control field-validate" name="corp_discount_rate[]" id="corp_discount_rate1" >
                                      </div>
                                    </div>               
                                  </div>

                                </div> 
                              </div>

                              <br>
                              <button class="btn btn-success" style="border-radius: 100%;" type='button' value='Add' id='corpAddButton'> <i class="fa fa-plus"></i> </button>                  
                              <button class="btn btn-danger" style="border-radius: 100%;"  type='button' value='Remove' id='corpRemoveButton' > <i class="fa fa-minus"></i> </button>
                                
                            </div>
                        </div>
                        <!------- product cost ------->

                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">SKU Code</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('products_sku', $sku, array('class'=>'form-control field-validate', 'id'=>'products_sku', 'readonly'=>'readonly')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Enter product sku code.
                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.IsFeature')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="is_feature">
                                                            <option value="0"><?php echo e(trans('labels.No')); ?></option>
                                                            <option value="1"><?php echo e(trans('labels.Yes')); ?></option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.IsFeatureProuctsText')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="products_status">
                                                            <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                                            <option value="0"><?php echo e(trans('labels.Inactive')); ?></option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.SelectStatus')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Min Order Limit')); ?></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('products_min_order', '1', array('class'=>'form-control field-validate number-validate', 'id'=>'products_min_order')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.Min Order Limit Text')); ?>

                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.Min Order Limit Text')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Max Order Limit')); ?></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('products_max_stock', '', array('class'=>'form-control ', 'id'=>'products_max_stock')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.Max Order Limit Text')); ?>

                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.Max Order Limit Text')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group" id="tax-class">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.TaxClass')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate" name="tax_class_id">
                                                            <option selected><?php echo e(trans('labels.SelectTaxClass')); ?></option>
                                                            <?php $__currentLoopData = $result['taxClass']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($taxClass->tax_class_id); ?>"><?php echo e($taxClass->tax_class_title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Choose tax class in which this product belongs. You can add them from Tax link.
                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.SelectProductTaxClass')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductsWeight')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::text('products_weight', '', array('class'=>'form-control', 'id'=>'products_weight')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.RequiredTextForWeight')); ?>

                                                        </span>
                                                    </div>
                                                    <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="products_weight_unit">
                                                            <?php if($result['units'] !== null): ?>
                                                            <?php $__currentLoopData = $result['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($unit->units_name); ?>"><?php echo e($unit->units_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductsModel')); ?></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <?php echo Form::text('products_model', '', array('class'=>'form-control', 'id'=>'products_model')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductsModelText')); ?>

                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 ">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?><span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?></h3>
                                                                    </div>
                                                                    <div class="modal-body manufacturer-image-embed">
                                                                        <?php if(isset($allimage)): ?>
                                                                        <select class="image-picker show-html " name="image_id" id="select_img">
                                                                            <option value=""></option>
                                                                            <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left"><?php echo e(trans('labels.Add Image')); ?></a>
                                                                        <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                        <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div id="imageselected">
                                                          <?php echo Form::button( trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                          <br>
                                                          <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                          <div class="closimage">
                                                              <button type="button" class="close pull-left image-close " id="image-close"
                                                                style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                              </button>
                                                          </div>
                                                        </div>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.UploadProductImageText')); ?></span>

                                                    </div>
                                                </div>
                                            </div>

                                            

                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Cancelation Period (In Days)<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input name="cancelation_period" class="form-control number-validate">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter only numreic value.</span>
                                                        <span class="help-block hidden">Please enter only numreic value.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Return Period (In Days)<span style="color:red;">*</span></label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input name="return_period" class="form-control number-validate">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            Please enter only numreic value.</span>
                                                        <span class="help-block hidden">Please enter only numreic value.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        

                                        <hr>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="<?php if($key==0): ?> active <?php endif; ?>"><a href="#product_<?=$languages->languages_id?>" data-toggle="tab"><?=$languages->name?><span style="color:red;">*</span></a></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <div style="margin-top: 15px;" class="tab-pane <?php if($key==0): ?> active <?php endif; ?>" id="product_<?=$languages->languages_id?>">
                                                            <div class="">
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductName')); ?><span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="products_name_<?=$languages->languages_id?>" class="form-control field-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.EnterProductNameIn')); ?> <?php echo e($languages->name); ?> </span>
                                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group external_link" style="display: none">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.External URL')); ?> (<?php echo e($languages->name); ?>)</label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="products_url_<?=$languages->languages_id?>" class="form-control products_url">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.External URL Text')); ?> <?php echo e($languages->name); ?> </span>
                                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Description')); ?><span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="editor<?=$languages->languages_id?>" name="products_description_<?=$languages->languages_id?>" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.EnterProductDetailIn')); ?> <?php echo e($languages->name); ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Quick Overview<span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <textarea id="pro_quick_overview<?=$languages->languages_id?>" name="pro_quick_overview_<?=$languages->languages_id?>" class="form-control" rows="5"></textarea>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            <?php echo e(trans('labels.EnterProductDetailIn')); ?> <?php echo e($languages->name); ?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <span><?php echo e(trans('labels.Save_And_Continue')); ?></span>
                                                <i class="fa fa-angle-right 2x"></i>
                                            </button>
                                        </div>

                                        <!-- /.box-footer -->
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo asset('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<script type="text/javascript">
    $(function() {

        //for multiple languages
        <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor<?php echo e($languages->languages_id); ?>');
        CKEDITOR.replace('pro_quick_overview<?php echo e($languages->languages_id); ?>');

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>

<script>
    $(document).ready(function(){

        /****************************************************/
        $("#today_deal").change(function () {
            if ($(this).is(":checked")) {
                $('#todayDealDiv').css('display','block');
                $('#deal_start_date').addClass("field-validate");
                $('#deal_end_date').addClass("field-validate");
            }else {
                $('#todayDealDiv').css('display','none');
                $('#deal_start_date').removeClass("field-validate");
                $('#deal_end_date').removeClass("field-validate");
                $('#deal_start_date').val("");
                $('#deal_end_date').val("");
            }
        });
        /****************************************************/
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /*********************** add row *****************************/
        var counter = 2;

        $("#addButton").click(function () {              

            if (counter>2) {
                var ct = counter-1;
                var ct_pre = ct-1;
                var minimum_quantity = $("#minimum_quantity"+ct).val();
                var maximum_quantity = $("#maximum_quantity"+ct_pre).val();

                if (minimum_quantity=='') {
                    alert("Please enter minimum quantity.");
                    return false;
                }

                if(minimum_quantity<=maximum_quantity){
                    alert("Minimum quantity must be greater than previous maximum quantity.");
                    return false;
                }
            }

            if (counter>1) {
                var cnt = counter-1;
                var maximm_quant = $("#maximum_quantity"+cnt).val();

                if(maximm_quant==''){
                    alert("Please enter maximum quantity.");
                    return false;
                }
            }
            
          var newTextBoxDiv = $(document.createElement('div')).attr("id", 'NormalPriceDiv'+counter).attr("class", 'col-lg-12');          

          newTextBoxDiv.after().html('<div class="row" style="margin-bottom: 4px;"> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control" name="minimum_quantity[]" id="minimum_quantity'+counter+'" > </div> </div> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control" name="maximum_quantity[]" id="maximum_quantity'+counter+'" > </div> </div> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control field-validate" name="discount_rate[]" id="discount_rate'+counter+'" > </div> </div> </div>');
                
          newTextBoxDiv.appendTo("#NormalPriceGroup");               
          counter++;
       
        });

        $("#removeButton").click(function () {
          if(counter==1){
            alert("No more textbox to remove");
            return false;
          }   
            
          counter--;  
          $("#NormalPriceDiv" + counter).remove();

        });

        /*********************** add row end *****************************/


        /*********************** add corporate row *****************************/
        var corp_counter = 2;

        $("#corpAddButton").click(function () {              

            if (corp_counter>2) {
                var corp_ct = corp_counter-1;
                var corp_ct_pre = corp_ct-1;
                var corp_minimum_quantity = $("#corp_minimum_quantity"+corp_ct).val();
                var corp_maximum_quantity = $("#corp_maximum_quantity"+corp_ct_pre).val();

                if (corp_minimum_quantity=='') {
                    alert("Please enter minimum quantity.");
                    return false;
                }

                if(corp_minimum_quantity<=corp_maximum_quantity){
                    alert("Minimum quantity must be greater than previous maximum quantity.");
                    return false;
                }
            }

            if (corp_counter>1) {
                var corp_cnt = corp_counter-1;
                var corp_maximm_quant = $("#corp_maximum_quantity"+corp_cnt).val();

                if(corp_maximm_quant==''){
                    alert("Please enter maximum quantity.");
                    return false;
                }
            }
            
          var corp_newTextBoxDiv = $(document.createElement('div')).attr("id", 'CorporatePriceDiv'+corp_counter).attr("class", 'col-lg-12');          

          corp_newTextBoxDiv.after().html('<div class="row" style="margin-bottom: 4px;"> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control" name="corp_minimum_quantity[]" id="corp_minimum_quantity'+corp_counter+'" > </div> </div> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control" name="corp_maximum_quantity[]" id="corp_maximum_quantity'+corp_counter+'" > </div> </div> <div class="col-sm-4"> <div class="form-group"> <input type="number" class="form-control field-validate" name="corp_discount_rate[]" id="corp_discount_rate'+corp_counter+'" > </div> </div> </div>');
                
          corp_newTextBoxDiv.appendTo("#CorporatePriceGroup");               
          corp_counter++;
       
        });

        $("#corpRemoveButton").click(function () {
          if(corp_counter==1){
            alert("No more textbox to remove");
            return false;
          }   
            
          corp_counter--;  
          $("#CorporatePriceDiv" + corp_counter).remove();

        });

        /*********************** add corporate row end *****************************/

      });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp7432\htdocs\suportstock\resources\views/admin/products/add.blade.php ENDPATH**/ ?>