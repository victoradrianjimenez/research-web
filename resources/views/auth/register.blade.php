@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>{{__('Register')}}</h1>
            <p class="text-muted">{{__('Sign up a new account')}}</p>
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{asset('icons/sprites/free.svg#cil-user')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="{{ __('User Name') }}" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{asset('icons/sprites/free.svg#cil-envelope-closed')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                        <use xlink:href="{{asset('icons/sprites/free.svg#cil-lock-locked')}}"></use>
                      </svg>
                  </span>
                </div>
                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{ __('Password') }}" name="password" required>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                        <use xlink:href="{{asset('icons/sprites/free.svg#cil-lock-locked')}}"></use>
                      </svg>
                  </span>
                </div>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="{{ __('Password Confirmation') }}" name="password_confirmation" required>
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Register') }}</button>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('login') }}" class="btn btn-link px-0" type="button">{{ __('Already registered?') }}</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection