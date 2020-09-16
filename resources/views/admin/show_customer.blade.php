@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<div class="ml-3 mt-3">
<h3>Detail Customer</h3>
      <p> name : {{ $customer->name }} </p>
      <p> email : {{ $customer->email }} </p>
      <p> age : {{ $customer->age }} </p>
      <p> address : {{ $customer->address }} </p>
      <p> gender : {{ $customer->gender }} </p>
      <p>phone : {{ $customer->phone }}</p>
@endsection
