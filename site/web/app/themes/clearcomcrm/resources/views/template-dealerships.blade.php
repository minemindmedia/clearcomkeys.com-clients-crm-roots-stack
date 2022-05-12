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
  <div class="flex-1 flex justify-center lg:ml-6 lg:justify-end mb-8 mt-8">
    <div class="max-w-lg w-full lg:max-w-xs">
      <label for="search" class="sr-only">Search</label>
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <!-- Heroicon name: solid/search -->
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
        </div>
        
        <input
          type="text"
          id="searchInput"
          onkeyup="myFunction()"
          placeholder="Search..."
          title="Type in a name"
          class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-gray-300 focus:ring-white focus:text-gray-900 sm:text-sm"
          autofocus
        >
      </div>
    </div>
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