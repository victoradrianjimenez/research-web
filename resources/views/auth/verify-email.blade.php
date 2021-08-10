@extends('admin.authBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>{{__('Confirm Password')}}</h1>
            <p class="text-muted">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>

            @if (session('status') == 'verification-link-sent')
                <p>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Resend Verification Email') }}</button>
                </div>
              </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">{{ __('Log Out') }}</button>
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
