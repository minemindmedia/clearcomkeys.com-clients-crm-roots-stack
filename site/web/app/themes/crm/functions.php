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

// Save Contacts Title from ACF Fields
add_action('acf/save_post', 'save_contacts_title', 20);
function save_contacts_title($post_id){

  if( get_post_type($post_id) == 'contacts' ) {

    // Get the data from a field
    if( have_rows('contact_details', $post_id) ):
        while( have_rows('contact_details', $post_id) ): the_row(); 

            $first_name = get_sub_field('first_name', $post_id);
            $last_name = get_sub_field('last_name', $post_id);
            $title = $last_name . ', ' . $first_name;
            $slug = $last_name . '-' . $first_name;

        endwhile;
    endif;

    // Set the post data
    $postdata = array(
        'ID'          => $post_id,
        'post_title'  => $title,
        'post_type'   => 'contacts',
        'post_name'   => $slug
    );

    // Remove the hook to avoid infinite loop. Please make sure that it has
    // the same priority (20)
    remove_action('acf/save_post', 'save_contacts_title', 20);

    // Update the post
    wp_update_post( $postdata );

    // Add the hook back
    add_action('acf/save_post', 'save_contacts_title', 20);

  }

}

// Save Comany Title from ACF Fields
add_action('acf/save_post', 'save_company_title', 20);
function save_company_title($post_id){

  if( get_post_type($post_id) == 'companies' ) {

            $company_name = get_field('company', $post_id);
            $title = $company_name;

    // Set the post data
    $postdata = array(
        'ID'          => $post_id,
        'post_title'  => $title,
        'post_type'   => 'companies',
        'post_name'   => $title
    );

    // Remove the hook to avoid infinite loop. Please make sure that it has
    // the same priority (20)
    remove_action('acf/save_post', 'save_company_title', 20);

    // Update the post
    wp_update_post( $postdata );

    // Add the hook back
    add_action('acf/save_post', 'save_company_title', 20);

  }

}

// Save Location Title from ACF Fields
add_action('acf/save_post', 'save_location_title', 20);
function save_location_title($post_id){

  if( get_post_type($post_id) == 'locations' ) {

            $location_name = get_field('location', $post_id);
            $title = $location_name;

    // Set the post data
    $postdata = array(
        'ID'          => $post_id,
        'post_title'  => $title,
        'post_type'   => 'locations',
        'post_name'   => $title
    );

    // Remove the hook to avoid infinite loop. Please make sure that it has
    // the same priority (20)
    remove_action('acf/save_post', 'save_location_title', 20);

    // Update the post
    wp_update_post( $postdata );

    // Add the hook back
    add_action('acf/save_post', 'save_location_title', 20);

  }

}



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



// Remove prefix from page titles
function prefix_category( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }elseif( is_tag() ){
      $title = single_cat_title( '', false );
    }elseif( is_author() ){
      $title = get_the_author();
    }elseif (is_date()) {
       $title = get_the_date('M Y');
    }elseif (is_post_type_archive()) {  //for custom post types
      $title = post_type_archive_title( '' ,false); 
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'prefix_category' );


add_action('acfe/save_term/taxonomy=location', 'my_acfe_save_category', 10, 2);
function my_acfe_save_category($post_id, $object){
    
    // Retrieve the user input from "my_field" field
    get_field('location');

}

/**
 * Change wp-admin to home page
 */
add_filter('login_url', 'change_login_url');
function change_login_url() {
    return home_url('/');
}

/**
 * Redirect wp-login.php to home page
 */
add_action('init','custom_login');

function custom_login(){
 global $pagenow;
 if( 'wp-login.php' == $pagenow && (isset($_GET['action']) ? $_GET['action'] : '') !="logout") {
  wp_redirect('/');
  exit();
 }
}

/**
 * Logout - Avoid Confirmation
 */
add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result)
{
    /**
     * Allow logout without confirmation
     */
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '/';
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}

/* start add new positon/title to contacts post_type*/
add_action('admin_footer', 'my_admin_footer_function');
add_action('wp_footer', 'my_admin_footer_function');
function my_admin_footer_function() {
    $admin_url = admin_url('admin-ajax.php');
    ?>
    <script>
    jQuery('.ct_position_title .acf-label').remove();
    jQuery('.ct_position_title .acf-input').remove();
    // jQuery('.acf-field-contacts-contact-details-position-title').after('<div id="ct-position-title" class="acf-field" style="border:unset;">'
    jQuery('.ct_position_title').append('<div id="ct-position-title" class="acf-field" style="border:unset;">'
    +'<div class="acf-label">'
    +'<label for="acf-field_contacts_contact_details-field_contacts_contact_details_email">New Position/Title</label></div>'
    +'<div class="acf-input">'
    +'<div class="acf-input-wrap"><input type="text" name="positionTitle" style="width:60%;">'
    +'<a class="acf-button button button-primary" id="savePositionTitle" style="margin-left:20px;" href="#">Add New Position</a><span class="spinner" style="display: inline-block;"></span></div></div></div>');
    jQuery('#savePositionTitle').on('click', function (e) {
        e.preventDefault();
        jQuery('#ct-position-title .spinner').addClass('is-active');
        jQuery('#savePositionTitle').addClass('disabled');
        var position = jQuery("input[name='positionTitle']").val();
        var data = {
            action: 'save_contact_position',
            position: position,
        };
        var ajaxurl = "<?php echo $admin_url; ?>";
        jQuery.post(ajaxurl, data, function (response) {
            var response = jQuery.parseJSON(response);
            jQuery('#ct-position-title .spinner').removeClass('is-active');
            jQuery('#savePositionTitle').removeClass('disabled');
            jQuery("input[name='positionTitle']").val('')
            if(response.success) {
                jQuery('#acf-field_contacts_contact_details-field_contacts_contact_details_position_title').append('<option value="'+response.post_title+'" data-select2-id="'+response.post_id+'">'+response.post_title+'</option>');
                
                /*if(response.delete) {
                    jQuery('#acf-field_contacts_contact_details-field_contacts_contact_details_position_title').empty();
                }*/
            } else {
                alert('Something went wrong.')
            }
        });
    });
    </script>
    <?php 
}

add_action('wp_ajax_nopriv_save_contact_position', 'save_contact_position');
add_action('wp_ajax_save_contact_position', 'save_contact_position');
function save_contact_position()
{
    $response['success'] = false;
    global $user_ID;
    global $wpdb;
    if(isset($_POST['action']) && isset($_POST['position']) && !empty($_POST['position'])) {
        $args = array(
            'post_title' => $_POST['position'],
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => $user_ID,
            'post_type' => 'ct_position_title',
            );
        $insert = wp_insert_post($args);
        if($insert) {
            $post_id = $wpdb->insert_id;
            $response['success'] = true;
            $posts = get_posts([
                'post_type' => 'ct_position_title',
                'post_status' => 'publish',
                'numberposts' => -1,
                'order'    => 'ASC'
              ]);
            /* 
            // if value is delete then delete add post with ct_position_title posty_type
            if($_POST['position'] == 'delete') {
                foreach ($posts as $eachpost) {
                    wp_delete_post( $eachpost->ID, true );
                    $response['delete'][] = $eachpost->ID;
                }
            }
            */
            $new_post = get_post($post_id);
            // $response['result'] = $posts;
            // $response['post'] = get_post($post_id);
            $response['post_id'] = $new_post->ID;
            $response['post_title'] = $new_post->post_title;
        }
	}
    exit(json_encode($response));
}
/* end add new positon/title to contacts post_type*/