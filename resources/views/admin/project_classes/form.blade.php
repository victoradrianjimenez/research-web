@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>Project class information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="name">Name</label>
            <div class="col-md-9">
              <input class="form-control @error('name') is-invalid @enderror" id="text-input" type="text" name="name" title="Enter the class name" value="{{old('name', (isset($project_classes[0]))?$project_classes[0]->name:'')}}" required=""><span class="help-block"></span>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="text[]">Text</label>
            <div class="col-md-9">
              <div id="items-wrapper" >
                @if (old("text"))
                @for($i=0; $i < count(old("text")); $i++)
                @include('admin.project_classes.text', [
                  'l' => old('lang')[$i],
                  't' => old('text')[$i]])
                @endfor
                @else
                @foreach($project_classes as $p)
                @include('admin.project_classes.text', [
                  'l' => $p->lang,
                  't' => $p->text])
                @endforeach
                @endif
              </div>
              @error('lang')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('lang.*')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('text.*')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="btn btn-outline-dark" onclick="add_item(this)">Add Text</button>
              </div>
            </div>
          </div>
          
        </div>
        <div class="card-footer">
          <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
          <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
        </div>
      </div>
    </form>
    <div id="item_template" style="display:none;">
      @include('admin.project_classes.text', [
        'l' => '',
        't' => ''])
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  function add_item(elem){
    $('#items-wrapper').append($('#item_template').html());
  }
  function remove_item(elem){
    $(elem).parentsUntil('#items-wrapper').remove();
  }
</script>
@endpush