@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<div class="ml-3 mt-3">
    <h1>Data Cutomers</h1>
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($customer as $k => $data)

      <tr>
        <td>{{$k + 1}}</td>
		    <td>{{$data->name}}</td>
        <td>{{$data->phone}}</td>
        <td>{{$data->address}}</td>

		<td>
			<a href="/data-customer/{{$data->id}}" class="btn btn-info">Info</a>
		</td>
      </tr>

    @endforeach
    </tbody>
  </table>
</div>
@endsection
