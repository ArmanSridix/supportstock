@extends('admin.layout')
@section('content')
<style>
.item {
/*  width:250px;*/
  height:40px;
  border:1px solid #DDD;
  font-size:20px;
  line-height:40px;
  text-align:center;
  color:#333;
  cursor:pointer;
  position:relative;
  transition:all .3s;
  user-select: none;
}

.item.onDrag {
  /*transform: scale(1.05, 1.1);*/
  opacity:1;
  background-color:#F5F5F5;
  box-shadow:0 0 5px rgba(0,0,0,.1);
}

.item::before {
  content:"";
  position:absolute;
  width:15px;
  height:15px;
  top:50%;
  right:10px;
  transform:translateY(-50%);
  background-size:120% 120%;
  background-position:center center;
}

.item:last-child {
  height:20px;
}

.item:last-child::before {
  border:none;
  height:0;
}

.itemClip {
  position: absolute;
  background-color:white;
  opacity:1;
  top:0;
  left:0;
  transform:translate(-50%, -50%);
  transition:none;
  background-color:white;
}

.hide {
  display:none;
}

</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Categories') }} <small>{{ trans('labels.ListingAllMainCategories') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li class="active">{{ trans('labels.MainCategories') }}</li>
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
                            <div class="col-lg-4 form-inline">
                                <form  name='registration' id="registration" class="registration" method="get" action="{{url('admin/categories/filter')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden>{{trans('labels.Filter By')}}</option>
                                            <option value="Name"  @if(isset($name)) @if  ($name == "Name") {{ 'selected' }} @endif @endif>{{trans('labels.Name')}}</option>
                                            <!-- <option value="Main"  @if(isset($name)) @if  ($name == "Main") {{ 'selected' }} @endif @endif>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="{{trans('labels.Search')}}..." id="parameter"  @if(isset($param)) value="{{$param}}" @endif >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        @if(isset($param,$name))  <a class="btn btn-danger " href="{{url('admin/categories/display')}}"><i class="fa fa-ban" aria-hidden="true"></i> </a>@endif
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="{{ URL::to('admin/categories/add')}}" type="button" class="btn btn-block btn-primary">{{ trans('labels.AddNewCategory') }}</a>
                            </div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary sort" data-toggle="tooltip" data-placement="bottom" title="Sort" href="" class="badge bg-light-blue"><i class="fa fa-list"></i>&nbsp;&nbsp;Sort Category </button>
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
                                            <th>@sortablelink('categories_id', trans('labels.ID') )</th>
                                            <th>{{ trans('labels.Name') }}</th>
                                            {{--<th>{{ trans('labels.Image') }}</th>--}}
                                            <th>{{ trans('labels.Icon') }}</th>
                                            <!-- <th>{{trans('labels.MainCategory')}}</th> -->
                                            <th>@sortablelink('created_at', trans('labels.AddedLastModifiedDate') )</th>
                                            <th>@sortablelink('status', trans('labels.Status'))</th>
                                            <th>{{ trans('labels.Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($categories)>0)
                                            @php $categoriesunique = $categories->unique('id'); @endphp
                                            @foreach ($categories as $key=>$category)
                                                    <tr>
                                                        <td>@if($category->id == -1) 0 @else {{ $category->id }} @endif</td>
                                                        <td>
                                                            @if($category->parent_name)
                                                                {{$category->parent_name}} /
                                                            @endif
                                                            {{ $category->name }}</td>
                                                        {{--<td><img src="{{asset($category->imgpath)}}" alt="" width=" 100px"></td>--}}
                                                        <td><img src="{{asset($category->iconpath)}}" alt="" width=" 100px"></td>
                                                        <td>
                                                            <strong>{{ trans('labels.AddedDate') }}: </strong> {{ $category->date_added }}<br>
                                                            <strong>{{ trans('labels.ModifiedDate') }}: </strong>{{ $category->last_modified }}
                                                        </td>
                                                        <td>
                                                          @if($category->categories_status==1)
                                                          <span class="label label-success">
                                                            {{ trans('labels.Active') }}
                                                          </span>
                                                          @elseif($category->categories_status==0)
                                                          <span class="label label-danger">
                                                              {{ trans('labels.InActive') }}
                                                          @endif
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="{{url('admin/categories/edit/'. $category->id) }}" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            @if($category->id >0 )<a id="delete" category_id="{{$category->id}}" href="#" class="badge bg-red " ><i class="fa fa-trash" aria-hidden="true"></i></a>@endif

                                                            <a data-toggle="tooltip" data-placement="bottom" title="Manage Adds" href="{{url('admin/categories/editAdds/'. $category->id) }}" class="badge bg-light-blue">Manage Adds</a>

                                                        </td>
                                                    </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ trans('labels.NoRecordFound') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($categories != null)
                                      <div class="col-xs-12 text-right">
                                          {{$categories->links()}}
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

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="deleteModalLabel">{{ trans('labels.Delete') }}</h4>
                        </div>
                        {!! Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')) !!}
                        {!! Form::hidden('action',  'delete', array('class'=>'form-control')) !!}
                        {!! Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')) !!}
                        <div class="modal-body">
                            <p>{{ trans('labels.DeleteText') }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner">{{ trans('labels.Delete') }}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <div class="modal fade" id="sortModal" tabindex="-1" role="dialog" aria-labelledby="sortModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="sortModalLabel">Sort Orderby</h4>
                        </div>
                        <div id="boxess" class="boxess">
                        @foreach($categories_sortbyorder as $categoriesval)
                          <div class="item" draggable="true" data-category-id="{{ $categoriesval->id }}">{{$categoriesval->name}}</div>
                        @endforeach 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.Close') }}</button>
                            <button type="submit" class="btn btn-primary" id="Save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
<script>
        document.addEventListener("DOMContentLoaded", function() {
        var dragItem = null;
        var boxess = document.getElementById("boxess");

        boxess.addEventListener("dragstart", function(event) {
            dragItem = event.target;
            event.dataTransfer.setData("text/plain", dragItem.dataset.categoryId);
        });

        boxess.addEventListener("dragover", function(event) {
            event.preventDefault();
        });

        boxess.addEventListener("drop", function(event) {
            event.preventDefault();
            var categoryId = event.dataTransfer.getData("text/plain");
            var targetItem = event.target.closest(".item");

            if (targetItem && targetItem !== dragItem) {
                var temp = targetItem.innerHTML;
                targetItem.innerHTML = dragItem.innerHTML;
                dragItem.innerHTML = temp;
            }

            dragItem = null;
        });

        // Event listener for the "Save" button click
        var saveButton = document.getElementById("Save");
        saveButton.addEventListener("click", function() {
            var sortedIds = Array.from(boxess.querySelectorAll('.item')).map(function(item) {
                return item.dataset.categoryId;
            });

            // Send an AJAX request to update sort order
            $.ajax({
                url: 'updateSortOrder',
                type: 'POST',
                data: {
                    sortedIds: sortedIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // Handle success response
                    data.message;
                    console.log(data.message);
                    window.location.reload();
                },
                error: function(error) {
                    // Handle error response
                    console.error(error.responseText);
                }
            });
        });
    });
    </script>
    <script>

        $(document).on('click','.sort', function(e){
            $('#sortModal').modal();
            
            var elements = document.querySelectorAll('.boxess .item');
            var targetEl;
            var wrapper = document.getElementById("boxess");
            var itemClip = document.getElementById("itemClip");

            var scopeObj;

            // === Event Binding ===
            for (var i = 0, max = elements.length; i < max; i++) {
              elements[i].addEventListener("dragstart", handleDrag);
              elements[i].addEventListener("dragend", handleDragEnd);
              elements[i].addEventListener("dragenter", handleDragEnter);
              
              elements[i].addEventListener("touchstart", handleTouch);
              elements[i].addEventListener("touchend", handleTouchEnd);
              elements[i].addEventListener("touchmove", handleTouchMove);
            }

            // === Function Kits ===
            function handleDrag(event) {
              targetEl = event.target;
              targetEl.classList.add("onDrag");
            }

            function handleDragEnd(event) {
              targetEl.classList.remove("onDrag");
            }

            function handleDragEnter(event) {
              wrapper.insertBefore(targetEl, event.target);
            }

            function handleTouch(event) {
              defineScope(elements);
              targetEl = event.target;
              itemClip.style.top = event.changedTouches[0].clientY + "px";
              itemClip.style.left = event.changedTouches[0].clientX + "px";
              itemClip.innerText = event.target.innerText;
              itemClip.classList.remove("hide");
              targetEl.classList.add("onDrag");
            }

            function handleTouchEnd(event) {
              itemClip.classList.add("hide");
              targetEl.classList.remove("onDrag");
            }

            function handleTouchMove(event) {
              itemClip.style.top = event.changedTouches[0].clientY + "px";
              itemClip.style.left = event.changedTouches[0].clientX + "px";
              hitTest(event.changedTouches[0].clientX, event.changedTouches[0].clientY);
            }

            function hitTest(thisX, thisY) {
              for (var i = 0, max = scopeObj.length; i < max; i++) {
                if (thisX > scopeObj[i].startX && thisX < scopeObj[i].endX) {
                  if (thisY > scopeObj[i].startY && thisY < scopeObj[i].endY) {
                    wrapper.insertBefore(targetEl, scopeObj[i].target);
                    return;
                  }
                }
              }
            }

            function defineScope(elementArray) {
              scopeObj = [];
              for (var i = 0, max = elementArray.length; i < max; i++) {
                var newObj = {};
                newObj.target = elementArray[i];
                newObj.startX = elementArray[i].offsetLeft;
                newObj.endX = elementArray[i].offsetLeft + elementArray[i].offsetWidth;
                newObj.startY = elementArray[i].offsetTop;
                newObj.endY = elementArray[i].offsetTop + elementArray[i].offsetHeight;
                scopeObj.push(newObj);
              }
            }
        });
    </script>
@endsection
