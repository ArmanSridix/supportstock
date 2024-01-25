<?php $__env->startSection('content'); ?>

<style type="text/css">
    .order-dt-img {
        background: #f9f9f9;
        padding: 10px;
        border: 1px solid #efefef;
        border-radius: 5px;
        width: 60px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> KYC <small>KYC List...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/customers/display')); ?>"><i class="fa fa-users"></i> <?php echo e(trans('labels.ListingAllCustomers')); ?></a></li>
            <li class="active">KYC</li>
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
                        <div class="container-fluid">
                            
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
                                            <th>ID</th>
                                            <th>Title </th>
                                            <th>File </th>
                                            <th>Upload Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($result['allKyc'])>0): ?>
                                        <?php $__currentLoopData = $result['allKyc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$allKyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($allKyc->corporate_kyc_id); ?></td>
                                            <td><?php echo e($allKyc->kyc_title); ?></td>
                                            <td>
                                                <a href="<?php echo e(asset('upload_file/kyc').'/'.$allKyc->kyc_file); ?>" target="_blank">
                                                    <img src="<?php echo e(asset('upload_file/kyc').'/'.$allKyc->kyc_file); ?>" alt="" height="50px">
                                                </a>
                                            </td>
                                            <td><?php echo e(date('d-m-Y', strtotime($allKyc->created_at))); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="4"><?php echo e(trans('labels.NoRecordFound')); ?></td>
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

        <!-- /.row -->

        

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/customers/view_kyc.blade.php ENDPATH**/ ?>