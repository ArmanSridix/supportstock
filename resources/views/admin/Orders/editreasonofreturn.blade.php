@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.editreasonOfReturn') }} <small>{{ trans('labels.editreasonOfReturn') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/orders/reasonOfReturnOrder')}}"><i class="fa fa-dashboard"></i>{{ trans('labels.reasonOfReturn') }}</a>
                <li class="active">{{ trans('labels.editreasonOfReturn') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.editreasonOfReturn') }}</h3>
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

                                            {!! Form::open(array('url' =>'admin/orders/updateReasonOfReturnOrder', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                              {!! Form::hidden('reason_id', $result['orders_cancle_reason']->reason_id ) !!}
                                              <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ReturnReason') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <textarea rows="4" cols="100" placeholder="Message" class="form-control" id="message" required="" data-validation-required-message="Please enter Reason" maxlength="999" style="resize:none" name="status_reason">{{ $result['orders_cancle_reason']->status_reason }}</textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                                  <div class="col-sm-10 col-md-4">
                                                      <select name="reason_status" class="form-control" >
                                                          <option value="0" @if($result['orders_cancle_reason']->reason_status==0) selected @endif>{{ trans('labels.Disable') }}</option>
                                                          <option value="1" @if($result['orders_cancle_reason']->reason_status==1) selected @endif>{{ trans('labels.Active') }}</option>
                                                      </select>
                                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"></span>
                                                  </div>
                                              </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                    <a href="{{ URL::to('admin/orders/reasonOfReturnOrder')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                                </div>
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

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
