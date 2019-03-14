<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }


    public function manage_category()
    {
        if(isset($_GET['category_name']) && $_GET['category_name']){
            $categories = Category::where('category_name', 'like', '%' . $_GET['category_name'] . '%')->paginate(15);
        }else {
            $categories = Category::paginate(15);
        }

        return view('admin.categories.index',['categories' => $categories]);
    }

    public function add()
    {
        return view('admin.categories.add');
    }

    public function store_category(Request $request)
    {
        $this->validate($request,[
            'category_name' => 'required',
            'category_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        if($request->hasFile('category_image')){

            $file = $request->file('category_image');

            $fileName = $file->getClientOriginalName();
            //Display File Extension
            $extension = $file->getClientOriginalExtension();
            //Display File Real Path
            $realpath = $file->getRealPath();
            //Display File Size
            $fileSize = $file->getSize();
            //Display File Mime Type
            $fileMime = $file->getMimeType();

            $namefile = time() .'.'. $extension;

            //Move Uploaded File
            $destinationPath = base_path('public/uploads/category/');
            $file->move($destinationPath,$namefile);
        }

        $store = Category::create([
            'category_name' => $request->category_name,
            'is_sub_category' => 'yes',
            'category_image' => $namefile,
        ]);

        return redirect()->route('categories')->with('success','Category add successfully');

    }


    public function category_edit($categoryId){

        $category = Category::where('id',$categoryId)->first();

        return view('admin.categories.edit',['category' => $category,'categoryid' => $categoryId]);
    }

    public function category_update(Request $request,$categoryId)
    {
        $this->validate($request,[
            'category_name' => 'required',
            'category_image'  => 'mimes:png,jpg,jpeg'
        ]);

        if($request->hasFile('category_image')){

            $file = $request->file('category_image');

            $fileName = $file->getClientOriginalName();
            //Display File Extension
            $extension = $file->getClientOriginalExtension();
            //Display File Real Path
            $realpath = $file->getRealPath();
            //Display File Size
            $fileSize = $file->getSize();
            //Display File Mime Type
            $fileMime = $file->getMimeType();

            $namefile = time() .'.'. $extension;

            //Move Uploaded File
            $destinationPath = base_path('public/uploads/category/');
            $file->move($destinationPath,$namefile);
        }

        if(isset($categoryId) && isset($namefile)) {
            $category = Category::where('id', $categoryId)->update([
                'category_name' => $request->category_name,
                'is_sub_category' => 'yes',
                'category_image' => $namefile,
            ]);

            return redirect()->route('categories')->with('success','Category has been updated');
        }else{

            $category = Category::where('id', $categoryId)->update([
                'category_name' => $request->category_name,
                'is_sub_category' => 'yes',
            ]);

            return redirect()->route('categories')->with('success','Category has been updated');

        }
    }


    public function delete_category($categoryId)
    {
        $delete = Category::where('id',$categoryId)->delete();


        return redirect()->route('categories')->with('success','Category delete successfully');

    }


    public function manage_subcategory()
    {
        $subcategories = SubCategory::select('sub_categories.*');
        if(isset($_GET['category_name']) && $_GET['category_name']){
            $mycategoryID = Category::select('id')->where('category_name', 'like', '%' . $_GET['category_name'] . '%')->get();
            $subcategories = $subcategories->whereIn('category_id',$mycategoryID);
        }elseif (isset($_GET['sub_category_name']) && $_GET['sub_category_name']){
            $subcategories = $subcategories->where('sub_category_name', 'like', '%' . $_GET['sub_category_name'] . '%');
        }
        $subcategories = $subcategories->paginate(15);

        $categories = Category::all();


        return view('admin.categories.sub-category-manage',['subcategories' => $subcategories,'categories' => $categories]);
    }


    public function subcategroy_add()
    {
        $categories = Category::all();

        return view('admin.categories.sub-category-add',['categories' => $categories]);
    }


    public function store_subcategory(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_image' => 'required|mimes:png,jpg,jpeg'
        ]);

        if($request->hasFile('sub_category_image')){

            $file = $request->file('sub_category_image');

            $fileName = $file->getClientOriginalName();
            //Display File Extension
            $extension = $file->getClientOriginalExtension();
            //Display File Real Path
            $realpath = $file->getRealPath();
            //Display File Size
            $fileSize = $file->getSize();
            //Display File Mime Type
            $fileMime = $file->getMimeType();

            $namefile = time() .'.'. $extension;

            //Move Uploaded File
            $destinationPath = base_path('public/uploads/subcategory/');
            $file->move($destinationPath,$namefile);
        }

        $subcategory = SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'sub_category_image' => $namefile,
        ]);

        return redirect()->route('subcategories')->with('message','Sub Category has been added');
    }


    public function subcategory_edit($subCategoryId)
    {
        $subcategory = SubCategory::where('id',$subCategoryId)->first();
        $categories = Category::where('is_sub_category','yes')->get();

        return view('admin.categories.sub-category-edit',['subcategory' => $subcategory,'subcategoryid' => $subCategoryId,'categories' => $categories]);
    }

    public function subcategory_update(Request $request,$subCategoryId)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_image'  => 'mimes:png,jpg,jpeg'
        ]);

        if($request->hasFile('sub_category_image')){

            $file = $request->file('sub_category_image');

            $fileName = $file->getClientOriginalName();
            //Display File Extension
            $extension = $file->getClientOriginalExtension();
            //Display File Real Path
            $realpath = $file->getRealPath();
            //Display File Size
            $fileSize = $file->getSize();
            //Display File Mime Type
            $fileMime = $file->getMimeType();

            $namefile = time() .'.'. $extension;

            //Move Uploaded File
            $destinationPath = base_path('public/uploads/subcategory/');
            $file->move($destinationPath,$namefile);
        }

        if(isset($subCategoryId) && isset($namefile)) {
            $category = SubCategory::where('id', $subCategoryId)->update([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'sub_category_image' => $namefile,
            ]);

            return redirect()->route('subcategories')->with('message','Sub Category has been updated');
        }else{
            $category = SubCategory::where('id', $subCategoryId)->update([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
            ]);

            return redirect()->route('subcategories')->with('message','Sub Category has been updated');
        }
    }


    public  function delete_subcategory($subCategoryId)
    {
        $delete = SubCategory::where('id',$subCategoryId)->delete();


        return redirect()->route('subcategories')->with('message','Category delete successfully');
    }

    public function categroy_type($categoryId)
    {
        $category_type = Category::where('id',$categoryId)->value('is_sub_category');

        if($category_type == 'yes'){
            $array = array('value' => 'yes');
            echo json_encode($array);
        }else{
            $array = array('value' => 'no');
            echo json_encode($array);
        }
    }
}
