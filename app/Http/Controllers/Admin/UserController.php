<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Role;
use App\Model\Jabatan;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->leftJoin('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
                ->select('users.id','users.name','users.email', 'users.is_active', 'roles.role_name as role', 'jabatan.jabatan as jabatan')
                ->paginate(10);

        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $jabatans = Jabatan::all();

        return view('admin.user.create', [
            'roles' => $roles,
            'jabatans' => $jabatans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'password' => 'required|min:6',
                        'email' => 'required|email|unique:users',
                        'role' => 'required|exists:roles,id',
                        'jabatan' => 'required|exists:jabatan,id',
                        'gender' => 'required|boolean',
                    ],
                    [
                        'password.required' => 'Password wajib diisi',
                        'password.min' => 'Minimal password 6 karakter',
                        'email.required' => 'Email wajib diisi',
                        'email.email' => 'Format email tidak sesuai',
                        'email.unique' => 'Email sudah digunakan',
                        'role.required' => 'Role wajib diisi',
                        'role.exists' => 'Role tidak ada',
                        'jabatan.required' => 'Jabatan harus diisi',
                        'jabatan.exists' => 'Jabatan tidak ada',
                        'gender.required' => 'Jenis kelamin harus diisi',
                        'gender.boolean' => 'Jenis kelamin tidak ditemukan',
                    ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            preg_match_all('!\d+!', $request->ttl, $ttl);
            $user = new User();
            $user->role_id = $request->role;
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->jabatan_id = $request->jabatan;
            $user->jk = $request->gender;
            $user->ttl = $ttl[0][2].'-'.$ttl[0][0].'-'.$ttl[0][1];
            $user->is_active = 1;
            $userSave = $user->save();
            if ($userSave) {
                return redirect()->route('users.index')->with('sukses', 'User berhasil ditambahkan');
            }
            return redirect()->route('users.index')->with('gagal', 'User gagal ditambahkan');
        }
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
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (!is_null($user)) {
            $roles = Role::all();
            $jabatans = Jabatan::all();
        $tes = explode("-", $user->ttl);
        $user->ttl = $tes['1'].'-'.$tes['2'].'-'.$tes['0'];
            return view('admin.user.edit', [
                'roles' => $roles,
                'jabatans' => $jabatans,
                'userData' => $user,
            ]);
        }
        return redirect()->route('users.index')->with('gagal', 'User tidak ditemukan');
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
        $user = User::where('id', $id)->first();
        if (!is_null($user)) {
            if (is_null($request->password)) {
                $validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:users,email,'. $user->id,
                        'role' => 'required|exists:roles,id',
                        'jabatan' => 'required|exists:jabatan,id',
                        'gender' => 'required|boolean',
                        'status' => 'required|boolean',
                    ],
                    [
                        'email.required' => 'Email wajib diisi',
                        'email.email' => 'Format email tidak sesuai',
                        'email.unique' => 'Email sudah digunakan',
                        'role.required' => 'Role wajib diisi',
                        'role.exists' => 'Role tidak ada',
                        'jabatan.required' => 'Jabatan harus diisi',
                        'jabatan.exists' => 'Jabatan tidak ada',
                        'gender.required' => 'Jenis kelamin harus diisi',
                        'gender.boolean' => 'Jenis kelamin tidak ditemukan',
                        'status.required' => 'Status harus diisi',
                        'status.boolean' => 'Status tidak ditemukan',
                    ]);
            }else{
                $validator = Validator::make($request->all(), [
                        'password' => 'min:6',
                        'email' => 'required|email|unique:users,email,'. $user->id,
                        'role' => 'required|exists:roles,id',
                        'jabatan' => 'required|exists:jabatan,id',
                        'gender' => 'required|boolean',
                        'status' => 'required|boolean',
                    ],
                    [
                        'password.min' => 'Minimal password 6 karakter',
                        'email.required' => 'Email wajib diisi',
                        'email.email' => 'Format email tidak sesuai',
                        'email.unique' => 'Email sudah digunakan',
                        'role.required' => 'Role wajib diisi',
                        'role.exists' => 'Role tidak ada',
                        'jabatan.required' => 'Jabatan harus diisi',
                        'jabatan.exists' => 'Jabatan tidak ada',
                        'gender.required' => 'Jenis kelamin harus diisi',
                        'gender.boolean' => 'Jenis kelamin tidak ditemukan',
                        'status.required' => 'Status harus diisi',
                        'status.boolean' => 'Status tidak ditemukan',
                    ]);
            }
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }else{
                preg_match_all('!\d+!', $request->ttl, $ttl);
                $user->role_id = $request->role;
                $user->name = $request->nama;
                $user->email = $request->email;
                $user->is_active = $request->status;
                if (!is_null($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $user->jabatan_id = $request->jabatan;
                $user->jk = $request->gender;
                $user->ttl = $ttl[0][2].'-'.$ttl[0][0].'-'.$ttl[0][1];
                $userSave = $user->save();
                if ($userSave) {
                    return redirect()->route('users.index')->with('sukses', 'User berhasil diupdate');
                }
                return redirect()->route('users.index')->with('gagal', 'User gagal diupdate');
            }
        }
        return redirect('/admin/users/$id/edit')->with('gagal', 'User tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->first();
        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('sukses', 'User berhasil dihapus');
        }
        return redirect()->route('users.index')->with('gagal', 'User tidak ditemukan');
    }
}
