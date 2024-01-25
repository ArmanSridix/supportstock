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
      
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th><?php echo e(trans('labels.ProductID')); ?></th>
                      <th><?php echo e(trans('labels.ProductName')); ?></th>
                      <th>Product Type</th>
                      <th>Attribute</th>
                      <th><?php echo e(trans('labels.Current Stock')); ?></th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php $__currentLoopData = $result['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                   
                      <tr>
                        <td><?php echo e($report->products_id); ?></td>  
                        <td><?php echo e($report->products_name); ?></td> 
                        <td>
                          <?php 
                            if($report->products_type==1){ 
                              echo "Variable";
                            }else{ 
                              echo "Simple";
                            } 
                          ?>
                        </td>
                        <td>
                          <?php if($report->products_type==1 && count($report->productAttributeDetails)>0){
                            $productAttributeDetails = $report->productAttributeDetails; ?>
                            <ul>
                              <?php foreach ($productAttributeDetails as $key => $value) { ?>
                                <li><?php echo e($value->options_name); ?> : <?php echo e($value->options_values); ?></li>
                              <?php } ?>
                            </ul>
                          <?php }else{ echo "N/A"; } ?>
                        </td>   
                        <td>0</td>                                                                      
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/reports/stockinprint.blade.php ENDPATH**/ ?>