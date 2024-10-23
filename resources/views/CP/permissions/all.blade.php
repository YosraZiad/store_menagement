@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Permissions</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Permissions
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewItem">
                <i class="fa fa-plus"></i> New Permissions
            </button>
        </h3>

        <hr>
        <div class="bulk border-bottom border-dark w-100" style="">
            @if (!empty($items))
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1 my-1">#</div>
                    <div class="col col-3 my-1 border-start">Permission</div>
                    <div class="col col-3 my-1 border-start">display Name</div>
                    <div class="col col-3 my-1 border-start">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($items as $item)
                    <div class="row m-0">
                        <div class="col col-1">{{ ++$c }}</div>
                        <div class="col col-3 border-start">{{ $item->name }}</div>
                        <div class="col col-3 border-start">{{ $item->display_name }}</div>
                        <div class="col col-3 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show Permission Information"
                                class="controls-btn btn">
                                <i data-bs-toggle="modal" data-bs-target="#displayItem"
                                    data-url="{{ route('view.permission.info', [$item->id]) }}"
                                    class="displayItemTrigger fa fa-eye"></i>
                            </button>

                            <button type="button" data-bs-toggle="tooltip" title="Edit Permission Information"
                                class="controls-btn btn">
                                <i data-bs-toggle="modal" data-bs-target="#editItem"
                                    data-url="{{ route('edit.permission.info', [$item->id]) }}"
                                    class="editItemTrigger fa fa-edit"></i>
                            </button>

                            <button class="btn btn-sm" data-bs-toggle="tooltip"
                                title="Delete Permission and related Information">
                                <a href="{{ route('destroy.permission', [$item->id]) }}"><i class="fa fa-trash"></i></a>
                            </button>
                        </div>

                    </div>
                @endforeach
            @else
                No Permissions has been Added Yet.
            @endif
        </div>
    </div>


    <!-- create  Modal -->
    <div class="modal fade" id="addNewItem" tabindex="-1" aria-labelledby="addNewItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h1 class="modal-title fs-5" id="addNewItemLabel">Add New Permission</h1>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <div class="fa fa-times"></div>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.permission.info') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name"
                                        placeholder="Permission Name / Code" autofocus>

                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="display_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Short Name') }}</label>

                            <div class="col col-10">
                                <input id="display_name" type="text"
                                    class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                                    value="{{ old('display_name') }}" autocomplete="Provider Short/Brand Name"
                                    placeholder="Permission Displayed As:">

                                @error('display_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="brief"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Description') }}</label>

                            <div class="col col-10">
                                <input id="brief" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="brief"
                                    value="{{ old('name') }}" autocomplete="brief" placeholder="Permission Description">

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
                            <button type="button" class="btn btn-sm btn-success" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                {{ __('Add New Provider') }}
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Display unit Info Modal -->
    <div class="modal fade" id="displayItem" tabindex="-1" aria-labelledby="displayItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayItemLabel">Show Unit Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="unit_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Role Info Modal -->
    <div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editItemLabel">Edit Provider Basic Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_unit_form_contents"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(() => {

        })

        $('.displayItemTrigger').click((e) => {

            const __url = e.target.getAttribute('data-url')
            console.log(__url)

            jQuery.ajax({
                url: __url,
                dataType: 'html',
                type: 'GET',
                cache: false,
                success: (data) => {

                    $('#unit_info_contents').html(data)
                },
                error: (err) => {
                    console.log(err)
                }
            })
        })

        $('.editItemTrigger').click((e) => {
            const __url = e.target.getAttribute('data-url');
            console.log(__url); // Log the URL for debugging

            jQuery.ajax({
                url: __url,
                dataType: 'html',
                type: 'GET',
                cache: false,
                success: (data) => {
                    console.log(data); // Log the received data for debugging
                    document.getElementById('edit_unit_form_contents').innerHTML = data;
                },
                error: (err) => {
                    console.log(err); // Log any errors during the request
                }
            });
        });
    </script>
@endsection
