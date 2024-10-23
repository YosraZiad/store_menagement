<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;

use App\Models\Permission;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Permission::all();
        return view('CP.permissions.all', ['items'=>$items]);
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
        try {
            $item = Permission::create([
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'brief'=>$request->brief,

                'created_by'=>auth()->user()->id,
                'updated_by'=>auth()->user()->id,
            ]);
            if (null != $item) {
                return redirect()->back()->with('success', 'New Permission Has Been Added Successfuly');
            }
        } catch(QueryException $err ) {
            return redirect()->back()->with('error', 'Failed to save new permission duo to: '.$err.'.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $item = Permission::where(['id'=>$id])->with('creator')->with('editor')->first();
        return view ('CP.permissions.ajax.view', ['item'=>$item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Permission::find($id);
        return view ('CP.permissions.ajax.edit', ['item'=>$item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $item = Permission::find($request->id);
        if ($item) {
            try {
            $item->name             = $request->name;
            $item->display_name     = $request->display_name;
            $item->brief            = $request->brief;
            $item->updated_by       = auth()->user()->id;
            if ($item->update()) {
                    return redirect()->back()->with(['success'=>'Permission has beed updated succeefully.']);
                } 
            } catch (QueryException $err) {
                return redirect()->back()->with(['success'=>'Permission can not updated due to: '.$err.'.']);
            }
        } return redirect()->bac()->with(['error'=>'Permission may be reomved recently and not found.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Permission::find($id);
        if ($item) {
            try {
                $item->delete();
                return redirect()->back()->with(['success'=>'Permission has beed removed succeefully.']);
            } catch (QueryException $err) {
                return redirect()->back()->with(['success'=>'Permission can not removed due to: '.$err.'.']);
            }
        } return redirect()->bac()->with(['error'=>'Permission may has been reomved recently and not found.']);
    }
}
