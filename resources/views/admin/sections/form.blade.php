@extends('admin.base')

@push('styles')
<link rel="stylesheet" href="{{asset('css/jquery.cleditor.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>Section data</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="url">URL Name</label>
            <div class="col-md-9">
              <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" title="Enter the full name" value="{{old('url', $section->url)}}" required=""><span class="help-block"></span>
              @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="descriptions">Descriptions</label>
            <div class="col-md-9">
              <div id="descriptions-wrapper" >
                @if (old("descriptions"))
                @foreach(old("descriptions") as $i => $d)
                  @include('admin.sections.description', [
                    'id' => $d['id'],
                    'lang' => $d['lang'],
                    'type' => $d['type'],
                    'title' => $d['title'],
                    'text' => $d['text'],
                    'logo' => $d['logo'],
                    'link' => $d['link'],
                    'i' => $i])
                @endforeach
                @else
                @foreach($section->descriptions as $i => $d)
                  @include('admin.sections.description', [
                    'id' => $d->id,
                    'lang' => $d->lang,
                    'type' => $d->type,
                    'title' => $d->title,
                    'text' => $d->text,
                    'logo' => $d->logo,
                    'link' => $d->link,
                    'i' => $i])
                @endforeach
                @endif
              </div>
              @error('descriptions')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="btn btn-outline-dark" onclick="add_description(this)">Add description</button>
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
    <div id="description_template" style="display:none;">
      @include('admin.sections.description', [
        'id' => '',
        'lang' => '',
        'type' => '',
        'title' => '',
        'text' => '',
        'logo' => '',
        'link' => '',
        'i' => ''])
    </div>
  </div>
</div>
<script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
<script type="text/javascript">
  function add_description(){
    var obj = $($('#description_template').html());
    $('#descriptions-wrapper').append(obj);
    obj.find('[name$="[text]"]').cleditor();
  };
  function remove_description(elem){
    $(elem).parentsUntil('#descriptions-wrapper').remove();
  };
  function up_description(elem){
    var obj = $(elem).parentsUntil('#descriptions-wrapper').last();
    var prev = obj.prev();
    prev.insertAfter(obj);
    prev.find('[name$="[text]"]').cleditor()[0].refresh();
  }
  function down_description(elem){
    var obj = $(elem).parentsUntil('#descriptions-wrapper').last();
    var next = obj.next();
    next.insertBefore(obj);
    next.find('[name$="[text]"]').cleditor()[0].refresh();
  }
  function remove_logo(elem){
    var obj = $(elem).parentsUntil('.logo_input_wrapper');
    obj.find('img').remove();
    obj.find('[type="file"]').val('');
    obj.find('[type="hidden"]').val('');
  }
  $(document).ready(function () { 
    $('#descriptions-wrapper [name$="[text]"]').cleditor();
    $('#main-form').submit(function(){
      var descriptions = $('#descriptions-wrapper').children().each(function(i, v){
        var element = $(v);
        element.find('[name$="[id]"]').attr('name','descriptions['+i+'][id]');
        element.find('[name$="[text]"]').attr('name','descriptions['+i+'][text]');
        element.find('[name$="[lang]"]').attr('name','descriptions['+i+'][lang]');
        element.find('[name$="[link]"]').attr('name','descriptions['+i+'][link]');
        element.find('[name$="[type]"]').attr('name','descriptions['+i+'][type]');
        element.find('[name$="[logo]"]').attr('name','descriptions['+i+'][logo]');
        element.find('[name$="[title]"]').attr('name','descriptions['+i+'][title]');
        element.find('[name$="[file_logo]"]').attr('name','descriptions['+i+'][file_logo]');
      });
      return true;
    });
  });  
</script>
@endsection