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
            <p>No location assigned.</p>
          @endif
        @endif
      @endwhile
    @endif
    </td>

    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
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
    </td>

    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      @if( $contact['position_title'] )
        {{ $contact['position_title'] }}
      @endif
    </td>

    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-right text-gray-900 whitespace-nowrap sm:pl-6">
      <a href="{{ the_permalink() }}" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
    </td>

  
</tr>

