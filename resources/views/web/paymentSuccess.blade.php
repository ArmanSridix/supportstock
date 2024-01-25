@extends('web.layout')
  @section('content')

    <section class="pt-2 pb-2 page-info section-padding border-bottom bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <a href="javascript:;"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="javascript:;">Payment</a> 
          </div>
        </div>
      </div>
    </section>

    <section class="shop-single section-padding pt-3">
      <div class="checkout block">
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <div class="form-dt">
                                
                                <?php if($returnData['order_status'] == 'success'){ ?>
                                    <div>
                                        <h1>Thank You</h1>
                                        <h4><?php echo $returnData['message']; ?></h4>
                                        <p>Payment ID: <?php echo $returnData['payment_id']; ?></p>

                                        <a href="{{ url('orders') }}" class="next-btn16 hover-btn" >Ok</a>
                                    </div>
                                <?php } ?>

                                <?php if($returnData['order_status'] == 'fail'){ ?>
                                    <div>
                                        <h4><?php echo $returnData['message']; ?></h4>

                                        <a href="{{ url('checkout') }}" class="next-btn16 hover-btn" >Ok</a>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>

  @endsection

