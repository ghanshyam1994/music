<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function password_change()
    {
        $name = 'pawan';
        $subject = 'Password Reset';

        $objDemo = new \stdClass();
        $objDemo->name = $name;
        $objDemo->subject = $subject;
        $objDemo->password = 'mypassword';
        $objDemo->receiver = 'pawanyd2012@gmail.com';
        $objDemo->action = 'reset_password';

        $mail = Mail::to('pawanyd2012@gmail.com')->send(new SendMail($objDemo));

        return $mail;
    }
}
