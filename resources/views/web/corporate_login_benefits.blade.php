@extends('web.layout')
@section('content')

<section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="{{ URL::to('/')}}"><strong><span class="mdi mdi-home"></span> Home</strong></a>   <span class="mdi mdi-chevron-right"></span><a href="javascript:;"> Corporate Login Benefit's </a>
               </div>
            </div>
         </div>
      </section>
     <section class="section-padding">
<div class="section-title text-center mb-4 mt-4">
<h2>Corporate Login Benefit's</h2>

</div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12">

	<?php echo stripslashes($result['corporate_login_benefits']->cms_text); ?>
	
</div>


</div>

</div>
</section>

@endsection
