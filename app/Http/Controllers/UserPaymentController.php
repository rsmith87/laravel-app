<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    public function index()
    {
        return view('auth.payment');
    }
}
