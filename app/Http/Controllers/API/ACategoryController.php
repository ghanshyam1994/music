<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Item;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ACategoryController extends Controller
{
    public function categories_list(Request $request)
    {
        $categories = [];
        $categoryId = null;
        $categoryName = null;
        if(isset($request->category_id)){
            $categoryId = $request->category_id;
        }
        if(isset($request->category_name))
        {
            $categoryName = $request->category_name;
        }

        if(isset($categoryId) && $categoryId != null) {
            $categories = Category::where('id', $categoryId)->get();
        }elseif (isset($categoryName) && $categoryName != null){
            $categories = Category::where('category_name', 'like', '%' . $categoryName . '%')->get();
        }elseif(isset($categoryId) && isset($categoryName) && $categoryId != null && $categoryName != null){
            $categories = Category::where('id', $categoryId)->where('category_name', 'like', '%' . $categoryName . '%')->get();
        }else{
            $categories = Category::all();
        }

        if(count($categories) > 0)
        {
            foreach ($categories as $category)
            {
                $subcategories = $this->sub_category_list($category->id);
                $category->image_path = url('uploads/category/'.$category->category_image);

                $category->category_item_count = $this->get_category_item_count($category->id,'category');
                $category->sub_category = $subcategories;

            }
        }

        $result['status'] = 'OK';
        $result['message'] = 'categories fetch successfully';
        $result['response'] = $categories;

        return response()->json($result,200);
    }


    public function get_category_item_count($categoryId,$categoryName)
    {
        if(trim($categoryName) != '' && $categoryName == 'category'){

            $itemcount = Item::where('category_id',$categoryId)->count();

            return $itemcount;

        }else{
            $itemcount = Item::where('sub_category_id',$categoryId)->count();

            return $itemcount;
        }
    }


    public function sub_category_list($subcategoryId)
    {
        $subcategories = [];
        $subcategories = SubCategory::where('category_id',$subcategoryId)->get();

        if(isset($subcategories) && count($subcategories) > 0)
        {
            foreach ($subcategories as $subcategory)
            {
                $subcategory->sub_category_item_count = $this->get_category_item_count($subcategory->id,'sub_category');
                $subcategory->image_path = url('uploads/subcategory/'.$subcategory->sub_category_image);
            }
        }

        return $subcategories;
    }
}
