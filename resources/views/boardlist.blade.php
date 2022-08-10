@extends('welcome')
@section('title','Board List')
@section('content')

<a href="/createlistview/{{ $id }}">
    <button type="button" class="btn btn-primary btn-lg mb-2">Add List</button>
    </a>
    <h2>Board List</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>

        <th scope="col">name</th>

        <th scope="col">Action</th>

      </tr>
    </thead>
    <tbody>
        @foreach ($response as $key => $value )


      <tr>
        <td>{{ $value['id']}}</td>

        <td>{{ $value['name']}}</td>

        <td>
           {{-- <a href="/editview/{{ $value['id'] }}">
            <button type="button" class="btn btn-primary btn-sm">Edit</button>
            </a> --}}
            <a href="/getcardlist/{{ $value['id']}}">
            <button type="button" class="btn btn-danger btn-sm">View Card</button>
            </a>

                <a href="/addcardview/{{ $value['id']}}">
                    <button type="button" class="btn btn-warning btn-sm">Add Card</button>
                    </a>
        </td>

      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
