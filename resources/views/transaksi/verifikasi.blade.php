@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Verifikasi Data</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Verifikasi Data</li>
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
          <table id="tableVerifikasi" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID trans</th>
              <th>ID cus</th>
              <th>ID cg</th>
              <th>ID lan</th>
              <th>Nama lan</th>
              <th>Nama cus</th>
              <th>hp</th>
              <th>jenis</th>
              <th>tarif</th>
              <th>total</th>
              <th>bukti</th>
              <th>status</th>
              <th>Created At</th>
              <th>Update At</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
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
    $('#tableVerifikasi').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '{{route("ajax.get.data.verifikasi")}}'},
      columns: [
      {data: 'id', name: 'users.id' },
      {data: 'id', name: 'users.id' },
      {data: 'id', name: 'users.id' },
      {data: 'keahlian', name: 'keahlian' },
      {data: 'email', name: 'email'},
      {data: 'status', name: 'status'},
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
