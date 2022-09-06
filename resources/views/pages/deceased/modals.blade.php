
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
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Viewing Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <div class="container-fluid">
                <form action="" method="POST" id="updateFormDeceased">
                    @csrf
                    {{ method_field('PUT') }}
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
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lightingModalLabel">Apply PASUGA</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="lightingModalBody">
            <div class="row">
                <div class="col-sm-3">
                    <form action="{{route('lighting.store')}}" method="POST" id="lightingForm">
                        @csrf
                        <input type="hidden" value="" id="deceasedPerson" name="id" />
                        <p id="recordOf"></p>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Payer *') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" />

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="dateOfConnection" class="col-md-4 col-form-label text-md-right">{{ __('Date of connection *') }}</label>
                                <input id="dateOfConnection" type="date" class="form-control @error('dateOfConnection') is-invalid @enderror" name="dateOfConnection" />

                                @error('dateOfConnection')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="expiryDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                                <input id="expiryDate" type="date" class="form-control @error('expiryDate') is-invalid @enderror" name="expiryDate" />

                                @error('expiryDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" />

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
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
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="form-control btn btn-primary">Save</button>
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
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Connection</th>
                                        <th>Expiry</th>
                                        <th>Amount</th>
                                        <th>OR #</th>
                                        <th>Status</th>
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
        </div>
      </div>
    </div>
</div>

{{-- Delete Lighting Confirmation Modal --}}
<div class="modal fade" id="deleteLightingModal" tabindex="1" role="dialog" aria-labelledby="deleteLightingModalabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteLightingModalLabel">Delete PASUGA Confirmation</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="deleteLightingModalBody">
            <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form id="formLightingDelete">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-primary">Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>

{{-- Approval Confirmation Modal --}}
<div class="modal fade" id="approveDeceasedModal" tabindex="1" role="dialog" aria-labelledby="approveDeceasedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approveDeceasedModalLabel">Approve Confirmation</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="approveDeceasedModalBody">
            <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form id="formDeceasedApproval">
                @csrf
                {{ method_field('PUT') }}
                <button type="submit" class="btn btn-primary">Approve</button>
          </form>
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
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Print</button>
        </div>
      </div>
    </div>
</div>
