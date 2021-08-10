@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>{{__('Login')}}</h1>
            <p class="text-muted">{{__('Sign In to your account')}}</p>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{asset('icons/sprites/free.svg#cil-user')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
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
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember" {{(old('remember'))?'checked=""':''}}>
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
              </div>

              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                </div>
                @if (Route::has('password.request'))
                <div class="col-6 text-right">
                    <a href="{{ route('password.request') }}" class="btn btn-link px-0" type="button">{{ __('Forgot Your Password?') }}</a>
                </div>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
