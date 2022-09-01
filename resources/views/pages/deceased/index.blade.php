@extends('layouts.app')

@push('js')
    <script src="{{asset('js/deceased.js')}}"></script>
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
<div class="container-fluid">
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
                                <th>Remarks</th>
                                <th>OR #</th>
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
{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="deleteModalBody">
            <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form id="formDelete">
                @csrf
                <input type="hidden" value="" id="deleteId">
                <button type="submit" class="btn btn-primary">Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>

{{-- Showing Details Modal --}}
<div class="modal fade modal-xl" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Viewing Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <div class="container-fluid">
                <form action="" method="POST">
                    <h5>Record of</h5>
                    <hr>
                    @csrf
                    @include('pages.common.template_deceased_form', [
                        'isEdit' => true
                    ])
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="updateFormBtn">Update</button>
        </div>
      </div>
    </div>
</div>

{{-- Showing lighting modal --}}
<div class="modal fade modal-xl" id="lightingModal" tabindex="-1" role="dialog" aria-labelledby="lightingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lightingModalLabel">PASUGA</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="lightingModalBody">
            <div class="row">
                <div class="col-sm-3">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" value="" id="deceasedPerson" />
                        <p id=""></p>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" />
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="dateOfConnection" class="col-md-4 col-form-label text-md-right">{{ __('Date of connection *') }}</label>
                                <input id="dateOfConnection" type="text" class="form-control @error('dateOfConnection') is-invalid @enderror" name="dateOfConnection" />
        
                                @error('dateOfConnection')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="expiryDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                                <input id="expiryDate" type="text" class="form-control @error('expiryDate') is-invalid @enderror" name="expiryDate" />
        
                                @error('expiryDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" />
        
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="ornumber" class="col-md-4 col-form-label text-md-right">{{ __('OR Number') }}</label>
                                <input id="ornumber" type="text" class="form-control @error('ornumber') is-invalid @enderror" name="ornumber" />
        
                                @error('ornumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped" id="tableLightings">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Connection</th>
                                        <th>Expiry</th>
                                        <th>Amount</th>
                                        <th>OR #</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>

{{-- Showing printing modal --}}
<div class="modal fade" id="printingModal" tabindex="-1" role="dialog" aria-labelledby="printingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="printingModalLabel">Print</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="printModalBody">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            First Document
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            Second Document
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Print</button>
        </div>
      </div>
    </div>
</div>
@endsection
