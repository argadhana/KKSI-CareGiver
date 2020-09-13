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
              <th>ID</th>
              <th>Waktu Order</th>
              <th>Paket</th>
              <th>Durasi</th>
              <th>Alamat</th>
              <th>Telpon</th>
              <th>Deskripsi</th>
              <th>Total Bayar</th>
              <th>Nama Customer</th>
              <th>Nama Lansia</th>
              <th>Nama Esccort</th>
              <th>Status</th>
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

<div class="modal fade" id="confirmStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form id="formverifikasi" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
          apakah anda yakin mengganti status <strong>transaksi(id  <span id="idtrans"></span>)</strong> dengan :
          <div class="form-group mt-3">
              <select class="form-control" id="statusrole">
                <option value="terima">Konfirmasi</option>
                <option value="tolak">Tolak</option>
              </select>
          </div>
            @csrf
          <div class="form-group">
            <input id="idtransaksi" name="id" type="hidden" value="">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" id="photo" name="bukti_foto" placeholder="Photo">
          </div>
            
            <input id="idlansia" name="idlansia" type="hidden" value="">
            <input id="idesccort" name="idesccort" type="hidden" value="1">
            <input id="iduser" name="iduser" type="hidden" value="{{auth()->user()->id}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="submitform" class="btn btn-primary">Save changes</button>
      </div>
    </form>

      </div>
</div>
</div>

@endsection
@section('script')
<script>
  $(function () {
    var table = $('#tableVerifikasi').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/transaksi/getverif'},
      columns: [
      {data: 'idtrans', name: 'idtrans' },
      {data: 'order_time', name: 'order_time' },
      {data: 'paket', name: 'paket'},
      {data: 'durasi', name: 'durasi'},
      {data: 'alamat', name: 'transaksis.alamat' },
      {data: 'nomor_telp', name: 'transaksis.nomor_telp' },
      {data: 'deskripsi_kerja', name: 'deskripsi_kerja' },
      {data: 'total_bayar', name: 'total_bayar' },
      {data: 'name', name: 'name.users' },
      {data: 'nama', name: 'nama.lansias' },
      {data: 'esccort_name', name: 'esccort_name' },
      {data: 'status', name: 'status' },
      ],
      rowId: 'id'
    });

    var id;

    $('#tableVerifikasi tbody').on( 'click', 'tr', function () {
        var id = table.row( this ).id();
        console.log('anjay');
        $('#idtrans').text(id);
        $('#idtransaksi').val(id);
        $('#confirmStatus').modal('show');
        // $.ajax({
        //     url:"role/edit/"+id,
        //     dataType:"json",
        //     success:function(html){
        //     $('.namauser').text(html.data[0].name);
        //     $('.roleawal').text(html.data[0].role_now);
        //     $('.rolesudah').text(html.data[0].role_requested);
        //     $('#editRoleModal').modal('show')
        //     // alert( 'ini adalah '+html.data[0].name );
        //     }
        // })
    } );

    $('#formverifikasi').submit(function(e) {
      e.preventDefault();
      // console.log(id);
      $.ajax({
        url:"/api/uploadbukti",
        method:"POST",
        data: new FormData(this),
        contentType: false,
        cache:false,
        processData: false,
        dataType:"json",
          success:function(html){
            
          alert('');
          }
      })
    } );

  });
</script>
@endsection
