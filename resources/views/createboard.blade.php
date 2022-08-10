@extends('welcome')
@section('title','Create Board')
@section('content')
<h2>Create Board</h2>
<form action="/createboard" method="GET" >

    <div class="form-outline mb-4">
        <label class="form-label" for="form5Example1">Name</label>
      <input type="text" id="form5Example1" class="form-control" name="name" required/>

    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form5Example2">Desc</label>
      <input type="text" id="form5Example2" class="form-control"  name="desc" required/>

    </div>

    <!-- Checkbox -->


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" >Submit</button>
  </form>
  @endsection
