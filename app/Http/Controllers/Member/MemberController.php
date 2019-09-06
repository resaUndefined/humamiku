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
    	
    }
}
