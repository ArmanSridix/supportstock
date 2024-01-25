<?php $__env->startSection('content'); ?>
<link href="<?php echo asset('admin/css/menu.css'); ?> " media="all" rel="stylesheet" type="text/css" />
<script>
    var _BASE_URL = "<?php echo e(url('/admin')); ?>";
    var current_group_id = 1;
    </script>
    <div class="content-wrapper">
        <!-- Content Header (menu header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.Menus')); ?> <small><?php echo e(trans('labels.ListingAllMenus')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.Menus')); ?> </li>
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
                        <h3 class="box-title"><?php echo e(trans('labels.Menus')); ?> </h3>
                        <div class="box-tools pull-right" style="top: 15px;">
                            <a href="<?php echo e(URL::to('admin/catalogmenu')); ?>" style="display: inline" type="button" class="btn btn-block btn-success"><?php echo e(trans('labels.GenerateCatalog')); ?></a>
                            <a href="<?php echo e(URL::to('admin/addmenus')); ?>" style="display: inline" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewMenu')); ?></a>
                        </div>
                        </br>
                        </br>
                    </div>
                    <div class="box-body">
                    <?php if(count($errors) > 0): ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e($errors->first()); ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                     <form method="post" id="form-menu" action="<?php echo e(url('/admin/menuposition')); ?>">
                        <?php if(!empty($result["menus"])): ?>
                            <?php echo $result["menus"]; ?>

                        <?php endif; ?>

                        <div class="box-header">
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="alert alert-success alert-dismissible" id="sorted" role="alert" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo app('translator')->get('labels.Menussortedsuccessfully'); ?>
                            </div>
                            <div class=" pull-right">
                                <button type="submit" id="btn-save-menu" class="btn btn-block btn-primary"><?php echo e(trans('labels.SaveMenu')); ?></button>
                            </div>
                        </div>
                     </form>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteProductModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/deletemenu', 'name'=>'deleteProduct', 'id'=>'deleteProduct', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'products_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteText')); ?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteProduct"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>

            

            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script src="<?php echo asset('admin/plugins/sort/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/plugins/sort/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/plugins/sort/jquery.ui.touch-punch.min.js'); ?>"></script>
    <script src="<?php echo asset('admin/plugins/sort/jquery.mjs.nestedSortable.js'); ?>"></script>
    <script src="<?php echo asset('admin/plugins/sort/menu.js'); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/menus/index.blade.php ENDPATH**/ ?>