<div class="vps_main_page_div">

<div class="vps_main_page_greeting">
<h1>Hello there <span class="vps_username_box"><?php echo esc_html(wp_get_current_user()->user_nicename); ?></span></h1>
</div>
<div class="vps_main_page_header">
<h1 class="vps_main_page_header_font">Welcome to your bespoke admin page!</h1>
</div>


<div><h3>Intro</h3></div>
<div><p>Here, you can create, update, insert and manage all of your custom post types.</p></div>
<div><p>We hope this page makes it very quick and very easy to manage the bespoke content for your site all in 1 place.</p></div>

<div class="vps_menu_buttons_wrapper">
<div class="vps_row">
<div class="vps_column">

<h2>Add video project</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video_project')); ?>" method="post">
   <input type="hidden" name="action" value="add_video_project">
   <input type="hidden" name="add_video_project" value="1">
   <input type="submit" name="submit" id="submit" value="Add Video Project">
   <?php wp_nonce_field( 'add_video_project_action', 'add_video_project_nonce' ); ?>
</form>

</div><!----End column---->

<div class="vps_column">

<h2>View all video projects</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video_project')); ?>" method="post">
   <input type="hidden" name="action" value="view_all_video_projects">
   <input type="hidden" name="view_all_video_projects" value="1">
   <input type="submit" name="submit" id="submit" value="View all Video Projects">
   <?php wp_nonce_field( 'view_all_video_projects_action', 'view_all_video_projects_nonce' ); ?>
</form>

</div><!----End column---->

</div><!----End row--->



</div><!----End wrapper--->

</div><!---End main div--->
