<div class="item">
  <div class="form-group row">
    <div class="col-sm-10">
      <input class="form-control" type="text" name="publications_text[]" readonly="" value="{{$url}}">
      <input type="hidden" name="publications[]" value="{{$id}}">
    </div>
    <div class="col-sm-2">
      {{--<label class="col-form-label">Action</label>--}}
      <div style="width: 40px">
        <button type="button" class="btn btn-outline-dark" onclick="remove_publication(this)" title="Remove"><i class="cil-minus"></i></button>
      </div>
    </div>
  </div>
</div>