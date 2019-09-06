@extends('layouts.admin.base')

@section('title', 'Dashboard')

@section('content')
	<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
      <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count">
        <span class="count_top"><i class="fa fa-comments-o"></i> Pertemuan Berikutnya</span>
        @if (!is_null($nextPertemuan))
          <div class="count">{{ date('d F Y', strtotime($nextPertemuan->tanggal)) }}</div>
        <span class="count_bottom"><i class="fa fa-chevron-circle-right"></i> Tempat <strong>{{ $nextPertemuan->tempat }}</strong></span>
        @endif
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 tile_stats_count">
        {{-- <a href="{{ route('notulen.show', $prevPertemuan->id) }}"> --}}
          <span class="count_top"><i class="fa fa-dollar"></i> Total Iuran</span>
          <div class="count">@currency($prevPertemuan->total_iuran)</div>
          <span class="count_bottom"><i class="fa fa-chevron-circle-right"></i> Dari Pertemuan Sebelumnya</span>
        {{-- </a>   --}}
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Total KAS</span>
        <div class="count">@currency($kas->sisa_saldo)</div>
        <span class="count_bottom"><i class="fa fa-chevron-circle-right"></i> Sampai Saat Ini</span>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> User Aktif</span>
        <div class="count">{{ $users }}</div>
        <span class="count_bottom"><i class="fa fa-chevron-circle-right"></i> Saat Ini</span>
      </div>
    </div>
    <!-- /top tiles -->

    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Rangkuman 5 Iuran Terakhir</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @for ($i = 0; $i <5 ; $i++)
              <div class="widget_summary">
                <div class="w_left w_25" style="width:35%;">
                  <span>@if ($tglArr[$i] != '-')
                    {{ date('d F Y', strtotime($tglArr[$i])) }}
                    @else
                    -
                  @endif</span>
                </div>
                <div class="w_center w_55" style="width:65%;">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $persenIur[$i] }}%;">
                        <span>@currency($iurArr[$i])</span>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            @endfor
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Anggota HUMAMIKU AKTIF</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table class="" style="width:100%">
                    <tbody><tr>
                      <th style="width:37%;">
                      </th>
                      <th>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                          <p class="">Jenis Kelamin</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm- col-xs-12">
                          <p class="">Jumlah</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1Rwp5n5Gm33Ec5nna5f4bprvsyCRX5R9EbdWoHGNvW-okYclk" width="80%">
                      </td>
                      <td>
                        <table class="tile_info">
                          <tbody>
                            <tr>
                                <td>
                                  <p>Laki-Laki </p>
                                </td>
                                <td>{{ $laki }}</td>
                            </tr>
                            <tr>
                                <td>
                                  <p>Perempuan</p>
                                </td>
                                <td>{{ $perempuan }}</td>
                            </tr>
                        </tbody></table>
                      </td>
                    </tr>
                  </tbody></table>
                  </div>
                </div>
      </div>
    </div>
  </div>
@endsection