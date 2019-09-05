@extends('layouts.member.base')

@section('title', 'Tambah Iuran')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tambah Iuran <small>HUMAMIKU</small></h3>
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
                            <h2>Tambah Iuran <small>Manajemen Kas</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <h2 class="text-center" style="margin-bottom: 30px;">Iuran Rutin Tanggal <strong>{{ date('d F Y', strtotime($pertemuan->tanggal)) }}</strong>, di tempat <strong> {{ $pertemuan->tempat }}</strong></h2>
                          <div class="clearfix"></div>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('iuran.store') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                      @foreach ($members as $member)
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12">{{ $member->name }} : </label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control" required="" name="iuran{{ $member->id }}">
                              <option value="">--Nominal--</option>
                              <option value="1">Rp 5.000</option>
                              <option value="2">Rp 10.000</option>
                              <option value="3">Rp 15.000</option>
                              <option value="4">Rp 20.000</option>
                              <option value="5">Rp 25.000</option>
                              <option value="6">Rp 30.000</option>
                              <option value="7">Rp 35.000</option>
                              <option value="8">Rp 40.000</option>
                              <option value="9">Rp 45.000</option>
                              <option value="10">Rp 50.000</option>
                            </select>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" class="flat" name="titip{{ $member->id }}"> Titip?
                              </label>
                            </div>
                          </div>
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Seharusnya : @currency($member->kekurangannya)</label>
                        </div>
                      @endforeach
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
              </div>
            </div>
          </div>
        </div>
@endsection