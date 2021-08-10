@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>Partner information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="name">Name</label>
            <div class="col-md-9">
              <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" title="Enter the short name" value="{{old('name', $partner->name)}}" required=""><span class="help-block"></span>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="fullname">Full name</label>
            <div class="col-md-9">
              <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" title="Enter the full name" value="{{old('fullname', $partner->fullname)}}" required=""><span class="help-block"></span>
              @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="link">Link</label>
            <div class="col-md-9">
              <input class="form-control @error('link') is-invalid @enderror" type="url" name="link" placeholder="http://" value="{{old('link', $partner->link)}}"><span class="help-block"></span>
              @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="file_logo">Logo</label>
            <div class="col-md-9">
              @if($partner->logo)
              <img src="{{url('storage/'.$partner->logo)}}" alt="Logo" height="60">
              <input type="hidden" name="logo" value="{{$partner->logo}}">
              @endif
              <input type="file" name="file_logo">
              @error('file_logo')
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