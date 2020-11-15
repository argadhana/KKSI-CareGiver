@extends('layouts.master')
@section('css')
<style>
.front{
  z-index: 9999;
}
</style>
@endsection
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
        {{-- <button id="buttoncreateadmin" type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahadmin">
          Tambah Admin
        </button> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableAdmin1" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Alamat</th>
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
<div class="toast" id="toasthapus" data-delay="10000" style="position: absolute; top: 100px; right: 50px;">
  <div class="toast-header">
    <strong class="mr-auto">Notice</strong>
    {{-- <small>11 mins ago</small> --}}
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Sukses, Data Berhasil dihapus.
  </div>
</div>

<div class="toast front" id="toastinput" data-delay="10000" style="position: absolute; top: 100px; right: 50px;">
  <div class="toast-header">
    <strong class="mr-auto">Notice</strong>
    {{-- <small>11 mins ago</small> --}}
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body" id="text-toast">
    Sukses, Data Berhasil Dibuat.
  </div>
</div>

<div class="modal fade" id="modaladmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formadmin" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="judulmodal">Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Admin:</label>
            <input type="text" class="form-control forminput forminputadmin" id="lnama" name="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Umur:</label>
            <input type="number" class="form-control forminput forminputadmin" id="lumur" name="umur">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gender:</label>
            <select class="form-control" name="gender" id="lgender">
              <option value="L" >Laki Laki</option>
              <option value="P" >Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Hobi:</label>
            <input type="text" class="form-control forminput forminputadmin" id="lhobi" name="hobi">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Riwayat Penyakit:</label>
            <textarea class="form-control" id="lriwayat" rows="3" name="riwayat"></textarea>
          </div>
          
        <input name="iduser" type="hidden" value="{{auth()->user()->id}}">
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id" />

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" id="submitform" class="btn btn-primary">Simpan</button>
      </div>
    </form>
      </div>
  </div>
</div>

@endsection
@section('script')
<script>
  
  function datatablesadmin() {
    table = $('#tableAdmin1').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/admin/get'},
      columnDefs: [
        {width: '15px', targets: 3 }
        ],
      columns: [
      {data: 'name', name: 'name' },
      {data: 'email', name: 'email' },
      {data: 'address', name: 'address'},
      {data: 'aksi', name: 'aksi', orderable: 'false'},
      ],
      rowId: 'id'
    });
  }

  function buttonhapus() {
    $('#tableAdmin1 tbody').on( 'click', 'button', function () {
      var id = $(this).attr('data-idadmin');
      $.ajax({
            url:"/admin/delete/"+ id,
            dataType:"json",
            success:function(html){
              $('#toasthapus').toast('show')
              table.ajax.reload();
            }
        })
    });
  }

  $(function () {

    datatablesadmin()
    buttonhapus()
    
    $('#buttoncreateadmin').on( 'click',function () {
    $('#formadmin')[0].reset();
    $('#lriwayat').text("");
    $('#judulmodal').text("Tambah Data Admin");
    $('#action').val("Add");
    $('#modaladmin').modal('show');
    });
  //   $('#tableAdmin1 tbody').on( 'click', 'tr', function () {
  //     var id = table.row( this ).id();
  //     $.ajax({
  //         url:"/admin/load/"+id,
  //         dataType:"json",
  //         success:function(html){
  //           $('#formadmin')[0].reset();
  //           $('#lnama').val(html.success.nama);
  //           $('#lumur').val(html.success.umur);
  //           $('#lgender').val(html.success.gender);
  //           $('#lhobi').val(html.success.hobi);
  //           $('#lriwayat').text(html.success.riwayat);
  //           $('#hidden_id').val(html.success.id);
  //           $('#judulmodal').text("Edit Admin");
  //           $('#action').val("Edit");
  //           $('#modaladmin').modal('show');
  //         }
  //     })
  // } );

  $('#formadmin').submit(function(e) {
  e.preventDefault();
  console.log("bisa");
  if($('#action').val() == 'Add')
  {
  $.ajax({
      url:"/admin/simpan",
      method:"POST",
      data: new FormData(this),
      contentType: false,
      cache:false,
      processData: false,
      dataType:"json",
      success:function(data)
      {
      var html = '';
      if(data.errors)
      {
        for(var count = 0; count < data.errors.length; count++)
        // alert(data.errors[count]);
        {
          html += data.errors[count]
        }
        $('#text-toast').html(html);
        $('#toastinput').toast('show')
      }
      if(data.success)
      {
          html += data.success ;
          $('#text-toast').html(html);
          table.ajax.reload();
          $('#formadmin')[0].reset();
          $('#modaladmin').modal('hide');
          $('#toastinput').toast('show')
      }
      }
    })
  }
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"/admin/update",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
      var html = '';
      if(data.errors)
      {
        for(var count = 0; count < data.errors.length; count++)
        // alert(data.errors[count]);
        {
          html += data.errors[count]
        }
        $('#text-toast').html(html);
        $('#toastinput').toast('show')
      }
      if(data.success)
      {
          html += data.success ;
          $('#text-toast').html(html);
          table.ajax.reload();
          $('#formadmin')[0].reset();
          $('#modaladmin').modal('hide');
          $('#toastinput').toast('show')
      }
      }
   });
  }
 });
  
  });
</script>
@endsection
