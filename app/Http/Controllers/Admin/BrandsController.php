<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;

class BrandsController extends Controller
{
  private static $path = 'assets/img/client_logo';
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    
    $companies = Company::all();
    $brands = Brand::all();

    foreach ($brands as $brand) {
      $brand->company = Company::where('id', '=', $brand->company_id)->first();
    }

    $vars = [
      'brands' => $brands,
      'companies' => $companies
    ];

    return view('CP.brands.all', $vars);
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
   */

  public function store(Request $request)
  {
    if ($request->hasFile('brand_logo')) {
      // catch the file
      $filehandler = $request->brand_logo;

      // file name to save
      $filename = time() . 'logo_brands.' . $filehandler->getClientOriginalExtension();
      // return   $filename;

      // move to destination folder
      $filehandler->move(self::$path, $filename);

      try {
        Brand::create([
          'name'              => $request->name,
          'description'       => $request->description,
          'website'           => $request->website,
          'brand_logo'        => $filename,
          'company_id'        => $request->company_id,

        ]);

        return redirect()->back()->with('success', 'brand has been saved successfuly');
      } catch (Exception $e) {
        return redirect()->back()->withInputs()->with(['error' => 'brand  Created failed ' . $e]);
      }
    }
  }

  /**
   * Display the specified resource.
   */
  public function view(string $id)
  {
    $brand = Brand::find($id);

    if (!$brand) {

      return view('CP.brands.ajax.view', ['brand' => null]);
    }

    $brand->company = Company::where('id', '=', $brand->company_id)->first();
    $brand->creator = User::where(['id' => $brand->created_by])->first();
    $brand->editor = User::where(['id' => $brand->updated_by])->first();

    $vars = [
      'brand' => $brand,
    ];

    return view('CP.brands.ajax.view', $vars);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $companies = Company::all();
    $brand = Brand::find($id);

    if (!$brand) {

      return view('CP.brands.ajax.edit', ['brand' => null]);
    }

    $brand->company = Company::where('id', '=', $brand->company_id)->first();
    $brand->creator = User::where(['id' => $brand->created_by])->first();
    $brand->editor = User::where(['id' => $brand->updated_by])->first();

    $vars = [
      'brand' => $brand,
      'companies' => $companies
    ];

    return view('CP.brands.ajax.edit', $vars);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $brand = Brand::find($request->id);
    if (null == $brand) {
      return redirect()->back()->with('error', 'brand doesn\'t exists.');
    }

    $brand->name          = $request->name;
    $brand->description   = $request->description;
    $brand->website        = $request->website;
    $brand->company_id     = $request->company_id;
    $brand->updated_by    = auth()->user()->id;
    try {
      $brand->update();
      return redirect()->back()->with('success', 'brand has been updated successfuly.');
    } catch (QueryException $err) {
      return redirect()->back()->with('error', 'brand update failed because of: ' . $err);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    Brand::find($id)->delete();
    return redirect()->back()->with(['Success' => 'Brand Removed Successfully']);
  }
}
