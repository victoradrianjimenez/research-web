<section id="services" class="services {{($parity=='even')?'section-bg':''}}">
  <div class="container" data-aos="fade-up">
    
    <div class="section-description content-align-justify">
    @php $i=0; @endphp
    @foreach($descriptions[$url] as $d)
      @if ($d->type == 'section')
        @if ($i++ == 0)
          <div class="section-title">
            @if ($d->logo)
              <img src="{{asset('assets/'.$d->logo)}}" height="40">
            @endif
            <h2>{{$d->title}}</h2>
            <div class="content-align-justify">{!!$d->text!!}</div>
          </div>
        @else
          <div class="">
            @if ($d->logo)
              <img src="{{asset('assets/'.$d->logo)}}" height="40">
            @endif
            <h3>{{$d->title}}</h3>
            <div>{!!$d->text!!}</div>
          </div>
        @endif
      @elseif ($full_description)
          <div class="">
            @if ($d->logo)
              <img src="{{asset('assets/'.$d->logo)}}" height="40">
            @endif
            <h4>{{$d->title}}</h4>
            <div>{!!$d->text!!}</div>
          </div>
      @endif
    @endforeach
    </div>

    @if (!$full_description)
      <div class="about">
        <div class="content">
          <a href="{{url($url)}}" class="btn-learn-more">{{__('Read More')}}...</a>
        </div>
      </div>
    @endif
  </div>
</section>