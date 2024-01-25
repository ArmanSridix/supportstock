<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.EditCustomers')); ?> <small><?php echo e(trans('labels.EditCurrentCustomers')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/customers/display')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.ListingAllCustomers')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.EditCustomers')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.EditCustomers')); ?> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit category</h3>
                                        </div>-->
                                    <!-- /.box-header -->
                                    <br>
                                    <?php if(count($errors) > 0): ?>
                                      <?php if($errors->any()): ?>
                                      <div class="alert alert-danger alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <?php echo e($errors->first()); ?>

                                      </div>
                                      <?php endif; ?>
                                    <?php endif; ?>


                                    <!-- form start -->
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/customers/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                        <?php echo Form::hidden('customers_id', $data['customers']->id, array('class'=>'form-control', 'id'=>'id')); ?>


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">User Type </label>
                                            <div class="col-sm-10 col-md-4">
                                              <select class="form-control field-validate" name="user_type" id="user_type">
                                                <option value="">Select User Type</option>
                                                <option value="Normal" <?php echo $data['customers']->user_type=="Normal"?"selected":""; ?> >Normal User</option>
                                                <option value="Corporate" <?php echo $data['customers']->user_type=="Corporate"?"selected":""; ?> >Corporate User</option>
                                              </select>
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                            Please select user type.</span>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group" id="subscription_div" style="display: none;" >

                                            <?php
                                                // $toDay = date('Y-m-d 00:00:00');
                                                // if ($toDay>=$data['customers']->subscription_start && $toDay<=$data['customers']->subscription_end) { ?>
                                                    <label for="" class="col-sm-2 col-md-3 control-label">Subscription Enable </label>
                                                    
                                            <?php // }else{ ?>

                                            <label for="" class="col-sm-2 col-md-3 control-label">Subscription Period </label>
                                            <div class="col-sm-10 col-md-4">
                                              <select class="form-control" name="subscription_period">
                                                <option value="">Select subscription period</option>
                                                <option value="30" <?php //echo $data['customers']->subscription_period=="30"?"selected":""; ?> >30 Days</option>
                                                <option value="60" <?php //echo $data['customers']->subscription_period=="60"?"selected":""; ?> >60 Days</option>
                                              </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please select subscription period.</span>
                                            </div>

                                            <?php //} ?>

                                        </div> -->
                                        <div id="subscription_div" style="display: none;" >
                                          <?php 
                                            $data['customers']->subscription_start == null ? $sub_start = '': $sub_start = date("d/m/Y",strtotime($data['customers']->subscription_start));
                                            $data['customers']->subscription_end == null ? $sub_end = '': $sub_end = date("d/m/Y",strtotime($data['customers']->subscription_end));
                                          ?>
                                          <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Start Date </label>
                                            <div class="col-sm-10 col-md-4">
                                              <?php echo Form::text('subscription_start_date', $sub_start, array('class'=>'form-control datepicker', 'id'=>'subscription_start_date', 'readonly'=>'readonly')); ?>

                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter start date.</span>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">End Date </label>
                                            <div class="col-sm-10 col-md-4">
                                            <?php echo Form::text('subscription_end_date', $sub_end , array('class'=>'form-control datepicker', 'id'=>'subscription_end_date', 'readonly'=>'readonly')); ?>

                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter end date.</span>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- <?php //if($data['customers']->subscription_start!=NULL){ ?>
                                        <div class="form-group subscription_date_div" style="display: none;" >
                                            <label for="" class="col-sm-2 col-md-3 control-label">Subscription From </label>
                                            <div class="col-sm-10 col-md-4">
                                                <p><?php echo e(date("d-m-Y",strtotime($data['customers']->subscription_start))); ?></p>
                                            </div>                                           
                                        </div>
                                        <?php //} ?>
                                        <?php //if($data['customers']->subscription_end!=NULL){ ?>
                                        <div class="form-group subscription_date_div" style="display: none;" >
                                            <label for="" class="col-sm-2 col-md-3 control-label">Subscription To </label>
                                            <div class="col-sm-10 col-md-4">
                                                <p><?php echo e(date("d-m-Y",strtotime($data['customers']->subscription_end))); ?></p>
                                            </div>                                           
                                        </div>
                                        <?php //} ?> -->

                                        <hr>
                                            <h4><?php echo e(trans('labels.Personal Info')); ?> </h4>
                                        <hr>

                                        <div class="form-group" id="company_div" style="display: none;">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Company Name </label>
                                            <div class="col-sm-10 col-md-4">
                                              <?php echo Form::text('company_name',$data['customers']->company_name, array('class'=>'form-control', 'id'=>'company_name')); ?>

                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter company name.</span>
                                              <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.FirstName')); ?>* </label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('first_name', $data['customers']->first_name, array('class'=>'form-control field-validate', 'id'=>'first_name')); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.FirstNameText')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.LastName')); ?>*</label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::text('last_name', $data['customers']->last_name , array('class'=>'form-control field-validate', 'id'=>'last_name')); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.lastNameText')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>
                                       

                                      
                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Telephone')); ?></label>
                                          <div class="col-sm-10 col-md-4">
                                            <?php echo Form::text('phone',  $data['customers']->phone, array('class'=>'form-control phone-validate', 'id'=>'phone')); ?>

                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.TelephoneText')); ?></span>
                                          </div>
                                        </div>

                                        <div id="corporate_cat" style="display: none;">
                                            <hr>
                                               <h4>Assign Category/Product</h4>
                                            <hr>

                                            <div class="form-group">
                                              <label for="" class="col-sm-2 col-md-3 control-label">Assign Type </label>
                                              <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="assign_type" id="assign_type">
                                                  <option value="">Please choose one</option>
                                                  <option value="Category" <?php echo $data['customers']->assign_type=="Category"?"selected":""; ?> >Category</option>
                                                  <option value="Product" <?php echo $data['customers']->assign_type=="Product"?"selected":""; ?> >Product</option>
                                                </select>
                                              <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                              Please choose one.</span>
                                              </div>
                                            </div>

                                            <div class="row" id="category_div" style="display: none;">
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

                                            <div class="form-group" id="product_div" style="display: none;">
                                              <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Products')); ?></label>
                                              <div class="col-sm-10 col-md-7 couponProdcuts">
                                                  <select name="product_ids[]" multiple class="form-control select2 " style="width: 100%;" >
                                                      <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                          <option value="<?php echo e($products->products_id); ?>" <?php if(in_array($products->products_id, $userProductArray)): ?> selected <?php endif; ?> ><?php echo e($products->products_name); ?> ( <?php echo e($products->products_sku); ?> )</option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  </select>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">List of product to get discount.</span>
                                              </div>
                                            </div>

                                            <br>
                                          </div>

                                        <hr>
                                            <h4><?php echo e(trans('labels.Login Info')); ?></h4>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.EmailAddress')); ?> </label>
                                            <div class="col-sm-10 col-md-4">
                                              <?php echo Form::text('email',$data['customers']->email, array('class'=>'form-control email-validate', 'id'=>'email')); ?>

                                               <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                               <?php echo e(trans('labels.EmailText')); ?></span>
                                              <span class="help-block hidden"> <?php echo e(trans('labels.EmailError')); ?></span>
                                            </div>
                                          </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.changePassword')); ?></label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::checkbox('changePassword', 'yes', null, ['class' => '', 'id'=>'change-passowrd']); ?>

                                            </div>
                                        </div>

                                        <!-- <div class="form-group password_content">-->
                                        <div class="form-group password" style="display: none">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Password')); ?>*</label>
                                            <div class="col-sm-10 col-md-4">
                                                <?php echo Form::password('password', array('class'=>'form-control ', 'id'=>'password')); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    <?php echo e(trans('labels.PasswordText')); ?></span>
                                                <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?>

                                            </label>
                                            <div class="col-sm-10 col-md-4">
                                                <select class="form-control" name="status">
                                                    <option <?php if($data['customers']->status == 1): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="1"><?php echo e(trans('labels.Active')); ?></option>
                                                    <option <?php if($data['customers']->status == 0): ?>
                                                        selected
                                                        <?php endif; ?>
                                                        value="0"><?php echo e(trans('labels.Inactive')); ?></option>
                                                </select><span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.StatusText')); ?></span>

                                            </div>
                                        </div>

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
                                            <a href="<?php echo e(URL::to('admin/customers/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<script type="text/javascript">
  $(document).ready(function(){

    <?php if(isset($data['customers'])){ ?>
    var user_type = '<?php echo $data['customers']->user_type; ?>';
    if(user_type=='Normal'){
        $('#company_div').css('display','none');
        $('#company_name').removeClass("field-validate");

        $('#corporate_cat').css('display','none');

        $('#subscription_div').css('display','none');
        $('.subscription_date_div').css('display','none');

        $("#assign_type").val("");
      }else if(user_type=='Corporate'){
        $('#company_div').css('display','block');
        $('#company_name').addClass("field-validate");

        $('#corporate_cat').css('display','block');

        $('#subscription_div').css('display','block');
        $('.subscription_date_div').css('display','block');
      }else{
        $('#company_div').css('display','none');
        $('#company_name').removeClass("field-validate");

        $('#corporate_cat').css('display','none');

        $('#subscription_div').css('display','none');
        $('.subscription_date_div').css('display','none');

        $("#assign_type").val("");
      }
    <?php } ?>


    $("#user_type").change(function(){
      var user_type = $("#user_type").val();  
      if(user_type=='Normal'){
        $('#company_div').css('display','none');
        $('#company_name').removeClass("field-validate");

        $('#corporate_cat').css('display','none');

        $('#subscription_div').css('display','none');
        $('.subscription_date_div').css('display','none');

        $("#assign_type").val("");
      }else if(user_type=='Corporate'){
        $('#company_div').css('display','block');
        $('#company_name').addClass("field-validate");

        $('#corporate_cat').css('display','block');

        $('#subscription_div').css('display','block');
        $('.subscription_date_div').css('display','block');
      }else{
        $('#company_div').css('display','none');
        $('#company_name').removeClass("field-validate");

        $('#corporate_cat').css('display','none');

        $('#subscription_div').css('display','none');
        $('.subscription_date_div').css('display','none');

        $("#assign_type").val("");
      }
    });


    <?php if(isset($data['customers'])){ ?>
    var assign_type = '<?php echo $data['customers']->assign_type; ?>';
    if(assign_type=='Category'){
        $('#category_div').css('display','block');
        $('#product_div').css('display','none');
      }else if(assign_type=='Product'){
        $('#category_div').css('display','none');
        $('#product_div').css('display','block');
      }else{
        $('#category_div').css('display','none');
        $('#product_div').css('display','none');
      }
    <?php } ?>

    $("#assign_type").change(function(){
      var assign_type = $("#assign_type").val();  
      if(assign_type=='Category'){
        $('#category_div').css('display','block');
        $('#product_div').css('display','none');
      }else if(assign_type=='Product'){
        $('#category_div').css('display','none');
        $('#product_div').css('display','block');
      }else{
        $('#category_div').css('display','none');
        $('#product_div').css('display','none');
      }
    });

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/customers/edit.blade.php ENDPATH**/ ?>