<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Cash On Delivery Price Limit <small>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> Cash On Delivery</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if($errors): ?>
                                        <?php if($errors->any()): ?>
                                            <div <?php if($errors->first()=='Default can not Deleted!!'): ?> class="alert alert-danger alert-dismissible" <?php else: ?> class="alert alert-success alert-dismissible" <?php endif; ?> role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <?php echo e(trans('labels.DefaultLanguageChangedMessage')); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th>User Type</th>
                                            <th>Minimum Price</th>
                                            <th>Maximum Price</th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php $__currentLoopData = $result['cod_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cod_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                      <?php echo e($cod_list->cod_limit_id); ?>

                                                    </td>
                                                    
                                                    <td>
                                                        <?php if($cod_list->cod_user_type=='Normal'){echo "Normal User";} ?>
                                                        <?php if($cod_list->cod_user_type=='Corporate'){echo "Corporate User";} ?>
                                                    </td>

                                                    <td>
                                                      <?php echo e($cod_list->cod_min_price); ?>

                                                    </td>
                                                    <td>
                                                      <?php echo e($cod_list->cod_max_price); ?>

                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(url('admin/paymentmethods/cashOnDelivery/edit')); ?>/<?php echo e($cod_list->cod_limit_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <!-- /.row -->
            <!-- deletelanguagesModal -->

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/paymentmethods/cass_on_delivery.blade.php ENDPATH**/ ?>