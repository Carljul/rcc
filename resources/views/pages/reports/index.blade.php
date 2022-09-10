@extends('layouts.app')

@push('css')
    <style>
        .btn-cancel{
            display: none;
        }
        .btn-cancel.active{
            display: initial;
        }
    </style>
@endpush

@push('js')
    <script src="{{asset('js/reports.js')}}"></script>
@endpush

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Report Template</div>
                    <div class="card-body">
                        <form action="{{route('reports.store')}}" method="post" id="templateForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Template Name</label>
                                    <input type="text" class="form-control" name="name" id="name"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="htmlReport">Template</label>
                                    <textarea class="form-control" name="htmlReport" id="htmlReport" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit">Save</button>
                                    <a href="{{route('reports.index')}}" class="btn btn-warning btn-cancel">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Report Templates</div>
                    <div class="card-body">
                        <table class="table table-stripped" id="reportTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->isActive ? 'Active':'Deactivated'}}</td>
                                        <td>
                                            <button class="btn btn-success btn-update" data-id="{{$item->id}}"><i class="fa fa-edit"></i></button>
                                            @php($icon = $item->isActive ? 'times':'check')
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#activateTemplate{{$item->id}}"><i class="fa fa-{{$icon}}"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="activateTemplate{{$item->id}}" tabindex="-1" aria-labelledby="activateTemplate{{$item->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="activateTemplate{{$item->id}}Label">Update template</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to update this template?</p>
                                                            <form action="{{route('reports.update', $item->id)}}" method="post">
                                                                @csrf
                                                                {{method_field('PUT')}}
                                                                <input type="hidden" name="isActiveOnly" value="true" />
                                                                <button type="submit" class="btn btn-success">{{$item->isActive ? 'Deactivate' : 'Activate'}}</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTemplate{{$item->id}}"><i class="fa fa-trash"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteTemplate{{$item->id}}" tabindex="-1" aria-labelledby="deleteTemplate{{$item->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title" id="deleteTemplate{{$item->id}}Label">Delete template Confirmation</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this template?</p>
                                                            <form action="{{route('reports.destroy', $item->id)}}" method="post">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                                <button type="submit" class="btn btn-success">Delete</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
