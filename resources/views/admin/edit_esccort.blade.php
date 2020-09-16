@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<div class="ml-3 mt-3">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Esccort</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="/data-esccort/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" class="form-control" value="{{$esccort->salary}}" id="salary" name="salary" placeholder="salary">
          </div>
          <div class="form-group">
            <label for="keahlian">Keahlian</label>
            <input type="textarea" class="form-control" value="{{$esccort->keahlian}}" id="keahlian" name="keahlian" placeholder="Keahlian">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{$esccort->name}}" id="name" name="name" placeholder="name">
          </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" class="form-control" value="{{$esccort->age}}" id="age" name="age" placeholder="age">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" value="{{$esccort->address}}" id="address" name="address" placeholder="Address">
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" class="form-control" value="{{$esccort->gender}}" id="gender" name="gender" placeholder="Gender">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control" value="{{$esccort->phone}}" id="phone" name="phone" placeholder="phone">
          </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" value="{{$esccort->photo}}" id="photo" name="photo" placeholder="Photo">
          </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection
