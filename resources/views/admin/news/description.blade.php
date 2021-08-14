<div class="item">
  <div class="row">
    <div class="col-sm-10">
      <div class="form-group row">
        <div class="col-sm-4">
          <label class="col-form-label">Languaje <span class="required">*</span></label>
          <select class="form-control" name="descriptions[{{$i}}][lang]" title="Language selector">
            <option value="en" {{$lang=='en'?'selected':''}}>English</option>
            <option value="es" {{$lang=='es'?'selected':''}}>Spanish</option>
          </select>
          @error('descriptions.*.lang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-sm-8">
          <label class="col-form-label">Title <span class="required">*</span></label>
          <input class="form-control" type="text" name="descriptions[{{$i}}][title]" value="{{$title}}" title="Title input" required="">
          @error('descriptions.*.title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-12">
          <label class="col-form-label">Short <span class="required">*</span></label>
          <input class="form-control" type="text" name="descriptions[{{$i}}][short]" value="{{$short}}" title="Short text input" required="">
          @error('descriptions.*.short')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-12">
          <label class="col-form-label">Text</label>
          <textarea class="form-control" name="descriptions[{{$i}}][text]" rows="9" title="Content...">{{$text}}</textarea>
          @error('descriptions.*.text')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <label class="col-form-label">Action</label>
      <div style="width: 40px">
        <button type="button" class="form-control btn btn-outline-dark" onclick="remove_description(this)" title="Remove"><i class="cil-minus"></i></button>
      </div>
    </div>
  </div>
</div>