@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>{{__('Reset Password')}}</h1>
            <p class="text-muted"></p>
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <svg class="c-icon">
                      <use xlink:href="{{asset('icons/sprites/free.svg#cil-user')}}"></use>
                    </svg>
                  </span>
                </div>
                <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email', $request->email) }}" required autofocus>
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
                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{__('Password')}}" name="password" required>
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
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" placeholder="{{__('Password Confirmation')}}" name="password_confirmation" required>
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Reset Password') }}</button>
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
