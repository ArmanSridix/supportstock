@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Manage Adds <small>Manage Adds...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/categories/display')}}"><i class="fa fa-database"></i> {{ trans('labels.Categories') }}</a></li>
            <li class="active">Manage Adds</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <!-- left add -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Left Adds </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                      @if($errors->has('adds_position'))
                                        @if($errors->first('adds_position') == 'left')
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first('message')}}
                                      </div>
                                        @endif
                                      @endif
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/categories/updateAdds', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('categories_id', $result['categories_id'] , array('class'=>'form-control', 'id'=>'id')) !!}
                                        {!! Form::hidden('adds_position', 'left' , array('class'=>'form-control', 'id'=>'adds_position')) !!}

                                        <!-- <input type="hidden" name="oldImage" id="oldImage" value="<?php //if(isset($result['left_add_details']->adds_image)){echo $result['left_add_details']->adds_image;} ?>"> -->
                                        

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Adds Type</label>
                                            <div class="col-sm-10 col-md-7">
                                                <select class="form-control field-validate" name="adds_type" id="left_adds_type">
                                                    <option value="">Select type</option>
                                                    <option value="gAdds" <?php 
                                                    if(isset($result['left_add_details']->adds_type)){
                                                        if($result['left_add_details']->adds_type == "gAdds"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Google Adds</option>
                                                    <option value="Link" <?php 
                                                    if(isset($result['left_add_details']->adds_type)){
                                                        if($result['left_add_details']->adds_type=="Link"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Link</option>
                                                    <!-- <option value="Image" <?php// if(isset($result['left_add_details']->adds_type)){if($result['left_add_details']->adds_type=="Image"){echo "selected";}} ?> >Image</option> -->
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">please select adds type.</span>
                                            </div>
                                        </div>

                                    <div class="left_link_div">
                                        <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Link<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="left_adds_link" name="adds_link" rows="4" cols="50" class="form-control"><?php 
                                                if(isset($result['left_add_details']->adds_link)){
                                                        echo $result['left_add_details']->adds_link;
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter link.</span>
                                                <span class="help-block hidden">Please enter link.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                            <div class="col-sm-10 col-md-4">

                                                <div class="modal fade" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnail" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload image</span>

                                            </div>
                                        </div>

                                        <?php $old_image = isset($result['left_add_details']->adds_image)?$result['left_add_details']->adds_image:''; ?>
                                        {!! Form::hidden('oldImage', $old_image , array('id'=>'oldImage', 'class'=>'')) !!}

                                        <?php if(isset($result['left_add_details']->imgpath)){ ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                              <br>
                                              <img src="<?php if(isset($result['left_add_details']->imgpath)){echo asset($result['left_add_details']->imgpath);} ?>" alt="" width=" 100px">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                        <div class="form-group left_google_adds_div">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Google Adds<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="left_google_adds" name="google_adds" rows="6" cols="50" class="form-control"><?php 
                                                if(isset($result['left_add_details']->google_adds)){
                                                        echo htmlspecialchars_decode($result['left_add_details']->google_adds);
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter google script.</span>
                                                <span class="help-block hidden">Please enter google script.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/categories/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                            </div>
                            <!-- /.box-footer -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- top add -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Top Adds </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                      @if($errors->has('adds_position'))
                                        @if($errors->first('adds_position') == 'top')
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first('message')}}
                                      </div>
                                        @endif
                                      @endif
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/categories/updateAdds', 'method'=>'post', 'class' => 'form-horizontal form-validate2', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('categories_id', $result['categories_id'] , array('class'=>'form-control', 'id'=>'id')) !!}
                                        {!! Form::hidden('adds_position', 'top' , array('class'=>'form-control', 'id'=>'adds_position')) !!}


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Adds Type</label>
                                            <div class="col-sm-10 col-md-7">
                                                <select class="form-control field-validate2" name="adds_type" id="top_adds_type">
                                                    <option value="">Select type</option>
                                                    <option value="gAdds" <?php 
                                                    if(isset($result['top_add_details']->adds_type)){
                                                        if($result['top_add_details']->adds_type == "gAdds"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Google Adds</option>
                                                    <option value="Link" <?php 
                                                    if(isset($result['top_add_details']->adds_type)){
                                                        if($result['top_add_details']->adds_type=="Link"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Link</option>
                                                    
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">please select adds type.</span>
                                            </div>
                                        </div>

                                    <div class="top_link_div">
                                        <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Link<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="top_adds_link" name="adds_link" rows="4" cols="50" class="form-control"><?php 
                                                if(isset($result['top_add_details']->adds_link)){
                                                        echo $result['top_add_details']->adds_link;
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter link.</span>
                                                <span class="help-block hidden">Please enter link.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                            <div class="col-sm-10 col-md-4">

                                                <div class="modal fade" id="Modalmanufactured2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected2" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage2','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured2" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnail2" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close2"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload image</span>

                                            </div>
                                        </div>

                                        <?php $old_image2 = isset($result['top_add_details']->adds_image)?$result['top_add_details']->adds_image:''; ?>
                                        {!! Form::hidden('oldImage', $old_image2 , array('id'=>'oldImage', 'class'=>' ')) !!}

                                        <?php if(isset($result['top_add_details']->imgpath)){ ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                              <br>
                                              <img src="<?php if(isset($result['top_add_details']->imgpath)){echo asset($result['top_add_details']->imgpath);} ?>" alt="" width=" 100px">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                        <div class="form-group top_google_adds_div">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Google Adds<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="top_google_adds" name="google_adds" rows="6" cols="50" class="form-control"><?php 
                                                if(isset($result['top_add_details']->google_adds)){
                                                        echo htmlspecialchars_decode($result['top_add_details']->google_adds);
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter google script.</span>
                                                <span class="help-block hidden">Please enter google script.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/categories/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                            </div>
                            <!-- /.box-footer -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- bottom add -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Bottom Adds </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <br>
                                      @if($errors->has('adds_position'))
                                        @if($errors->first('adds_position') == 'bottom')
                                      <div class="alert alert-success alert-dismissible" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          {{$errors->first('message')}}
                                      </div>
                                        @endif
                                      @endif
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        {!! Form::open(array('url' =>'admin/categories/updateAdds', 'method'=>'post', 'class' => 'form-horizontal form-validate3', 'enctype'=>'multipart/form-data')) !!}

                                        {!! Form::hidden('categories_id', $result['categories_id'] , array('class'=>'form-control', 'id'=>'id')) !!}
                                        {!! Form::hidden('adds_position', 'bottom' , array('class'=>'form-control', 'id'=>'adds_position')) !!}


                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Adds Type</label>
                                            <div class="col-sm-10 col-md-7">
                                                <select class="form-control field-validate3" name="adds_type" id="bottom_adds_type">
                                                    <option value="">Select type</option>
                                                    <option value="gAdds" <?php 
                                                    if(isset($result['bottom_add_details']->adds_type)){
                                                        if($result['bottom_add_details']->adds_type == "gAdds"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Google Adds</option>
                                                    <option value="Link" <?php 
                                                    if(isset($result['bottom_add_details']->adds_type)){
                                                        if($result['bottom_add_details']->adds_type=="Link"){
                                                            echo "selected";
                                                        }
                                                    } ?> >Link</option>
                                                    
                                                </select>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">please select adds type.</span>
                                            </div>
                                        </div>

                                    <div class="bottom_link_div">
                                        <div class="form-group ">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Link<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="bottom_adds_link" name="adds_link" rows="4" cols="50" class="form-control"><?php 
                                                if(isset($result['bottom_add_details']->adds_link)){
                                                        echo $result['bottom_add_details']->adds_link;
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter link.</span>
                                                <span class="help-block hidden">Please enter link.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                            <div class="col-sm-10 col-md-4">

                                                <div class="modal fade" id="Modalmanufactured3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" id="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                            </div>
                                                            <div class="modal-body manufacturer-image-embed">
                                                                @if(isset($allimage))
                                                                <select class="image-picker show-html " name="image_id" id="select_img">
                                                                    <option value=""></option>
                                                                    @foreach($allimage as $key=>$image)
                                                                    <option data-img-src="{{asset($image->path)}}" class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                              <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Image') }}</a>
                                                              <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                              <button type="button" class="btn btn-primary" id="selected3" data-dismiss="modal">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                  {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage3','class'=>"btn btn-primary ", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured3" )) !!}
                                                  <br>
                                                  <div id="selectedthumbnail3" class="selectedthumbnail col-md-5"> </div>
                                                  <div class="closimage">
                                                      <button type="button" class="close pull-left image-close " id="image-close3"
                                                        style="display: none; position: absolute;left: 105px; top: 54px; background-color: black; color: white; opacity: 2.2; " aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Upload image</span>

                                            </div>
                                        </div>

                                        <?php $old_image3 = isset($result['bottom_add_details']->adds_image)?$result['bottom_add_details']->adds_image:''; ?>
                                        {!! Form::hidden('oldImage', $old_image3 , array('id'=>'oldImage', 'class'=>' ')) !!}

                                        <?php if(isset($result['bottom_add_details']->imgpath)){ ?>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 col-md-3 control-label"></label>
                                            <div class="col-sm-10 col-md-4">
                                              <span class="help-block " style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.OldImage') }}</span>
                                              <br>
                                              <img src="<?php if(isset($result['bottom_add_details']->imgpath)){echo asset($result['bottom_add_details']->imgpath);} ?>" alt="" width=" 100px">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                        <div class="form-group bottom_google_adds_div">
                                            <label for="name" class="col-sm-2 col-md-3 control-label">Google Adds<span style="color:red;">*</span></label>
                                            <div class="col-sm-10 col-md-7">
                                                <textarea id="bottom_google_adds" name="google_adds" rows="6" cols="50" class="form-control"><?php 
                                                if(isset($result['bottom_add_details']->google_adds)){
                                                        echo htmlspecialchars_decode($result['bottom_add_details']->google_adds);
                                                } ?></textarea>
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                    Please enter google script.</span>
                                                <span class="help-block hidden">Please enter google script.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                <a href="{{ URL::to('admin/categories/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                            </div>
                            <!-- /.box-footer -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body -->

        <!-- /.box -->

        <!-- /.col -->

        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // left_Divs
        $('.left_google_adds_div').css('display','none');
        $('.left_link_div').css('display','none');
        // $('.image_div').css('display','none');

        $("#left_google_adds").removeClass("field-validate");
        $("#left_adds_link").removeClass("field-validate");
        //$("#newImage").removeClass("field-validate");

        // top_Divs
        $('.top_google_adds_div').css('display','none');
        $('.top_link_div').css('display','none');

        $("#top_google_adds").removeClass("field-validate2");
        $("#top_adds_link").removeClass("field-validate2");

        // bottom_Divs
        $('.bottom_google_adds_div').css('display','none');
        $('.bottom_link_div').css('display','none');

        $("#bottom_google_adds").removeClass("field-validate3");
        $("#bottom_adds_link").removeClass("field-validate3");

        // left_Divs
        <?php if(isset($result['left_add_details']->adds_type)){ ?>
            var adds_type = '<?php echo $result['left_add_details']->adds_type; ?>';
            if(adds_type=='gAdds'){
                $('.left_google_adds_div').css('display','block');
                $('.left_link_div').css('display','none');
                // $('.image_div').css('display','none');

                $("#left_google_adds").addClass("field-validate");
                $("#left_adds_link").removeClass("field-validate");
                //$("#newImage").removeClass("field-validate");
            }else if(adds_type=='Link'){
                $('.left_google_adds_div').css('display','none');
                $('.left_link_div').css('display','block');
                // $('.image_div').css('display','none');

                $("#left_google_adds").removeClass("field-validate");
                $("#left_adds_link").addClass("field-validate");
                //$("#newImage").removeClass("field-validate");
            }
            // else if(adds_type=='Image' && adds_position=='left'){
            //     $('.google_adds_div').css('display','none');
            //     $('.link_div').css('display','none');
            //     // $('.image_div').css('display','block');

            //     $("#google_adds").removeClass("field-validate");
            //     $("#adds_link").removeClass("field-validate");
            //     //$("#newImage").addClass("field-validate");
            // }
            else{
                $('.left_google_adds_div').css('display','none');
                $('.left_link_div').css('display','none');
                // $('.image_div').css('display','none');

                $("#left_google_adds").removeClass("field-validate");
                $("#left_adds_link").removeClass("field-validate");
                // $("#newImage").removeClass("field-validate");
            }
        <?php } ?>


        $("#left_adds_type").change(function(){
            var adds_type = $("#left_adds_type").val();  
            if(adds_type=='gAdds'){
                $('.left_google_adds_div').css('display','block');
                $('.left_link_div').css('display','none');
                // $('.image_div').css('display','none');

                $("#left_google_adds").addClass("field-validate");
                $("#left_adds_link").removeClass("field-validate");
                // $("#newImage").removeClass("field-validate");

                $('#left_adds_link').val("");
                // $('#oldImage').val("");
                // $('#select_img').val("");
            }else if(adds_type=='Link'){
                $('.left_google_adds_div').css('display','none');
                $('.left_link_div').css('display','block');
                // $('.image_div').css('display','none');

                $("#left_google_adds").removeClass("field-validate");
                $("#left_adds_link").addClass("field-validate");
                // $("#newImage").removeClass("field-validate");

                $('#left_google_adds').val("");
                // $('#oldImage').val("");
                // $('#select_img').val("");
            }
            // else if(adds_type=='Image'){
            //     $('.google_adds_div').css('display','none');
            //     $('.link_div').css('display','none');
            //     $('.image_div').css('display','block');

            //     $("#google_adds").removeClass("field-validate");
            //     $("#adds_link").removeClass("field-validate");
            //     $("#newImage").addClass("field-validate");

            //     $('#adds_link').val("");
            //     $('#google_adds').val("");
            // }
            else{
                $('.left_google_adds_div').css('display','none');
                $('.left_link_div').css('display','none');
                // $('.image_div').css('display','none');

                $("#left_google_adds").removeClass("field-validate");
                $("#left_adds_link").removeClass("field-validate");
                // $("#newImage").removeClass("field-validate");

                $('#left_adds_link').val("");
                $('#left_google_adds').val("");
                // $('#oldImage').val("");
                // $('#select_img').val("");
            }
        });

        // top_Divs
        

        <?php if(isset($result['top_add_details']->adds_type)){ ?>
            var adds_type = '<?php echo $result['top_add_details']->adds_type; ?>';
            if(adds_type=='gAdds'){
                $('.top_google_adds_div').css('display','block');
                $('.top_link_div').css('display','none');

                $("#top_google_adds").addClass("field-validate2");
                $("#top_adds_link").removeClass("field-validate2");
            }else if(adds_type=='Link'){
                $('.top_google_adds_div').css('display','none');
                $('.top_link_div').css('display','block');

                $("#top_google_adds").removeClass("field-validate2");
                $("#top_adds_link").addClass("field-validate2");
            }
            else{
                $('.top_google_adds_div').css('display','none');
                $('.top_link_div').css('display','none');

                $("#top_google_adds").removeClass("field-validate2");
                $("#top_adds_link").removeClass("field-validate2");
            }
        <?php } ?>


        $("#top_adds_type").change(function(){
            var adds_type = $("#top_adds_type").val();  
            if(adds_type=='gAdds'){
                $('.top_google_adds_div').css('display','block');
                $('.top_link_div').css('display','none');

                $("#top_google_adds").addClass("field-validate2");
                $("#top_adds_link").removeClass("field-validate2");

                $('#top_adds_link').val("");
            }else if(adds_type=='Link'){
                $('.top_google_adds_div').css('display','none');
                $('.top_link_div').css('display','block');

                $("#top_google_adds").removeClass("field-validate2");
                $("#top_adds_link").addClass("field-validate2");

                $('#top_google_adds').val("");
            }
            else{
                $('.top_google_adds_div').css('display','none');
                $('.top_link_div').css('display','none');

                $("#top_google_adds").removeClass("field-validate2");
                $("#top_adds_link").removeClass("field-validate2");

                $('#top_adds_link').val("");
                $('#top_google_adds').val("");
            }
        });

        // bottom_Divs
        

        <?php if(isset($result['bottom_add_details']->adds_type)){ ?>
            var adds_type = '<?php echo $result['bottom_add_details']->adds_type; ?>';
            if(adds_type=='gAdds'){
                $('.bottom_google_adds_div').css('display','block');
                $('.bottom_link_div').css('display','none');

                $("#bottom_google_adds").addClass("field-validate3");
                $("#bottom_adds_link").removeClass("field-validate3");
            }else if(adds_type=='Link'){
                $('.bottom_google_adds_div').css('display','none');
                $('.bottom_link_div').css('display','block');

                $("#bottom_google_adds").removeClass("field-validate3");
                $("#bottom_adds_link").addClass("field-validate3");
            }
            else{
                $('.bottom_google_adds_div').css('display','none');
                $('.bottom_link_div').css('display','none');

                $("#bottom_google_adds").removeClass("field-validate3");
                $("#bottom_adds_link").removeClass("field-validate3");
            }
        <?php } ?>


        $("#bottom_adds_type").change(function(){
            var adds_type = $("#bottom_adds_type").val();  
            if(adds_type=='gAdds'){
                $('.bottom_google_adds_div').css('display','block');
                $('.bottom_link_div').css('display','none');

                $("#bottom_google_adds").addClass("field-validate3");
                $("#bottom_adds_link").removeClass("field-validate3");

                $('#bottom_adds_link').val("");
            }else if(adds_type=='Link'){
                $('.bottom_google_adds_div').css('display','none');
                $('.bottom_link_div').css('display','block');

                $("#bottom_google_adds").removeClass("field-validate3");
                $("#bottom_adds_link").addClass("field-validate3");

                $('#bottom_google_adds').val("");
            }
            else{
                $('.bottom_google_adds_div').css('display','none');
                $('.bottom_link_div').css('display','none');

                $("#bottom_google_adds").removeClass("field-validate3");
                $("#bottom_adds_link").removeClass("field-validate3");

                $('#bottom_adds_link').val("");
                $('#bottom_google_adds').val("");
            }
        });
    });
</script>

@endsection
