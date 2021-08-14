@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="member-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>User information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="full">Name <span class="required">*</span></label>
            <div class="col-md-9">
              <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" title="Enter the user name" value="{{old('name', $user->name)}}" required=""><span class="help-block"></span>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="email">Email <span class="required">*</span></label>
            <div class="col-md-9">
              <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" title="Email address" value="{{old('email', $user->email)}}" required=""><span class="help-block"></span>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="password">Password</label>
            <div class="col-md-9">
              <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" title="Password" placeholder="*****" value="">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              
              <span class="help-block">Password confirmation:</span>
              <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" title="Enter the same password" placeholder="*****" value=""><span class="help-block">Leave empty to keep previous password.</span>
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
          <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection