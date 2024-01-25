<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.AddConstantBanner')); ?> <small><?php echo e(trans('labels.AddConstantBanner')); ?>...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/constantbanners')); ?>"><i class="fa fa-bars"></i> <?php echo e(trans('labels.ListingConstantBanners')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.AddConstantBanner')); ?></li>
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
            <h3 class="box-title"><?php echo e(trans('labels.AddConstantBanner')); ?></h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		<div class="box box-info">
                        <br>

                          <?php if(session()->has('error')): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e(session()->get('error')); ?>

                            </div>
                          <?php endif; ?>

                          <?php if(session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e(session()->get('success')); ?>

                            </div>
                          <?php endif; ?>

                        <!-- form start -->
                         <div class="box-body">

                            <?php echo Form::open(array('url' =>'admin/addNewConstantBanner', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                            	<div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Language')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="languages_id">
                                          <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($language->languages_id); ?>"><?php echo e($language->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.ChooseLanguageText')); ?></span>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Side Banner')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="type">
                                          <option value="1"><?php echo e(trans('labels.Right And Left Carousel Side Banner 1')); ?></option>
                                          <option value="2"><?php echo e(trans('labels.Right And Left Carousel Side Banner 2')); ?></option>
                                          <option value="3"><?php echo e(trans('labels.First Banner For Banner Style 1')); ?></option>
                                          <option value="4"><?php echo e(trans('labels.Second Banner For Banner Style 1')); ?></option>
                                          <option value="5"><?php echo e(trans('labels.Third Banner For Banner Style 1')); ?></option>
                                          <option value="6"><?php echo e(trans('labels.First Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="7"><?php echo e(trans('labels.Second Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="8"><?php echo e(trans('labels.Third Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="9"><?php echo e(trans('labels.Fourth Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="10"><?php echo e(trans('labels.First Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="11"><?php echo e(trans('labels.Second Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="12"><?php echo e(trans('labels.Third Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="13"><?php echo e(trans('labels.Fourth Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="14"><?php echo e(trans('labels.Fifth Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="15"><?php echo e(trans('labels.First Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="16"><?php echo e(trans('labels.Second Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="17"><?php echo e(trans('labels.Third Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="18"><?php echo e(trans('labels.Fourth Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="19"><?php echo e(trans('labels.First Banner For Banner Style 9')); ?></option>
                                          <option value="20"><?php echo e(trans('labels.Second Banner For Banner Style 9')); ?></option>
                                          <option value="21"><?php echo e(trans('labels.First Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="22"><?php echo e(trans('labels.Second Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="23"><?php echo e(trans('labels.Third Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="24"><?php echo e(trans('labels.Fourth Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="25"><?php echo e(trans('labels.First Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="26"><?php echo e(trans('labels.Second Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="27"><?php echo e(trans('labels.Third Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="28"><?php echo e(trans('labels.Fourth Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="29"><?php echo e(trans('labels.Fifth Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="30"><?php echo e(trans('labels.First Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="31"><?php echo e(trans('labels.Second Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="32"><?php echo e(trans('labels.Third Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="33"><?php echo e(trans('labels.First Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="34"><?php echo e(trans('labels.Second Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="35"><?php echo e(trans('labels.Third Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="36"><?php echo e(trans('labels.Fourth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="37"><?php echo e(trans('labels.Fifth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="38"><?php echo e(trans('labels.Sixth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="39"><?php echo e(trans('labels.Home Page First Banner')); ?></option>
                                          <option value="40"><?php echo e(trans('labels.Home Page Second Banner')); ?></option>



                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.AddBannerText')); ?></span>
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Image')); ?></label>
                                    <div class="col-sm-10 col-md-4">
                                        
                                        <!-- Modal -->
                                            <div class="modal fade embed-images" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Image')); ?> </h3>
                                                        </div>
                                                        <div class="modal-body manufacturer-image-embed">
                                                            <?php if(isset($allimage)): ?>
                                                                <select class="image-picker show-html field-validate" name="image_id" id="select_img">
                                                                    <option  value=""></option>
                                                                    <?php $__currentLoopData = $allimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option data-img-src="<?php echo e(asset($image->path)); ?>"  class="imagedetail" data-img-alt="<?php echo e($key); ?>" value="<?php echo e($image->id); ?>"> <?php echo e($image->id); ?> </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                          <a href="<?php echo e(url('admin/media/add')); ?>" target="_blank" class="btn btn-primary pull-left" ><?php echo e(trans('labels.Add Icon')); ?></a>
                                                          <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                          <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal"><?php echo e(trans('labels.Done')); ?></button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div  id ="imageselected">
                                                <?php echo Form::button(trans('labels.Add Icon'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 3px;"><?php echo e(trans('labels.LanguageFlag')); ?></span>
                                                <div class="closimage">
                                                    <button type="button" class="close pull-right" id="image-close" style="display: none; position: absolute;left: 91px; top: 54px; background-color: black; color: white; opacity: 2.2;" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div  id="selectedthumbnail"></div>
                                                <br>


                                            </div>
                                    </div>
                                </div>



                                <div class="form-group banner-link">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.URL')); ?> </label>
                                  <div class="col-sm-10 col-md-4">
                                    <?php echo Form::text('banners_url', '', array('class'=>'form-control field-validate','id'=>'banners_url')); ?>

                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1"><?php echo e(trans('labels.Active')); ?></option>
                                          <option value="0"><?php echo e(trans('labels.InActive')); ?></option>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.StatusBannerText')); ?></span>
                                  </div>
                                </div>

                              <!-- /.box-body -->
                              <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?></button>
                                <a href="<?php echo e(URL::to('admin/constantbanners')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/settings/web/banners/add.blade.php ENDPATH**/ ?>