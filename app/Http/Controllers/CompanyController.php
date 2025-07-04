<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();
        return view('company.list',compact('companies'));
    }

    public function create(Request $request)
    {
        return view('company.detail',[
            'company' => null
        ]);
    }

}
