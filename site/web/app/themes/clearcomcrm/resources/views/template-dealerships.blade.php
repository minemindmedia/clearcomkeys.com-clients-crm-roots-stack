{{--
  Template Name: Dealerships
--}}


@extends('layouts.app')

@section('content')
  

  @php
      $term_query = new WP_Term_Query( array( 
          'taxonomy' => 'dealership', // <-- Custom Taxonomy name..
          'orderby'                => 'name',
          'order'                  => 'ASC',
          'child_of'               => 0,
          'parent' => 0,
          'fields'                 => 'all',
          'hide_empty'             => false,
          ) );
  @endphp


  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  

  <div class="px-4 sm:px-6 lg:px-8" id="userTable">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Dealerships</h1>
      <p class="mt-2 text-sm text-gray-700">Filter by any column in the search input below. Click view / edit to view more information about the user and make any changes.</p>
    </div>
    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
      @include('components.modal-new-dealership')
    </div>
  </div>
  <div class="sm:flex sm:items-center">
  <input
    type="text"
    id="searchInput"
    onkeyup="myFunction()"
    placeholder="Search for dealership."
    title="Type in a name"
    class="w-full p-4 mt-8 mb-8 border border-indigo-600"
    autofocus
    >
  </div>
  <div class="flex flex-col">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Dealership Name</th>
              
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              
               
              
              @if ( ! empty( $term_query->terms ) )
                
                @foreach ( $term_query ->terms as $term )

                  @include('partials.content-dealerships')
                  
                @endforeach

                @else
                
                <p>No dealerships found</p>/
            
              @endif

              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

  <script>
      function myFunction() {
  var input, filter, table, tr, td, cell, i, j;
  filter = document.getElementById("searchInput").value.toLowerCase();
  table = document.getElementById("userTable");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
    const tdArray = tr[i].getElementsByTagName("td");
    for (var j = 0; j < tdArray.length; j++) {
      const cellValue = tdArray[j];
      if (cellValue && cellValue.innerHTML.toLowerCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        break;
      }
    }
  }
}
  </script>
@endsection