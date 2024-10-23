<?php

namespace App\Http\Controllers\Admin;
//Contollers
use App\Http\Controllers\Admin\Controller;
//Models
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
//Requests
use Illuminate\Http\Request;
//Exceptions
use Illuminate\Database\QueryException;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $roles = Role::all();
        //$permissionNames = $user->roles('adminin');
        //$role = Role::create(['name'=>'Admin2', 'guard_name'=>'web']);
       
        $vars = [
            'roles'=>$roles
        ];
        return view ('CP.roles.all', $vars);
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
        Role::create([
            'name'              => $request->name, 
            'display_name'      => $request->display_name, 
            'brief'             => $request->brief, 
            'guard_name'        => $request->guard_name ? $request->guard_name : 'admin', 
            'created_by'        => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Role has been saved successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $role = Role::find($id);
        $role->creator = User::find($role->created_by);
        $role->editor = User::find($role->updated_by);
        return view ('CP.roles.ajax.view', ['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $role->creator = User::find($role->created_by);
        $role->editor = User::find($role->updated_by);
        return view ('CP.roles.ajax.edit', ['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getAdmins(string $id)
    {
        $role = Role::where(['id'=>$id])->with('users')->first();
        $admins = User::all();
        return view ('CP.roles.ajax.giveRoleToAdmins', ['admins' => $admins, 'role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getPermissions(string $id)
    {
        $role = Role::where(['id'=>$id])->with('permissions')->first();
        $permissions = Permission::all();
        return view ('CP.roles.ajax.assignPermissions', ['permissions' => $permissions, 'role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function assignPermissions(Request $request)
    {
        $role = Role::where(['id'=>$request->id])->with('permissions')->first();
        $admins = User::all();
        return view ('CP.roles.ajax.giveRoleToAdmins', ['admins' => $admins, 'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $role = Role::find($request->id);
        if (null == $role) {
            return redirect()->back()->with('error', 'Role doesn\'t exists.');

        }
        $role->name              = $request->name;
        $role->display_name      = $request->display_name;
        $role->brief             = $request->brief;
        $role->guard_name        = $request->guard_name;
        $role->updated_by        = auth()->user()->id;
        try {
            $role->update();
            return redirect()->back()->with('success', 'Role has been updated successfuly.');
        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Role update failed because of: '.$err);

        }
        
    }

    public function assignToAdmin (Request $request) {
        $role = Role::find($request->id)->name;
        
        foreach ($request['admins'] as $id) {
            User::find($id)->addRole($role);
        }
        return redirect()->back()->with('success', 'Role has been assigned to chaoosen admin/s successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (null == $role) {
            return redirect()->back()->with('error', 'Role doesn\'t exists.');
        }
        return $role->users();
    }
}
