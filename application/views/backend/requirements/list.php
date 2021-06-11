<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('User Name'); ?></th>
			<th><?php echo get_msg('Phone Number'); ?></th>
			<th><?php echo get_msg('City Name'); ?></th>
			<!--<th><?php echo get_msg('Requirement'); ?></th>---->
			<!--
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			--->

			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			
		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $requirements ) && count( $requirements->result()) > 0 ): ?>

		<?php foreach($requirements->result() as $requirement): ?>
			<?php  $user_info= $this->User->get_one($requirement->user_id); ?>
			<tr>
				<td><?php echo ++$count;?></td>
				
				<td ><?php echo $user_info->user_name ;?> </td>
				<td ><?php echo $user_info->user_phone ;?></td>
				<td><?php echo $this->Itemlocation->get_one($requirement->location_id)->name; ?></td>
				<!---<td ><?php echo $requirement->requirement;?></td>---->
			   <!----
				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $requirement->id; ?>'>
							<i style='font-size: 18px;' class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				---->
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $requirement->id;?>">
							<i style='font-size: 18px;' class='fa fa-trash-o'></i>
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

