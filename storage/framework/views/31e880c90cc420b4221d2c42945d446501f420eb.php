<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Faq <small>Edit Faq...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/displayFaq')); ?>"> Faq</a></li>
                <li class="active">Edit Faq</li>
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
                            <h3 class="box-title">Edit Faq </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit News</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <?php if( count($errors) > 0): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only"><?php echo e(trans('labels.Error')); ?>:</span>
                                                        <?php echo e($error); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php echo Form::open(array('url' =>'admin/updateFaq', 'method'=>'post', 'class' => 'form-horizontal form-validate' )); ?>


                                            <input type="hidden" name="faq_id" value="<?php echo e($faqDetails->faq_id); ?>">

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Title</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="faq_title" class="form-control field-validate" value="<?php echo e($faqDetails->faq_title); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.TitleNews')); ?></span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label">Description</label>
                                                    <div class="col-sm-10 col-md-8">
                                                        <textarea id="editor1" name="faq_text" class="form-control"  rows="10" cols="80"><?php echo e($faqDetails->faq_text); ?></textarea>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Description')); ?></span>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <select class="form-control" name="faq_status">
                                                            <option value="1" <?php if($faqDetails->faq_status==1): ?> selected <?php endif; ?> ><?php echo e(trans('labels.Active')); ?></option>
                                                            <option value="0" <?php if($faqDetails->faq_status==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
                                                        </select>
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Active status will be displayed on user side.</span>
                                                    </div>
                                                </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                                <a href="<?php echo e(URL::to('admin/displayFaq')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                            </div>

                                            <!-- /.box-footer -->
                                            <?php echo Form::close(); ?>

                                        </div>
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
    <script src="<?php echo asset('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
    <script type="text/javascript">
       $(function() {     
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/admin/faq/edit.blade.php ENDPATH**/ ?>