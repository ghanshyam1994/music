<?php

namespace App\Http\Controllers;

use Acekyd\LaravelMP3\LaravelMP3;
use App\Category;
use App\Http\Controllers\common\MP3File;
use App\Song;
use App\SubCategory;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;
use wapmorgan\Mp3Info\Mp3Info;

class MySongscontroller extends Controller
{
    public function manage_songs()
    {
        $songs = Song::paginate(15);

        return view('songs.index',['songs' => $songs]);
    }


    public function list_subcategory($category)
    {
        $subcategories = SubCategory::select('id','category_id','sub_category_name')->where('category_id',$category)->get();
        if(count($subcategories) > 0)
        {
            $result = array('status' => 'ok','response' => $subcategories);
            echo json_encode($result);
        }else{
            $subcategories = [];
            $result = array('status' => 'ok','response' => $subcategories);
            echo json_encode($result);
        }
    }


    public function add()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('songs.add',['categories' => $categories,'subcategories' => $subcategories]);
    }


    public function storeold(Request $request)
    {
        //echo "<pre>";
        //print_r($request->all()); exit;
        $this->validate($request,[
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'song_name' => 'required',
            'song_uplod' => 'required'
        ]);
        $filenames = '';
        if($request->hasFile('song_uplod')){
            $file = $request->file('song_uplod');

            //Display File Name
            $filename = $file->getClientOriginalName();

            //Display File Extension
            $extension = $file->getClientOriginalExtension();

            $filenames = time() . '.' . $extension;

            //Display File Real Path
            $realname = $file->getRealPath();

            //Display File Size
            $size = $file->getSize();

            //Display File Mime Type
            $mimetype = $file->getMimeType();

            //Move Uploaded File
            $destinationPath = 'uploads/songs/';
            $fileupload = $file->move($destinationPath,$filenames);

            $dataArray = [];
            $duration = '';
            if(file_exists(base_path('public/uploads/songs/' . $filenames))){
                $dataArray = new MP3File(base_path('public/uploads/songs/' . $filenames));
                $duration = $dataArray->mp3data['duration'];
            }
        }
        $subcategory = 0;
        if(isset($request->sub_category_id)){
            $subcategory = $request->sub_category_id;
        }
        $data = Song::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $subcategory,
            'song_name' => $request->song_name,
            'song_path' => $filenames,
            'song_duration' => $duration,
        ]);

        return redirect()->route('manage-songs');
    }

    public function store(Request $request)
    {
        if(!isset($request->upload_type)){
            $this->validate($request,[
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'song_name' => 'required',
                'upload_type' => 'required',
            ]);
        }
        if($request->upload_type == 'folder') {

            $this->validate($request,[
                'category_id' => 'required',
                'sub_category_id' => 'required',
                //'song_name' => 'required',
                'upload_type' => 'required',
                'song_uplod' => 'required'
            ]);

            $uploads = $this->UpFilesTOObj($_FILES['song_uplod']);
            $first = time();
            foreach ($uploads as $song) {
                $name = $first . preg_replace('/\s+/', '', $song['name']);
                move_uploaded_file($song['tmp_name'], public_path('uploads/songs/' . $name));

                $duration = '';
                if (file_exists(base_path('public/uploads/songs/' . $name))) {
                    //$dataArray = new MP3File(base_path('public/uploads/songs/' . $name));
                    //$details = LaravelMP3::getBitrate($song);
                    $audio = new Mp3Info(base_path('public/uploads/songs/' . $name), true);
                    // $duration = $dataArray->mp3data['duration'];
                    $duration = floor($audio->duration / 60) . ':' . floor($audio->duration % 60);
                }

                $subcategory = 0;
                if (isset($request->sub_category_id)) {
                    $subcategory = $request->sub_category_id;
                }
                $data = Song::create([
                    'category_id' => $request->category_id,
                    'sub_category_id' => $subcategory,
                    'song_name' => $song['name'],
                    'song_path' => $name,
                    'song_duration' => $duration,
                ]);
            }
            return redirect()->route('manage-songs');
        }else{

            $this->validate($request,[
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'song_name' => 'required',
                'upload_type' => 'required',
                'song_uplods' => 'required'
            ]);

            $filenames = '';
            if($request->hasFile('song_uplods')){
                $file = $request->file('song_uplods');

                //Display File Name
                $filename = $file->getClientOriginalName();

                //Display File Extension
                $extension = $file->getClientOriginalExtension();

                $filenames = time() . '.' . $extension;

                //Display File Real Path
                $realname = $file->getRealPath();

                //Display File Size
                $size = $file->getSize();

                //Display File Mime Type
                $mimetype = $file->getMimeType();

                //Move Uploaded File
                $destinationPath = 'uploads/songs/';
                $fileupload = $file->move($destinationPath,$filenames);

                $dataArray = [];
                $duration = '';
                if(file_exists(base_path('public/uploads/songs/' . $filenames))){
                    //$dataArray = new MP3File(base_path('public/uploads/songs/' . $filenames));
                    //$duration = $dataArray->mp3data['duration'];
                    $audio = new Mp3Info(base_path('public/uploads/songs/' . $filenames), true);
                    // $duration = $dataArray->mp3data['duration'];
                    $duration = floor($audio->duration / 60) . ':' . floor($audio->duration % 60);
                }
            }
            $subcategory = 0;
            if(isset($request->sub_category_id)){
                $subcategory = $request->sub_category_id;
            }
            $data = Song::create([
                'category_id' => $request->category_id,
                'sub_category_id' => $subcategory,
                'song_name' => $request->song_name,
                'song_path' => $filenames,
                'song_duration' => $duration,
            ]);

            return redirect()->route('manage-songs');
        }
    }

    function UpFilesTOObj($fileArr){
        $uploads = [];
        foreach($fileArr['name'] as $keyee => $info)
        {
            $uploads[$keyee]['name'] = $fileArr['name'][$keyee];
            $uploads[$keyee]['type'] = $fileArr['type'][$keyee];
            $uploads[$keyee]['tmp_name'] = $fileArr['tmp_name'][$keyee];
            $uploads[$keyee]['error'] = $fileArr['error'][$keyee];
        }
        return $uploads;
    }


    function get_file_extension($file_name)
    {
        return substr(strrchr($file_name,'.'),1);
    }


    public function edit($songId)
    {
        return view('songs.edit');
    }

    public function update(Request $request)
    {

    }
}
