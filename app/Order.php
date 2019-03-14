<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['item_id','price','user_id','item_details','payment_status','payment_type','order_status','user_note'];
}
