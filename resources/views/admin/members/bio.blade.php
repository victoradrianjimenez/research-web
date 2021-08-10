<div class="item">
  <div class="form-group row">
    <div class="col-sm-10">
      <div class="row">
        <div class="col-sm-4">
          <label class="col-form-label">Language</label>
          <select class="form-control" name="bios[{{$i}}][lang]" required="">
            <option value="en" {{$lang=='en'?'selected':''}}>English</option>
            <option value="es" {{$lang=='es'?'selected':''}}>Spanish</option>
          </select>
          @error('bios.'.$i.'.lang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-8">
          <label class="col-form-label">Role</label>
          <input class="form-control" type="text" name="bios[{{$i}}][role]" value="{{$role}}" title="Role input" required="">
          @error('bios.'.$i.'.role')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="col-form-label">Short-bio</label>
          <textarea class="form-control" name="bios[{{$i}}][short]" id="short" rows="6" title="Short biography">{{$short}}</textarea>
          @error('bios.'.$i.'.short')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="col-form-label">Interests</label>
          <textarea class="form-control" name="bios[{{$i}}][interests]" rows="6" title="Interests">{{$interests}}</textarea>
          @error('bios.'.$i.'.interests')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="col-form-label">Activities</label>
          <textarea class="form-control" name="bios[{{$i}}][activities]" rows="6" title="Activities">{{$activities}}</textarea>
          @error('bios.'.$i.'.activities')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <label class="col-form-label">Action</label>
      <button type="button" class="form-control btn btn-outline-dark" onclick="remove_bio(this)">Remove</button>
    </div>
  </div>
</div>