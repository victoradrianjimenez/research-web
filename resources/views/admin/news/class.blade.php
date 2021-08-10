<div class="form-check checkbox">
  <input class="form-check-input" name="classes[]" type="checkbox" value="{{$c->name}}" @foreach($v as $o){{($c->name==$o)?'checked="checked"':''}}@endforeach>
  <label class="form-check-label" for="check1">{{$c->text}}</label>
</div>