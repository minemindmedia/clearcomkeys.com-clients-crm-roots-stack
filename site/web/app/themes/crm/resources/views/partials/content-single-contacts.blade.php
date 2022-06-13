@php
    $contact = get_field('contact_details');
    $details = get_field('forum_access');
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
                    @if( have_rows('location_relationship') )
                      @while( have_rows('location_relationship') )
                        @php the_row();
                          $assign = get_sub_field('assign_location');
                        @endphp
                        @if ( $assign == 1 )
                          @php
                            $location = get_sub_field('location');
                          @endphp
                          @if( $location )
                              @foreach( $location as $l )
                                @php
                                  $permalink = get_permalink( $l->ID );
                                  $title = get_the_title( $l->ID );
                                @endphp
                                <a href="{{ $permalink }}">
                                  {{ $title }}
                                </a>
                              @endforeach
                          @else 
                            <p>No location has been selected.</p>
                          @endif
                        @endif
                      @endwhile
                    @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Company</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( have_rows('company_relationship') )
                      @while( have_rows('company_relationship') )
                        @php the_row();
                          $assign = get_sub_field('assign_company');
                        @endphp
                        @if ( $assign == 1 )
                          @php
                            $company = get_sub_field('company');
                          @endphp
                          @if( $company )
                              @foreach( $company as $c )
                                @php
                                  $permalink = get_permalink( $c->ID );
                                  $title = get_the_title( $c->ID );
                                @endphp
                                <a href="{{ $permalink }}">
                                  {{ $title }}
                                </a>
                              @endforeach
                          @else 
                            <p>No company assigned.</p>
                          @endif
                        @endif
                      @endwhile
                    @endif
                  </dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Title</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    @if( $contact['position_title'] )
                      {{ $contact['position_title'] }}
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
                    @if( have_rows('contact_details') )
                      @while( have_rows('contact_details') )
                        @php
                          the_row();
                        @endphp

                        @if( have_rows('phone_numbers') )
                        <ul>
                          @while( have_rows('phone_numbers') )
                            @php
                              the_row();
                              $phone = get_sub_field('phone');
                              $type = get_sub_field('phone_type');
                            @endphp
                            <li>
                              {{ $type }}: {{ $phone->national }}
                            </li>
                          @endwhile
                        </ul>
                        @endif
                      @endwhile
                    @endif
                  </dd>
                </div>
              </dl>
            </div>
            <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
                

                    @if( have_rows('access_details') )
                      @while( have_rows('access_details') )
                        @php the_row();
                          $access = get_sub_field('forum_access');
                        @endphp
                        @if ( $access == 1 )
                          @php
                            $login = get_sub_field('login');
                            $password = get_sub_field('password');
                          @endphp
                          <div class="sm:col-span-1">
                            <dt class="text-lg font-medium leading-6 text-gray-900">Forum Access</dt>
                          </div>
                          <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Login</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $login }}
                            </dd>
                          </div>
                          <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Password</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                              {{ $password }}
                            </dd>
                          </div>
                        @endif
                      @endwhile
                    @endif

                    
                  
                
                
              </dl>
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
                        $time = get_sub_field('training_time');
                        $note = get_sub_field('training_note');
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
                          <div>
                            <p class="text-sm text-gray-500">{{ $time }}</p>
                          </div>
                        </div>
                        
                      </div>
                      <p class="mt-2 text-sm text-gray-500">{{ $note }}</p>
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