<header class="py-10">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">{!! $title !!}</h1>
        @php 
        $featured_posts = get_field('location');
      @endphp

      @if( $featured_posts )
        @foreach( $featured_posts as $featured_post )

          @php
            $permalink = get_permalink( $featured_post->ID );
            $location = get_the_title( $featured_post->ID );
          @endphp
          
          <span class="block mt-2 text-2xl text-white">
            Location: <a href="{{ $permalink }}">{{ $location }}</a>
          </span>
          
        @endforeach

      @endif
      </div>
       
    </header>