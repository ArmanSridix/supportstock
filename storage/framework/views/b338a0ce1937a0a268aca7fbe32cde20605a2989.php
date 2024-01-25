<?php $__env->startSection('template_title'); ?>
    Requirements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    Server Requirements
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <?php $__currentLoopData = $requirements['requirements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <ul class="list">
            <li class="list__item list__title">
                <strong>PHP Extensions</strong>                
            </li>

            <li class="list__item <?php echo e($phpSupportInfo['supported'] ? 'success' : 'error'); ?>">
                <strong><?php echo e(ucfirst($type)); ?></strong>
                <?php if($type == 'php'): ?>
                    <strong>
                        <small>
                            (version <?php echo e($phpSupportInfo['minimum']); ?> required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            <?php echo e($phpSupportInfo['current']); ?>

                        </strong>
                        <i class="fa fa-fw fa-<?php echo e($phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle'); ?> row-icon" aria-hidden="true"></i>
                    </span>
                <?php endif; ?>
            </li>
            <?php $__currentLoopData = $requirements['requirements'][$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extention => $enabled): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($extention == 'max_execution_time'): ?>
                <li class="list__item list__title">
                    <strong>PHP Settings</strong>                
                </li>
                <?php endif; ?>
                <li class="list__item <?php echo e($enabled ? 'success' : 'error'); ?>">
                    <?php if($extention == 'gd'): ?>
                        GD Library
                    <?php else: ?>    
                        <?php echo e(str_replace('_', ' ', $extention)); ?>

                    <?php endif; ?>
                    
                    <?php if($extention == 'max_execution_time'): ?>
                    <br>
                    <small>Please Make sure your max execution time is greater than <?php echo e($requirements['extensions_limit_array']['max_execution_time']); ?></small>
                    <?php endif; ?>
                    <?php if($extention == 'upload_max_filesize'): ?>
                    <br>
                    <small>Please Make sure your mupload max filesize is greater than <?php echo e($requirements['extensions_limit_array']['upload_max_filesize']); ?>MB</small>
                    <?php endif; ?>
                    <?php if($extention == 'post_max_size'): ?>
                    <br>
                    <small>Please Make sure your post max size is greater than <?php echo e($requirements['extensions_limit_array']['post_max_size']); ?>MB</small>
                    <?php endif; ?>
                    <i class="fa fa-fw fa-<?php echo e($enabled ? 'check-circle-o' : 'exclamation-circle'); ?> row-icon" aria-hidden="true"></i>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if( !$requirements['errors'] && $phpSupportInfo['supported'] ): ?>
        <div class="buttons">
            <a class="button" href="<?php echo e(route('LaravelInstaller::permissions')); ?>">
                Next
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\adminpanel\resources\views/vendor/installer/requirements.blade.php ENDPATH**/ ?>