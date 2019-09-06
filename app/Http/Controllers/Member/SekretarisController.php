<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\Model\Pertemuan;
use App\Model\Iuran;
use Auth;
use Carbon\Carbon;

class SekretarisController extends Controller
{
    public function create(Request $request)
    {
    	if (Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris') {
    		$pertemuan = Pertemuan::whereNull('total_iuran')->first();
	    	if (!is_null($pertemuan)) {
	    		
	    		return view('member.sekretaris.create', [
	    			'pertemuan' => $pertemuan
	    		]);
	    	}
	    	return redirect()->route('pertemuan.index')->with('gagal', 'Silakan tambahkan pertemuan dulu');
    	}
    	return redirect()->route('home');
    }


    public function store(Request $request)
    {
    	$pertemuan = Pertemuan::where('id', $request->pertemuan)->first();
    	$pertemuanCekIuran = Iuran::where('pertemuan_id',$pertemuan->id)->get();
    	$pertemuan->notulen = $request->notulen;
    	if (count($pertemuanCekIuran) > 0) {
    		$totalRemanen = null;
    		foreach ($pertemuanCekIuran as $key => $iuran) {
    			$totalRemanen+=(int)$iuran->iuran;
    		}
    		$pertemuan->total_iuran = $totalRemanen;
    	}

    	$pertemuanSave = $pertemuan->save();
    	if ($pertemuanSave) {
    		return redirect()->route('pertemuan.index')->with('sukses', 'Notulen berhasil ditambahkan');
    	}
    	return redirect()->route('notulen.create')->with('gagal', 'Notulen gagal ditambahkan');
    }

}
