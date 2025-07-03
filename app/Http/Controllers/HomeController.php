<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function language(Request $request)
    {
        session()->put("locale",$request->locale);
        return redirect()->back();
    }
}
