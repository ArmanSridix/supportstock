@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Edit Shipping rate <small>{{ trans('labels.Setting') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/shippingmethods/display')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.ShippingMethods') }}</a></li>
                <li class="active">Edit Shipping rate</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Edit Shipping rate</h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        @if($errors->any())
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">
                                        {!! Form::open(array('url' =>'admin/shippingmethods/update', 'method'=>'post', 'id'=>'shippingmethodsupdate', 'class' => 'form-horizontal form-validate' )) !!}

                                        <input type="hidden" name="id" class="form-control field-validate" value="{{ $shipping_rate->id }}">
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Amount (From)</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="amount_from" id="amount_from" class="form-control field-validate" value="{{ $shipping_rate->amount_from }}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter Amount (from).</span>
                                                    <span class="help-block hidden">Please enter Amount (from).</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Amount (To)</label>
                                                <div class="col-sm-10 col-md-8">
                                                    <input type="text" name="amount_to" id="amount_to" class="form-control field-validate" value="{{ $shipping_rate->amount_to }}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter Amount (to)</span>
                                                    <span class="help-block hidden">Please enter Amount (to).</span>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">Shipping Rate</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="text" name="shipping_rate" class="form-control field-validate" value="{{ $shipping_rate->shipping_rate }}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter Shipping Rate.</span>
                                                    <span class="help-block hidden">Please enter Shipping Rate.</span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                            <a href="{{ URL::to('admin/shippingmethods/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>

                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <script>
                $("#shippingmethodsupdate").on("submit", function(){
                    var amount_to = $("#amount_to").val();
                    var amount_from = $("#amount_from").val();
                    if(amount_to < amount_from){
                        alert("Ammount(to) is lesser than Ammount(from)");
                        return false;
                    }
                    
                })
            </script>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
