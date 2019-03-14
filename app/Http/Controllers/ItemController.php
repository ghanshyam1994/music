<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @description manage items
     */
    public function manage_items()
    {
        $items = Item::select('items.*');
        if (isset($_GET['item_name']) && $_GET['item_name']){
            $items = $items->where('item_name', 'like', '%' . $_GET['item_name'] . '%');
        }
        $items = $items->paginate(15);

        return view('admin.items.index',['items' => $items]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @description add item form
     */

    public function add_item()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.items.add',['categories' => $categories,'subcategories' => $subcategories]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * @description store item
     */

    public function store_item(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'item_name' => 'required',
            'price' => 'required|numeric',
            'item_unit' => 'required',
            'quantity' => 'required',
            'item_image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $discount = 0;
        $discountedPrice = $request->price;

        if($request->hasFile('item_image')){

            $file = $request->file('item_image');

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
            $destinationPath = base_path('public/uploads/items/');
            $file->move($destinationPath,$namefile);
        }

        if(isset($request->discount)){

            $discount = $request->discount;

            $discounted =  ($request->price / 100) * $discount;
            $discountedPrice = $request->price - $discounted;
        }
        $stock = 0;
        if(isset($request->stock))
        {
            $stock = $request->stock;
        }

        $create = Item::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'price' => $request->price,
            'stock' => $stock,
            'item_image' => $namefile,
            'item_unit' => $request->item_unit,
            'quantity' => $request->quantity,
            'discount' => $discount,
            'discounted_price' => $discountedPrice,
        ]);
        return redirect()->route('manage-items')->with('success','Item has been added');
    }

    /**
     * @param $itemId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @description edit item
     */

    public function edit_item($itemId)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $item = Item::where('id',$itemId)->first();


        return view('admin.items.edit',['item' => $item,'categories' => $categories, 'subcategories' => $subcategories]);
    }

    /**
     * @param Request $request
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * @descripton Item updated
     */

    public function update_item(Request $request,$itemId)
    {
        // print_r($request->all()); exit;
        $this->validate($request,[
            'category_id' => 'required',
            'item_name' => 'required',
            'item_description' => 'required',
            'price' => 'required',
            'item_unit' => 'required',
            'quantity' => 'required',
        ]);

        if($request->hasFile('item_image')){

            $file = $request->file('item_image');

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
            $destinationPath = base_path('public/uploads/items/');
            $file->move($destinationPath,$namefile);

            Item::where('id',$itemId)->update([
                'item_image' => $namefile
            ]);
        }

        $discount = 0;
        $discountedPrice = $request->price;

        if(isset($request->discount)){

            $discount = $request->discount;

            $discounted =  ($request->price / 100) * $discount;
            $discountedPrice = $request->price - $discounted;
        }

        $stock = 0;
        if(isset($request->stock))
        {
            $stock = $request->stock;
        }
        $update = Item::where('id',$itemId)->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'item_description' => $request->item_description,
            'price' => $request->price,
            'stock' => $stock,
            'item_unit' => $request->item_unit,
            'discount' => $discount,
            'quantity' => $request->quantity,
            'discounted_price' => $discountedPrice,

        ]);

        return redirect()->route('manage-items')->with('success','item updated');
    }

    /**
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     *
     * @description delete item
     */

    public function delete_item($itemId)
    {
        $delete = Item::where('id',$itemId)->delete();


        return redirect()->route('manage-items')->with('message','Item Deleted');
    }
}
