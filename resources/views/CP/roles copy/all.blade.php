@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Users</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')

    <h3>All Roles
        <button type="button" data-bs-toggle="tooltip" title="Add New Role" class="btn btn-sm btn-outline-primary"><i
                data-bs-toggle="modal" data-bs-target="#addNewRole" class="fa fa-plus"></i> Add New Role
        </button>
    </h3>
    <hr>
    <div class="bulk border-bottom border-dark w-100" style="">
        @if (count($roles) > 0)
            <div class="m-0 row border-top border-bottom border-dark">
                <div class="col col-1 text-center fw-bold">#</div>
                <div class="col col-3 text-center border-start fw-bold">Display Name</div>
                <div class="col col-3 text-center border-start fw-bold">Name</div>
                <div class="col col-2 text-center border-start fw-bold">Guard</div>
                <div class="col col-3 text-center border-start fw-bold">Controls</div>
            </div>
            @php $c=0 @endphp
            @foreach ($roles as $role)
                <div class="row m-0">
                    <div class="col col-1">{{ ++$c }}</div>
                    <div class="col col-3 border-start">{{ $role->display_name }}</div>
                    <div class="col col-3 border-start">{{ $role->name }}</div>
                    <div class="col col-2 border-start">{{ $role->guard_name }}</div>
                    <div class="col col-3 border-start">
                        <button type="button" data-bs-toggle="tooltip" title="Show Role Information"
                            class="controls-btn btn">
                            <a data-bs-toggle="modal" data-bs-target="#displayRole"
                                data-url="{{ route('view.role.info', [$role->id]) }}"
                                class="displayRoleTrigger primary fa fa-eye"></a>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Edit Role Information"
                            class="btn controls-btn">
                            <a data-bs-toggle="modal" data-bs-target="#editRole"
                                data-url="{{ route('edit.role.info', [$role->id]) }}"
                                class="editRoleTrigger success fa fa-edit"></a>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Assign Role to admin"
                            class="btn controls-btn">
                            <a data-bs-toggle="modal" data-bs-target="#assignToAdmin"
                                data-url="{{ route('get.admins.to.assign.role', [$role->id]) }}"
                                class="assignToAdminTrigger success fa fa-user-tag"></a>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Assign permission/s to Role"
                            class="btn controls-btn">
                            <a href="{{ route('destroy.role', [$role->id]) }}"
                                class="displayRoleTrigger fa fa-passport warning"></a>
                        </button>
                        <button type="button" data-bs-toggle="tooltip" title="Delete Role" class="btn controls-btn">
                            <a href="{{ route('destroy.role', [$role->id]) }}"
                                class="displayRoleTrigger danger fa fa-trash"></a>
                        </button>



                    </div>

                </div>
            @endforeach
        @else
            No Roles has been Added Yet
        @endif
    </div>




    <!-- Add New Role Modal -->
    <div class="modal fade" id="addNewRole" tabindex="-1" aria-labelledby="addNewRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNewRoleLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.role.info') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Role Name:') }}</label>

                            <div class="col col-10">
                                <input id="name" type="name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="display_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Displayed As:') }}</label>

                            <div class="col col-10">
                                <input id="display_name" type="display_name"
                                    class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                                    value="{{ old('display_name') }}" required autocomplete="display_name">

                                @error('display_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="brief"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Brief:') }}</label>

                            <div class="col col-10">
                                <input id="brief" type="brief"
                                    class="form-control @error('brief') is-invalid @enderror" name="brief"
                                    value="{{ old('brief') }}" required autocomplete="brief">

                                @error('brief')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="guard_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Guard:') }}</label>

                            <div class="col col-10">

                                <div class="input-group mb-3">

                                    <select id="guard_name" class="form-control" value="{{ old('guard_name') }}"
                                        name="guard_name">
                                        <option {{ old('guard_name') == 'web' ? 'selected' : '' }} value="admin">admins
                                        </option>
                                        <option {{ old('guard_name') == 'users' ? 'selected' : '' }} value="web">Users
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-1 justify-content-end mb-3">

                            <button type="reset" class="btn btn-secondary">
                                {{ __('Reset Form') }}
                            </button>
                            <button type="button" class="btn btn-success"
                                onclick="window.location.href='{{ route('show.all.users') }}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New Role') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Display Role Info Modal -->
    <div class="modal fade" id="displayRole" tabindex="-1" aria-labelledby="displayRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayRoleLabel">Show Role Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="role_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Role Info Modal -->
    <div class="modal fade" id="editRole" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRoleLabel">Edit Role Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_role_form_contents"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Role To Admin Modal -->
    <div class="modal fade" id="assignToAdmin" tabindex="-1" aria-labelledby="assignToAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignToAdminLabel">Edit Role Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="assign_role_to_admins_form">
                        {{-- href="{{ route('assign.role.to.admin', [$role->id]) }}" --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {

        })

        $('.displayRoleTrigger').click((e) => {

            const __url = e.target.getAttribute('data-url')
            console.log(e.target)

            jQuery.ajax({
                url: __url,
                dataType: 'html',
                type: 'GET',
                cache: false,
                success: (data) => {

                    $('#role_info_contents').html(data)
                },
                error: (err) => {
                    console.log(err)
                }
            })
        })
        $('.editRoleTrigger').click((e) => {
            const __url = e.target.getAttribute('data-url')
            console.log(__url)
            jQuery.ajax({
                url: __url,
                dataType: 'html',
                type: 'GET',
                cache: false,
                success: (data) => {

                    $('#edit_role_form_contents').html(data)
                },
                error: (err) => {
                    console.log(err)
                }
            })
        })

        $('.assignToAdminTrigger').click((e) => {
            const __url = e.target.getAttribute('data-url')
            console.log(__url)
            jQuery.ajax({
                url: __url,
                dataType: 'html',
                type: 'GET',
                cache: false,
                success: (data) => {

                    $('#assign_role_to_admins_form').html(data)
                },
                error: (err) => {
                    console.log(err)
                }
            })
        })
    </script>
@endsection
