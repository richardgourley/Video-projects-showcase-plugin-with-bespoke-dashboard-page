<div class="vps_main_page_div">

<h1>Add a new video project</h1>
<form action="<?php echo esc_url( admin_url('admin.php?page=video_project')); ?>" method="post">
<?php wp_nonce_field( 'insert_video_project_form_action', 'insert_video_project_form_nonce' ); ?>
<table class="form-table">
    <tbody>
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
        		<p><small>Enter the location of the project.</small></p>
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
        		<label for="date">Duration</label>
        		<p><small>Enter a duration eg 2 weeks, 3 months.</small></p>
        	</th>
        	<td>
        		<input class="regular-text" id="duration" name="duration" type="text" value="">
        	</td>
        </tr>
        <tr>
        	<th>
        		<label for="image">Image</label>
        		<p><small>Click the button to see and choose an image from the media library.</small></p>
        	</th>
        	<td>
        		<input class="regular-text" id="image" name="image" type="text" value="">
        		<input class="button insert_video_project_form_button" id="upload_insert_video_project" name="video_project_button" type="button" value="upload"/>
        	</td>
        </tr>
    </tbody>
</table>
</form> <!---End form--->

</div><!---End main div--->
