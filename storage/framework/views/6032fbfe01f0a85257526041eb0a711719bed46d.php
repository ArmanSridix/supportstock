<?php $__env->startSection('content'); ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="<?php echo e(URL::to('/')); ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> TERMS & CONDITIONS </a>
               </div>
            </div>
         </div>
      </section>
     <section class="section-padding">
<div class="section-title text-center mb-4 mt-4">
<h2>TERMS & CONDITIONS</h2>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

	<?php echo stripslashes($result['termsDetails']->cms_text); ?>

</div>


</div>

</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/web/term_condition.blade.php ENDPATH**/ ?>