
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('Agents Information')?></h3>
		    </div>
	        <!-- /.card-header -->
	        <div class="card-body">
	            <div class="row">
	            	<div class="col-md-12">
	            		<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'name',
								'value' => set_value( 'name', show_data( @$agents->name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Name' ),
								'id' => 'name'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Phone Number')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'phone_number',
								'value' => set_value( 'phone_number', show_data( @$agents->phone_number ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Phone Number' ),
								'id' => 'phone_number'
							)); ?>
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
								'value' => set_value( 'location', show_data( @$agents->location ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Location' ),
								'id' => 'location'
							)); ?>
	              		</div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Info') ?>
                           </label>
                           <?php echo form_textarea(array(
                              'name' => 'info',
                              'value' => set_value('info', show_data(@$agents->info), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Info'),
                              'id' => 'info',
                              'rows' => "3"
                              )); ?>
                        </div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Rating
                           </label>
                           <select name="rating" class="form-control">
                              <?php if (empty($agents->rating)) { ?>
                              <option value="">Select Rating</option>
                              <?php } ?>
                              <option value="0" 
                                 <?php if ($agents->rating == "0") {
                                    echo "selected";
                                    } ?>>0
                              </option>
                              <option value="1" 
                                 <?php if ($agents->rating == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($agents->rating == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($agents->rating == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
							  <option value="4" 
                                 <?php if ($agents->rating == "4") {
                                    echo "selected";
                                    } ?>>4
                              </option>
							  <option value="5" 
                                 <?php if ($agents->rating == "5") {
                                    echo "selected";
                                    } ?>>5
                              </option>
                           </select>
                        </div>

						<div class="form-group" style="padding-top: 30px;" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_open',
                                 'id' => 'is_open',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_open', 1, (@$agents->is_open == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Open'); ?>
                              </label>
                           </div>
                        </div>

						<div class="form-group" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_like',
                                 'id' => 'is_like',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_like', 1, (@$agents->is_like == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Like'); ?>
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