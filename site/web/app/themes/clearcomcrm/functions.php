<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

try {
    \Roots\bootloader();
} catch (Throwable $e) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://docs.roots.io/acorn/2.x/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enable Sage Theme Support
|--------------------------------------------------------------------------
|
| Once our theme files are registered and available for use, we are almost
| ready to boot our application. But first, we need to signal to Acorn
| that we will need to initialize the necessary service providers built in
| for Sage when booting.
|
*/

add_theme_support('sage');

/*
|--------------------------------------------------------------------------
| Custom Functions Below
|--------------------------------------------------------------------------
|
*/

//Disable Gutenburg
add_filter('use_block_editor_for_post', '__return_false', 10);

//Create new title based on ACF Fields
function update_contacts_title($post_id) {
    if ( get_post_type( $post_id ) == 'contacts' ) {

        if( have_rows('contact_details') ):
            while( have_rows('contact_details') ): the_row(); 

                $first_name = get_sub_field('first_name', $post_id);
                $last_name = get_sub_field('last_name', $post_id);
                $title = $last_name . ', ' . $first_name;
                $slug = $last_name . '-' . $first_name;

            endwhile;
        endif;

            $postdata = array(
                'ID'          => $post_id,
                'post_title'  => $title,
                'post_type'   => 'contacts',
                'post_name'   => $slug
            );

            wp_update_post( $postdata );
            
            }
    }
add_filter('acf/save_post', 'update_contacts_title', 10, 3);

//Add meta box with Contact URL
function contacts_metabox_permalink() {
    add_meta_box( 'prfx_meta', ( 'View Contact' ), 'contacts_metabox_permalink_callback', 'contacts', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'contacts_metabox_permalink' );

function contacts_metabox_permalink_callback( $post ) {
    echo '<a href="';
    the_permalink();
    echo '" class="button button-small" target="_blank" style="width:100%;">';
    echo the_permalink();
    echo '</a>';
}

