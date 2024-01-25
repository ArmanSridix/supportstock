
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> User Coupon <small>Edit User Coupon...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active">Edit User Coupon</li>
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
                            <h3 class="box-title">Edit User Coupon</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div  <?php if($errors->first() == 'Coupon has been updated successfully!'): ?> class="alert alert-success alert-dismissible" <?php else: ?> class="alert alert-danger alert-dismissible" <?php endif; ?> role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(Session::has('success')): ?>

                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo session('success'); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info"><br>

                                        <?php if(count($result['message'])>0): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($result['message']); ?>

                                            </div>
                                    <?php endif; ?>

                                    <!--<div class="box-header with-border">
                          <h3 class="box-title">Edit category</h3>
                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/coupons/updateUserCoupon', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Coupon')); ?> </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('code',  $result['coupon'][0]->code, array('class'=>'form-control field-validate', 'id'=>'code')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.AddCouponsTaxt')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.AddCouponsTaxt')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::textarea('description',  $result['coupon'][0]->description, array('class'=>'form-control field-validate', 'rows'=>'5', 'id'=>'description')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CouponDescriptionText')); ?></span>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.CouponAmount')); ?>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('amount',  $result['coupon'][0]->amount, array('class'=>'form-control number-validate', 'id'=>'amount')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.CouponAmountText')); ?></span>
                                                </div>
                                            </div>

                                            

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/coupons/new_user_coupon.blade.php ENDPATH**/ ?>