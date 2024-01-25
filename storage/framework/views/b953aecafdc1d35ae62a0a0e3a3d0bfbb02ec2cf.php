<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.editconstantbanner')); ?> <small><?php echo e(trans('labels.editconstantbanner')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li><a href="<?php echo e(URL::to('admin/constantbanners')); ?>"><i class="fa fa-bars"></i> <?php echo e(trans('labels.ListingConstantBanners')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.editconstantbanner')); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->

    <!-- /.row -->
    <style>
      .selectedthumbnail {
          display: block;
          margin-bottom: 10px;
          padding: 0;
      }
      .thumbnail {
          padding: 0;
      }
      .closimage{
        position: relative
      }
      </style>

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo e(trans('labels.editconstantbanner')); ?> </h3>
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
                        <!-- /.box-header -->
                        <!-- form start -->
                         <div class="box-body">

                            <?php echo Form::open(array('url' =>'admin/updateconstantBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>


                                <?php echo Form::hidden('id',  $result['banners'][0]->banners_id , array('class'=>'form-control', 'id'=>'id')); ?>

                                <?php echo Form::hidden('oldImage',  $result['banners'][0]->banners_image, array('id'=>'oldImage')); ?>


                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Language')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="languages_id">
                                          <?php $__currentLoopData = $result['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($language->languages_id); ?>" <?php if($language->languages_id==$result['banners'][0]->languages_id): ?> selected <?php endif; ?>><?php echo e($language->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.ChooseLanguageText')); ?></span>
                                  </div>
                                </div>

                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Side Banner')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="type">
                                          <option value="1" <?php if($result['banners'][0]->type==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Right And Left Carousel Side Banner 1')); ?></option>
                                          <option value="2" <?php if($result['banners'][0]->type==2): ?> selected <?php endif; ?>><?php echo e(trans('labels.Right And Left Carousel Side Banner 2')); ?></option>
                                          <option value="3" <?php if($result['banners'][0]->type==3): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 1')); ?></option>
                                          <option value="4" <?php if($result['banners'][0]->type==4): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 1')); ?></option>
                                          <option value="5" <?php if($result['banners'][0]->type==5): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 1')); ?></option>
                                          <option value="6" <?php if($result['banners'][0]->type==6): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="7" <?php if($result['banners'][0]->type==7): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="8" <?php if($result['banners'][0]->type==8): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="9" <?php if($result['banners'][0]->type==9): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 2 & 3 & 4')); ?></option>
                                          <option value="10" <?php if($result['banners'][0]->type==10): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="11" <?php if($result['banners'][0]->type==11): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="12" <?php if($result['banners'][0]->type==12): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="13" <?php if($result['banners'][0]->type==13): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="14" <?php if($result['banners'][0]->type==14): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fifth Banner For Banner Style 5 & 6')); ?></option>
                                          <option value="15" <?php if($result['banners'][0]->type==15): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="16" <?php if($result['banners'][0]->type==16): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="17" <?php if($result['banners'][0]->type==17): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="18" <?php if($result['banners'][0]->type==18): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 7 & 8')); ?></option>
                                          <option value="19" <?php if($result['banners'][0]->type==19): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 9')); ?></option>
                                          <option value="20" <?php if($result['banners'][0]->type==20): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 9')); ?></option>
                                          <option value="21" <?php if($result['banners'][0]->type==21): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="22" <?php if($result['banners'][0]->type==22): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="23" <?php if($result['banners'][0]->type==23): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="24" <?php if($result['banners'][0]->type==24): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 10 & 11 & 12')); ?></option>
                                          <option value="25" <?php if($result['banners'][0]->type==25): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="26" <?php if($result['banners'][0]->type==26): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="27" <?php if($result['banners'][0]->type==27): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="28" <?php if($result['banners'][0]->type==28): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="29" <?php if($result['banners'][0]->type==29): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fifth Banner For Banner Style 13 & 14 & 15')); ?></option>
                                          <option value="30" <?php if($result['banners'][0]->type==30): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="31" <?php if($result['banners'][0]->type==31): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="32" <?php if($result['banners'][0]->type==32): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 16 & 17')); ?></option>
                                          <option value="33" <?php if($result['banners'][0]->type==33): ?> selected <?php endif; ?>><?php echo e(trans('labels.First Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="34" <?php if($result['banners'][0]->type==34): ?> selected <?php endif; ?>><?php echo e(trans('labels.Second Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="35" <?php if($result['banners'][0]->type==35): ?> selected <?php endif; ?>><?php echo e(trans('labels.Third Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="36" <?php if($result['banners'][0]->type==36): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fourth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="37" <?php if($result['banners'][0]->type==37): ?> selected <?php endif; ?>><?php echo e(trans('labels.Fifth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="38" <?php if($result['banners'][0]->type==38): ?> selected <?php endif; ?>><?php echo e(trans('labels.Sixth Banner For Banner Style 18 & 19')); ?></option>
                                          <option value="39" <?php if($result['banners'][0]->type==39): ?> selected <?php endif; ?>><?php echo e(trans('labels.Home Page First Banner')); ?></option>
                                          <option value="40" <?php if($result['banners'][0]->type==40): ?> selected <?php endif; ?>><?php echo e(trans('labels.Home Page Second Banner')); ?></option>

                                          <option value="83" <?php if($result['banners'][0]->type==83): ?> selected <?php endif; ?>>Banner Style 3</option>

                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.AddBannerText')); ?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Constant Image')); ?></label>
                                    <div class="col-sm-10 col-md-4">
                                        
                                        <!-- Modal -->
                                            <div class="modal fade embed-images" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h3 class="modal-title text-primary" id="myModalLabel"><?php echo e(trans('labels.Choose Constant Image')); ?> </h3>
                                                        </div>
                                                        <div class="modal-body manufacturer-image-embed">
                                                            <?php if(isset($allimage)): ?>
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
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
                                                <?php echo Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )); ?>

                                                <div id="selectedthumbnailIcon" style="display:none" class="selectedthumbnail col-md-12"> </div>
                                                <div class="closimage">
                                                    <button type="button" class="close pull-left image-close " id="image-Icone"
                                                    style="display:none; position: absolute;left: -3px !important;top: 15px !important;background-color: black;color: white;opacity: 2.2;" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <br>
                                                <?php echo Form::hidden('oldImage', $result['languages'][0]->image, array('id'=>'oldImage')); ?>

                                                <?php if(($result['languages'][0]->path!== null)): ?>
                                                    <img style="max-width: 100%" src="<?php echo e(asset('').$result['banners'][0]->path); ?>" class="">
                                                <?php else: ?>
                                                    <img style="max-width: 100%" src="<?php echo e(asset('').$result['banners'][0]->path); ?>" class="">
                                                <?php endif; ?>

                                            </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.SliderNavigation')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="navigate_type" id="bannerType">
                                          <option value="category" <?php if($result['banners'][0]->navigate_type=='category'): ?> selected <?php endif; ?>>
                                          <?php echo e(trans('labels.Category')); ?></option>
                                          <option value="product" <?php if($result['banners'][0]->navigate_type=='product'): ?> selected <?php endif; ?>><?php echo e(trans('labels.Product')); ?></option>
                                          
                                      </select>
                                       <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.SliderNavigationText')); ?></span>
                                  </div>
                                </div>


                                <div class="form-group categoryContent" <?php if($result['banners'][0]->navigate_type!='category'): ?> style="display: none" <?php endif; ?> >
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Categories')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="categories_id" id="categories_id">
                                      <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if($result['banners'][0]->navigate_type=='category'){if($result['banners'][0]->banners_url==$category->id){echo "selected";}} ?> ><?php echo e($category->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.CategoriessliderText')); ?></span>
                                  </div>
                                </div>

                                <div class="form-group productContent" <?php if($result['banners'][0]->navigate_type!='product'): ?> style="display: none" <?php endif; ?>>
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Products')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="products_id" id="products_id">
                                      <?php $__currentLoopData = $result['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($products_data->products_id); ?>" <?php if($result['banners'][0]->navigate_type=='product'){if($result['banners'][0]->banners_url==$products_data->products_id){echo "selected";}} ?> ><?php echo e($products_data->products_name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </select>
                                     <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      <?php echo e(trans('labels.ProductsSliderText')); ?></span>
                                  </div>
                                </div>

                                

                                <div class="form-group hidden">
                                  <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1" <?php if($result['banners'][0]->status==1): ?> selected <?php endif; ?>><?php echo e(trans('labels.Active')); ?></option>
                                          <option value="0" <?php if($result['banners'][0]->status==0): ?> selected <?php endif; ?>><?php echo e(trans('labels.Inactive')); ?></option>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/settings/web/banners/edit.blade.php ENDPATH**/ ?>