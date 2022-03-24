<?php 

// args
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'contacts'
);


// query
$the_query = new WP_Query( $args );

?>
<?php if( $the_query->have_posts() ): ?>
	<ul>
	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li class="block mb-12">
			<a href="<?php the_permalink(); ?>">
				

        <?php
          $contact_details = get_field('contact_details');
          if( $contact_details ): ?>
              <h2 class="text-2xl">{{ $contact_details['first_name'] }} {{ $contact_details['last_name'] }}</h2>
          <?php endif; ?>


			</a>
      <p class="text-xl block">
        {{ the_field('contact_type') }}
        @if (get_field('contact_type') == 'Key Technician')
          : {{ the_field('key_technician') }}
        @endif
      </p>
      <p>
        
      </p>
      <p>
        {{ the_field('dealership_location') }}
      </p>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>