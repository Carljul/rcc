@extends('layouts.app')

@push('js')
    <script src="{{asset('js/deceased.js')}}"></script>
@endpush

@push('css')
<style>
    #deceasedForm label,
    #detailModalBody label{
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
                                <th>Died</th>
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
<div class="modal fade" id="lightingModal" tabindex="-1" role="dialog" aria-labelledby="lightingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lightingModalLabel">PASUGA</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="lightingModalBody">
            <h4>Pasuga</h4>
            <hr>
            <form action="" method="POST">
                @csrf
                <input type="hidden" value="" id="deceasedPerson" />
                <p></p>
                <div class="row">
                    <div class="col-md-6">
                        <label for="viewfirstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name *') }}</label>
                        <input id="viewfirstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required />

                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="viewmiddlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
                        <input id="viewmiddlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" />

                        @error('middlename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>
@endsection
