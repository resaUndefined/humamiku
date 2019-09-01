@extends('layouts.admin.base')

@section('title', 'Edit Role')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manajemen Role <small>HUMAMIKU</small></h3>
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
                    <h2>Edit Role <small>Manajemen Role</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(Session::has('gagal'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Gagal!</strong> {{ Session::get('gagal') }}
                      </div>
                    @endif
                    <form id="add-role" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('roles.update', $role->id) }}">
                        {{ csrf_field() }}
                      <input name="_method" type="hidden" value="PUT">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="role" name="role" required="required" class="form-control col-md-7 col-xs-12" value="{{ $role->role_name }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Level <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="level" required="">
                            <option value="">-- Pilih Level --</option>
                            <option value="2" @if ($role->level == 2)
                              selected
                            @endif>Staff</option>
                            <option value="3" @if ($role->level == 3)
                              selected
                            @endif>Member</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('roles.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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