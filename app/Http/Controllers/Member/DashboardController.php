<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Pertemuan;
use App\Model\Kas;
use App\Model\Iuran;
use App\Model\Kasflow;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
    	$nextPertemuan = pertemuan::whereNull('total_iuran')->first(['tanggal', 'tempat']);
    	$prevPertemuan = Pertemuan::where('total_iuran', '!=', null)->where('notulen', '!=', null)->orderBy('id', 'DESC')->first(['id' ,'total_iuran']);
    	$kas = Kas::orderBy('id', 'DESC')->first();
    	$users = User::where('is_active', 1)->where('role_id', '!=', 1)->get();
    	$laki= 0;
    	$perempuan = 0;
    	foreach ($users as $key => $user) {
    		if ($user->jk == 1) {
    			$laki+=1;
    		}else{
    			$perempuan+=1;
    		}
    	}
    	$iurans = Pertemuan::where('total_iuran', '!=', null)->where('notulen', '!=', null)->orderBy('id', 'DESC')->get()->take(5);
    	$tglArr = [];
    	$iurArr = [];
    	$persenIur = [];
    	$jumTmp = 0;
    	for ($i=0; $i <5 ; $i++) {
    		$x = 0;
    		if (isset($iurans[$i])) {
    			$tmpTgl = date('d F Y', strtotime($iurans[$i]->tanggal));
				array_push($tglArr, $tmpTgl);
				$x = $iurans[$i]->total_iuran;
    		}else{
    			array_push($tglArr, '-');
    		}
    		$jumTmp+=(int)$x;
    		array_push($iurArr, $x);
    	}
    	for ($i=0; $i <5 ; $i++) {
    		$y = 0;
    		$y = ($iurArr[$i]*100)/$jumTmp;
    		array_push($persenIur, $y);
    	}
    	return view('member.index', [
    		'nextPertemuan' => $nextPertemuan,
    		'prevPertemuan' => $prevPertemuan,
    		'kas' => $kas,
    		'users' => count($users),
    		'laki' => $laki,
    		'perempuan' => $perempuan,
    		'iurans' => $iurans,
    		'tglArr' => $tglArr,
    		'iurArr' => $iurArr,
    		'persenIur' => $persenIur,
    	]);
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
