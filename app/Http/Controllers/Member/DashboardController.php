<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	return view('member.index');
    }


    public function profile()
    {
    	$profile = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->leftJoin('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
                ->select('users.id','users.name', 'users.jk', 'users.ttl', 'users.email', 'users.is_active', 'roles.role_name as role', 'jabatan.jabatan as jabatan')
                ->where('users.id', Auth::id())
                ->first();
        $tes = explode("-", $profile->ttl);
        $profile->ttl = $tes['1'].'-'.$tes['2'].'-'.$tes['0'];

    	return view('member.user.profile', [
    		'profile' => $profile
    	]);
    }


    public function profile_update(Request $request)
    {
    	$user = User::where('id', Auth::id())->first();
    	if (is_null($request->password) && is_null($request->password_confirmation)) {
    		$validator = Validator::make($request->all(), [
                        'email' => 'required|email|unique:users,email,'. $user->id,
                        'gender' => 'required|boolean',
                    ],
                    [
                        'email.required' => 'Email wajib diisi',
                        'email.email' => 'Format email tidak sesuai',
                        'email.unique' => 'Email sudah digunakan',
                        'gender.required' => 'Jenis kelamin harus diisi',
                        'gender.boolean' => 'Jenis kelamin tidak ditemukan',
                    ]);	
    	}else{
    		$validator = Validator::make($request->all(), [
                        'password' => 'min:6',
                        'password_confirmation' => 'same:password',
                        'email' => 'required|email|unique:users,email,'. $user->id,
                        'gender' => 'required|boolean',
                    ],
                    [
                        'password.min' => 'Minimal password 6 karakter',
                        'password_confirmation.same' => 'Kombinasi password dengan konfirmasi password tidak sama',
                        'email.required' => 'Email wajib diisi',
                        'email.email' => 'Format email tidak sesuai',
                        'email.unique' => 'Email sudah digunakan',
                        'gender.required' => 'Jenis kelamin harus diisi',
                        'gender.boolean' => 'Jenis kelamin tidak ditemukan',
                    ]);
    	}
    	if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
        	preg_match_all('!\d+!', $request->ttl, $ttl);
            $user->name = $request->nama;
            $user->email = $request->email;
            if (!is_null($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->jk = $request->gender;
            $user->ttl = $ttl[0][2].'-'.$ttl[0][0].'-'.$ttl[0][1];
            $userSave = $user->save();
            if ($userSave) {
                return redirect()->route('member.profile')->with('sukses', 'Profile berhasil diupdate');
            }
            return redirect()->route('member.profile')->with('gagal', 'Profile gagal diupdate');
        }
    }
}
