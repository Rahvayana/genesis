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
                  <h3 class="card-title">Update Profile</h3>
  
                  <div class="card-tools">
                    
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" style="font-weight: bold">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('users.update',$user->id) }}" method="POST">@csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name" placeholder="Enter Name">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email" placeholder="Enter Email">
                          </div>
                          <div class="form-group">
                            <label for="birth">Birth Date</label>
                            <input type="date" class="form-control" value="{{date('Y-m-d',strtotime($user->birth))}}" name="birth" id="birth">
                          </div>
                          <div class="form-group">
                            <label for="Gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="LAKI-LAKI" {{$user->gender=='LAKI-LAKI'?'selected':''}}>LAKI-LAKI</option>
                                <option value="PEREMPUAN" {{$user->gender=='PEREMPUAN'?'selected':''}}>PEREMPUAN</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" value="{{$user->address}}" name="address" id="address" placeholder="Address">
                          </div>
                          @if (Auth::user()->role_id!=1)
                          <div class="form-group">
                            <label for="address">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="1" {{$user->role_id=='1'?'selected':''}}>User</option>
                                <option value="2" {{$user->role_id=='2'?'selected':''}}>Moderator</option>
                                <option value="3" {{$user->role_id=='3'?'selected':''}}>Admin</option>
                            </select>
                          </div>
                          @endif
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                </div>
                <!-- /.card-body -->
            </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
@endsection