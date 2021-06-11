<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('User Name'); ?></th>
			<th><?php echo get_msg('Location'); ?></th>
			<th><?php echo get_msg('Services'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			

		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $homeservices ) && count( $homeservices->result()) > 0 ): ?>

		<?php foreach($homeservices->result() as $homeservice): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td ><?php echo $this->User->get_one($homeservice->user_id)->user_name ;?></td>
				<td ><?php echo $homeservice->location;?></td>
				<td ><?php echo $homeservice->home_services_category;?></td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $homeservice->id; ?>'>
							<i style='font-size: 18px;' class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $homeservice->id;?>">
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

