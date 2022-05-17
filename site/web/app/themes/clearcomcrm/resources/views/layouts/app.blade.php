<div>
@include('sections.header')

  <main class="relative -mt-32">
    <div class="max-w-screen-xl px-4 pb-6 mx-auto sm:px-6 lg:pb-16 lg:px-8">
      <div class="pt-8 overflow-hidden bg-gray-200 rounded-lg shadow">
        @yield('content')
      </div>
    </div>
  </main>
</div>
