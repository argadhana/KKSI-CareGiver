@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Permintaan Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Permintaan Role</li>
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
          <table id="tableRole" class="table table-bordered table-hover small" style="text-size:11px; width:100%;">
            <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role Sekarang</th>
              <th>Permintaan Role</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Update At</th>
            </tr>
            </thead>
            <tbody>
            <tr class="anjay">
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

  <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Apakah anda yakin mengganti role user <strong><span class="namauser"></span></strong> dari role <strong><span class="roleawal"></span></strong> ke role <strong><span class="rolesudah"></span></strong>?
              <div class="form-group mt-3">
                  <select class="form-control" id="statusrole">
                    <option value="accepted">Konfirmasi</option>
                    <option value="rejected">Tolak</option>
                  </select>
              </div>
              <div id="boxalasan" class="form-group mt-3 d-none">
                  <label for="alasan">Alasan: </label>
                  <textarea class="form-control" id="alasan" rows="3"></textarea>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>
          </div>
  </div>
</div>

@endsection
@section('script')
<script>
  $(function () {
    var table = $('#tableRole').DataTable({
      scrollX: true,
      autoWidth: false,
      selection: true,
      processing: true,
      serverSide: true,
      ajax: {url: '{{route("ajax.get.data.role")}}'},
      columns: [
      {data: 'id', name: 'request_roles.id' },
      {data: 'name', name: 'name' },
      {data: 'email', name: 'email'},
      {data: 'role_now', name: 'role_now'},
      {data: 'role_requested', name: 'role_requested' },
      {data: 'status', name: 'status' },
      {data: 'created_at', name: 'request_roles.created_at' },
      {data: 'updated_at', name: 'request_roles.updated_at' },
      ],
      rowId: 'id'
    });

    $('#tableRole tbody').on( 'click', 'tr', function () {
        var id = table.row( this ).id();
        $.ajax({
            url:"role/edit/"+id,
            dataType:"json",
            success:function(html){
            $('.namauser').text(html.data[0].name);
            $('.roleawal').text(html.data[0].role_now);
            $('.rolesudah').text(html.data[0].role_requested);
            $('#editRoleModal').modal('show')
            // alert( 'ini adalah '+html.data[0].name );
            }
        })
    } );

    $('#statusrole').change(function(){
        if($(this).val() == 'rejected'){
            $('#boxalasan').removeClass('d-none');
        }
        else{
            $('#boxalasan').addClass('d-none');
        }
    });
    // $( "#target" ).click(function() {
        
    // });
  });
</script>
@endsection
