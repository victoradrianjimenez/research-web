<section id="portfolio" class="portfolio">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Projects')}}</h2>
    </div>

    <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
      <li data-filter="*" class="filter-active">{{__('All')}}</li>
      @php
        $cnt = 0;
        $unique = [];
        foreach($projects as $p)
          foreach(explode('|',$p->class) as $c)
            $unique[$c] = (isset($unique[$c]))?$unique[$c]+1:1;
      @endphp
      @foreach($classes as $c)
        @foreach($unique as $k => $v)
          @if($c->name == $k && $v > 0)
            @if(++$cnt == 6)
              </ul><ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
              @php $cnt=0;@endphp
            @endif
            <li data-filter=".filter-{{$k}}">{{$c->text}}</li>
          @endif
        @endforeach
      @endforeach
    </ul>
    
    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
      @foreach($projects as $p)
        @php 
          $description = $p->descriptions()->where('lang','=',$config->lang)->first();
          if(!$description) $description = $p->descriptions()->first();
        @endphp
        <div class="col-lg-4 col-md-6 portfolio-item filter-{{implode(' filter-',explode('|',$p->class))}}">
          <div class="portfolio-img">
            <img src="{{asset('storage/'.$p->logo)}}" class="img-fluid" alt="Logo">
          </div>
          <div class="portfolio-info">
            <h4><a href="{{route('project', $p->url)}}">{{$description->title}}</a></h4>
            <p>{{$p->period}}</p>
            <a href="{{route('project', $p->url)}}" class="details-link" title="{{__('More Details')}}">
              <i class="bx bx-link"></i></a>
          </div>
        </div>
      @endforeach
    </div>

  </div>
</section>