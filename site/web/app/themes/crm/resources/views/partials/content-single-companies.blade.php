@php
  $company = get_field('company');

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
</div>
@include('components.modal-edit-company')
</div>



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





