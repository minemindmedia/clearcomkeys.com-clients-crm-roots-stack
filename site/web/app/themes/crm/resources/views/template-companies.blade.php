{{--
  Template Name: Companies
--}}


@extends('layouts.app')

@section('content')
  

  @php
      $term_query = new WP_Term_Query( array( 
          'taxonomy' => 'company', // <-- Custom Taxonomy name..
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
        <p class="mt-2 text-sm text-gray-700">A list of all companies.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        @include('components.modal-new-company')
      </div>
    </div>
  
  <div class="flex flex-col mt-8">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          @if ( ! empty( $term_query->terms ) )
          <table class="min-w-full divide-y divide-gray-300" id="filterTable">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Company</th>
              
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              
               
              
              
                
                @foreach ( $term_query ->terms as $term )

                  @include('partials.content-company')
                  
                @endforeach

                @else
                
                
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="p-12 text-center">
              <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No Companies</h3>
              <p class="mt-1 text-sm text-gray-500">Get started by adding a company and then adding contacts.</p>
              <div class="mt-6">
                @include('components.modal-new-company')
              </div>
            </div>

            
              

              
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection