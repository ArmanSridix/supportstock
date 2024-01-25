@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.pincode') }} <small>{{ trans('labels.EditCurrentPincode') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/pincode/display')}}"><i class="fa fa-language"></i>{{ trans('labels.pincode') }}</a></li>
                <li class="active">{{ trans('labels.EditPincode') }}</li>
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
                          <h3 class="box-title">{{ trans('labels.EditPincode') }}</h3>
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
                                        <br>                       
                        
                        @if(session()->has('message'))
                            <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('errorMessage'))
                            <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('errorMessage') }}
                            </div>
                        @endif
                                        <!-- form start -->
                                        <div class="box-body">

                                            {!! Form::open(array('url' =>'admin/pincode/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                            {!! Form::hidden('pincodes_id',  $result['pincodes'][0]->pincodes_id, array('class'=>'form-control', 'id'=>'pincodes_id'))!!}

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.pincodeCity') }}<span style="color:red;">*</span>

                                                </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select class="form-control field-validate" name="pincodes_city_id">
                                                        <option value="">{{ trans('labels.ChooseCity') }}</option>
                                                        @foreach ($result['cities'] as $cities)
                                                        <option value="{{ $cities->cities_id }}" <?php echo ($result['pincodes'][0]->pincodes_city_id==$cities->cities_id)?'selected':''; ?> >{{ $cities->cities_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                        {{ trans('labels.ChooseCity') }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.pincode') }}<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('pincodes_val',  $result['pincodes'][0]->pincodes_val, array('class'=>'form-control field-validate', 'id'=>'pincodes_val'))!!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.examplePincode') }}</span>
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>

                                            
                                            <!-- /.box-body -->
                                            <div class="box-footer text-right">
                                                <div class="col-sm-offset-2 col-md-offset-3 col-sm-10 col-md-4">
                                                    <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                    <a href="{{ URL::to('admin/pincode/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
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
