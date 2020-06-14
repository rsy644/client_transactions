<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

use App\Employee;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;



class employees_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->paginate(10);
        
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id)
    {
        $company = Company::findOrFail($company_id);
        return view('employees.create')->with('company', $company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc,dns'],
            'phone' => ['required', 'max:20']
        ]);
        if($request->update == 1){
            $employee = Employee::findOrFail($request->employee_id);
            $action = 'updated';
        } else {
            $employee = new Employee();
            $action = 'created';
        }
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->save();

        $request->session()->flash('success', 'Employee ' . $employee->first_name . ' ' . $employee->last_name . ' has been ' . $action);
        return redirect::route('companies.show', $request->company_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company_id, $employee_id)
    {
        $company = Company::findOrFail($company_id);
        $employee = Employee::findOrFail($employee_id);
        return view('employees.show')->with(['company' => $company, 'employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id, $employee_id)
    {
        $company = Company::get_company_from_id($company_id);
        $employee = Employee::get_employee_from_id($employee_id);
        return view('employees.edit')->with(['company' => $company, 'employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($employee_id)
    {
        $employee = Employee::findOrFail($employee_id)->delete();

        return response()->json(['success' => true],200);
    }
}
