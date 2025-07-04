<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        $company = Company::findOrFail($request->id);
        return view('company.detail',[
            'company' => $company
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {   
        $validated = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $company = Company::find($validated['id'] ?? null);

        if ($company) {
            if (isset($validated['logo']) && $company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $company->update($validated);
        } else {
            $company = Company::create($validated);
        }

        return response()->json($company);
    }

    public function destroy(Request $request)
    {
        $company = Company::find($request->id);

        if (!$company) {
            return response()->json([
                'status' => 'error',
                'message' => __('Company not found.')
            ]);
        }

        // Delete logo file if exists
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('Company deleted successfully.')
        ]);
    }


}
