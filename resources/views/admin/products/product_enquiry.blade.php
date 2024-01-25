@extends('admin.layout')
@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>  Enquiries <small>Enquiries...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active"> Enquiries</li>
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
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Pincode</th>
                                            <th>Quantity</th>
                                            <th>Expected Price</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($productEnquiryList)>0)
                                            @foreach ($productEnquiryList as $key=>$productEnquiry)
                                                <tr>
                                                    <td>{{ $productEnquiry->enquiry_products_id}}</td>
                                                    <td>{{ $productEnquiry->products_name }}</td>
                                                    <td>{{ $productEnquiry->enName }}</td>
                                                    <td>{{ $productEnquiry->enEmail }}</td>
                                                    <td>{{ $productEnquiry->enPhone }}</td>
                                                    <td>{{ $productEnquiry->cities_name }}</td>
                                                    <td>{{ $productEnquiry->pincodes_val }}</td>
                                                    <td>{{ $productEnquiry->enQuantity }}</td>
                                                    <td>{{ $productEnquiry->enPrice }}</td>
                                                    <td>{{ date("d-m-Y",strtotime($productEnquiry->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10">No record found..</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                        @if($productEnquiryList != null)
                                        <div class="col-xs-12 text-right">
                                            {{$productEnquiryList->links()}}
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

            {{--<div class="modal fade" id="deleteLanguagesModal" tabindex="-1" role="dialog" aria-labelledby="deleteLanguagesModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteLanguagesModalLabel">Delete</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/contactCommentDelete', 'name'=>'deletelanguages', 'id'=>'deletelanguages', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'languages_id')) !!}
                        <div class="modal-body">
                            <p>Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deletelanguages">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>--}}
           
            <!--  row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
