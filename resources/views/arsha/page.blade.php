@extends('arsha.layouts.app')

@section('content')

@include('arsha.layouts.head')
<main id="main">
  @include('arsha.'.$page)
</main>
@endsection