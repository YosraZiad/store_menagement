<form action="{{ route('update.category.info') }}" method="POST">

    @csrf
    <input type="hidden" name="id" value="{{ $category->id }}">

    <div class="row mb-3">
        <label for="name" class="col col-2 col-form-label fw-bold text-md-end">{{ __(' Name:') }}</label>

        <div class="col col-10">
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') ? old('name') : $category->name }}" required autocomplete="name">

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
                class="form-control @error('brief') is-invalid @enderror" name="brief"
                value="{{ old('brief') ? old('brief') : $category->brief }}" required
                autocomplete="brief">

            @error('description')
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
                                    @foreach($roots as $root )
                                    <option {{$root->id == $root->parent ? 'selected' :''}} value="{{$root->id}}">{{$root->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
    

    <div class="d-flex gap-1 justify-content-end mb-3">

        <button type="reset" class="btn btn-secondary">
            {{ __('Reset Form') }}
        </button>
        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('show.all.categories') }}'">
            {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('Update Category') }}
        </button>

    </div>

</form>
