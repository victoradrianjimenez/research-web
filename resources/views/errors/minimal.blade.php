@extends('admin.errorBase')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="clearfix">
        <h1 class="float-left display-3 mr-4">@yield('code')</h1>
        <h4 class="pt-3">@yield('title')</h4>
        <p class="text-muted">@yield('message')</p>
      </div>
      <form action="http://google.com/search" method="get">
        <input type="hidden" name="as_sitesearch" value="{{url('')}}">
        <div class="input-prepend input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg class="c-icon">
                <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-magnifying-glass')}}"></use>
              </svg>
            </span>
          </div>
          <input name="as_q" results="0" class="form-control" id="prependedInput" size="16" type="text" placeholder="What are you looking for?"><span class="input-group-append">
          <span>
            <button class="btn btn-info" type="submit">Search</button>
          </span>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


