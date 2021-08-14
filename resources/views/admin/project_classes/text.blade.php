<div class="form-group row">
  <div class="col-sm-3">
    <select class="form-control" name="lang[]" title="Language selector" required="">
      <option value="en" {{$l=='en'?'selected':''}}>English</option>
      <option value="es" {{$l=='es'?'selected':''}}>Spanish</option>
    </select>
  </div>
  <div class="col-sm-7">
    <input class="form-control" type="text" name="text[]" value="{{$t}}" title="Text input" required="">
  </div>
  <div class="col-sm-2">
    <div style="width:40px">
      <button type="button" class="form-control btn btn-outline-dark" onclick="remove_item(this)" title="Remove"><i class="cil-minus"></i></button>
    </div>
  </div>
</div>