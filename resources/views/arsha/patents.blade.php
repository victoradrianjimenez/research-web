<section id="why-us" class="why-us section-bg">
  <div class="container-fluid" data-aos="fade-up">

    <div class="section-title">
      <h2>{{__('Patents')}}</h2>
    </div>

    <div class="accordion-list content-align-justify">
      <ul>
        @foreach($patents as $p)
          @php 
            $patent = $p->parse_string($p->bibtex); 
          @endphp
          @if (isset($patent['year']) && isset($patent['title']))
          <li>
            <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#accordion-list-{{$p->id}}">
              <span>{{$patent['year']}}</span> {{$patent['title']}}
              <i class="bx bx-chevron-down icon-show"></i>
              <i class="bx bx-chevron-up icon-close"></i>
            </a>
            <div id="accordion-list-{{$p->id}}" class="collapse show">
              <ul>
                <li class="publication-item">
                  <p>
                    {{(isset($patent['abstract']))?str_replace(array("\\"), "", $patent['abstract']):''}}
                  </p>
                  @if (isset($patent['author']))
                    <p><strong>{{__('Inventors')}}</strong>: {{implode('; ', $patent['author'])}}</p>
                  @endif
                  @if (isset($patent['assignee']))
                    <p><strong>{{__('Current Assignee')}}</strong>: {{$patent['assignee']}}</p>
                  @endif
                  @if (isset($patent['number']))
                    <p><strong>{{__('Application Number')}}</strong>: {{$patent['number']}}</p>
                  @endif
                  @if (isset($patent['year']))
                    <p><strong>{{__('Priority Date')}}</strong>: 
                      @if (isset($patent['month']))
                        {{date('m',strtotime($patent['month'])).'/'.$patent['year']}}
                      @else
                        {{$patent['year']}}
                      @endif
                    </p>
                  @endif
                  @if (isset($patent['nationality']))
                    <p><strong>{{__('Nationality')}}</strong>: {{$patent['nationality']}}</p>
                  @endif
                  @if($p->members()->count())
                    <p><strong>{{__('Members')}}</strong>: 
                      <ul>
                      @foreach($p->members as $m)
                        <li><a href="{{route('member', $m->url)}}">{{$m->fullname}}</a></li>
                      @endforeach
                      </ul>
                    </p>
                  @endif
                  <div class="about">
                    <div class="content" style="padding:0; margin-top: 15px">
                      <a class="btn-learn-more" data-toggle="modal" data-target="#modal_bibtex_{{$p->id}}">{{__('BibTex')}}</a>
                      @if(isset($patent['url']))
                        <a href="{{$patent['url']}}" class="btn-learn-more" target="_blank">{{__('Link')}}</a>
                      @endif
                      @if($p->file)
                        <a href="{{asset('storage/'.$p->file)}}" target="_blank" class="btn-learn-more">{{__('File')}}</a>
                      @endif
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          @endif
          @include('arsha.layouts.modal_bibtex', ['bibtex' => $p->bibtex, 'id' => $p->id])
        @endforeach
      </ul>
    </div>

  </div>
</section>