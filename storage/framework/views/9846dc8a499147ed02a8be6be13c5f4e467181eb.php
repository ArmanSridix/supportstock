<style>
.wrapper.wrapper2{
	display: block;
}
.wrapper{
	display: none;
}
</style>
<body onload="window.print();">
<div class="wrapper wrapper2">
  <!-- Main content -->
  <section class="invoice" style="margin: 15px;">
      <!-- title row -->
      
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header" style="padding-bottom: 25px">
          <div class="box-body no-padding">
              <form  name='registration' method="get" action="<?php echo e(url('admin/customers-orders-report')); ?>">
              <input type="hidden" name="type" value="all">
              <div class="box-body">
              <?php if(app('request')->input('dateRange')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Date')); ?></label>
                    <p><?php echo e(app('request')->input('dateRange')); ?></p>
                  </div>
                </div>
                <?php endif; ?>
                <?php if( app('request')->input('customers_id')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Customers')); ?></label>
                        <?php $__currentLoopData = $result['customers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <p> <?php if(app('request')->input('customers_id') == $customers->id): ?> <?php echo e($customers->first_name); ?> <?php echo e($customers->last_name); ?> <?php endif; ?> </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <?php endif; ?>
                <?php if( app('request')->input('orders_status_id')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.OrdersStatus')); ?></label>
                        <?php $__currentLoopData = $result['orderstatus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p>  <?php if(app('request')->input('orders_status_id') == $status->orders_status_id): ?> <?php echo e($status->orders_status_name); ?> <?php endif; ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <?php endif; ?>
                <?php if( app('request')->input('deliveryboys_id')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Choose Devlieryboy')); ?></label>
                        <?php $__currentLoopData = $result['deliveryboys']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deliveryboy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p> <?php if(app('request')->input('deliveryboys_id') == $deliveryboy->id): ?> <?php echo e($deliveryboy->first_name); ?> <?php echo e($deliveryboy->last_name); ?> <?php endif; ?> </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <?php endif; ?>

                
                <?php if( app('request')->input('orderid')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.OrderID')); ?></label>
                        <p> <?php echo e(app('request')->input('orderid')); ?> </p>
                  </div>
                </div>
                <?php endif; ?>
      
            </div>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th><?php echo e(trans('labels.ID')); ?></th>
                      <th><?php echo e(trans('labels.CustomerName')); ?></th>
                      <th><?php echo e(trans('labels.Order Source')); ?></th>
                      <th><?php echo e(trans('labels.OrderTotal')); ?></th>
                      <th><?php echo e(trans('labels.DatePurchased')); ?></th>
                      <th><?php echo e(trans('labels.Status')); ?> </th>
                      <!-- <th><?php echo e(trans('labels.deliveryBoy')); ?> </th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['reports']['orders'])>0): ?>
                    <?php $__currentLoopData = $result['reports']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($orderData->orders_id); ?></td>
                        <td><?php echo e($orderData->customers_name); ?></td>
                        <td>
                            <?php if($orderData->ordered_source == 1): ?>
                            <?php echo e(trans('labels.Website')); ?>

                            <?php else: ?>
                            <?php echo e(trans('labels.Application')); ?>

                            <?php endif; ?></td>
                        <td>

                            <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($orderData->order_price); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
                        <td><?php echo e(date('d/m/Y', strtotime($orderData->date_purchased))); ?></td>
                        <td>
                            <?php if($orderData->orders_status_id==1): ?>
                                <span class="label label-warning">
                            <?php elseif($orderData->orders_status_id==2): ?>
                                <span class="label label-success">
                            <?php elseif($orderData->orders_status_id==3): ?>
                                <span class="label label-danger">
                            <?php else: ?>
                                <span class="label label-primary">
                            <?php endif; ?>
                            <?php echo e($orderData->orders_status); ?>

                                </span>
                        </td>
                         

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  	<tr>
                    	<td colspan="5"><strong><?php echo e(trans('labels.NoRecordFound')); ?></strong></td>
                    </tr>
                  <?php endif; ?>
                  </tbody>
                </table>
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- /.row -->


    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/reports/statsCustomersinvoice.blade.php ENDPATH**/ ?>