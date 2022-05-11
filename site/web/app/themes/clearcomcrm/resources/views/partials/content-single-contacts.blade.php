@php
    $contact = get_field('contact_details');
    $details = get_field('additional_details');
@endphp

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="overflow-hidden bg-white shadow sm:rounded-lg">
  <div class="flex px-4 py-5 sm:px-6">
    <div class="flex-1">
      <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Information</h3>
      <p class="max-w-2xl mt-1 text-sm text-gray-500">User details are below. View user for additional information.</p>
    </div>
    
      
   <div class="flex flex-wrap">
       
      
      @include('components.modal-edit-contact')
   </div>
    
   
  </div>
  <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
      <div class="sm:col-span-1">
        <dt class="text-sm font-medium text-gray-500">Full name</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( $contact['first_name'] )
            {{ $contact['first_name'] }}
          @endif
                @if( $contact['last_name'] )
            <a href="{{ get_permalink() }}">
              {{ $contact['last_name'] }}
            </a>
          @endif
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-sm font-medium text-gray-500">Location</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( get_field('dealer_store') == 'Dealership' )
            Dealership = <?php the_field('dealership_location'); ?>
          @elseif( get_field('dealer_store') == 'Store' )
            Store = <?php the_field('store_location'); ?>
          @endif
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-sm font-medium text-gray-500">Title</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( get_field('dealer_store') == 'Dealership' )
            <?php the_field('contact_type_dealership') ?>
            @elseif( get_field('dealer_store') == 'Store' )
            <?php the_field('contact_type_store') ?>
          @endif
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-sm font-medium text-gray-500">Email address</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( $contact['email'] )
            {{ $contact['email'] }}
          @endif
        </dd>
      </div>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Phone</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( $contact['phone'] )
            {{ $contact['phone'] }}
          @endif
        </dd>
      </div>
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
        <dt class="text-sm font-medium text-gray-500">Forum Access?</dt>
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
      <div class="sm:col-span-3">
        <dt class="text-sm font-medium text-gray-500">Additional Notes</dt>
        <dd class="mt-1 text-sm text-gray-900">
          @if( $contact )
            {{ $contact['notes'] }}
          @endif
        </dd>
      </div>
      <div class="sm:col-span-2">
        <dt class="text-sm font-medium text-gray-500">Training Dates</dt>
        <dd class="mt-1 text-sm text-gray-900">
         
          
				  @if( have_rows('additional_details') )
					
			
					@while( have_rows('additional_details') )
            @php the_row() @endphp
						<div>
							
							@if( have_rows('training_dates') )
								<ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
								

								
								@while( have_rows('training_dates') )
                  
                  @php
                    the_row();
                    $date = get_sub_field('training_date');
                    $date2 = date("F dS Y @ h:i:s A", strtotime($date));
                  @endphp
                  <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                    <div class="flex items-center flex-1 w-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                       <span class="flex-1 w-0 ml-2 truncate">{{ $date2 }}</span>
									    
                    </div>
                  </li>
								@endwhile
								</ul>
							@endif
						</div>	

					@endwhile
					
				@endif

			


      
          
        </dd>
      </div>
    </dl>
  </div>
</div>
