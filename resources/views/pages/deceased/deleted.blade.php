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
    <div class="row mt-3 justify-content-center">
        <div class="col-sm-12 mb-3">
            <form action="{{route('export.deleted')}}" method="GET">
                <button type="submit" class="btn btn-success">Export</button>
            </form>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-stripped" id="table-deleted">
                        <thead>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Gender</th>
                            <th>Date Died</th>
                            <th>Internment</th>
                            <th>Expiry</th>
                            <th>C.O.D</th>
                            <th>Location</th>
                            <th>Remarks</th>
                        </thead>
                        <tbody>
                            @foreach ($deleted as $item)
                                @php($name = $item->person->firstname.' '.$item->person->middlename.' '.$item->person->lastname.' '.$item->person->extension)
                                <tr>
                                    <td>{{$name}}</td>
                                    <td>{{$item->person->birthdate}}</td>
                                    <td>{{$item->gender == 0 ? 'Male' : 'Female'}}</td>
                                    <td>{{$item->dateDied}}</td>
                                    <td>{{$item->internmentDate}} {{$item->internmentTime}}</td>
                                    <td>{{$item->expiryDate}}</td>
                                    <td>{{$item->causeOfDeath}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>{{$item->remarks}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
