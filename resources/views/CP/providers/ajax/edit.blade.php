<form action="{{ route('update.provider.info') }}" method="POST">

    @csrf

    <div class="row mb-3">
        <label for="full_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

        <div class="col col-10">
            <div class="input-group">
                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror"
                    name="full_name" value="{{ old('full_name', $item->full_name) }}" required autocomplete="full_name"
                    autofocus>

            </div>
            @error('full_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="short_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Short Name') }}</label>

        <div class="col col-10">
            <input id="short_name" type="text" class="form-control @error('short_name') is-invalid @enderror"
                name="short_name" value="{{ old('short_name', $item->short_name) }}">

            @error('short_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' About') }}</label>

        <div class="col col-10">
            <input id="brief" type="text" class="form-control @error('name') is-invalid @enderror" name="brief"
                value="{{ old('brief', $item->profile->about) }}">

            @error('brief')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Field') }}</label>

        <div class="col col-10">
            <select id="field" class="form-control @error('name') is-invalid @enderror" name="field"
                value="{{ old('field', $item->field) }}">
                <option hidden>{{ __('select one') }}</option>
                @if (!empty($fields))
                    @foreach ($fields as $id => $field)
                        <option value="{{ $id }}">{{ $field }}</option>
                    @endforeach
                @endif
            </select>

            @error('field')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Registry') }}</label>

        <div class="col col-10">
            <div class="input-group">
                <input id="cr_number" type="text" class="form-control @error('cr_number') is-invalid @enderror"
                    name="cr_number" value="{{ old('cr_number', $item->profile->cr_number) }}">
                <input id="vat_number" type="text" class="form-control @error('vat_number') is-invalid @enderror"
                    name="vat_number" value="{{ old('vat_number', $item->profile->vat_number) }}">


            </div>

            @error('cr_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('vat_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Contact') }}</label>

        <div class="col col-10">
            <div class="input-group">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ old('phone', $item->profile->phone) }}">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email', $item->profile->email) }}">


            </div>

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="border btn-group mb-3 p-1" style="float: right">
        <button type="reset" class="btn btn-sm btn-secondary">
            {{ __('Reset Form') }}
        </button>
        <button type="reset" class="btn btn-sm btn-secondary">
            {{ __('Full view') }}
        </button>
        <button type="button" class="btn btn-sm btn-success" data-bs-dismiss="modal" aria-label="Close">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
            {{ __('Add New Provider') }}
        </button>
    </div>

</form>
