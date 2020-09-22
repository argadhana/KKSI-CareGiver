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
        <h1>Data Lansia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data Lansia</li>
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
        <button id="buttoncreatelansia" type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahlansia">
          Tambah Lansia
        </button>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableLansia" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              {{-- <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th> --}}
              <th>Usia</th>
              {{-- <th>Alamat</th> --}}
              <th>Jenis Kelamin</th>
              <th>Hobi</th>
              {{-- <th>No. HP</th> --}}
              <th>Penyakit Pribadi</th>
              {{-- <th>Token</th>
              <th>Created At</th>
              <th>Update At</th> --}}
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

<div class="modal fade" id="modallansia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formlansia" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="judulmodal">Lansia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Lansia:</label>
            <input type="text" class="form-control forminput forminputlansia" id="lnama" name="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Umur:</label>
            <input type="number" class="form-control forminput forminputlansia" id="lumur" name="umur">
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
            <input type="text" class="form-control forminput forminputlansia" id="lhobi" name="hobi">
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
  
  function datatableslansia() {
    table = $('#tableLansia').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/lansia/get'},
      columnDefs: [
        {width: '15px', targets: 6 }
        ],
      columns: [
      {data: 'id', name: 'id' },
      {data: 'nama', name: 'nama' },
      {data: 'umur', name: 'umur'},
      {data: 'gender', name: 'name'},
      {data: 'hobi', name: 'name' },
      {data: 'riwayat', name: 'name' },
      {data: 'aksi', name: 'aksi', orderable: 'false'},
      ],
      rowId: 'id'
    });
  }

function allk() {

  
}

  // function buttonsimpan() {
  //   $('#formtambahlansia').submit(function(e) {
  //     e.preventDefault();
  //     // console.log(id);
  //     if ($('#idlansia').val() !== '') {
  //       $.ajax({
  //       url:"/updatelansia",
  //       method:"POST",
  //       data: new FormData(this),
  //       contentType: false,
  //       cache:false,
  //       processData: false,
  //       dataType:"json",
  //         success:function(html){
  //           $('#toastinput').toast('show')
  //           table.ajax.reload();
  //           $('#formtambahlansia')[0].reset();
  //           $('#tambahlansia').modal('hide');
  //         }
  //       })
  //     } else {
  //       $.ajax({
  //       url:"/simpanlansia",
  //       method:"POST",
  //       data: new FormData(this),
  //       contentType: false,
  //       cache:false,
  //       processData: false,
  //       dataType:"json",
  //         success:function(html){
  //           $('#toastinput').toast('show')
  //           table.ajax.reload();
  //           $('#formtambahlansia')[0].reset();
  //           $('#tambahlansia').modal('hide');

  //         // $('#toastberhasil').toast('show')
  //         // $('#confirmStatus').modal('hide');
  //         // alert(html.success);
  //         // table.ajax.reload();
  //         }
  //       })
  //     }
  //   } );
  // }

  // function buttonedit() {
  //   $('#tableLansia tbody').on( 'click', 'tr', function () {
  //       var id = table.row( this ).id();
  //       $.ajax({
  //           url:"/loadlansia/"+id,
  //           dataType:"json",
  //           success:function(html){
  //             $('#formtambahlansia')[0].reset();
  //             $('#lnama').val(html.success.nama);
  //             $('#lumur').val(html.success.umur);
  //             $('#lgender').val(html.success.gender);
  //             $('#lhobi').val(html.success.hobi);
  //             $('#lriwayat').text(html.success.riwayat);
  //             $('#idlansia').val(html.success.id);
  //             $('#tambahlansia').modal('show');
  //           }
  //       })
  //   } );
  // }

  function buttonhapus() {
    $('#tableLansia tbody').on( 'click', 'button', function () {
      var id = $(this).attr('data-idlansia');
      $.ajax({
            url:"/lansia/delete/"+ id,
            dataType:"json",
            success:function(html){
              $('#toasthapus').toast('show')
              table.ajax.reload();
            }
        })
    });
  }

  $(function () {

    datatableslansia()
    buttonhapus()
    // all()
    $('#buttoncreatelansia').on( 'click',function () {
    $('#formlansia')[0].reset();
    $('#lriwayat').text("");
    $('#judulmodal').text("Tambah Data Lansia");
    $('#action').val("Add");
    $('#modallansia').modal('show');
    });
    // buttonedit()
    // buttonsimpan()

    $('#tableLansia tbody').on( 'click', 'tr', function () {
      var id = table.row( this ).id();
      $.ajax({
          url:"/loadlansia/"+id,
          dataType:"json",
          success:function(html){
            $('#formlansia')[0].reset();
            $('#lnama').val(html.success.nama);
            $('#lumur').val(html.success.umur);
            $('#lgender').val(html.success.gender);
            $('#lhobi').val(html.success.hobi);
            $('#lriwayat').text(html.success.riwayat);
            $('#hidden_id').val(html.success.id);
            $('#judulmodal').text("Edit Lansia");
            $('#action').val("Edit");
            $('#modallansia').modal('show');
          }
      })
  } );

  $('#formlansia').submit(function(e) {
  e.preventDefault();
  console.log("bisa");
  if($('#action').val() == 'Add')
  {
  $.ajax({
      url:"/simpanlansia",
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
          $('#formlansia')[0].reset();
          $('#modallansia').modal('hide');
          $('#toastinput').toast('show')
      }
      }
    })
  }
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"/updatelansia",
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
          $('#formlansia')[0].reset();
          $('#modallansia').modal('hide');
          $('#toastinput').toast('show')
      }
      }
   });
  }
 });
  
  });
</script>
@endsection
