<?php

namespace App\Http\Controllers\API;

use App\Mail\SendMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AUserController extends Controller
{
    public function update_profile(Request $request)
    {
        $userId = Auth::guard('api')->id();

        if(isset($request->name)){
            $update = User::where('id',$userId)->update([
                'name' => $request->name,
            ]);
        }

        if(isset($request->phone)){
            $update = User::where('id',$userId)->update([
                'phone' => $request->phone,
            ]);
        }

        if(isset($request->address)){
            $update = User::where('id',$userId)->update([
                'address' => $request->address,
            ]);
        }

        if(isset($request->store_location)){
            $update = User::where('id',$userId)->update([
                'store_location' => $request->store_location,
            ]);
        }

        if(isset($request->device_type)){
            $update = User::where('id',$userId)->update([
                'device_type' => $request->device_type,
            ]);
        }

        if(isset($request->password)){
            $update = User::where('id',$userId)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $users = User::find($userId);

        $result['status'] = 'OK';
        $result['code'] = 200;
        $result['message'] = 'profile update successfully';
        $result['response'] = $users;

        return response()->json($result,200);
    }


    public function password_reset(Request $request)
    {
        if(isset($request->email) && trim($request->email) != '') {

            $usercount = User::where('email',$request->email)->count();
            if(isset($usercount) && $usercount > 0) {

                $user = User::where('email', $request->email)->first();

                $generatepassword = $this->generateRandomString();

                $updatepasword = User::where('email', $request->email)->update(
                    ['password' => Hash::make($generatepassword)]
                );

                $name = $user->name;
                $subject = 'Password Reset';

                $objDemo = new \stdClass();
                $objDemo->name = $name;
                $objDemo->subject = $subject;
                $objDemo->password = $generatepassword;
                $objDemo->receiver = $request->email;
                $objDemo->action = 'reset_password';

                Mail::to($request->email)->send(new SendMail($objDemo));

                $result['status'] = 'OK';
                $result['code'] = 200;
                $result['message'] = 'please check your mail';
                $result['response'] = $user;

                return response()->json($result, 200);
            }else{

                $result['status'] = 'Error';
                $result['code'] = 400;
                $result['message'] = 'record not found please check your email';
                $result['response'] = null;

                return response()->json($result, 200);

            }
        }else{

            $result['status'] = 'Error';
            $result['code'] = 400;
            $result['message'] = 'please enter your mail';
            $result['response'] = null;

            return response()->json($result,200);
        }
    }

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
