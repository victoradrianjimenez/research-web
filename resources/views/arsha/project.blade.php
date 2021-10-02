@php 
  $description = $project->descriptions()->where('lang','=',$config->lang)->first();
  if(!$description) $description = $project->descriptions()->first();
@endphp
<section id="portfolio-details" class="portfolio-details">
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">

      <div class="col-lg-4 order-lg-2">
        <div class="portfolio-info box-featured">
          <div class="d-flex justify-content-center">
            <img src="{{asset('assets/'.$project->logo)}}" height="150">
          </div>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Participants')}}</h3>
          <ul>
            @foreach(explode('|', $project->participants) as $p)
              <li>{{$p}}</li>
            @endforeach
          </ul>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Certification')}}</h3>
          <ul>
            @if ($project->institution)
              <li><strong>{{__('Institution')}}: </strong>
                {{$project->institution}}
              </li>
            @endif
              <li><strong>{{__('Title')}}: </strong>
                {{$project->title}}
              </li>
            @if ($project->code)
              <li><strong>{{__('Code')}}: </strong>
                {{$project->code}}
              </li>
            @endif
              <li><strong>{{__('Period')}}: </strong>
                {{$project->period}}
              </li>
            @if ($project->link)
              <li><strong>{{__('Link')}}: </strong>
                <a href="{{$project->link}}" target="_blank">{{$project->link}}</a>
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
          <h2 id="short-bio">{{__('Description')}}</h2>
          <div>{!!$description->text!!}</div>
          <span class="border-separator"></span>
          @php
            $n_patents = 0;
            $n_publications = 0;
            foreach($project->publications as $p){
              if(strtolower($p->type) == 'patent')
                $n_patents++;
              else
                $n_publications++;
            }
          @endphp
          @if($n_patents)
            <h2>{{__('Patent Applications')}}</h2>
            <ul>
              @foreach($project->publications as $p)
                @if(strtolower($p->type) == 'patent')
                  <li>{!!$p->citation!!}</li>
                    <a href="{{route('publication', $p->url)}}">{{__('Read More')}}...</a>
                  </li>
                @endif
              @endforeach
            </ul>
          @endif
          @if($n_publications)
            <h2>{{__('Publications')}}</h2>
            <ul>
              @foreach($project->publications as $p)
                @if(strtolower($p->type) != 'patent')
                  <li>{!!$p->citation!!}</li>
                    <a href="{{route('publication', $p->url)}}">{{__('Read More')}}...</a>
                  </li>
                @endif
              @endforeach
            </ul>
          @endif
          <span class="border-separator"></span>
        </div>
        <h2>{{__('Partners')}}</h2>
        <div class="services section-bg">
          <div class="row">
            @foreach($project->partners as $p)
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
