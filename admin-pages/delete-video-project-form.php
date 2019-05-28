<div class="vps-main-page-div">
<h1>Click the delete button under a project to delete it.</h1>
<p>CAUTION: This action can't be undone</p>

<div class="vps-row">
<?php 
foreach($video_projects->posts as $project):
?>
<div class="vps-col-11">
  <?php
      $title = esc_html( $project->post_title );
      $category_name = esc_html( get_post_meta( $project->ID, 'video_project_category', true ) );
      $category_slug = esc_html( get_term_by( 'name', $category_name, 'video_project_category' )->slug );
      $country_name = esc_html( get_post_meta( $project->ID, 'video_project_country', true ) );
      $country_slug = esc_html( get_term_by( 'name', $country_name, 'video_project_country' )->slug );
      $location = esc_html( get_post_meta( $project->ID, 'video_project_location', true ) );
      $date = esc_html( get_post_meta( $project->ID, 'video_project_date', true ) );
      $video_url = esc_url( get_post_meta( $project->ID, 'video_project_url', true ) );
  ?>
  <h3>Title: <?php echo $title; ?></h3>
  <p>ID: <?php echo $project->ID; ?></p>
  <p>Category: <?php echo $category_name; ?></p>
  <p>Country: <?php echo $country_name; ?></p>
  <p>Location: <?php echo $location; ?></p>
  <p>Date: <?php echo $date; ?></p>
  <p>Video URL: <?php echo $video_url; ?></p>
  <form method="post" action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>">
    <?php wp_nonce_field( 'delete-video-project-action', 'delete-video-project-nonce' ); ?>
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
    <input type="hidden" id="video-url" name="video-url"
    value="<?php echo $video_url; ?>">
    
    <input type="submit" value="DELETE PROJECT">
  </form>
</div> <!----End col---->
<?php
endforeach;
?>
</div><!---End row--->

</div><!---End main div--->
