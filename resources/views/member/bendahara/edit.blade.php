@extends('layouts.member.base')

@section('title', 'Edit Iuran')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Iuran <small>HUMAMIKU</small></h3>
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
                            <h2>Edit Iuran <small>Manajemen Kas</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <h2 class="text-center" style="margin-bottom: 30px;">Iuran Rutin Tanggal <strong>{{ date('d F Y', strtotime($pertemuan->tanggal)) }}</strong>, di tempat <strong> {{ $pertemuan->tempat }}</strong></h2>
                          <div class="clearfix"></div>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('iuran.update', $pertemuan->id) }}" method="post">
                      {{ csrf_field() }}
                      <input name="_method" type="hidden" value="PUT">
                      <input type="hidden" name="pertemuan" value="{{ $pertemuan->id }}">
                      <input type="hidden" name="kas_prev" value="{{ $iuranPrev }}">
                      @foreach ($pertemuanIuran as $pi)
                        <div class="form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12">{{ $pi->nama_anggota }} : </label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control" required="" name="iuran{{ $pi->user_id }}">
                              <option value="0" @if ($pi->iuran == 0)
                                selected="" 
                              @endif>--Nominal--</option>
                              <option value="1" @if ($pi->iuran == 1)
                                selected="" 
                              @endif>Rp 5.000</option>
                              <option value="2" @if ($pi->iuran == 2)
                                selected="" 
                              @endif>Rp 10.000</option>
                              <option value="3" @if ($pi->iuran == 3)
                                selected="" 
                              @endif>Rp 15.000</option>
                              <option value="4" @if ($pi->iuran == 4)
                                selected="" 
                              @endif>Rp 20.000</option>
                              <option value="5" @if ($pi->iuran == 5)
                                selected="" 
                              @endif>Rp 25.000</option>
                              <option value="6" @if ($pi->iuran == 6)
                                selected="" 
                              @endif>Rp 30.000</option>
                              <option value="7" @if ($pi->iuran == 7)
                                selected="" 
                              @endif>Rp 35.000</option>
                              <option value="8" @if ($pi->iuran == 8)
                                selected="" 
                              @endif>Rp 40.000</option>
                              <option value="9" @if ($pi->iuran == 9)
                                selected="" 
                              @endif>Rp 45.000</option>
                              <option value="10" @if ($pi->iuran == 10)
                                selected="" 
                              @endif>Rp 50.000</option>
                            </select>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" class="flat" name="titip{{ $pi->user_id }}" @if ($pi->hadir == 0)
                                  checked="" 
                                @endif> Titip?
                              </label>
                            </div>
                          </div>
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 {{ $pi->warna }}" style="color: #fff; font-weight: bold;">{{ $pi->text }} : @currency($pi->kekurangannya)</label>
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