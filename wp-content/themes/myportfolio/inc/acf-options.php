<?php 

add_action('acf/init', 'myportfolio_acf_op_init');
function myportfolio_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme General Settings'),
            'menu_title'    => __('Theme Options'),
            'menu_slug'     => 'myportfolio-options',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}// end of myportfolio_acf_op_init function