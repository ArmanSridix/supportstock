<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.Inventory Report')); ?> <small><?php echo e(trans('labels.Inventory Report')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Inventory Report')); ?></li>
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
              <form  name='registration' method="get" action="<?php echo e(url('admin/inventoryreport')); ?>">
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
                    <label for="exampleInputEmail1"><?php echo e(trans('labels.Choose Product')); ?></label>
                    <select type="button" required class="btn btn-default select2 form-control" data-toggle="dropdown" name="products_id" id="products_id"  >
                        <option value=""><?php echo e(trans('labels.Choose Product')); ?></option>
                        <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->products_id); ?>"  <?php if( app('request')->input('products_id')): ?> <?php if(app('request')->input('products_id') == $product->products_id): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e($product->products_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
               
                <div class="col-xs-2" style="padding-top: 25px">                  
                  <div class="form-group">
                    <button class="btn btn-primary" id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    <?php if(app('request')->input('type') and app('request')->input('type') == 'all'): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/inventoryreport')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
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
            <h3 class="box-title"><?php echo e(trans('labels.Inventory Report')); ?> </h3>

            <div class="box-tools pull-right">
              <form action="<?php echo e(URL::to('admin/inventoryreportprint')); ?>" target="_blank">
                <input type="hidden" name="page" value="invioce">
                <input type="hidden" name="products_id" value="<?php echo e(app('request')->input('products_id')); ?>">
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
                <div class="col-xs-12" style="background: #eee;">


                  <?php
                    if($result['reports']->total()>0){
                      $fromrecord = ($result['reports']->currentpage()-1)*$result['reports']->perpage()+1;
                    }else{
                      $fromrecord = 0;
                    }
                    if($result['reports']->total() < $result['reports']->currentpage()*$result['reports']->perpage()){
                      $torecord = $result['reports']->total();
                    }else{
                      $torecord = $result['reports']->currentpage()*$result['reports']->perpage();
                    }

                  ?>
                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                    <div>Showing <?php echo e($fromrecord); ?> to <?php echo e($torecord); ?>

                        of  <?php echo e($result['reports']->total()); ?> entries
                    </div>
                  </div>
                <div class="col-xs-12 col-md-6 text-right">
                    <?php echo e($result['reports']->appends(\Request::except('type'))->render()); ?>

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

    <!-- Main row -->

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\adminpanel\resources\views/admin/reports/inventoryreport.blade.php ENDPATH**/ ?>