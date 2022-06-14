@include('components.modal-edit-company')

<div class="entry-content">
	
	<div class="entry-content">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php

		/*
		*  Query posts for a relationship value.
		*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
		*/

		$staff = get_posts(array(
			'post_type' => 'contacts',
			'meta_query' => array(
				array(
					'key' => 'location', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));

		?>
		<div class="people-grid">
		<?php if( $staff ): ?>
			<?php foreach( $staff as $doctor ): ?>
				<?php

				$photo = get_field('photo', $doctor->ID);

				?>
				<div class="single-person">
						<img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>" />
						<h3><?php echo get_the_title( $doctor->ID ); ?></h3>
						<h4><?php echo get_field('position_title', $doctor->ID); ?></h3>

				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

<?php endwhile; // end of the loop. ?>'''
	 
	 </div>