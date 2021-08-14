@extends('admin.base')

@push('styles')
<link rel="stylesheet" href="{{asset('css/jquery.cleditor.css')}}" />
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <form id="main-form" class="form-horizontal" action="{{$action}}" method="post" enctype="multipart/form-data">
      {{ ($method == 'PUT') ? method_field('PUT') : ''}}
      @csrf
      <div class="card">
        <div class="card-header"><h3>News information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="date">Date <span class="required">*</span></label>
            <div class="col-md-9">
              <input class="form-control @error('date') is-invalid @enderror" id="datepicker" type="text" name="date" placeholder="yyyy-mm-dd" value="{{old('date', $news->date)}}" title="Published date of the article" required=""><span class="help-block"></span>
              @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="url">URL name <span class="required">*</span></label>
            <div class="col-md-9">
              <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" placeholder="" value="{{old('url', $news->url)}}" title="Part of the URL to access to the news entry in the site" required=""><span class="help-block"></span>
              @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="author">Author <span class="required">*</span></label>
            <div class="col-md-9">
              <input class="form-control @error('author') is-invalid @enderror" type="text" name="author" placeholder="" value="{{old('author', $news->author)}}" title="Name of the article author" required=""><span class="help-block"></span>
              @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="link">External link</label>
            <div class="col-md-9">
              <input class="form-control @error('link') is-invalid @enderror" type="url" name="link" placeholder="http://" value="{{old('link', $news->link)}}" title="Full URL for external page"><span class="help-block"></span>
              @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="classes[]">Classes <span class="required">*</span></label>
            <div class="col-md-9 col-form-label">
              @if (old("classes"))
                @foreach($classes as $c)
                  @include('admin.news.class', ['c'=>$c, 'v'=>old("classes")])
                @endforeach
              @else
                @foreach($classes as $c)
                  @include('admin.news.class', ['c'=>$c, 'v'=>explode('|',$news->class)])
                @endforeach
              @endif
              @error('classes')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="descriptions">Description <span class="required">*</span></label>
            <div class="col-md-9">
              <div id="descriptions-wrapper" >
                @if (old("descriptions"))
                @foreach(old("descriptions") as $i => $r)
                  @include('admin.news.description', [
                    'lang' => $r['lang'], 
                    'title' => $r['title'], 
                    'short' => $r['short'], 
                    'text' => $r['text'],
                    'i' => $i])
                @endforeach
                @else
                @foreach($news->descriptions as $i => $p)
                  @include('admin.news.description', [
                    'lang' => $p->lang, 
                    'title' => $p->title, 
                    'short' => $p->short, 
                    'text' => $p->text,
                    'i' => $i])
                @endforeach
                @endif
              </div>
              @error('descriptions')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <br>
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark" onclick="add_description(this)"><i class="cil-plus"></i> Add description</button>
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
      @include('admin.news.description', ['lang'=>'', 'title'=>'', 'short'=>'', 'text'=>'', 'i'=>''])
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
  function add_description(elem){
    var obj = $($('#description_template').html());
    $('#descriptions-wrapper').append(obj);
    obj.find('[name$="[text]"]').cleditor(); 
  }
  function remove_description(elem){
    $(elem).parentsUntil('#descriptions-wrapper').remove();
  }
  $(document).ready(function () { 
    $('#descriptions-wrapper [name$="[text]"]').cleditor(); 
    $('#datepicker').datepicker({dateFormat: "yy-mm-dd"});
    $('#main-form').submit(function(){
      var descriptions = $('#descriptions-wrapper').children().each(function(i, v){
        var element = $(v);
        element.find('[name$="[text]"]').attr('name','descriptions['+i+'][text]');
        element.find('[name$="[title]"]').attr('name','descriptions['+i+'][title]');
        element.find('[name$="[short]"]').attr('name','descriptions['+i+'][short]');
        element.find('[name$="[text]"]').attr('name','descriptions['+i+'][text]');
      });
    });
  });
</script>
@endpush