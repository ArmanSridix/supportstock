<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  <?php echo e(trans('labels.reasonOfCancel')); ?> <small><?php echo e(trans('labels.reasonOfCancel')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> <?php echo e(trans('labels.reasonOfCancel')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.ListingReasonOfCancelOrder')); ?> </h3>
                            <div class="box-tools pull-right">
                                <a href="addReasonOfCancelOrder" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.addreasonOfCancel')); ?></a>
                            </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans('labels.ID')); ?></th>
                                            <th><?php echo e(trans('labels.Reasons')); ?></th>
                                            <th><?php echo e(trans('labels.Status')); ?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $result['orders_cancle_reasons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders_cancle_reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($orders_cancle_reason->reason_id); ?></td>
                                                <td><?php echo e($orders_cancle_reason->status_reason); ?></td>
                                                <td>
                                                <?php if($orders_cancle_reason->reason_status==0): ?> 
                                                <span class="badge badge-secondary">Disable</span>
                                                 <?php elseif($orders_cancle_reason->reason_status==1): ?>
                                                 <span class="badge" style="background-color:'green' !important;">Active</span>
                                                 <?php endif; ?>
                                                </td>
                                               
                                                <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editReasonOfCancelOrder/<?php echo e($orders_cancle_reason->reason_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                     <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteReasonOfCancelOrder" reason_id ="<?php echo e($orders_cancle_reason->reason_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        <?php echo e($result['orders_cancle_reasons']->links()); ?>

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
            <!-- deleteOrderStatusModal -->
            <div class="modal fade" id="deleteReasonOfCancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="deleteReasonOfCancelOrder">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteReasonOfCancelOrder"><?php echo e(trans('labels.DeleteOrderStatus')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/orders/deleteReasonOfCancelOrder', 'name'=>'deleteOrderStatus', 'id'=>'deleteOrderStatus', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('reason_id',  '', array('class'=>'form-control', 'id'=>'reason_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.deletereasonOfCancelText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteOrderStatus"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/Orders/reasonofcancel.blade.php ENDPATH**/ ?>