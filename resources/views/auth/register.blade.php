@extends('layouts.app')

@push('js')
    <script src="{{asset('js/sign-up.js')}}"></script>
@endpush

@section('content')
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" minlength="6" maxlength="6" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" minlength="6" maxlength="6" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role *') }}</label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control">
                                    <option value="1">Administrator</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <table class="table table-stripped" id="userTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role == 1 ? 'Administrator':'Staff'}}</td>
                                    <td>
                                        @php($label = $user->isActive ? 'Deactivate' : 'Activate')
                                        <button class="btn btn-{{$label == 'Activate' ? 'warning':'info'}} btn-update" data-id="{{$user->id}}" data-name="{{$user->name}}">{{$label}}</button>                                        

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#userRoleModal{{$user->id}}">
                                            Set to {{$user->role != 1 ? 'Administrator':'Staff'}}
                                        </button>

                                        <div class="modal fade" id="userRoleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="userRoleModal{{$user->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="userRoleModal{{$user->id}}Label">Change Role Confirmation</h5>
                                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body" id="userRoleModal{{$user->id}}">
                                                    <p>Are you sure you want to change role of user {{$user->name}}?</p>
                                                    <p>User will have a role of {{$user->role != 1 ? 'Administrator':'Staff'}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                                    <form action="{{route('user.update', $user->id)}}" method="post">
                                                        @csrf
                                                        {{method_field('PUT')}}
                                                        <input type="hidden" name="userRole" value="true">
                                                        <button type="submit" class="btn btn-danger">Update</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#resetPasswordModal{{$user->id}}">
                                            Reset password
                                        </button>

                                        <div class="modal fade" id="resetPasswordModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModal{{$user->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="resetPasswordModal{{$user->id}}Label">Reset Password Confirmation</h5>
                                                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body" id="resetPasswordModal{{$user->id}}">
                                                    <p>Are you sure you want to reset the password of {{$user->name}}?</p>
                                                    <p>User will have <strong>123456</strong> as its new password.</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        
                                                  <form action="{{route('user.update', $user->id)}}" method="post">
                                                      @csrf
                                                      {{method_field('PUT')}}
                                                      <input type="hidden" name="resetPassword" value="true">
                                                      <button type="submit" class="btn btn-success">Reset</button>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Lighting Confirmation Modal --}}
<div class="modal fade" id="activateUserModal" tabindex="1" role="dialog" aria-labelledby="activateUserModalabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="activateUserModalLabel">Confirmation</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="activateUserModalBody">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form id="formActivateUser" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
