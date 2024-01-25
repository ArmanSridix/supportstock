<?php $__env->startSection('content'); ?>
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
            <h1> <?php echo e(trans('labels.Categories')); ?> <small><?php echo e(trans('labels.ListingAllMainCategories')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.MainCategories')); ?></li>
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
                                <form  name='registration' id="registration" class="registration" method="get" action="<?php echo e(url('admin/categories/filter')); ?>">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                    <div class="input-group-form search-panel ">
                                        <select type="button" class="btn btn-default dropdown-toggle form-control input-group-form " data-toggle="dropdown" name="FilterBy" id="FilterBy" >
                                            <option value="" selected disabled hidden><?php echo e(trans('labels.Filter By')); ?></option>
                                            <option value="Name"  <?php if(isset($name)): ?> <?php if($name == "Name"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>><?php echo e(trans('labels.Name')); ?></option>
                                            <!-- <option value="Main"  <?php if(isset($name)): ?> <?php if($name == "Main"): ?> <?php echo e('selected'); ?> <?php endif; ?> <?php endif; ?>>Main Category</option> -->
                                        </select>
                                        <input type="text" class="form-control input-group-form " name="parameter" placeholder="<?php echo e(trans('labels.Search')); ?>..." id="parameter"  <?php if(isset($param)): ?> value="<?php echo e($param); ?>" <?php endif; ?> >
                                        <button class="btn btn-primary " id="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                        <?php if(isset($param,$name)): ?>  <a class="btn btn-danger " href="<?php echo e(url('admin/categories/display')); ?>"><i class="fa fa-ban" aria-hidden="true"></i> </a><?php endif; ?>
                                    </div>
                                </form>
                                <div class="col-lg-4 form-inline" id="contact-form12"></div>
                            </div>
                            <div class="box-tools pull-right">
                                <a href="<?php echo e(URL::to('admin/categories/add')); ?>" type="button" class="btn btn-block btn-primary"><?php echo e(trans('labels.AddNewCategory')); ?></a>
                            </div>
                            <div class="col-sm-8">
                                <button class="btn btn-primary sort" data-toggle="tooltip" data-placement="bottom" title="Sort" href="" class="badge bg-light-blue"><i class="fa fa-list"></i>&nbsp;&nbsp;Sort Category </button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('categories_id', trans('labels.ID')));?></th>
                                            <th><?php echo e(trans('labels.Name')); ?></th>
                                            
                                            <th><?php echo e(trans('labels.Icon')); ?></th>
                                            <!-- <th><?php echo e(trans('labels.MainCategory')); ?></th> -->
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', trans('labels.AddedLastModifiedDate')));?></th>
                                            <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', trans('labels.Status')));?></th>
                                            <th><?php echo e(trans('labels.Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($categories)>0): ?>
                                            <?php $categoriesunique = $categories->unique('id'); ?>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php if($category->id == -1): ?> 0 <?php else: ?> <?php echo e($category->id); ?> <?php endif; ?></td>
                                                        <td>
                                                            <?php if($category->parent_name): ?>
                                                                <?php echo e($category->parent_name); ?> /
                                                            <?php endif; ?>
                                                            <?php echo e($category->name); ?></td>
                                                        
                                                        <td><img src="<?php echo e(asset($category->iconpath)); ?>" alt="" width=" 100px"></td>
                                                        <td>
                                                            <strong><?php echo e(trans('labels.AddedDate')); ?>: </strong> <?php echo e($category->date_added); ?><br>
                                                            <strong><?php echo e(trans('labels.ModifiedDate')); ?>: </strong><?php echo e($category->last_modified); ?>

                                                        </td>
                                                        <td>
                                                          <?php if($category->categories_status==1): ?>
                                                          <span class="label label-success">
                                                            <?php echo e(trans('labels.Active')); ?>

                                                          </span>
                                                          <?php elseif($category->categories_status==0): ?>
                                                          <span class="label label-danger">
                                                              <?php echo e(trans('labels.InActive')); ?>

                                                          <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="Edit" href="<?php echo e(url('admin/categories/edit/'. $category->id)); ?>" class="badge bg-light-blue"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                            <?php if($category->id > 0 ): ?><a id="delete" category_id="<?php echo e($category->id); ?>" href="#" class="badge bg-red"><i class="fa fa-trash" aria-hidden="true"></i></a><?php endif; ?>

                                                            <a data-toggle="tooltip" data-placement="bottom" title="Manage Adds" href="<?php echo e(url('admin/categories/editAdds/'. $category->id)); ?>" class="badge bg-light-blue">Manage Adds</a>

                                                        </td>
                                                    </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7"><?php echo e(trans('labels.NoRecordFound')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php if($categories != null): ?>
                                      <div class="col-xs-12 text-right">
                                          <?php echo e($categories->links()); ?>

                                      </div>
                                    <?php endif; ?>
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
                            <h4 class="modal-title" id="deleteModalLabel"><?php echo e(trans('labels.Delete')); ?></h4>
                        </div>
                        <?php echo Form::open(array('url' =>'admin/categories/delete', 'name'=>'deleteBanner', 'id'=>'deleteBanner', 'method'=>'post', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

                        <?php echo Form::hidden('action',  'delete', array('class'=>'form-control')); ?>

                        <?php echo Form::hidden('id',  '', array('class'=>'form-control', 'id'=>'category_id')); ?>

                        <div class="modal-body">
                            <p><?php echo e(trans('labels.DeleteText')); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
                            <button type="submit" class="btn btn-primary" id="deleteBanner"><?php echo e(trans('labels.Delete')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

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
                        <?php $__currentLoopData = $categories_sortbyorder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoriesval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="item" draggable="true" data-category-id="<?php echo e($categoriesval->id); ?>"><?php echo e($categoriesval->name); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('labels.Close')); ?></button>
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
                    _token: '<?php echo e(csrf_token()); ?>'
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
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp_7.4\htdocs\suportstock\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>