@extends('admin.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>New publication</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="bibtex">Bibtex <span class="required">*</span></label>
            <div class="col-md-9">
              <textarea class="form-control @error('bibtex') is-invalid @enderror" name="bibtex" id="bibtex" rows="9" title="Content.." required="">{{old('bibtex',$publication->bibtex)}}</textarea>
              @error('bibtex')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('citation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="members[]">Members</label>
            <div class="col-md-9">
              @php $ids = []; foreach($publication->members as $m) array_push($ids, $m->id); @endphp
              <label class="col-form-label">Available</label>
              <select class="form-control" id="select-member">
                <option value=""></option>
                @foreach($all as $a)
                @if (!in_array($a->id, old("members", $ids)))
                <option value="{{$a->id}}"}}>{{$a->fullname}} ({{$a->id}})</option>
                @endif
                @endforeach
              </select>
              <label class="col-form-label">Selected</label>
              <select class="form-control @error('members') is-invalid @enderror" id="select-items" name="members[]" size="5" multiple="" style="margin-bottom: 10px;">
                @foreach($all as $a)
                @if (in_array($a->id, old("members",$ids)))
                <option value="{{$a->id}}"}}>{{$a->fullname}} ({{$a->id}})</option>
                @endif
                @endforeach
              </select>
              @error('members')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="form-control btn btn-outline-dark" id="btn-remove" onclick="remove_item()"><i class="cil-minus"></i> Remove</button>
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
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $('#main-form').submit(function(){
    $('#select-items option').attr("selected", "");
    return true;
  });
  $('#select-member').change(function(){
    $('#select-items').append($('#select-member option:selected'));
    return true;
  });
  function remove_item(){
    $('#select-member').append($('#select-items option:selected'));
    $('#select-member [value=""]').attr('selected','selected');
    return false;
  };
</script>
@endpush