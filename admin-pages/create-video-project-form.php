<div class="vps-main-page-div">

<h1>Add a new video project</h1>

<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
<?php wp_nonce_field( 'create-video-project-action', 'create-video-project-nonce' ); ?>
  <table class="form-table">
    <tbody>
      <tr>
        <th>
          <label for="category">Select a video category for this video</label>
        </th>
        <td>
          <?php
          $video_project_category_terms = get_terms( array(
              'taxonomy' =>   'video_project_category',
              'hide_empty' => false
          ));

          foreach($video_project_category_terms as $term):
          ?>
          <label>
            <input checked type="radio" id="<?php echo esc_html( $term->slug ); ?>" 
            name="category" value="<?php echo esc_html( $term->slug ); ?>">
            <?php echo esc_html( $term->name); ?>
          </label>
          <?php endforeach; ?>
        </td>
      </tr>
      <tr>
        <th>
          <label for="country">Select a country where the video was filmed</label>
        </th>
        <td>
          <div id="countries">
            <?php
            $video_project_country_terms = get_terms( array(
                'taxonomy' =>   'video_project_country',
                'hide_empty' => false
            ));

            foreach($video_project_country_terms as $term):
            ?>
            <label>
              <input checked type="radio" id="<?php echo esc_html( $term->slug ); ?>" 
              name="country" value="<?php echo esc_html( $term->slug ); ?>">
              <?php echo esc_html( $term->name ); ?>
            </label>
            <?php endforeach ?>
          </div>
            	    
          <br />
          <br />
          <label>
            <input type="radio" id="other" name="country" value="other">Other
          </label>
          <input placeholder="Enter country" type="text" id="new-country" name="new-country" 
          value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="title">Title</label>
          <p><small>Enter the project name or the name of the customer or client.</small></p>
        </th>
        <td>
          <input class="regular-text" id="title" name="title" type="text" value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="location">Location</label>
          <p><small>Enter the town or city of the project.</small></p>
        </th>
        <td>
          <input class="regular-text" id="location" name="location" type="text" value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="date">Date</label>
          <p><small>Select a date for the project.</small></p>
        </th>
        <td>
          <input class="regular-text" id="date" name="date" type="date" value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="duration">Duration</label>
          <p><small>Enter a duration for the project - 2 weeks, 3 months etc.</small></p>
        </th>
        <td>
          <input class="regular-text" id="duration" name="duration" type="text" value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="image-url">Image</label>
          <p><small>Click the upload button to choose an image from the media library.</small></p>
        </th>
        <td>
          <input class="regular-text" id="image-url" name="image-url" type="text" value="">
          <input class="button insert-video-project-form_button" id="upload-image-video-project" name="video-project-button" type="button" value="Upload"/>
        </td>
      </tr>
      <tr>
        <th>
          <label for="video-url">Video Url</label>
          <p><small>Enter the url of the video for this project (Vimeo or youtube link etc.)</small></p>
        </th>
        <td>
          <input class="regular-text" id="video-url" name="video-url" type="text" value="">
        </td>
      </tr>
      <tr>
        <th>
          <label for="submit">Add new Video Project</label>
        </th>
        <td>
          <input type="submit" value="Submit">
        </td>
      </tr>
    </tbody>
  </table>
</form> <!---End form--->

</div><!---End main div--->
