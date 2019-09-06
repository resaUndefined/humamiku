@extends('layouts.member.base')

@section('title', 'Lihat Iuran')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lihat Iuran <small>HUMAMIKU</small></h3>
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
                    <h2>Lihat Iuran <small>Manajemen Iuran</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-10 col-md-offset-1">
                      <h2 style="text-align: justify;">Pertemuan tanggal <strong>{{ date('d F Y', strtotime($pertemuan->tanggal)) }}</strong> di termpat <strong>{{ $pertemuan->tempat }}</strong></h2>
                      <h2 style="text-align: justify;">Total Iuran : <strong>@currency($pertemuan->total_iuran)</strong></h2>
                      {{-- <h4 style="text-align: right;"><strong>Jumlah : </strong></h4> --}}
                      <h6 style="text-align: right;"><span class="label label-success">Hadir</span> : <strong>{{ $hadir }}</strong></h6>
                      <h6 style="text-align: right;"><span class="label label-warning">Nitip</span> : <strong>{{ $nitip }}</strong></h6>
                      <h6 style="text-align: right;"><span class="label label-danger">Tidak Hadir + Tidak Nitip</span> : <strong>{{ $tidakHadir }}</strong></h6><br>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="th-table col-md-1">No</th>
                            <th class="th-table col-md-3">Anggota</th>
                            <th class="th-table col-md-3">Iuran</th>
                            <th class="th-table col-md-3">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($pertemuanIuran as $key => $pi)
                            <tr>
                              <td scope="row" class="col-md-1">{{ $pertemuanIuran->firstItem() + $key }}</td>
                              <td class="col-md-3">{{ $pi->anggota }}</td>
                              <td class="col-md-3">@if ($pi->iuran == 0 OR $pi->iuran == '0')
                                -
                              @else
                                @currency($pi->iuran)
                              @endif</td>
                              <td class="col-md-3">
                                @if ($pi->hadir == 1 OR $pi->hadir == '1')
                                  <span class="label label-success">Hadir</span>
                                @elseif($pi->hadir == 0 OR $pi->hadir == '0')
                                  <span class="label label-warning">Titip</span>
                                @else
                                  <span class="label label-danger">Tidak Hadir</span>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div>Menampilkan {{ $pertemuanIuran->firstItem() }} sampai {{ $pertemuanIuran->lastItem() }} dari total {{ $pertemuanIuran->total() }} iuran</div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                        <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            {{ $pertemuanIuran->links() }}
                          </div>
                      </div>
                    </div>
                    <br>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-left">
                          <a href="{{ route('pertemuan.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection