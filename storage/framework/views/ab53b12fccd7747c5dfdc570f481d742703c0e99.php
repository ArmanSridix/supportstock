<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><?php echo e(trans('labels.Sales Report')); ?> <small><?php echo e(trans('labels.Sales Report')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Sales Report')); ?></li>
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
                <div class="col-lg-9 form-inline" id="contact-form">
                    
                    <form method="get" action="<?php echo e(url('admin/salesreport')); ?>">
                        <input type="hidden" name="type"  value="id">
                        <input type="hidden"  value="<?php echo e(csrf_token()); ?>">
                        
                        <div class="col-xs-3">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo e(trans('labels.Choose start and end date')); ?></label>
                            <input class="form-control reservation dateRange" placeholder="<?php echo e(trans('labels.Choose start and end date')); ?>" readonly value="<?php echo e(app('request')->input('dateRange')); ?>" name="dateRange" aria-label="Text input with multiple buttons ">
                          </div>
                        </div>

                        <div class="col-xs-2" style="padding-top: 25px">                  
                          <div class="form-group">
                            <button class="btn btn-primary" id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            <?php if(app('request')->input('type') and app('request')->input('type') == 'all'): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/salesreport')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                          </div>
                        </div>   
                    </form>

                  </div>
                  <div class="box-tools pull-right">
                    <form action="<?php echo e(URL::to('admin/customer-orders-print')); ?>" target="_blank">
                      <input type="hidden" name="page" value="invioce">
                      <input type="hidden" name="customers_id" value="<?php echo e(app('request')->input('customers_id')); ?>">
                      <input type="hidden" name="orders_status_id" value="<?php echo e(app('request')->input('orders_status_id')); ?>">
                      <input type="hidden" name="deliveryboys_id" value="<?php echo e(app('request')->input('deliveryboys_id')); ?>">
                      <input type="hidden" name="dateRange" value="<?php echo e(app('request')->input('dateRange')); ?>">
                      <input type="hidden" name="orderid" value="<?php echo e(app('request')->input('orderid')); ?>">
                      <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> <?php echo e(trans('labels.Print')); ?></button>
                    </form>
                  </div>
                </div>
                

          <!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-xs-12"> 

              <div class="box-tools pull-right">
                <h2 style="margin-top: 0;"><small><?php echo e(trans('labels.Total Sale Price')); ?>:</small> <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($result['price']); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?> </h2>
              </div>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th><?php echo e(trans('labels.Date')); ?></th>
                      <th><?php echo e(trans('labels.No of Orders')); ?></th>
                      <th><?php echo e(trans('labels.No of Products')); ?></th>
                      <th><?php echo e(trans('labels.OrderTotal')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['reports']['orders'])>0): ?>
                    <?php $__currentLoopData = $result['reports']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($orderData->date_purchased); ?></td>
                        <td><?php echo e($orderData->total_orders); ?></td>
                        <td><?php echo e($orderData->total_products); ?></td>  
                        <td><?php echo e($orderData->total_price); ?></td>    
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/reports/salesreport.blade.php ENDPATH**/ ?>