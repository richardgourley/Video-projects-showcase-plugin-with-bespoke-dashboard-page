<div class="vps-main-page-div">
    
  <div>
    <?php 
        //Determine if updating for the first time or if we have errors from an attempted update
        if( !$message == '' ){
            echo "There were errors in your form. Please check.<br />";
            echo "<p>$message</p>";
        }

        //Make sure using $post or assign $_POST to $post if not.
        if( $post == null || count( $post ) == 0){
            $post = $_POST;
        }

    ?>
  </div>

  <h1>Update <?php echo esc_html($post[ 'title' ]); ?> </h1>

  <form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
    <?php wp_nonce_field( 'update-video-project-action', 'update-video-project-nonce' ); ?>
    <input type="hidden" id="id" name="id" value="<?php echo $post['id']; ?>">
      <table class="form-table">
        <tbody>
          <tr>
            <th>
              <label for="category">Select a category for this video</label>
            </th>
            <td>
              <?php
              $video_project_category_terms = get_terms( array(
                  'taxonomy' =>   'video_project_category',
                  'hide_empty' => false
              ));
                
              foreach($video_project_category_terms as $term) {
                    
                  $checked = '';
                  if($term->slug == $post['category']){
                      $checked = 'checked';
                  }else{
                      $checked = '';
                  }
                  printf('<label><input %s type="radio" id=%s name="category" value=%s>%s</label> ',
                      $checked,
                      esc_html( $term->slug),
                      esc_html( $term->slug),
                      esc_html( $term->name)
                  );

              }
              ?>
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
                
                $new_country = true;

                foreach($video_project_country_terms as $country_term){
                    
                    if($country_term->slug == $post['country']){
                        //existing country selected - NOT a new country
                        $new_country = false;
                        //prints existing country with checked box
                        printf('<label><input checked type="radio" id=%s name="country" value=%s>%s</label> ',
                            esc_html( $country_term->slug),
                            esc_html( $country_term->slug),
                            esc_html( $country_term->name)
                        );
                    }else{
                        //prints existing country not checked
                        printf('<label><input type="radio" id=%s name="country" value=%s>%s</label> ',
                            esc_html( $country_term->slug),
                            esc_html( $country_term->slug),
                            esc_html( $country_term->name)
                        );
                    }
                }

                //other is checked or not and value printed or not depending if $new_country is true
                if($new_country){
                    $country = $post['new-country'];
                    echo
                        '<br /><br /><label><input checked type="radio" id="other" name="country" value="other">Other</label>
                        <input type="text" id="new-country" name="new-country" value="' . $country .'">';
                }else{
                    printf(
                        '<br /><br /><label><input type="radio" id="other" name="country" value="other">Other</label>
                        <input placeholder="Enter country" type="text" id="new-country" name="new-country" value="">'
                    ); 
                }

                ?>
              </div>
              <br />
            </td>
          </tr>
          <tr>
            <th>
              <label for="title">Title</label>
              <p><small>Enter the project name or the name of the customer or client.</small></p>
            </th>
            <td>
              <input class="regular-text" id="title" name="title" type="text" 
                value="<?php echo $post['title']; ?>">
            </td>
          </tr>
          <tr>
            <th>
              <label for="location">Location</label>
              <p><small>Enter the town or city of the project.</small></p>
            </th>
            <td>
              <input class="regular-text" id="location" name="location" type="text" 
                value="<?php echo $post['location']; ?>">
            </td>
          </tr>
          <tr>
            <th>
              <label for="date">Date</label>
              <p><small>Select a date for the project.</small></p>
            </th>
            <td>
              <input class="regular-text" id="date" name="date" type="date" 
                value="<?php echo $post['date']; ?>">
            </td>
          </tr>
          <tr>
            <th>
              <label for="duration">Duration</label>
              <p><small>Enter a duration eg 2 weeks, 3 months.</small></p>
            </th>
            <td>
              <input class="regular-text" id="duration" name="duration" type="text" 
                value="<?php echo $post['duration']; ?>">
            </td>
          </tr>
          <tr>
            <th>
              <label for="image-url">Image</label>
              <p><small>Click the upload button to choose an image from the media library.</small></p>
            </th>
            <td>
              <input class="regular-text" id="image-url" name="image-url" type="text" 
                value="<?php echo $post['image-url']; ?>">
              <input class="button insert-video-project-form_button" id="upload-image-video-project" 
                name="video-project-button" type="button" value="Upload"/>
            </td>
          </tr>
          <tr>
            <th>
              <label for="video-url">Video Url</label>
              <p><small>Enter the url of the video for this project (Vimeo or youtube link etc.)</small></p>
            </th>
            <td>
              <input class="regular-text" id="video-url" name="video-url" type="text" 
                value="<?php echo $post['video-url']; ?>">
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
