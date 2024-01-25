<?php
namespace App\Http\Controllers\AdminControllers;

use App;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\ConstantBanner;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Products;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Lang;
use DB;

class AdminConstantController extends Controller
{
    public function __construct(Setting $setting, Languages $languages, Categories $category)
    {
        $this->Setting = $setting;
        $this->Languages = $languages;
        $this->category = $category;
    }
    //constantBanners
    public function constantBanners(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ListingConstantBanners"));
        $result = ConstantBanner::paginator($request);
        $result['commonContent'] = $this->Setting->commonContent();
        $result['languages'] = $this->Languages->getter();
        if($request->bannerType){
            $bannerType = $request->bannerType;    
        }else{
            $bannerType = '';
        }
        
        return view("admin.settings.web.banners.index", $title)->with(['result' => $result, 'bannerType'=>$bannerType]);
    }

    public function addconstantbanner(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddConstantBanner"));

        $result = array();
        $message = array();

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['message'] = $message;
        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.banners.add", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function addNewConstantBanner(Request $request)
    {
        //check exist banner
        $exist = ConstantBanner::existbanner($request);

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {

            //add banner
            $insert = ConstantBanner::insert($request);

            return redirect()->back()->with('success', Lang::get("labels.BannerAddedMessage"));
        }

    }

    public function editconstantbanner(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));
        $result = array();
        $result['message'] = array();

        $banners = ConstantBanner::edit($request);
        $result['banners'] = $banners;

        //get function from other controller
        $myVar = new Categories();
        $categories = $myVar->getter(1);

        $images = new Images();
        $allimage = $images->getimages();

        $myVar = new Products();
        $products = $myVar->getter();
        //get function from other controller
        $myVar = new Languages();
        $result['languages'] = $myVar->getter();

        $result['categories'] = $categories;
        $result['products'] = $products;
        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin.settings.web.banners.edit", $title)->with(['result' => $result, 'allimage' => $allimage]);
    }

    public function updateconstantBanner(Request $request)
    {
        $exist = ConstantBanner::existbannerforupdate($request);
        $title = array('pageTitle' => Lang::get("labels.EditBanner"));

        if ($exist == 1) {
            return redirect()->back()->with('error', Lang::get("labels.constantBannerErrorMessage"));
        } else {
            $exist = ConstantBanner::updatebanner($request);
            return redirect()->back()->with('success', Lang::get("labels.BannerUpdatedMessage"));
        }
    }

    public function deleteconstantBanner(Request $request)
    {
        ConstantBanner::deletebanners($request);
        return redirect()->back()->withErrors([Lang::get("labels.BannerDeletedMessage")]);

    }


    /************** front category ****************/
    public function frontCategory(Request $request){

        $catDetails = DB::table('front_category')->where('front_category_id','=', 1)->first();
        $categories_ids = $catDetails->categories_ids;
        $categories_ids_array = explode(",",$categories_ids);

        $categories = $this->category->recursivecategories($request);

        $parent_id = $categories_ids_array;
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
            <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class=" required_one categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
          ' . $parents->categories_name . '
          </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
          <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }
        $option .= '</ul>';

        $result['categories'] = $option;

        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin/categories/front_category")->with('result', $result);
    }

    public function childcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            if (in_array($child->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $contents .= '<label> <input id="categories_' . $child->categories_id . '" parents_id="' . $child->parent_id . '"  type="checkbox" name="categories[]" class="required_one sub_categories categories sub_categories_' . $child->parent_id . '" value="' . $child->categories_id . '" ' . $checked . '> ' . $child->categories_name . '</label>';

            if (isset($child->childs)) {
                $contents .= '<ul class="list-group">
        <li class="list-group-item">';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</li></ul>";
            }

        }
        return $contents;
    }

    public function updateFrontCategory(Request $request){
        $categories_ids = implode(",",$request->categories);
        $cat_update = DB::table('front_category')->where('front_category_id','=',1)
            ->update([
                'categories_ids'  =>  $categories_ids
            ]);

        $message = "Category has updated successfully.";
        return redirect()->back()->withErrors([$message]);

    }
    /************** front category ****************/

    /************** front product category ****************/
    public function frontProductCategory(Request $request){

        $catDetails = DB::table('front_category')->where('front_category_id','=', 2)->first();
        $categories_ids = $catDetails->categories_ids;
        $categories_ids_array = explode(",",$categories_ids);

        $categories = $this->category->recursivecategories($request);

        $parent_id = $categories_ids_array;
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
            <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox" class=" required_one categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
          ' . $parents->categories_name . '
          </label></li>';

          //   if (isset($parents->childs)) {
          //       $option .= '<ul class="list-group">
          // <li class="list-group-item">';
          //       $option .= $this->childcat($parents->childs, $parent_id);
          //       $option .= '</li></ul>';
          //   }
        }
        $option .= '</ul>';

        $result['categories'] = $option;

        $result['commonContent'] = $this->Setting->commonContent();

        return view("admin/categories/front_product_category")->with('result', $result);
    }

    public function updateFrontProductCategory(Request $request){
        $categories_ids = implode(",",$request->categories);
        $cat_update = DB::table('front_category')->where('front_category_id','=',2)
            ->update([
                'categories_ids'  =>  $categories_ids
            ]);

        $message = "Category has updated successfully.";
        return redirect()->back()->withErrors([$message]);

    }
    /************** front product category ****************/


}
