@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.ShippingMethods') }} <small>{{ trans('labels.ShippingMethods') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.ShippingMethods') }}</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> {{ trans('labels.ShippingMethods') }} </h3>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/shippingmethods/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            @if (count($errors) > 0)
                                @if($errors->any())
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                        {{ trans('labels.ShippingMethodsChangedMessage') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped" style="text-align: center;">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center;">Sl. No.</th>
                                            <th style="text-align: center;">From</th>
                                            <th style="text-align: center;">To</th>
                                            <th style="text-align: center;">Shipping Rate</th>
                                            <th style="text-align: center;">{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if($shipping_rate != null)
                                                @foreach ($shipping_rate as  $key=>$shipping)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $shipping->amount_from }}</td>
                                                        <td>{{ $shipping->amount_to }}</td>
                                                        <td>{{ $shipping->shipping_rate }}</td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="{{ URL::to('admin/shippingmethods/edit/'.$shipping->id)}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                            <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteshippingrate" shipping_rate_id="{{ $shipping->id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">{{ trans('labels.NoRecordFound') }}.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- deleteNewsModal -->
            <div class="modal fade" id="deleteshippingrateModal" tabindex="-1" role="dialog" aria-labelledby="deleteshippingrateModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteshippingrateModalLabel">Delete Shipping Rate.</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/shippingmethods/delete', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'shipping_rate_id')) !!}
                        <div class="modal-body">
                            <p>Delete</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletefaq">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
