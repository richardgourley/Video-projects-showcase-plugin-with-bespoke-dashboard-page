<div class="vps-main-page-div">
<h1>Click the update button under any project to amend it.</h1>
<?php  ?>

<div class="vps-row">
<?php 
foreach($video_projects->posts as $project):
?>
<div class="vps-col-10">
  <?php
      $title = esc_html( $project->post_title );
      $category_name = esc_html( get_post_meta( $project->ID, 'video_project_category_name', true ) );
      $category_slug = esc_html( get_post_meta( $project->ID, 'video_project_category_slug', true ) );
      $country_name = esc_html( get_post_meta( $project->ID, 'video_project_country_name', true ) );
      $country_slug = esc_html( get_post_meta( $project->ID, 'video_project_country_slug', true ) );
      $location = esc_html( get_post_meta( $project->ID, 'video_project_location', true ) );
      $date = esc_html( get_post_meta( $project->ID, 'video_project_date', true ) );
      $duration = esc_html( get_post_meta( $project->ID, 'video_project_duration', true ) );
      $video_url = esc_url( get_post_meta( $project->ID, 'video_project_url', true ) );
      $image_url = esc_url( get_post_meta( $project->ID, 'video_project_image', true ) );
  ?>
  <h3>Title: <?php echo $title; ?></h3>
  <p>Category: <?php echo $category_name; ?></p>
  <p>Country: <?php echo $country_name; ?></p>
  <p>Location: <?php echo $location; ?></p>
  <p>Date: <?php echo $date; ?></p>
  <p>Duration: <?php echo $duration; ?></p>
  <p>Video URL: <?php echo $video_url; ?></p>
  <p>Image URL: <?php echo $image_url; ?></p>
  <form method="post" action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>">
    <?php wp_nonce_field( 'update-video-project-form-action', 'update-video-project-form-nonce' ); ?>
    <input type="hidden" id="id" name="id" value="<?php echo $project->ID; ?>">
    <input type="hidden" id="title" name="title" value="<?php echo $title; ?>">
    <input type="hidden" id="category" name="category"
    value="<?php echo $category_slug; ?>">
    <input type="hidden" id="country" name="country"
    value="<?php echo $country_slug; ?>">
    <input type="hidden" id="location" name="location"
    value="<?php echo $location; ?>">
    <input type="hidden" id="date" name="date"
    value="<?php echo $date; ?>">
    <input type="hidden" id="duration" name="duration"
    value="<?php echo $duration; ?>">
    <input type="hidden" id="image-url" name="image-url"
    value="<?php echo $image_url; ?>">
    <input type="hidden" id="video-url" name="video-url"
    value="<?php echo $video_url; ?>">
    
    <input type="submit" value="Update">
  </form>
</div>
<?php
endforeach;
?>
</div><!---End row--->

</div><!---End main div--->
