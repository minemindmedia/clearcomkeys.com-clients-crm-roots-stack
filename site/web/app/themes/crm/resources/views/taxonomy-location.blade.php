@extends('layouts.app')

@section('content')

@php
    $queried_object = get_queried_object(); 
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;  
    $location = get_field('location', $queried_object);
@endphp







<div class="lg:flex lg:items-center lg:justify-between">
  <div class="flex-1 min-w-0">
    <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ $location }}
    </h2>
    
  </div>
  <div class="flex mt-5 lg:mt-0 lg:ml-4">

    <span class="sm:ml-3">
      @include('components.modal-edit-location')
    </span>

    
  </div>
</div>




  <?php
  if(have_posts()) : ?>
  <table class="min-w-full mt-8 divide-y divide-gray-300" id="filterTable">
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