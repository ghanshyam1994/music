<?php

namespace App\Http\Controllers\API;

use App\Mail\SendMail;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AOrderController extends Controller
{
    public function save_order(Request $request)
    {
        $this->validate($request,[
            'item_details' => 'required',
            'price' => 'required',
        ]);
        $paymentType = 'cash_on_delivery';
        $paymentStatus = 'unpaid';
        $orderStatus = 'new';
        $userId = Auth::guard('api')->id();
        if(isset($request->payment_type)){
            $paymentType = $request->payment_type;
        }
        if(isset($request->payment_status)){
            $paymentStatus = $request->payment_status;
        }
        if(isset($request->order_status))
        {
            $orderStatus = $request->order_status;
        }

        $insert = Order::create([
           'price' => $request->price,
           'item_details' => $request->item_details,
           'user_id' => $userId,
           'payment_type' => $paymentType,
           'payment_status' => $paymentStatus,
           'order_status' => $orderStatus,
        ]);

        $userdata = User::where('id',$userId)->first();

        $name = $userdata->name;
        $subject = 'Order Confirmation';

        $objDemo = new \stdClass();
        $objDemo->name = $name;
        $objDemo->subject = $subject;
        $objDemo->receiver = $userdata->email;
        $objDemo->action = 'order_placed';
        $objDemo->order_id = $insert->id;

        $mail = Mail::to($userdata->email)->send(new SendMail($objDemo));

        $insert->item_details = json_decode($insert->item_details);

        $result['status'] = 'OK';
        $result['message'] = 'order save successfully';
        $result['response'] = $insert;

        return response()->json($result,200);
    }


    public function update_order(Request $request,$orderId)
    {
        $this->validate($request,[
            'item_details' => 'required',
            'price' => 'required',
        ]);

        $paymentType = 'cash_on_delivery';
        $paymentStatus = 'unpaid';
        $orderStatus = 'new';
        $userId = Auth::guard('api')->id();
        if(isset($request->payment_type)){
            $paymentType = $request->payment_type;
        }
        if(isset($request->payment_status)){
            $paymentStatus = $request->payment_status;
        }
        if(isset($request->order_status))
        {
            $orderStatus = $request->order_status;
        }

        $update = Order::where('id',$orderId)->update([
            'price' => $request->price,
            'item_details' => $request->item_details,
            'user_id' => $userId,
            'payment_type' => $paymentType,
            'payment_status' => $paymentStatus,
            'order_status' => $orderStatus,
        ]);

        $order = Order::where('id',$orderId)->first();

        $result['status'] = 'OK';
        $result['message'] = 'order save successfully';
        $result['response'] = $order;

        return response()->json($result,200);
    }

    public function get_orders($orderId = null)
    {
        $userId = Auth::guard('api')->id();
        if($orderId == null){
            $orders = Order::where('user_id',$userId)->get();
            foreach ($orders as $order){
                $order->item_details = json_decode($order->item_details);
            }

            $result['status'] = 'OK';
            $result['message'] = 'order fetch successfully';
            $result['response'] = $orders;

            return response()->json($result,200);
        }else{

            $orders = Order::where('user_id',$userId)->where('id',$orderId)->get();

            foreach ($orders as $order){
                $order->item_details = json_decode($order->item_details);
            }

            $result['status'] = 'OK';
            $result['message'] = 'order fetch successfully';
            $result['response'] = $orders;

            return response()->json($result,200);
        }

    }
}
