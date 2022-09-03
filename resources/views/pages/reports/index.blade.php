@extends('layouts.app')

@push('js')
    <script src="{{asset('js/reports.js')}}"></script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Report Template</div>
                    <div class="card-body">
                        <form action="{{route('reports.store')}}" method="post">
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
                                    <th>Template</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->htmlReport}}</td>
                                        <td>{{$item->isActive ? 'Active':'Deactivated'}}</td>
                                        <td>
                                            <button class="btn btn-success"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-warning"><i class="fa fa-check"></i></button>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
