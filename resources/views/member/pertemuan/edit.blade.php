@extends('layouts.member.base')

@section('title', 'Edit Pertemuan')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Pertemuan <small>HUMAMIKU</small></h3>
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
                    <h2>Edit Notulen <small>Manajemen Pertemuan</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(Session::has('gagal'))
                      <div class="alert alert-warning alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Gagal!</strong> {{ Session::get('gagal') }}
                      </div>
                    @endif
                    <form id="add-role" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('pertemuan.update', $pertemuan->id) }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="tempat" name="tempat" required="required" class="form-control col-md-7 col-xs-12" value="{{ $pertemuan->tempat }}">
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status3" name="tanggal">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Iuran : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          @if (is_null($pertemuan->total_iuran))
                            <span> - </span>
                          @else
                            <span>@currency($pertemuan->total_iuran)</span>
                          @endif
                        </div>
                      </div>
                      @if (!is_null($pertemuan->notulen))
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Notulen <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="notulen" value="{!! $pertemuan->notulen !!}"></textarea>
                          </div>
                        </div>
                      @endif
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('pertemuan.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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