<div class="form-group row">
  <div class="col-sm-2">
    <select class="form-control" name="lang[]" title="Language selector" required="">
      <option value="en" {{$l=='en'?'selected':''}}>English</option>
      <option value="es" {{$l=='es'?'selected':''}}>Spanish</option>
    </select>
  </div>
  <div class="col-sm-8">
    <input class="form-control" type="text" name="text[]" value="{{$t}}" title="Text input" required="">
  </div>
  <div class="col-sm-2">
    <button type="button" class="form-control btn btn-outline-dark" onclick="remove_item(this)">Remove</button>
  </div>
</div>