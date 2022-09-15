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
        <div class="col-sm-6">
            <form action="{{route('deceased.expired')}}" method="post">
                @csrf
                <div class="btn-group form-control p-0 b-0 br-0">
                    <select name="year" class="form-control">
                        @foreach ($years as $year)
                            @if($selected == $year)
                                <option value="{{$year}}" selected>{{$year}}</option>
                            @else
                                <option value="{{$year}}">{{$year}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <form action="{{route('export.expired', $selected)}}" method="GET">
                <button type="submit" class="btn btn-success">Export</button>
            </form>
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
                            @foreach ($data as $item)
                                @php($name = $item->person->firstname.' '.$item->person->middlename.' '.$item->person->lastname.' '.$item->person->extension)
                                <tr>
                                    <td>{{$name}}</td>
                                    <td>{{$item->dateDied}}</td>
                                    <td>{{$item->internmentDate}} {{$item->internmentTime}}</td>
                                    <td>{{$item->expiryDate}}</td>
                                    <td>{{$item->location}}</td>
                                    <td>{{$item->vicinity}}</td>
                                    <td>{{$item->area}}</td>
                                    <td>{{$item->remarks}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}">
                                            Delete
                                        </button>

                                        <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$item->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal{{$item->id}}Label">Delete Confirmation</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete {{$name}}?</p>
                                                        <form action="{{route('deceased.update', $item->id)}}" method="post">
                                                            @csrf
                                                            {{method_field('PUT')}}
                                                            <input type="hidden" name="expiredUpdate" value="true">
                                                            <input type="text" class="form-control mb-3" placeholder="Remarks on deleting" name="remarks">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
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
@endsection
