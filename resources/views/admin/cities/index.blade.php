@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  {{ trans('labels.City') }} <small>{{ trans('labels.ListingAllCity') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> {{ trans('labels.City') }}</li>
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
                            <div class="col-lg-6 form-inline" id="contact-form">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/city/filter')}}">
                                    <input type="hidden"  value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown" name="FilterBy" id="FilterBy"  >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="city" @if(isset($filter)) @if  ($filter == "city") {{ 'selected' }}@endif @endif>{{trans('labels.City')}}</option>
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="Search term..." id="parameter" @if(isset($parameter)) value="{{$parameter}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($parameter,$filter))  <a class="btn btn-danger " href="{{url('admin/city/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/city/add')}}" type="button" style="display:inline-block; width: auto; margin-top: 0;" class="btn btn-block btn-primary">{{ trans('labels.AddNew') }}</a>
                            </div>
                        </div>

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

                            <!-- <div class="row default-div hidden">
                                <div class="col-xs-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ trans('labels.DefaultLanguageChangedMessage') }}
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('labels.ID') }}</th>
                                            <th>{{ trans('labels.pincodeCity') }}</th>
                                            <th>{{trans('labels.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($result['cities'])>0)
                                            @foreach ($result['cities'] as $key=>$cities)
                                                <tr>
                                                    <td>
                                                        {{ $cities->cities_id}}
                                                    </td>
                                                    <td>{{ $cities->cities_name }}</td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="bottom" title=" {{ $cities->cities_name }}" href="{{ URL::to('admin/city/edit/'.$cities->cities_id)}}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        
                                                        <!-- <a data-toggle="tooltip" data-placement="bottom" title=" {{ $cities->cities_name }}" id="deleteLanguageId" languages_id ="{{ $cities->cities_id }}" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">{{ trans('labels.NoCityExist') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                        @if($result['cities'] != null)
                                        <div class="col-xs-12 text-right">
                                            {{$result['cities']->links()}}
                                        </div>
                                        @endif
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

            <!-- <div class="modal fade" id="deleteLanguagesModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">{{ trans('labels.DeletePincode') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/pincode/delete', 'name'=>'deletepincode', 'id'=>'deletepincode', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'languages_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.confrimPincodeDelete') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletepincode">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div> -->

            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
