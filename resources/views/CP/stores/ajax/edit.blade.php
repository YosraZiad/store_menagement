<form action="{{ route('update.product.info') }}" method="POST">

  @csrf
  <input type="hidden" name="id" value="{{ $product->id }}">
  <div class="row mb-3">
    <label for="category"
      class="col col-2 col-form-label fw-bold text-md-end">{{ __('product Category') }}</label>

    <div class="col col-10">
      <select class="form-control" name="category" id="category">

        @foreach($productCategory as $item )
        <option {{$item->id == $item->category ? 'selected' :''}} value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Name:') }}</label>

    <div class="col col-10">
      <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') ? old('name') : $product->name }}" required autocomplete="name">

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
        value="{{ old('description') ? old('description') : $product->description }}" required
        autocomplete="description">

      @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="price" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Price:') }}</label>

    <div class="col col-10">
      <input id="price" type="text"
        class="form-control @error('price') is-invalid @enderror" name="price"
        value="{{ old('price') ? old('price') : $product->price }}" required
        autocomplete="price">

      @error('price')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>


  <div class="row mb-3">
    <label for="unit"
      class="col col-2 col-form-label fw-bold text-md-end">{{ __('Unit') }}</label>

    <div class="col col-10">
      <select class="form-control" name="unit" id="unit">

        @foreach($units as $unit )
        <option {{$unit->id == $unit->unit ? 'selected' :''}} value="{{$unit->id}}">{{$unit->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label for="barcode" class="col col-2 col-form-label fw-bold text-md-end">{{ __('Barcode:') }}</label>

    <div class="col col-10">
      <input id="barcode" type="text"
        class="form-control @error('barcode') is-invalid @enderror" name="barcode"
        value="{{ old('barcode') ? old('barcode') : $product->barcode }}" required
        autocomplete="barcode">

      @error('barcode')
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
      {{ __('Update Product') }}
    </button>

  </div>

</form>