<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['category_id','song_name','song_path','song_duration','sub_category_id'];
}
