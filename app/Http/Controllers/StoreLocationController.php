<?php

namespace App\Http\Controllers;

use App\StoreLocation;
use Illuminate\Http\Request;

class StoreLocationController extends Controller
{
    public function manage_store_location()
    {
        $storelocation = StoreLocation::select('stores.*');
        if (isset($_GET['store_location']) && $_GET['store_location']){
            $storelocation = $storelocation->where('store_location', 'like', '%' . $_GET['store_location'] . '%');
        }

        $storelocation = $storelocation->paginate(15);

        return view('admin.store-location.index',['storelocations' => $storelocation]);
    }

    public function add_store_location()
    {
        return view('admin.store-location.add');
    }

    public function store_store_location(Request $request)
    {
        $this->validate($request,[
            'store_location' => 'required'
        ]);

        $insert = StoreLocation::create([
            'store_location' => $request->store_location,
        ]);

        return redirect()->route('manage-store-location')->with('success','Store location Added');
    }

    public function edit_store_location($storelocationId)
    {
        $storelocation = StoreLocation::where('id',$storelocationId)->first();

        return view('admin.store-location.edit',['storelocation' => $storelocation]);
    }

    public function update_store_location(Request $request,$storelocationId)
    {
        $this->validate($request,[
            'store_location' => 'required'
        ]);

        $update = StoreLocation::where('id',$storelocationId)->update([
            'store_location' => $request->store_location,
        ]);

        return redirect()->route('manage-store-location')->with('success','Store location Updated');
    }

    public function delete_store_location($storelocationId)
    {
        if(isset($storelocationId)){
            $delete = StoreLocation::where('id',$storelocationId)->delete();

            return redirect()->route('manage-store-location')->with('message','Store location Deleted');
        }else{
            return redirect()->route('manage-store-location')->with('message','please try again');
        }
    }
}
