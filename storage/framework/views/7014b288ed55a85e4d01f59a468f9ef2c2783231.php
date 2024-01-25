<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  Enquiries <small>Enquiries...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"> Enquiries</li>
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
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Pincode</th>
                                            <th>Quantity</th>
                                            <th>Expected Price</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($productEnquiryList)>0): ?>
                                            <?php $__currentLoopData = $productEnquiryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$productEnquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($productEnquiry->enquiry_products_id); ?></td>
                                                    <td><?php echo e($productEnquiry->products_name); ?></td>
                                                    <td><?php echo e($productEnquiry->enName); ?></td>
                                                    <td><?php echo e($productEnquiry->enEmail); ?></td>
                                                    <td><?php echo e($productEnquiry->enPhone); ?></td>
                                                    <td><?php echo e($productEnquiry->cities_name); ?></td>
                                                    <td><?php echo e($productEnquiry->pincodes_val); ?></td>
                                                    <td><?php echo e($productEnquiry->enQuantity); ?></td>
                                                    <td><?php echo e($productEnquiry->enPrice); ?></td>
                                                    <td><?php echo e(date("d-m-Y",strtotime($productEnquiry->created_at))); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="10">No record found..</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                        <?php if($productEnquiryList != null): ?>
                                        <div class="col-xs-12 text-right">
                                            <?php echo e($productEnquiryList->links()); ?>

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

            
           
            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/products/product_enquiry.blade.php ENDPATH**/ ?>