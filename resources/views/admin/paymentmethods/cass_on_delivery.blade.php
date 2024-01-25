@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Cash On Delivery Price Limit <small>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> Cash On Delivery</li>
            </ol>
        </section>

        <!--  content -->
        <section class="content">
            <!-- Info boxes -->

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if ($errors)
                                        @if($errors->any())
                                            <div @if ($errors->first()=='Default can not Deleted!!') class="alert alert-danger alert-dismissible" @else class="alert alert-success alert-dismissible" @endif role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.ID')}}</th>
                                            <th>User Type</th>
                                            <th>Minimum Price</th>
                                            <th>Maximum Price</th>
                                            <th>{{trans('labels.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($result['cod_list'] as $cod_list)
                                                <tr>
                                                    <td>
                                                      {{$cod_list->cod_limit_id}}
                                                    </td>
                                                    
                                                    <td>
                                                        <?php if($cod_list->cod_user_type=='Normal'){echo "Normal User";} ?>
                                                        <?php if($cod_list->cod_user_type=='Corporate'){echo "Corporate User";} ?>
                                                    </td>

                                                    <td>
                                                      {{$cod_list->cod_min_price}}
                                                    </td>
                                                    <td>
                                                      {{$cod_list->cod_max_price}}
                                                    </td>
                                                    <td>
                                                        <a href="{{url('admin/paymentmethods/cashOnDelivery/edit')}}/{{$cod_list->cod_limit_id}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
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
            <!-- /.row -->
            <!-- deletelanguagesModal -->

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
