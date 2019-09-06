<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatans = Jabatan::paginate(5);

        return view('admin.jabatan.index', [
            'jabatans' => $jabatans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatan = new Jabatan();
        $jabatan->jabatan = $request->jabatan;
        $jabatanSave = $jabatan->save();
        if ($jabatanSave) {
            return redirect()->route('jabatan.index')->with('sukses', 'Jabatan berhasil ditambahkan');
        }
        return redirect()->route('jabatan.create')->with('gagal', 'Jabatan gagal ditambahkan');
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
        $jabatan = Jabatan::where('id', $id)->first();
        if (!is_null($jabatan)) {
            return view('admin.jabatan.edit', [
                'jabatan' => $jabatan
            ]);
        }
        return redirect()->route('jabatan.index')->with('gagal', 'Maaf jabatan tidak ada');
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
        $jabatan = Jabatan::where('id',$id)->first();
        if (!is_null($jabatan)) {
            $jabatan->jabatan = $request->jabatan;
            $jabatanUpdate = $jabatan->save();
            if ($jabatanUpdate) {
                return redirect()->route('jabatan.index')->with('sukses', 'Jabatan berhasil diupdate');
            }
            return redirect('/jabatan/$id/edit')->with('gagal', 'Jabatan gagal diupdate');
        }
        return redirect('/jabatan/$id/edit')->with('gagal', 'Jabatan tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::where('id',$id)->first();
        if ($jabatan) {
            $jabatan->delete();
            return redirect()->route('jabatan.index')->with('sukses', 'Jabatan berhasil dihapus');
        }
        return redirect()->route('jabatan.index')->with('gagal', 'Jabatan tidak ditemukan');
    }
}
