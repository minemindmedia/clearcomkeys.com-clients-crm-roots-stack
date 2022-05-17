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

    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      @if( get_field('recon_center_store') == 'Recon Center' )
        Dealership = <?php the_field('recon_center_location'); ?>
      @elseif( get_field('recon_center_store') == 'Store' )
        Store = <?php the_field('store_location'); ?>
      @endif
    </td>

    <td>
      @if( get_field('recon_center_store') == 'Recon Center' )
        <?php the_field('contact_type_recon_center') ?>
        @elseif( get_field('recon_center_store') == 'Store' )
        <?php the_field('contact_type_store') ?>
      @endif
    </td>

    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-right text-gray-900 whitespace-nowrap sm:pl-6">
      <a href="{{ the_permalink() }}" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
    </td>

  
</tr>

