@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<div class="ml-3 mt-3">
<h3>Detail Esccort</h3>
      <p> name : {{ $esccort->name }} </p>
      <p> email : {{ $esccort->salary }} </p>
      <p> age : {{ $esccort->age }} </p>
      <p> address : {{ $esccort->address }} </p>
      <p> gender : {{ $esccort->gender }} </p>
      <p>phone : {{ $esccort->phone }}</p>
      <img src="/esccortPhotos/{{$esccort->photo}}"
@endsection
