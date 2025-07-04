<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $employeesCount = Employee::count();
        $companiesCount = Company::count();
        return view('dashboard',compact('employeesCount','companiesCount'));
    }

    public function language(Request $request)
    {
        $en="__('English')";
        $el="__('Greek')";
        session()->put("locale",$request->locale);
        return redirect()->back();
    }
}
