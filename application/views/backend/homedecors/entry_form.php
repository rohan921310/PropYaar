
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('Homedecors Information')?></h3>
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
								'value' => set_value( 'name', show_data( @$homedecors->name ), false ),
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
								'value' => set_value( 'phone_number', show_data( @$homedecors->phone_number ), false ),
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
								'value' => set_value( 'location', show_data( @$homedecors->location ), false ),
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
                              'value' => set_value('info', show_data(@$homedecors->info), false),
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
                              <?php if (empty($homedecors->rating)) { ?>
                              <option value="">Select Rating</option>
                              <?php } ?>
                              <option value="0" 
                                 <?php if ($homedecors->rating == "0") {
                                    echo "selected";
                                    } ?>>0
                              </option>
                              <option value="1" 
                                 <?php if ($homedecors->rating == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($homedecors->rating == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($homedecors->rating == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
							  <option value="4" 
                                 <?php if ($homedecors->rating == "4") {
                                    echo "selected";
                                    } ?>>4
                              </option>
							  <option value="5" 
                                 <?php if ($homedecors->rating == "5") {
                                    echo "selected";
                                    } ?>>5
                              </option>
                           </select>
                        </div>



						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('City Name')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'city_name',
						        		'value' => set_value( 'city_name', show_data( @$homedecors->city_name ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'City Name' ),
						        		'id' => 'city_name'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Builtup Area')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'builtup_area',
						        		'value' => set_value( 'builtup_area', show_data( @$homedecors->builtup_area ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Builtup Area' ),
						        		'id' => 'builtup_area'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>  

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
                                   <label>
                                   <span style="font-size: 17px; color: red;">*</span>
                                     Floor Plan
                                   </label>
                                   <select name="floor_plan" class="form-control">
                                      <?php if (empty($homedecors->floor_plan)) { ?>
                                      <option value="">Select Floor Plan</option>
                                      <?php } ?>
                                      <option value="1bhk" 
                                         <?php if ($homedecors->floor_plan == "1bhk") {
                                            echo "selected";
                                            } ?>>1BHK
                                      </option>
                                      <option value="2bhk" 
                                         <?php if ($homedecors->floor_plan == "2bhk") {
                                            echo "selected";
                                            } ?>>2BHK
                                      </option>
                                      <option value="3bhk" 
                                         <?php if ($homedecors->floor_plan == "3bhk") {
                                            echo "selected";
                                            } ?>>3BHK
                                      </option>
						        	  <option value="+3bhk" 
                                         <?php if ($homedecors->floor_plan == "+3bhk") {
                                            echo "selected";
                                            } ?>>+3BHK
                                      </option>
                                   </select>
                                </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
                                   <label>
                                   <span style="font-size: 17px; color: red;">*</span>
								     Purpose
                                   </label>
                                   <select name="purpose" class="form-control">
                                      <?php if (empty($homedecors->purpose)) { ?>
                                      <option value="">Select Purpose</option>
                                      <?php } ?>
                                      <option value="move in" 
                                         <?php if ($homedecors->purpose == "move in") {
                                            echo "selected";
                                            } ?>>Move In
                                      </option>
                                      <option value="rent out" 
                                         <?php if ($homedecors->purpose == "rent out") {
                                            echo "selected";
                                            } ?>>Rent Out
                                      </option>
                                      <option value="rennovate" 
                                         <?php if ($homedecors->purpose == "rennovate") {
                                            echo "selected";
                                            } ?>>Rennovate
                                      </option>
                                   </select>
                                </div>
                           </div>
                        </div>

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Wardobe Count')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'wardobe_count',
						        		'value' => set_value( 'wardobe_count', show_data( @$homedecors->wardobe_count ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Wardobe Count' ),
						        		'id' => 'wardobe_count'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Entertainment Count')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'entertainment_count',
						        		'value' => set_value( 'entertainment_count', show_data( @$homedecors->entertainment_count), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Entertainment Count' ),
						        		'id' => 'entertainment_count'
						        	)); ?>
	              		        </div>
                           </div>
                        </div> 

						<div class="row">
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Study Count')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'study_count',
						        		'value' => set_value( 'study_count', show_data( @$homedecors->study_count ), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Study Count' ),
						        		'id' => 'study_count'
						        	)); ?>
	              		        </div>
                           </div>
                           <div class="col-md-6">
						        <div class="form-group">
	                   	        	<label>
	                   	        		<span style="font-size: 17px; color: red;">*</span>
						        		<?php echo get_msg('Cockery Count')?>
						        		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
						        			<span class='glyphicon glyphicon-info-sign menu-icon'>
						        		</a>
						        	</label>
						        	<?php echo form_input( array(
						        		'name' => 'cockery_count',
						        		'value' => set_value( 'cockery_count', show_data( @$homedecors->cockery_count), false ),
						        		'class' => 'form-control form-control-sm',
						        		'placeholder' => get_msg( 'Cockery Count' ),
						        		'id' => 'cockery_count'
						        	)); ?>
	              		        </div>
                           </div>
                        </div>

						<div class="form-group" style="padding-top: 30px;" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_kitchen',
                                 'id' => 'is_kitchen',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_kitchen', 1, (@$homedecors->is_kitchen == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Kitchen'); ?>
                              </label>
                           </div>
                        </div>

						<div class="form-group" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_open',
                                 'id' => 'is_open',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_open', 1, (@$homedecors->is_open == 1) ? true : false),
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
                                 'checked' => set_checkbox('is_like', 1, (@$homedecors->is_like == 1) ? true : false),
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