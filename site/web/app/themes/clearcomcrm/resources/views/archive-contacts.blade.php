@extends('layouts.app')

@section('content')
  <div class="w-full p-8 mb-8 bg-gray-900">
    <h1 class="text-3xl font-semibold text-white">Contact List</h1>
  </div>

  

  @php
      $args = array(
        'post_type' => 'contacts',
        'posts_per_page' => -1,
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

  <input
    type="text"
    id="searchInput"
    onkeyup="myFunction()"
    placeholder="Search for names, locations, titles, email, phone, or login."
    title="Type in a name"
    class="w-full p-4 mb-8 border border-yellow-500"
    >

  <table id="userTable" class="w-full table-auto">
    <thead class="bg-yellow-500">
    <tr class="header">
      <th class="p-4 text-left">First Name</th>
      <th class="p-4 text-left">Last Name</th>
      <th class="p-4 text-left">Location</th>
      <th class="p-4 text-left">Title</th>
      <th class="p-4 text-left">Email</th>
      <th class="p-4 text-left">Phone</th>
      <th class="p-4 text-left">Login</th>
      <th class="p-4 text-left">Password</th>
      <th class="p-4 text-left">Forum Access?</th>
    </tr>
    </thead>
    @while($query->have_posts()) @php($query->the_post())
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    @endwhile
  </table>

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