@extends('welcome')
@section('title','Card List')
@section('content')

<h2>Card List</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>

        <th scope="col">name</th>
        <th scope="col">Desc</th>



      </tr>
    </thead>
    <tbody>
        @foreach ($response as $key => $value )


      <tr>
        <td>{{ $value['id']}}</td>

        <td>{{ $value['name']}}</td>
        <td>{{ $value['desc']}}</td>



      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
