<div class="item">
  <div class="form-group row">
    <div class="col-sm-3">
      <label class="col-form-label">Name</label>
      <input class="form-control" type="text" name="socials[{{$i}}][name]" title="Name" value="{{$name}}" title="Name input" required="">
      @error('socials.'.$i.'.name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-sm-3">
      <label class="col-form-label">Text</label>
      <input class="form-control" type="text" name="socials[{{$i}}][text]" title="Text" value="{{$text}}" title="Text input" required="">
      @error('socials.'.$i.'.text')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-sm-4">
      <label class="col-form-label">External Link</label>
      <input class="form-control" type="text" name="socials[{{$i}}][link]" placeholder="http://" value="{{$link}}" title="External link input">
      @error('socials.'.$i.'.link')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="col-sm-2">
      <label class="col-form-label">Action</label>
      <button type="button" class="form-control btn btn-outline-dark" onclick="remove_social(this)">Remove</button>
    </div>
  </div>
</div>