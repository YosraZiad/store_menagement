<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $companies = Company::all();
      $vars = [
          'companies'=>$companies
      ];
      return view ('CP.companies.all', $vars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function store(Request $request)
    {
          Company::create([
            'name'                   => $request->name, 
            'address'                => $request->address, 
            'company_size'           => $request->company_size, 
            'phone_number'           => $request->phone_number, 
            'incorporation_date'     => $request->incorporation_date, 
            'industry'               => $request->industry, 
            'website'               => $request->website, 
            'created_by'             => auth()->user()->id
        ]);
    return redirect()->back()->with('success', 'Company has been saved successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
      $company = Company::find($id);
      $company->creator = User::find($company->created_by);
      $company->editor = User::find($company->updated_by);
      return view ('CP.companies.ajax.view', ['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $company = Company::find($id);
      $company->creator = User::find($company->created_by);
      $company->editor = User::find($company->updated_by);
      return view ('CP.companies.ajax.edit', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $company = Company::find($request->id);
      if (null == $company) {
          return redirect()->back()->with('error', 'Company doesn\'t exists.');

      }
  
      $company->name                  = $request->name;
      $company->address               = $request->address;
      $company->company_size          = $request->company_size;
      $company->phone_number          = $request->phone_number;
      $company->incorporation_date    = $request->incorporation_date;
      $company->industry              = $request->industry;
      $company->website               = $request->website;
      $company->updated_by             = auth()->user()->id;
      try {
          $company->update();
          return redirect()->back()->with('success', 'company has been updated successfuly.');
      } catch (QueryException $err) {
          return redirect()->back()->with('error', 'company update failed because of: '.$err);

      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      Company::find($id)->delete();
      return redirect() ->back()->with(['Success'=>'Company Removed Successfully']);
    }
}
