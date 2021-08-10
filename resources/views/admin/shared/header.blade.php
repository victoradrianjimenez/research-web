<div class="c-wrapper">
  <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
      <span class="c-header-toggler-icon"></span>
    </button>
    <a class="c-header-brand d-sm-none" href="#">
      {{--<img class="c-header-brand" src="{{asset('storage/'.$config->logo_color_small)}}" height="46" alt="Logo" style="height: 46px;">--}}
    </a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav ml-auto mr-4">
      <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <span style="margin-right:5px;">{{Auth::user()->name}}</span>
          <div class="c-avatar">
            <img class="c-avatar-img" src="{{asset('img/user.png')}}" alt="{{Auth::user()->email}}">
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
          <a class="dropdown-item" href="{{route('users.edit',Auth::user()->id)}}">
            <svg class="c-icon mr-2">
              <use xlink:href="{{ url('icons/sprites/free.svg#cil-settings') }}"></use>
            </svg> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <svg class="c-icon mr-2">
              <use xlink:href="{{ url('icons/sprites/free.svg#cil-account-logout') }}"></use>
            </svg>
            <form action="{{ route('logout') }}" method="POST"> 
              @csrf
              <button type="submit" class="btn" style="padding:0;">Logout</button>
            </form>
          </a>
        </div>
      </li>
    </ul>
    <div class="c-subheader px-3">
      <ol class="breadcrumb border-0 m-0">
        {{--<li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>--}}
        @for($i = 1; $i <= count(Request::segments()); $i++)
          <li class="breadcrumb-item {{($i < count(Request::segments()))?'active':''}}">
            <a href="{{url(implode('/',array_slice(Request::segments(),0,$i)))}}">
              {{ ucfirst(Request::segment($i)) }}
            </a>
          </li>
        @endfor
      </ol>
    </div>
</header>