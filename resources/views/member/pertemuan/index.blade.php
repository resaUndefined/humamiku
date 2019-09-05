@extends('layouts.member.base')

@section('title', 'Manajemen Pertemuan')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manajemen Pertemuan <small>HUMAMIKU</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <br>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        @if (count($pertemuans) > 0)
                          @if (is_null($pertemuanCek) && (Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris'))
                            <a href="{{ route('pertemuan.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Pertemuan Berikutnya</a>
                          @elseif(!is_null($pertemuanCek))
                            @if (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara')
                              <a href="{{ route('iuran.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Iuran</a>
                            @elseif((Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris') && (is_null($pertemuanCek->notulen)))
                              <a href="{{ route('notulen.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Notulen</a>
                            @endif
                          @endif
                        @elseif(count($pertemuans) == 0 && (Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris'))
                          <a href="{{ route('pertemuan.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Pertemuan Berikutnya</a>
                        @endif
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(Session::has('gagal'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Gagal!</strong> {{ Session::get('gagal') }}
                      </div>
                    @endif
                    @if(Session::has('sukses'))
                      <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{ Session::get('sukses') }}
                      </div>
                    @endif
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="th-table">No</th>
                          <th class="th-table">Tempat</th>
                          <th class="th-table">Tanggal</th>
                          <th class="th-table">Total Iuran</th>
                          <th class="th-table">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($pertemuans) > 0)
                          @foreach ($pertemuans as $key => $pertemuan)
                            <tr>
                              <th scope="row" class="col-md-1">{{ $pertemuans->firstItem() + $key }}</th>
                              <td>{{ $pertemuan->tempat }}</td>
                              <td>{{ $pertemuan->tanggal }}</td>
                              @if (is_null($pertemuan->total_iuran))
                                <td> - </td>
                              @else
                                <td>@currency($pertemuan->total_iuran)</td>
                              @endif
                              <td class="col-md-3">
                                <a href="{{ route('pertemuan.show', $pertemuan->id) }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-eye"></i> View</a>
                                <a @if (Auth::user()->jabatan->jabatan == 'Sekretaris' || Auth()->user()->jabatan->jabatan == 'sekretaris' || Auth()->user()->jabatan->jabatan == 'Sekertaris' || Auth()->user()->jabatan->jabatan == 'sekertaris')
                                  href="{{ route('pertemuan.edit', $pertemuan->id) }}"
                                @else
                                  href="{{ route('iuran.edit', $pertemuan->id) }}"
                                  @if ($tglNow > $pertemuan->tanggal)
                                    onclick="return false;"
                                    disabled
                                  @endif
                                @endif type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$pertemuan->id}})" 
                                    data-target="#DeleteModal" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                    
                    @if (count($pertemuans) > 0)
                      <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div>Menampilkan {{ $pertemuans->firstItem() }} sampai {{ $pertemuans->lastItem() }} dari total {{ $pertemuans->total() }} pertemuan</div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                        <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            {{ $pertemuans->links() }}
                          </div>
                      </div>
                    </div>
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection