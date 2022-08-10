@extends('welcome')
@section('title','Create List')
@section('content')
<h2>Create List</h2>
<form action="/addlist" method="GET" >

    <div class="form-outline mb-4">
    <label class="form-label" for="form5Example1">Name</label>
      <input type="text" id="form5Example1" class="form-control" name="name" required/>

    </div>



    <!-- Checkbox -->

    <input type="hidden"  name="id" value="{{ $id }}"/>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" >Submit</button>
  </form>
  @endsection
