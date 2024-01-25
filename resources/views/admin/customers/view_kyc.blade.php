@extends('admin.layout')
@section('content')

<style type="text/css">
    .order-dt-img {
        background: #f9f9f9;
        padding: 10px;
        border: 1px solid #efefef;
        border-radius: 5px;
        width: 60px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> KYC <small>KYC List...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/customers/display')}}"><i class="fa fa-users"></i> {{ trans('labels.ListingAllCustomers') }}</a></li>
            <li class="active">KYC</li>
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
                        <div class="container-fluid">
                            {{--<div class="row">
                                <div class="col-lg-6 form-inline" id="contact-form">
                                    <form name='registration' id="registration" class="registration" method="get" action="{{url('admin/customers/filter')}}">
                                        <input type="hidden" value="{{csrf_token()}}">
                                        
                                        <div class="input-group-form search-panel ">
                                            <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy">
                                                <option value="" selected disabled hidden>Filter By</option>
                                                <option value="Name" @if(isset($filter)) @if ($filter=="Name" ) {{ 'selected' }} @endif @endif>{{ trans('labels.Name') }}</option>
                                                <option value="E-mail" @if(isset($filter)) @if ($filter=="E-mail" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Email') }}</option>
                                                <option value="Phone" @if(isset($filter)) @if ($filter=="Phone" ) {{ 'selected' }}@endif @endif>{{ trans('labels.Phone') }}</option>
                                                
                                            </select>
                                            <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" @if(isset($parameter)) value="{{$parameter}}" @endif>
                                            <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                            @if(isset($parameter,$filter)) <a class="btn btn-danger " href="{{url('admin/customers/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                        </div>
                                    </form>
                                    <div class="col-lg-4 form-inline" id="contact-form12"></div>
                                </div>
                                <div class="box-tools pull-right">
                                    <a href="{{ url('admin/customers/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                                </div>
                            </div>--}}
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
                                            <th>ID</th>
                                            <th>Title </th>
                                            <th>File </th>
                                            <th>Upload Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($result['allKyc'])>0)
                                        @foreach ($result['allKyc'] as $key=>$allKyc)
                                        <tr>
                                            <td>{{ $allKyc->corporate_kyc_id }}</td>
                                            <td>{{ $allKyc->kyc_title }}</td>
                                            <td>
                                                <a href="{{asset('upload_file/kyc').'/'.$allKyc->kyc_file}}" target="_blank">
                                                    <img src="{{asset('upload_file/kyc').'/'.$allKyc->kyc_file}}" alt="" height="50px">
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($allKyc->created_at)) }}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4">{{ trans('labels.NoRecordFound') }}</td>
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

        <!-- /.row -->

        

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
