@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a>Users</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>All Users
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i> Add New User
            </button>
        </h3>

        <hr>


        <div class="bulk border-bottom border-dark w-100" style="">
            @if (count($users) > 0)
                <div class="m-0 row border-top border-bottom border-dark">
                    <div class="col col-1">#</div>
                    <div class="col col-3 border-start">Name</div>
                    <div class="col col-3 border-start">Email</div>
                    <div class="col col-2 border-start">Member Since</div>
                    <div class="col col-3 border-start">Controls</div>
                </div>
                @php $c=0 @endphp
                @foreach ($users as $user)
                    <div class="row m-0">
                        <div class="col col-1">{{ ++$c }}</div>
                        <div class="col col-3 border-start">
                            {{ @$user->profile->first_name ? $user->profile->first_name . ' ' . $user->profile->last_name : 'Not Assigned' }}
                        </div>
                        <div class="col col-3 border-start">{{ $user->email }}</div>
                        <div class="col col-2 border-start">{{ $user->created_at }}</div>
                        <div class="col col-3 border-start">
                            <button class="btn btn-sm">
                                <a href="{{ route('view.user.info', [$user->id]) }}"><i class="fa fa-eye"></i></a>
                            </button>
                            <button class="btn btn-sm">
                                <a href="{{ route('edit.user.info') }}"><i class="fa fa-edit"></i></a>
                            </button>
                            @if ($user->id != auth()->user()->id)
                                <button class="btn btn-sm">
                                    <a href="{{ route('destroy.user', [$user->id]) }}"><i class="fa fa-trash"></i></a>
                                </button>
                            @endif
                            <button class="btn btn-sm">
                                <a href="{{ route('change.user.status', [$user->id]) }}"><i
                                        class="fa fa-{{ $user->status ? 'ban' : 'check' }}"></i></a>
                            </button>
                            <button class="btn btn-sm">
                                <a href="{{ route('change.user.status', [$user->id]) }}"><i
                                        class="fa-solid fa-plug-circle-xmark"></i></a>
                            </button>
                        </div>

                    </div>
                @endforeach
            @else
                No Users has been Added Yet
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.user.info') }}" method="POST">

                        @csrf

                        <div class="row mb-3">
                            <label for="first_name"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" required autocomplete="first_name"
                                        placeholder="First Name" autofocus>
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="last_name"
                                        placeholder="Last Name">
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
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('User Name') }}</label>

                            <div class="col col-10">
                                <input id="name" type="name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Email Address') }}</label>

                            <div class="col col-10">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Password') }}</label>

                            <div class="col col-10">
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="Type a strong password" required autocomplete="new-password">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirm password" required
                                        autocomplete="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address"
                                class="col col-2 col-form-label fw-bold text-md-end">{{ __('Address') }}</label>

                            <div class="col col-10">
                                <div class="input-group mb-3">
                                    <input id="address" type="text" class="form-control"
                                        value="{{ old('address[street]') }}" name="address[street]" placeholder="Street"
                                        required autocomplete="address[street]">
                                </div>
                                <div class="input-group mb-3">
                                    <input id="city" type="text" class="form-control"
                                        value="{{ old('address[city]') }}" name="address[city]" placeholder="City"
                                        required autocomplete="address[city]">
                                    <input id="state" type="text" class="form-control"
                                        value="{{ old('address[state]') }}" name="address[state]" placeholder="State"
                                        required autocomplete="address[state]">
                                </div>
                                <div class="input-group mb-3">
                                    <input id="postal_code" type="text" class="form-control"
                                        name="address[postal_code]" placeholder="Postal Code" required
                                        autocomplete="postal_code">
                                    <select id="country" class="form-control" value="{{ old('address[country]') }}"
                                        name="address[country]">
                                        @if (!empty($countries))
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-1 justify-content-end mb-3">

                            <button type="reset" class="btn btn-secondary">
                                {{ __('Reset Form') }}
                            </button>
                            <button type="button" class="btn btn-success"
                                onclick="window.location.href='{{ route('show.all.users') }}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New User') }}
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
