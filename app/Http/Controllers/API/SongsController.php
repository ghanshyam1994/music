<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\DeviceToken;
use App\Song;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongsController extends Controller
{
    public function list_songs()
    {
        $categories = Category::select('id','category_name','category_image')->get();
        if(isset($categories) && count($categories) > 0) {
            foreach ($categories as $category) {
                $category->category_image_path = url('uploads/category/' . $category->category_image);
                // $category->songs = $this->getSongsByCategories($category->id);
                $category->sub_category = $this->getSongsBySubCategories($category->id);
            }

            $result['status'] = 'OK';
            $result['message'] = 'songs and categories fetch successfully';
            $result['response'] = $categories;

            return response()->json($result, 200);
        }else{
            $categories = [];

            $result['status'] = 'OK';
            $result['message'] = 'no sogs and category found';
            $result['response'] = $categories;

            return response()->json($result, 200);
        }
    }

    public function getSongsByCategories($categoryId)
    {
        $songs = Song::select('id','song_name','category_id','song_path','song_duration')->where('category_id',$categoryId)->where('sub_category_id',null)->get();
        if(isset($songs) && count($songs) > 0){
            foreach ($songs as $song)
            {
                $song->song_full_path = url('uploads/songs/' . $song->song_path);
            }
            return $songs;
        }else{
            return [];
        }
    }

    public function getSongsBySubCategories($categoryId){

        $SubCategories = SubCategory::where('category_id',$categoryId)->get();
        if(isset($SubCategories) && count($SubCategories) > 0) {
            foreach ($SubCategories as $subCategory) {
                $subCategory->sub_category_image_path = url('uploads/subcategory/' . $subCategory->sub_category_image);
                $subCategory->sub_category_songs = $this->getSongsOfCategories($subCategory->id,$categoryId);
            }
            return $SubCategories;
        }else{
            return [];
        }

    }

    public function getSongsOfCategories($subcategoryId,$categoryId)
    {
        $songs = Song::select('id','song_name','category_id','song_path','song_duration')->where('sub_category_id',$subcategoryId)->where('category_id',$categoryId)->get();
        if(isset($songs) && count($songs) > 0){
            foreach ($songs as $song)
            {
                $song->song_full_path = url('uploads/songs/' . $song->song_path);
            }
            return $songs;
        }else{
            return [];
        }
    }

    public function add_device_token(Request $request)
    {
        $this->validate($request,[
            'device_token' => 'required',
        ]);

        $data = DeviceToken::create([
            'device_token' => $request->device_token,
        ]);

        $result['status'] = 'OK';
        $result['message'] = 'device token has been saved';
        $result['response'] = $data;

        return response()->json($result, 200);
    }
}
