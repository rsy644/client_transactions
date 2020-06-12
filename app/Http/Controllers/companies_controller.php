<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Input;

use App\Company;

use App\Employee;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class companies_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')->paginate(10);
        
        return view('companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => ['required', 'unique:companies', 'max:255'],
            'email' => ['required', 'unique:companies', 'email:rfc,dns'],
            'logo' => ['required'],
            'website' => ['required']
        ]);

        if($request->update == 1){
            $company = Company::findOrFail($request->company_id);
            $action = 'updated';
        } else {
            $company = new Company();
            $action = 'created';
        }



        $company->name = $request->name;
        $company->email = $request->email;
        $image_name = $request->file('logo')->getClientOriginalName();
        $file = $request->file('logo')->storeAs('/public', $image_name);
        $company->logo = $image_name;
        $company->website = $request->website;
        $company->save();

        return redirect::route('companies.index')->with('success', 'Company was ' . $action);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = DB::table('employees')->paginate(10);
        $company = Company::get_company_from_id($id);
        return view('companies.show')->with(['company' => $company, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::get_company_from_id($id);
        return view('companies.edit')->with('company', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($company_id)
    {
        $company = Company::findOrFail($company_id)->delete();

        return response()->json(['success' => true],200);
    }

    public function logout(){        

        Auth::logout();

        return redirect('/');
    }
}
