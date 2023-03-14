
@extends('layouts.main')
@push('title')
    <title>Home</title>
@endpush
@section('main-section')
    <h2 class="text-white">Home</h2>
    @if (session()->has('error_message'))
        <div class="alert alert-danger home-login-error d-none" data-error-message="{{ session()->get("error_message") }}" role="alert"></div>
    @endif

@endsection
