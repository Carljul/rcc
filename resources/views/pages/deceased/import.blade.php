@extends('layouts.app')

@push('js')
    <script src="{{asset('js/import.js')}}"></script>
@endpush

@section('content')
    <div class="container-fluid mt-3 h-100p">
        <div class="row h-100p">
            <div class="col-sm-12">
                <div id="drop-area" class="h-100p">
                    <form class="my-form">
                      <p>Upload multiple files with the file dialog or by dragging and dropping excel(.xlsx | .xls) file onto the dashed region</p>
                      <input type="file" id="fileElem" multiple accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="handleFiles(this.files)">
                      <label class="button" for="fileElem">Select some files</label>
                    </form>
                </div>
                <div id="progress-area" class="hide">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped" id="fileList">
                                <thead>
                                    <tr>
                                        <th>Filename</th>
                                        <th>Progress</th>
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
    </div>
@endsection