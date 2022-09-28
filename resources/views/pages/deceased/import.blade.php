@extends('layouts.app')

@push('css')
    <style>
        .float-button-circle {
            position: absolute;
            right: 1.5%;
            bottom: 2%;
            border-radius: 128px;
            width: 50px;
            height: 50px;
        }
    </style>
@endpush

@push('js')
    <script src="{{asset('js/jszip.js')}}"></script>
    <script src="{{asset('js/xlsx.js')}}"></script>
    <script src="{{asset('js/import.js?'.strtotime(now()))}}"></script>
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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning float-button-circle" data-bs-toggle="modal" data-bs-target="#withIssueImport" id="withIssueImportButton">
        <i class="fa fa-exclamation-triangle"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          0
        </span>
    </button>
  
    <!-- Modal -->
    <div class="modal fade" id="withIssueImport" tabindex="-1" aria-labelledby="withIssueImportLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="withIssueImportLabel">Import with issues</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Extension Name</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Date Died</th>
                                <th>Date Internment</th>
                                <th>Time Internment</th>
                                <th>Expiry Date</th>
                                <th>Cause of Death</th>
                                <th>Location</th>
                                <th>Vicinity</th>
                                <th>Area</th>
                                <th>Payer</th>
                                <th>Lease Amount</th>
                                <th>Amount</th>
                                <th>Contact Number</th>
                                <th>OR Number</th>
                                <th>Date Paid</th>
                                <th>Balance</th>
                                <th>Terms of Payment</th>
                                <th>Remarks</th>
                                <th>Pasuga Payer</th>
                                <th>Date of Connection</th>
                                <th>Expiry Date</th>
                                <th>Amount</th>
                                <th>Number</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="clearIssues">Clear Issues</button>
                </div>
            </div>
        </div>
    </div>
@endsection
