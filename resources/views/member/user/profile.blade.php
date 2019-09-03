@extends('layouts.member.base')

@section('title', 'Manajemen Profile')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manajemen Profile <small>HUMAMIKU</small></h3>
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
                    <h2>Manajemen Profile</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if ($errors->has('password'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('password') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('password_confirmation'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('email'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('email') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('gender'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('gender') }}</strong>
                      </div>
                    @endif
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
                    <form id="add-role" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('member.profile_update') }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            @if ($profile->is_active == 1)
                              <span class="label label-success">Aktif</span>
                            @else
                              <span class="label label-danger">Tidak Aktif</span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text"  class="form-control col-md-7 col-xs-12" value="{{ $profile->jabatan }}" disabled="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12" value="{{ $profile->name }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $profile->email }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Konfirmasi Password</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="gender" required="">
                              <option value="">-- Pilih jenis kelamin --</option>
                              <option value="1" @if ($profile->jk == 1)
                                selected="" 
                              @endif>Laki-Laki</option>
                              <option value="0" @if ($profile->jk == 0)
                                selected="" 
                              @endif>Perempuan</option>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">TTL <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3" name="ttl" value="{{ $profile->ttl }}">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('member') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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