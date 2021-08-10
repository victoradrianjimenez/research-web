@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>{{__('Confirm Password')}}</h1>
            <p class="text-muted">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
            <form method="POST" action="{{ route('password.confirm') }}">
              @csrf
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
              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Confirm') }}</button>
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