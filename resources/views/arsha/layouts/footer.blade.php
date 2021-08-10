<footer id="footer">

  <div class="footer-top section-bg" style="background: #DBE3F0;">
    <div class="container content-align-justify">
      <div class="row">

        <div class="col-lg-4 col-md-6 footer-links">
          <h3>{{__('Latest News')}}</h3>
          <ul>
            @foreach($latest_news as $n)
            @php 
            $d = $n->descriptions()->where('lang','=','en')->first();
            if (!$d) $d = $n->descriptions()->first();
            @endphp
            <li>
              <i class="bx bx-chevron-right"></i> 
              <a href="{{route('news').'/'.str_replace(['-'],'/',$n->date).'/'.$n->url}}">{{$d->title}}</a>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h3>{{$footer_work->title}}</h3>
          <p>{!!$footer_work->text!!}</p>
          @if ($footer_work->link)
          <div class="mt-3">
            <a href="{{$footer_work->link}}">{{__('Available Projects')}}</a>
          </div>
          @endif
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h3>{{$footer_about->title}}</h3>
          <p>{!!$footer_about->text!!}</p>
          <div class="social-links mt-3">
            <a href="{{$config->linkedin}}" class="linkedin" title="Linkedin">
              <i class="ri-linkedin-fill"></i>
            </a>
            <a href="{{$config->researchgate}}" class="linkedin" title="Researchgate">
              <i class="ri-global-line"></i>
            </a>
            <a href="{{asset('storage/'.$config->brochure)}}" class="linkedin" title="Brochure">
              <i class="ri-file-pdf-line"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container footer-bottom clearfix">
    <div class="copyright">
      &copy; Copyright {!!$config->copyright!!}. {{__('All Rights Reserved')}}
    </div>
    <div class="credits">
      {!!$config->footer!!}
    </div>
  </div>
</footer>