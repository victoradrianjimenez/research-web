@include('arsha.layouts.utils')
<section id="team" class="team section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Team')}}</h2>
      <p>{{__('People Working at :name', ['name'=>$config->short_name])}}</p>
    </div>

    <div class="row">
      @foreach($members as $m)
      @php
        $bio = $m->bios()->where('lang','=',$config->lang)->first();
        if (!$bio) $bio = $m->bios()->first();
      @endphp
      <div class="col-lg-6 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic">
              <img src="{{asset('storage/'.$m->photo)}}" class="img-fluid" alt="Photo">
            </div>
            <div class="member-info">
              <a href="{{route('member',$m->url)}}">
                <h4>{{$m->fullname}}</h4>
                <span><strong>{{__('app.'.$m->type)}}</strong></span>
                <p>
                  {{$bio->role}}
                </p>
              </a>
              <div class="social">
                @foreach($m->socials as $s)
                  @if(strlen($s->link) > 1)
                    <a href="{{$s->link}}" title="{{$s->text}}" target="_blank">
                      <i class="{{getSocialIconClass($s->name)}}"></i>
                    </a>
                  @endif
                @endforeach
              </div>
            </div>
        </div>
      </div>
      @endforeach
    </div>
    
  </div>
</section>