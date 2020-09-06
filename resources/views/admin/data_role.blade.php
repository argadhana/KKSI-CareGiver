@extends('layout.layouting')
@section('title', 'Dashboard')
@section('content')
<div class="ml-3 mt-3">
      <a href="/data-role/create" class="btn btn-primary mb-2">Tambah Role</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $key => $role)
            <tr>
              <td> {{$key + 1}} </td>
              <td> {{ $role->name }} </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
