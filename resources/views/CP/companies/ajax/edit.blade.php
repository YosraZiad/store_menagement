<form action="{{ route('update.company.info') }}" method="POST">

    @csrf
    <input type="hidden" name="id" value="{{ $company->id }}">

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Name:') }}</label>

        <div class="col col-10">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') ? old('name') : $company->name }}" required autocomplete="name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="address" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Address:') }}</label>

        <div class="col col-10">
            <input id="address" type="text"
                class="form-control @error('address') is-invalid @enderror" name="address"
                value="{{ old('address') ? old('address') : $company->address }}" required
                autocomplete="address">

            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

         <div class="row mb-3">
                            <label for="company_size"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Company Size') }}</label>
                                <div class="col col-10">
            <input id="company_size" type="text"
                class="form-control @error('company_size') is-invalid @enderror" name="company_size"
                value="{{ old('company_size') ? old('company_size') : $company->company_size }}" required
                autocomplete="company_size">

            @error('company_size')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
                          
                        </div>
                        <div class="row mb-3">
        <label for="phone_number" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Phone Number:') }}</label>

        <div class="col col-10">
            <input id="phone_number" type="text"
                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                value="{{ old('phone_number') ? old('phone_number') : $company->phone_number }}" required
                autocomplete="phone_number">

            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="incorporation_date" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Incorporation Date:') }}</label>

        <div class="col col-10">
            <input id="incorporation_date" type="text"
                class="form-control @error('incorporation_date') is-invalid @enderror" name="incorporation_date"
                value="{{ old('incorporation_date') ? old('incorporation_date') : $company->incorporation_date }}" required
                autocomplete="incorporation_date">

            @error('incorporation_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="industry" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Industry:') }}</label>

        <div class="col col-10">
            <input id="industry" type="text"
                class="form-control @error('industry') is-invalid @enderror" name="industry"
                value="{{ old('industry') ? old('industry') : $company->industry }}" required
                autocomplete="industry">

            @error('industry')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="website" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Website:') }}</label>

        <div class="col col-10">
            <input id="website" type="text"
                class="form-control @error('website') is-invalid @enderror" name="website"
                value="{{ old('website') ? old('website') : $company->website }}" required
                autocomplete="website">

            @error('industry')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="d-flex gap-1 justify-content-end mb-3">

        <button type="reset" class="btn btn-secondary">
            {{ __('Reset Form') }}
        </button>
        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('show.all.categories') }}'>
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('Update company') }}
        </button>

    </div>

</form>
