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
        		<input class="regular-text" id="title" name="title" type="text">
        	</td>
        </tr>
        <tr>
        	<th>
        		<label for="location">Location</label>
        		<p><small>Enter the location of the project.</small></p>
        	</th>
        	<td>
        		<input class="regular-text" id="location" name="location" type="text">
        	</td>
        </tr>
        <tr>
        	<th>
        		
        	</th>
        	<td>
        		
        	</td>
        </tr>
    </tbody>
</table>
</form> <!---End form--->

</div><!---End main div--->
