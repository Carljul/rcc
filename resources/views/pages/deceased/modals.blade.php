
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
                @include('pages.common.template_deceased_form', [
                    'isEdit' => true
                ])
            </div>
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
              <div class="col-sm-12">
                <p><strong>Please select certificate</strong></p>
              </div>
            </div>
            <div class="row" id="templates">
            </div>
            <hr>
            <form action="" method="GET" id="formReport">
                @csrf
                <input type="hidden" name="report" id="reportSelected" />
                <div class="row">
                    <div class="col-sm-12">
                        Selected: <p class="reportSelectedText"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="contractNo" class="col-md-4 col-form-label text-md-right">{{ __('Contract No') }}</label>
                        <input id="contractNo" type="text" class="form-control @error('contractNo') is-invalid @enderror" name="contractNo" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="lessor" class="col-md-4 col-form-label text-md-right">{{ __('Lessor') }}</label>
                        <input id="lessor" type="text" class="form-control @error('lessor') is-invalid @enderror" name="lessor" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="lesse" class="col-md-4 col-form-label text-md-right">{{ __('Lesse') }}</label>
                        <input id="lesse" type="text" class="form-control @error('lesse') is-invalid @enderror" name="lesse" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="moderator" class="col-md-4 col-form-label text-md-right">{{ __('Parish Team Moderator') }}</label>
                        <input id="moderator" type="text" class="form-control @error('moderator') is-invalid @enderror" name="moderator" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="member" class="col-md-4 col-form-label text-md-right">{{ __('Parish Team Member') }}</label>
                        <input id="member" type="text" class="form-control @error('member') is-invalid @enderror" name="member" />
                    </div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="createPDF">Create</button>
        </div>
      </div>
    </div>
</div>
