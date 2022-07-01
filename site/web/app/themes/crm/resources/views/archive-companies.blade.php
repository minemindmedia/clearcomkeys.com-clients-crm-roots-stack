@extends('layouts.app')

@section('content')
  

@php
  $args = array(
    'post_type' => 'companies',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'order' => 'DESC'
  );

  $query = new WP_query ( $args );
@endphp

  <div class="px-4">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-3xl font-bold text-indigo-600">All Companies</h1>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        @include('components.modal-new-company')
      </div>
    </div>
    <div class="flex flex-col mt-8">
      
        <div class="inline-block min-w-full py-2 align-middle">
          <div class="shadow-sm ring-1 ring-black ring-opacity-5">
            @if( $query->have_posts() )
            <table class="min-w-full border-separate" style="border-spacing: 0" id="filterTable">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="sticky top-0 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Company</th>
                  <th scope="col" class="sticky top-0 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Location</th>
                  <th scope="col" class="sticky top-0 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Phone</th>
                  <th scope="col" class="sticky top-0 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                @while($query->have_posts()) @php($query->the_post())
                  @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
                @endwhile
              </tbody>
            </table>

            @else 

                        <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="p-12 text-center">
              <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No companies</h3>
              <p class="mt-1 text-sm text-gray-500">???</p>
            </div>

            @endif
          </div>
        </div>
      
    </div>
  </div>

@endsection
