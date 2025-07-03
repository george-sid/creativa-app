<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('company')->get();
        return view('employee.list',compact('employees'));
    }

    public function create(Request $request)
    {
        return view('employee.detail',[
            'employee' => null
        ]);
    }

    public function update(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        return view('employee.detail',[
            'employee' => $employee
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {   
        $validated = $request->validated();
        $employee = Employee::find($validated['id']);
        if($employee){
            $employee->update($validated);
        }else{
            $employee = Employee::create($validated);
        }

        return response()->json($employee);
    }

    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => __('Employee not found.')
            ]);
        }

        $employee->delete();
        return response()->json([
            'status' => 'success',
            'message' => __('Employee deleted successfully.')
        ]);
    }
}
