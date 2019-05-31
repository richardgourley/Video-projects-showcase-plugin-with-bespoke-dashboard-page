<div class="vps-main-page-div">

<div class="vps-main-page-greeting">
<h1>Hello there <span class="vps-username-box"><?php echo esc_html(wp_get_current_user()->user_nicename); ?></span></h1>
</div>
<div class="vps-main-page-header">
<h1 class="vps-main-page-header-font">Welcome to your bespoke admin page!</h1>
</div>

<div><h3>Intro</h3></div>
<div><p>Here, you can create, update, insert and manage all of your video projects.</p></div>
<div><p>We hope this page makes it very quick and very easy to manage bespoke content for your site all in 1 place.</p></div>

<div class="vps-row">
<div class="vps-col-5">

<h2>Add video project</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
   <input type="hidden" name="action" value="add-video-project">
   <input type="hidden" name="add-video-project" value="1">
   <input type="submit" name="submit" id="submit" value="Add Video Project">
   <?php wp_nonce_field( 'create-video-project-form-action', 'create-video-project-form-nonce' ); ?>
</form>

</div><!----End column---->

<div class="vps-col-5">

<h2>View all and update video projects</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
   <input type="hidden" name="action" value="view-all-video-projects">
   <input type="hidden" name="view-all-video-projects" value="1">
   <input type="submit" name="submit" id="submit" value="View all Video Projects">
   <?php wp_nonce_field( 'view-all-video-projects-action', 'view-all-video-projects-nonce' ); ?>
</form>

</div><!----End column---->

<div class="vps-col-5">

<h2>Delete a video project</h2>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
   <input type="hidden" name="action" value="delete-video-project">
   <input type="hidden" name="delete-video-project" value="1">
   <input type="submit" name="submit" id="submit" value="Choose project to delete">
   <?php wp_nonce_field( 'delete-video-project-form-action', 'delete-video-project-form-nonce' ); ?>
</form>

</div><!----End column---->

</div><!----End row--->

</div><!---End main div--->
