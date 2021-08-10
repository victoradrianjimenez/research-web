<div class="item">
  <div class="form-group row">
    <div class="col-sm-10">
      <div class="row">
        <div class="col-sm-4">
          <label class="col-form-label">Language</label>
          <select class="form-control" name="descriptions[{{$i}}][lang]" title="Language selector" required="">
            <option value="en" {{$lang=='en'?'selected':''}}>English</option>
            <option value="es" {{$lang=='es'?'selected':''}}>Spanish</option>
          </select>
          @error('descriptions.'.$i.'.lang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-sm-8">
          <label class="col-form-label">Title</label>
          <input class="form-control" type="text" name="descriptions[{{$i}}][title]" value="{{$title}}" title="Name input" required="">
          @error('descriptions.'.$i.'.title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <label class="col-form-label">Text</label>
          <textarea class="form-control" name="descriptions[{{$i}}][text]" rows="9" title="Content.." required="">{{$text}}</textarea>
          @error('descriptions.'.$i.'.text')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <label class="col-form-label">Action</label>
      <button type="button" class="form-control btn btn-outline-dark" onclick="remove_description(this)">Remove</button>
    </div>
  </div>
</div>