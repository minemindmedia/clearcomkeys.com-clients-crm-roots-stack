@include('components.modal-edit-company')

<div class="entry-content">
	
						<?php 
						global $wpdb;
						$locations = get_field('location');
						$locationName = $locations;
						$companies = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='companies' AND post_status='publish'");
						$locationArray = [];
						if($companies) {
							$counter = 0;
							foreach ($companies as $company) {
								$location = get_field('location', $company->ID);
								if(!empty($location) && isset($location[0]->post_title) && $location[0]->post_title == $locations) {
									$locationArray[$counter]['id'] = $company->ID;
									$locationArray[$counter]['title'] = $company->post_title;
									$counter++;
								}
							}
						}

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
				<?php if ($locationArray): ?>
					<div class="flex-1 mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
						<div class="px-4 py-5 sm:px-6">
							<h3 class="text-lg font-medium leading-6 text-gray-900">Company list associated with this location</h3>
							<p class="max-w-2xl mt-1 text-sm text-gray-500">
							</p>
						</div>
						<div class="border-t border-gray-200">
							
						<?php foreach($locationArray as $singleLocation): ?>
								<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
									<dt class="text-sm font-medium text-gray-500"><a href="<?php echo get_permalink($singleLocation['id']); ?>"><?php echo $singleLocation['title'] ?></a></dt>
				
								</div>
						<?php endforeach ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="flex-1 mt-4 overflow-hidden bg-white shadow sm:rounded-lg">
					<div class="px-4 py-5 sm:px-6">
						<h3 class="text-lg font-medium leading-6 text-gray-900">Contacts</h3>
						<p class="max-w-2xl mt-1 text-sm text-gray-500">
						</p>
					</div>
					<div class="border-t border-gray-200">
					<?php
					$contacts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='contacts' AND post_status='publish'");
					if($contacts) {
						foreach ($contacts as $contact) {
							$location = get_field('location_relationship', $contact->ID);
							if(isset($location['assign_location']) && $location['assign_location']) {
								if(!empty($location) && isset($location['location'][0]->post_title) && $location['location'][0]->post_title == $locationName) {
									?>
									@if( have_rows('contact_details', $contact->ID) )
										@while( have_rows('contact_details', $contact->ID) )
										@php
											the_row();
											$position_title = get_sub_field('position_title', $contact->ID);
											$first_name = get_sub_field('first_name', $contact->ID);
											$last_name = get_sub_field('last_name', $contact->ID);
											@endphp
											@if($position_title != 'Key Tech')
												<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
													<dt class="text-sm font-medium text-gray-500"><a href="<?php echo get_permalink($contact->ID); ?>">{{ $first_name . ' ' . $last_name }}</a></dt>
												</div>
											@endif
										@endwhile
									@endif
									<?php
								}
							}
						}
					}
					?>
					</div>
				</div>
