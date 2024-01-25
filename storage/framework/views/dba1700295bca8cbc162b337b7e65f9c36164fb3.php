
<script src="<?php echo e(asset('frontEnd/js/bootstrap.bundle.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('frontEnd/js/header.js')); ?>"></script>
<script src="<?php echo e(asset('frontEnd/js/select2.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('frontEnd/js/owl.carousel.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('frontEnd/js/jquery.mobile-menu.min.js')); ?>"></script> 

<script src="<?php echo e(asset('frontEnd/js/jquery.exzoom.js')); ?>"></script>
<script src="<?php echo e(asset('frontEnd/js/jquery-ui.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('frontEnd/js/price-range.js')); ?>"></script> -->
<script src="<?php echo e(asset('frontEnd/js/number.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('frontEnd/js/jquery-accordion-menu.js')); ?>"> </script>
<script src="<?php echo e(asset('frontEnd/js/custom.js')); ?>" type="text/javascript"></script>


<script type="text/javascript">

  $(document).ready(function(){


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
          url:'<?php echo e(url('pincodeList')); ?>',
          data:{cities_id:cities_id,"_token": "<?php echo e(csrf_token()); ?>"},
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
          url:'<?php echo e(url('pincodeList')); ?>',
          data:{cities_id:cities_id,"_token": "<?php echo e(csrf_token()); ?>"},
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
          url:'<?php echo e(url('pincodeList')); ?>',
          data:{cities_id:city_id,"_token": "<?php echo e(csrf_token()); ?>"},
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
  });
  

  function addWishList(products_id){
      //alert(products_id);
      $.ajax({

        type:'POST',
        url:'<?php echo e(url('addWishlistWeb')); ?>',
        data:{products_id:products_id,"_token": "<?php echo e(csrf_token()); ?>"},
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
      jQuery("#jquery-accordion-menu").jqueryAccordionMenu();
      jQuery(".colors a").click(function() {
          if ($(this).attr("class") != "default") {
              $("#jquery-accordion-menu").removeClass();
              $("#jquery-accordion-menu").addClass("jquery-accordion-menu").addClass($(this).attr("class"));
          } else {
              $("#jquery-accordion-menu").removeClass();
              $("#jquery-accordion-menu").addClass("jquery-accordion-menu");
          }
      });


     
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


<?php /**PATH /home/demo203/webapps/demo203/supportstock/resources/views/web/common/scripts.blade.php ENDPATH**/ ?>