<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo e(trans('labels.Coupon Report')); ?> <small><?php echo e(trans('labels.Coupon Report')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Coupon Report')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->

    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo e(trans('labels.Filter')); ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body no-padding">
              <form  name='registration' method="get" action="<?php echo e(url('admin/couponreport')); ?>">
              <input type="hidden" name="type" value="all">
              <div class="box-body">
                <div class="col-xs-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Choose start and end date')); ?></label>
                    <input class="form-control reservation dateRange" placeholder="<?php echo e(trans('labels.Choose start and end date')); ?>" readonly value="<?php echo e(app('request')->input('dateRange')); ?>" name="dateRange" aria-label="Text input with multiple buttons ">
                  </div>
                </div>

                <div class="col-xs-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Coupon Code')); ?></label>
                    <input class="form-control" placeholder="<?php echo e(trans('labels.Coupon Code')); ?>" value="<?php echo e(app('request')->input('couponcode')); ?>" name="couponcode" aria-label="Text input with multiple buttons ">
                  </div>
                </div>
               
                <div class="col-xs-2" style="padding-top: 25px">                  
                  <div class="form-group">
                    <button class="btn btn-primary" id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    <?php if(app('request')->input('type') and app('request')->input('type') == 'all'): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/couponreport')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                  </div>
                </div>       
            </div>
              <!-- /.box-body -->

            </form>  
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
                <div class="col-lg-9 form-inline" id="contact-form">

                  </div>
                  <div class="box-tools pull-right">
                    <form action="<?php echo e(URL::to('admin/couponreport-print')); ?>" target="_blank">
                      <input type="hidden" name="page" value="invioce">
                      <input type="hidden" name="couponcode" value="<?php echo e(app('request')->input('couponcode')); ?>">
                      <input type="hidden" name="dateRange" value="<?php echo e(app('request')->input('dateRange')); ?>">
                      <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> <?php echo e(trans('labels.Print')); ?></button>
                    </form>
                  </div>
                </div>
                

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th><?php echo e(trans('labels.Coupon Code')); ?></th>
                      <th><?php echo e(trans('labels.Discount')); ?></th>
                      <th><?php echo e(trans('labels.OrderID')); ?></th>
                      <th><?php echo e(trans('labels.CustomerName')); ?></th>
                      <th><?php echo e(trans('labels.OrderTotal')); ?></th>
                      <th><?php echo e(trans('labels.Order Date')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['reports']['orders'])>0): ?>
                    <?php $__currentLoopData = $result['reports']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($orderData->coupon_code); ?></td>
                        <td><?php echo e($orderData->coupon_amount); ?></td>
                        <td><?php echo e($orderData->orders_id); ?></td>
                        <td><?php echo e($orderData->customers_name); ?></td>
                        <td>                            
                            <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($orderData->order_price); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
                        <td><?php echo e(date('d/m/Y', strtotime($orderData->date_purchased))); ?></td>
                        
                        <td>
                            <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="<?php echo e(trans('labels.View Invoice')); ?>" href="<?php echo e(url('admin/orders/invoiceprint/'.$orderData->orders_id)); ?>" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  	<tr>
                    	<td colspan="6"><strong><?php echo e(trans('labels.NoRecordFound')); ?></strong></td>
                    </tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <div class="col-xs-12" style="background: #eee;">


                  <?php
                    if($result['reports']['orders']->total()>0){
                      $fromrecord = ($result['reports']['orders']->currentpage()-1)*$result['reports']['orders']->perpage()+1;
                    }else{
                      $fromrecord = 0;
                    }
                    if($result['reports']['orders']->total() < $result['reports']['orders']->currentpage()*$result['reports']['orders']->perpage()){
                      $torecord = $result['reports']['orders']->total();
                    }else{
                      $torecord = $result['reports']['orders']->currentpage()*$result['reports']['orders']->perpage();
                    }

                  ?>
                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                    <div>Showing <?php echo e($fromrecord); ?> to <?php echo e($torecord); ?>

                        of  <?php echo e($result['reports']['orders']->total()); ?> entries
                    </div>
                  </div>
                <div class="col-xs-12 col-md-6 text-right">
                    <?php echo e($result['reports']['orders']->appends(\Request::except('type'))->render()); ?>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/reports/couponreport.blade.php ENDPATH**/ ?>