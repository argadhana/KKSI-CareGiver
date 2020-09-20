@extends('layouts.master')
{{-- @section('title', 'Dashboard') --}}
@section('content')
<div class="ml-3 mt-3">
    <h1>Data CG</h1>
    <a href="/data-esccort/create" class="btn btn-primary mb-2">Tambah Data CG</a>
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
    @foreach($esccort as $k => $data)

      <tr>
        <td>{{$k + 1}}</td>
		    <td>{{$data->name}}</td>
        <td>{{$data->phone}}</td>
        <td>{{$data->address}}</td>

		<td>
        <a href="/data-esccort/{{$data->id}}" class="btn btn-info">Info</a>
			<a href="/data-esccort/{{$data->id}}/edit" class="btn btn-warning">Edit</a>
        <form action="/data-esccort/{{$data->id}}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
		</td>
      </tr>

    @endforeach
    </tbody>
  </table>
</div>
@endsection
