<form action="{{ route('update.unit.info') }}" method="POST">

    @csrf
    <input type="hidden" name="id" value="{{ $unit->id }}">

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Name:') }}</label>

        <div class="col col-10">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') ? old('name') : $unit->name }}" required autocomplete="name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="description" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Description:') }}</label>

        <div class="col col-10">
            <input id="description" type="text"
                class="form-control @error('display_name') is-invalid @enderror" name="description"
                value="{{ old('description') ? old('description') : $unit->description }}" required
                autocomplete="display_name">

            @error('display_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="short_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('short_name:') }}</label>

        <div class="col col-10">
            <input id="brief" type="text" class="form-control @error('brief') is-invalid @enderror"
                name="short_name" value="{{ old('short_name') ? old('short_name') : $unit->short_name }}" required autocomplete="short_name">

            @error('brief')
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
        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('show.all.units') }}'">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('Update Unit') }}
        </button>

    </div>

</form>
