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

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ((Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris') || (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara')) {
            
            $pertemuans = Pertemuan::orderBy('created_at', 'DESC')->paginate(10);
            $pertemuanCek = Pertemuan::whereNull('total_iuran')->first();
            $tglNow = Carbon::now()->format('Y-m-d');
            return view('member.pertemuan.index', [
                'pertemuans' => $pertemuans,
                'pertemuanCek' => $pertemuanCek,
                'tglNow' => $tglNow,
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pertemuanCek = Pertemuan::whereNull('total_iuran')->first();
        if (Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris') {
            if (is_null($pertemuanCek)) {
                return view('member.pertemuan.create');
            }
            return redirect()->route('pertemuan.index')->with('gagal', 'Maaf saat ini masih perkumpulan');
        }
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tglNow = Carbon::now()->format('Y-m-d');
        preg_match_all('!\d+!', $request->tanggal, $tanggal);
        $reqTanggal = $tanggal[0][2].'-'.$tanggal[0][0].'-'.$tanggal[0][1];
        if ($reqTanggal < $tglNow) {
            return redirect()->route('pertemuan.create')->with('gagal', 'Maaf tanggal sudah lewat');
        }
        $pertemuan = new Pertemuan();
        $pertemuan->tempat = $request->tempat;
        $pertemuan->tanggal = $reqTanggal;
        $pertemuanSave = $pertemuan->save();
        if ($pertemuanSave) {
            return redirect()->route('pertemuan.index')->with('sukses', 'Pertemuan berhasil ditambahkan');
        }
        return redirect()->route('pertemuan.index')->with('gagal', 'Pertemuan gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris') || (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara')) {
            $pertemuan = Pertemuan::where('id', $id)->first();
            if (is_null($pertemuan)) {
                return redirect()->route('pertemuan.index')->with('gagal', 'Maaf pertemuan tidak ditemukan');
            }
            $iurans = Iuran::where('id', $id)->get();

            return view('member.pertemuan.show', [
                'pertemuan' => $pertemuan,
                'iurans' => $iurans,
            ]);
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
