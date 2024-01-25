
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  Sell on supportstock <small>Sell on supportstock...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> Sell on supportstock</li>
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

                            <!-- <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <?php echo e(trans('labels.DefaultLanguageChangedMessage')); ?>

                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th style="width: 50%;">Feedback</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($sellList)>0): ?>
                                            <?php $__currentLoopData = $sellList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($sell->sell_on_support_id); ?></td>
                                                    <td><?php echo e($sell->sName); ?></td>
                                                    <td><?php echo e($sell->sEmail); ?></td>
                                                    <td><?php echo e($sell->sPhone); ?></td>
                                                    <td style="width: 50%;"><?php echo e($sell->sFeedback); ?></td>
                                                    <td><?php echo e(date("d-m-Y",strtotime($sell->created_at))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6">No record found..</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                        <?php if($sellList != null): ?>
                                        <div class="col-xs-12 text-right">
                                            <?php echo e($sellList->links()); ?>

                                        </div>
                                        <?php endif; ?>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/sell_support.blade.php ENDPATH**/ ?>