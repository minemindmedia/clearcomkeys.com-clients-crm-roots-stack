@extends('layouts.app')

@section('content')



<?php if( have_rows('physical_address') ): ?>
    <?php while( have_rows('physical_address') ): the_row(); 

        // Get sub field values.
        $company = get_sub_field('company');
        $address = get_sub_field('street_address');
        $city = get_sub_field('city');
        $state = get_sub_field('state');
        $zip = get_sub_field('zip');
        $training = get_sub_field('last_in_person_training');
        $zoom = get_sub_field('last_zoom_training');

        ?>

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="lg:flex lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      <?php the_field('recon_center_name'); ?>
    </h2>
    <div class="flex flex-col mt-1 sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
      <div class="flex items-center mt-2 text-sm text-gray-500">
        <!-- Heroicon name: solid/briefcase -->
        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
          <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
        </svg>
        {{ $company }}
      </div>
      <div class="flex items-center mt-2 text-sm text-gray-500">
        <!-- Heroicon name: solid/location-marker -->
        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
        </svg>
        {{ $address }}, {{ $city }} {{ $state }} {{ $zip }}
      </div>
      <div class="flex items-center mt-2 text-sm text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>
        {{ $training }}
      </div>
      <div class="flex items-center mt-2 text-sm text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5z"/>
        </svg>
        {{ $zoom }}
      </div>
    </div>
  </div>
  <div class="flex mt-5 lg:mt-0 lg:ml-4">

    <span class="sm:ml-3">
      <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <!-- Heroicon name: solid/check -->
        <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Edit
      </button>
    </span>

    
  </div>
</div>

       
    <?php endwhile; ?>
<?php endif; ?>



  <?php
  if(have_posts()) : ?>
  <table class="min-w-full divide-y divide-gray-300">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Last Name</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">First Name</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
          <span class="sr-only">Edit</span>
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      

<?php
          while(have_posts()) :
              the_post();
    ?>
      

      @php
    $contact = get_field('contact_details');
    $details = get_field('additional_details');
@endphp

<tr class="hover:bg-gray-200">
  
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      @if( $contact['last_name'] )
        <a href="{{ get_permalink() }}">
          {{ $contact['last_name'] }}
        </a>
      @endif
    </td>
    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      @if( $contact['first_name'] )
        {{ $contact['first_name'] }}
      @endif
    </td>

  

    <td>
      @if( get_field('recon_center_store') == 'Recon Center' )
        <?php the_field('contact_type_recon_center') ?>
        @elseif( get_field('recon_center_store') == 'Store' )
        <?php the_field('contact_type_store') ?>
      @endif
    </td>

    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      <a href="{{ the_permalink() }}" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
    </td>

  
</tr>




        <?php
              endwhile;
          else :
        ?>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="p-12 text-center">
              <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No contacts</h3>
              <p class="mt-1 text-sm text-gray-500">Get started by adding a contact for this center.</p>
              <div class="mt-6">
                @include('components.modal-new-contact')
              </div>
            </div>



              

      
    </tbody>
  </table>
        <?php
          endif;
        ?>


    



@endsection