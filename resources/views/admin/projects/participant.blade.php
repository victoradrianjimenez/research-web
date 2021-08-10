<div class="form-group row">
  <div class="col-sm-10">
    <label class="col-form-label">Name</label>
    <input class="form-control" type="text" name="participants[]" value="{{$p}}">
  </div>
  <div class="col-sm-2">
    <label class="col-form-label">Action</label>
    <button type="button" class="form-control btn btn-outline-dark" onclick="remove_item(this)">Remove</button>
  </div>
</div>