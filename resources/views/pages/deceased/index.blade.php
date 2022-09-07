@extends('layouts.app')

@push('js')
    <script>
        const lightingStore = '{!! route('lighting.store') !!}'
        const lightingUpdate = '{!! route('lighting.update', '') !!}'
        const lightingOne = '{!! route('lighting.lighting', "pasugaId") !!}'
    </script>
    <script src="{{asset('js/deceased.js')}}"></script>
    <script src="{{asset('js/pasuga.js')}}"></script>
@endpush

@push('css')
<style>
    #deceasedForm label,
    #detailModalBody label,
    #lightingModal label{
        width: 100%;
    }
    .card-form .card-header {
        display: flex;
    }
    .card-form .card-header p{
        margin: 0;
        flex: 1;
    }
    .right-text {
        text-align: right;
    }
</style>
@endpush

@section('content')
<div class="container-fluid mt-2 mb-2">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-form">
                <div class="card-header"><p>{{ __('Add Record') }}</p><p class="right-text">Fields with * are required</p></div>

                <div class="card-body">
                    <form action="{{route('deceased.store')}}" method="POST" id="deceasedForm">
                        @csrf
                        @include('pages.common.template_deceased_form')
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deceased Record') }}</div>

                <div class="card-body">
                    <table class="table table-stripped" id="deceasedTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Internment</th>
                                <th>Location</th>
                                <th>OR #</th>
                                <th>Approved</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.deceased.modals')
@endsection
