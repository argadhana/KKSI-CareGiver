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
        <h1>Data Customer</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data Customer</li>
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
        {{-- <button id="buttoncreatecustomer" type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahcustomer">
          Tambah Customer
        </button> --}}
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableCustomer" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>No. Hp</th>
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

<div class="modal fade" id="modalcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formcustomer" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="judulmodal">Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Customer:</label>
            <input type="text" class="form-control forminput forminputcustomer" id="customername" name="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No. HP:</label>
            <input type="text" class="form-control forminput forminputcustomer" id="customerkeahlian" name="keahlian">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat:</label>
            <input type="number" class="form-control forminput forminputcustomer" id="customerage" name="age">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Kelamin:</label>
            <select class="form-control" name="gender" id="customergender">
              <option value="L" >Laki Laki</option>
              <option value="P" >Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No. Hp:</label>
            <input type="text" class="form-control forminput forminputcustomer" id="customerphone" name="phone">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gaji:</label>
            <input type="number" class="form-control forminput forminputcustomer" id="customersalary" name="salary" value="2000000">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat:</label>
            <textarea class="form-control" id="customeraddress" rows="3" name="address"></textarea>
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <div class="mb-3 text-center">
              <img src="" alt="" id="spanimage" class="rounded d-none" style="max-width:425px;">
            </div>
            <input type="file" class="form-control forminput forminputcustomer" id="customerphoto" name="photo" placeholder="Photo">
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
  
  function datatablescustomer() {
    table = $('#tableCustomer').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/customer/get'},
      columnDefs: [
        {width: '15px', targets: 4 }
        ],
      columns: [
      {data: 'id', name: 'id' },
      {data: 'name', name: 'name' },
      {data: 'phone', name: 'phone'},
      {data: 'address', name: 'address' },
      {data: 'aksi', name: 'aksi', orderable: 'false'},
      ],
      rowId: 'id'
    });
  }

  function buttonhapus() {
    $('#tableCustomer tbody').on( 'click', 'button', function () {
      var id = $(this).attr('data-idcustomer');
      $.ajax({
            url:"/customer/delete/"+ id,
            dataType:"json",
            success:function(html){
              $('#toasthapus').toast('show')
              table.ajax.reload();
            }
        })
    });
  }



  $(function () {

    datatablescustomer()
    buttonhapus()
    
    $('#buttoncreatecustomer').on( 'click',function () {
    $('#formcustomer')[0].reset();
    $('#spanimage').attr('src','');
    $('#spanimage').addClass('d-none');
    $('#customeraddress').text('');
    $('#lriwayat').text("");
    $('#judulmodal').text("Tambah Data Customer");
    $('#action').val("Add");
    $('#modalcustomer').modal('show');
    });

  $('#formcustomer').submit(function(e) {
  e.preventDefault();
  console.log("bisa");
  if($('#action').val() == 'Add')
  {
  $.ajax({
      url:"/customer/simpan",
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
          $('#formcustomer')[0].reset();
          $('#modalcustomer').modal('hide');
          $('#toastinput').toast('show')
      }
      }
    })
  }
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"/customer/update",
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
          $('#formcustomer')[0].reset();
          $('#modalcustomer').modal('hide');
          $('#toastinput').toast('show')
      }
      }
   });
  }
 });
  
  });
</script>
@endsection
