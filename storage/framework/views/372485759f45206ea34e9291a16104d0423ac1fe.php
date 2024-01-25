<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.pincode')); ?> <small><?php echo e(trans('labels.EditCurrentPincode')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/pincode/display')); ?>"><i class="fa fa-language"></i><?php echo e(trans('labels.pincode')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.EditPincode')); ?></li>
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
                          <h3 class="box-title"><?php echo e(trans('labels.EditPincode')); ?></h3>
                      </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>                       
                        
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('message')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <?php if(session()->has('errorMessage')): ?>
                            <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(session()->get('errorMessage')); ?>

                            </div>
                        <?php endif; ?>
                                        <!-- form start -->
                                        <div class="box-body">

                                            <?php echo Form::open(array('url' =>'admin/pincode/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('pincodes_id',  $result['pincodes'][0]->pincodes_id, array('class'=>'form-control', 'id'=>'pincodes_id')); ?>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.pincodeCity')); ?><span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" name="pincodes_city_id">
                                                        <option value=""><?php echo e(trans('labels.ChooseCity')); ?></option>
                                                        <?php $__currentLoopData = $result['cities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($cities->cities_id); ?>" <?php echo ($result['pincodes'][0]->pincodes_city_id==$cities->cities_id)?'selected':''; ?> ><?php echo e($cities->cities_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        <?php echo e(trans('labels.ChooseCity')); ?>

                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.pincode')); ?><span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('pincodes_val',  $result['pincodes'][0]->pincodes_val, array('class'=>'form-control field-validate', 'id'=>'pincodes_val')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.examplePincode')); ?></span>
                                                    <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                </div>
                                            </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                    <a href="<?php echo e(URL::to('admin/pincode/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                                </div>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/pincodes/edit.blade.php ENDPATH**/ ?>