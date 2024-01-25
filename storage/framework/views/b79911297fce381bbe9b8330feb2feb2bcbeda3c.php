
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  Comments <small>Comments...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> Comments</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if($errors): ?>
                                        <?php if($errors->any()): ?>
                                            <div <?php if($errors->first()=='Default can not Deleted!!'): ?> class="alert alert-danger alert-dismissible" <?php else: ?> class="alert alert-success alert-dismissible" <?php endif; ?> role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <?php echo e(trans('labels.DefaultLanguageChangedMessage')); ?>

                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Comment</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($comment_list)>0): ?>
                                            <?php $__currentLoopData = $comment_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$comment_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($comment_data->contact_us_comments_id); ?>

                                                    </td>
                                                    <td><?php echo e($comment_data->contact_name); ?></td>
                                                    <td><?php echo e($comment_data->contact_mail); ?></td>
                                                    <td><?php echo e($comment_data->contact_phone); ?></td>
                                                    <td><?php echo e($comment_data->contact_comment); ?></td>
                                                    <td>
                                                      <a data-toggle="tooltip" data-placement="bottom" title="Delete" id="deleteLanguageId" languages_id ="<?php echo e($comment_data->contact_us_comments_id); ?>" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6">No record found..</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                        <?php if($comment_list != null): ?>
                                        <div class="col-xs-12 text-right">
                                            <?php echo e($comment_list->links()); ?>

                                        </div>
                                        <?php endif; ?>
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
            <!-- deletelanguagesModal -->

            <div class="modal fade" id="deleteLanguagesModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Delete</h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/contactCommentDelete', 'name'=>'deletelanguages', 'id'=>'deletelanguages', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'languages_id')); ?>

                        <div class="modal-body">
                            <p>Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deletelanguages"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
           
            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/admin/contact_us/contact_us_comment.blade.php ENDPATH**/ ?>