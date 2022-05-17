<div class="relative pb-32 overflow-hidden bg-sky-700">
    <!-- Menu open: "bg-sky-900", Menu closed: "bg-transparent" -->
    <nav class="relative z-10 bg-transparent border-b border-teal-500 border-opacity-25 lg:bg-transparent lg:border-none">
      <div class="px-2 mx-auto max-w-7xl sm:px-4 lg:px-8">
        <div class="relative flex items-center justify-between h-16 lg:border-b lg:border-sky-800">
          <div class="flex items-center px-2 lg:px-0">
            <div class="flex-shrink-0">
              <img class="block w-auto h-8" src="@asset("images/cclogo-white.png")" alt="ClearCom Technologies">
            </div>
            <div class="hidden lg:block lg:ml-6 lg:space-x-4">
              <div class="flex">
                <!-- Current: "bg-black bg-opacity-25", Default: "hover:bg-sky-800" -->
                <a href="/" class="px-3 py-2 text-sm font-medium text-white rounded-md @if(is_page('/')) bg-black bg-opacity-25 @endif">Dashboard</a>

                <a href="/contacts" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-sky-800">Contacts</a>

                <a href="/recon-centers" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-sky-800">Recon Centers</a>

                <a href="/stores" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-sky-800">Stores</a>
              </div>
            </div>
          </div>
          <div class="flex justify-center flex-1 lg:ml-6 lg:justify-end">
            <div class="w-full max-w-lg lg:max-w-xs">
              <label for="search" class="sr-only">Search</label>
              <div class="relative text-sky-100 focus-within:text-gray-400">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <!-- Heroicon name: solid/search -->
                  <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
                </div>
                @include('search')
              </div>
            </div>
          </div>
          
          
        </div>
      </div>
    </nav>
    <div aria-hidden="true" class="absolute inset-x-0 inset-y-0 w-full overflow-hidden transform -translate-x-1/2 left-1/2 lg:inset-y-0">
      <div class="absolute inset-0 flex">
        <div class="w-1/2 h-full" style="background-color: #0a527b"></div>
        <div class="w-1/2 h-full" style="background-color: #065d8c"></div>
      </div>
      <div class="relative flex justify-center">
        <svg class="flex-shrink-0" width="1750" height="308" viewBox="0 0 1750 308" xmlns="http://www.w3.org/2000/svg">
          <path d="M284.161 308H1465.84L875.001 182.413 284.161 308z" fill="#0369a1" />
          <path d="M1465.84 308L16.816 0H1750v308h-284.16z" fill="#065d8c" />
          <path d="M1733.19 0L284.161 308H0V0h1733.19z" fill="#0a527b" />
          <path d="M875.001 182.413L1733.19 0H16.816l858.185 182.413z" fill="#0a4f76" />
        </svg>
      </div>
    </div>
    <header class="relative py-10">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">{{ get_the_title() }}</h1>
      </div>
    </header>
  </div>