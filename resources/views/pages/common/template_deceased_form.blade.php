@if(!isset($isEdit))
<div class="row">
    <div class="col-md-4">
        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name *') }}</label>
        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required />

        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
        <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" />

        @error('middlename')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name *') }}</label>
        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" />

        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="extension" class="col-md-4 col-form-label text-md-right">{{ __('Name Extension') }}</label>
        <input id="extension" type="text" class="form-control" name="extension" />
    </div>
    <div class="col-md-6">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
        <select name="gender" id="gender" class="form-control">
            <option value="null">Gender</option>
            <option value="0">Male</option>
            <option value="1">Female</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birth date') }}</label>
        <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" />
    </div>
    <div class="col-md-6">
        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
        <input id="address" type="text" class="form-control" name="address" />
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="dateDied" class="col-md-4 col-form-label text-md-right">{{ __('Date Died *') }}</label>
        <input id="dateDied" type="date" class="form-control @error('dateDied') is-invalid @enderror" name="dateDied" />
    </div>
    <div class="col-md-4">
        <label for="internmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Date Internment') }}</label>
        <input id="internmentDate" type="date" class="form-control @error('internmentDate') is-invalid @enderror" name="internmentDate" />
    </div>
    <div class="col-md-4">
        <label for="expiryDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
        <input id="expiryDate" type="date" class="form-control @error('expiryDate') is-invalid @enderror" name="expiryDate" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="internmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Time Internment') }}</label>
        <input id="internmentTime" type="time" class="form-control @error('internmentTime') is-invalid @enderror" name="internmentTime" />
    </div>
    <div class="col-md-6">
        <label for="cod" class="col-md-4 col-form-label text-md-right">{{ __('Cause of death') }}</label>
        <input id="cod" type="text" class="form-control @error('cod') is-invalid @enderror" name="cod" />
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" />
    </div>
    <div class="col-md-4">
        <label for="vicinity" class="col-md-4 col-form-label text-md-right">{{ __('Vicinity') }}</label>
        <input id="vicinity" type="text" class="form-control" name="vicinity" />
    </div>
    <div class="col-md-4">
        <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>
        <input id="area" type="text" class="form-control" name="area" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="payer" class="col-md-4 col-form-label text-md-right">{{ __('Payer') }}</label>
        <input id="payer" type="text" class="form-control" name="payer" />
    </div>
    <div class="col-md-6">
        <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Payer Contact #') }}</label>
        <input id="contact_number" type="text" class="form-control" name="contact_number" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
        <input id="amount" type="text" class="form-control" name="amount" />
    </div>
    <div class="col-md-6">
        <label for="ornumber" class="col-md-4 col-form-label text-md-right">{{ __('OR #') }}</label>
        <input id="ornumber" type="text" class="form-control" name="ornumber" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>
        <input id="balance" type="text" class="form-control" name="balance" />
    </div>
    <div class="col-md-6">
        <label for="terms_of_payment" class="col-md-4 col-form-label text-md-right">{{ __('Terms of Payment') }}</label>
        <input id="terms_of_payment" type="text" class="form-control" name="terms_of_payment" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="datepaid" class="col-md-4 col-form-label text-md-right">{{ __('Date paid') }}</label>
        <input id="datepaid" type="date" class="form-control" name="datepaid" />
    </div>
    <div class="col-md-6">
        <label for="remarks" class="col-md-12 col-form-label text-md-right">{{ __('Remarks') }}</label>
        <input id="remarks" type="text" class="form-control" name="remarks" />
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>

@else

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Info</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Payments</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row">
            <div class="col-sm-6">
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
                <div class="row">
                    <div class="col-md-6">
                        <label for="viewlastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name *') }}</label>
                        <input id="viewlastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" />

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="viewextension" class="col-md-4 col-form-label text-md-right">{{ __('Name Extension') }}</label>
                        <input id="viewextension" type="text" class="form-control @error('extension') is-invalid @enderror" name="extension" />

                        @error('extension')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="viewgender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                        <select name="gender" id="viewgender" class="form-control">
                            <option value="null">Gender</option>
                            <option value="0">Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="viewbirthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birth date') }}</label>
                        <input id="viewbirthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="viewaddress" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                        <input id="viewaddress" type="text" class="form-control @error('address') is-invalid @enderror" name="address" />

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="viewdateDied" class="col-form-label text-md-right">{{ __('Date Died') }}</label>
                        <input id="viewdateDied" type="date" class="form-control" name="dateDied" />
                    </div>
                    <div class="col-md-4">
                        <label for="viewinternmentDate" class="col-form-label text-md-right">{{ __('Date Internment') }}</label>
                        <input id="viewinternmentDate" type="date" class="form-control" name="internmentDate" />
                    </div>
                    <div class="col-md-4">
                        <label for="viewexpiryDate" class="col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                        <input id="viewexpiryDate" type="date" class="form-control" name="expiryDate" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="viewinternmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Time Internment') }}</label>
                        <input id="viewinternmentTime" type="time" class="form-control @error('internmentTime') is-invalid @enderror" name="internmentTime" />
                    </div>
                    <div class="col-md-6">
                        <label for="viewcod" class="col-md-4 col-form-label text-md-right">{{ __('Cause of death') }}</label>
                        <input id="viewcod" type="text" class="form-control @error('cod') is-invalid @enderror" name="cod" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-md-4">
                        <label for="viewlocation" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                        <input id="viewlocation" type="text" class="form-control @error('location') is-invalid @enderror" name="location" />
                    </div>
                    <div class="col-md-4">
                        <label for="viewVicinity" class="col-md-4 col-form-label text-md-right">{{ __('Vicinity') }}</label>
                        <input id="viewVicinity" type="text" class="form-control" name="vicinity" />
                    </div>
                    <div class="col-md-4">
                        <label for="viewArea" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>
                        <input id="viewArea" type="text" class="form-control" name="area" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="viewRemarks" class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>
                        <input id="viewRemarks" type="text" class="form-control @error('viewRemarks') is-invalid @enderror" name="viewRemarks" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <strong><p id="isApprove"></p></strong>
                        <p id="recordLogCreated"></p>
                        <p id="recordLogUpdated"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-success float-right" id="updateFormBtn">Update</button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row mt-2">
            <div class="col-sm-4">
                {{-- <form action="{{route('payment.store')}}" method="POST" id="paymentForm"> --}}
                <form action="" method="POST" id="paymentForm">
                    @csrf
                    <input type="hidden" value="" id="deceasedPerson" name="id" />
                    <div class="row">
                        <div class="col-md-12">
                            <label for="payer" class="col-md-4 col-form-label text-md-right">{{ __('Payer *') }}</label>
                            <input id="payer" type="text" class="form-control" name="payer" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>
                            <input id="contact_number" type="text" class="form-control" name="contact_number" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                            <input id="amount" type="text" class="form-control" name="amount" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="ornumber" class="col-md-4 col-form-label text-md-right">{{ __('OR Number') }}</label>
                            <input id="ornumber" type="text" class="form-control" name="ornumber" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>
                            <input id="balance" type="text" class="form-control" name="balance" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="temrs_of_payment" class="col-md-4 col-form-label text-md-right">{{ __('Terms of Payment') }}</label>
                            <input id="temrs_of_payment" type="text" class="form-control" name="temrs_of_payment" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="remarks" class="col-md-4 col-form-label text-md-right">{{ __('remarks') }}</label>
                            <input id="remarks" type="text" class="form-control" name="remarks" />
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="form-control btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped" id="amountTable">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>OR #</th>
                            <th>Date Paid</th>
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
@endif
