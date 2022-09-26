@extends('layout')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Users Table 
                    @if (Auth::user()->role_id==3)
                    <a href="{{ route('users.export') }}" class="btn btn-primary">Export</a>
                    @endif

                  </h3>
                  <div class="card-tools">
                    <form action="{{ route('users.cari') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="q" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  @if (session('success'))
                        <div class="alert alert-success" style="font-weight: bold">
                            {{ session('success') }}
                        </div>
                  @endif
                  
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>
                            @if (Auth::user()->role_id!=1)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-pencil-alt"></i></a>
                            <button type="button" data-record-id="{{$user->id}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-rounded waves-effect waves-light"><i class="fas fa-trash"></i></button>
                            @endif
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-success btn-rounded waves-effect waves-light"><i class="fas fa-eye"></i></a>
                          </td>
                        </tr> 
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Hapus User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
      </div>
@endsection
@section('script')
<script>
  $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      
      $.post('/delete-user/' + id).then()
      setTimeout(function() {
          location.reload();            
      })
  });
  $('#confirm-delete').on('show.bs.modal', function(e) {
      var data = $(e.relatedTarget).data();
      $('.btn-ok', this).data('recordId', data.recordId);
  });
  </script>
@endsection