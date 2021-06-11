
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('Users Share Property Information')?></h3>
		    </div>
	        <!-- /.card-header -->
	        <div class="card-body">
	            <div class="row">
	            	<div class="col-md-12">
					    <div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Property Name')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
	    					        	</label>
        
						        	<?php echo form_input( array(
						        		'name' => 'property_name',
						        		'value' => set_value( 'property_name', show_data( @$realty_share_properties->property_name ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Property Name' ),
						        		'id' => 'property_name'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Item Id')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
	     					        	</label>
        
						        	<?php echo form_input( array(
						        		'name' => 'item_id',
						        		'value' => set_value( 'item_id', show_data( @$realty_share_properties->item_id ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Item Id' ),
						        		'id' => 'item_id',
						        		'readonly'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Price')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'price',
						        		'value' => set_value( 'price', show_data( @$realty_share_properties->price ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Price' ),
						        		'id' => 'price'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('No Users')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'no_users',
						        		'value' => set_value( 'no_users', show_data( @$realty_share_properties->no_users ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'No Users' ),
						        		'id' => 'no_users'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Per Annual Return')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'per_annual_return',
						        		'value' => set_value( 'per_annual_return', show_data( @$realty_share_properties->per_annual_return ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Per Annual Return' ),
						        		'id' => 'per_annual_return'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('No Investors')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'no_investors',
						        		'value' => set_value( 'no_investors', show_data( @$realty_share_properties->no_investors ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'No Investors' ),
						        		'id' => 'no_investors'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('No Waitlist')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'no_waitlist',
						        		'value' => set_value( 'no_waitlist', show_data( @$realty_share_properties->no_waitlist ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'No Waitlist' ),
						        		'id' => 'no_waitlist'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Financed Amount')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'financed_amount',
						        		'value' => set_value( 'financed_amount', show_data( @$realty_share_properties->financed_amount ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Financed Amount' ),
						        		'id' => 'financed_amount'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Purchase Price')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'purchase_price',
						        		'value' => set_value( 'purchase_price', show_data( @$realty_share_properties->purchase_price ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Purchase Price' ),
						        		'id' => 'purchase_price'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Raised Amount')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'raised_amount',
						        		'value' => set_value( 'raised_amount', show_data( @$realty_share_properties->raised_amount ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Raised Amount' ),
						        		'id' => 'raised_amount'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

				        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_live',
                                 'id' => 'is_live',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_live', 1, (@$realty_share_properties->is_live == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Live'); ?>
                              </label>
                           </div>
                        </div>
      
                        <div class="form-group" >
                           <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_funded',
                                 'id' => 'is_funded',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_funded', 1, (@$realty_share_properties->is_funded == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Funded'); ?>
                              </label>
                           </div>
                        </div>      

	              	</div>

	              
            		
	              		
	            <!-- /.row -->
	        	</div>
	        <!-- /.card-body -->
	   		</div>
	   		<?php 
				if ( isset( $condition )) { 
			?>
				<input type="hidden" id="edit_condition" name="edit_condition" value="1">
			<?php		
				} else {
			?>
				<input type="hidden" id="edit_condition" name="edit_condition" value="0">
			<?php } ?> 
			<div class="card-footer">
	            <button type="submit" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_save')?>
				</button>

				<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
					<?php echo get_msg('btn_cancel')?>
				</a>
	        </div>
	       
		</div>

	</div>
</section>
				

	
	

<?php echo form_close(); ?>