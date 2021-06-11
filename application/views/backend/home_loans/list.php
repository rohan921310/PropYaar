<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no'); ?></th>
			<th><?php echo get_msg('Listed User'); ?></th>
			<th><?php echo get_msg('Aadharcard Name'); ?></th>
			<th><?php echo get_msg('salary'); ?></th>
			<th><?php echo get_msg('Company Name'); ?></th>
			
			<?php if ( $this->ps_auth->has_access( EDIT )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_edit')?></span></th>
			
			<?php endif; ?>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><span class="th-title"><?php echo get_msg('btn_delete')?></span></th>
			
			<?php endif; ?>
			

		</tr>
		
	
	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $homeloans ) && count( $homeloans->result()) > 0 ): ?>

		<?php foreach($homeloans->result() as $homeloan): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td ><?php echo $this->User->get_one($homeloan->listed_user_id)->user_name ;?></td>
				<td ><?php echo $homeloan->aadharcard_name;?></td>
				<td ><?php echo $homeloan->salary;?></td>
				<td ><?php echo $homeloan->company_name;?></td>

				<?php if ( $this->ps_auth->has_access( EDIT )): ?>
			
					<td>
						<a href='<?php echo $module_site_url .'/edit/'. $homeloan->id; ?>'>
							<i style='font-size: 18px;' class='fa fa-pencil-square-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $homeloan->id;?>">
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

