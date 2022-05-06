@php
    $contact = get_field('contact_details');
    $details = get_field('additional_details');
@endphp

<tr>
  
      
    <td class="p-4 text-left">
      @if( $contact['first_name'] )
        {{ $contact['first_name'] }}
      @endif
    </td>

    <td class="p-4 text-left">
      @if( $contact['last_name'] )
        {{ $contact['last_name'] }}
      @endif
    </td>

    <td class="p-4 text-left">
      @if( get_field('dealer_store') == 'Dealership' )
        Dealership = <?php the_field('dealership_location'); ?>
      @elseif( get_field('dealer_store') == 'Store' )
        Store = <?php the_field('store_location'); ?>
      @endif
    </td>

    <td>
      @if( get_field('dealer_store') == 'Dealership' )
        <?php the_field('contact_type_dealership') ?>
        @elseif( get_field('dealer_store') == 'Store' )
        <?php the_field('contact_type_store') ?>
      @endif
    </td>

    <td class="p-4 text-left">
      @if( $contact['email'] )
        {{ $contact['email'] }}
      @endif
    </td>

    <td class="p-4 text-left">
      @if( $contact['phone'] )
        {{ $contact['phone'] }}
      @endif
    </td>

    <td class="p-4 text-left">
      @if( $details )
        {{ $details['login'] }}
      @endif
    </td>

    <td class="p-4 text-left">
      @if( $details )
        {{ $details['password'] }}
      @endif
    </td>


    <td class="float-right p-4">
      @if( $details )
        @if( $details['forum_access'])
          Yes
        @else
          No
        @endif
      @endif
    </td>

  
</tr>

