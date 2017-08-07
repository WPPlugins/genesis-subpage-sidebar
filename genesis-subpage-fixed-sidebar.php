<?php
/**
 * Plugin Name: Genesis Subpage Sidebar
 * Plugin URI: http://redblue.us/sidebar-plugin
 * Description: A plugin to automatically generate a sidebar from pages and their subpages. Supports heirarchical custom content types.
 * Version: 0.0.9
 * Author: Jon Schroeder
 * Author URI: http://redblue.us
 * License: GPL2
 */

/*  Copyright 2014 Jon Schroeder (email:jon@redblue.us)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$gsfs_prefix = 'gsfs_';
$gsfs_plugin_name = 'Genesis Subpage Sidebar';

$gsfs_options = get_option('gsfs_settings');
global $gsfs_options;

// include('includes/data-processing.php'); // this controls all saving of data
include('includes/admin-page.php'); // the plugin options page HTML and save functions

if (  !isset ( $gsfs_options['enable'] ) || $gsfs_options['enable'] == 'false' ) {
    // using the genesis_init hook so that if we're NOT on a genesis theme, it won't break anyone's site
    add_action( 'genesis_init', 'gsfs_genesis_test' );
}

function gsfs_genesis_test() {

    // retrieve our plugin settings from the options table
    $gsfs_options = get_option('gsfs_settings');

    // enqueue the plugin styles
    if ( !isset( $gsfs_options['defaultstyle'] ) || $gsfs_options['defaultstyle'] == 'false' ) {
        wp_enqueue_style( 'gsfs_styles', plugins_url( '/css/gsfs_style.css', __FILE__) );
    }

    if ( !isset( $gsfs_options['scrolling'] ) ||  $gsfs_options['scrolling'] == 'false' ) {
        wp_enqueue_style( 'gsfs_styles_scroll', plugins_url( '/css/gsfs_style_scroll.css', __FILE__) );
    }

    // If we're on a Genesis site, then let's start the process of doing everything else!
    add_action( 'wp_head', 'gsfs_check_query');
}

/**
 * This function checks to make sure that we're on the 'single' template for a heirarchical post type
 */
function gsfs_check_query() {

    $post_types = get_post_types( array( 'hierarchical' => true ) );
   
    // *** echoing the current post type for testing
    // $current_post_type = get_post_type( $post );
    // echo '$current_post_type = ' . $current_post_type . '<br/>';

    // *** echoing a list of the post types for testing
    // echo '<pre>';
    // print_r( $post_types );
    // echo '</pre>';

    // *** echoing the is_singular value for testing
    // echo 'is_singular( $post_types ) = ' . is_singular( $post_types ) . '<br/>';

    if ( !is_singular( $post_types ) )
        return;

    add_action( 'genesis_before_sidebar_widget_area', 'gsfs_secondary_navigation', 2 );
}

/**
 * This function adds an unordered list of child pages right before the post content in Genesis.
 *
 * @global object $post The current post object
 */
function gsfs_secondary_navigation() {
    
    global $post; // Setup the global variable $post
    $parent_title = get_the_title($post->post_parent);
    $current_post_type = get_post_type( $post );
    
    // *** echoing the $post->post_parent value for testing
    // echo '$post->post_parent = ' . $post->post_parent . '<br/>';

    // if the current post is a parent...
    if ( $post->post_parent ) {

        $kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' . '&post_type=' . $current_post_type);
        
        if ( is_single ( $post->post_parent ) )
            $current = 'class="current_page_item"';

    }

    // if the current post is not a parent...
    else {

        $kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' . '&post_type=' . $current_post_type);
        
        if ( get_the_title() ==  ( $parent_title ) ) {

            // *** echoing the get_the_title( $post->post_parent ) value for testing
            // echo '<p>get_the_title( $post->post_parent ) = ' . get_the_title( $post->post_parent ) . '</p>';
            
            $current = 'class="current_page_item"';
        }       
    }

    // if there are no children, then stop right there. We don't want to show anything on a post without parent-child relationships
    if ( !$kiddies )
        return;

    $gsfs_options = get_option('gsfs_settings');
    if ( ( !isset( $gsfs_options['scrolling'] ) ) || $gsfs_options['scrolling'] == false ) {
        // Enqueue jquery if it isn't already
        wp_enqueue_script( 'jquery' );

        // Enqueue the javascript to add the fixed class and hide the subnav when a user scrolls to the footer or footer widet area
        wp_enqueue_script( 'gsfs_fixedclassaddition', plugins_url( '/js/gsfs_fixedclassaddition.js', __FILE__ ), array( 'jquery' ) );
    }

    if ( ( !isset( $gsfs_options['scrolling'] ) ) || $gsfs_options['scrolling'] == false || $gsfs_options['removeprimarymenu'] == true ) {
        // removes the sidebar IF there are child pages being displayed
        remove_action( 'genesis_sidebar', 'ss_do_sidebar' ); // remove the Genesis simple sidebars sidebar
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' ); // remove the normal Genesis sidebar
    }
    
    // output the actual html
    ?>
    <section class="widget widget-secondary-menu">
        <ul class="secondary">
            <li <?php echo $current;?>><a href="<?php echo get_permalink( $post->post_parent ) ?>"><?php echo $parent_title;?></a></li>
            <?php echo $kiddies;?>
        </ul>
    </section>
    <?php
}