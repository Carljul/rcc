@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/login.js') }}"></script>
@endpush

@section('content')
<div class="container text-center">
    <div class="row d-grid justify-content-center align-items-center position-relative">
        <center>
            <div id="login-image"></div>
        </center>
        <form method="POST" class="mt-5" id="login-form" action="{{ route('login') }}">
            @csrf
            {{-- email --}}
            <span type="text" id="form-email">{{ $user->email }}</span>
            <span class="times">&times;</span>

            <div class="input-group mb-3 input-email-cont d-none">
                <input type="email" class="form-control" id="new-email" placeholder="Enter email . . ." aria-label="Email" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="confirm-button"><span>&#10004;</span></button>
            </div>

            <input type="hidden" name="email" id="email" value="{{ $user->email }}">

            {{-- password --}}
            <div class="mt-5">
                <div class="pass-dots"></div>
                <div class="pass-dots"></div>
                <div class="pass-dots"></div>
                <div class="pass-dots"></div>
                <div class="pass-dots"></div>
                <div class="pass-dots"></div>
            </div>
            <input type="password" class="position-absolute password-field" id="password" name="password">
        </form>
    </div>
</div>
@endsection
