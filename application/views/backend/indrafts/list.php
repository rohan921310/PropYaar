<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('item_name'); ?></th>
			<th><?php echo get_msg('cat_name'); ?></th>
			<th><?php echo get_msg('subcat_name'); ?></th>
			<th><?php echo get_msg('status_label'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			
		</tr>
	<?php $count = $this->uri->segment(4) or $count = 0; ?>
	<?php if ( !empty( $indrafts ) && count( $indrafts->result()) > 0 ): ?>
		<?php foreach($indrafts->result() as $indraft): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td><?php echo $indraft->title;?></td>
				<td><?php echo $this->Category->get_one( $indraft->cat_id )->cat_name; ?></td>
				<td><?php echo $this->Subcategory->get_one( $indraft->sub_cat_id )->name; ?></td>
				<td>
					<?php if ($indraft->status == 0) {
						echo "InDraft";
						} 
					?>
				</td>
				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $indraft->id; ?>'>
							<i class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo "$indraft->id";?>">
							<i class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>
	<?php endif; ?>
</table>
</div>