@include('components.modal-edit-company')

<div class="entry-content">
	
						<?php 

						$locations = get_sub_field('locations');

						?>
						<?php if( $locations ): ?>
							<ul>
							<?php foreach( $locations as $location ): ?>
								<li>
									<a href="<?php echo get_permalink( $location->ID ); ?>">
										<?php echo get_the_title( $location->ID ); ?>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>

					</div>
