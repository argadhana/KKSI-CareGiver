@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
  <div class="ml-3 mt-3">
    <form action="/data-role" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Role Name</label>
        <input class="form-control" type="text" name="name" placeholder="Isi Nama Role">

        <input class="btn btn-primary mt-2" type="submit" value="Create Category">
      </div>
    </form>
  </div>
@endsection
