@extends('layouts.app')

@push('js')
    <script src="{{asset('js/deceased.js')}}"></script>
@endpush

@push('css')
<style>
    #deceasedForm label{
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
                                <th>Expiry</th>
                                <th>Location</th>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="deleteModalBody">
            <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <form action="" method="POST">
                @csrf
                <h5>Record of</h5>
                <hr>
                @include('pages.common.template_deceased_form')
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection
