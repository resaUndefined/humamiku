@extends('layouts.member.base')

@section('title', 'List User')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manajemen User <small>HUMAMIKU</small></h3>
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
                    <!-- <h2>Hover rows <small>Try hovering over the rows</small></h2> -->
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        @if(Session::has('gagal'))
                          <div class="alert alert-warning alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Gagal!</strong> {{ Session::get('gagal') }}
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="th-table">No</th>
                          <th class="th-table">Nama</th>
                          <th class="th-table">Email</th>
                          <th class="th-table">Role</th>
                          <th class="th-table">Jabatan</th>
                          <th class="th-table">Status</th>
                          <th class="th-table">Action</th>
                        </tr>
                      </thead>
                      @if (count($users) > 0)
                        <tbody>
                          @foreach ($users as $key => $user)
                            <tr>
                              <th scope="row" class="col-md-1">{{ $users->firstItem() + $key }}</th>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->role }}</td>
                              @if (is_null($user->jabatan))
                                <td> - </td>
                              @else
                                <td>{{ $user->jabatan }}</td>
                              @endif
                              @if ($user->is_active == 1)
                                <td><i class="fa fa-check"> Aktif</i></td>
                              @else
                                <td><i class="fa fa-close"> Tidak Aktif</i></td>
                              @endif
                              <td class="col-md-2">
                                <a href="{{ route('detail.user', $user->id) }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-eye"></i>Detail</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      @endif
                    </table>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div>Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari total {{ $users->total() }} user</div>
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

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection