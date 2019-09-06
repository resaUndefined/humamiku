@extends('layouts.admin.base')

@section('title', 'List Role')

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
                    <!-- <h2>Hover rows <small>Try hovering over the rows</small></h2> -->
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <a href="{{ route('roles.create') }}" type="button" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Role</a>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        @if(Session::has('sukses'))
                          <div class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ Session::get('sukses') }}
                          </div>
                        @endif
                        @if(Session::has('gagal'))
                          <div class="alert alert-warning alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Gagal!</strong> {{ Session::get('gagal') }}
                          </div>
                        @endif
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="th-table">No</th>
                          <th class="th-table">Role</th>
                          <th class="th-table">Level</th>
                          <th class="th-table">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $key => $role)
                          <tr>
                            <th scope="row" class="col-md-1">{{ $key+1 }}</th>
                            <td class="col-md-4">{{ $role->role_name }}</td>
                            <td class="col-md-4">{{ $role->level }}</td>
                            <td class="col-md-2">
                              <a href="{{ route('roles.edit', $role->id) }}" type="button" class="btn btn-round btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                              <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$role->id}})" 
                                  data-target="#DeleteModal" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    {{-- div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <div>Showing 1 to 10 of 57 entries</div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <div style="margin-top: -25px; margin-bottom: -15px;" class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                            <ul class="pagination">
                              <li class="paginate_button previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0">Previous</a></li>
                              <li class="paginate_button active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0">1</a></li>
                              <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0">2</a></li>
                              <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0">3</a></li>
                              <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0">4</a></li>
                              <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0">5</a></li>
                              <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0">6</a></li>
                              <li class="paginate_button next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0">Next</a></li>
                            </ul>
                          </div>
                      </div>
                    </div> --}}

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="DeleteModal" class="modal fade text-danger" role="dialog">
         <div class="modal-dialog ">
           <!-- Modal content-->
           <form action="" id="deleteForm" method="post">
               <div class="modal-content">
                   <div class="modal-header bg-danger">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                   </div>
                   <div class="modal-body">
                       {{ csrf_field() }}
                       {{ method_field('DELETE') }}
                       <p class="text-center">Apa kamu yakin ingin menghapus role ini ?</p>
                   </div>
                   <div class="modal-footer">
                       <center>
                           <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                           <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Ya, Hapus</button>
                       </center>
                   </div>
               </div>
           </form>
         </div>
        </div>
        <script type="text/javascript">
          function deleteData(id){
             var id = id;
             var url = '{{ route("roles.destroy", ":id") }}';
             url = url.replace(':id', id);
             $("#deleteForm").attr('action', url);
           }

          function formSubmit(){
               $("#deleteForm").submit();
          }
        </script>
@endsection