@php
    $location = get_field('location');
@endphp

       
<tr class="hover:bg-gray-200">
  
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
       <p>
          <a href="{{ the_permalink() }}">
            {{ $location }}
          </a>
        </p>
    </td>
    
    
    
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 w-[100px] whitespace-nowrap sm:pl-6">
      <a href="{{ the_permalink() }}" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
    </td>

  
</tr>

       
      


