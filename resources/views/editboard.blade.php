@extends('welcome')
@section('title','Edit Board')
@section('content')
<h2>Edit Baord</h2>
<form action="/updateboard/{{  $data['id'] }}" method="GET" >

    <div class="form-outline mb-4">
      <label class="form-label" for="form5Example1">Name</label>
      <input type="text" id="form5Example1" class="form-control" name="name" value="{{ $data['name'] }}" required/>

    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
    <label class="form-label" for="form5Example2">Desc</label>
      <input type="text" id="form5Example2" class="form-control"  name="desc" value="{{ $data['desc'] }}" required/>

    </div>

    <!-- Checkbox -->


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" >Update</button>
  </form>
  @endsection
