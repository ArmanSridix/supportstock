@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.reasonOfReturn') }} <small>{{ trans('labels.reasonOfReturn') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.reasonOfReturn') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.ListingReasonOfReturnOrder') }} </h3>
                            <div class="box-tools pull-right">
                                <a href="addReasonOfReturnOrder" type="button" class="btn btn-block btn-primary">{{ trans('labels.addreasonOfReturn') }}</a>
                            </div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>{{ trans('labels.Reasons') }}</th>
                                            <th>{{ trans('labels.Status') }}</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($result['orders_cancle_reasons'] as $orders_cancle_reason)
                                            <tr>
                                                <td>{{ $orders_cancle_reason->reason_id  }}</td>
                                                <td>{{ $orders_cancle_reason->status_reason }}</td>
                                                <td>
                                                @if($orders_cancle_reason->reason_status==0) 
                                                <span class="badge badge-secondary">Disable</span>
                                                 @elseif($orders_cancle_reason->reason_status==1)
                                                 <span class="badge" style="background-color:'green' !important;">Active</span>
                                                 @endif
                                                </td>
                                               
                                                <td><a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Edit') }}" href="editReasonOfReturnOrder/{{ $orders_cancle_reason->reason_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                     <a data-toggle="tooltip" data-placement="bottom" title="{{ trans('labels.Delete') }}" id="deleteReasonOfReturnOrder" reason_id ="{{ $orders_cancle_reason->reason_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        {{$result['orders_cancle_reasons']->links()}}
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
            <!-- deleteOrderStatusModal -->
            <div class="modal fade" id="deleteReasonOfReturnOrderModal" tabindex="-1" role="dialog" aria-labelledby="deleteReasonOfReturnOrder">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteReasonOfReturnOrder">{{ trans('labels.DeleteOrderStatus') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/orders/deleteReasonOfReturnOrder', 'name'=>'deleteOrderStatus', 'id'=>'deleteOrderStatus', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('reason_id',  '', array('class'=>'form-control', 'id'=>'reason_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.deletereasonOfReturnText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteOrderStatus">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
