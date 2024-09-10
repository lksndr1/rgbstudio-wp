<?php

add_action('wp_enqueue_scripts', 'rgb_studio_scripts');

function rgb_studio_scripts(){
    wp_enqueue_style('main', get_stylesheet_uri());
    wp_enqueue_style('rgb_studio-style', get_template_directory_uri() . '/styles/main.css', array('main'));
    wp_enqueue_script('rgb_studio-scripts', get_template_directory_uri() . '/scripts/main.js', array(), false, true);
    
    if (is_page_template('templates/contact.php')) {
        wp_enqueue_style('contact-style', get_template_directory_uri() . '/styles/template-styles/contact.css', array('main'));
        wp_enqueue_script('contact-scripts', get_template_directory_uri() . '/scripts/template-scripts/contact.js', array(), false, true);
    }
}

    function register_lead_post_type() {
        $labels = array(
            'name'               => 'Leads',
            'singular_name'      => 'Lead',
            'menu_name'          => 'Leads',
            'name_admin_bar'     => 'Lead',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Lead',
            'new_item'           => 'New Lead',
            'edit_item'          => 'Edit Lead',
            'view_item'          => 'View Lead',
            'all_items'          => 'All Leads',
            'search_items'       => 'Search Leads',
            'not_found'          => 'No leads found.',
            'not_found_in_trash' => 'No leads found in Trash.',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'lead'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'supports'           => array('title', 'editor', 'custom-fields'),
        );

        register_post_type('lead', $args);
    }
    add_action('init', 'register_lead_post_type');

?>