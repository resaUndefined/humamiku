@extends('layouts.member.base')

@section('title', 'List Pertemuan')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>List Pertemuan <small>HUMAMIKU</small></h3>
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
                  <div class="x_content">
                    @if(Session::has('gagal'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Gagal!</strong> {{ Session::get('gagal') }}
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
                                @if (!is_null($pertemuan->notulen))
                                  <a href="{{ route('notulen.show', $pertemuan->id) }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-eye"></i> Lihat Notulen</a>
                                @endif
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