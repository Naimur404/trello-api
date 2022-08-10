@extends('welcome')
@section('title','All Board')
@section('content')
<a href="{{ route('createboardview') }}">
<button type="button" class="btn btn-primary btn-lg mb-2">Add Board</button>
</a>
<h2>All Board</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">Desc</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
    <tbody>
        @foreach ($list as $key => $value )


      <tr>
        <th scope="row">{{ $value['id'] }}</th>
        <td>{{ $value['name']}}</td>
        <td>{{ $value['desc']}}</td>
        <td>
          <a href="/editview/{{ $value['id'] }}">
            <button type="button" class="btn btn-primary btn-sm">Edit</button>
            </a>
            <a href="/boarddelete/{{ $value['id'] }}">
            <button type="button" class="btn btn-danger btn-sm">Delete</button>
            </a>
            <a href="/getboadlist/{{ $value['id'] }}">
                <button type="button" class="btn btn-success btn-sm">View List</button>
            </a

        </td>

      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
