@extends('layouts.member.base')

@section('title', 'Tambah Notulen')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tambah Notulen <small>HUMAMIKU</small></h3>
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
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Tambah Notulen <small>Manajemen Pertemuan</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('notulen.store') }}" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pertemuan</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                                  <span>Di Tempat <span class="place">{{ $pertemuan->tempat }}</span></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <span class="place">{{ date('d F Y', strtotime($pertemuan->tanggal)) }}</span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Notulen <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <textarea name="notulen"></textarea>
                                </div>
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <a href="show_pertemuan.html" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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
              </div>
            </div>
          </div>
        </div>
@endsection