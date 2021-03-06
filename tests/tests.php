<?php

/*
* TESTS
* Not included or necessary in finished plugin.
* Various testing shown below when writing functions for the plugin.
*/

/************
* TAXONOMY TESTS
*************

var_dump(taxonomy_exists('category'));
var_dump(taxonomy_exists('video_category'));

wp_insert_term('Ireland', 'country');
wp_insert_term('Spain', 'country');

wp_insert_term('Wedding', 'video_category');
wp_insert_term('Music video', 'video_category');
wp_insert_term('Commercial', 'video_category');

var_dump(term_exists('music-video'));
var_dump(term_exists('wedding'));
var_dump(term_exists('Music Video'));
var_dump(term_exists('Ireland'));
var_dump(term_exists('ireland'));
var_dump(term_exists('Spain'));
var_dump(term_exists('spain'));

var_dump(taxonomy_exists('Video category'));
var_dump(taxonomy_exists('video_category'));
*/

//Practice getting terms and looping the slug name and real name of our terms for specific taxonomies.
/*$terms = get_terms( array(
    'taxonomy' => 'video_category',
    'hide_empty' => false,
) );
var_dump($terms);

foreach($terms as $term){
	echo "<br>" . $term->name;
	echo "<br>" . $term->slug;
}

var_dump(term_exists('music-video'));
*/

/*****************
* DATE VALIDITY TESTS
******************

function check_date_validity( $date ){
    //if blank
	  if($date === ''){
		    return "<br />Your date field must not be blank";
	  }

    $date_arr = explode( '-', $date);

    if(!strlen($date_arr[0]) == 4 || preg_match('/[a-z@,!]/i', $date)){
    	return "<br />Your date is not valid. Check it is in YYYY-MM-DD format";
    }
    
    if(!wp_checkdate($date_arr[1], $date_arr[2], $date_arr[0], $date)){
    	return "<br />WP_CHECKDATE ERROR Your date is not valid. Check it is in YYYY-MM-DD format";
    }
    
    return '';
}

//YYYY-MM-DD
var_dump(check_date_validity('2003-12-13')); // returns string ''
var_dump(check_date_validity('2003-3-13')); // returns string ''
var_dump(check_date_validity('')); // returns blank
var_dump(check_date_validity('@!,aaggrRRRtt@uyee')); // returns reg ex error
var_dump(check_date_validity('@!,aaggrtt@uyee')); // returns reg ex error
var_dump(check_date_validity('2003-13-13')); // returns wp_checkdate error

//Check new language taxonomy
if(taxonomy_exists( 'video_project_language' )){
	var_dump("Yes video project language is a registered taxonomy");
}
*/

/***************
*  REGEX TESTS
*****************

$my_test_str = 'Hello@';
$res = preg_match("/[^a-zA-Z0-9_-]/", $my_test_str);
var_dump($res);
if($res){
	echo "res is ok";
}

$my_test_str2 = 'Goodness';
var_dump(preg_match('/ness$/', $my_test_str2)); //true (ness at the end)
var_dump(preg_match('/^ness/', $my_test_str2)); //false (no string starts with ness)
var_dump(preg_match('/Goodne.s/', $my_test_str2)); //true - matches any character between e and s
var_dump(preg_match('/Goodness|Terribleness/', $my_test_str2)); //true matches EITHER
var_dump(preg_match('/Good?ness/', $my_test_str2)); // true - matches EITHER Good or Goodness

$my_test_str3 = 'mememe';
var_dump(preg_match('/me+/', $my_test_str3)); // true - matches me 1 or more times eg. me or meme or mememe etc.
var_dump(preg_match('/(A-Z)/', $my_test_str3)); // false - ?
var_dump(preg_match('/[me]/', $my_test_str3)); // true - matches any single character
var_dump(preg_match('/[bB]/', $my_test_str3)); //false - neither b or B contained
var_dump(preg_match('/abc{1}/', $my_test_str3)); //false - matches abc but not abcc
var_dump(preg_match('/abc{1,}/', $my_test_str3)); //false - matches abc or abccc 1 or more c after ab
var_dump(preg_match('/ME/i', $my_test_str3)); //true - i means case insensitive


$my_arr = array('smartest', 'big', 'small', 'tallest', 'short', 'shortest');
//find all superlative adjectives. (ending in est)
foreach($my_arr as $word){
	if(preg_match('/est$/', $word)){
		echo "<br>" . $word;
	}
}
//find all words starting with s
foreach($my_arr as $word){
	if(preg_match('/^s/', $word)){
		echo "<br>" . $word;
	}
}

var_dump(preg_match('/^[a-z]+$/i', 'italy2')); //false - contains a number
var_dump(preg_match('/^[a-z]+$/i', 'italy')); //true - only letters - i case insensitive
var_dump(preg_match('/^[a-z]+$/i', 'italy@-!22-')); //false - only letters - i case insensitive

*/

/********************
* QUERY TERM TESTS
*********************

$args = array(
'post_type' => 'video_project',
'tax_query' => array(
    array(
    'taxonomy' => 'video_project_language',
    'terms' => 'english'
     )
  )
);
$test_query = new WP_Query( $args );

/************************
* CONVERT FIRST LETTER OF STRING TO UPPER CASE
*************************
$my_string = 'australia';
echo "<br />" . $my_string;
echo "<br />" . $my_string[0];
$my_string[0] = strtoupper($my_string[0]);
echo "<br />" . $my_string;

/************************
* GET VIMEO ID NUMBER TO DISPLAY
*************************
function get_vimeo_link( $vimeo_url){
    //https://vimeo.com/259695789
    $video_id = $vimeo_url;
    $vid_arr = explode('/', $video_id);
    return $vid_arr[(count($vid_arr)-1)];
}
echo get_vimeo_link( 'https://vimeo.com/259695789' );
echo get_vimeo_link( '29898759');

/*********************************
* GET ALL CATEGORY NAMES
**********************************
$video_category_terms = get_terms( array(
                    'taxonomy' =>   'video_category',
                    'hide_empty' => false
                ));
foreach($video_category_terms as $category){
    echo '<br />' . $category->name;
}

/*****************************
* GET TERM NAME FROM TERM SLUG
******************************

$my_term_name =  get_term_by('slug', 'music-video', 'video_category')->name;
var_dump($my_term_name);


/****************************
GET_THE_TERMS TEST (used to retrieve language for update video project form)
******************************

$language = get_the_terms( 495,'video_project_language' );
$language_name = esc_html( $language[0]->name );
$language_slug = esc_html( $language[0]->slug );

/******************************
* PLUGIN_DIR_URL TESTS
********************************
//CALLED FROM admin-pages/main.php
var_dump(plugin_dir_url( __FILE__ ) . '/js/admin-page-media.js'); 
//'http://localhost/wordpress/wp-content/plugins/video-projects-showcase/admin-pages//js/admin-page-media.js'
var_dump(plugin_dir_url( __FILE__ ) . 'js/admin-page-media.js'); 
//'http://localhost/wordpress/wp-content/plugins/video-projects-showcase/admin-pages/js/admin-page-media.js'
var_dump(plugin_dir_url( __DIR__ ) . 'js/admin-page-media.js'); 
//http://localhost/wordpress/wp-content/plugins/video-projects-showcase/js/admin-page-media.js
var_dump(plugins_url('css/styles.css', __DIR__));

/******************************
* DIRNAME TESTS
********************************
//CALLED FROM admin-pages/main.php
var_dump(dirname(dirname(dirname(__FILE__)))); // C:\wamp\www\wordpress\wp-content\plugins
?>

/*******************************
* DATE TO MONTH YEAR FORMAT
********************************
$new_date = date("F Y", strtotime('2018-05-03'));
var_dump($new_date); // returns 'May 2018'

/*********************************
* URL TESTS
**********************************
$url_string = 'https://vimeo.com/301862295';
$url_string2 = 'Hello there';
var_dump( esc_url($url_string) ); // 'https://vimeo.com/301862295'
var_dump( esc_url($url_string2) ); // 'http://Hello%20there'
var_dump( esc_url_raw($url_string2) ); // 'http://Hello%20there'
var_dump( filter_var($url_string, FILTER_VALIDATE_URL)); // 'https://vimeo.com/301862295'
var_dump( filter_var($url_string2, FILTER_VALIDATE_URL)); // false
$image_url1 = 'http://localhost/wordpress/wp-content/uploads/2019/04/cobh-cove-285147_640.jpg';
$image_url2 = 'hello world, how are you?';
var_dump( filter_var($image_url1, FILTER_VALIDATE_URL)); //'http://localhost/wordpress/wp-content/uploads/2019/04/cobh-cove-285147_640.jpg'
var_dump( filter_var($image_url2, FILTER_VALIDATE_URL)); // false





