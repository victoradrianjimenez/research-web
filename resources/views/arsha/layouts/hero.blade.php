<section id="hero" class="d-flex align-items-center" style="background-image:url('{{asset("storage/".$config->wallpaper)}}');background-size: cover;height: initial;">

  <div class="container">
    <div class="row">
      <div class="col-lg-9 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>{{$config->name}}</h1>
        <h2 style="margin-bottom:0;">{{$config->institution}}</h2>
      </div>
      <div class="col-lg-3 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="{{asset('storage/'.$config->logo_color_small)}}" class="img-fluid animated" style="height: 250px; width: initial;">
      </div>
    </div>
  </div>

</section>