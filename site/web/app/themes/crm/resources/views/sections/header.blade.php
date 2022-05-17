<header class="banner">
<nav class="bg-indigo-600 border-b border-indigo-300 border-opacity-25 lg:border-none">
      <div class="px-2 mx-auto max-w-7xl sm:px-4 lg:px-8">
        <div class="relative flex items-center justify-between h-16 lg:border-b lg:border-indigo-400 lg:border-opacity-25">
          <div class="flex items-center px-2 lg:px-0">
            <div class="flex-shrink-0">
              <img class="block w-8 h-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-300.svg" alt="Workflow">
            </div>
            <div class="hidden lg:block lg:ml-10">
              <div class="flex space-x-4">
                <!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
                <a href="/" class="px-3 py-2 text-sm font-medium text-white bg-indigo-700 rounded-md" aria-current="page"> Dashboard </a>

                <a href="/contacts" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Contacts </a>

                <a href="/recon-centers" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Recon Centers </a>

                <a href="/stores" class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Stores </a>

              </div>
            </div>
          </div>
          <div class="flex justify-center flex-1 px-2 lg:ml-6 lg:justify-end">
            <div class="w-full max-w-lg lg:max-w-xs">
              <label for="search" class="sr-only">Search</label>
              <div class="relative text-gray-400 focus-within:text-gray-600">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <!-- Heroicon name: solid/search -->
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
                </div>
                @include('search')
              </div>
            </div>
          </div>
          <div class="flex lg:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="inline-flex items-center justify-center p-2 text-indigo-200 bg-indigo-600 rounded-md hover:text-white hover:bg-indigo-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <!--
                Heroicon name: outline/menu

                Menu open: "hidden", Menu closed: "block"
              -->
              <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <!--
                Heroicon name: outline/x

                Menu open: "block", Menu closed: "hidden"
              -->
              <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          
        </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="lg:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
          <a href="#" class="block px-3 py-2 text-base font-medium text-white bg-indigo-700 rounded-md" aria-current="page"> Dashboard </a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Team </a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Projects </a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Calendar </a>

          <a href="#" class="block px-3 py-2 text-base font-medium text-white rounded-md hover:bg-indigo-500 hover:bg-opacity-75"> Reports </a>
        </div>
        
      </div>
    </nav>
</header>
