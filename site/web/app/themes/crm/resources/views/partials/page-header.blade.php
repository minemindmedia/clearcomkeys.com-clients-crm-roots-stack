@if (is_front_page())
<header class="py-10">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white">Dashboard</h1>
  </div>
   
</header>
@else
<header class="py-10">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white">
      @if( is_singular('locations'))
      Location: <span class="font-normal">{!! $title !!}</span>
      @elseif( is_singular('companies'))
      Company: <span class="font-normal">{!! $title !!}</span>
      @elseif( is_singular('contacts'))
      Contact: <span class="font-normal">{!! $title !!}</span>
      @endif
    </h1>
    @php 
      $featured_posts = get_field('location');
    @endphp
  </div>
   
</header>
@endif