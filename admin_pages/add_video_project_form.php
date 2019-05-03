<div class="vps_main_page_div">

<h1>Add a new video project</h1>
<form action="<?php echo esc_url( admin_url('admin.php?page=video_project')); ?>" method="post">
<?php wp_nonce_field( 'insert_video_project_form_action', 'insert_video_project_form_nonce' ); ?>
<table class="form-table">
    <tbody>
        <tr>
        	<th>
        		Hello
        	</th>
        	<td>
        		I'm the data
        	</td>
        </tr>
        <tr>
        	<th>
        		Hello 2
        	</th>
        	<td>
        		I'm the data2
        	</td>
        </tr>
    </tbody>
</table>
</form> <!---End form--->

</div><!---End main div--->
