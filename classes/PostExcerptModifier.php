<?php

class VpsPostExcerptInit{
    public function __construct(){
        /* remove the default filter */
        //remove_filter('get_the_excerpt', 'wp_trim_excerpt');

        /* now, add your own filter */
        //add_filter('get_the_excerpt', array( $this, 'vps_wp_trim_excerpt' ));
    }

    function vps_wp_trim_excerpt($text) { // Fakes an excerpt if needed
    global $post;
    //var_dump($post);
    
    if ( '' == $text ) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace('\]\]\>', ']]&gt;', $text);
        //$text = strip_tags($text);
        $excerpt_length = 55;
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words)> $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }
    }
    return $text;
}

}