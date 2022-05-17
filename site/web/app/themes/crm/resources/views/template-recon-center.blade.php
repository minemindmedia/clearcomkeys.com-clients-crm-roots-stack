{{--
  Template Name: Recon Centers
--}}


@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())

    <div class="flex">
      <div class="flex-1">
      </div>
      <div>
        @include('components.modal-new-recon-center')
      </div>
    </div>
      
    <table class="min-w-full mt-8 border-separate" style="border-spacing: 0" id="filterTable">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="sticky top-0 z-10 py-4 pl-4 pr-4 text-sm font-semibold text-left text-gray-900 bg-opacity-75 border-b border-gray-300 bg-gray-50 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Center Name</th>
          <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
            <span class="sr-only">Edit</span>
          </th>
        </tr>
      </thead>
      <tbody class="bg-white">
          <?php
            $terms = get_terms( array(
                'taxonomy' => 'recon-center',
                'hide_empty' => false
            ) );
          ?>
          @foreach( $terms as $term )
            <tr class="hover:bg-gray-200">
              <td class="py-4 pl-4 pr-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                <a href="<?php echo get_term_link( $term->term_id, 'recon-center');?>"><?php echo $term->name; ?></a>
              </td>
              <td class="py-4 pl-4 pr-3 text-sm font-medium text-right text-gray-900 whitespace-nowrap sm:pl-6">
                <a href="<?php echo get_term_link( $term->term_id, 'recon-center');?>" class="text-indigo-600 hover:text-indigo-900">View / Edit</a>
              </td>
            </tr> 
          @endforeach
      </tbody>
    </table>

  @endwhile
@endsection
