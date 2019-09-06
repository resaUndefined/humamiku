@extends('layouts.member.base')

@section('title', 'Manajemen kas Flow')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>List Kas Flow <small>HUMAMIKU</small></h3>
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
                            @if (Auth::user()->jabatan->jabatan == 'Bendahara' || Auth::user()->jabatan->jabatan == 'bendahara')
                              <a href="{{ route('kasflow.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Cash Flow</a>
                            @endif
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            @if(Session::has('gagal'))
                              <div class="alert alert-warning alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Gagal!</strong> {{ Session::get('gagal') }}
                              </div>
                            @endif
                            <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="th-table">No</th>
                            <th class="th-table">Tanggal</th>
                            <th class="th-table">Keterangan</th>
                            <th class="th-table">Kredit</th>
                            <th class="th-table">Debit</th>
                            <th class="th-table">Saldo</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $key => $d)
                            <tr>
                              <td scope="row" class="col-md-1">{{ $key+1 }}</td>
                              <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
                              <td>@if ($d->status == 2 || $d->status == '2')
                                <strong>{{ $d->keterangan }}</strong>
                              @else
                                {{ $d->keterangan }}
                              @endif</td>
                              @if ($d->status == 0 || $d->status == '0')
                                <td>@currency($d->nominal)</td>
                                <td>-</td>
                                <td>-</td>
                              @elseif($d->status == 1 || $d->status == '1')
                                <td>-</td>
                                <td>@currency($d->nominal)</td>
                                <td>-</td>
                              @else
                                <td>-</td>
                                <td>-</td>
                                <td>@currency($d->nominal)</td>
                              @endif
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <a href="{{ route('download.kas') }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-download"></i> Lihat Selengkapnya</a>
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
            </div>
          </div>
        </div>
        <script>
      // $('.add').on('click', add);
      // $('.remove').on('click', remove);
      
      $(document).ready(function(){
        $(document).on('click', '.add', function() {
          var html = '';
          html += '<tr>';
          html += '<td><input type="text" name="item_nominal[]" class="form-control item_nominal" required=""></td>';
          html += '<td><select name="item_jenis[]" class="form-control item_jenis" required=""><option>--Jenis--</option><option value="1">Pemasukan</option><option value="0">Pengeluaran</option></select></td>';
          html += '<td><input type="text" name="item_ket[]" class="form-control item_ket" required=""></td>';
          html += '<td><button type="button" name="remove" class="remove btn btn-round btn-danger btn-sm"><i class="fa fa-minus"></i></button></td></tr>';
          $('#item_table').append(html);
        });

        $(document).on('click', '.remove', function(){
          $(this).closest('tr').remove();
        });
      });
    </script>
@endsection