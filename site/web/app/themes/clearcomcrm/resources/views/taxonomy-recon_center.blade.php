@extends('layouts.app')

@section('content')
  
  
<h1 class="mb-8 text-xl font-bold">
	Recon Center: {{ single_cat_title() }}
</h1>





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
        if(have_posts()) :
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

      Oops, there are no posts.

<?php
   endif;
?>
      

      
    </tbody>
  </table>



    



@endsection