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
          <h2>{{__('News & Events')}}</h2>
        </div>
        
        <div class="portfolio-description content-align-justify">
          @foreach($news as $n)
            @php 
              $description = $n->descriptions()->where('lang','=',$config->lang)->first();
              if(!$description) $description = $n->descriptions()->first();
              $news_classes = [];
              foreach(explode('|',$n->class) as $nc)
                foreach($classes as $c)
                  if ($c->name == $nc)
                    array_push($news_classes, $c->text);
            @endphp
            <h4>{{$description->title}}</h4>
            <div class="news-metadata">
              <span class="metadata-item">
                <i class="bi bi-calendar3"></i> {{date("d/m/Y",strtotime($n->date))}}
              </span>
              <span class="metadata-item">
                <i class="bi bi-person"></i> {{$n->author}}
              </span>
              <span class="metadata-item">
                <i class="bi bi-folder"></i> {{implode(', ',$news_classes)}}
              </span>
            </div>
            <div>{{$description->short}}</div>
            <div class="about">
              <div class="content">
                <a href="{{route('news').date('/Y/m/d/',strtotime($n->date)).$n->url}}" class="btn-learn-more">{{__('Read On')}}</a>
              </div>
            </div>
            <br>
          @endforeach
        </div>
        {{ $news->links('arsha.layouts.pagination') }}
      </div>

    </div>
  </div>
</section>