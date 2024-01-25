<?php $__env->startSection('content'); ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> PRIVACY POLICY </a>
               </div>
            </div>
         </div>
      </section>
     <section class="section-padding">
<div class="section-title text-center mb-4 mt-4">
<h2>PRIVACY POLICY</h2>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

	<?php echo stripslashes($result['Details']->cms_text); ?>

</div>


</div>

</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/privacy_policy.blade.php ENDPATH**/ ?>