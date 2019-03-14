<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function manage_users()
    {
        $users = User::where('user_type','!=','admin')->paginate(10);

        return view('admin.users.index',['users' => $users]);
    }

    public function password_reset($email)
    {
        if(isset($email) && trim($email) != '') {

            $user = User::where('email',$email)->first();

            $generatepassword = $this->generateRandomString();

            $updatepasword = User::where('email', $email)->update(
                ['password' => Hash::make($generatepassword)]
            );

            $name = $user->name;
            $subject = 'Password Reset';

            $objDemo = new \stdClass();
            $objDemo->name = $name;
            $objDemo->subject = $subject;
            $objDemo->password = $generatepassword;
            $objDemo->receiver = $email;

            Mail::to($email)->send(new SendMail($objDemo));
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
