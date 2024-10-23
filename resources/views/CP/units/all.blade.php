@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Units</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Units
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add Unit New" class="btn btn-sm btn-outline-primary">
                <i class="fa fa-plus"></i>Add New Unit
            </button>
        </h3>

        <hr>


        <div class="bulk border-bottom border-dark" >
            @if (count($units) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1">#</div>
                    <div class="col col-4 border-start fw-bold">Name</div>
                    <div class="col col-3 border-start fw-bold"> Short Name</div>
                    <div class="col col-4 border-start fw-bold">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($units as $unit)
                    <div class="row m-0">
                        <div class="col col-1">{{ ++$c }}</div>

                        <div class="col col-4 border-start">{{ $unit->name }}</div>
                        <div class="col col-3 border-start">{{ $unit->short_name }}</div>
                        <div class="col col-4 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show unit Information"
                                class="btn controls-btn">
                                <a data-bs-toggle="modal" data-bs-target="#displayUnit"
                                    data-url="{{ route('view.unit.info', [$unit->id]) }}"
                                    class="displayUnitTrigger primary fa fa-eye"></a>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="Show unit Information"
                                class="btn controls-btn">
                                <a data-bs-toggle="modal" data-bs-target="#editUnit"
                                    data-url="{{ route('edit.unit.info', ['id' => $unit->id]) }}"
                                    class="editUnitTrigger success fa fa-edit"></a>
                            </button>

                            <button class="btn controls-btn" 
                             onclick="if(!confirm('You are about to delete a unit, are you sure!?.')){return false}"
                            title="Delete unit and related Information">
                                <a href="{{ route('destroy.unit', [$unit->id]) }}" class="danger fa fa-trash"></a>
                            </button>


                        </div>

                    </div>
                @endforeach
            @else
                No Units has been Added Yet
            @endif
        </div>
    </div>

    <!-- create  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addNewUnitLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNewUnitLabel">Add New Unit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.unit.info') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <label for="first_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" placeholder=" Name"
                                        autofocus>

                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Description') }}</label>

                            <div class="col col-10">
                                <input id="description" type="description"
                                    class="form-control @error('name') is-invalid @enderror" name="description"
                                    value="{{ old('name') }}" required autocomplete="description"
                                    placeholder="description" autofocus>

                                @error('name')
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
                                    class="form-control @error('email') is-invalid @enderror" name="short_name"
                                    value="{{ old('email') }}" required autocomplete="short_name"
                                    placeholder="short_name">

                                @error('email')
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
                            <button type="button" class="btn btn-success"
                                onclick="window.location.href='{{ route('show.all.units') }}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New Unit') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Display unit Info Modal -->
    <div class="modal fade" id="displayUnit" tabindex="-1" aria-labelledby="displayUnitLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayUnitLabel">Show Unit Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="unit_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Role Info Modal -->
    <div class="modal fade" id="editUnit" tabindex="-1" aria-labelledby="editUnitLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUnitLabel">Edit Unit Information</h1>
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

        $('.displayUnitTrigger').click((e) => {

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

        $('.editUnitTrigger').click((e) => {
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
