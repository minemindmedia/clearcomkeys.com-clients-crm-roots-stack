@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @php
      $args = array(
        'post_type' => 'contacts',
        'orderby' => 'meta_value',
        'order' => 'DESC'
      );

$query = new WP_query ( $args );
  @endphp


  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  @while($query->have_posts()) @php($query->the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection