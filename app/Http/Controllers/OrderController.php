<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function manage_order()
    {
        $orders = Order::select('orders.*');
        if(isset($_GET['user_name']) && trim($_GET['user_name']) != ''){
            $users = User::select('id')->where('name', 'like', '%' . $_GET['user_name'] . '%')->get();
            $orders = $orders->whereIn('user_id',$users);
        }elseif (isset($_GET['payment_type']) && trim($_GET['payment_type']) != ''){
            $orders = $orders->where('payment_type',$_GET['payment_type']);
        }elseif (isset($_GET['payment_status']) && trim($_GET['payment_status']) != ''){
            $orders = $orders->where('payment_status',$_GET['payment_status']);
        }elseif (isset($_GET['order_status']) && trim($_GET['order_status']) != ''){
            $orders = $orders->where('order_status',$_GET['order_status']);
        }
        $orders = $orders->orderBy('created_at','desc')->paginate(15);

        return view('admin.orders.index',['orders' => $orders]);
    }
}
