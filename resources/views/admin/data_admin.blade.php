@extends('layout.layouting')
@section('title', 'Dashboard')
@section('content')
<div class="ml-3 mt-3">
    <h1>Data Items</h1>
    <a href="/data-admin/create" class="btn btn-primary mb-2">
      Create New Item
    </a>
    <table class="table table-bordered">
    <thead>
      <tr>
      	<th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
    @foreach($admin as $k => $data)

      <tr>
        <td>{{$k + 1}}</td>
		<td>{{$data->name}}</td>
        <td>{{$data->email}}</td>
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
</div>
@endsection
