@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>brands</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All brands
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add brand New" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>Add New Brand
            </button>
        </h3>

        <hr>


        <div class="bulk border-bottom border-dark w-100" style="">
            @if (count($brands) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1">#</div>
                    <div class="col col-2 border-start  fw-bold ">Name</div>
                    <div class="col col-2 border-start  fw-bold">company</div>
                    <div class="col col-2 border-start  fw-bold"> website</div>
                    <div class="col col-2 border-start  fw-bold">Member Since</div>
                    <div class="col col-3 border-start  fw-bold">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($brands as $brand)
                    <div class="row m-0">
                        <div class="col col-1">{{ ++$c }}</div>
                        
                        <div class="col col-2 border-start">{{ $brand->name }}</div>
                        <div class="col col-2 border-start">{{ @$brand->company->name }}</div>
                        <div class="col col-2 border-start">{{ $brand->website }}</div>
                        <div class="col col-2 border-start">{{ $brand->created_at }}</div>
                        <div class="col col-3 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show brand Information"
                            class="btn controls-btn">
                              <a data-bs-toggle="modal" data-bs-target="#displayBrand"
                                 data-url="{{ route('view.brand.info', ['id' => $brand->id]) }}" 
                                 class="displayBrandTrigger primary fa fa-eye"></a>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="edit brand " class="btn controls-btn">
                              <a data-bs-toggle="modal"
                               data-bs-target="#editBrand"
                               data-url="{{ route('edit.brand.info', ['id' => $brand->id]) }}" 
                               class="editBrandTrigger success fa fa-edit"></a>
                            </button>
                          
                                <button type="button"  data-bs-toggle="tooltip" title="delete brand " class="btn controls-btn"
                                onclick="if(!confirm('You are about to delete a brand, are you sure!?.')){return false}"
                                title="Delete brand and related Information">
                                    <a href="{{ route('destroy.brand', [$brand->id]) }}" class="danger fa fa-trash"></a>
                                </button>
                      
                          
                        </div>

                    </div>
                @endforeach
            @else
                No brand has been Added Yet
            @endif
        </div>
    </div>

    <!-- create  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.brand.info') }}" method="POST" accept="[]" enctype="multipart/form-data">

                        @csrf
                        <div class="row mb-3">
                            <label for="first_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Brand Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name"
                                        placeholder=" Name" autofocus>
                                    
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="company"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Company Name') }}</label>

                            <div class="col col-10">
                            <select class="form-control" name="company_id" id="name">
                                    
                                    @foreach($companies as $company )
                                    <option  value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Description') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="description" type="text"
                                        class="form-control @error('description') is-invalid @enderror" name="description"
                                        value="{{ old('description') }}" required autocomplete="description"
                                        placeholder=" description" autofocus>
                                    
                                </div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_size"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('brand_logo') }}</label>

                            <div class="col col-10">
                                <input id="image"   type="file"
                                      name="brand_logo" 
                                    class="form-control @error('company_size') is-invalid @enderror"
                                    value="{{ old('image') }}" required autocomplete="image"   placeholder="image " autofocus>
                                    <figure class="imagecheck-figure">
                                  <img
                                    id="preview-image" src="" alt="Preview Image"  class="img-fluid"
                                  />
                                </figure>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="website"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Website') }}</label>

                            <div class="col col-10">
                                <input id="website" type="text"
                                    class="form-control @error('website') is-invalid @enderror" name="website"
                                    value="{{ old('website') }}" required autocomplete="website"   placeholder="website" autofocus>

                                @error('website')
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
                            onclick="window.location.href='{{ route('show.all.brands') }}';">

                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New Brand') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

      <!-- Display Category Info Modal -->
      <div class="modal fade" id="displayBrand" tabindex="-1" aria-labelledby="displayBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayBrandLabel">Show Brand Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="Brand_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

      <!-- Edit Role Info Modal -->
      <div class="modal fade" id="editBrand" tabindex="-1" aria-labelledby="editBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BrandLabel">Edit Brand Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_Brand_form_contents"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
  $('.displayBrandTrigger').click((e) => {
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
            document.getElementById('Brand_info_contents').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching Brand info:', error);
            const errorMessage = error.message || 'An error occurred while loading Brand information. Please try again later.';
            $('#Brand_info_contents').html('<p class="error-message">' + errorMessage + '</p>');
        });
});

$('.editBrandTrigger').click((e) => {
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
            document.getElementById('edit_Brand_form_contents').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching Company editing:', error);
            const errorMessage = error.message || 'An error occurred while loading Brand editing. Please try again later.';
            $('#edit_Brand_form_contents').html('<p class="error-message">' + errorMessage + '</p>');
        });
});

$(document).ready(function() {
        $('#image').change(function() {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);   

        });
    });



    </script>
@endsection
