<!DOCTYPE html>
<html lang="en">
  <?php echo $__env->make('web.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <body>
      <?php echo $__env->make('web.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


      <?php echo $__env->yieldContent('content'); ?>
      

      <?php echo $__env->make('web.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
      <?php echo $__env->make('web.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   </body>
</html><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/layout.blade.php ENDPATH**/ ?>