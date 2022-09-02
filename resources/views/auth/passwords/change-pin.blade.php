@extends('layouts.app')

@push('js')
    <script src="{{ asset('js/login.js') }}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mt-5">
                {{-- alert message --}}
                @include('common.template_alert')
            </div>

            <div class="card mt-5">
                <div class="card-header">{{ __('Change PIN') }}</div>
                <div class="card-body">
                    <form action="{{ route('change-pin') }}" method="post">
                        @csrf
                        <div class="form-group mt-3 ">
                            <label for="current_password">Current PIN</label>
                            <input type="password" name="current_password" class="form-control change-pin-input" value="{{ old('current_password') }}">
                            @if($errors->has('current_password'))
                                <span class="invalid-feedback @if($errors->has('current_password')) d-block @endif" role="alert">
                                    <strong><small>{{ $errors->first('current_password') }}</small></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mt-3 ">
                            <label for="password">New PIN</label>
                            <input type="password" name="password" class="form-control change-pin-input" value="{{ old('password') }}">
                            @if($errors->has('password'))
                                <span class="invalid-feedback @if($errors->has('password')) d-block @endif" role="alert">
                                    <strong><small>{{ $errors->first('password') }}</small></strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mt-3 ">
                            <label for="confirm_password">Confirm PIN</label>
                            <input type="password" name="password_confirmation" class="form-control change-pin-input" value="{{ old('password_confirmation') }}">
                            @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback @if($errors->has('password_confirmation')) d-block @endif" role="alert">
                                    <strong><small>{{ $errors->first('password_confirmation') }}</small></strong>
                                </span>
                            @endif
                        </div>
                        <input type="submit" value="Change" class="mt-3 btn btn-primary float-end">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
