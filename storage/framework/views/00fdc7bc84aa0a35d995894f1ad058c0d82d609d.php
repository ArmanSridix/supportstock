
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.ShippingMethods')); ?> <small><?php echo e(trans('labels.ShippingMethods')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.ShippingMethods')); ?></li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> <?php echo e(trans('labels.ShippingMethods')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/shippingmethods/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if(count($errors) > 0): ?>
                                <?php if($errors->any()): ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                        <?php echo e(trans('labels.ShippingMethodsChangedMessage')); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped" style="text-align: center;">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;">Sl. No.</th>
                                            <th style="text-align: center;">From</th>
                                            <th style="text-align: center;">To</th>
                                            <th style="text-align: center;">Shipping Rate</th>
                                            <th style="text-align: center;"><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($shipping_rate != null): ?>
                                                <?php $__currentLoopData = $shipping_rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key+1); ?></td>
                                                        <td><?php echo e($shipping->amount_from); ?></td>
                                                        <td><?php echo e($shipping->amount_to); ?></td>
                                                        <td><?php echo e($shipping->shipping_rate); ?></td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(URL::to('admin/shippingmethods/edit/'.$shipping->id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                            <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteshippingrate" shipping_rate_id="<?php echo e($shipping->id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6"><?php echo e(trans('labels.NoRecordFound')); ?>.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteshippingrateModal" tabindex="-1" role="dialog" aria-labelledby="deleteshippingrateModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteshippingrateModalLabel">Delete Shipping Rate.</h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/shippingmethods/delete', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'shipping_rate_id')); ?>

                        <div class="modal-body">
                            <p>Delete</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deletefaq"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/shippingmethods/index.blade.php ENDPATH**/ ?>