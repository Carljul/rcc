@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <img src="{{ asset('img/App icon.png') }}" alt="">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <span type="text" id="form-email">{{ $user->email }}</span>
            <div class="form-group text-center">
            </div>
            <div class="form-group">
                <span class="pass-dots"></span>
                <span class="pass-dots"></span>
                <span class="pass-dots"></span>
                <span class="pass-dots"></span>
                <span class="pass-dots"></span>
                <span class="pass-dots"></span>
            </div>
        </form>
    </div>
</div>
@endsection
