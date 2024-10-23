@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Providers</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Providers
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add Unit New" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>Add New Provider
            </button>
        </h3>

        </h3>

        <hr>


        <div class="bulk border-bottom border-dark">
            @if (count($providers) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1">#</div>
                    <div class="col col-3 border-start fw-bold">Name</div>
                    <div class="col col-2 border-start fw-bold"> Short Name</div>
                    <div class="col col-3 border-start fw-bold"> Email</div>
                    <div class="col col-3 border-start fw-bold">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($providers as $provider)
                    <div class="row m-0">
                        <div class="col col-1 pt-2">{{ ++$c }}</div>
                        <div class="col col-3 pt-2 border-start">{{ $provider->full_name }}</div>
                        <div class="col col-2 pt-2 border-start">{{ $provider->short_name }}</div>
                        <div class="col col-3 pt-2 border-start">{{ $provider->profile->email }}</div>
                        <div class="col col-3 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show Provider Information"
                              class="btn controls-btn">
                                <a data-bs-toggle="modal" data-bs-target="#displayItem"
                                    data-url="{{ route('view.provider.info', [$provider->id]) }}"
                                    class="displayItemTrigger primary fa fa-eye"></a>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="Edit Provider Information"
                              class="btn controls-btn">
                                <a data-bs-toggle="modal" data-bs-target="#editItem"
                                    data-url="{{ route('edit.provider.info', ['id' => $provider->id]) }}"
                                    class="editItemTrigger success fa fa-edit"></a>
                            </button>

                            <button class="btn controls-btn" data-bs-toggle="tooltip"
                                onclick="if(!confirm('You are about to delete a provider, are you sure!?.')){return false}"
                                title="Delete Provider and related Information">
                                <a href="{{ route('destroy.provider', [$provider->id]) }}" class="danger fa fa-trash"></a>
                            </button>


                        </div>

                    </div>
                @endforeach
            @else
                No Providers has been Added Yet
            @endif
        </div>
    </div>

    <!-- create  Modal -->
    <div class="modal fade" id="addNewItem" tabindex="-1" aria-labelledby="addNewItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h1 class="modal-title fs-5" id="addNewItemLabel">Add New Provider</h1>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <div class="fa fa-times"></div>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.provider.info') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <label for="full_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="full_name" type="text"
                                        class="form-control @error('full_name') is-invalid @enderror" name="full_name"
                                        value="{{ old('full_name') }}" required autocomplete="full_name"
                                        placeholder="Provider full Name" autofocus>

                                </div>
                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="short_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Short Name') }}</label>

                            <div class="col col-10">
                                <input id="short_name" type="text"
                                    class="form-control @error('short_name') is-invalid @enderror" name="short_name"
                                    value="{{ old('short_name') }}" autocomplete="Provider Short/Brand Name"
                                    placeholder="short_name">

                                @error('short_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __(' About') }}</label>

                            <div class="col col-10">
                                <input id="brief" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="brief"
                                    value="{{ old('name') }}" autocomplete="brief" placeholder="description" autofocus>

                                @error('brief')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Field') }}</label>

                            <div class="col col-10">
                                <select id="field" class="form-control @error('name') is-invalid @enderror"
                                    name="field" value="{{ old('name') }}" autocomplete="field">
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
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Registry') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="cr_number" type="text"
                                        class="form-control @error('cr_number') is-invalid @enderror" name="cr_number"
                                        value="{{ old('cr_number') }}" autocomplete="cr_number"
                                        placeholder="Commercial Registry">
                                    <input id="vat_number" type="text"
                                        class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                                        value="{{ old('vat_number') }}" autocomplete="vat_number"
                                        placeholder="VAT Number">


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
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Contact') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autocomplete="phone" placeholder="Phone Number">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" placeholder="Email Address">


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
                    <h1 class="modal-title fs-5" id="displayItemLabel">Show Provider Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="item_info_contents"></div>
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
                    <div id="edit_item_form_contents"></div>
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

                    $('#item_info_contents').html(data)
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
                    document.getElementById('edit_item_form_contents').innerHTML = data;
                },
                error: (err) => {
                    console.log(err); // Log any errors during the request
                }
            });
        });
    </script>
@endsection

