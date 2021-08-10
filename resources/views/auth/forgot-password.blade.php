@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <p class="text-muted">{{__('Forgot Your Password?')}}<br>{{__('No problem. Just let us know your email address and we will email you a password reset link.')}}</p>
            <form method="POST" action="{{ route('password.email') }}">
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
              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{__('Send Reset Link')}}</button>
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
