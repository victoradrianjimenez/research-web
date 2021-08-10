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
        <div class="card-header"><h3>Member information</h3></div>
        <div class="card-body">

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="fullname">Full name</label>
            <div class="col-md-9">
              <input class="form-control @error('fullname') is-invalid @enderror" type="text" name="fullname" title="Enter the full name" value="{{old('fullname', $member->fullname)}}" required=""><span class="help-block"></span>
              @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="type">Type</label>
            <div class="col-md-9">
              <select class="form-control @error('type') is-invalid @enderror" name="type" required="">
                <option value="" {{old('type',$member->type)==''?'selected':''}}>Please select an option</option>
                @foreach($member->get_type_list() as $t)
                <option value="{{$t}}" {{old('type',$member->type)==$t?'selected':''}}>{{__('app.'.$t)}}</option>
                @endforeach
              </select>
              @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="url">URL name</label>
            <div class="col-md-9">
              <input class="form-control @error('url') is-invalid @enderror" id="text-input" type="text" name="url" title="Name showed in bibliography items" value="{{old('url', $member->url)}}" required=""><span class="help-block"></span>
              @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="file_photo">Photo</label>
            <div class="col-md-9">
              @if($member->photo)
              <img src="{{url('storage/'.$member->photo)}}" alt="Photo" height="60">
              <input type="hidden" name="photo" value="{{$member->photo}}">
              @endif
              <input type="file" name="file_photo">
              @error('file_photo')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="order">Order</label>
            <div class="col-md-9">
              <input class="form-control @error('order') is-invalid @enderror" id="text-input" type="number" name="order" title="Position in the members list" value="{{old('order',$member->order)}}" required=""><span class="help-block"></span>
              @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="socials">Socials</label>
            <div class="col-md-9">
              <div id="socials-wrapper" >
                @if (old("socials"))
                @foreach(old("socials") as $i => $r)
                  @include('admin.members.social', [
                    'name' => $r['name'], 
                    'link' => $r['link'], 
                    'text' => $r['text'],
                    'i' => $i])
                @endforeach
                @else
                @foreach($member->socials as $i => $s)
                  @include('admin.members.social', [
                    'name' => $s->name, 
                    'link' => $s->link, 
                    'text' => $s->text,
                    'i' => $i])
                @endforeach
                @endif
              </div>
              @error('socials')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="btn btn-outline-dark" onclick="add_social(this)">Add social</button>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 col-form-label" for="bios">Biography</label>
            <div class="col-md-9">
              <div id="bios-wrapper" >
                @if (old("bios"))
                @foreach(old("bios") as $i => $r)
                  @include('admin.members.bio', [
                    'lang' => $r['lang'], 
                    'role' => $r['role'],
                    'short' => $r['short'],
                    'interests' => $r['interests'], 
                    'activities' => $r['activities'],
                    'i' => $i])
                @endforeach
                @else
                @foreach($member->bios as $i => $b)
                  @include('admin.members.bio', [
                    'lang' => $b->lang, 
                    'role' => $b->role, 
                    'short' => $b->short, 
                    'interests' => $b->interests, 
                    'activities' => $b->activities,
                    'i' => $i])
                @endforeach
                @endif
              </div>
              @error('bios')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="btn-group" role="">
                <button type="button" class="btn btn-outline-dark" onclick="add_bio(this)">Add biography</button>
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
    <div id="social_template" style="display:none;">
      @include('admin.members.social', ['name'=>'','link'=>'','text'=>'','i'=>''])
    </div>
    <div id="bio_template" style="display:none;">
      @include('admin.members.bio', ['lang'=>'','role'=>'','short'=>'','interests'=>'','activities'=>'','i'=>''])
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
<script type="text/javascript">
  function add_social(){
    var obj = $($('#social_template').html());
    $('#socials-wrapper').append(obj);
  };
  function remove_social(elem){
    $(elem).parentsUntil('#socials-wrapper').remove();
  };
  function add_bio(){
    var obj = $($('#bio_template').html());
    $('#bios-wrapper').append(obj);
    obj.find('[name$="[interests]"]').cleditor();
    obj.find('[name$="[activities]"]').cleditor(); 
    obj.find('[name$="[short]"]').cleditor(); 
  };
  function remove_bio(elem){
    $(elem).parentsUntil('#bios-wrapper').remove();
  };
  $(document).ready(function () { 
    $('#bios-wrapper [name$="[interests]"]').cleditor(); 
    $('#bios-wrapper [name$="[activities]"]').cleditor(); 
    $('#bios-wrapper [name$="[short]"]').cleditor(); 
    $('#main-form').submit(function(){
      $('#bios-wrapper').children().each(function(i, v){
        var element = $(v);
        element.find('[name$="[lang]"]').attr('name','bios['+i+'][lang]');
        element.find('[name$="[role]"]').attr('name','bios['+i+'][role]');
        element.find('[name$="[short]"]').attr('name','bios['+i+'][short]');
        element.find('[name$="[interests]"]').attr('name','bios['+i+'][interests]');
        element.find('[name$="[activities]"]').attr('name','bios['+i+'][activities]');
      });
      $('#socials-wrapper').children().each(function(i, v){
        var element = $(v);
        element.find('[name$="[name]"]').attr('name','socials['+i+'][name]');
        element.find('[name$="[text]"]').attr('name','socials['+i+'][text]');
        element.find('[name$="[link]"]').attr('name','socials['+i+'][link]');
      });
      return true;
    });
  });
</script>
@endpush