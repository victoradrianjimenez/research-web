@include('arsha.layouts.utils')

@php 
  $bio = $member->bios()->where('lang','=',$config->lang)->first();
  if (!$bio) 
    $bio = $member->bios()->first();
  $socials = $member->socials; 
  $year=-1; 
  $years=[];
  $member_publications = $member->publications()->orderBy('year','desc')->get();
  foreach($member_publications as $p)
    if ($p->year != $year){
      $year = $p->year;
      array_push($years, $p->year);
    }
@endphp
<section id="portfolio-details" class="portfolio-details">
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">

      <div class="col-lg-4 order-lg-2">
        <div class="portfolio-info box-featured">
          <div class="d-flex justify-content-center">
            <img src="{{asset('assets/'.$member->photo)}}" width="200" height="200">
          </div>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Contact')}}</h3>
          <ul>
            @foreach($socials as $s)
            <li>
              <a href="{{$s->link}}" target="_blank">
                <i class="{{getSocialIconClass($s->name)}}"></i> {{$s->text}}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Menu')}}</h3>
          <h6>{{__('Information')}}:</h6>
          <ul>
            @if (strlen($bio->short)>1)
              <li>
                <strong><a href="#short-bio">{{__('Short Bio')}}</a></strong>
              </li>
            @endif
            @if (strlen($bio->interests)>1)
              <li>
                <strong><a href="#research-interests">{{__('Research Interests')}}</a></strong>
              </li>
            @endif
            @if (strlen($bio->activities)>1)
              <li>
                <strong><a href="#research-activities">{{__('Research Activities')}}</a></strong>
              </li>
            @endif
            @if (count($member_publications) > 0)
              <li>
                <strong><a href="#selected-publications">{{__('Selected Publications')}}</a></strong>
              </li>
            @endif
          </ul>
          <h6>{{__('Publications')}}:</h6>
          <ul>
            @foreach($years as $year)
              <li><strong><a href="#{{$year}}">{{$year}}</a></strong></li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-lg-8 order-lg-1">
        <div class="section-title">
          <h2>{{$member->fullname}}</h2>
          @if ($bio)
            <p>{{$bio->role}}</p>
          @endif
        </div>
        <br>
        <div class="portfolio-description content-align-justify">
          @if ($bio)
            @if (strlen($bio->short)>1)
              <h2 id="short-bio">{{__('Short Bio')}}</h2>
              {!!$bio->short!!}
              <span class="border-separator"></span>
            @endif
            @if (strlen($bio->interests)>1)
              <h2 id="research-interests">{{__('Research Interests')}}</h2>
              {!!$bio->interests!!}
              <span class="border-separator"></span>
            @endif
            @if (strlen($bio->activities)>1)
              <h2 id="research-activities">{{__('Research Activities')}}</h2>
              {!!$bio->activities!!}
              <span class="border-separator"></span>
            @endif
          @endif
          @if (count($member_publications) > 0)
            <h2 id="selected-publications">{{__('Selected Publications')}}</h2>
            <ul>
            @php $year=-1; @endphp
            @foreach($member_publications as $p)
              @if ($p->year != $year)
                @if($year > 0)
                    </ul>
                  </li>
                @endif
                  <li>
                    <h4 id="{{$p->year}}">{{$year = $p->year}}</h4>
                    <ul>
              @endif
                      <li class="publication-item">
                        {!!$p->citation!!}
                      </li>
            @endforeach
                    </ul>
                  </li>
            </ul>
          @endif
        </div>
      </div>

    </div>
  </div>
</section>
