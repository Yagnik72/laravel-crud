@extends('layouts.main')
@push('title') <title>Register</title> @endpush
@section('main-section')
<div class="d-flex align-items-center" style="height: 100vh;">

    <div class="container bg-white py-3 rounded">
        <div class="row ">
             @php
                echo "<pre>";
                print_r($errors->all());
                echo "</pre>";
            @endphp
            {!! Form::open([
                'url' => url('registration'),
                'method' => 'post',
                'id' => 'register',
                'class' => 're-form',
                'enctype' => 'multipart/form-data'
            ]) !!}

            <div class="row ">
                <div class="col-md-4 mb-3">
                    {!!Form::text('name','',[
                        'name'=>"name", 'id'=>"name", 'class'=>"form-control", 'placeholder' => 'Name'
                    ])!!}
                </div>
                <div class="col-md-4 mb-3">
                    {!!Form::email('email','',[
                        'name'=>"email", 'id'=>"email", 'class'=>"form-control", 'placeholder' => 'Email'
                    ])!!}
                </div>
                <div class="col-md-4 mb-3">
                    {!!Form::password('password',[
                            'name'=>"password", 'id'=>"password", 'class'=>"form-control", 'placeholder' =>'Password'
                    ])!!}
                </div>
                <div class="col-md-4 mb-3">
                    {!!Form::select('status', ['0' => 'Inactive', '1' => 'Active'], null, ['placeholder' => 'Select Account Status','class'=>"form-select",'aria-label'=>"Default select example"]);!!}
                </div>
                <div class="col-md-4 mb-3">
                    {!!Form::selectMonth('month', '',['class'=>"form-select"])!!}
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check form-check-inline">
                        {!!Form::radio('gender','M', '',[
                            'name'=>"gender", 'id'=>"male", 'class'=>"form-check-input"
                        ])!!}
                        <label class="form-check-label" for="male" style="position: relative;top: -4px;">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!!Form::radio('gender','F', '',[
                            'name'=>"gender", 'id'=>"fmale", 'class'=>"form-check-input"
                        ])!!}
                        <label class="form-check-label" for="fmale" style="position: relative;top: -4px;">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {!!Form::radio('gender','O', '',[
                            'name'=>"gender", 'id'=>"other", 'class'=>"form-check-input"
                        ])!!}
                        <label class="form-check-label" for="other" style="position: relative;top: -4px;">Other</label>
                    </div>
                </div>

                <div class="form-group mb-3">
                    {!! Form::submit('Submit form',[
                        'class'=>"btn btn-primary"
                    ]); !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>

@endsection
