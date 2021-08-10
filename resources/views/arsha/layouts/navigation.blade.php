<nav id="navbar" class="navbar">
  <ul>
    <li><a class="getstarted scrollto active" href="{{route('home')}}">{{__('Home')}}</a></li>
    <li class="dropdown "><a href="#"><span>{{__('Research')}}</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
        <li><a href="{{url('research')}}">{{__('Research Areas')}}</a></li>
        <li><a href="{{route('projects')}}">{{__('Projects')}}</a></li>
        <li><a href="{{route('developments')}}">{{__('Developments')}}</a></li>
        <li><a href="{{route('publications')}}">{{__('Publications')}}</a></li>
        <li><a href="{{route('patents')}}">{{__('Patents')}}</a></li>
      </ul>
    </li>
    <li><a class="nav-link scrollto" href="{{route('news')}}">{{__('News & Events')}}</a></li>
    <li><a class="nav-link scrollto" href="{{route('members')}}">{{__('Members')}}</a></li>
    <li><a class="nav-link scrollto" href="{{route('contact')}}">{{__('Contact')}}</a></li>
    <li><a class="nav-link scrollto" href="{{route('login')}}"><span title="{{__('Login')}}"><i class="bi bi-box-arrow-in-right"></i></span></a></li>
    <li class="dropdown"><a href="#"><span title="{{__('Translate')}}"><i class="bi bi-translate"></i></span></a>
      <ul class="dropdown-menu-right">
        @foreach($locales as $l)
        <li><a href="{{route('locale',$l->lang)}}">{{__($l->text)}}</a></li>
        @endforeach
      </ul>
    </li>
  </ul>
  <i class="bi bi-list mobile-nav-toggle"></i>
</nav>
