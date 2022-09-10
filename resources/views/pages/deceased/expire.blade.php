@extends('layouts.app')

@push('js')
    <script>
        $(document).ready(function(){
            $('#table-deleted').DataTable({
                'iDisplayLength': 50,
                'lengthMenu': [50, 100, 300, 500]
            });
        })
    </script>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-sm-12">
            <select name="" id="" class="form-control">
                @foreach ($years as $year)
                    @if(date('Y') == $year)
                        <option value="{{$year}}" selected>{{$year}}</option>
                    @else
                        <option value="{{$year}}">{{$year}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-stripped" id="table-deleted">
                        <thead>
                            <th>Name</th>
                            <th>Date Died</th>
                            <th>Internment</th>
                            <th>Expiry</th>
                            <th>Location</th>
                            <th>Vicinity</th>
                            <th>Area</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
