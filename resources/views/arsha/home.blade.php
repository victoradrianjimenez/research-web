@extends('arsha.layouts.app')

@section('content')

@include('arsha.layouts.hero')
<main id="main">
  @include('arsha.section', ['url'=>'about', 'parity' => 'even'])
  @include('arsha.section', ['url'=>'research', 'parity' => 'odd'])
  @include('arsha.members')
  @include('arsha.contact')
</main>
@endsection
