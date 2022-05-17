@php
    $contact = get_field('contact_details');
    $details = get_field('access_details');
@endphp

<div class="min-h-full">
  
  <main class="py-10">
    <!-- Page header -->
    <div class="max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
      <div class="flex items-center space-x-5">
        <div class="flex-shrink-0">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-20 h-20" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
            </svg>
            <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
          </div>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-900">
            @if( $contact['first_name'] )
              {{ $contact['first_name'] }}
            @endif
            @if( $contact['last_name'] )
              <a href="{{ get_permalink() }}">
                {{ $contact['last_name'] }}
              </a>
            @endif
          </h1>
          <p class="text-sm font-medium text-gray-500">Added on <time><?php echo get_the_date('F j, Y, g:i a'); ?></time> by {{ get_the_author() }}.</p>
          <p class="text-sm font-medium text-gray-500">Last modified on <time><?php echo get_the_modified_date('F j, Y, g:i a'); ?></time> by {{ get_the_modified_author() }}.</p>
        </div>
      </div>
      <div class="flex flex-col-reverse mt-6 space-y-4 space-y-reverse justify-stretch sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
       @include('components.modal-edit-contact')
      </div>
    </div>

    <div class="grid max-w-3xl grid-cols-1 gap-6 mx-auto mt-8 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
      <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Description list-->
        <section aria-labelledby="applicant-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Contact Information</h2>
              <p class="max-w-2xl mt-1 text-sm text-gray-500">Personal details and information.</p>
            </div>
            <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Location</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                      @if( get_field('recon_center_store') == 'Recon Center' )
                        Recon Center = <?php the_field('recon_center_location'); ?>
                      @elseif( get_field('recon_center_store') == 'Store' )
                        Store = <?php the_field('store_location'); ?>
                      @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Title</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( get_field('recon_center_store') == 'Recon Center' )
                      <?php the_field('contact_type_recon_center') ?>
                      @elseif( get_field('recon_center_store') == 'Store' )
                      <?php the_field('contact_type_store') ?>
                    @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Email</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( $contact['email'] )
                      {{ $contact['email'] }}
                    @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Phone</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( $contact['phone'] )
                      {{ $contact['phone'] }}
                    @endif
                  </dd>
                </div>
              </dl>
            </div>
            <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Login</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                      @if( $details )
                        {{ $details['login'] }}
                      @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Password</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( $details )
                      {{ $details['password'] }}
                    @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Forum access?</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( $details )
                      @if( $details['forum_access'])
                        Yes
                      @else
                        No
                      @endif
                    @endif
                  </dd>
                </div>
                
              </dl>
            </div>
          </div>
        </section>

        <!-- Comments-->
        <section aria-labelledby="notes-title">
          <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden">
            <div class="divide-y divide-gray-200">
              <div class="px-4 py-5 sm:px-6">
                <h2 id="notes-title" class="text-lg font-medium text-gray-900">Notes</h2>
              </div>
              <div class="px-4 py-6 sm:px-6">

                @if( have_rows('notes') )
                  <div class="flow-root mt-6">
                    <ul role="list" class="space-y-8">
                        
                        @while( have_rows('notes') )
                          
                          @php
                            the_row();
                            $note = get_sub_field('note');
                            $date = get_sub_field('note_date');
                          @endphp
                          <li>
                        <div class="flex space-x-3">
                          <div>
                            <div class="mt-1 text-sm text-gray-700">
                              <p>{{ $note }}
                            </div>
                            <div class="mt-2 space-x-2 text-sm">
                              <span class="font-medium text-gray-500">
                                {{ $date }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </li>
                        @endwhile
                    </ul>
                  </div>
                @endif

              </div>
            </div>
            
          </div>
        </section>
      </div>

      <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
        <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:px-6">
          <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Training Dates</h2>
							
            @if( have_rows('training_dates') )
              <div class="flow-root mt-6">
                <ul role="list" class="-mb-8">
                    
                    @while( have_rows('training_dates') )
                      
                      @php
                        the_row();
                        $date = get_sub_field('training_date');
                        $date2 = date("F dS Y", strtotime($date));
                      @endphp
                      <li>
                    <div class="relative pb-8">
                      <div class="relative flex space-x-3">
                        
                          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 text-black" viewBox="0 0 16 16">
                              <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                              <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                      
                        <div class="flex justify-between flex-1 min-w-0 space-x-4">
                          <div>
                            <p class="text-sm text-gray-500">{{ $date2 }}</p>
                          </div>
                        
                        </div>
                      </div>
                    </div>
                  </li>
                    @endwhile
                </ul>
              </div>
            @endif
      
        </div>
      </section>

      
    </div>
  </main>
</div>