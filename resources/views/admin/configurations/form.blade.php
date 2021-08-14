@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>Parameter: {{$configuration->name}}</h3></div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="value">Value <span class="required">*</span></label>
            <div class="col-md-9">
              @switch($configuration->type)
              @case('html')
                <textarea class="form-control @error('value') is-invalid @enderror" rows="10" name="value" required="">{{old('value', $configuration->value)}}</textarea>
                @push('styles')
                  <link rel="stylesheet" href="{{asset('css/jquery.cleditor.css')}}" />
                @endpush
                @push('scripts')
                <script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
                <script type="text/javascript">
                  $('#main-form [name="value"]').cleditor();                  
                </script>
                @endpush
                @break
              @case('file')
                <input type="file" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old('value', $configuration->value)}}" required="">
                @break
              @case('url')
                <input type="url" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old('value', $configuration->value)}}" required="">
                @break
              @case('text')
                <textarea class="form-control @error('value') is-invalid @enderror" rows="10" name="value" required="">{{old('value', $configuration->value)}}</textarea>
              @default
                <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old('value', $configuration->value)}}" required="">
              @endswitch
              @error('value')
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
