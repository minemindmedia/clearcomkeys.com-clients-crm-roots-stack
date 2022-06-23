@php
  $company = get_field('company');
  $addBilling = get_field('add_billing');
  $location = get_field('location');

  if( have_rows('shipping_address') ):
    while( have_rows('shipping_address') ): the_row(); 

        $s_street = get_sub_field('street_address');
        $s_city = get_sub_field('city');
        $s_state = get_sub_field('state');
        $s_zip = get_sub_field('zip');
        $s_phone = get_sub_field('phone');
        $s_fax = get_sub_field('fax');

    endwhile;
  endif;

    if( have_rows('billing_address') ):
    while( have_rows('billing_address') ): the_row(); 

        $b_street = get_sub_field('street_address');
        $b_city = get_sub_field('city');
        $b_state = get_sub_field('state');
        $b_zip = get_sub_field('zip');
        $b_phone = get_sub_field('phone');
        $b_fax = get_sub_field('fax');

    endwhile;
  endif;

  if( have_rows('website_details') ):
    while( have_rows('website_details') ): the_row(); 

        $login = get_sub_field('login');
        $password = get_sub_field('password');
        $website = get_sub_field('website');

    endwhile;
  endif;


@endphp

<div class="flex flex-wrap space-x-4">
  

<div class="flex-1 overflow-hidden bg-white shadow sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900">Shipping Address</h3>
    <p class="max-w-2xl mt-1 text-sm text-gray-500">
     
    </p>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Address</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $s_street }}</dd>
      </div>
      <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">City, State, Zip</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $s_city }}, {{ $s_state }}, {{ $s_zip }}</dd>
      </div>
      <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Phone</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $s_phone }}</dd>
      </div>
      <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Fax</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $s_fax }}</dd>
      </div>
    </dl>
  </div>
</div>


<div class="flex-1 overflow-hidden bg-white shadow sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900">Billing Address</h3>
    <p class="max-w-2xl mt-1 text-sm text-gray-500">
     
    </p>
  </div>
  @if( $addBilling == '1' )
  <div class="border-t border-gray-200">
    <dl>
      <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Address</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $b_street }}</dd>
      </div>
      <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">City, State, Zip</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $b_city }}, {{ $b_state }}, {{ $b_zip }}</dd>
      </div>
      <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Phone</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $b_phone }}</dd>
      </div>
      <div class="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Fax</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $b_fax }}</dd>
      </div>
    </dl>
  </div>
  @else
  <div class="border-t border-gray-200">
    <dl>
      <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-1 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">Billing address is the same as the shipping address.</dt>
      </div>

    </dl>
  </div>
  @endif
</div>
@include('components.modal-edit-company')
</div>

<div class="flex-1 mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900">Website Details</h3>
    <p class="max-w-2xl mt-1 text-sm text-gray-500">
     
    </p>
  </div>
  <div class="border-t border-gray-200">





        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Website: <span class="text-sm text-gray-900">{{ $website }}</span></dt>
          <dt class="text-sm font-medium text-gray-500">Login: <span class="text-sm text-gray-900">{{ $login }}</span></dt>
        <dt class="text-sm font-medium text-gray-500">Password: <span class="text-sm text-gray-900">{{ $password }}</dt>
        
      </div>



  </div>
</div>
@if ($location)
    <div class="flex-1 mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Location</h3>
            <p class="max-w-2xl mt-1 text-sm text-gray-500">
            </p>
        </div>
        <div class="border-t border-gray-200">
            @foreach ($location as $l)
                @php
                    $permalink = get_permalink($l->ID);
                    $title = get_the_title($l->ID);
                @endphp

                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500"><a href="{{ $permalink }}">{{ $title }}</a></dt>

                </div>
            @endforeach
        </div>
    </div>
@endif
<div class="flex-1 mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900">Notes</h3>
    <p class="max-w-2xl mt-1 text-sm text-gray-500">
     
    </p>
  </div>
  <div class="border-t border-gray-200">




    @if( have_rows('company_notes') )
    @while( have_rows('company_notes') )
    @php
      the_row();
      $note = get_sub_field('note');
      $date = get_sub_field('note_date');
    @endphp

        <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">{{ $note }}</dt>
        <dt class="text-sm font-medium text-gray-500">{{ $date }}</dt>
        
      </div>

    @endwhile
  @endif


  </div>
</div>





