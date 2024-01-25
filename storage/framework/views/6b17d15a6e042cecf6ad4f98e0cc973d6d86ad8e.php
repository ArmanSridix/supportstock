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
                <?php if( app('request')->input('couponcode')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Coupon Code')); ?></label>
                    <p><?php echo e(app('request')->input('couponcode')); ?></p>
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
                      <th><?php echo e(trans('labels.Coupon Code')); ?></th>
                      <th><?php echo e(trans('labels.Discount')); ?></th>
                      <th><?php echo e(trans('labels.OrderID')); ?></th>
                      <th><?php echo e(trans('labels.CustomerName')); ?></th>
                      <th><?php echo e(trans('labels.OrderTotal')); ?></th>
                      <th><?php echo e(trans('labels.Order Date')); ?></th>
                      <!-- <th><?php echo e(trans('labels.Action')); ?></th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['reports']['orders'])>0): ?>
                    <?php $__currentLoopData = $result['reports']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                         <!-- <td style="width: 20%;"><?php echo e($orderData->coupon_code); ?></td> -->
                         <td style="width: 20%;"><?php echo e($orderData->coupon_text); ?></td>
                        <td><?php echo e($orderData->coupon_amount); ?></td>
                        <td><?php echo e($orderData->orders_id); ?></td>
                        <td><?php echo e($orderData->customers_name); ?></td>
                        <td>                            
                            <?php if(!empty($result['commonContent']['currency']->symbol_left)): ?> <?php echo e($result['commonContent']['currency']->symbol_left); ?> <?php endif; ?> <?php echo e($orderData->order_price); ?> <?php if(!empty($result['commonContent']['currency']->symbol_right)): ?> <?php echo e($result['commonContent']['currency']->symbol_right); ?> <?php endif; ?></td>
                        <td><?php echo e(date('d/m/Y', strtotime($orderData->date_purchased))); ?></td>
                        
                        <!-- <td>
                            <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="<?php echo e(trans('labels.View Invoice')); ?>" href="<?php echo e(url('admin/orders/invoiceprint/'.$orderData->orders_id)); ?>" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td> -->

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/reports/couponreportinvoice.blade.php ENDPATH**/ ?>