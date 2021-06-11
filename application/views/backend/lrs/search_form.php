<div class='row my-3'>
	<div class='col-9'>
		<?php
			$attributes = array('class' => 'form-inline');
				
			echo form_open( $module_site_url . '/search', $attributes );
		?>
			<div class="form-group mr-3">
				
				<?php echo form_input(array(
					'name' => 'searchterm',
					'value' => set_value( 'searchterm' ),
					'class' => 'form-control form-control-sm',
					'placeholder' => get_msg( 'btn_search' ),
					'id' => ''
				)); ?>

		  	</div>

			<div class="form-group mr-3">
			  	<button type="submit" class="btn btn-sm btn-primary">
			  		<?php echo get_msg( 'btn_search' ); ?>
			  	</button>
		  	</div>

		  	<div class="form-group">
			  	<a href="<?php echo $module_site_url ; ?>" class="btn btn-sm btn-primary">
			  		<?php echo get_msg( 'btn_reset' ); ?>
			  	</a>
		  	</div>
		
		<?php echo form_close(); ?>

	</div>

	<div class='col-2'>
		<div class="form-group" style="display: inline-block;">
		    <a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right'>
		    	<span class='fa fa-plus'></span> 
		    	<?php echo get_msg( 'Add LRS' )?>
		    </a>
		</div>
	</div>



</div>