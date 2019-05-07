<div class="vps-main-page-div">

<h1>Add a new video project</h1>
<form action="<?php echo esc_url( admin_url('admin.php?page=video-project')); ?>" method="post">
<?php wp_nonce_field( 'insert-video-project-form-action', 'insert-video-project-form-nonce' ); ?>
<table class="form-table">
    <tbody>
    	<tr>
        	<th>
        		<label for="video-category">Select a category for this video</label>
        	</th>
        	<td>
        		<label><input checked type="radio" id="weddings" name="video-category" value="weddings">Weddings
                </label>
        		<label><input type="radio" id="music-video" name="video-category" value="music-video">Music Video
                </label>
        		<label><input type="radio" id="commercial-video" name="video-category" value="commercial-video">Commercial Video</label>
        	</td>
        </tr>
        <tr>
        	<th>
        		<label for="country">Select a country where the video was filmed</label>
        	</th>
        	<td>
        		<div id="countries">
        		<label><input checked type="radio" id="ireland" name="country" value="ireland">Ireland</label>
        		<label><input type="radio" id="australia" name="country" value="australia">Australia</label>
        		<label><input type="radio" id="spain" name="country" value="spain">Spain</label>
        		<label><input type="radio" id="germany" name="country" value="germany">Germany</label>
        		<label><input type="radio" id="morocco" name="country" value="morocco">Morocco</label>
        		<label><input type="radio" id="france" name="country" value="france">France</label>
        		<label><input type="radio" id="usa" name="country" value="usa">USA</label>
        	    </div>
        	    <br />
                <label><input type="radio" id="add-new-country" name="country" value="add-new-country">Other</label>
        		<label id="new-country-text-input"></label>
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
        		<p><small>Enter a duration eg 2 weeks, 3 months.</small></p>
        	</th>
        	<td>
        		<input class="regular-text" id="duration" name="duration" type="text" value="">
        	</td>
        </tr>
        <tr>
        	<th>
        		<label for="video-project-image">Image</label>
        		<p><small>Click the upload button to choose an image from the media library.</small></p>
        	</th>
        	<td>
        		<input class="regular-text" id="video-project-image" name="video-project-image" type="text" value="">
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