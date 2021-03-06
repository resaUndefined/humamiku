@extends('layouts.admin.base')

@section('title', 'Edit User')

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
                    <h2>Edit User <small>Manajemen User</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if ($errors->has('password'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('password') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('email'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('email') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('jabatan'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('jabatan') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('role'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('role') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('gender'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('gender') }}</strong>
                      </div>
                    @endif
                    @if ($errors->has('kekurangan_iuran'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ $errors->first('kekurangan_iuran') }}</strong>
                      </div>
                    @endif
                    @if(Session::has('gagal'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Gagal!</strong> {{ Session::get('gagal') }}
                      </div>
                    @endif
                    <form id="add-role" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('users.update', $userData->id) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="role" required="">
                              <option value="">-- Pilih role --</option>
                              @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                  <option value="{{ $role->id }}" @if ($userData->role_id == $role->id)
                                    selected="" 
                                  @endif>{{ $role->role_name }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="status" required="">
                              <option value="">-- Pilih status --</option>
                              <option value="1" @if ($userData->is_active == 1)
                                selected="" 
                              @endif>Aktif</option>
                              <option value="0" @if ($userData->is_active == 0)
                                selected="" 
                              @endif>Tidak Aktif</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12" value="{{ $userData->name }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $userData->email }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="jabatan" required="">
                              <option value="">-- Pilih jabatan --</option>
                              @if (count($jabatans) > 0)
                                @foreach ($jabatans as $jabatan)
                                  <option value="{{ $jabatan->id }}" @if ($userData->jabatan_id == $jabatan->id)
                                    selected="" 
                                  @endif>{{ $jabatan->jabatan }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="gender" required="">
                              <option value="">-- Pilih jenis kelamin --</option>
                              <option value="1" @if ($userData->jk == 1)
                                selected="" 
                              @endif>Laki-Laki</option>
                              <option value="0" @if ($userData->jk == 0)
                                selected="" 
                              @endif>Perempuan</option>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">TTL <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3" name="ttl" value="{{ $userData->ttl }}">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kekurangan Iuran
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="kekurangan_iuran" name="kekurangan_iuran" class="form-control col-md-7 col-xs-12" value="{{ $userData->kekurangan_iuran }}">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('users.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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