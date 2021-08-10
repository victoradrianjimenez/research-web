<section id="why-us" class="why-us section-bg">
  <div class="container-fluid" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Publications')}}</h2>
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
              <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#accordion-list-{{$p->year}}">
                <span>{{$year = $p->year}}</span>
                <i class="bx bx-chevron-down icon-show"></i>
                <i class="bx bx-chevron-up icon-close"></i>
              </a>
              <div id="accordion-list-{{$p->year}}" class="collapse {{($cnt++ <= $years_number)?'show':''}}">
                <ul>
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