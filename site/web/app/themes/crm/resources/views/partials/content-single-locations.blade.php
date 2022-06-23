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
											$email = get_sub_field('email', $contact->ID);
											@endphp
											@if($position_title != 'Key Tech')
												<div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
													<dt class="text-sm font-medium text-gray-500"><a href="<?php echo get_permalink($contact->ID); ?>">{{ $first_name . ' ' . $last_name }}</a></dt>
												</div>
												<div class="space-y-6 lg:col-start-1 lg:col-span-2">
													<section aria-labelledby="applicant-information-title">
														<div class="bg-white shadow sm:rounded-lg">
															<div class="px-4 py-5 sm:px-6">
																<p class="max-w-2xl mt-1 text-sm text-gray-500">Contact Information
																</p>
															</div>
															<div class="px-4 py-5 border-t border-gray-200 sm:px-6">
																<dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
																	<div class="sm:col-span-1">
																		<dt class="text-sm font-medium text-gray-500">Location</dt>
																		<dd class="mt-1 text-sm text-gray-900">
																			@if ($locationName)
																				{{ $locationName }}
																			@else
																				<p>No location has been selected.</p>
																			@endif
																		</dd>
																	</div>
																	<div class="sm:col-span-1">
																		<dt class="text-sm font-medium text-gray-500">Company</dt>
																		<dd class="mt-1 text-sm text-gray-900">
																			@if( have_rows('company_relationship', $contact->ID) )
																				@while( have_rows('company_relationship', $contact->ID) )
																				@php the_row();
																					$assign = get_sub_field('assign_company', $contact->ID);
																				@endphp
																				@if ( $assign == 1 )
																					@php
																					$company = get_sub_field('company', $contact->ID);
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
																		</dd>
																	</div>
																	@if($position_title)
																	<div class="sm:col-span-1">
																		<dt class="text-sm font-medium text-gray-500">Title</dt>
																		<dd class="mt-1 text-sm text-gray-900">
																			{{ $position_title }}
																		</dd>
																	</div>
																	@endif
																	@if($email)
																	<div class="sm:col-span-1">
																		<dt class="text-sm font-medium text-gray-500">Email</dt>
																		<dd class="mt-1 text-sm text-gray-900">
																			{{ $email }}
																		</dd>
																	</div>
																	@endif
																	@if (have_rows('phone_numbers', $contact->ID))
																	<div class="sm:col-span-1">
																		<dt class="text-sm font-medium text-gray-500">Phone</dt>
																		<dd class="mt-1 text-sm text-gray-900">
																			<ul>
																				@while (have_rows('phone_numbers', $contact->ID))
																					@php
																						the_row();
																						$phone = get_sub_field('phone', $contact->ID);
																						$type = get_sub_field('phone_type', $contact->ID);
																					@endphp
																					<li>
																						{{ $type }}: {{ $phone->national }}
																					</li>
																				@endwhile
																			</ul>
																		</dd>
																	</div>
																	@endif
																</dl>
															</div>
														</div>
													</section>
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
