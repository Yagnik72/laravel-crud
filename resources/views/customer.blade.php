@extends('layouts.main')
@push('title') <title>{{ $title }}</title> @endpush
@section('main-section')

<div class="bg-dark rounded" >
    {{-- <form action="{{url('/')}}/customer/create" method="post"> --}}

    <form action="{{$url}}" method="post" enctype='multipart/form-data' class="customer-create-form">
        @csrf
        <div class="container mt-4 card p-3 bg-white">
            <h3 class="text-center text text-primary">{{ $title }}</h3>
            <div class="row">
                <div class="form-group col-md-6 required">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $customer->name}}">
                    <span class="text-danger">
                        @error('name')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? $customer->email}}">
                    <span class="text-danger">
                        @error('email')
                            {{$message}}
                        @enderror
                    </span>
                </div>

                @if ($form_status == "new")
                    <div class="form-group col-md-6 required">
                        <label for="password">Password:</label>
                        <input type="text" name="password" id="password" class="form-control" >
                        <span class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-6 required">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        <span class="text-danger">
                            @error('confirm_password')
                                {{$message}}
                            @enderror
                        </span>
                    </div>
                @endif

                <div class="form-group col-md-6 required">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" class="form-control" value="{{old('country') ?? $customer->country}}">
                    <span class="text-danger">
                        @error('country')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="state">State:</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{old('state') ?? $customer->state}}">
                    <span class="text-danger">
                        @error('state')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="address">Address:</label>
                    <textarea  name="address" id="address" class="form-control" rows="2">{{{ old('address') ?? $customer->address }}}</textarea>
                    <span class="text-danger">
                        @error('address')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label for="formFile"  class="form-label">Upload Image</label>
                    <input class="form-control" name="customer_image" type="file" id="formFile"
                        accept="image/jpg, image/jpeg, image/png"
                        value="{{old('customer_image') ?? $customer->customer_image}}">

                        @if ($form_status != "new")
                            @if ($customer->customer_image != null)
                                <img src="{{asset("storage/uploads").'/'.$customer->customer_image}}"  id="preview" class="mt-2 mr-2 border border-secondary" width="100" height="100">
                            @else
                                <img src="{{asset('storage/images')}}/men-dummy.png"  id="preview" class="mt-2 mr-2 border border-secondary" width="100" height="100">
                            @endif

                        @else
                            <img src="{{asset('storage/images')}}/100x100.png" id="preview" class="mt-2 mr-2 border border-secondary" width="100" height="100">
                        @endif


                    <span class="text-danger">
                        @error('customer_image')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-6 required">
                    <label>Gender:</label>
                    <div class="">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="M" {{ (old('gender') ?? $customer->gender == 'M') ? ' checked' : '' }} >
                            <label class="form-check-label" for="male" style="position: relative;top: -4px;">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="F" {{ (old('gender') ?? $customer->gender == 'F') ? ' checked' : '' }} >
                            <label class="form-check-label mr-4" for="Female" style="position: relative;top: -4px;">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Other" value="O" {{ (old('gender') ?? $customer->gender == 'O') ? ' checked' : '' }} >
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
                    <input type="date" name="dob" id="dob" class="form-control" value="{{old('dob') ?? get_formatted_date($customer->dob, 'Y-m-d') }}" />
                    <span class="text-danger">
                        @error('dob')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary w-100">{{$form_submit_text}}</button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
