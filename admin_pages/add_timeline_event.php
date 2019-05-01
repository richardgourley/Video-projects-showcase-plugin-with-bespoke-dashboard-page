<div class="wppd_results_display_div">

<form action="<?php echo esc_url( admin_url('admin.php?page=bespoke_admin_page')); ?>" method="post">
<?php wp_nonce_field( 'insert_timeline_event_action', 'insert_timeline_event_nonce' ); ?>
<table class="form-table">
	<tbody>
		<tr>
		<th scope="row">
		    <label for="date">Date</label>
		</th>
		<td>
            <input class="regular-text" id="date" name="date" type="date" value="">
	    </td>
	    </tr>
	    <tr>
	    <th>
	    	<label for="title_of_event">Title</label>
	    </th>
	    <td>
	    	<input class="regular-text" id="title_of_event" name="title_of_event" type="text" value="">
	    </td>
	    </tr>
	    <tr>
	    <th>
	    	<label for="description_of_event">Description</label>
	    </th>
	    <td>
	    	<textarea id="description_of_event" name="description_of_event" value="" rows="5"></textarea>
	    </td>
	    </tr>
	    <tr>
	    <th>
	    	<label for="select_image">Image</label>
	    </th>
	    <td>
	    	<input class="regular-text" id="select_image" name="select_image" type="text" value=""> <input class="button bespoke_admin_page_button" id="upload_button" name="select_image_button" type="button" value="Upload" />
	    </td>
	    </tr>
	    <tr>
	    <th>
	    	<label for="submit">Add timeline event</label>
	    </th>
	    <td>
	    	<input class="regular-text" id="submit" name="submit" type="submit" value="Submit">
	    </td>
	    </tr>
	</tbody>
</table>
</form>

</div>