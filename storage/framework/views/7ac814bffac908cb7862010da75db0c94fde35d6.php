<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.EditProduct')); ?> <small><?php echo e(trans('labels.EditProduct')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/products/display')); ?>"><i class="fa fa-database"></i> <?php echo e(trans('labels.ListingAllProducts')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.EditProduct')); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo e(trans('labels.EditProduct')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <?php if( count($errors) > 0): ?>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <?php echo e($error); ?>

                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php echo Form::open(array('url' =>'admin/products/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                        <?php echo Form::hidden('id', $result['product'][0]->products_id, array('class'=>'form-control', 'id'=>'id')); ?>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Product Type')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control field-validate prodcust-type" name="products_type" onChange="prodcust_type();">
                                                            <option value=""><?php echo e(trans('labels.Choose Type')); ?></option>
                                                            <option value="0" <?php if($result['product'][0]->products_type==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.Simple')); ?></option>
                                                            <option value="1" <?php if($result['product'][0]->products_type==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Variable')); ?></option>
                                                            
                                                        </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.Product Type Text')); ?>.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Manufacturers')); ?> </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <select class="form-control" name="manufacturers_id">
                                                            <option value=""><?php echo e(trans('labels.ChooseManufacturers')); ?></option>
                                                            <?php $__currentLoopData = $result['manufacturer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($result['product'][0]->manufacturers_id == $manufacturer->id ): ?>
                                                                selected
                                                                <?php endif; ?>
                                                                value="<?php echo e($manufacturer->id); ?>"><?php echo e($manufacturer->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ChooseManufacturerText')); ?>.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-2 control-label"><?php echo e(trans('labels.Category')); ?></label>
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
                                                        <input class="form-check-input" type="checkbox" value="1" id="today_deal" name="today_deal" <?php echo $result['product'][0]->today_deal == 1?"checked":""; ?> >
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
                                                       
                                                        <input type="text" name="deal_start_date" id="deal_start_date" class="form-control datepicker" value="<?php echo $result['product'][0]->deal_start_date!=""?date('d/m/Y', strtotime($result['product'][0]->deal_start_date)):""; ?>" readonly>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter start date</span>
                                                        <span class="help-block hidden">Please enter start date</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">End Date </label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input type="text" name="deal_end_date" id="deal_end_date" class="form-control datepicker" value="<?php echo $result['product'][0]->deal_end_date!=""?date('d/m/Y', strtotime($result['product'][0]->deal_end_date)):""; ?>" readonly>

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
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault2" name="best_seller" <?php echo $result['product'][0]->best_seller == 1?"checked":""; ?> >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="flexCheckDefault3">Trending Product</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault3" name="trending_product" <?php echo $result['product'][0]->trending_product == 1?"checked":""; ?> >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label" for="flexCheckDefault4">Supportstock Assured</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault4" name="ss_assured" <?php echo $result['product'][0]->ss_assured == 1?"checked":""; ?>>
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
                                                    <?php echo Form::text('mrp_price', $result['product'][0]->mrp_price, array('class'=>'form-control number-validate', 'id'=>'mrp_price')); ?>

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
                                                        <?php echo Form::text('products_price', $result['product'][0]->products_price, array('class'=>'form-control number-validate', 'id'=>'products_price')); ?>

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

                                <?php
                                  $rowcounter = 1;   
                                  foreach($result['normal_price_list'] as $normal_price_list){ 
                                ?>
                                <div class="col-lg-12" id="NormalPriceDiv<?php echo $rowcounter ;?>">  

                                  <div class="row" style="margin-bottom: 4px;">
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="minimum_quantity[]" id="minimum_quantity<?php echo $rowcounter ;?>" value="<?php echo $normal_price_list->minimum_quantity; ?>" >
                                      </div>
                                    </div>
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="maximum_quantity[]" id="maximum_quantity<?php echo $rowcounter ;?>" value="<?php echo $normal_price_list->maximum_quantity; ?>" >
                                      </div>
                                    </div>
                                     
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control field-validate" name="discount_rate[]" id="discount_rate<?php echo $rowcounter ;?>" value="<?php echo $normal_price_list->discount_rate; ?>" >
                                      </div>
                                    </div>               
                                  </div>

                                </div> 
                                <?php $rowcounter++;} ?>
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
                                                        <?php echo Form::text('corporate_products_price', $result['product'][0]->corporate_products_price, array('class'=>'form-control number-validate', 'id'=>'corporate_products_price')); ?>

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

                                <?php
                                  $corp_rowcounter = 1;   
                                  foreach($result['corporate_price_list'] as $corporate_price_list){ 
                                ?>

                                <div class="col-lg-12" id="CorporatePriceDiv<?php echo $corp_rowcounter ;?>">  

                                  <div class="row" style="margin-bottom: 4px;">
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="corp_minimum_quantity[]" id="corp_minimum_quantity<?php echo $corp_rowcounter ;?>" value="<?php echo $corporate_price_list->minimum_quantity; ?>" >
                                      </div>
                                    </div>
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control" name="corp_maximum_quantity[]" id="corp_maximum_quantity<?php echo $corp_rowcounter ;?>" value="<?php echo $corporate_price_list->maximum_quantity; ?>" >
                                      </div>
                                    </div>
                                    
                                    <div class="col-sm-4">  
                                      <div class="form-group">
                                        <input type="number" class="form-control field-validate" name="corp_discount_rate[]" id="corp_discount_rate<?php echo $corp_rowcounter ;?>" value="<?php echo $corporate_price_list->discount_rate; ?>" >
                                      </div>
                                    </div>               
                                  </div>

                                </div>
                                <?php $corp_rowcounter++;} ?> 
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
                                                        <?php echo Form::text('products_sku', $result['product'][0]->products_sku, array('class'=>'form-control field-validate', 'id'=>'products_sku')); ?>

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
                                                            <option value="0" <?php if($result['product'][0]->is_feature==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.No')); ?></option>
                                                            <option value="1" <?php if($result['product'][0]->is_feature==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Yes')); ?></option>
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
                                                            <option value="1" <?php if($result['product'][0]->products_status==1): ?> selected <?php endif; ?> ><?php echo e(trans('labels.Active')); ?></option>
                                                            <option value="0" <?php if($result['product'][0]->products_status==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
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
                                                        <?php echo Form::text('products_min_order', $result['product'][0]->products_min_order, array('class'=>'form-control', 'id'=>'products_min_order')); ?>

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
                                                        <?php echo Form::text('products_max_stock', $result['product'][0]->products_max_stock, array('class'=>'form-control', 'id'=>'products_max_stock')); ?>

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
                                                            <option selected> <?php echo e(trans('labels.SelectTaxClass')); ?></option>
                                                            <?php $__currentLoopData = $result['taxClass']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($result['product'][0]->products_tax_class_id == $taxClass->tax_class_id ): ?>
                                                                selected
                                                                <?php endif; ?>
                                                                value="<?php echo e($taxClass->tax_class_id); ?>"><?php echo e($taxClass->tax_class_title); ?></option>
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
                                                        <?php echo Form::text('products_weight', $result['product'][0]->products_weight, array('class'=>'form-control', 'id'=>'products_weight')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.RequiredTextForWeight')); ?>

                                                        </span>

                                                    </div>
                                                    <div class="col-sm-10 col-md-4" style="padding-left: 0;">
                                                        <select class="form-control" name="products_weight_unit">
                                                            <?php if($result['units']): ?> !== null)
                                                            <?php $__currentLoopData = $result['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($unit->units_name); ?>" <?php if($result['product'][0]->products_weight_unit==$unit->units_name): ?> selected <?php endif; ?>><?php echo e($unit->units_name); ?></option>
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
                                                        <?php echo Form::text('products_model', $result['product'][0]->products_model, array('class'=>'form-control', 'id'=>'products_model')); ?>

                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                            <?php echo e(trans('labels.ProductsModelText')); ?>

                                                        </span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?> </label>
                                                    <div class="col-sm-10 col-md-4">

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel">Choose Image </h3>
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
                                                            <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

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


                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <?php echo Form::hidden('oldImage', $result['product'][0]->products_image , array('id'=>'oldImage', 'class'=>'field-validate ')); ?>

                                                        <img src="<?php echo e(asset($result['product'][0]->path)); ?>" alt="" width=" 100px">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        

                                        <hr>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="tabbable tabs-left">
                                                    <ul class="nav nav-tabs">
                                                        <?php
                                                        $i = 0;
                                                        ?>
                                                        <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="<?php if($i==0): ?> active <?php endif; ?>"><a href="#product_<?=$languages->languages_id?>" data-toggle="tab"><?=$languages->name?></a></li>
                                                        <?php
                                                        $i++;
                                                        ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <?php
                                                        $j = 0;
                                                        ?>
                                                        <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="margin-top: 15px;" class="tab-pane <?php if($j==0): ?> active <?php endif; ?>" id="product_<?=$description_data['languages_id']?>">
                                                            <?php
                                                            $j++;
                                                            ?>
                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ProductName')); ?> </label>
                                                                <div class="col-sm-10 col-md-4">
                                                                    <input type="text" name="products_name_<?=$description_data['languages_id']?>" class="form-control field-validate" value='<?php echo e($description_data['products_name']); ?>'>
                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        <?php echo e(trans('labels.EnterProductNameIn')); ?> <?php echo e($description_data['language_name']); ?> </span>
                                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>

                                                                </div>
                                                            </div>

                                                            <div class="form-group external_link" style="display: none">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.External URL')); ?> </label>
                                                                <div class="col-sm-10 col-md-4">
                                                                    <input type="text" name="products_url_<?=$description_data['languages_id']?>" class="form-control products_url" value='<?php echo e($description_data['products_url']); ?>'>
                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        <?php echo e(trans('labels.External URL Text')); ?> (<?php echo e($description_data['language_name']); ?>) </span>
                                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Description')); ?> </label>
                                                                <div class="col-sm-10 col-md-8">
                                                                    <textarea id="editor<?=$description_data['languages_id']?>" name="products_description_<?=$description_data['languages_id']?>" class="form-control"
                                                                      rows="5"><?php echo e(stripslashes($description_data['products_description'])); ?></textarea>

                                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                        <?php echo e(trans('labels.EnterProductDetailIn')); ?> <?php echo e($description_data['language_name']); ?></span> </div>
                                                            </div>

                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary pull-right" id="normal-btn"><?php echo e(trans('labels.Save_And_Continue')); ?> <i class="fa fa-angle-right 2x"></i></button>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();

    });
</script>

<script>
    $(document).ready(function(){

        /****************************************************/
        <?php if($result['product'][0]->today_deal == 1){ ?>
            $('#todayDealDiv').css('display','block');
            $('#deal_start_date').addClass("field-validate");
            $('#deal_end_date').addClass("field-validate");
        <?php }else{ ?>
            $('#todayDealDiv').css('display','none');
            $('#deal_start_date').removeClass("field-validate");
            $('#deal_end_date').removeClass("field-validate");
            $('#deal_start_date').val("");
            $('#deal_end_date').val("");
        <?php } ?>
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
        <?php
            $normal_price_list = $result['normal_price_list'];
            $normal_price_count = count($normal_price_list);
            if($normal_price_count>0){
        ?>
            var counter = <?php echo $normal_price_count; ?>;
            var counter = counter+1;
        <?php }else{ ?>
            var counter = 2;
        <?php } ?>

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
        <?php
            $corporate_price_list = $result['corporate_price_list'];
            $corporate_price_count = count($corporate_price_list);
            if($corporate_price_count>0){
        ?>
            var corp_counter = <?php echo $corporate_price_count; ?>;
            var corp_counter = corp_counter+1;
        <?php }else{ ?>
            var corp_counter = 2;
        <?php } ?>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/products/edit.blade.php ENDPATH**/ ?>