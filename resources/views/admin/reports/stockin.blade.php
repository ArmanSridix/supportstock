{{--@extends('admin.layout')
@section('content')
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> {{ trans('labels.stockin') }} <small>{{ trans('labels.stockin') }}...</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">{{ trans('labels.stockin') }}</li>
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
            <h3 class="box-title">{{ trans('labels.ProductName') }} : {{ $result['products'][0]->products_name }} @if(!empty($result['products'][0]->products_model)) ( {{ $result['products'][0]->products_model }} )@endif</h3>
          </div>          
          <!-- /.box-header -->
          <div class="box-body">
            
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>{{ trans('labels.AddedBy') }}</th>
                      <th>{{ trans('labels.AddedDate') }}</th>
                      <th>{{ trans('labels.Stock') }}</th>
                      <th>{{ trans('labels.Reference / Purchase Code') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($result['products']['history']) and count($result['products']['history']) > 0)
                    @foreach ($result['products']['history'] as  $key=>$history)
                        
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $history->first_name }} {{ $history->last_name }}</td>
                            <td>{{ $history->added_date }}</td>
                            <td>
                                {{ $history->stock }}
                            </td>
                            <td>
                            @if(!empty($history->reference_code))
                                {{ $history->reference_code }}
                            @else
                            	---
                            @endif
                            </td>                           
                        </tr>
                     @endforeach
                     @else
                     <tr><td>{{ trans('labels.Stock is not added yet') }}</td></tr>
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
    
    <!-- Main row --> 
    
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
@endsection--}}


@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Products Stockin<small>Products Stockin</small> </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
      <li class="active">Products Stockin</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Products Stockin </h3>

            <div class="box-tools pull-right">
              <form action="{{ URL::to('admin/stockinprint')}}" target="_blank">
                <input type="hidden" name="page" value="invioce">
                <button type='submit' class="btn btn-default pull-right"><i class="fa fa-print"></i> {{ trans('labels.Print') }}</button>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ trans('labels.ProductID') }}</th>
                      <th>{{ trans('labels.ProductName') }}</th>
                      <th>Product Type</th>
                      <th>Attribute</th>
                      <th>{{ trans('labels.Current Stock') }}</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                   <tbody>
                    @foreach ($result['reports'] as  $key=>$report)                   
                      <tr>
                          <td>{{ $report->products_id }}</td>  
                          <td>{{ $report->products_name }}</td> 
                          <td>
                            <?php 
                              if($report->products_type==1){ 
                                echo "Variable";
                              }else{ 
                                echo "Simple";
                              } 
                            ?>
                          </td>
                          <td>
                            <?php if($report->products_type==1 && count($report->productAttributeDetails)>0){
                              $productAttributeDetails = $report->productAttributeDetails; ?>
                              <ul>
                                <?php foreach ($productAttributeDetails as $key => $value) { ?>
                                  <li>{{$value->options_name}} : {{$value->options_values}}</li>
                                <?php } ?>
                              </ul>
                            <?php }else{ echo "N/A"; } ?>
                          </td>   
                          {{--<td>0</td>--}}    
                          <td>
                          <a data-toggle="tooltip" target="_blank" data-placement="bottom" title="{{ trans('labels.View') }}" href="{{url('admin/inventoryreport?type=all&products_id='.$report->products_id.'&value='.$report->productAttribute)}}" class="badge bg-light-blue"><i class="fa fa-eye" aria-hidden="true"></i></a>                                                                 
                          </td>                                                                    
                      </tr>
                    @endforeach
                    
                    
                  </tbody>
                </table>
                <div class="col-xs-12" style="background: #eee;">

                  @php
                    if($result['reports']->total()>0){
                      $fromrecord = ($result['reports']->currentpage()-1)*$result['reports']->perpage()+1;
                    }else{
                      $fromrecord = 0;
                    }
                    if($result['reports']->total() < $result['reports']->currentpage()*$result['reports']->perpage()){
                      $torecord = $result['reports']->total();
                    }else{
                      $torecord = $result['reports']->currentpage()*$result['reports']->perpage();
                    }

                  @endphp
                  <div class="col-xs-12 col-md-6" style="padding:30px 15px; border-radius:5px;">
                    <div>Showing {{$fromrecord}} to {{$torecord }}
                        of  {{ $result['reports']->total() }} entries
                    </div>
                  </div>
                <div class="col-xs-12 col-md-6 text-right">
                    {{ $result['reports']->appends(\Request::except('type'))->render() }}
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