@extends('layout.layouting')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <a href="/data-esccort/create" class="btn btn-primary mb-2">Tambah Data Esccort</a>
  <table class="table table-hover">
    <thead>
      <tr>
      	<th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
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
			<a href="#" class="btn btn-info">Info</a>
			<a href="#" class="btn btn-warning">Edit</a>
      <form action="#" method="post" style="display: inline;">
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
