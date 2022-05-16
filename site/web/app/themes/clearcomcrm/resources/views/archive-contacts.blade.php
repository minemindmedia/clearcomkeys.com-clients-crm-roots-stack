@extends('layouts.app')

@section('content')

  @php
      $args = array(
        'post_type' => 'contacts',
        'posts_per_page' => -1,
        'orderby' => 'meta_value',
        'order' => 'DESC'
      );

      $query = new WP_query ( $args );
  @endphp

  
<div class="flex min-h-full">
  

  
  <div class="flex flex-col flex-1 w-0 mx-auto">
    <div class="sticky top-0 z-10 flex flex-shrink-0 h-16 bg-white border-b border-gray-200">
      <div class="flex justify-between flex-1 px-4">
        <div class="flex flex-1">
          <form class="flex w-full lg:ml-0" action="#" method="GET">
            <label for="search-field" class="sr-only">Search</label>
            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
              <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                <!-- Heroicon name: solid/search -->
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </div>
              <input
                type="text"
                id="searchInput"
                onkeyup="myFunction()"
                placeholder="Search..."
                title="Type in a name"
                class="block w-full h-full py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 border-transparent focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                autofocus
              >
            </div>
          </form>
        </div>
        <div class="flex items-center ml-4 lg:ml-6">
          @include('components.modal-new-contact')
        </div>
      </div>
    </div>

    <main>
      <div class="py-8 xl:py-10">
        <div class="">

          <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-300" id="userTable">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Last Name</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">First Name</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Location</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      
                      @while($query->have_posts()) @php($query->the_post())
                        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
                      @endwhile
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
                  
        </div>
      </div>
    </main>
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