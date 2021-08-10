<section id="why-us" class="why-us section-bg">
  <div class="container-fluid" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Publication')}}</h2>
    </div>

    <div class="accordion-list content-align-justify">
      <ul>
          @php 
            $p=$publication->parse_string($publication->bibtex);
          @endphp
          <li>
            <strong><span>{{$publication->year}}</span> {!!$publication->citation!!}</strong>
            <div class="collapse show" data-bs-parent=".accordion-list">
              <ul>
                <li class="publication-item">
                  <p><strong>{{__('Type')}}</strong>: {{__('app.'.$publication->type)}}</p>
                  @if($publication->members()->count())
                    <p><strong>{{__('Members')}}</strong>: 
                      <ul>
                      @foreach($publication->members as $m)
                        <li><a href="{{route('member', $m->url)}}">{{$m->fullname}}</a></li>
                      @endforeach
                      </ul>
                    </p>
                  @endif
                  @if(isset($p['abstract']))
                    <p>
                      <strong>{{__('Abstract')}}</strong>: {{str_replace(array("\\"), "", $p['abstract'])}}
                    </p>
                  @endif
                  <div class="about">
                    <div class="content" style="padding:0; margin-top: 15px">
                      <a class="btn-learn-more" data-toggle="modal" data-target="#modal_bibtex">
                        {{__('BibTex')}}
                      </a>
                      @if(isset($p['url']))
                        <a href="{{$p['url']}}" class="btn-learn-more" target="_blank">{{__('Link')}}</a>
                      @endif
                      @if($publication->file)
                        <a href="{{asset('storage/'.$publication->file)}}" target="_blank" class="btn-learn-more">
                          {{__('File')}}
                        </a>
                      @endif
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </li>
      </ul>
    </div>

  </div>
</section>
@include('arsha.layouts.modal_bibtex', ['bibtex' => $publication->bibtex, 'id'=> $publication->id])