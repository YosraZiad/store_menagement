@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Categories</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Categories
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add category New" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>Add New category
            </button>
        </h3>
        <hr>
        <div class="bulk border-bottom border-dark w-100" style="">
            @if (count($categories) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1 py-1">#</div>
                    <div class="col col-2 py-1 border-start fw-bold">Name</div>
                    <div class="col col-2 py-1 border-start fw-bold"> Parent</div>
                    <div class="col col-2 py-1 border-start fw-bold"> Created at</div>
                    <div class="col col-3 py-1 border-start fw-bold">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($categories as $category)
                    <div class="row m-0">
                        <div class="col col-1 py-1">{{ ++$c }}</div>
                        <div class="col col-2 py-1 border-start">{{ $category->name }}</div>
                        <div class="col col-2 py-1 border-start">{{ $category->parent }}</div>
                        <div class="col col-2 py-1 border-start">{{ $category->created_at }}</div>
                        <div class="col col-3 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show category Information"
                                class="controls-btn btn">
                                <a data-bs-toggle="modal" data-bs-target="#displayCategory"
                                    data-url="{{ route('view.category.info', ['id' => $category->id]) }}"
                                    class="displayCategoryTrigger primary fa fa-eye"></a>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="edit category " class="controls-btn btn">
                                <a data-bs-toggle="modal" data-bs-target="#editcategory"
                                    data-url="{{ route('edit.category.info', ['id' => $category->id]) }}"
                                    class="editcategoryTrigger success fa fa-edit"></a>
                            </button>

                            <button class="controls-btn btn"
                            onclick="if(!confirm('You are about to delete a category, are you sure!?.')){return false}"
                            title="Delete category and related Information">
                                <a href="{{ route('destroy.category', [$category->id]) }}" class="danger fa fa-trash"></a>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                No category has been Added Yet
            @endif
        </div>
    </div>

    <!-- create  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.category.info') }}" method="POST">

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
                            <label for="parent"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Parent') }}</label>

                            <div class="col col-10">
                                <select class="form-control" name="parent" id="name">
                                    <option value="0">Root</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $category->parent ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="d-flex gap-1 justify-content-end mb-3">

                            <button type="reset" class="btn btn-secondary">
                                {{ __('Reset Form') }}
                            </button>
                            <button type="button" class="btn btn-success"
                                onclick="window.location.href='{{ route('show.all.categories') }}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New Category') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Display Category Info Modal -->
    <div class="modal fade" id="displayCategory" tabindex="-1" aria-labelledby="displayCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayCategoryLabel">Show Category Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="category_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Role Info Modal -->
    <div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="editcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategoryLabel">Edit Category Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_category_form_contents"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.displayCategoryTrigger').click((e) => {
            const url = e.target.getAttribute('data-url');
            console.log('Fetching data from:', url);

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById('category_info_contents').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching category info:', error);
                    const errorMessage = error.message ||
                        'An error occurred while loading category information. Please try again later.';
                    $('#category_info_contents').html('<p class="error-message">' + errorMessage + '</p>');
                });
        });

        $('.editcategoryTrigger').click((e) => {
            const url = e.target.getAttribute('data-url');
            console.log('Fetching data from:', url);

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById('edit_category_form_contents').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching category editing:', error);
                    const errorMessage = error.message ||
                        'An error occurred while loading category editing. Please try again later.';
                    $('#edit_category_form_contents').html('<p class="error-message">' + errorMessage + '</p>');
                });
        });
    </script>
@endsection
