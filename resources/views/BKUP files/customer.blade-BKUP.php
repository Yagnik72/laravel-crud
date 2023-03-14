@extends('layouts.main')
@push('title') <title>{{ $title }}</title> @endpush
@section('main-section')

<div class="bg-dark" >
    {{-- <form action="{{url('/')}}/customer/create" method="post"> --}}
    <form action="{{$url}}" method="post">
    {{-- <div class="form-row">
        <x-input type="text" name="fname" placeholder="First name" :demo="$demo" />
        <x-input type="text" name="lname" placeholder="Last name" />
        <x-input type="text" name="username" placeholder="Username" />
        <x-input type="email" name="email" placeholder="Email" />
        <x-input type="text" name="password" placeholder="Password" />
        <x-input type="password" name="password_confirm" placeholder="Password" />
    </div> --}}
        @csrf
        <div class="container mt-4 card p-3 bg-white">
            <h3 class="text-center text text-primary">{{ $title }}</h3>
            <div class="row">
                <div class="form-group col-md-6 required">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                    <span class="text-danger">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" class="form-control" value="{{old('password')}}">
                    <span class="text-danger">
                        @error('password')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="{{old('confirm_password')}}">
                    <span class="text-danger">
                        @error('confirm_password')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{old('country')}}">
                    <span class="text-danger">
                        @error('country')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="state">State:</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{old('state')}}">
                    <span class="text-danger">
                        @error('state')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-12 required">
                    <label for="address">Address:</label>
                    <textarea  name="address" id="address" class="form-control" rows="2">{{{ old('address') }}}</textarea>
                    <span class="text-danger">
                        @error('address')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label>Gender:</label>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="M" {{ (old('gender') == 'M') ? ' checked' : '' }} >
                            <label class="form-check-label" for="male" style="position: relative;top: -4px;">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="F" {{ (old('gender') == 'F') ? ' checked' : '' }} >
                            <label class="form-check-label mr-4" for="Female" style="position: relative;top: -4px;">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Other" value="O" {{ (old('gender') == 'O') ? ' checked' : '' }} >
                            <label class="form-check-label mr-4" for="Other" style="position: relative;top: -4px;">Other</label>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('gender')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="dob">Date Of Birth:</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{old('dob')}}" />
                    <span class="text-danger">
                        @error('dob')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
</div>
@endsection
