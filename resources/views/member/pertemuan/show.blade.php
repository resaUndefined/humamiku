@extends('layouts.member.base')

@section('title', 'Lihat Pertemuan')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lihat Pertemuan <small>HUMAMIKU</small></h3>
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
                    <h2>Lihat Pertemuan <small>Manajemen Pertemuan</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ $pertemuan->tempat }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          <span>{{ date('d F Y', strtotime($pertemuan->tanggal)) }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Notulen : </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                          @if (is_null($pertemuan->notulen))
                            <span> - </span>
                          @else
                            <span>{!! $pertemuan->notulen !!}</span>
                          @endif
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
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{ route('pertemuan.index') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
                          @if (!is_null($pertemuan->total_iuran))
                            <a href="#" type="button" class="btn btn-info"><i class="fa fa-money"></i> Cek Iuran</a>
                          @endif
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