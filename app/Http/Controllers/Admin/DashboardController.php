<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Pertemuan;
use App\Model\Kas;
use App\Model\Iuran;
use App\Model\Kasflow;
use Illuminate\Support\Facades\Auth;

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
    	return view('admin.index', [
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
}
