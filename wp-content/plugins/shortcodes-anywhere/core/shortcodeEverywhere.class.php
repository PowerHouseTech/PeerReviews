<?php

class shortcodeEverywhere{

    function __construct (){

        /* Add shortcodes in Text Widgets */

        add_filter( 'widget_text', 'shortcode_unautop');
        add_filter( 'widget_text', 'do_shortcode');

        /* Add shortcodes in Comments */

        add_filter( 'comment_text', 'shortcode_unautop');
        add_filter( 'comment_text', 'do_shortcode' );

        /* Add shortcodes in  Excerpts */

        add_filter( 'the_excerpt', 'shortcode_unautop');
        add_filter( 'the_excerpt', 'do_shortcode');

        /* Add shortcodes in Category, Tag, and Taxonomy Descriptions */

        add_filter( 'term_description', 'shortcode_unautop');
        add_filter( 'term_description', 'do_shortcode' );

    }






}