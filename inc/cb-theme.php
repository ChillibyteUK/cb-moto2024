<?php
/**
 * File: cb-theme.php
 *
 * Theme initialization and customization functions for cb-moto2024.
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

require_once CB_THEME_DIR . '/inc/cb-utility.php';
require_once CB_THEME_DIR . '/inc/cb-blocks.php';
require_once CB_THEME_DIR . '/inc/cb-news.php';

// Remove unwanted SVG filter injection WP.
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


/**
 * Removes the comment-reply script from the header.
 */
function remove_comment_reply_header_hook() {
    wp_deregister_script( 'comment-reply' );
}
add_action( 'init', 'remove_comment_reply_header_hook' );

/**
 * Removes the comments menu from the WordPress admin dashboard.
 */
function remove_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_comments_menu' );

/**
 * Removes specific page templates from the available templates list.
 *
 * @param array $page_templates Array of available page templates.
 * @return array Modified array of page templates.
 */
function child_theme_remove_page_template( $page_templates ) {
    unset( $page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php'] );
    return $page_templates;
}
add_filter( 'theme_page_templates', 'child_theme_remove_page_template' );

/**
 * Removes support for specific post formats from the theme.
 */
function remove_understrap_post_formats() {
    remove_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'remove_understrap_post_formats', 11 );

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Site-Wide Settings',
            'menu_title' => 'Site-Wide Settings',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
        )
    );
}

/**
 * Initializes theme widgets, registers sidebars and navigation menus,
 * unregisters unused sidebars and menus, and sets editor color palette.
 */
function widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Footer Col 1', 'cb-moto2024' ),
            'id'            => 'footer-1',
            'description'   => __( 'Footer Col 1', 'cb-moto2024' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
        )
    );

    register_nav_menus(
		array(
			'primary_nav'  => __( 'Primary Nav', 'cb-moto2024' ),
			'footer_menu1' => __( 'Footer Menu 1', 'cb-moto2024' ),
			'footer_menu2' => __( 'Footer Menu 2', 'cb-moto2024' ),
			'footer_menu3' => __( 'Footer Menu 3', 'cb-moto2024' ),
		)
	);

    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
    unregister_sidebar( 'left-sidebar' );
    unregister_sidebar( 'right-sidebar' );
    unregister_sidebar( 'footerfull' );
    unregister_nav_menu( 'primary' );

    add_theme_support( 'disable-custom-colors' );
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Light Blue',
                'slug'  => 'bg-light-blue',
                'color' => '#95c1e9',
            ),
            array(
                'name'  => 'Navy Blue',
                'slug'  => 'bg-navy-blue',
                'color' => '#0d1624',
            ),
            array(
                'name'  => 'Coral',
                'slug'  => 'bg-coral',
                'color' => '#ff554d',
            ),
            array(
                'name'  => 'Off White',
                'slug'  => 'bg-off-white',
                'color' => '#f8f6f4',
            ),
            array(
                'name'  => 'Off White 50',
                'slug'  => 'bg-off-white-50',
                'color' => '#f8f6f480',
            ),
        )
    );
}
add_action( 'widgets_init', 'widgets_init', 11 );


remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Registers a custom dashboard widget for Chillibyte.
 */
function register_cb_dashboard_widget() {
    wp_add_dashboard_widget(
        'cb_dashboard_widget',
        'Chillibyte',
        'cb_dashboard_widget_display'
    );
}
add_action( 'wp_dashboard_setup', 'register_cb_dashboard_widget' );

/**
 * Displays the Chillibyte dashboard widget content.
 *
 * @return void
 */
function cb_dashboard_widget_display() {
    ?>
<div style="display: flex; align-items: center; justify-content: space-around;">
    <img style="width: 50%;"
        src="<?= esc_url( get_stylesheet_directory_uri() . '/img/cb-full.jpg' ); ?>">
    <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
        href="mailto:hello@www.chillibyte.co.uk/">Contact</a>
</div>
<div>
    <p><strong>Thanks for choosing Chillibyte!</strong></p>
    <hr>
    <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
    <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
</div>
    <?php
}


/**
 * Registers custom block editor scripts and block types for Gutenberg.
 */
function cc_gutenberg_register_files() {
    // script file.
    wp_register_script(
        'cc-block-script',
        get_stylesheet_directory_uri() . '/js/block-script.js', // adjust the path to the JS file.
        array( 'wp-blocks', 'wp-edit-post' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
    // register block editor script.
    register_block_type(
        'cc/ma-block-files',
        array(
            'editor_script' => 'cc-block-script',
        )
    );
}
add_action( 'init', 'cc_gutenberg_register_files' );

/**
 * Returns the post excerpt, optionally modifying it for non-admin views.
 *
 * @param string $post_excerpt The post excerpt.
 * @return string The (possibly modified) post excerpt.
 */
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( is_admin() || ! get_the_ID() ) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

/**
 * Change submit from input to button
 *
 * Do not use example provided by Gravity Forms as it strips out the button attributes including onClick
 *
 * @param string $button_input The original HTML input element for the submit button.
 * @param array  $form The Gravity Forms form array.
 */
function wd_gf_update_submit_button( $button_input, $form ) {
    // save attribute string to $button_match[1].
    preg_match( '/<input([^\/>]*)(\s\/)*>/', $button_input, $button_match );

    // remove value attribute (since we aren't using an input).
    $button_atts = str_replace( 'value=' . $form['button']['text'] . "' ", '', $button_match[1] );

    // create the button element with the button text inside the button element instead of set as the value.
    return '<button ' . $button_atts . '><span>' . $form['button']['text'] . '</span></button>';
}
add_filter( 'gform_submit_button', 'wd_gf_update_submit_button', 10, 2 );


/**
 * Enqueues theme scripts and styles, sets up theme text domain, and deregisters jQuery.
 *
 * @return void
 */
function cb_theme_enqueue() {
    $the_theme = wp_get_theme();

    load_theme_textdomain( 'cb-moto2024', get_stylesheet_directory() . '/languages' );

    wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'cb_theme_enqueue' );


/**
 * Adds a 'Featured' column to the admin posts list before the 'date' column.
 *
 * @param array $columns Existing columns in the posts list.
 * @return array Modified columns with 'is_sticky' added.
 */
function add_is_sticky_column_in_specific_position( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $title ) {
        // Add all columns up to (but not including) the 'date' column.
        if ( 'date' === $key ) {
            // Insert the 'is_sticky' column before the 'date' column.
            $new_columns['is_sticky'] = 'Featured';
        }
        // Add the current column to the new columns array.
        $new_columns[ $key ] = $title;
    }
    return $new_columns;
}
add_filter( 'manage_posts_columns', 'add_is_sticky_column_in_specific_position' );

/**
 * Makes the 'is_sticky' column sortable in the admin posts list.
 *
 * @param array $columns Existing sortable columns.
 * @return array Modified sortable columns with 'is_sticky' added.
 */
function make_is_sticky_column_sortable( $columns ) {
    $columns['is_sticky'] = 'is_sticky'; // The value 'is_sticky' identifies the column.
    return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'make_is_sticky_column_sortable' );

/**
 * Populates the 'is_sticky' column in the admin posts list with 'Yes' or 'No' based on the post's 'is_sticky' field.
 *
 * @param string $column  The name of the column being displayed.
 * @param int    $post_id The ID of the current post.
 */
function populate_is_sticky_column_in_posts( $column, $post_id ) {
    if ( 'is_sticky' === $column ) {
        // Get the value of the 'is_sticky' field from the current post.
        $is_sticky = get_field( 'is_sticky', $post_id );

        // Check if 'is_sticky' field is true and display accordingly.
        if ( $is_sticky ) {
            echo 'Yes'; // Adjust as needed.
        } else {
            echo 'No'; // Adjust as needed.
        }
    }
}
add_action( 'manage_posts_custom_column', 'populate_is_sticky_column_in_posts', 10, 2 );

/**
 * Sorts posts in the admin list by the 'is_sticky' custom field when the column is selected for sorting.
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 * @return void
 */
function sort_posts_by_is_sticky( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    $orderby = $query->get( 'orderby' );

    if ( 'is_sticky' === $orderby ) {
        $query->set( 'meta_key', 'is_sticky' );
        $query->set( 'orderby', 'meta_value_num' ); // Use 'meta_value_num' for numeric sorting.
        $query->set( 'order', 'DESC' ); // Use 'ASC' if you want the false/0 values first.
    }
}
add_action( 'pre_get_posts', 'sort_posts_by_is_sticky' );
