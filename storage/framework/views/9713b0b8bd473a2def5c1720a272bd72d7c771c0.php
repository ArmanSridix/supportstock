<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?php echo e(trans('labels.constantBanners')); ?> <small><?php echo e(trans('labels.ListingConstantBanners')); ?>...</small> </h1>
    <ol class="breadcrumb">
       <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
      <li class="active"><?php echo e(trans('labels.Banners')); ?></li>
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
             <div class="box-tools pull-right">
            	 <a href="<?php echo e(URL::to('admin/addconstantbanner')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewBanner')); ?></a>
            </div> 

            <div class="form-inline">

              <form  name='registration' id="registration" class="" method="get">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                  <div class="input-group-form search-panel ">
                      <select id="parameter" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="bannerType">
                          <option value="" selected disabled hidden><?php echo e(trans('labels.ChooseSliderType')); ?></option>
                          

                          <option value="banner3" <?php if(request()->get('bannerType') == 'banner3'): ?> selected <?php endif; ?>>Banner Style 1</option>

                          

                          <option value="banner9" <?php if(request()->get('bannerType') == 'banner9'): ?> selected <?php endif; ?>>Banner Style 2</option>
                          <option value="singlebanner" <?php if(request()->get('bannerType') == 'singlebanner'): ?> selected <?php endif; ?>>Banner Style 3</option>

                          
                      </select>
                      <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="languages_id" style="display: none;">
                        <option value="1">English</option>
                        
                      </select>
                      <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                      <?php if(request()->get('bannerType')): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/constantbanners')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                  </div>
              </form>
              <div class="col-lg-4 form-inline" id="contact-form12"></div>

              <?php if(request()->get('bannerType') == 'banner1'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner1.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner2'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner2.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner3'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner3.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner4'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner4.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner5'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner5.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner6'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner6.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner7'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner7.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner8'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner8.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner9'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner9.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner10'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner10.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner11'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner11.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner11'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner11.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner12'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner12.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner13'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner13.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner14'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner14.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner15'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner15.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner16'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner16.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner17'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner17.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner19'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner18.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'banner19'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\banner19.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'rightsliderbanner'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\carousal3.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'leftsliderbanner'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\carousal5.jpg')); ?>" alt=""  width=100%>
              <?php elseif(request()->get('bannerType')  == 'singlebanner'): ?>
                <br>
                <img src="<?php echo e(asset('images\prototypes\singleBanner.jpg')); ?>" alt=""  width=100%>
              <?php endif; ?>
          </div>
          
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
              		  <?php if(count($errors) > 0): ?>
                          <?php if($errors->any()): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php echo e($errors->first()); ?>

                            </div>
                          <?php endif; ?>
                      <?php endif; ?>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      
                      
                      <th><?php echo e(trans('labels.Image')); ?></th>
                      <th><?php echo e(trans('labels.AddedModifiedDate')); ?></th>
                      <th><?php echo e(trans('labels.Action')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(count($result['banners'])>0): ?>
                    <?php $__currentLoopData = $result['banners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            
                            <td><img src="<?php echo e(asset('').$banners->path); ?>" alt="" style="max-width: 300px"></td>
                            <td><strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e(date('d M, Y', strtotime($banners->date_added))); ?><br>
                            </td>

                            <td><a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="editconstantbanner/<?php echo e($banners->banners_id); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <!-- <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deleteBannerId" banners_id ="<?php echo e($banners->banners_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                       <tr>
                            <td colspan="4"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                       </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
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

    <!-- deleteBannerModal -->
	<div class="modal fade" id="deleteBannerModal" tabindex="-1" role="dialog" aria-labelledby="deleteBannerModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="deleteBannerModalLabel"><?php echo e(trans('labels.DeleteBanner')); ?></h4>
		  </div>
		  <?php echo Form::open(array('url' =>'admin/deleteconstantBanner', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

				  <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

				  <?php echo Form::hidden('banners_id',  '', array('class'=>'form-control', 'id'=>'banners_id')); ?>

		  <div class="modal-body">
			  <p><?php echo e(trans('labels.DeleteBannerText')); ?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
			<button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
		  </div>
		  <?php echo Form::close(); ?>

		</div>
	  </div>
	</div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/settings/web/banners/index.blade.php ENDPATH**/ ?>