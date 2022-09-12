@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Defaults Certification') }}</div>

                <div class="card-body">
                    <form action="{{route('defaults.update', $defaults->id)}}" method="post">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="cemetery_administrator" class="col-md-4 col-form-label text-md-right">{{ __('Cemetery Administrator') }}</label>
                                <input id="cemetery_administrator" type="text" class="form-control" name="cemetery_administrator" value="{{$defaults->cemetery_administrator}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="parish_office_staff" class="col-md-4 col-form-label text-md-right">{{ __('Parish Office Staff') }}</label>
                                <input id="parish_office_staff" type="text" class="form-control" name="parish_office_staff" value="{{$defaults->parish_office_staff}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="parish_team_moderator" class="col-md-4 col-form-label text-md-right">{{ __('Parish Team Moderator') }}</label>
                                <input id="parish_team_moderator" type="text" class="form-control" name="parish_team_moderator" value="{{$defaults->parish_team_moderator}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="parish_team_member" class="col-md-4 col-form-label text-md-right">{{ __('Parish Team Member') }}</label>
                                <input id="parish_team_member" type="text" class="form-control" name="parish_team_member" value="{{$defaults->parish_team_member}}"/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
