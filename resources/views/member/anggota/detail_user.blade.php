@extends('layouts.member.base')

@section('title', 'Detail User')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Detail User <small>HUMAMIKU</small></h3>
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
                    <h2>Detail User <small>Manajemen User</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ $user->name }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ $user->email }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ $user->jabatan }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          @if ($user->jk == 1)
                            <span>Laki-Laki</span>
                          @else
                            <span>Perempuan</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ date('d F Y', strtotime($user->ttl)) }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          @if ($user->is_active == 1)
                            <span class="label label-primary">Aktif</span>
                          @else
                            <span class="label label-danger">Tidak Aktif</span>
                          @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('list.user') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                        </div>
                      </div>

                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection