{{--
  Template Name: Locations
--}}


@extends('layouts.app')

@section('content')
  

  @php
      $term_query = new WP_Term_Query( array( 
          'taxonomy' => 'location', // <-- Custom Taxonomy name..
          'orderby'                => 'name',
          'order'                  => 'ASC',
          'child_of'               => 0,
          'parent' => 0,
          'fields'                 => 'all',
          'hide_empty'             => false,
          ) );
  @endphp
  

  <div class="px-4 sm:px-6 lg:px-8" id="">
  <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-700">A list of all locations.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        @include('components.modal-new-location')
      </div>
    </div>
  
  <div class="flex flex-col mt-8">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300" id="filterTable">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Location</th>
              
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              
               
              
              @if ( ! empty( $term_query->terms ) )
                
                @foreach ( $term_query ->terms as $term )

                  @include('partials.content-location')
                  
                @endforeach

                @else
                
                <p>No locations found</p>
            
              @endif

              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection