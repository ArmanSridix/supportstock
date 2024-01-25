
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Cash On Delivery Price Limit Edit <small>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li class="active">Price Update</li>
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
                      <h3 class="box-title">
                        <?php if($result['cod_details'][0]->cod_user_type=='Normal'){echo "Normal User";} ?>
                        <?php if($result['cod_details'][0]->cod_user_type=='Corporate'){echo "Corporate User";} ?>
                      </h3>
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
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <?php echo e($errors->first()); ?>

                                      </div>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(session()->has('message')): ?>
                                    <div class="alert alert-success" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      <?php echo e(session()->get('message')); ?>

                                                  </div>
                                              <?php endif; ?>


                                    <!-- form start -->
                                    <div class="box-body">

                                        <?php echo Form::open(array('url' =>'admin/paymentmethods/updateCashOnDelivery', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>


                                        <input type="hidden" name="id" value="<?php echo e($id); ?>">

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Minimum Price</label>
                                          <div class="col-sm-10 col-md-6">
                                            <?php echo Form::text('cod_min_price',  $result['cod_details'][0]->cod_min_price, array('class'=>'form-control price-validate field-validate', 'id'=>'cod_min_price')); ?>

                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter minimum price</span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Maximum Price</label>
                                          <div class="col-sm-10 col-md-6">
                                            <?php echo Form::text('cod_max_price',  $result['cod_details'][0]->cod_max_price, array('class'=>'form-control price-validate field-validate', 'id'=>'cod_max_price')); ?>

                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter maximum price</span>
                                          </div>
                                        </div>                                   

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
                                            <a href="<?php echo e(URL::to('admin/paymentmethods/cashOnDelivery')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/paymentmethods/cass_on_delivery_edit.blade.php ENDPATH**/ ?>