<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">

		<tr>
			<th><?php echo get_msg('no')?></th>
			<th><?php echo get_msg('user_name')?></th>
			<th><?php echo get_msg('user_email')?></th>
			<th><?php echo get_msg('City')?></th>
			<th><?php echo get_msg('Listing Count')?></th>
			<th><?php echo get_msg('user_phone')?></th>
			<th><?php echo get_msg('role')?></th>
			<th><?php echo get_msg('Actions')?></th>

		</tr>

		<?php $count = $this->uri->segment(4) or $count = 0; ?>

		<?php if ( !empty( $users ) && count( $users->result()) > 0 ): ?>
				
			<?php foreach($users->result() as $user): ?>
				
				<tr>
					<td><?php echo ++$count;?></td>
					<td><?php echo $user->user_name;?></td>
					<td><?php echo $user->user_email;?></td>
					<td><?php echo $user->city;?></td>
					<td><?php echo $user->listings_count;?></td>
					<td><?php echo $user->user_phone;?></td>
					<td><?php echo "Registered User";?></td>
					<td>
					    <div class="dropdown">
                          <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <?php if ( $this->ps_auth->has_access( EDIT )): ?>
							
					        	<a href='<?php echo $module_site_url .'/edit/'. $user->user_id; ?>'>
					        		<i style='font-size: 14px; padding:8px;' class='fa fa-pencil-square-o'>Edit</i>
					        	</a>
							</br>	
					        <?php endif; ?>


							<?php if ( $this->ps_auth->has_access( BAN )):?>
					
						        <?php if ( @$user->is_banned == 0 ): ?>
						        
						        	<button  style='font-size: 14px; margin:8px;' class="btn btn-sm btn-primary-green ban" userid='<?php echo @$user->user_id;?>'>
						        		<?php echo get_msg( 'user_ban' ); ?>
						        	</button>
						        
						        <?php else: ?>
						        	
						        	<button  style='font-size: 14px; margin:8px;' class="btn btn-sm btn-danger unban" userid='<?php echo @$user->user_id;?>'>
						        		<?php echo get_msg( 'user_unban' ); ?>
						        	</button>
						       
						        <?php endif; ?>
								</br>
				            <?php endif;?>

							<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
				            	
				            		<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $user->user_id;?>">
				            			<i style='font-size: 14px; padding:8px;' class='fa fa-trash-o'>Delete</i>
				            		</a>
				            	
				            
				            <?php endif; ?>

                          </div>
                        </div>
					</td>





				</tr>
			
			<?php endforeach; ?>

		<?php else: ?>
				
			<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

		<?php endif; ?>

	</table>
</div>