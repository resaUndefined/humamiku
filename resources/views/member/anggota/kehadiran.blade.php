@extends('layouts.member.base')

@section('title', 'Check Kehadiran')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Check Kehadiran <small>HUMAMIKU</small></h3>
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
                    <h2>Check Kehadiran <small>Manajemen Kehadiran</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-10 col-md-offset-1">
                      <h2 style="text-align: justify;"><strong>Keterangan :</strong></h2>
                      <h6 style="text-align: justify;"><span class="label label-success">Jumlah Kehadiran</span> : <strong>{{ $hadir }} kali</strong></h6>
                      <h6 style="text-align: justify;"><span class="label label-danger">Tidak Hadir</span> : <strong>{{ $tidakHadir }} kali</strong></h6><br>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="th-table col-md-1">No</th>
                            <th class="th-table col-md-3">Tanggal</th>
                            <th class="th-table col-md-3">Pertemuan</th>
                            <th class="th-table col-md-3">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($iurans as $key => $pi)
                            <tr>
                              <td scope="row" class="col-md-1">{{ $iurans->firstItem() + $key }}</td>
                              <td class="col-md-3">{{ date('d F Y', strtotime($pi->tanggal)) }}</td>
                              <td class="col-md-3">{{ $pi->tempat }}</td>
                              <td class="col-md-3">
                                @if ($pi->hadir == 1 OR $pi->hadir == '1')
                                  <span class="label label-success">Hadir</span>
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
                        <div>Menampilkan {{ $iurans->firstItem() }} sampai {{ $iurans->lastItem() }} dari total {{ $iurans->total() }} pertemuan</div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                        <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            {{ $iurans->links() }}
                          </div>
                      </div>
                    </div>
                    <br>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-left">
                          <a href="{{ route('home') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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