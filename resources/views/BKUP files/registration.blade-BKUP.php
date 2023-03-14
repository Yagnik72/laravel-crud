<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="{{ URL::asset('css/app.css');  }}">
</head>
<body class="d-flex align-items-center    " style="height: 100vh;">

<div class="container">
    <div class="row">
        <form class="" method="POST" action="{{ url('/') }}/registration" >
            @csrf
            {{-- @php
                echo "<pre>";
                print_r($errors->all());
                echo "</pre>";                
            @endphp --}}
            <div class="form-row">
            <div class="col-md-4 mb-3">
                {{-- <label for="fname">First name</label> --}}
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" value="{{ old('fname') }}" >
                <span  class="text-danger"> @error('fname') {{$message}} @enderror </span>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="{{ old('lname') }}" >
                <span  class="text-danger"> @error('lname') {{$message}} @enderror </span>
            </div>
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend" name="inputGroupPrepend">@</span>
                    </div>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" aria-describedby="inputGroupPrepend" >
                </div>
                <span  class="text-danger"> @error('username') {{$message}} @enderror </span>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}" >
                <span  class="text-danger"> @error('email') {{$message}} @enderror </span>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="password" name="password" placeholder="Password" >
                <span  class="text-danger"> @error('password') {{$message}} @enderror </span>
            </div>
            <div class="col-md-4 mb-3">
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" >
                <span  class="text-danger"> @error('password_confirm') {{$message}} @enderror </span>
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ old('city') }}" >
                <span  class="text-danger"> @error('city') {{$message}} @enderror </span>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state') }}" >
                <span  class="text-danger"> @error('state') {{$message}} @enderror </span>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" value="{{ old('zip') }}" >
                <span  class="text-danger"> @error('zip') {{$message}} @enderror </span>
            </div>
        </div>
        <div class="form-group mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="invalidCheck" name="invalidCheck[]"  value="1" {{ (is_array(old('invalidCheck')) and in_array(1, old('invalidCheck'))) ? ' checked' : '' }} >
                <label class="form-check-label" for="invalidCheck"> Agree to terms and conditions</label>
                <div  class="text-danger"> @error('invalidCheck') {{$message}} @enderror </div>
            </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
        
    </div>
</div>

</body>
</html>
