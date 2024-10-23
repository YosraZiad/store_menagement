@extends('layouts.app')
@section('crumbs')
<li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
<li class="breadcrumb-item"><a>products</a></li>
{{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
<div class="container">
  <h3>All products
  <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-toggle="tooltip" title="Add Unit New" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>Add New Product
            </button>
  </h3>

  <hr>


  <div class="bulk border-bottom border-dark w-100">
    @if (count($products) > 0)
    <div class="m-0 row border-top border-bottom border-dark">
      <div class="col col-1">#</div>
      <div class="col col-2 border-start fw-bold">Name</div>
      <div class="col col-2 border-start fw-bold">barcode</div>
      <div class="col col-2 border-start fw-bold"> price</div>
      <div class="col col-1 border-start fw-bold"> unit</div>
      <div class="col col-2 border-start fw-bold">created_at</div>
      <div class="col col-2 border-start fw-bold">Controls</div>
    </div>
    @php $c=0 @endphp
    @foreach ($products as $product)
    <div class="row m-0">
      <div class="col col-1">{{ ++$c }}</div>

      <div class="col col-2 border-start">{{ $product->name }}</div>
      <div class="col col-2 border-start">{{ $product->barcode }}</div>
      <div class="col col-2 border-start">{{ $product->price }}</div>
      <div class="col col-1 border-start">{{@$product->unit->name }}</div>
      <div class="col col-2 border-start">{{ $product->created_at }}</div>
      <div class="col col-2 border-start">
        <button type="button" data-bs-toggle="tooltip" title="Show product Information"
          class="btn controls-btn" >
          <a data-bs-toggle="modal" data-bs-target="#displayProduct"
            data-url="{{ route('view.product.info', ['id' => $product->id]) }}"
            class="displayProductTrigger primary fa fa-eye"></a>
        </button>
        <button type="button" data-bs-toggle="tooltip" title="edit Product " class="btn controls-btn" >
          <a data-bs-toggle="modal"
            data-bs-target="#editProduct"
            data-url="{{ route('edit.product.info', ['id' => $product->id]) }}"
            class="editProductTrigger success fa fa-edit"></a>
        </button>

        <button class="btn controls-btn" 
          onclick="if(!confirm('You are about to delete a product, are you sure!?.')){return false}"
          title="Delete product and related Information">
          <a href="{{ route('destroy.product', [$product->id]) }}" class="danger fa fa-trash"></a>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('store.product.info') }}" method="POST">

          @csrf
          <div class="row mb-3">
            <label for="unit"
              class="col col-2 col-form-label fw-bold text-md-end">{{ __('Product Category') }}</label>

            <div class="col col-10">
              <select class="form-control" name="category" id="category">

                @foreach($productCategory as $item )
                <option {{ $item->id == $item->unit ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="name"
              class="col col-2 col-form-label fw-bold text-md-end">{{ __('Product Name') }}</label>

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
            <label for="description"
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
            <label for="barcode"
              class="col col-2 col-form-label fw-bold text-md-end">{{ __('Barcode') }}</label>

            <div class="col col-10">
              <div class="input-group">
                <input id="barcode" type="text"
                  class="form-control @error('barcode') is-invalid @enderror" name="barcode"
                  value="{{ old('barcode') }}" required autocomplete="barcode"
                  placeholder=" Barcode" autofocus>

              </div>
              @error('Barcode')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label for="price"
              class="col col-2 col-form-label fw-bold text-md-end">{{ __('price') }}</label>

            <div class="col col-10">
              <div class="input-group">
                <input id="price" type="text"
                  class="form-control @error('price') is-invalid @enderror" name="price"
                  value="{{ old('price') }}" required autocomplete="price"
                  placeholder=" price" autofocus>

              </div>
              @error('price')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label for="unit"
              class="col col-2 col-form-label fw-bold text-md-end">{{ __(' unit') }}</label>

            <div class="col col-10">
              <select class="form-control" name="unit" id="name">

                @foreach($units as $item )
                <option {{ $item->id == $item->unit ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>
          </div>





          <div class="d-flex gap-1 justify-content-end mb-3">

            <button type="reset" class="btn btn-secondary">
              {{ __('Reset Form') }}
            </button>
            <button type="button" class="btn btn-success"
              onclick="window.location.href=" {{ route('show.all.products')}}">
              {{ __('Cancel') }}
            </button>
            <button type="submit" class="btn btn-primary">
              {{ __('Add New Product') }}
            </button>

          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<!-- Display Category Info Modal -->
<div class="modal fade" id="displayProduct" tabindex="-1" aria-labelledby="displayProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="displayProductLabel">Show Product Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="Product_info_contents"></div>
      </div>

    </div>
  </div>
</div>

<!-- Edit Role Info Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editProductLabel">Edit Product Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="edit_product_form_contents"></div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
  $('.displayProductTrigger').click((e) => {
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
        document.getElementById('Product_info_contents').innerHTML = data;
      })
      .catch(error => {
        console.error('Error fetching Brand info:', error);
        const errorMessage = error.message || 'An error occurred while loading Product information. Please try again later.';
        $('#Product_info_contents').html('<p class="error-message">' + errorMessage + '</p>');
      });
  });

  $('.editProductTrigger').click((e) => {
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
        document.getElementById('edit_product_form_contents').innerHTML = data;
      })
      .catch(error => {
        console.error('Error fetching product editing:', error);
        const errorMessage = error.message || 'An error occurred while loading product editing. Please try again later.';
        $('#edit_product_form_contents').html('<p class="error-message">' + errorMessage + '</p>');
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