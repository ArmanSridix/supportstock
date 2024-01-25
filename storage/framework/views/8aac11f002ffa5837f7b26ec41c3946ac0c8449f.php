<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.mailchimp')); ?> <small><?php echo e(trans('labels.mailchimp_setting')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.mailchimp_setting')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.mailchimp_setting')); ?> </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!--<div class="box-header with-border">
                                          <h3 class="box-title">Setting</h3>
                                        </div>-->
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">
                                            <?php if( count($errors) > 0): ?>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <span class="icon fa fa-check" aria-hidden="true"></span>
                                                        <span class="sr-only"><?php echo e(trans('labels.Setting')); ?>Error:</span>
                                                        <?php echo e($error); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                            <?php echo Form::open(array('url' =>'admin/updateSetting', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                                            <br>                                      
                                                                               


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.MailChimp')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="<?php echo e($result['settings'][119]->name); ?>" class="form-control">
                                                        <option <?php if($result['settings'][119]->value == '1'): ?>
                                                                selected
                                                                <?php endif; ?>
                                                                value="1"> <?php echo e(trans('labels.enable')); ?></option>
                                                        <option <?php if($result['settings'][119]->value == '0'): ?>
                                                                selected
                                                                <?php endif; ?>
                                                                value="0"> <?php echo e(trans('labels.Disable')); ?></option>
                                                    </select>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.Newsletter Text')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.MailChimp API')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text($result['settings'][123]->name,  $result['settings'][123]->value, array('class'=>'form-control', 'id'=>$result['settings'][123]->name)); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.MailChimp API')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.MailChimp LIST ID')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text($result['settings'][124]->name,  $result['settings'][124]->value, array('class'=>'form-control', 'id'=>$result['settings'][124]->name)); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;"><?php echo e(trans('labels.MailChimp LIST ID')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group" id="imageIcone">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Newsletter Image')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <!-- Modal -->
                                                    <div class="modal fade embed-images" id="ModalmanufacturedICone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                    <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                                </div>
                                                                <div class="modal-body manufacturer-image-embed">
                                                                    <?php if(isset($allimage)): ?>
                                                                    <select class="image-picker show-html " name="<?php echo e($result['settings'][125]->name); ?>" id="select_img">
                                                                        <option value=""></option>
                                                                        <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                          <option data-img-src="<?php echo e(asset($image->path)); ?>" class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Image')); ?></a>
                                                                    <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                    <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="imageselected">
                                                      <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newIcon','class'=>"btn btn-primary field-validate", 'data-toggle'=>"modal", 'data-target'=>"#ModalmanufacturedICone" )); ?>

                                                      <br>
                                                      <div id="selectedthumbnailIcon" class="selectedthumbnail col-md-5" style="display: none"> </div>
                                                      <div class="closimage">
                                                          <button type="button" class="close pull-left image-close " id="image-Icone"
                                                            style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                    </div>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px; text-align: left"><?php echo e(trans('labels.Newsletter Image')); ?></span>

                                                    <br>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">  </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.OldImage')); ?></span>
                                                    <br>
                                                    <?php echo Form::hidden('oldImage',  $result['settings'][125]->value , array('id'=>$result['settings'][125]->name)); ?>

                                                    <img src="<?php echo e(asset($result['settings'][125]->value)); ?>" alt="" width="80px">
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <!-- /.box-body -->
                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
                                            <a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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

            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/settings/general/newsletter.blade.php ENDPATH**/ ?>