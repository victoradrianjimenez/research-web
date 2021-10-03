<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <id>{{ url('/atom.xml') }}</id>
  <title><![CDATA[{{$config->name}}]]></title>
  <link href="{{url('atom.xml')}}" rel="self"/>
  <link href="{{url('')}}"/>
  <description></description>
  <language></language>
  <updated>{{date(DATE_ATOM, strtotime($news->first()->date))}}</updated>
  <id>http://www.gitia.org/</id>
  <author>
    <name><![CDATA[GITIA]]></name>
    <email><![CDATA[info@gitia.org]]></email>
  </author>
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
    <entry>
      <title type="html"><![CDATA[{{$description->title}}]]></title>
      <link href="{{route('news').date('/Y/m/d/',strtotime($n->date)).$n->url}}"/>
      <id>{{route('news').date('/Y/m/d/',strtotime($n->date)).$n->url}}</id>
      <author>
        <name><![CDATA[{{$n->author}}]]></name>
      </author>
      <summary type="html">
        <![CDATA[{{$description->short}}]]>
      </summary>
      <category type="html">
        <![CDATA[{{implode(', ',$news_classes)}}]]>
      </category>
      <updated>{{date(DATE_ATOM, strtotime($n->date))}}</updated>
      <content type="html"><![CDATA[{!!$description->text!!}]]></content>
    </entry>
  @endforeach
</feed>
