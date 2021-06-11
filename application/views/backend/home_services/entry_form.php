
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('Builders Information')?></h3>
		    </div>
	        <!-- /.card-header -->
	        <div class="card-body">
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('User Id')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'user_id',
								'value' => set_value( 'user_id', show_data( @$homeservices->user_id ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'User Id' ),
								'id' => 'user_id'
							)); ?>
	              		</div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
						       Home Services Category
                           </label>
                           <select name="home_services_category" class="form-control">
                              <?php if (empty($homeservices->home_services_category)) { ?>
                              <option value="">Select Home Services Category</option>
                              <?php } ?>
                              <option value="sanitization" 
                                 <?php if ($homeservices->home_services_category == "sanitization") {
                                    echo "selected";
                                    } ?>>Sanitization
                              </option>
                              <option value="cleaning" 
                                 <?php if ($homeservices->home_services_category == "cleaning") {
                                    echo "selected";
                                    } ?>>Cleaning
                              </option>
                              <option value="painting" 
                                 <?php if ($homeservices->home_services_category == "painting") {
                                    echo "selected";
                                    } ?>>Painting
                              </option>
							  <option value="movers" 
                                 <?php if ($homeservices->home_services_category == "movers") {
                                    echo "selected";
                                    } ?>>Movers
                              </option>
							  <option value="laundry" 
                                 <?php if ($homeservices->home_services_category == "laundry") {
                                    echo "selected";
                                    } ?>>Laundry
                              </option>
                           </select>
                        </div>  

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Location')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>
							<?php echo form_input( array(
								'name' => 'location',
								'value' => set_value( 'location', show_data( @$homeservices->location ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Location' ),
								'id' => 'Location'
							)); ?>
	              		</div>

				      	<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('itm_address_label') ?>
                           </label>
                           <?php echo form_textarea(array(
                              'name' => 'address',
                              'value' => set_value('address', show_data(@$homeservices->address), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('itm_address_label'),
                              'id' => 'address',
                              'rows' => "5"
                              )); ?>
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