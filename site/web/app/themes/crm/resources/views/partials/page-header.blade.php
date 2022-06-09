<header class="py-10">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">{!! $title !!}</h1>
        @php 
          $featured_posts = get_field('location');
        @endphp
      </div>
       
</header>