
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.manage admin_contact_us')); ?> <small><?php echo e(trans('labels.manage admin_contact_us')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.manage admin_contact_us')); ?></li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.manage admin_contact_us')); ?> </h3>
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

                                        <?php echo Form::open(array('url' =>'admin/updateContactUs', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>



                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label">Contact No</label>
                                          <div class="col-sm-10 col-md-6">
                                            <?php echo Form::text('contact_us_phone',  $contactDetails->contact_us_phone, array('class'=>'form-control phone-validate field-validate', 'id'=>'contact_us_phone')); ?>

                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.contactnotext')); ?></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.EmailAddress')); ?> </label>
                                          <div class="col-sm-10 col-md-6">
                                             <?php echo Form::text('contact_email',  $contactDetails->contact_email, array('class'=>'form-control email-validate', 'id'=>'contact_email')); ?>

                                             <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                             <?php echo e(trans('labels.EmailText')); ?></span>
                                            <span class="help-block hidden"> <?php echo e(trans('labels.EmailError')); ?></span>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.contactusaddress')); ?></label>
                                            <div class="col-sm-10 col-md-6">
                                                <?php echo Form::textarea('contact_address',  $contactDetails->contact_address, array('class'=>'form-control field-validate', 'rows'=>'5', 'id'=>'contact_address')); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.contactusaddresstext')); ?></span>
                                            </div>
                                        </div>                                       

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
                                            <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/contact_us/edit.blade.php ENDPATH**/ ?>