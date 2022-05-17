{{--
  Template Name: Recon Centers
--}}


@extends('layouts.app')

@section('content')

<div class="flex max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
  <div class="flex-1">
    @include('partials.page-header-recon-center')
    @include('search')
  </div>
</div>

  

@endsection