@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Companies</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Companies
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add Unit New" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>Add New Company
            </button>
        </h3>

        <hr>


        <div class="bulk border-bottom border-dark w-100" style="">
            @if (count($companies) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1">#</div>
                    <div class="col col-2 border-start fw-bold">Name</div>
                    <div class="col col-2 border-start fw-bold">Address</div>
                    <div class="col col-2 border-start fw-bold">Phone Number</div>
                    <div class="col col-1 border-start fw-bold"> Industry</div>
                    <div class="col col-2 border-start fw-bold">Member Since</div>
                    <div class="col col-2 border-start fw-bold">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($companies as $company)
                    <div class="row m-0">
                        <div class="col col-1">{{ ++$c }}</div>
                        
                        <div class="col col-2 border-start">{{ $company->name }}</div>
                        <div class="col col-2 border-start">{{ $company->address }}</div>
                        <div class="col col-2 border-start">{{ $company->phone_number }}</div>
                        <div class="col col-1 border-start">{{ $company->industry }}</div>
                        <div class="col col-2 border-start">{{ $company->created_at }}</div>
                        <div class="col col-2 border-start">
                            <button type="button" data-bs-toggle="tooltip" title="Show company Information"
                            class="btn controls-btn">
                              <a data-bs-toggle="modal" data-bs-target="#displayCompany"
                                 data-url="{{ route('view.company.info', ['id' => $company->id]) }}" 
                                 class="displayCompanyTrigger primary fa fa-eye"></a>
                            </button>
                            <button type="button" data-bs-toggle="tooltip" title="edit company " class="btn controls-btn">
                              <a data-bs-toggle="modal"
                               data-bs-target="#editCompany"
                               data-url="{{ route('edit.company.info', ['id' => $company->id]) }}" 
                               class="editCompanyTrigger success fa fa-edit"></a>
                            </button>
                          
                                <button class="btn controls-btn"
                                onclick="if(!confirm('You are about to delete a unit, are you sure!?.')){return false}"
                                title="Delete unit and related Information">
                                    <a href="{{ route('destroy.company', [$company->id]) }}"class="danger fa fa-trash"></a>
                                </button>
                      
                          
                        </div>

                    </div>
                @endforeach
            @else
                No Company has been Added Yet
            @endif
        </div>
    </div>

    <!-- create  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.company.info') }}" method="POST">

                        @csrf
                        <div class="row mb-3">
                            <label for="first_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="first_name" type="text"
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
                            <label for="name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Address') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address"
                                        placeholder=" Address" autofocus>
                                    
                                </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_size"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Company Size') }}</label>

                            <div class="col col-10">
                                <input id="company_size" type="text"
                                    class="form-control @error('company_size') is-invalid @enderror" name="company_size"
                                    value="{{ old('company_size') }}" required autocomplete="company_size"   placeholder="Company Size" autofocus>

                                @error('company_size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone_number"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col col-10">
                                <input id="phone_number" type="number"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="phone_number"   placeholder="Phone Number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="incorporation_date"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Incorporation Date') }}</label>

                            <div class="col col-10">
                                <input id="incorporation_date" type="date"
                                    class="form-control @error('incorporation_date') is-invalid @enderror" name="incorporation_date"
                                    value="{{ old('incorporation_date') }}" required autocomplete="incorporation_date"   placeholder="Incorporation Date" autofocus>

                                @error('incorporation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="industry"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Industry') }}</label>

                            <div class="col col-10">
                                <input id="industry" type="text"
                                    class="form-control @error('industry') is-invalid @enderror" name="industry"
                                    value="{{ old('industry') }}" required autocomplete="industry"   placeholder="Industry" autofocus>

                                @error('industry')
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
                                    value="{{ old('website') }}" required autocomplete="website"   placeholder="Website" autofocus>

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
                                onclick="window.location.href='{{ route('show.all.companies')}}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New Company') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

      <!-- Display Category Info Modal -->
      <div class="modal fade" id="displayCompany" tabindex="-1" aria-labelledby="displayCompanyLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="displayCompanyLabel">Show Company Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="Company_info_contents"></div>
                </div>

            </div>
        </div>
    </div>

      <!-- Edit Role Info Modal -->
      <div class="modal fade" id="editCompany" tabindex="-1" aria-labelledby="editCompanyLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CompanyLabel">Edit Company Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_Company_form_contents"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
  $('.displayCompanyTrigger').click((e) => {
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
            document.getElementById('Company_info_contents').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching Company info:', error);
            const errorMessage = error.message || 'An error occurred while loading Company information. Please try again later.';
            $('#Company_info_contents').html('<p class="error-message">' + errorMessage + '</p>');
        });
});

$('.editCompanyTrigger').click((e) => {
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
            document.getElementById('edit_Company_form_contents').innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching Company editing:', error);
            const errorMessage = error.message || 'An error occurred while loading Company editing. Please try again later.';
            $('#edit_Company_form_contents').html('<p class="error-message">' + errorMessage + '</p>');
        });
});





    </script>
@endsection
