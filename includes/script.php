<?php 
//Enqueue scripts
if (!function_exists('my_plugin_scripts')) {
    function my_plugin_scripts()
    {
        wp_enqueue_style('my-css', My_PLUGIN_DIR. 'admin/style.css');

    }
    add_action('admin_enqueue_scripts', 'my_plugin_scripts');
}