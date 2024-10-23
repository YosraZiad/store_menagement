<form action="{{ route('assign.role.to.admin') }}" method="post">

    @csrf
    <input type="hidden" name="id" value="{{ $role->id }}">


    @foreach ($permissions as $permission)
        <div class="row mx-3 mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="permissions[]" role="switch"
                    id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                    {{ $role->hasPermission($permission) ? 'checked' : '' }}>
                <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
            </div>
        </div>
    @endforeach



    <div class="d-flex gap-1 justify-content-end mb-3">

        <button type="reset" class="btn btn-sm btn-secondary">
            {{ __('Reset Form') }}
        </button>
        <button type="button" class="btn btn-sm btn-success" data-bs-dismiss="modal" aria-label="Close">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
            {{ __('Assign Role') }}
        </button>

    </div>

</form>
