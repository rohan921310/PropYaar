<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('Property Name'); ?></th>
			<th><?php echo get_msg('User Name'); ?></th>
			<th><?php echo get_msg('Is Paid'); ?></th>
			<th><?php echo get_msg('Paid Amount'); ?></th>
			<th><?php echo get_msg('Is Following'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			<!--	
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			---->
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
			<!---	
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			----->
			<?php endif; ?>
			

		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $users_share_properties ) && count( $users_share_properties->result()) > 0 ): ?>

		<?php foreach($users_share_properties->result() as $users_share_property): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td><?php echo $users_share_property->realty_share_property_id;?></td>
				<td><?php echo $users_share_property->user_id;?></td>
				<td><?php echo $users_share_property->is_paid;?></td>
				<td><?php echo $users_share_property->amount_paid;?></td>
				<td><?php echo $users_share_property->is_following;?></td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			<!---
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $users_share_property->id; ?>'>
							<i style='font-size: 18px;' class='fa fa-pencil-square-o'></i>
						</a>
					</td>
			------->	
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
			<!---		
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $users_share_property->id;?>">
							<i style='font-size: 18px;' class='fa fa-trash-o'></i>
						</a>
					</td>
			----->	
				<?php endif; ?>
				

			</tr>

		<?php endforeach; ?>

	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

	<?php endif; ?>

</table>
</div>

