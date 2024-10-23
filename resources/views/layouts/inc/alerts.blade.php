@if (Session::has('error'))
    <div class="alert alert-sm py-1 my-2 mx-3 alert-success" style="position: relative; width: 500px;">
        {!! Session::get('error') !!}
        <button type="button" class="position-absolute top-0 end-0 btn-close p-2" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-sm py-1 my-2 mx-3 alert-success" style="position: relative; width: 500px;">
        {!! Session::get('success') !!}
        <button type="button" class="position-absolute top-0 end-0 btn-close p-2" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
@endif
