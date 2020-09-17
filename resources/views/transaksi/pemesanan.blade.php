@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Transaksi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
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
        <button id="buttona" type="button" class="btn btn-primary">
          tambah transaksi
        </button>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableTransaksi" class="table table-bordered small" style="text-size:11px; width:100%;">
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
              {{-- <th>Token</th>
              <th>Created At</th>
              <th>Update At</th> --}}
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

<div class="modal fade" id="tambaht" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
    <form id="formtambah" method="POST">
          @csrf
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <select class="form-control" name="lansiauses" id="lansiauses">
              <option value="lama" id="optionlama">Gunakan Data Lama</option>
              <option value="baru" id="optionbaru">Gunakan Data Baru</option>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Lansia:</label>
            <input type="text" class="form-control forminput forminputlansia" id="tnama" name="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">umur:</label>
            <input type="text" class="form-control forminput forminputlansia" id="tumur" name="umur">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">gender:</label>
            <input type="text" class="form-control forminput forminputlansia" id="tgender" name="gender">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">hobi:</label>
            <input type="text" class="form-control forminput forminputlansia" id="thobi" name="hobi">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">riwayat:</label>
            <input type="text" class="form-control forminput forminputlansia" id="triwayat" name="riwayat">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">paket:</label>
            <input type="text" class="form-control forminput " id="tpaket" name="paket">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">durasi:</label>
            <input type="text" class="form-control forminput " id="tdurasi-name" name="durasi">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">alamat:</label>
            <input type="text" class="form-control forminput " id="recipient-name" name="alamat">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">nomor:</label>
            <input type="text" class="form-control forminput " id="recipient-name" name="nomor_telp">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">deskripsi:</label>
            <input type="text" class="form-control forminput" id="recipient-name" name="deskripsi_kerja">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">harga:</label>
            <input type="text" class="form-control forminput" id="recipient-name" name="bayar">
          </div>
          <input id="idlansia" name="lansia_id" type="hidden" value="">
          <input id="idesccort" name="esccort_id" type="hidden" value="1">
          <input id="iduser" name="user_id" type="hidden" value="{{auth()->user()->id}}">
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

  function ajaxload() {
        $.ajax({
            url:"api/load/"+id,
            dataType:"json",
            success:function(html){
              if (html.success !== '[]') {
                // $('.forminput')[0].reset();          
                $('#tnama').val(html.success.nama);
                $('#tumur').val(html.success.umur);
                $('#tgender').val(html.success.gender);
                $('#thobi').val(html.success.hobi);
                $('#triwayat').val(html.success.riwayat);
                $('#idlansia').val(html.success.id);
                $('.forminputlansia').attr('readonly',true);
                $('#tambaht').modal('show')
              }
              else {
                $('.forminputlansia').attr('readonly',false);
                $('#tambaht').modal('show')
              }
            // alert( 'ini adalah '+html.data[0].name );
            }
        })   
      }

  $(function () {
    id = $("#iduser").val();
    $('#buttona').click(function () {
        // console.log(id);
      ajaxload();
    } );
    
    $('#lansiauses').change(function(){
        if($(this).val() == 'baru'){
          $('.forminputlansia').attr('readonly',false);
          $('.forminput').val('');
        }
        if($(this).val() == 'lama'){
            ajaxload();
        }
    });

  $('#formtambah').submit(function(e) {
      e.preventDefault();
      // console.log(id);
      $.ajax({
        url:"/api/pesan",
        method:"POST",
        data: new FormData(this),
        contentType: false,
        cache:false,
        processData: false,
        dataType:"json",
          success:function(html){
            
          alert( 'ini bisa');
          }
      })
  } );

    table = $('#tableTransaksi').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '/transaksi/getpesan'},
      columns: [
      {data: 'idtrans', name: 'idtrans' },
      {data: 'order_time', name: 'order_time' },
      {data: 'paket', name: 'paket'},
      {data: 'durasi', name: 'durasi'},
      {data: 'alamat', name: 'transaksis.alamat' },
      {data: 'nomor_telp', name: 'transaksis.nomor_telp' },
      {data: 'deskripsi_kerja', name: 'deskripsi_kerja' },
      {data: 'total_bayar', name: 'total_bayar' },
      {data: 'user_name', name: 'user_name' },
      {data: 'nama', name: 'nama.lansias' },
      {data: 'esccort_name', name: 'esccort_name' },
      {data: 'status', name: 'status' },
      ],
    });
    
    $(window).bind('resize', function () {
    Table.fnAdjustColumnSizing();
    });
  });
</script>
@endsection
