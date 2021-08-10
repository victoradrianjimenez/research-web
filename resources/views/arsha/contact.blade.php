<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Contact :name', ['name'=>$config->short_name])}}</h2>
    </div>

    <div class="row">
      <div class="col-lg-5 d-flex align-items-stretch">
        <div class="info">
          <div class="address">
            <i class="bi bi-geo-alt"></i>
            <h4>{{__('Location')}}:</h4>
            <p>{!!str_replace(["\n"],'<br>',$config->address)!!}</p>
          </div>
          <div class="email">
            <i class="bi bi-envelope"></i>
            <h4>{{__('Email')}}:</h4>
            <p><a href="mailto:{{$config->email}}">{{$config->email}}</a></p>
          </div>
          <div class="phone">
            <i class="bi bi-phone"></i>
            <h4>{{__('Call')}}:</h4>
            <p>{{$config->phone}}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
        {!!$config->map_iframe!!}
      </div>
    </div>

  </div>
</section>