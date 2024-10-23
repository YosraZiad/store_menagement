<form action="{{ route('update.permission.info') }}" method="POST">

    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

        <div class="col col-10">
            <div class="input-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" required value="{{ old('name', $item->name) }}" autofocus>

            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="display_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Short Name') }}</label>

        <div class="col col-10">
            <input id="display_name" type="text" class="form-control @error('display_name') is-invalid @enderror"
                name="display_name" value="{{ old('display_name', $item->display_name) }}" required>

            @error('display_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="brief" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Description') }}</label>

        <div class="col col-10">
            <input id="brief" type="text" class="form-control @error('name') is-invalid @enderror" name="brief"
                value="{{ old('brief', $item->brief) }}" required>

            @error('brief')
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
        <button type="button" class="btn btn-sm btn-success" data-bs-dismiss="modal" aria-label="Close">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
            {{ __('Update Permission') }}
        </button>
    </div>

</form>
