@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('arsha/vendor/bungie-bar/bungie.css')}}">
@endpush

<section id="why-us" class="why-us section-bg">
  <div class="container-fluid" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Publications')}}</h2>
    </div>

    <div class="demoNav">
      <div id="left">
      </div>
      <div id="bungie">
        <ul>
        @php 
          $year = -1; 
        @endphp
        @foreach($publications as $p)
          @if ($p->year != $year)
            <li><a href="#accordion-list-{{$year = $p->year}}">{{$year}}</a></li>
          @endif
        @endforeach
        </ul>
      </div>
      <div id="right">
      </div>
    </div>
    
    <div class="accordion-list content-align-justify">
      <ul>
        @php 
          $year = -1; 
          $cnt = 0;
        @endphp
        @foreach($publications as $p)
          @if ($p->year != $year)
            @if($year > 0)  
                </ul>
              </div>
            </li>
            @endif
            <li>
              <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{$p->year}}">
                <span>{{$year = $p->year}}</span>
                <i class="bi bi-caret-up icon-close"></i>
                <i class="bi bi-caret-down icon-show"></i>
              </a>
              <div id="accordion-list-{{$p->year}}" class="collapse {{($cnt++ <= $years_number)?'show':''}}">
                <ul class="timeline">
          @endif
                  <li class="publication-item">
                    {!!$p->citation!!}
                    <a href="{{route('publication', $p->url)}}">{{__('Read More')}}...</a>
                  </li>
        @endforeach
                </ul>
              </div>
            </li>
      </ul>
    </div>
        
  </div>
</section>

@push('scripts')
<script src="{{asset('arsha/vendor/bungie-bar/bungie.js')}}"></script>
@endpush