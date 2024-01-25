@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Orders') }} <small>{{ trans('labels.ListingAllOrders') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.Orders') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.ListingAllOrders') }} </h3>

                            <div CLASS="col-lg-12"> <h7 style="font-weight: bold; padding:0px 16px; float: left;">Filter By Status:</h7>
                            <br>
                            <div class="col-lg-10 form-inline">

                                <form  name='registration' id="registration2" class="registration" method="get">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <div class="input-group-form search-panel ">
                                        <select id="FilterBy" type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="orders_status_id">

                                            <option value="" selected disabled hidden>Choose Status</option>

                                            @foreach( $listingOrders['orders_status'] as $orders_status)
                                                <option value="{{ $orders_status->orders_status_id }}"
                                                    @if(isset($_REQUEST['orders_status_id']) and !empty($_REQUEST['orders_status_id']))
                                                        @if( $orders_status->orders_status_id == $_REQUEST['orders_status_id'])
                                                            selected
                                                        @endif
                                                    @endif
                                                >{{ $orders_status->orders_status_name }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($_REQUEST['orders_status_id']))  <a class="btn btn-danger " href="{{url('admin/orders/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
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
                                            <th>{{ trans('labels.CustomerName') }}</th>
                                            <th>{{ trans('labels.OrderTotal') }}</th>
                                            <th>{{ trans('labels.DatePurchased') }}</th>
                                            <th>{{ trans('labels.Status') }} </th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($listingOrders['orders'])>0)
                                            @foreach ($listingOrders['orders'] as $key=>$orderData)
                                                <tr>
                                                    <td>{{ $orderData->orders_id }}</td>
                                                    <td>{{ $orderData->customers_name }}</td>
                                                    <td>
                                                        
                                                        @if(!empty($result['commonContent']['currency']->symbol_left)) {{$result['commonContent']['currency']->symbol_left}} @endif {{ $orderData->order_price }} @if(!empty($result['commonContent']['currency']->symbol_right)) {{$result['commonContent']['currency']->symbol_right}} @endif</td>
                                                    <td>{{ date('d/m/Y', strtotime($orderData->date_purchased)) }}</td>
                                                    <td>
                                                        @if($orderData->orders_status_id==1)
                                                            <span class="label label-warning">
                                                        @elseif($orderData->orders_status_id==2)
                                                            <span class="label label-success">
                                                        @elseif($orderData->orders_status_id==3)
                                                            <span class="label label-danger">
                                                        @else
                                                            <span class="label label-primary">
                                                        @endif
                                                        {{ $orderData->orders_status }}
                                                            </span>
                                                    </td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title="View Order" href="vieworder/{{ $orderData->orders_id }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                        <a data-toggle="tooltip" data-placement="bottom" title="Delete Order" id="deleteOrdersId" orders_id ="{{ $orderData->orders_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6"><strong>{{ trans('labels.NoRecordFound') }}</strong></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="col-xs-12 text-right">
                                        

                                        {{ $listingOrders['orders']->appends(\Request::except('type'))->render() }}
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

            <!-- deleteModal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.DeleteOrder') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/orders/deleteOrder', 'name'=>'deleteOrder', 'id'=>'deleteOrder', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('orders_id',  '', array('class'=>'form-control', 'id'=>'orders_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteOrderText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteOrder">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
