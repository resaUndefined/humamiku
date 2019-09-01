<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->role_name = $request->role;
        $role->level = $request->level;
        $roleSave = $role->save();
        if ($roleSave) {
            return redirect()->route('roles.index')->with('sukses', 'Role berhasil ditambahkan');
        }
        return redirect()->route('roles.create')->with('gagal', 'Role gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $roleData = Role::where('id', $role->id)->first();
        if (!is_null($roleData)) {
            return view('admin.role.edit', [
                'role' => $roleData
            ]);
        }
        return redirect()->route('roles.index')->with('gagal', 'Maaf role tidak ada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $roleData = Role::where('id',$role->id)->first();
        if (!is_null($roleData)) {
            $roleData->role_name = $request->role;
            $roleData->level = $request->level;
            $roleUpdate = $roleData->save();
            if ($roleUpdate) {
                return redirect()->route('roles.index')->with('sukses', 'Role berhasil diupdate');
            }
            return redirect('/role/$role->id/edit')->with('gagal', 'Role gagal diupdate');
        }
        return redirect('/role/$role->id/edit')->with('gagal', 'Role tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role = Role::where('id',$role->id)->first();
        if ($role) {
            $role->delete();
            return redirect()->route('roles.index')->with('sukses', 'Role berhasil dihapus');
        }
        return redirect()->route('roles.index')->with('gagal', 'Role tidak ditemukan');
    }
}
