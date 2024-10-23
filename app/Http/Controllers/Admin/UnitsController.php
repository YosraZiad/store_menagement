<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\User;

use App\Http\Requests\UnitRequest;
use Illuminate\Database\QueryException;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $units = Unit::all();
      
     
      $vars = [
          'units'=>$units
      ];
      return view ('CP.units.all', $vars);
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
    public function store(UnitRequest $request)
    {
      Unit::create([
        'name'             => $request->name, 
        'description'      => $request->description, 
        'short_name'       => $request->short_name, 
        'created_by'        => auth()->user()->id,
        'updated_by'        => auth()->user()->id
    ]);
    return redirect()->back()->with('success', 'unit has been saved successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
      $unit = Unit::find($id);
      $unit->creator = User::find($unit->created_by);
      $unit->editor = User::find($unit->updated_by);
      return view ('CP.units.ajax.view', ['unit'=>$unit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( string $id)
    {
      $unit = Unit::find($id);
      $unit->creator = User::find($unit->created_by);
      $unit->editor = User::find($unit->updated_by);
      return view ('CP.units.ajax.edit', ['unit'=>$unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $unit = Unit::find($request->id);
      if (null == $unit) {
          return redirect()->back()->with('error', 'Unit doesn\'t exists.');

      }
    
      $unit->name              = $request->name;
      $unit->description      = $request->description;
      $unit->short_name        = $request->short_name;
      $unit->updated_by        = auth()->user()->id;
      try {
          $unit->update();
          return redirect()->back()->with('success', 'Unit has been updated successfuly.');
      } catch (QueryException $err) {
          return redirect()->back()->with('error', 'Unit update failed because of: '.$err);

      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      Unit::find($id)->delete();
      return redirect() ->back()->with(['Success'=>'Unit Removed Successfully']);
    }
}
