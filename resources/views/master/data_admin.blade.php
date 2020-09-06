@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Admin</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data Admin</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      
      <!-- /.card -->

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableAdmin" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Password</th>
              <th>Verifikasi</th>
              <th>Photo</th>
              <th>Token</th>
              <th>Created At</th>
              <th>Update At</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

@endsection
@section('script')
<script>
  $(function () {
    $('#tableAdmin').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '{{route("ajax.get.data.admin")}}'},
      columns: [
      {data: 'id', name: 'users.id' },
      {data: 'name', name: 'name' },
      {data: 'email', name: 'email'},
      {data: 'name', name: 'name'},
      {data: 'name', name: 'name' },
      {data: 'name', name: 'name' },
      {data: 'name', name: 'name' },
      {data: 'name', name: 'name' },
      {data: 'name', name: 'name' },
      {data: 'name', name: 'name' },
      ],
    });
  });
</script>
@endsection
