<div class='row my-3'>

	<div class='col-10'>
	<?php
		$attributes = array('class' => 'form-inline');
		echo form_open( $module_site_url .'/search', $attributes);
	?>
		
		<div class="form-group" style="padding-right: 3px;">

			<?php echo form_input(array(
				'name' => 'searchterm',
				'value' => set_value( 'searchterm' ),
				'class' => 'form-control form-control-sm',
				'placeholder' => get_msg( 'btn_search' )
			)); ?>

	  	</div>

		<div class="form-group" style="padding-right: 2px;">
		  	<button type="submit" class="btn btn-sm btn-primary">
		  		<?php echo get_msg( 'btn_search' )?>
		  	</button>
	  	</div>
	
		<div class="form-group">
		  	<a href='<?php echo $module_site_url .'/index';?>' class='btn btn-sm btn-primary'>
			<?php echo get_msg( 'btn_reset' )?>
		</a>
	  	</div>

	<?php echo form_close(); ?>

	</div>	

	<div class='col-2'>
       	<div class="form-group" style="display: inline-block;">
			<button type="button" class='btn btn-sm btn-primary pull-right' data-toggle="modal" data-target="#exampleModal">
				<span class='fa fa-plus'></span> 
				Bulk Upload
			</button>
		</div>
		<div class="form-group" style="display: inline-block;">
		   <a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right'>
		   	   <span class='fa fa-plus'></span> 
		   	   <?php echo get_msg( 'blog_add' )?>
		   </a>
		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Upload Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="import_csv" enctype="multipart/form-data">
        	<input type="hidden" name="csrf_test_name" value="28147c3a4942b0ea4ef77b23d64deade">
        	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>File Items Upload (*)</label>
			  	<input type="file" name="csv_file[]" id="csv_file" multiple class="form-control"  required accept=".csv,.jpg,.jpeg,.png,.gif" /><br>
		  	</div>
		  	<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
		  	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>Download Items Sample</label>
			  	<a href="<?php echo base_url();?>csv_sample/book1.csv" download>Download bulk upload items sample file</a>
		  	</div>
			<div id="message" style="display: none;">
				<div class="alert alert-success" role="alert">
				  Bulk upload items saved successfully!
				</div>
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
	
$('#import_csv').on('submit', function(event){
	event.preventDefault();
	var form_data = new FormData(this);

	for(var count = 0; count<csv_file.length; count++)
	{
		var name = files[count].name;
		form_data.append("csv_file[]", files[count]);
	}
	$.ajax({
		url:"<?php echo $module_site_url .'/import';?>",
		method:"POST",
		data:form_data, //new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		beforeSend:function(){
			$('#import_csv_btn').html('Importing...');
		},
		success:function(data)
		{
			$('#import_csv')[0].reset();
			$('#import_csv_btn').attr('disabled', false);
			if(data == 1){
				$('#import_csv_btn').html('Import Done');
				$("#message").show();
				setTimeout(function () { 
			        location.reload(true); 
			    }, 1000); 
			}
			else{
				$('#import_csv')[0].reset();
				alert(data);
			}
		}
	})
});
</script>