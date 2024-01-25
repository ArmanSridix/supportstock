<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo e(trans('labels.ImageDetail')); ?> <small><?php echo e(trans('labels.ImageDetail')); ?>...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i>
                    <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
            <li><a href="<?php echo e(URL::to('admin/media/add')); ?>">
                    <?php echo e(trans('labels.AddNewImage')); ?></a></li>
            <li class="active"><?php echo e(trans('labels.ImageDetail')); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <?php if(session()->has('success')): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                                <?php echo e(session()->get('success')); ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(count($errors) > 0): ?>
                                <?php if($errors->any()): ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <?php echo e($errors->first()); ?>

                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>    
                        
                            <?php if(isset($result['images'])): ?>
                                <?php $__currentLoopData = $result['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="caption">
                                            <h2><?php echo e($image->image_type); ?>  (<?php echo e($image->height); ?> X <?php echo e($image->width); ?>)</h2>
                                        </div>
                                      <div class="thumbnail">
                                      <img src="<?php echo e(asset($image->path)); ?>" alt="<?php echo e($image->height); ?> X <?php echo e($image->width); ?>">
                                      <div class="col-md-6 col-md-offset-3">
                                            <div class="caption">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><?php echo app('translator')->get('labels.Path'); ?></span>
                                                    <input type="text" class="form-control" name="path" value="<?php echo e(asset($image->path)); ?>">                                                
                                                </div>
                                            </div>
                                            <?php if($image->image_type !='ACTUAL'): ?>
                                            <?php echo Form::open(array('url' =>'admin/media/regenerateimage', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('image_id',  $image->image_id, array('class'=>'form-control', 'id'=>'id')); ?>

                                            <?php echo Form::hidden('id',  $image->id, array('class'=>'form-control', 'id'=>'id')); ?>

                                            <div class="caption">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><?php echo app('translator')->get('labels.Size'); ?></span>
                                                    <input required type="text" class="form-control" name="height" value="<?php echo e($image->height); ?>">
                                                    <span class="input-group-addon">X</span>
                                                    <input required type="text" class="form-control" name="width" value="<?php echo e($image->width); ?>">
                                                    <span class="input-group-addon" style="padding: 0">
                                                        <button type="submit" class="btn btn-primary"> <?php echo app('translator')->get('labels.Regenerate'); ?></button>
                                                    </span>                                                
                                                </div>
                                            </div>
                                            <?php echo Form::close(); ?>

                                            <?php endif; ?>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <p id="demo"></p>

            <!-- /.col -->
        </div>
        <!-- /.row -->
<script>

</script>
        <!-- Main row -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add File Here</h4>
                    </div>
                    <div class="modal-body">
                        <p>Click or Drop Images in the Box for Upload.</p>
                        <form action="<?php echo e(url('admin/media/uploadimage')); ?>" enctype="multipart/form-data"
                            class="dropzone " id="my-dropzone">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" disabled="disabled" id="compelete"
                            data-dismiss="modal">Done</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModaldetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h3 class="modal-title text-primary" id="myModalLabel">Image Details</h3>
                    </div>

                    <?php echo Form::open(array('url' =>'admin/deleteimage', 'method'=>'post', 'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data', 'onsubmit' => 'return ConfirmDelete()')); ?>

                    <div class="image_embed">

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="myDeleteImage"
                            data-toggle="modal">Delete</button>
                        
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>


                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>

        <div id="myModal2" class="modal modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#myModal">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmation!!</h4>
                    </div>
                    <div class="modal-body">
                        <p>You are sure to delete It!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="myDeleteImage"
                            data-toggle="modal">Delete</button>
                        <button class="btn btn-default" data-dismiss="modal" data-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/media/detail.blade.php ENDPATH**/ ?>