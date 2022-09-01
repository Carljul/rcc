@if(!isset($isEdit))
<div class="row">
    <div class="col-md-6">
        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name *') }}</label>
        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required />

        @error('firstname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
        <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" />

        @error('middlename')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name *') }}</label>
        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" />

        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="extension" class="col-md-4 col-form-label text-md-right">{{ __('Name Extension') }}</label>
        <input id="extension" type="text" class="form-control @error('extension') is-invalid @enderror" name="extension" />

        @error('extension')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
        <select name="gender" id="gender" class="form-control">
            <option value="null">Gender</option>
            <option value="0">Male</option>
            <option value="1">Female</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birth date') }}</label>
        <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" />

        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="dateDied" class="col-md-4 col-form-label text-md-right">{{ __('Date Died *') }}</label>
        <input id="dateDied" type="date" class="form-control @error('dateDied') is-invalid @enderror" name="dateDied" />

        @error('dateDied')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="internmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Date Internment') }}</label>
        <input id="internmentDate" type="date" class="form-control @error('internmentDate') is-invalid @enderror" name="internmentDate" />

        @error('internmentDate')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="internmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Time Internment') }}</label>
        <input id="internmentTime" type="time" class="form-control @error('internmentTime') is-invalid @enderror" name="internmentTime" />
    </div>
    <div class="col-md-6">
        <label for="expiryDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
        <input id="expiryDate" type="date" class="form-control @error('expiryDate') is-invalid @enderror" name="expiryDate" />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="cod" class="col-md-4 col-form-label text-md-right">{{ __('Cause of death') }}</label>
        <input id="cod" type="text" class="form-control @error('cod') is-invalid @enderror" name="cod" />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" />
    </div>
    <div class="col-md-6">
        <label for="ornumber" class="col-md-4 col-form-label text-md-right">{{ __('OR #') }}</label>
        <input id="ornumber" type="text" class="form-control @error('ornumber') is-invalid @enderror" name="ornumber" />
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="datepaid" class="col-md-4 col-form-label text-md-right">{{ __('Date paid') }}</label>
        <input id="datepaid" type="date" class="form-control @error('datepaid') is-invalid @enderror" name="datepaid" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="relativeFirstname" class="col-md-4 col-form-label text-md-right">{{ __('Relative first name') }}</label>
        <input id="relativeFirstname" type="text" class="form-control @error('relativeFirstname') is-invalid @enderror" name="relativeFirstname" />
    </div>
    <div class="col-md-6">
        <label for="relativeMiddlename" class="col-md-4 col-form-label text-md-right">{{ __('Relative middle name') }}</label>
        <input id="relativeMiddlename" type="text" class="form-control @error('relativeMiddlename') is-invalid @enderror" name="relativeMiddlename" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="relativeLastname" class="col-md-4 col-form-label text-md-right">{{ __('Relative last name') }}</label>
        <input id="relativeLastname" type="text" class="form-control @error('relativeLastname') is-invalid @enderror" name="relativeLastname" />
    </div>
    <div class="col-md-6">
        <label for="relativeContactNumber" class="col-md-4 col-form-label text-md-right">{{ __('Relative Contact Number') }}</label>
        <input id="relativeContactNumber" type="text" class="form-control @error('relativeContactNumber') is-invalid @enderror" name="relativeContactNumber" />
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>

@else

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
            <div class="col-md-6">
                <label for="viewdateDied" class="col-md-4 col-form-label text-md-right">{{ __('Date Died *') }}</label>
                <input id="viewdateDied" type="date" class="form-control @error('dateDied') is-invalid @enderror" name="dateDied" />

                @error('dateDied')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="viewinternmentDate" class="col-md-4 col-form-label text-md-right">{{ __('Date Internment') }}</label>
                <input id="viewinternmentDate" type="date" class="form-control @error('internmentDate') is-invalid @enderror" name="internmentDate" />

                @error('internmentDate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="viewinternmentTime" class="col-md-4 col-form-label text-md-right">{{ __('Time Internment') }}</label>
                <input id="viewinternmentTime" type="time" class="form-control @error('internmentTime') is-invalid @enderror" name="internmentTime" />
            </div>
            <div class="col-md-6">
                <label for="viewexpiryDate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                <input id="viewexpiryDate" type="date" class="form-control @error('expiryDate') is-invalid @enderror" name="expiryDate" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="viewcod" class="col-md-4 col-form-label text-md-right">{{ __('Cause of death') }}</label>
                <input id="viewcod" type="text" class="form-control @error('cod') is-invalid @enderror" name="cod" />
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-md-12">
                <label for="viewlocation" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                <input id="viewlocation" type="text" class="form-control @error('location') is-invalid @enderror" name="location" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h5>Payment</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="viewamount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                <input id="viewamount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" />
            </div>
            <div class="col-md-6">
                <label for="viewornumber" class="col-md-4 col-form-label text-md-right">{{ __('OR #') }}</label>
                <input id="viewornumber" type="text" class="form-control @error('ornumber') is-invalid @enderror" name="ornumber" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="viewdatepaid" class="col-md-4 col-form-label text-md-right">{{ __('Date paid') }}</label>
                <input id="viewdatepaid" type="date" class="form-control @error('datepaid') is-invalid @enderror" name="datepaid" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <h5>Relative</h5>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="viewrelativeFirstname" class="col-md-4 col-form-label text-md-right">{{ __('Relative first name') }}</label>
                <input id="viewrelativeFirstname" type="text" class="form-control @error('relativeFirstname') is-invalid @enderror" name="relativeFirstname" />
            </div>
            <div class="col-md-6">
                <label for="viewrelativeMiddlename" class="col-md-4 col-form-label text-md-right">{{ __('Relative middle name') }}</label>
                <input id="viewrelativeMiddlename" type="text" class="form-control @error('relativeMiddlename') is-invalid @enderror" name="relativeMiddlename" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="viewrelativeLastname" class="col-md-4 col-form-label text-md-right">{{ __('Relative last name') }}</label>
                <input id="viewrelativeLastname" type="text" class="form-control @error('relativeLastname') is-invalid @enderror" name="relativeLastname" />
            </div>
            <div class="col-md-6">
                <label for="viewrelativeContactNumber" class="col-md-4 col-form-label text-md-right">{{ __('Relative Contact Number') }}</label>
                <input id="viewrelativeContactNumber" type="text" class="form-control @error('relativeContactNumber') is-invalid @enderror" name="relativeContactNumber" />
            </div>
        </div>
    </div>
</div>
@endif