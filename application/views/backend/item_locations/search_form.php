<div class='row my-3'>

	<div class='col-9'>
	<?php
		$attributes = array('class' => 'form-inline');
		echo form_open( $module_site_url .'/search', $attributes);
	?>
		
		<div class="form-group mr-3">

			<?php echo form_input(array(
				'name' => 'searchterm',
				'value' => set_value( 'searchterm' ),
				'class' => 'form-control form-control-sm',
				'placeholder' => get_msg( 'btn_search' )
			)); ?>

	  	</div>

		<div class="form-group">
		  	<button type="submit" class="btn btn-sm btn-primary">
		  		<?php echo get_msg( 'btn_search' )?>
		  	</button>
	  	</div>

	  	<div class="row">
	  		<div class="form-group ml-3">
			  	<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
					  		<?php echo get_msg( 'btn_reset' ); ?>
				</a>
			</div>
		</div>
	
	<?php echo form_close(); ?>

	</div>	

	<div class='col-3'>
	   <a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right mx-1'>
			<span class='fa fa-plus'></span> 
			<?php echo get_msg( 'location_add' )?>
		</a>
		<button type="button" class='btn btn-sm btn-primary pull-right mx-1' data-toggle="modal" data-target="#exampleModal">
			<span class='fa fa-plus'></span> 
			Bulk Upload
		</button>
	</div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Upload Locations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="import_csv" enctype="multipart/form-data">
        	<input type="hidden" name="csrf_test_name" value="28147c3a4942b0ea4ef77b23d64deade">
        	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>File Locations Upload (*)</label>
			  	<input type="file" name="csv_file" id="csv_file" class="form-control" required accept=".csv" /><br>
		  	</div>
		  	<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
		  	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<!---<label>Download Items Sample</label> ---->
			  	<!--<a href="<?php echo base_url();?>csv_sample/book1.csv" download>Download bulk upload location sample file</a> ---->
		  	</div>
			<div id="message" style="display: none;">
				<div class="alert alert-success" role="alert">
				  Bulk upload locations saved successfully!
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
	
<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>
	function jqvalidate() {
	$('#cat_id').on('change', function() {

			var catId = $(this).val();
			
			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_sub_categories/';?>' + catId,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#sub_cat_id').html("");
					$.each(data, function(i, obj){
					    $('#sub_cat_id').append('<option value="'+ obj.id +'">' + obj.name + '</option>');
					});
					$('#name').val($('#name').val() + " ").blur();
				}
			});
		});
}
	<?php endif; ?>

$('#import_csv').on('submit', function(event){
	event.preventDefault();
	$.ajax({
		url:"<?php echo $module_site_url .'/import';?>",
		method:"POST",
		data:new FormData(this),
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

		}
	})
});
</script>
