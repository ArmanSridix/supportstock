
<script src="{{ asset('frontEnd/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontEnd/js/header.js') }}"></script>
<script src="{{ asset('frontEnd/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontEnd/js/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontEnd/js/jquery.mobile-menu.min.js') }}"></script> 

<script src="{{ asset('frontEnd/js/jquery.exzoom.js') }}"></script>
<script src="{{ asset('frontEnd/js/jquery-ui.js') }}"></script>
<!-- <script src="{{ asset('frontEnd/js/price-range.js') }}"></script> -->
<script src="{{ asset('frontEnd/js/number.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontEnd/js/jquery-accordion-menu.js') }}"> </script>
<script src="{{ asset('frontEnd/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontEnd/mSelect/chosen.jquery.min.js') }}"></script>


<script type="text/javascript">

  $(document).ready(function(){

    $(".mSelectDropdown").chosen({
      width: "100%",
      placeholder_text_multiple:"Choose...",
      max_shown_results:"Infinity",
      search_contains:"true"
    });

    $(".headerSelectCity").click(function() {
        $("#locationModal").modal('toggle');
    });

    <?php if(Session::has('middleWarePincodeError')){ ?>
      $("#locationModal").modal('toggle');
    <?php } ?>

    <?php if(Session::has('ProductPincodeError')){ ?>
      $("#ProductPincodeErrorModal").modal('toggle');
    <?php } ?>


    <?php if(Session::has('middleWareloginError')){ ?>
      $("#bd-example-modal").modal('toggle');
      $("#login").show();
      $("#forgotpassword").hide();
      $("#register").hide();
      $("#otp").hide();
    <?php } ?>

    <?php if(Session::has('loginError')){ ?>
      $("#bd-example-modal").modal('toggle');
      $("#login").show();
      $("#forgotpassword").hide();
      $("#register").hide();
      $("#otp").hide();
    <?php } ?>

    <?php if(Session::has('SignupError')){ ?>
      $("#bd-example-modal").modal('toggle');
      $("#login").hide();
      $("#forgotpassword").hide();
      $("#register").show();
      $("#otp").hide();
    <?php } ?>

    <?php if(Session::has('SignupError')){ ?>
      $("#bd-example-modal").modal('toggle');
      $("#login").hide();
      $("#forgotpassword").hide();
      $("#register").show();
      $("#otp").hide();
    <?php } ?>

    <?php if(Session::has('signUpData') || Session::has('OtpError')){ ?>
        $("#bd-example-modal").modal('toggle');
        $("#login").hide();
        $("#forgotpassword").hide();
        $("#register").hide();
        $("#otp").show();
      <?php } ?>
  
      <?php if(Session::has('fp_error')){ ?>
      $("#bd-example-modal").modal('toggle');
      $("#login").hide();
      $("#forgotpassword").show();
      $("#register").hide();
      $("#otp").hide();
    <?php } ?>

    <?php if(Session::has('otp_success') || Session::has('otp_error')){ 
      $user_id = Session::get('user_id'); ?>
      $("#otp-example-modal").modal('toggle');
      $('#otp_user_id').val(<?php echo $user_id; ?>);
    <?php } ?>
    
    <?php if(Session::has('up_password_success') || Session::has('up_password_error')){ 
      $user_id = Session::get('user_id'); ?>
      $("#change-password-modal").modal('toggle');
      $('#cp_user_id').val(<?php echo $user_id; ?>);
    <?php } ?>
      
    $('#loginCloseButton').click(function(){
      // alert("hi!");
    
    });
   
    $('#Locality').change(function(){
      var cities_id = $(this).val()
      if(cities_id == ""){
        $(".pin").remove();
      }else{
        $.ajax({
          type:'POST',
          url:'{{ url('pincodeList') }}',
          data:{cities_id:cities_id,"_token": "{{ csrf_token() }}"},
          success:function(data){
            var pincodeList = data.returnData['pincodeList'];
            // console.log(pincodeList);
            $(".pin").remove();
            $.each(pincodeList, function(key, value) {   
              console.log(value.pincodes_val);
              $('#pincode')
                .append($("<option></option>")
                            .attr("value", value.pincodes_id)
                            .attr("class", "pin")
                            .text(value.pincodes_val)); 
            });
          }
        });
      }
    });

    $('#edit-Locality').change(function(){
      var cities_id = $(this).val()
      if(cities_id == ""){
        $(".edit-pin").remove();
      }else{
        $.ajax({
          type:'POST',
          url:'{{ url('pincodeList') }}',
          data:{cities_id:cities_id,"_token": "{{ csrf_token() }}"},
          success:function(data){
            var pincodeList = data.returnData['pincodeList'];
            // console.log(pincodeList);
            $(".edit-pin").remove();
            $.each(pincodeList, function(key, value) {   
              console.log(value.pincodes_val);
              $('#edit-pincode')
                .append($("<option></option>")
                            .attr("value", value.pincodes_id)
                            .attr("class", "edit-pin")
                            .text(value.pincodes_val)); 
            });
          }
        });
      }
    });

    $('.edit_address').click(function(){
      var default_address_id = 0;
      <?php 
        if(Session::has('supportUserDetails')){ 
          $user_details = Session::get('supportUserDetails'); ?>
          var default_address_id = <?php echo $user_details->default_address_id; ?>;
      <?php } ?>
      
      var detailed_address = $(this).parents(".detailed-address-div").children(".detailed-address").text();
      var city_id = $(this).parents(".detailed-address-div").children(".detailed-address-city-id").text();
      var address_book_id = $(this).parents(".detailed-address-div").children(".detailed-address-id").text();
      if(default_address_id == address_book_id){
        $('#edit-default-address').prop('checked', true);
      }else{
        $('#edit-default-address').prop('checked', false);
      }
      $('#edit-address_book_id').val(address_book_id);
      var detailed_address = detailed_address.split(", ");
      $('#edit-flat').val(detailed_address[0]);
      $('#edit-street').val(detailed_address[1]);
      $('#edit-Locality option[value='+city_id+']').attr("selected", "selected");
      $.ajax({
          type:'POST',
          url:'{{ url('pincodeList') }}',
          data:{cities_id:city_id,"_token": "{{ csrf_token() }}"},
          success:function(data){
            var pincodeList = data.returnData['pincodeList'];
            $(".edit-pin").remove();
            $.each(pincodeList, function(key, value) {   
              if(detailed_address[3] == value.pincodes_val){
                $('#edit-pincode')
                .append($("<option selected></option>")
                            .attr("value", value.pincodes_id)
                            .attr("class", "edit-pin")
                            .text(value.pincodes_val));
                
              }else{
                $('#edit-pincode')
                .append($("<option></option>")
                            .attr("value", value.pincodes_id)
                            .attr("class", "edit-pin")
                            .text(value.pincodes_val));
              }
            });
          }
        });
      $('#editaddress_model').modal('toggle');
    
    });


    //cancelReasonModal
    $(document).on('click', '#cancelReason', function(){
      var orders_products_id = $(this).attr('orders_products_id');
      $('#cancel_orders_products_id').val(orders_products_id);
      $("#CancelModal").modal('show');
    });
    // ReturnModal
    $(document).on('click', '#returnReason', function(){
      var orders_products_id = $(this).attr('orders_products_id');
      $('#return_orders_products_id').val(orders_products_id);
      $("#ReturnModal").modal('show');
    });
  });

  
  function headerCartPincodeCheck(){
    $("#locationModal").modal('toggle');
  }
      
  function pincodeByCity(){
    var cities_id = $('#webb_cities').val();
    $('#pincodeErrDiv1').css('display','none');

    $.ajax({

      type:'POST',
      url:'{{ url('pincodesByCity') }}',
      data:{cities_id:cities_id,"_token": "{{ csrf_token() }}"},
      success:function(data){
        //console.log(data.pincode_list);
        $('#webb_pincode').html('');
        $('#webb_pincode').append( $('<option></option>').val("").html("Please select your Pincode") )
        $.each(data.pincode_list, function(val, text) {
            $('#webb_pincode').append( $('<option></option>').val(text.pincodes_id).html(text.pincodes_val) )
        });
        $("#webb_pincode").trigger('chosen:updated');
      }

    });

  }

  function cityCheck(){
    
    var cities_id = $('#webb_cities').val();
    console.log($('#webb_cities'));
    var pincodes_id = $('#webb_pincode').val();
    //alert(cities_id);
    if (cities_id=='') {
     
      $('#pincodeErrDiv1').css('display','block');
    }else if (pincodes_id=='') {
      
      $('#pincodeErrDiv1').css('display','none');
      $('#pincodeErrDiv2').css('display','block');
    }else{
      $('#pincodeErrDiv1').css('display','none');
      $('#pincodeErrDiv2').css('display','none');
      $.ajax({

        type:'POST',
        url:'{{ url('checkPincodeExist') }}',
        data:{pincodes_id:pincodes_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          //console.log(data.pincode_exist);
          if (data.pincode_exist == 'yes') {
            $('#pincodeErrDiv').css('display','none');
            //window.location.href = "<?php //echo url('/'); ?>";
            location.reload();
          }
          if (data.pincode_exist == 'no') {
            $('#pincodeErrDiv').css('display','block');
          }
        }

      });

    }
  }
  

  function addWishList(products_id){
      //alert(products_id);
      $.ajax({

        type:'POST',
        url:'{{ url('addWishlistWeb') }}',
        data:{products_id:products_id,"_token": "{{ csrf_token() }}"},
        success:function(data){
          console.log(data.returnData['isLogin']);
          if (data.returnData['isLogin']=='no') {
            $("#bd-example-modal").modal('toggle');
            $("#login").show();
            $("#forgotpassword").hide();
            $("#register").hide();
          }
          if (data.returnData['isLogin']=='yes') {
            console.log(data.returnData['cartResponse']['success']);
            if (data.returnData['cartResponse']['success']==1) {
              $(".pro_wish_"+products_id).removeClass("liked");
            }
            if (data.returnData['cartResponse']['success']==2) {
              $(".pro_wish_"+products_id).addClass("liked");
            }
          }
          
        }

      });
    }

  
	
    function openNav() {
      document.getElementById("mobile-menu").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mobile-menu").style.width = "0";
    }
</script>


<script type="text/javascript">
  jQuery(document).ready(function() {
      // jQuery("#jquery-accordion-menu").jqueryAccordionMenu();
      jQuery(".colors a").click(function() {
        console.log('efdsgrf');
          if ($(this).attr("class") != "default") {
              $("#jquery-accordion-menu").removeClass();
              $("#jquery-accordion-menu").addClass("jquery-accordion-menu").addClass($(this).attr("class"));
          } else {
              $("#jquery-accordion-menu").removeClass();
              $("#jquery-accordion-menu").addClass("jquery-accordion-menu");
          }
      });


     
  });

  // jQuery(document).ready(function() {
  //   $("#category-mobile-menu").mobileMenu({
  //       MenuWidth: 0,
  //       SlideSpeed: 300,
  //       WindowsMaxWidth: 767,
  //       PagePush: true,
  //       FromLeft: true,
  //       Overlay: true,
  //       CollapseMenu: true,
  //       ClassName: "mobile-menu"
  //   }); 
  //   var window_width = $(window).width();
  //   if(window_width < 992){
  //     $('.category-list').hide();
  //   } else{
  //     $('#category-mobile-menu').hide();
  //   }
  // });


  //validate form
  $(document).on('submit', '.form-validate', function(e){
    var error = "";
    //to validate text field
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

    $(".required_one").each(function() {
      var checked = $('.required_one:checked').length;
      if(!checked) {
        $(this).closest(".form-group").addClass('has-error');
        error = "has error";
      }else{
        $(this).closest(".form-group").removeClass('has-error');
      }
    });

    $(".number-validate").each(function() {
      if(this.value == '' || isNaN(this.value)) {
        $(this).closest(".form-group").addClass('has-error');
        //$(this).next(".error-content").removeClass('hidden');
        error = "has error";
      }else{
        $(this).closest(".form-group").removeClass('has-error');
        //$(this).next(".error-content").addClass('hidden');
      }
    });

    //focus form field
    $(".price-validate").each(function() {

      if(this.value == ''  || this.value < 1 || isNaN(this.value)) {
        $(this).closest(".form-group").addClass('has-error');
        //$(this).next(".error-content").removeClass('hidden');
          error = "has error";
      }else{
        $(this).closest(".form-group").removeClass('has-error');
        //$(this).next(".error-content").addClass('hidden');
      }

    });

    //focus form field
    $(".stock-validate").each(function() {
      //var re = /^[-+]?[0-9]+\.[0-9]+$/;
      // /this.value.match( re )
      var x = event.keyCode;
      // if(this.value == '' || isNaN(this.value) || this.value > 0) {
      if(this.value == '' || isNaN(this.value) || this.value < 1 || this.value % 1 != 0 || x == 110 || x == 190) {
        //$(this).closest(".form-group").addClass('has-error');
        $(this).val(1);
        //$(this).next(".error-content").removeClass('hidden');
      }else{
        $(this).closest(".form-group").removeClass('has-error');
        //$(this).next(".error-content").addClass('hidden');
      }

    });

    //
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

    //postcode validate
    $(".postcode-validate").each(function() {
      if(this.value == '' || this.value.length < 6 || isNaN(this.value)) {
        $(this).closest(".form-group").addClass('has-error');
        error = "has error";

      }else{
        $(this).closest(".form-group").removeClass('has-error');
      }
    });

    if(error=="has error"){
        return false;
    }

  });

  //focus form field
  $(document).on('keyup change', '.field-validate', function(e){

    if(this.value == '') {
      $(this).closest(".form-group").addClass('has-error');
      //$(this).next(".error-content").removeClass('hidden');
    }else{
      $(this).closest(".form-group").removeClass('has-error');
      //$(this).next(".error-content").addClass('hidden');
    }

  });

  $(document).on('click', '.required_one', function(e){

    var checked = $('.required_one:checked').length;
    if(!checked) {
      $(this).closest(".form-group").addClass('has-error');
    }else{
      $(this).closest(".form-group").removeClass('has-error');
    }

  });

  //focus form field
  $(document).on('keyup', '.number-validate', function(e){

    if(this.value == '' || isNaN(this.value)) {
      $(this).closest(".form-group").addClass('has-error');
      //$(this).next(".error-content").removeClass('hidden');
    }else{
      $(this).closest(".form-group").removeClass('has-error');
      //$(this).next(".error-content").addClass('hidden');
    }

  });

  //focus form field
  $(document).on('keyup', '.price-validate', function(e){

    if(this.value == ''  || this.value < 1 || isNaN(this.value)) {
      $(this).closest(".form-group").addClass('has-error');
      //$(this).next(".error-content").removeClass('hidden');
    }else{
      $(this).closest(".form-group").removeClass('has-error');
      //$(this).next(".error-content").addClass('hidden');
    }

  });

  //focus form field
  $(document).on('keyup', '.stock-validate', function(e){
    //var re = /^[-+]?[0-9]+\.[0-9]+$/;
    // /this.value.match( re )
    var x = event.keyCode;
    // if(this.value == '' || isNaN(this.value) || this.value > 0) {
    if(this.value == '' || isNaN(this.value) || this.value < 1 || this.value % 1 != 0 || x ==110 || x ==190) {
      //$(this).closest(".form-group").addClass('has-error');
      $(this).val(1);
      //$(this).next(".error-content").removeClass('hidden');
    }else{
      $(this).closest(".form-group").removeClass('has-error');
      //$(this).next(".error-content").addClass('hidden');
    }

  });

  $(document).on('keyup focusout', '.email-validate', function(e){
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

  $(document).on('keyup focusout', '.phone-validate', function(e){

    if(this.value == '' || isNaN(this.value) || this.value.length < 10) {
      $(this).closest(".form-group").addClass('has-error');
      error = "has error";

    }else{
      $(this).closest(".form-group").removeClass('has-error');
    }
  });

  $(document).on('keyup focusout', '.postcode-validate', function(e){

    if(this.value == '' || isNaN(this.value) || this.value.length < 6) {
      $(this).closest(".form-group").addClass('has-error');
      error = "has error";

    }else{
      $(this).closest(".form-group").removeClass('has-error');
    }
  });

</script>


<script type="text/javascript">

  $(document).on('click', '#sellon_next_btn', function(){

    var error = "";

          $(".field-validate-sell").each(function() {

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

        $(".email-validate-sell").each(function() {
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
        $(".phone-validate-sell").each(function() {
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
          var contact_name = $("#sName").val();
          var contact_phone = $("#sPhone").val();
          var contact_mail = $("#sEmail").val();

          $.ajax({

                    type:'POST',
                    url:'{{ url('contactOtpSend') }}',
                    data:{"_token": "{{ csrf_token() }}",contact_name:contact_name,contact_phone:contact_phone,contact_mail:contact_mail},
                    success:function(data){
                      $('.sellondiv').css('display','none');
                      $('#sellon_next').css('display','none');
                      $('#sellon_otpdiv').css('display','block');
                      $('#sellon_submit').css('display','block');
                      $("#sOtp").addClass("field-validate");
                      $('#sell_send_otp').val(data.rand_otp);
                    }

                });
        }
    });

    $(document).on('click', '#sellon_submit_btn', function(){
      $('#sell_otp_error_div').css('display','none');
      var sendOtp = $("#sell_send_otp").val();
      var sOtp = $("#sOtp").val();
      if (sendOtp!=sOtp) {
        $('#sell_otp_error_div').css('display','block');
        //alert('if'+sendOtp);
      }else{
        //alert('else'+sendOtp);
        $('#sell_otp_error_div').css('display','none');
        $('#sellon_form').submit();
      }
    });

    $(document).on('keyup change', '.field-validate-sell', function(e){

      if(this.value == '') {
        $(this).closest(".form-group").addClass('has-error');
        //$(this).next(".error-content").removeClass('hidden');
      }else{
        $(this).closest(".form-group").removeClass('has-error');
        //$(this).next(".error-content").addClass('hidden');
      }

    });

    $(document).on('keyup focusout', '.email-validate-sell', function(e){
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

    $(document).on('keyup focusout', '.phone-validate-sell', function(e){

      if(this.value == '' || isNaN(this.value) || this.value.length < 10) {
        $(this).closest(".form-group").addClass('has-error');
        error = "has error";

      }else{
        $(this).closest(".form-group").removeClass('has-error');
      }
    });
  
</script>




<script type="text/javascript">


var sync1 = $(".slider");
var sync2 = $(".navigation-thumbs");

var thumbnailItemClass = '.owl-item';

var slides = sync1.owlCarousel({
	video:true,
  startPosition: 12,
  items:1,
  loop:true,
  margin:10,
  autoplay:false,
  autoplayTimeout:6000,
  autoplayHoverPause:false,
   nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
  dots: false,
}).on('changed.owl.carousel', syncPosition);

function syncPosition(el) {
  $owl_slider = $(this).data('owl.carousel');
  var loop = $owl_slider.options.loop;

  if(loop){
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    if(current < 0) {
        current = count;
    }
    if(current > count) {
        current = 0;
    }
  }else{
    var current = el.item.index;
  }

  var owl_thumbnail = sync2.data('owl.carousel');
  var itemClass = "." + owl_thumbnail.options.itemClass;


  var thumbnailCurrentItem = sync2
  .find(itemClass)
  .removeClass("synced")
  .eq(current);

  thumbnailCurrentItem.addClass('synced');

  if (!thumbnailCurrentItem.hasClass('active')) {
    var duration = 300;
    sync2.trigger('to.owl.carousel',[current, duration, true]);
  }   
}
var thumbs = sync2.owlCarousel({
  startPosition: 12,
  items:4,
  loop:false,
  margin:10,
  autoplay:false,
  nav: false,
  dots: false,
  onInitialized: function (e) {
    var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
    thumbnailCurrentItem.addClass('synced');
  },
})
.on('click', thumbnailItemClass, function(e) {
    e.preventDefault();
    var duration = 300;
    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
}).on("changed.owl.carousel", function (el) {
  var number = el.item.index;
  $owl_slider = sync1.data('owl.carousel');
  $owl_slider.to(number, 100, true);
});



</script>


