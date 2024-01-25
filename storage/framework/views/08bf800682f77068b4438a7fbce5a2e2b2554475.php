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
                <?php if( app('request')->input('products_id')): ?>
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Products')); ?></label>
                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p> <?php if( app('request')->input('products_id' ) == $product->products_id): ?> <?php echo e($product->products_name); ?> <?php endif; ?> </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
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
                  <th><?php echo e(trans('labels.Date')); ?></th>
                  <th><?php echo e(trans('labels.In Stock')); ?></th>
                  <th><?php echo e(trans('labels.Out Stock')); ?></th>
                  <th><?php echo e(trans('labels.Min Stock')); ?></th>
                  <th><?php echo e(trans('labels.Max Stock')); ?></th>
                  <th><?php echo e(trans('labels.Current Stock')); ?></th>
                  <th><?php echo e(trans('labels.Reference')); ?></th>
                </tr>
              </thead>
                <tbody>
                <?php $__currentLoopData = $result['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <tr>
                        <td><?php echo e(date('m/d/Y', strtotime($report->created_at))); ?></td>
                        <?php if($report->stock_type == 'in'): ?>
                        <td><?php echo e($report->stock); ?></td>
                        <?php else: ?>
                        <td>---</td>                            
                        <?php endif; ?>

                        <?php if($report->stock_type == 'out'): ?>
                        <td><?php echo e($report->stock); ?></td>
                        <?php else: ?>
                        <td>---</td>                            
                        <?php endif; ?>


                        <?php if($report->min_level): ?>
                        <td><?php echo e($report->min_level); ?></td>
                        <?php else: ?>
                        <td>---</td>                            
                        <?php endif; ?>                           


                        <?php if($report->max_level): ?>
                        <td><?php echo e($report->max_level); ?></td>
                        <?php else: ?>
                        <td>---</td>                            
                        <?php endif; ?>
                        <td><?php echo e($report->current_stock); ?></td>    
                          <?php if($report->reference_code): ?>
                          <td><?php echo e($report->reference_code); ?></td>
                          <?php else: ?>
                          <td>---</td>                            
                          <?php endif; ?>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/reports/inventoryreportprint.blade.php ENDPATH**/ ?>