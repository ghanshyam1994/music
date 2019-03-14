<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = ['item_name','item_image','item_description','price','category_id','sub_category_id','stock'
    ,'discounted_price','discount','item_unit','quantity'];
}
