@extends('layouts.member.base')

@section('title', 'kas Flow')

@section('content')
  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tambah Kas Flow <small>HUMAMIKU</small></h3>
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
                            <h2>Tambah Kas Flow <small>Manajemen Kas</small></h2>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            @if(Session::has('gagal'))
                              <div class="alert alert-warning alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Gagal!</strong> {{ Session::get('gagal') }}
                              </div>
                            @endif
                            <form id="form1" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kasflow.store') }}">
                              {{ csrf_field() }}
                              <div class="table-responsive">
                                <table class="table table-bordered" id="item_table">
                                  <tr>
                                    <th style="vertical-align: middle;">Nominal</th>
                                    <th style="vertical-align: middle;">Jenis</th>
                                    <th style="vertical-align: middle;">Keterangan</th>
                                    <th style="vertical-align: middle;"><button type="button" name="add" class="add btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                                  </tr>
                                </table>
                              </div>
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <a href="{{ route('kasflow.list') }}" type="button" class="btn btn-primary"><i class="fa fa-rotate-left"></i> Kembali</a>
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