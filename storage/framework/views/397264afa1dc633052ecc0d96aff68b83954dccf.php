<?php $__env->startSection('content'); ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <a href="<?php echo e(URL::to('/')); ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Faq's </a>
         </div>
      </div>
   </div>
</section>

<div id="page_container">
<section class="faq-page section-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 mx-auto">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="card card-body">

                  	<?php if($result['faq_list'] != null): ?>

                     <div class="accordion" id="accordionExample">

                     	<?php $__currentLoopData = $result['faq_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="card mb-0">
                           <div class="card-header" id="headingOne<?php echo $faq_list->faq_id; ?>">
                              <h6 class="mb-0">
                                 <a href="#" data-toggle="collapse" data-target="#collapseOne<?php echo $faq_list->faq_id; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $faq_list->faq_id; ?>">
                                 <i class="icofont icofont-question-square"></i><?php echo e($faq_list->faq_title); ?>

                                 </a>
                              </h6>
                           </div>
                           <div id="collapseOne<?php echo $faq_list->faq_id; ?>" class="collapse <?php echo $key==0?'show':''; ?>" aria-labelledby="headingOne<?php echo $faq_list->faq_id; ?>" data-parent="#accordionExample">
                              <div class="card-body">
                                <?php echo stripslashes($faq_list->faq_text); ?>
                              </div>
                           </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     </div>

                     <?php endif; ?>

                  </div>
               </div>
               <!-- <div class="col-lg-6 col-md-6">
                  <div class="card card-body">
                     <div class="section-header">
                        <h5 class="heading-design-h5">
                           Ask us question
                        </h5>
                     </div>
                     <form>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label class="control-label">Your Name <span class="required">*</span></label>
                                 <input class="form-control border-form-control" value="" placeholder="Enter Name" type="text">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="control-label">Email Address <span class="required">*</span></label>
                                 <input class="form-control border-form-control " value="" placeholder="ex@gmail.com" type="email">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label class="control-label">Phone <span class="required">*</span></label>
                                 <input class="form-control border-form-control" value="" placeholder="Enter Phone" type="number">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label class="control-label">Your Message <span class="required">*</span></label>
                                 <textarea class="form-control border-form-control"></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 text-right">
                              <button type="button" class="btn btn-danger btn-lg"> Cencel </button>
                              <button type="button" class="btn btn-success btn-lg"> Send Message </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</section>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/supportmain/webapps/supportstock/resources/views/web/faq.blade.php ENDPATH**/ ?>