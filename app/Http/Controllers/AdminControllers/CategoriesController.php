<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Core\Languages;
use App\Models\Core\Categories;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use \stdClass;

class CategoriesController extends Controller
{
  public function __construct(Categories $categories, Setting $setting)
  {
      $this->Categories = $categories;
      $this->varseting = new SiteSettingController($setting);
      $this->Setting = $setting;
  }

  public function display(){
    $title = array('pageTitle' => Lang::get("labels.SubCategories"));
    $categories = $this->Categories->paginator();

    $categories_sortbyorder = Categories::
           leftJoin('categories_description','categories_description.categories_id', '=', 'categories.categories_id')
           ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })

            ->LeftJoin('categories_description as parent_description', function ($join) {
                $join->on('parent_description.categories_id', '=', 'categories.parent_id')
                    ->where(function ($query) {
                        $query->where('parent_description.language_id', '=', 1)->limit(1);
                    });
            })
            ->select('categories.categories_id as id', 'categories.categories_image as image',
            'categories.categories_icon as icon',  'categories.created_at as date_added',
            'categories.updated_at as last_modified', 'categories_description.categories_name as name',
            'categories_description.language_id','categoryTable.path as imgpath','iconTable.path as iconpath', 
            'categories.categories_status  as categories_status', 'parent_description.categories_name as parent_name','categories.sort_order')
         
            ->where('categories_description.language_id', '1')
            ->where('categories.parent_id','=', '0')
            ->where('categories.categories_id','>', '0')
            ->orderBy('categories.sort_order', 'asc')
            // ->groupby('categories.sort_order')
            ->paginate(50);
    // dd($categories_sortbyorder);

    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.categories.index",$title)->with(['categories'=> $categories, 'categories_sortbyorder' => $categories_sortbyorder])->with('result', $result);
  }


  public function filter(Request $request){
    $title = array('pageTitle' => Lang::get("labels.SubCategories"));
    $categories = $this->Categories->filter($request);
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.categories.index", $title)->with('result', $result)->with(['categories'=> $categories, 'name'=> $request->FilterBy, 'param'=> $request->parameter]);
  }

  public function add(Request $request){
    $title = array('pageTitle' => Lang::get("labels.AddSubCategories"));

    $images = new Images;
    $allimage = $images->getimages();

    $result = array();
    $result['message'] = array();
    //get function from other controller
    $result['languages'] = $this->varseting->getLanguages();
    $categories = $this->Categories->recursivecategories();

    $parent_id = 0;
    $option = '<option value="0">'. Lang::get("labels.Leave As Parent").'</option>';

      foreach($categories as $parents){
        if($parents->categories_id > 0){
        $option .= '<option value="'.$parents->categories_id.'">'.$parents->categories_name.'</option>';

          if(isset($parents->childs)){
            $i = 1;
            $option .= $this->childcat($parents->childs, $i, $parent_id);
          }
        }
      }

    $result['categories'] = $option;
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.categories.add",$title)->with('result', $result)->with('allimage', $allimage);
  }

  public function childcat($childs, $i, $parent_id){
    $contents = '';
    foreach($childs as $key => $child){
      $dash = '';
      for($j=1; $j<=$i; $j++){
          $dash .=  '-';
      }
      //print(" <i>   ".$i." chgild");  echo '<pre>'.print_r($childs, true).'</pre>';
      if($child->categories_id==$parent_id){
        $selected = 'selected';
      }else{
        $selected = '';
      }

      $contents.='<option value="'.$child->categories_id.'" '.$selected.'>'.$dash.$child->categories_name.'</option>';
      if(isset($child->childs)){

        $k = $i+1;
        $contents.= $this->childcat($child->childs,$k,$parent_id);
      }
      elseif($i>0){
        $i=1;
      }

    }
    return $contents;
  }

  public function insert(Request $request){

        $date_added	= date('y-m-d h:i:s');
        $result = array();

        //get function from other controller
        $languages = $this->varseting->getLanguages();

        $categoryName = $request->categoryName;
        $parent_id = $request->parent_id;

        $uploadImage = $request->image_id;
        $uploadIcon  = $request->image_icone;
        $categories_status  = $request->categories_status;

        $categories_id = $this->Categories->insert($uploadImage,$date_added,$parent_id,$uploadIcon,$categories_status);
        $slug_flag = false;

        //multiple lanugauge with record
        foreach($languages as $languages_data){
            $categoryName= 'categoryName_'.$languages_data->languages_id;
            //slug
            if($slug_flag==false){
                $slug_flag=true;
                $slug = $request->$categoryName;
                $old_slug = $request->$categoryName;
                $slug_count = 0;
                do{
                    if($slug_count==0){
                        $currentSlug = $this->varseting->slugify($old_slug);
                    }else{
                        $currentSlug = $this->varseting->slugify($old_slug.'-'.$slug_count);
                    }
                    $slug = $currentSlug;
                    $checkSlug = $this->Categories->checkSlug($currentSlug);
                    $slug_count++;
                }
                  while(count($checkSlug)>0);
                  $updateSlug = $this->Categories->updateSlug($categories_id,$slug);
                }
            $categoryNameSub = $request->$categoryName;
            $languages_data_id = $languages_data->languages_id;
            $subcatoger_des = $this->Categories->insertcategorydescription($categoryNameSub,$categories_id,$languages_data_id);
        }

        $categories =  $this->Categories->subcategorydes();
        $result['categories'] = $categories;
        $message = Lang::get("labels.AddCategoryMessage");
        return redirect()->back()->withErrors([$message]);
  }

  public function edit(Request $request){
    $title = array('pageTitle' => Lang::get("labels.EditCategories"));
    $images = new Images;
    $allimage = $images->getimages();

    $result = array();
    $result['message'] = array();

    //get function from other controller
    $result['languages'] = $this->varseting->getLanguages();
    $editSubCategory = $this->Categories->editsubcategory($request);

    $description_data = array();
    foreach($result['languages'] as $languages_data){
        $languages_id = $languages_data->languages_id;
        $id = $request->id;
        $description = $this->Categories->editdescription($languages_id,$id);
        if(count($description)>0){
            $description_data[$languages_data->languages_id]['name'] = $description[0]->categories_name;
            $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
            $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
        }else{
            $description_data[$languages_data->languages_id]['name'] = '';
            $description_data[$languages_data->languages_id]['language_name'] = $languages_data->name;
            $description_data[$languages_data->languages_id]['languages_id'] = $languages_data->languages_id;
        }
    }

    $result['description'] = $description_data;
    $result['editSubCategory'] = $editSubCategory;

    $categories = $this->Categories->editrecursivecategories($request);
  //  dd($editSubCategory[0]->parent_id);
    $parent_id = $editSubCategory[0]->parent_id;
    $option = '<option value="0">'. Lang::get("labels.Leave As Parent").'</option>';
    foreach($categories as $parents){
      $selected = '';
      if(isset($parents->categories_id)){
        if($parents->categories_id > 0){
          if($parents->categories_id==$parent_id){
            $selected = 'selected';
          }

          $option .= '<option value="'.$parents->categories_id.'"  '.$selected.' >'.$parents->categories_name.'</option>';
          $i = 1;
          if(isset($parents->childs)){
            $option .= $this->childcat($parents->childs, $i, $parent_id);
          }
        }
      }
    }

    $result['categories'] = $option;
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.categories.edit",$title)->with('result', $result)->with('allimage', $allimage);
   }

   public function update(Request $request){

     $title = array('pageTitle' => Lang::get("labels.EditSubCategories"));
     $result = array();
     $result['message'] = Lang::get("labels.Category has been updated successfully");
     $last_modified 	=   date('y-m-d h:i:s');
     $parent_id = $request->parent_id;
     $categories_id = $request->id;
     $categories_status  = $request->categories_status;

     //get function from other controller
     $languages = $this->varseting->getLanguages();
     $extensions = $this->varseting->imageType();

     //check slug
     if($request->old_slug!=$request->slug){
         $slug = $request->slug;
         $slug_count = 0;
         do{
             if($slug_count==0){
                 $currentSlug = $this->varseting->slugify($request->slug);
             }else{
                 $currentSlug = $this->varseting->slugify($request->slug.'-'.$slug_count);
             }
             $slug = $currentSlug;
             $checkSlug = DB::table('categories')->where('categories_slug',$currentSlug)->where('categories_id','!=',$request->id)->get();
             $slug_count++;
         }
         while(count($checkSlug)>0);
     }else{
         $slug = $request->slug;
     }
     if($request->image_id!==null){
         $uploadImage = $request->image_id;
     }else{
         $uploadImage = $request->oldImage;
     }

     if($request->image_icone !==null){
         $uploadIcon = $request->image_icone;
     }	else{
         $uploadIcon = $request->oldIcon;
     }


     $updateCategory = $this->Categories->updaterecord($categories_id,$uploadImage,$uploadIcon,$last_modified,$parent_id,$slug,$categories_status);

     foreach($languages as $languages_data){
       $categories_name = 'category_name_'.$languages_data->languages_id;
       $checkExist = $this->Categories->checkExit($categories_id,$languages_data);
         $categories_name = $request->$categories_name;
         if(count($checkExist)>0){
           $category_des_update = $this->Categories->updatedescription($categories_name,$languages_data,$categories_id);
       }else{
           $updat_des = $this->Categories->insertcategorydescription($categories_name,$categories_id, $languages_data->languages_id);
       }
     }

     $message = Lang::get("labels.CategorieUpdateMessage");
     return redirect()->back()->withErrors([$message]);
    }

    public function delete(Request $request){
      $deletecategory = $this->Categories->deleterecord($request);
      $message = Lang::get("labels.CategoriesDeleteMessage");
      return redirect()->back()->withErrors([$message]);
    }


    public function editAdds(Request $request){
      $title = array('pageTitle' => "Manage Adds");
      $images = new Images;
      $allimage = $images->getimages();
      
      $result = array();
      $result['message'] = array();
      $result['left_add_details'] = new \stdClass();
      $result['top_add_details'] = new \stdClass();
      $result['bottom_add_details'] = new \stdClass();
      $categories_id = $request->id;
      $result['categories_id'] = $categories_id;

      $adds_details = DB::table('categories_adds')
          ->LeftJoin('image_categories', function ($join) {
              $join->on('image_categories.image_id', '=', 'categories_adds.adds_image')
                ->where(function ($query) {
                    $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                        ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                        ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                });
          })
          ->select('categories_adds.*', 'image_categories.path as imgpath') 
          //->select('categories_adds.*')
          ->groupBy('categories_adds.categories_adds_id')
          ->where('categories_adds.categories_id','=', $categories_id)
          ->get();

        // echo "<pre>";
        // print_r($adds_details);exit;

        if(count($adds_details)>0){
            foreach ($adds_details as $key=>$value) {
                if($value->adds_position == 'left'){
                  $result['left_add_details'] = $adds_details[$key];
                }else if($value->adds_position == 'top'){
                  $result['top_add_details'] = $adds_details[$key];
                }else if($value->adds_position == 'bottom'){
                  $result['bottom_add_details'] = $adds_details[$key];
                }
              }
        }
      // $result['adds_details'] = $adds_details;
      // echo "<pre>";print_r($result['left_add_details']);print_r($result['top_add_details']);print_r($result['bottom_add_details']);exit;
      $result['commonContent'] = $this->Setting->commonContent();
      return view("admin.categories.adds_edit",$title)->with('result', $result)->with('allimage', $allimage);
    }


    public function updateAdds(Request $request){

      $result = array();
      $last_modified = date('Y-m-d H:i:s');
      $adds_position = $request->adds_position;
      $categories_id = $request->categories_id;
      $categories_status = $request->categories_status;

      if($request->image_id!==null){
         $uploadImage = $request->image_id;
      }else{
         $uploadImage = $request->oldImage;
      }

      if ($request->google_adds!='') {
        $google_adds = htmlentities($request->google_adds);
      }else{
        $google_adds = '';
      }

      $adds_details = DB::table('categories_adds')
        ->where('categories_adds.categories_id','=', $categories_id)
        ->where('categories_adds.adds_position','=', $adds_position)
        ->get();
      if (count($adds_details)>0) {
        DB::table('categories_adds')->where('categories_id', $categories_id)->where('categories_adds.adds_position','=', $adds_position)->update(
        [
            'adds_type' => $request->adds_type,
            'adds_image' => $uploadImage,
            'adds_link' => $request->adds_link,
            'google_adds' => $google_adds,
            'updated_at' => $last_modified
        ]);
      }else{
        DB::table('categories_adds')->insertGetId([
            'categories_id' => $categories_id,
            'adds_position' => $adds_position,
            'adds_type' => $request->adds_type,
            'adds_image' => $uploadImage,
            'adds_link' => $request->adds_link,
            'google_adds' => $google_adds,
            'created_at' => $last_modified
        ]);
      }

      $message = "Category adds has been updated successfully";
      return redirect()->back()->withErrors(['message'=>$message, 'adds_position'=>$adds_position]);
    }

    public function updateSortOrder(Request $request)
    {
        // $requestData = json_decode($request->getContent(), true);
        $sortedIds = $request->input('sortedIds');
        // dd($sortedIds);
        foreach ($sortedIds as $index => $categoryId) {
            // Update the database table with the new sort order
            Categories::where('categories_id', $categoryId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['message' => 'Sort order updated successfully']);
    }


}
