<div class="vps-main-page-div">

<?php
/*
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
$terms = get_terms( array(
    'taxonomy' => 'video_category',
    'hide_empty' => false,
) );
var_dump($terms);

foreach($terms as $term){
	echo "<br>" . $term->name;
}

?>

<div class="vps-main-page-greeting">
<h1>Hello there <span class="vps-username-box"><?php echo esc_html(wp_get_current_user()->user_nicename); ?></span></h1>
</div>
<div class="vps-main-page-header">
<h1 class="vps-main-page-header-font">Welcome to your bespoke admin page!</h1>
</div>


<div><h3>Intro</h3></div>
<div><p>Here, you can create, update, insert and manage all of your custom post types.</p></div>
<div><p>We hope this page makes it very quick and very easy to manage the bespoke content for your site all in 1 place.</p></div>

<div class="vps-menu-buttons-wrapper">
<div class="vps-row">
<div class="vps-column">

<h2>Add video project</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
   <input type="hidden" name="action" value="add-video-project">
   <input type="hidden" name="add-video-project" value="1">
   <input type="submit" name="submit" id="submit" value="Add Video Project">
   <?php wp_nonce_field( 'add-video-project-action', 'add-video-project-nonce' ); ?>
</form>

</div><!----End column---->

<div class="vps-column">

<h2>View all video projects</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
   <input type="hidden" name="action" value="view-all-video-projects">
   <input type="hidden" name="view-all-video-projects" value="1">
   <input type="submit" name="submit" id="submit" value="View all Video Projects">
   <?php wp_nonce_field( 'view-all-video-projects-action', 'view-all-video-projects-nonce' ); ?>
</form>

</div><!----End column---->

</div><!----End row--->



</div><!----End wrapper--->

</div><!---End main div--->
