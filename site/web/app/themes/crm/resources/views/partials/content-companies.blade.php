@php
    $company = get_field('company');
    $location = get_field('location');

     if( have_rows('shipping_address') ):
        while( have_rows('shipping_address') ): the_row(); 

            $phone = get_sub_field('phone');

        endwhile;
    endif;

@endphp

       
<tr class="hover:bg-gray-200">
  
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
       <p>
          <a href="{{ the_permalink() }}">
            {{ $company }}
          </a>
        </p>
    </td>
    
    <td>
      <?php
        $location = get_field('location');
        if( $location ): ?>
            <ul>
            <?php foreach( $location as $l ): 
                $permalink = get_permalink( $l->ID );
                $title = get_the_title( $l->ID );
                ?>
                <li>
                    <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </td>

    <td>
      {{ $phone }}
    </td>
    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      <a href="{{ the_permalink() }}" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
    </td>

  
</tr>

       
      


