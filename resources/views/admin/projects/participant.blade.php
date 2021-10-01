<div class="form-group row">
  <div class="col-sm-10">
    <label class="col-form-label">Name <span class="required">*</span></label>
    <input class="form-control" type="text" name="participants[]" value="{{$p}}" required="">
  </div>
  <div class="col-sm-2">
    <label class="col-form-label">Action</label>
    <div style="width:40px">
      <button type="button" class="btn btn-outline-dark" onclick="remove_item(this)" title="Remove"><i class="cil-minus"></i></button>
    </div>
  </div>
</div>