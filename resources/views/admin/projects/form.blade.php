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
        <div class="card-header"><h3>Project information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="type">Type</label>
            <div class="col-md-9">
              <select class="form-control @error('type') is-invalid @enderror" name="type" title="Type of project" required="">
                <option value="project" {{(old('type', $project->type)=='project'?'selected="selected"':'')}}>Project</option>
                <option value="development" {{(old('type', $project->type)=='development'?'selected="selected"':'')}}>Development</option>
              </select>
              @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="title">Title</label>
            <div class="col-md-9">
              <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" title="Enter the full title" value="{{old('title', $project->title)}}" required=""><span class="help-block"></span>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="institution">Institution</label>
            <div class="col-md-9">
              <input class="form-control @error('institution') is-invalid @enderror" type="text" name="institution" title="Institution name" value="{{old('institution', $project->institution)}}"><span class="help-block"></span>
              @error('institution')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="code">Code</label>
            <div class="col-md-9">
              <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" title="Code / Grantt number" value="{{old('code', $project->code)}}"><span class="help-block"></span>
              @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="period">Period</label>
            <div class="col-md-9">
              <input class="form-control @error('period') is-invalid @enderror" type="text" name="period" placeholder="YYYY-YYYY" value="{{old('period', $project->period)}}" required=""><span class="help-block"></span>
              @error('period')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="url">URL name</label>
            <div class="col-md-9">
              <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" placeholder="" value="{{old('url', $project->url)}}" required=""><span class="help-block"></span>
              @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="link">External link</label>
            <div class="col-md-9">
              <input class="form-control @error('link') is-invalid @enderror" type="url" name="link" placeholder="http://" value="{{old('link', $project->link)}}"><span class="help-block"></span>
              @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="file_logo">Logo</label>
            <div class="col-md-9">
              <div class="logo_input_wrapper">
                <div>
                  @if($project->logo)
                    <img src="{{url('storage/'.$project->logo)}}" alt="Logo" height="60">
                  @endif
                  {{--<button type="button" class="btn btn-sm btn-outline-dark" onclick="remove_logo(this)">Remove</button>--}}
                  <input type="hidden" name="logo" value="{{$project->logo}}">
                  <input type="file" name="file_logo">
                  @error('file_logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>      
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="classes[]">Classes</label>
            <div class="col-md-9 col-form-label">
              @if (old("classes"))
                @foreach($classes as $c)
                  @include('admin.projects.class', ['c'=>$c, 'v'=>old("classes")])
                @endforeach
              @else
                @foreach($classes as $c)
                  @include('admin.projects.class', ['c'=>$c, 'v'=>explode('|',$project->class)])
                @endforeach
              @endif
              @error('classes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="partners[]">Partners</label>
            <div class="col-md-9 col-form-label">
              @if (old("partners"))
                @foreach($partners as $c)
                  @include('admin.projects.partner',['c'=>$c,'v'=>old('partners')])
                @endforeach
              @else
                @foreach($partners as $c)
                  @include('admin.projects.partner',['c'=>$c,'v'=>$project->partners()->pluck('id')->toArray()])
                @endforeach
              @endif
              @error('partners')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="participants[]">Participants</label>
            <div class="col-md-9">
              <div id="items-wrapper" >
                @if (old("participants"))
                @for($i=0; $i < count(old("participants")); $i++)
                  @include('admin.projects.participant', ['p'=>old('participants')[$i]])
                @endfor
                @else
                @foreach(explode('|',$project->participants) as $p)
                  @if($p)
                  @include('admin.projects.participant', ['p'=>$p])
                  @endif
                @endforeach
                @endif
              </div>
              @error('participants')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              @error('participants.*')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="btn btn-outline-dark" onclick="add_item(this)">Add participant</button>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="description_text[]">Description</label>
            <div class="col-md-9">
              <div id="descriptions-wrapper" >
                @if (old("descriptions"))
                @foreach(old("descriptions") as $i => $d)
                  @include('admin.projects.description', [
                    'lang' => $d['lang'],
                    'title' => $d['title'], 
                    'text' => $d['text'],
                    'i' => $i])
                @endforeach
                @else
                @foreach($project->descriptions as $i => $p)
                  @include('admin.projects.description', [
                    'lang' => $p->lang, 
                    'title' => $p->title, 
                    'text' => $p->text,
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
    <div id="item_template" style="display:none;">
      @include('admin.projects.participant', ['p'=>''])
    </div>
    <div id="description_template" style="display:none;">
      @include('admin.projects.description', ['lang'=>'', 'title'=>'', 'text'=>'', 'i' => ''])
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
<script type="text/javascript">
  function add_item(elem){
    $('#items-wrapper').append($('#item_template').html());
  }
  function remove_item(elem){
    $(elem).parentsUntil('#items-wrapper').remove();
  }
  function add_description(elem){
    var obj = $($('#description_template').html());
    $('#descriptions-wrapper').append(obj);
    obj.find('[name$="[text]"]').cleditor(); 
  }
  function remove_description(elem){
    $(elem).parentsUntil('#descriptions-wrapper').remove();
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
        element.find('[name$="[lang]"]').attr('name','descriptions['+i+'][lang]');
        element.find('[name$="[title]"]').attr('name','descriptions['+i+'][title]');
        element.find('[name$="[text]"]').attr('name','descriptions['+i+'][text]');
      });
      return true;
    });
  });
</script>
@endpush