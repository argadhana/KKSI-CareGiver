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
        <h1>Data CG</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data CG</li>
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
        <button id="buttoncreatecg" type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahcg">
          Tambah CG
        </button>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableCG" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
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

<div class="modal fade" id="modalcg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formcg" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="judulmodal">CG</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama CG:</label>
            <input type="text" class="form-control forminput forminputcg" id="cgname" name="name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Keahlian:</label>
            <input type="text" class="form-control forminput forminputcg" id="cgkeahlian" name="keahlian">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Umur:</label>
            <input type="number" class="form-control forminput forminputcg" id="cgage" name="age">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Kelamin:</label>
            <select class="form-control" name="gender" id="cggender">
              <option value="L" >Laki Laki</option>
              <option value="P" >Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No. Hp:</label>
            <input type="text" class="form-control forminput forminputcg" id="cgphone" name="phone">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gaji:</label>
            <input type="number" class="form-control forminput forminputcg" id="cgsalary" name="salary" value="2000000">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Alamat:</label>
            <textarea class="form-control" id="cgaddress" rows="3" name="address"></textarea>
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <div class="mb-3 text-center">
              <img src="" alt="" id="spanimage" class="rounded d-none" style="max-width:425px;">
            </div>
            <input type="file" class="form-control forminput forminputcg" id="cgphoto" name="photo" placeholder="Photo">
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
  
  function datatablescg() {
    table = $('#tableCG').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/cg/get'},
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
    $('#tableCG tbody').on( 'click', 'button', function () {
      var id = $(this).attr('data-idcg');
      $.ajax({
            url:"/cg/delete/"+ id,
            dataType:"json",
            success:function(html){
              $('#toasthapus').toast('show')
              table.ajax.reload();
            }
        })
    });
  }

  function buttonupdate() {
    $('#tableCG tbody').on( 'click', 'tr', function () {
      var id = table.row( this ).id();
      $.ajax({
          url:"/cg/load/"+id,
          dataType:"json",
          success:function(html){
            $('#formcg')[0].reset();
            $('#cgname').val(html.success.name);
            $('#cgage').val(html.success.age);
            $('#cgphone').val(html.success.phone);
            $('#cggender').val(html.success.gender);
            $('#cgkeahlian').val(html.success.keahlian);
            $('#cgsalary').val(html.success.salary);
            $('#spanimage').attr('src','/esccortPhotos/' + html.success.photo);
            $('#spanimage').removeClass('d-none');
            $('#cgaddress').text(html.success.address);
            $('#hidden_id').val(html.success.id);
            $('#judulmodal').text("Edit CG");
            $('#action').val("Edit");
            $('#modalcg').modal('show');
          }
      })
    } );
  }

  $(function () {

    datatablescg()
    buttonhapus()
    buttonupdate()
    
    $('#buttoncreatecg').on( 'click',function () {
    $('#formcg')[0].reset();
    $('#spanimage').attr('src','');
    $('#spanimage').addClass('d-none');
    $('#cgaddress').text('');
    $('#lriwayat').text("");
    $('#judulmodal').text("Tambah Data CG");
    $('#action').val("Add");
    $('#modalcg').modal('show');
    });

  $('#formcg').submit(function(e) {
  e.preventDefault();
  console.log("bisa");
  if($('#action').val() == 'Add')
  {
  $.ajax({
      url:"/cg/simpan",
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
          $('#formcg')[0].reset();
          $('#modalcg').modal('hide');
          $('#toastinput').toast('show')
      }
      }
    })
  }
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"/cg/update",
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
          $('#formcg')[0].reset();
          $('#modalcg').modal('hide');
          $('#toastinput').toast('show')
      }
      }
   });
  }
 });
  
  });
</script>
@endsection
