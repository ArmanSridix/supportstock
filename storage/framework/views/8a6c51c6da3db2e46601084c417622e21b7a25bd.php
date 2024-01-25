<div style="width: 100%; display:block;">
<h2>Welcome To Supportstock</h2>
<p>
	<strong><?php echo e(trans('labels.Hi')); ?> <?php echo e($userData[0]->first_name); ?> <?php echo e($userData[0]->last_name); ?>!</strong><br>
	Your OTP is <?php echo e($userData[0]->rand_otp); ?><br><br>
	<strong><?php echo e(trans('labels.Sincerely')); ?>,</strong><br>
	Supportstock
</p>
</div><?php /**PATH /home/supportmain/webapps/supportstock/resources/views//mail/fPasswordOtp.blade.php ENDPATH**/ ?>