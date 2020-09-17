@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
  <div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Admin</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="/data-admin" method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="role_id">Roles</label>
            <select name="role_id" id="role_id" class="form-control">
              @foreach ($roles as $role)
                <option value="{{$role->id}}"> {{ $role->name }} </option>
              @endforeach
            </select>
          </div>
          <div class="card-body">
          <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control">
              @foreach ($users as $user)
                <option value="{{$user->id}}"> {{ $user->name }} </option>
              @endforeach
            </select>
          </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>

@endsection
