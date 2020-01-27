<div class="vps-main-page-div">

  <?php
      //var to count how many video projects exist in the database
      $video_count = count( $video_projects->posts );
      if( $video_count == 0 ):
  ?>
  <h2>You don't have any video projects saved yet! Click 'Add Video Project' to start adding projects.</h2>
  <?php 
      endif;
      //exit if no video projects exist
      exit();
  ?>

  <h1>Click the delete button under a project to delete it.</h1>
  <p>CAUTION: This action can't be undone</p>

  <div>
    <?php 
    foreach($video_projects->posts as $project):
    ?>
    <div class="vps-project-display-admin-div">
      <?php
          $title = esc_html( $project->post_title );
          $category_name = esc_html( get_post_meta( $project->ID, 'video_project_category_name', true ) );
          $category_slug = esc_html( get_post_meta( $project->ID, 'video_project_category_slug', true ) );
          $country_name = esc_html( get_post_meta( $project->ID, 'video_project_country_name', true ) );
          $country_slug = esc_html( get_post_meta( $project->ID, 'video_project_country_slug', true ) );
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
