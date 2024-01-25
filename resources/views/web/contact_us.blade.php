@extends('web.layout')
@section('content')

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="{{ URL::to('/')}}"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Contact Us </a>
               </div>
            </div>
         </div>
      </section>
    <div id="page_container">
      <section class="section-padding">
<div class="container">

	<div class="">
        @if ($errors != null)
            @if($errors->any())
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{$errors->first()}}
                </div>
            @endif
        @endif
    </div>

<div class="row mt-4">



<div class="col-lg-4 col-md-4">
<h3 class="mt-1 mb-5">Get In Touch</h3>
<h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
<p>{{$result['contactDetails']->contact_address}}</p>
<h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
<p>{{$result['contactDetails']->contact_us_phone}}</p>

<h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
<p>{{$result['contactDetails']->contact_email}}</p>


</div>
<div class="col-lg-8 col-md-8">

	<form action="{{ URL::to('/contactUsMail')}}" method="post" class="form-validate" id="contact_form">
		@csrf
		<div class="control-group form-group contact_divs">
			<div class="controls">
				<label>Full Name <span class="text-danger">*</span></label>
				<input type="text" placeholder="Full Name" class="form-control field-validate" id="contact_name" data-validation-required-message="Please enter your name." name="contact_name">
				<p class="help-block"></p>
			</div>
		</div>
		<div class="row contact_divs">
			<div class="control-group form-group col-md-6">
				<label>Phone Number <span class="text-danger">*</span></label>
				<div class="controls">
					<input type="text" placeholder="Phone Number" class="form-control phone-validate" id="contact_phone"  data-validation-required-message="Please enter your phone number." name="contact_phone" maxlength="10" >
					<div class="help-block"></div>
				</div>
			</div>
			<div class="control-group form-group col-md-6">
				<div class="controls">
					<label>Email Address <span class="text-danger">*</span></label>
					<input type="email" placeholder="Email Address" class="form-control email-validate" id="contact_mail" data-validation-required-message="Please enter your email address." name="contact_mail">
					<div class="help-block"></div>
				</div>
			</div>
		</div>
		<div class="control-group form-group contact_divs">
			<div class="controls">
				<label>Message <span class="text-danger">*</span></label>
				<textarea rows="4" cols="100" placeholder="Message" class="form-control field-validate" id="message" data-validation-required-message="Please enter your message" maxlength="999" style="resize:none" name="contact_comment"></textarea>
				<div class="help-block"></div>
			</div>
		</div>

		<div class="row" style="display: none;" id="otp_div" >
			<p>An OTP has been sent to your phone/email.</p>
			<div class="control-group form-group col-md-6">
				<label>OTP <span class="text-danger">*</span></label>
				<div class="controls">
					<input type="text" placeholder="Please enter OTP" class="form-control" id="contact_otp"  data-validation-required-message="Please enter OTP." name="contact_otp" >
					<div class="help-block"></div>
				</div>
			</div>
		</div>
		<input type="hidden" name="" id="send_otp" value="">
		<div class="alert alert-danger alert-dismissible" role="alert" id="otp_error_div" style="display: none;" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            OTP not match..
        </div>

		<div id="success"></div>

		<button type="button" class="btn btn-success" id="contact_submit" >Submit</button>

		<button type="button" class="btn btn-success" id="contact_send" style="display: none;" >Send Message</button>
	</form>

</div>
</div>
</div>
</section>
    </div>

<script type="text/javascript">

	$(document).on('click', '#contact_submit', function(){

		var error = "";

	      	$(".field-validate").each(function() {

		      if(this.value == '') {
		        var parent_id  = $(this).parents('.tab-pane').attr('id');
		        if(parent_id!=undefined){
		          $("[href='#"+parent_id+"']").css('color','red');
		          var position = $("[href='#"+parent_id+"']").offset().top;
		          $("body, html").animate({
		            scrollTop: position
		          } /* speed */ );
		        }
		        $(this).closest(".form-group").addClass('has-error');
		        //$(this).next(".error-content").removeClass('hidden');
		        error = "has error";
		      }else{
		        $(this).closest(".form-group").removeClass('has-error');
		        //$(this).next(".error-content").addClass('hidden');
		      }
		    });

		    $(".email-validate").each(function() {
		      var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		      if(this.value != '' && validEmail.test(this.value)) {
		        $(this).closest(".form-group").removeClass('has-error');
		        //$(this).next(".error-content").addClass('hidden');

		      }else{
		        $(this).closest(".form-group").addClass('has-error');
		        //$(this).next(".error-content").removeClass('hidden');
		        error = "has error";
		      }
		    });

		    //phone validate
		    $(".phone-validate").each(function() {
		      if(this.value == '' || this.value.length < 10 || isNaN(this.value)) {
		        $(this).closest(".form-group").addClass('has-error');
		        error = "has error";

		      }else{
		        $(this).closest(".form-group").removeClass('has-error');
		      }
		    });

		   	if(error=="has error"){
		        return false;
		    }else{
		    	var contact_name = $("#contact_name").val();
		    	var contact_phone = $("#contact_phone").val();
		    	var contact_mail = $("#contact_mail").val();

		    	$.ajax({

                  	type:'POST',
                  	url:'{{ url('contactOtpSend') }}',
                  	data:{"_token": "{{ csrf_token() }}",contact_name:contact_name,contact_phone:contact_phone,contact_mail:contact_mail},
                  	success:function(data){
                    	$('.contact_divs').css('display','none');
                    	$('#contact_submit').css('display','none');
				    	$('#otp_div').css('display','block');
				    	$('#contact_send').css('display','block');
				    	$("#contact_otp").addClass("field-validate");
				    	$('#send_otp').val(data.rand_otp);
                  	}

                });
		    }
    });

    $(document).on('click', '#contact_send', function(){
    	$('#otp_error_div').css('display','none');
    	var sendOtp = $("#send_otp").val();
    	var contact_otp = $("#contact_otp").val();
    	if (sendOtp!=contact_otp) {
    		$('#otp_error_div').css('display','block');
    		//alert('if'+sendOtp);
    	}else{
    		//alert('else'+sendOtp);
    		$('#otp_error_div').css('display','none');
    		$('#contact_form').submit();
    	}
    });
	
</script>

@endsection
