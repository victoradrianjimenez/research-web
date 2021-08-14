  <div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{asset('assets/'.$config->logo_color_large)}}" height="46" alt="Research Site" style="height: 46px;">
    <img class="c-sidebar-brand-minimized" src="{{asset('assets/'.$config->logo_color_small)}}" height="46" alt="Research Site" style="height: 46px;">
  </div>
  <nav class="c-sidebar-nav">
    <ul class="c-sidebar-nav">
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('members.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-people')}}"></use>
          </svg> Members
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('publications.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-library')}}"></use>
          </svg> Publications
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('partners.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-industry')}}"></use>
          </svg> Partners
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('projects.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-object-group')}}"></use>
          </svg> Projects
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('sections.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-notes')}}"></use>
          </svg> Sections
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('news.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-newspaper')}}"></use>
          </svg> News
        </a>
      </li>
      <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('assets.index')}}">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-copy')}}"></use>
          </svg> Assets
        </a>
      </li>
      <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-settings')}}"></use>
        </svg> Configuration</a>
        <ul class="c-sidebar-nav-dropdown-items">
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('configuration.index')}}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-check')}}"></use>
              </svg> Settings
            </a>
          </li>
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('users.index')}}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-people')}}"></use>
              </svg> Users
            </a>
          </li>
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('project_classes.index')}}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-tags')}}"></use>
              </svg> Project classes
            </a>
          </li>
          <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('news_classes.index')}}">
              <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{asset('icons/coreui/free-symbol-defs.svg#cui-tags')}}"></use>
              </svg> News classes
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>