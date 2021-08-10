<div class="form-check checkbox">
  <input class="form-check-input" name="partners[]" type="checkbox" value="{{$c->id}}" @foreach($v as $o){{($c->id == $o)?'checked="checked"':''}}@endforeach>
  <label class="form-check-label" for="check1">{{$c->name}}</label>
</div>