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
                  <h3 class="card-title">Add Transaction</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
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
                    <form action="{{ route('storePenjualan') }}" method="POST">@csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label for="name">Inventory</label>
                            <select name="inventory"  class="form-control">
                              @foreach ($inventories as $inventory)
                                  <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="harga">Stock</label>
                            <input type="integer" class="form-control" id="harga" name="stock" placeholder="Enter Stock">
                          </div>
                        <!-- /.card-body -->
        
                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                </div>
                <!-- /.card-body -->
              </div>
              @if (Session::get('data'))
              @php
                  $data=Session::get('data');
              @endphp
              <div class="card">
                <div class="card-body table-responsive p-0">
                    <table>
                      <tr>
                        <td>Nama Barang</td>
                        <td>:</td>
                        <td>{{$data['name']}}</td>
                      </tr>
                      <tr>
                        <td>Jumlah Barang</td>
                        <td>:</td>
                        <td>{{$data['amount']}}</td>
                      </tr>
                      <tr>
                        <td>Harga Satuan</td>
                        <td>:</td>
                        <td>Rp. {{number_format($data['price'])}}</td>
                      </tr>
                      <tr>
                        <td>Harga Total</td>
                        <td>:</td>
                        <td>Rp. {{number_format($data['total'])}}</td>
                      </tr>
                    </table>
                </div>
              </div>
              @endif
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
@endsection