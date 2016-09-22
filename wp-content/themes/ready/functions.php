<?php
add_action('wp_enqueue_scripts', 'ready_scripts' , 20);
function ready_scripts() {
	wp_enqueue_style('ready-style-sheet', get_stylesheet_uri());	
	wp_enqueue_style('ready-slate-color', get_stylesheet_directory_uri() . '/css/cyan.css');	
}
function ready_add_editor_styles() {
	
    add_editor_style('custom-editor-style.css' );
	load_child_theme_textdomain('ready', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'ready_add_editor_styles' );
?>