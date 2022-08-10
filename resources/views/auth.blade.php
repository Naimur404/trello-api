@extends('welcome')
@section('title','Authorization')
@section('content')
<h2>Enter Api Key And Secret</h2>
<form action="" method="" id="key">
    @csrf
    <div class="form-outline mb-4">
      <input type="text" id="form5Example1" class="form-control" name="apikey" required/>
      <label class="form-label" for="form5Example1">Api Key</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" id="form5Example2" class="form-control"  name="apisecret" required/>
      <label class="form-label" for="form5Example2">Api Secret</label>
    </div>

    <!-- Checkbox -->


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" id="btnkey">Authorization</button>
  </form>
  @endsection
