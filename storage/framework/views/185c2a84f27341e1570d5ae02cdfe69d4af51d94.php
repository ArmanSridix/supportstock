<?php $__env->startSection('content'); ?>

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Contact Us </a>
               </div>
            </div>
         </div>
      </section>
<section class="section-padding">
<div class="container">

	<div class="">
        <?php if($errors != null): ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<div class="row mt-4">



<div class="col-lg-4 col-md-4">
<h3 class="mt-1 mb-5">Get In Touch</h3>
<h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
<p><?php echo e($result['contactDetails']->contact_address); ?></p>
<h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
<p><?php echo e($result['contactDetails']->contact_us_phone); ?></p>

<h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
<p><?php echo e($result['contactDetails']->contact_email); ?></p>


</div>
<div class="col-lg-8 col-md-8">

	<form action="<?php echo e(URL::to('/contactUsMail')); ?>" method="post" class="form-validate">
		<?php echo csrf_field(); ?>
		<div class="control-group form-group">
			<div class="controls">
				<label>Full Name <span class="text-danger">*</span></label>
				<input type="text" placeholder="Full Name" class="form-control" id="name" required="" data-validation-required-message="Please enter your name." name="contact_name">
				<p class="help-block"></p>
			</div>
		</div>
		<div class="row">
			<div class="control-group form-group col-md-6">
				<label>Phone Number <span class="text-danger">*</span></label>
				<div class="controls">
					<input type="text" placeholder="Phone Number" class="form-control" id="phone" required="" data-validation-required-message="Please enter your phone number." name="contact_phone">
					<div class="help-block"></div>
				</div>
			</div>
			<div class="control-group form-group col-md-6">
				<div class="controls">
					<label>Email Address <span class="text-danger">*</span></label>
					<input type="email" placeholder="Email Address" class="form-control" id="email" required="" data-validation-required-message="Please enter your email address." name="contact_mail">
					<div class="help-block"></div>
				</div>
			</div>
		</div>
		<div class="control-group form-group">
			<div class="controls">
				<label>Message <span class="text-danger">*</span></label>
				<textarea rows="4" cols="100" placeholder="Message" class="form-control" id="message" required="" data-validation-required-message="Please enter your message" maxlength="999" style="resize:none" name="contact_comment"></textarea>
				<div class="help-block"></div>
			</div>
		</div>
		<div id="success"></div>

		<button type="submit" class="btn btn-success">Send Message</button>
	</form>

</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/contact_us.blade.php ENDPATH**/ ?>