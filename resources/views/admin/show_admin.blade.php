@extends('layout.layouting')
@section('title', 'Dashboard')
@section('content')
    <div class="ml-3 mt-3">
      <h3>Detail Admin</h3>
      <p> Name : {{ $admin->name }} </p>
      <p> Email : {{ $admin->email }} </p>
      <p> Age : {{ $admin->age }} </p>
      <p> Address : {{ $admin->address }} </p>
      <p> Gender : {{ $admin->gender }} </p>
      <p> phone : {{ $admin->phone }} </p>
    </div>
@endsection
