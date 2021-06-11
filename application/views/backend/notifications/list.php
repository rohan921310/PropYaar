<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('User Name'); ?></th>
			<th><?php echo get_msg('Title'); ?></th>
			<th><?php echo get_msg('Date'); ?></th>
			<!-----
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			------>
			<!---
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( PUBLISH )): ?>
				
				<th><span class="th-title"><?php echo get_msg('Verify')?></span></th>
			
			<?php endif; ?>
            ---->
		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $notifications ) && count( $notifications->result()) > 0 ): ?>

		<?php foreach($notifications->result() as $notification): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td ><?php echo $this->User->get_one($notification->user_id)->user_name ;?></td>
				<td ><?php echo $notification->title;?></td>
				<td ><?php echo $notification->added_date;?></td>

				<?php $default_photo = get_default_photo( $business_user->id, 'category-icon' ); ?>	

				<!-----
				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $business_user->user_id; ?>'>
							<i style='font-size: 18px;' class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $business_user->user_id;?>">
							<i style='font-size: 18px;' class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( PUBLISH )): ?>
					
					<td>
						<?php if ( @$business_user->is_verified == 1): ?>
							<button class="btn btn-sm btn-success unpublish" catid='<?php echo $business_user->user_id;?>'>
							<?php echo get_msg('Verified'); ?></button>
						<?php else:?>
							<button class="btn btn-sm btn-danger publish" catid='<?php echo $business_user->user_id;?>'>
							<?php echo get_msg('Not verified'); ?></button></button><?php endif;?>
					</td>
				
				<?php endif; ?>
                ------>
			</tr>

		<?php endforeach; ?>

	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

	<?php endif; ?>

</table>
</div>

