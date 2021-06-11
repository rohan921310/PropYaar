<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('item_name'); ?></th>
			<th><?php echo get_msg('Price'); ?></th>
			<th><?php echo get_msg('cat_name'); ?></th>
			<th><?php echo get_msg('Location'); ?></th>
			<th><?php echo get_msg('status_label'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			<th>Images</th>
		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $items ) && count( $items->result()) > 0 ): ?>
		<?php $rn=1; ?>
		<?php foreach($items->result() as $item): ?>
		
			<tr>
				<td><?php if($mapitem){ echo $rn ;}else{echo ++$count;} $rn++;?></td>
				<td><?php echo $item->title;?></td>
				<td><?php echo $item->price;?></td>
				<td><?php echo $this->Category->get_one( $item->cat_id )->cat_name; ?></td>
				<td><?php echo $this->Itemlocation->get_one( $item->item_location_id )->name; ?></td>
				<td>
					<?php if ($item->status == 1) {
						echo "Published";
						} elseif ($item->status == 2) {
							echo "Disable";
						}elseif($item->status == 0){
							echo "Not Published";
						}elseif($item->status == 4){
							echo "In Draft";
						}else{
							echo "Rejected";
						}
						
					?>
				</td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $item->id; ?>'>
							<i class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo "$item->id";?>">
							<i class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				<td>
					<button type="button" class='btn btn-sm btn-primary opne_model' data-toggle="modal" id="open_modal" data-target="#imageModal" data-id="<?php echo $item->id;?>">
						<span class='fa fa-plus'></span> 
						Upload Images
					</button>
				</td>
			</tr>

		<?php endforeach; ?>

	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

	<?php endif; ?>

</table>
</div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Upload Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="_imgClose">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="import_csv_img" enctype="multipart/form-data">
        	<input type="hidden" name="csrf_test_name" value="28147c3a4942b0ea4ef77b23d64deade">
        	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>File Images Upload (*)</label>
			  	<input type="file" name="csv_img_file" id="csv_img_file" class="form-control" required accept=".csv" /><br>
			  	<input type="hidden" name="id" id="csv_id" value="" class="form-control">
		  	</div>
		  	<button type="submit" name="import_csv_img" class="btn btn-info" id="import_csv_img_btn">Import CSV</button>
		  	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>Download Images Sample</label>
			  	<a href="<?php echo base_url();?>csv_sample/images.csv" download>Download bulk images sample file</a>
		  	</div>
			<div id="message" style="display: none;">
				<div class="alert alert-success" role="alert">
				  Bulk upload images saved successfully!
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
<script type="text/javascript">
	$('#import_csv_img').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:"<?php echo $module_site_url .'/image_upload';?>",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(){
				$('#import_csv_img_btn').html('Importing...');
			},
			success:function(data)
			{
				$('#import_csv_img')[0].reset();
				$('#import_csv_img_btn').attr('disabled', false);
				if(data == 1){
					$('#import_csv_img_btn').html('Import Done');
					$("#message").show();
					setTimeout(function () { 
				        location.reload(true); 
				    }, 1000); 
				}

			}
		})
	});

	$(".opne_model").on('click',function(){
		var id = $(this).attr('data-id');
        $('#csv_id').val(id);
	});
</script>
