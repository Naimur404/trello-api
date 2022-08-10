@extends('welcome')
@section('title','Enter Verification Code')
@section('content')
<h2>Please Enter Verification Code</h2>
<form  id="token">
    @csrf
    <div class="form-outline mb-4">
        <label class="form-label" for="form5Example1">Verification Code</label>
      <input type="text" id="form5Example1" class="form-control" name="token_api" required/>

    </div>

    <!-- Email input -->


    <!-- Checkbox -->


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" id="btntoken">Authintaicate</button>
  </form>
@endsection
