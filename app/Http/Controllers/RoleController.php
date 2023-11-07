<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Laratrust\Laratrust;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['roles'] = Role::query()->orderBy('id','desc')->paginate(10);
        return view('Dashboard.Roles.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['permissions'] = Permission::all();
        return view('Dashboard.Roles.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:roles',
            // Add any other validation rules you require
        ]);

        // Create a new role
        $role = new Role();
        $role->display_name = $request->name;
        $role->name = $request->name;
        $role->save();
        if ($request->has('permession')) {
            $role->syncPermissions($request->permession);
        }
        return redirect()->route('role.index')->with('success', 'Role created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $data['permissions'] = Permission::all();
        return view('Dashboard.Roles.edit',$data,compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Role $role)
    {
        //

        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            // Add any other validation rules you require
        ]);

        // Create a new role
        $role->display_name = $request->name;
        $role->name = $request->name;
        $role->save();
        if ($request->has('permession')) {
            $role->syncPermissions($request->permession);
        }
        return redirect()->route('role.index')->with('success', 'Role edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->detachPermissions();
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_permissions(Request $request)
    {
        //
        $role = Role::find($request->id);
        if ($role) {
            $permissions = $role->permissions;
        }

        return response()->json(['data' => $permissions],200);

    }
}
