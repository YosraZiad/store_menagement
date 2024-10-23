<form action="{{ route('update.brand.info') }}" method="POST">

  @csrf
  <input type="hidden" name="id" value="{{ $brand->id }}">

  <div class="row mb-3">
    <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Name:') }}</label>

    <div class="col col-10">
      <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') ? old('name') : $brand->name }}" required autocomplete="name">

      @error('name')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="description" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Description:') }}</label>

    <div class="col col-10">
      <input id="description" type="text"
        class="form-control @error('description') is-invalid @enderror" name="description"
        value="{{ old('description') ? old('description') : $brand->description }}" required
        autocomplete="description">

      @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label for="company_id"
      class="col col-2 col-form-label fw-bold text-md-end">{{ __('Company Name') }}</label>

    <div class="col col-10">
      <select class="form-control" name="company_id" id="company_id">

        @foreach($companies as $company )
        <option {{$company->id == $company->company_id ? 'selected' :''}} value="{{$company->id}}">{{$company->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="website" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Website:') }}</label>

    <div class="col col-10">
      <input id="website" type="text"
        class="form-control @error('website') is-invalid @enderror" name="website"
        value="{{ old('website') ? old('website') : $brand->website }}" required
        autocomplete="website">

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
    <button type="button" class="btn btn-success" onclick="window.location.href="{{ route('show.all.brands') }}">
      {{ __('Cancel') }}
    </button>
    <button type="submit" class="btn btn-primary">
      {{ __('Update Brand') }}
    </button>

  </div>

</form>