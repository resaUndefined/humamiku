@extends('layouts.member.base')

@section('title', 'Manajemen Kehadiran')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manajemen Kehadiran <small>HUMAMIKU</small></h3>
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
                    <h2>Manajemen Kehadiran <small>Manajemen Kehadiran</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-10 col-md-offset-1">
                      <h2 style="text-align: justify;"><strong>Keterangan :</strong></h2>
                      <h6 style="text-align: justify;"><span class="label label-success">Hadir</span></h6>
                      <h6 style="text-align: justify;"><span class="label label-danger">Tidak Hadir</span></h6>
                      <h6 style="text-align: justify;"><span class="label label-info">Jumlah Pertemuan</span></h6><br>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="th-table col-md-1">No</th>
                            <th class="th-table col-md-2">Nama</th>
                            <th class="th-table col-md-2">Hadir</th>
                            <th class="th-table col-md-2">Tidak Hadir</th>
                            <th class="th-table col-md-2">Pertemuan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (count($users) > 0)
                            @foreach ($users as $key => $u)
                            <tr>
                                <td scope="row" class="col-md-1">{{ $users->firstItem() + $key }}</td>
                                <td class="col-md-2"><a href="{{ route('kehadiran.show', $u->id) }}">{{ $u->name }}</a></td>
                                <td class="col-md-2"><span class="label label-success">{{ $u->hadir }} kali</span></td>
                                <td class="col-md-2"><span class="label label-danger">{{ $u->tidakHadir }} kali</span></td>
                                <td class="col-md-2"><span class="label label-info">{{ $u->pertemuan }} kal</span></td>
                              </tr>
                            @endforeach
                            </tbody>
                              </table>
                            </div>
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                <div>Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari total {{ $users->total() }} users</div>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 pull-right">
                                <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                    {{ $users->links() }}
                                  </div>
                              </div>
                            </div>
                          @endif
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