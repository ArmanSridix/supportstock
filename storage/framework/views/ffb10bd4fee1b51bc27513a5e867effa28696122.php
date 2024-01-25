
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Faq <small>Listing All Faqs...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
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
                            

                            <div class="col-lg-6 form-inline">

                                
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/addFaq')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNew')); ?></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <br>

                            <div class="row">
                                <div class="col-xs-12">

                                    <?php if($errors != null): ?>
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
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($faqList != null): ?>

                                            
                                            <?php $__currentLoopData = $faqList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td><?php echo e($faq->faq_id); ?></td>
                                                    <td><?php echo e($faq->faq_title); ?></td>
                                                    <td><?php echo substr($faq->faq_text,0,40)."..."; ?></td>
                                                    <td>
                                                        <?php if($faq->faq_status==1): ?>
                                                        <strong class="badge bg-green"><?php echo e(trans('labels.Active')); ?> </strong>
                                                        <?php else: ?>
                                                        <strong class="badge bg-light-grey"><?php echo e(trans('labels.InActive')); ?> </strong>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Edit')); ?>" href="<?php echo e(URL::to('admin/editFaq/'.$faq->faq_id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="<?php echo e(trans('labels.Delete')); ?>" id="deletefaqId" faq_id="<?php echo e($faq->faq_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"><?php echo e(trans('labels.NoRecordFound')); ?>.</td>
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

            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteFaqModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteNewsModalLabel"><?php echo e(trans('labels.DeleteNews')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/faqDelete', 'name'=>'deleteFaq', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('faq_id',  '', array('class'=>'form-control', 'id'=>'id')); ?>

                        <div class="modal-body">
                            <p>Delete Faq</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deletefaq"><?php echo e(trans('labels.Delete')); ?></button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/faq/index.blade.php ENDPATH**/ ?>