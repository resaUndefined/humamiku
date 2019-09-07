<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\Model\Pertemuan;
use App\Model\Iuran;
use App\Model\Kas;
use App\Model\Kasflow;
use App\User;
use Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {
    	$iurans = Iuran::where('user_id', Auth::id())->paginate(15);
    	$harusnya = 0;
    	$adanya = 0;
    	$kekurangannya = 0;
		foreach ($iurans as $key => $iuran) {
			$harusnya+=5000;
			$adanya+=(int)$iuran->iuran;
    		$pertemuan = Pertemuan::where('id', $iuran->pertemuan_id)->first();
    		$iuran->tempat = $pertemuan->tempat;
    		$iuran->tanggal = $pertemuan->tanggal;
    		if ($iuran->iuran == 0 || $iuran->iuran == '0') {
				$iuran->hadir = 2;
			}
    	}
    	$kekurangannya = $harusnya - $adanya;
    	return view('member.anggota.index', [
    		'iurans' => $iurans,
    		'harusnya' => $harusnya,
    		'adanya' => $adanya,
    		'kekurangannya' => $kekurangannya,
    	]);
    }


    public function hadir()
    {
    	$iurans = Iuran::where('user_id', Auth::id())->paginate(15);
    	$hadir = 0;
    	$tidakHadir = 0;
		foreach ($iurans as $key => $iuran) {
			if ($iuran->hadir == 1 OR $iuran->hadir == '1') {
				$hadir+=1;
			}else{
				$tidakHadir+=1;
			}
    		$pertemuan = Pertemuan::where('id', $iuran->pertemuan_id)->first();
    		$iuran->tempat = $pertemuan->tempat;
    		$iuran->tanggal = $pertemuan->tanggal;
    	}
    	return view('member.anggota.kehadiran', [
    		'iurans' => $iurans,
    		'hadir' => $hadir,
    		'tidakHadir' => $tidakHadir,
    	]);
    }


    public function list_notulen(Request $request)
    {
    	$pertemuans = Pertemuan::orderBy('created_at', 'DESC')->paginate(10);

    	return view('member.anggota.notulen_list', [
    		'pertemuans' => $pertemuans
    	]);
    }


    public function detail_notulen($id)
    {
    	$pertemuan = Pertemuan::where('id', $id)->first();
    	if (!is_null($pertemuan)) {
    		return view('member.anggota.detail_notulen', [
    			'pertemuan' => $pertemuan
    		]);
    	}
    	return redirect()->route('notulen.list')->with('gagal', 'Maaf Pertemuan tidak ditemukan');
    }


    public function list_user()
    {
    	if (Auth::user()->jabatan->jabatan == 'Ketua' || Auth::user()->jabatan->jabatan == 'ketua' || Auth::user()->jabatan->jabatan == 'Wakil Ketua' || Auth::user()->jabatan->jabatan == 'wakil ketua') {
	    		$users = DB::table('users')
	                ->join('roles', 'roles.id', '=', 'users.role_id')
	                ->leftJoin('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
	                ->select('users.id','users.name','users.email', 'users.is_active', 'roles.role_name as role', 'jabatan.jabatan as jabatan')
	                ->paginate(10);

	        return view('member.anggota.list_user', [
	            'users' => $users
	        ]);
	    }
	    return redirect()->route('home');
    }


    public function detail_user($id)
    {
    	if (Auth::user()->jabatan->jabatan == 'Ketua' || Auth::user()->jabatan->jabatan == 'ketua' || Auth::user()->jabatan->jabatan == 'Wakil Ketua' || Auth::user()->jabatan->jabatan == 'wakil ketua') {
    		$user = DB::table('users')
	                ->leftJoin('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
	                ->select('users.*', 'jabatan.jabatan as jabatan')
	                ->where('users.id', $id)
	                ->first();
	        return view('member.anggota.detail_user', [
	        	'user' => $user
	        ]);
    	}
    }


    public function kehadiran()
    {
    	if (Auth::user()->jabatan->jabatan == 'Ketua' || Auth::user()->jabatan->jabatan == 'ketua' || Auth::user()->jabatan->jabatan == 'Wakil Ketua' || Auth::user()->jabatan->jabatan == 'wakil ketua') {
    		$users = User::where('role_id', '!=', 1)->where('is_active',1)->orderBy('name')->paginate(10);
    		if (count($users) > 0) {
    			foreach ($users as $key => $user) {
    				$hadirTmp = 0;
    				$tidakHadirTmp = 0;
    				$pertemuanTmp = 0;
    				$iurans = Iuran::where('user_id',$user->id)->get();
    				if (count($iurans) > 0) {
    					foreach ($iurans as $key => $i) {
    						$pertemuanTmp+=1;
    						if ($i->hadir == 1) {
    							$hadirTmp+=1;
    						}else{
    							$tidakHadirTmp+=1;
    						}
    					}
    				}
    				$user->hadir = $hadirTmp;
    				$user->tidakHadir = $tidakHadirTmp;
    				$user->pertemuan = $pertemuanTmp;
    			}
    		}
    		return view('member.anggota.presensi', [
    			'users' => $users
    		]);
    	}
    	return redirect()->route('home');
    }


    public function kehadiran_show($id)
    {
    	if (Auth::user()->jabatan->jabatan == 'Ketua' || Auth::user()->jabatan->jabatan == 'ketua' || Auth::user()->jabatan->jabatan == 'Wakil Ketua' || Auth::user()->jabatan->jabatan == 'wakil ketua') {
    		$pertemuans = Pertemuan::where('total_iuran', '!=', null)->where('notulen', '!=', null)->paginate(10);
    		if (count($pertemuans) > 0) {
    			foreach ($pertemuans as $key => $p) {
    				$iuran = Iuran::where('pertemuan_id', $p->id)->where('user_id',$id)->first();
    				if ($p->hadir == 1 || $p->hadir == '1') {
    					$p->hadir = 'Hadir';
    					$p->klas = 'success';
    				}else{
    					$p->hadir = 'Tidak Hadir';
    					$p->klas = 'danger';
    				}
    			}
    		}
    		$user = User::where('id',$id)->first();
    		return view('member.anggota.detail_presensi', [
    			'pertemuans' => $pertemuans,
    			'user' => $user,
    		]);
    	}
    	return redirect()->route('home');
    }
}
