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

class BendaharaController extends Controller
{
    public function create(Request $request)
    {
    	$pertemuan = Pertemuan::whereNull('total_iuran')->first();
    	if (!is_null($pertemuan)) {
    		$members = User::where('role_id', '!=', 1)
    						->where('is_active', 1)
    		                ->orderBy('name')
	    				    ->get(['id', 'name']);
			$jumlahMember = $members->count();
			if ($jumlahMember > 0) {
				foreach ($members as $key => $member) {
					$iurannya = null;
					$harusnya = 5000;
					$kekurangan = null;
					$iuranTmp = Iuran::where('user_id', $member->id)->get(['iuran']);
					$totalIuranTmp = $iuranTmp->count();
					if ($totalIuranTmp > 0) {
						foreach ($iuranTmp as $key => $i_tmp) {
							$harusnya+=5000;
							$iurannya+=(int)$i_tmp->iuran;
						}
						$kekurangan = $harusnya - $iurannya;
					}else{
						$kekurangan = 5000;
					}
					$member->kekurangannya = $kekurangan;
				}
				return view('member.bendahara.create', [
					'members' => $members,
					'pertemuan' => $pertemuan,
				]);
			}
			return redirect()->route('pertemuan.index')->with('gagal', 'Anggota belum ada coy');
    	}
    	return redirect()->route('pertemuan.index')->with('gagal', 'Pertemuan belum berlangsung');
    }


    public function store(Request $request)
    {
    	if (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara') {
    		$members = User::where('role_id', '!=', 1)
    						->where('is_active', 1)
    		                ->orderBy('name')
	    				    ->get(['id']);
	    	$pertemuan = Pertemuan::where('id', $request->pertemuan)->first();
	    	$totalIuranTmp = null;
	    	foreach ($members as $key => $member) {
	    		$iuran = new Iuran();
	    		$iuranTmp = null;
	    		$iuranTmp2 = null;
	    		$iuranTmp = $request->get('iuran'.$member->id);
	    		if ($iuranTmp == 1 || $iuranTmp == '1') {
		    		$iuranTmp2 = 5000;
	    		}elseif ($iuranTmp == 2 || $iuranTmp == '2') {
	    			$iuranTmp2 = 10000;
	    		}elseif ($iuranTmp == 3 || $iuranTmp == '3') {
	    			$iuranTmp2 = 15000;
	    		}elseif ($iuranTmp == 4 || $iuranTmp == '4') {
	    			$iuranTmp2 = 20000;
	    		}elseif ($iuranTmp == 5 || $iuranTmp == '5') {
	    			$iuranTmp2 = 25000;
	    		}elseif ($iuranTmp == 6 || $iuranTmp == '6') {
	    			$iuranTmp2 = 30000;
	    		}elseif ($iuranTmp == 7 || $iuranTmp == '7') {
	    			$iuranTmp2 = 35000;
	    		}elseif ($iuranTmp == 8 || $iuranTmp == '8') {
	    			$iuranTmp2 = 40000;
	    		}elseif ($iuranTmp == 9 || $iuranTmp == '9') {
	    			$iuranTmp2 = 45000;
	    		}else {
	    			$iuranTmp2 = 50000;
	    		}
	    		$iuran->iuran = $iuranTmp2;
	    		$iuran->user_id = $member->id;
	    		$iuran->pertemuan_id = $pertemuan->id;
	    		$totalIuranTmp+=$iuranTmp2;
	    		if ($request->has('titip'.$member->id)) {
	    			$iuran->hadir = 0;
	    		}else{
	    			$iuran->hadir = 1;
	    		}
	    		$iuran->save();
	    	}

	    	if (!is_null($pertemuan->notulen)) {
	    		$pertemuan->total_iuran = $totalIuranTmp;
	    		$pertemuan->save();
	    	}
	    	$now = Carbon::now()->format('Y-m-d');
	    	$kas = Kas::where('sisa_saldo', '=', null)->first();
			if (!is_null($kas)) {
				$idTmp = $kas->id - 1;
				$kasPrev = Kas::where('id', $idTmp)->first();
				$kas->sisa_saldo = (int)$kasPrev->sisa_saldo + (int)$totalIuranTmp;
				$kas->save();

				$kas_flow = new Kasflow();
				$kas_flow->kas_id = $kas->id;
				$kas_flow->tanggal = $pertemuan->tanggal;
				$kas_flow->status = 1;
				$kas_flow->nominal = $totalIuranTmp;
				$kas_flow->keterangan = 'Iuran Rutin di tempat '.$pertemuan->tempat;
				$kas_flow->save();
			}else{
				$kas = new Kas();
				$kas->tanggal = $pertemuan->tanggal;
				$idTmp = $kas->id - 1;
				$kasPrev = Kas::orderBy('id', 'DESC')->first();
				$kas->sisa_saldo = (int)$kasPrev->sisa_saldo + (int)$totalIuranTmp;
				$kas->save();

				$kas_flow = new Kasflow();
				$kas_flow->kas_id = $kas->id;
				$kas_flow->tanggal = $pertemuan->tanggal;
				$kas_flow->status = 1;
				$kas_flow->nominal = $totalIuranTmp;
				$kas_flow->keterangan = 'iuran rutin di tempat '.$pertemuan->tempat;
				$kas_flow->save();
			}

			return redirect()->route('pertemuan.index')->with('sukses', 'Iuran berhasil ditambahkan');
    	}

    	return redirect()->route('home');
    }


    public function edit($id)
    {
    	if (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara') {
    		$pertemuan = Pertemuan::where('id', $id)->first();
    		if (is_null($pertemuan)) {
    			return redirect()->route('pertemuan.index')->with('gagal', 'Maaf pertemuan belum ada');
    		}
	    	$tglNow = Carbon::now()->format('Y-m-d');
	    	if ($tglNow > $pertemuan->tanggal) {
	    		return redirect()->route('pertemuan.index')->with('gagal', 'Maaf pertemuan sudah lewat');
	    	}
	    	$pertemuanIuran = $pertemuan->iurans;
	    	$iuranPrev = 0;
	    	foreach ($pertemuanIuran as $key => $pi) {
	    		$iuranPrev+=(int)$pi->iuran;
	    		$member = User::where('role_id', '!=', 1)
    						->where('is_active', 1)
    						->where('id', $pi->user_id)
	    				    ->first(['name']);
	    		$pi->nama_anggota = $member->name;
				$iurannya = null;
				$harusnya = null;
				$kekurangan = null;
				$iuranTmp = null;
	    		if ($pi->iuran == 5000 || $pi->iuran == '5000') {
		    		$iuranTmp = 1;
	    		}elseif ($pi->iuran == 10000 || $pi->iuran == '10000') {
	    			$iuranTmp = 2;
	    		}elseif ($pi->iuran == 15000 || $pi->iuran == '15000') {
	    			$iuranTmp = 3;
	    		}elseif ($pi->iuran == 20000 || $pi->iuran == '20000') {
	    			$iuranTmp = 4;
	    		}elseif ($pi->iuran == 25000 || $pi->iuran == '25000') {
	    			$iuranTmp = 5;
	    		}elseif ($pi->iuran == 30000 || $pi->iuran == '30000') {
	    			$iuranTmp = 6;
	    		}elseif ($pi->iuran == 35000 || $pi->iuran == '35000') {
	    			$iuranTmp = 7;
	    		}elseif ($pi->iuran == 40000 || $pi->iuran == '40000') {
	    			$iuranTmp = 8;
	    		}elseif ($pi->iuran == 45000 || $pi->iuran == '45000') {
	    			$iuranTmp = 9;
	    		}else {
	    			$iuranTmp = 10;
	    		}
	    		$pi->iuran = $iuranTmp;
				$iuranTmp = Iuran::where('user_id', $pi->user_id)->get(['iuran']);
				if (count($iuranTmp) > 0) {
					foreach ($iuranTmp as $key => $i_tmp) {
						$harusnya+=5000;
						$iurannya+=(int)$i_tmp->iuran;
					}
					$kekurangan = $harusnya - $iurannya;
				}else{
					$kekurangan = 5000;
				}
				$pi->kekurangannya = $kekurangan;
	    	}
	    	return view('member.bendahara.edit', [
					'pertemuan' => $pertemuan,
					'pertemuanIuran' => $pertemuanIuran,
					'iuranPrev' => $iuranPrev,
				]);
    	}
    	return redirect()->route('home');
    }


    public function update(Request $request, $id)
    {
    	if (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara') {
    		$tglNow = Carbon::now()->format('Y-m-d');
    		$pertemuan = Pertemuan::where('id', $id)->first();
    		$iuranPertemuan = Iuran::where('pertemuan_id',$pertemuan->id)->get();
    		$kas_flow = Kasflow::where([
    			'tanggal' => $tglNow,
    			'status' => 1,
    			'nominal' => $request->kas_prev,
    			'keterangan' => 'iuran rutin di tempat '.$pertemuan->tempat,
    		])->first();
    		$totalIuranTmp = null;
    		foreach ($iuranPertemuan as $key => $ip) {
	    		$iuranTmp = null;
	    		$iuranTmp2 = null;
	    		$iuranTmp = $request->get('iuran'.$ip->user_id);
	    		if ($iuranTmp == 1 || $iuranTmp == '1') {
		    		$iuranTmp2 = 5000;
	    		}elseif ($iuranTmp == 2 || $iuranTmp == '2') {
	    			$iuranTmp2 = 10000;
	    		}elseif ($iuranTmp == 3 || $iuranTmp == '3') {
	    			$iuranTmp2 = 15000;
	    		}elseif ($iuranTmp == 4 || $iuranTmp == '4') {
	    			$iuranTmp2 = 20000;
	    		}elseif ($iuranTmp == 5 || $iuranTmp == '5') {
	    			$iuranTmp2 = 25000;
	    		}elseif ($iuranTmp == 6 || $iuranTmp == '6') {
	    			$iuranTmp2 = 30000;
	    		}elseif ($iuranTmp == 7 || $iuranTmp == '7') {
	    			$iuranTmp2 = 35000;
	    		}elseif ($iuranTmp == 8 || $iuranTmp == '8') {
	    			$iuranTmp2 = 40000;
	    		}elseif ($iuranTmp == 9 || $iuranTmp == '9') {
	    			$iuranTmp2 = 45000;
	    		}else {
	    			$iuranTmp2 = 50000;
	    		}
	    		$ip->iuran = $iuranTmp2;
	    		$totalIuranTmp+=$iuranTmp2;
	    		if ($request->has('titip'.$ip->user_id)) {
	    			$ip->hadir = 0;
	    		}else{
	    			$ip->hadir = 1;
	    		}
	    		$ip->save();
	    	}
	    	// end loop for update iuran
	    	if (!is_null($pertemuan->notulen)) {
	    		$pertemuan->total_iuran = $totalIuranTmp;
	    		$pertemuan->save();
	    	}
	    	$tmpKas = null;
	    	$kas = Kas::where('id', $kas_flow->kas_id)->first();
	    	$kas_flow->nominal = $totalIuranTmp;
	    	$kas_flow->save();
	    	$kasLast = Kas::orderBy('id', 'DESC')->first();
	    	$jumKas = $kasLast->id - $kas->id;
	    	if ($jumKas > 0) {
	    		$tmpKas = (int)$kas->sisa_saldo - (int)$request->kas_prev + (int)$totalIuranTmp;
	    		$kas->sisa_saldo = $tmpKas;
	    		$kas->save();
	    		$i = 1;
	    		for ($x = 0; $x <$jumKas; $x++) {
	    			$ID = (int)$kas->id+=$i;
	    			$nextKas = Kas::where('id', $ID)->first();
	    			$tmpKas = (int)$nextKas->sisa_saldo - (int)$request->kas_prev + (int)$totalIuranTmp;
		    		$nextKas->sisa_saldo = $tmpKas;
		    		$nextKas->save();
		    		$i++;
				}
	    	}else{
	    		$tmpKas = (int)$kas->sisa_saldo - (int)$request->kas_prev + (int)$totalIuranTmp;
	    		$kas->sisa_saldo = $tmpKas;
	    		$kas->save();
	    	}
	    	return redirect()->route('pertemuan.index')->with('sukses', 'Iuran berhasil diupdate');
    	}
    	return redirect()->route('home');
    }
}
