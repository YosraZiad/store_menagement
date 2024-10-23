<form action="{{ route('update.role.info') }}" method="POST">

    @csrf
    <input type="hidden" name="id" value="{{ $role->id }}">

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Role Name:') }}</label>

        <div class="col col-10">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') ? old('name') : $role->name }}" required autocomplete="name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="display_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Displayed As:') }}</label>

        <div class="col col-10">
            <input id="display_name" type="display_name"
                class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                value="{{ old('display_name') ? old('display_name') : $role->display_name }}" required
                autocomplete="display_name">

            @error('display_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="brief" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Brief:') }}</label>

        <div class="col col-10">
            <input id="brief" type="brief" class="form-control @error('brief') is-invalid @enderror"
                name="brief" value="{{ old('brief') ? old('brief') : $role->brief }}" required autocomplete="brief">

            @error('brief')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="guard_name" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Guard:') }}</label>

        <div class="col col-10">

            <div class="input-group mb-3">

                <select id="guard_name" class="form-control" value="{{ old('guard_name') }}" name="guard_name">
                    <option {{ old('guard_name') == 'web' ? 'selected' : '' }} value="web">admins
                    </option>
                    <option {{ old('guard_name') == 'users' ? 'selected' : '' }} value="users">Users
                    </option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex gap-1 justify-content-end mb-3">

        <button type="reset" class="btn btn-secondary">
            {{ __('Reset Form') }}
        </button>
        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('show.all.roles') }}'">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('Update Role') }}
        </button>

    </div>

</form>
