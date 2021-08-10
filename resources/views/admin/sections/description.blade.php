<div class="item">
  <div class="form-group row">
    <div class="col-sm-10">
      
      <div class="row">
        <input type="hidden" name="descriptions[{{$i}}][id]" value="{{$id}}">

        <div class="col-sm-4">
          <label class="col-form-label">Language</label>
          <select class="form-control" name="descriptions[{{$i}}][lang]" required="">
            <option value="en" {{$lang=='en'?'selected':''}}>English</option>
            <option value="es" {{$lang=='es'?'selected':''}}>Spanish</option>
          </select>
          @error('descriptions.'.$i.'.lang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="col-sm-4">
          <label class="col-form-label">Type</label>
          <select class="form-control" name="descriptions[{{$i}}][type]" required="">
            <option value="section" {{$type=='section'?'selected':''}}>Section</option>
            <option value="subsection" {{$type=='subsection'?'selected':''}}>Subsection</option>
          </select>
          @error('descriptions.'.$i.'.type')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="col-md-4">
          <label class="col-form-label">Title</label>
          <input class="form-control" type="text" name="descriptions[{{$i}}][title]" value="{{$title}}" title="Title input" required="">
          @error('descriptions.'.$i.'.title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <label class="col-form-label">Text</label>
          <textarea class="form-control" name="descriptions[{{$i}}][text]" rows="6" title="Text content input">{{$text}}</textarea>
          @error('descriptions.'.$i.'.text')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="logo_input_wrapper">
            <div>
              <label class="col-form-label">Logo</label>
              @if($logo)
                <img src="{{url('storage/'.$logo)}}" alt="Logo" height="60">
              @endif
              <button type="button" class="btn btn-sm btn-outline-dark" onclick="remove_logo(this)">Remove</button>
              <input type="hidden" name="descriptions[{{$i}}][logo]" value="{{$logo}}">
              <input type="file" name="descriptions[{{$i}}][file_logo]">
            </div>
          </div>
          @error('descriptions.'.$i.'.logo')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          @error('descriptions.'.$i.'.file_logo')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <label class="col-form-label">Link</label>
          <input class="form-control" type="url" name="descriptions[{{$i}}][link]" placeholder="http://" value="{{$link}}" title="External link input">
          @error('descriptions.'.$i.'.link')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

    </div>
    <div class="col-sm-2">
      <label class="col-form-label">Action</label>
      <button type="button" class="form-control btn btn-outline-dark" onclick="remove_description(this)">Remove</button>
      <button type="button" class="form-control btn btn-outline-dark" onclick="up_description(this)">Up</button>
      <button type="button" class="form-control btn btn-outline-dark" onclick="down_description(this)">Down</button>
    </div>
  </div>
</div>