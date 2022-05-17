<a class="sr-only focus:not-sr-only" href="#main">
  {{ __('Skip to content') }}
</a>

@include('sections.header')

<div class="min-h-full">
  <div class="pb-32 bg-indigo-600">
    @include('partials.page-header')
  </div>
  <main class="-mt-32">
    <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="px-5 py-6 bg-gray-100 rounded-lg shadow sm:px-6">
          @yield('content')
      </div>
    </div>
  </main>
</div>


@include('sections.footer')