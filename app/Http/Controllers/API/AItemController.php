<?php

namespace App\Http\Controllers\API;

use App\Item;
use App\StoreLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AItemController extends Controller
{
    public function getitems(Request $request)
    {
        $items = Item::select('items.*');
        if(isset($request->item_name)){
            $items = $items->where('item_name','like', '%' .$request->item_name. '%' );
        }elseif(isset($request->item_id)) {
            $items = $items->where('id',$request->item_id);
        }elseif (isset($request->category_id)){
            $items = $items->where('category_id',$request->category_id);
        }elseif (isset($request->sub_category_id)){
            $items = $items->where('sub_category_id',$request->sub_category_id);
        }
        $items = $items->get();

        if(isset($items) && count($items) > 0)
        {
            foreach ($items as $item)
            {
                $item->image_path = url('uploads/items/'.$item->item_image);
            }
        }
        $result['status'] = 'OK';
        $result['message'] = 'item fetch successfully';
        $result['response'] = $items;

        return response()->json($result,200);
    }


    public function getcities()
    {
        // $cities = config('app.cities');
        $cities = StoreLocation::select('id','store_location as value')->get();

        $result['status'] = 'OK';
        $result['message'] = 'cities list fetch successfully';
        $result['response'] = $cities;

        return response()->json($result,200);
    }
}
