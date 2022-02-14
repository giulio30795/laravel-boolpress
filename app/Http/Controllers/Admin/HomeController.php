<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendWelcomeEmail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {

        Mail::to(Auth::user()->email)->send(new SendWelcomeEmail(Auth::user()->name));


        return view('admin.home');
    }
}
