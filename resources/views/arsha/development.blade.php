@php 
  $description = $development->descriptions()->where('lang','=',$config->lang)->first();
  if(!$description) $description = $development->descriptions()->first();
@endphp
<section id="portfolio-details" class="portfolio-details">
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">

      <div class="col-lg-4 order-lg-2">
        <div class="portfolio-info box-featured">
          <div class="d-flex justify-content-center">
            <img src="{{asset('assets/'.$development->logo)}}" height="150">
          </div>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Participants')}}</h3>
          <ul>
            @foreach(explode('|', $development->participants) as $p)
              <li>{{$p}}</li>
            @endforeach
          </ul>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Details')}}</h3>
          <ul>
            <li><strong>{{__('Title')}}: </strong>{{$development->title}}</li>
            <li><strong>{{__('Period')}}: </strong>{{$development->period}}</li>
            @if ($development->link)
              <li><strong>{{__('Link')}}: </strong>
                <a href="{{$development->link}}" target="_blank">{{$development->link}}</a>
              </li>
            @endif
          </ul>
        </div>
      </div>

      <div class="col-lg-8 order-lg-1">
        <div class="section-title">
          <h2>{{$description->title}}</h2>
        </div>
        <div class="portfolio-description content-align-justify">
          {{--<h2 id="short-bio">{{__('Description')}}</h2>--}}
          <div>{!!$description->text!!}</div>
          <span class="border-separator"></span>
          <h2 id="selected-publications">{{__('Partners')}}</h2>
        </div>
        <div class="services section-bg">
          <div class="row">
            @foreach($development->partners as $p)
            <div class="col-xl-3 col-md-3 align0items-stretch">
              <div class="icon-box box-featured">
                <div class="icon">
                  <img src="{{asset('assets/'.$p->logo)}}" height="40">
                </div>
                <h4>
                  <a href="{{$p->link}}" target="_blank" title="{{$p->fullname}}">{{$p->name}}</a>
                </h4>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
