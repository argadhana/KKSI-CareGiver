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
        <h1>Data Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data Role</li>
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
        {{-- <button id="buttoncreaterole" type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahrole">
          Tambah Role
        </button> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableRole1" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
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

<div class="modal fade" id="modalrole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formrole" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="judulmodal">Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Role:</label>
            <input type="text" class="form-control forminput forminputrole" id="lnama" name="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Umur:</label>
            <input type="number" class="form-control forminput forminputrole" id="lumur" name="umur">
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
            <input type="text" class="form-control forminput forminputrole" id="lhobi" name="hobi">
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
  
  function datatablesrole() {
    table = $('#tableRole1').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/role/get'},
      columnDefs: [
        {width: '15px', targets: 2 }
        ],
      columns: [
      {data: 'id', name: 'id' },
      {data: 'name', name: 'name' },
      {data: 'aksi', name: 'aksi', orderable: 'false'},
      ],
      rowId: 'id'
    });
  }

  function buttonhapus() {
    $('#tableRole1 tbody').on( 'click', 'button', function () {
      var id = $(this).attr('data-idrole');
      $.ajax({
            url:"/role/delete/"+ id,
            dataType:"json",
            success:function(html){
              $('#toasthapus').toast('show')
              table.ajax.reload();
            }
        })
    });
  }

  $(function () {

    datatablesrole()
    buttonhapus()
    
    $('#buttoncreaterole').on( 'click',function () {
    $('#formrole')[0].reset();
    $('#lriwayat').text("");
    $('#judulmodal').text("Tambah Data Role");
    $('#action').val("Add");
    $('#modalrole').modal('show');
    });
  //   $('#tableRole1 tbody').on( 'click', 'tr', function () {
  //     var id = table.row( this ).id();
  //     $.ajax({
  //         url:"/role/load/"+id,
  //         dataType:"json",
  //         success:function(html){
  //           $('#formrole')[0].reset();
  //           $('#lnama').val(html.success.nama);
  //           $('#lumur').val(html.success.umur);
  //           $('#lgender').val(html.success.gender);
  //           $('#lhobi').val(html.success.hobi);
  //           $('#lriwayat').text(html.success.riwayat);
  //           $('#hidden_id').val(html.success.id);
  //           $('#judulmodal').text("Edit Role");
  //           $('#action').val("Edit");
  //           $('#modalrole').modal('show');
  //         }
  //     })
  // } );

  $('#formrole').submit(function(e) {
  e.preventDefault();
  console.log("bisa");
  if($('#action').val() == 'Add')
  {
  $.ajax({
      url:"/role/simpan",
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
          $('#formrole')[0].reset();
          $('#modalrole').modal('hide');
          $('#toastinput').toast('show')
      }
      }
    })
  }
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"/role/update",
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
          $('#formrole')[0].reset();
          $('#modalrole').modal('hide');
          $('#toastinput').toast('show')
      }
      }
   });
  }
 });
  
  });
</script>
@endsection
