@php 
  $description = $new->descriptions()->where('lang','=',$config->lang)->first();
  if(!$description) $description = $new->descriptions()->first();
@endphp
<section id="portfolio-details" class="portfolio-details">
  <div class="container aos-init aos-animate" data-aos="fade-up">
    <div class="row gy-4">

      <div class="col-lg-4 order-lg-2">
        <div class="portfolio-info box-featured">
          <h3>{{__('Categories')}}</h3>
          <ul class="categories">
          @foreach($classes as $c)
            <li class="{{($c->name == $category)?'selected':''}}">
              <strong>
                <a href="{{route('news_category',$c->name)}}">
                @if($c->name == $category)
                  <i class="bi bi-arrow-right"></i>
                @endif {{$c->text}}
                </a>
              </strong>
            </li>
          @endforeach
          </ul>
        </div>
        <br>
        <div class="portfolio-info box-featured">
          <h3>{{__('Search')}}</h3>
          <div class="search-box">
            <form action="http://google.com/search" method="get" class="form-search">
              <fieldset role="search">
                <input type="hidden" name="q" value="site:{{url('')}}">
                <input class="input-medium" type="text" name="q" results="0" placeholder="">
                <input type="submit" value="{{__('Search')}}">
              </fieldset>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8 order-lg-1">
        <div class="section-title">
          <h2>{{$description->title}}</h2>
          <p>{{$new->time}}</p>
        </div>        
        <div class="portfolio-description content-align-justify">
          {!!$description->text!!}
        </div>
      </div>

    </div>
  </div>
</section>