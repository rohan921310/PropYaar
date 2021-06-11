
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('Movers Information')?></h3>
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
								'name' => 'mv_name',
								'value' => set_value( 'mv_name', show_data( @$movers->mv_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Name' ),
								'id' => 'mv_name'
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
								'name' => 'mv_phone_number',
								'value' => set_value( 'mv_phone_number', show_data( @$movers->mv_phone_number ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Phone Number' ),
								'id' => 'mv_phone_number'
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
								'name' => 'mv_location',
								'value' => set_value( 'mv_location', show_data( @$movers->mv_location ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Location' ),
								'id' => 'mv_location'
							)); ?>
	              		</div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('Info') ?>
                           </label>
                           <?php echo form_textarea(array(
                              'name' => 'mv_info',
                              'value' => set_value('mv_info', show_data(@$movers->mv_info), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('Info'),
                              'id' => 'mv_info',
                              'rows' => "3"
                              )); ?>
                        </div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Rating
                           </label>
                           <select name="mv_rating" class="form-control">
                              <?php if (empty($movers->mv_rating)) { ?>
                              <option value="">Select Rating</option>
                              <?php } ?>
                              <option value="0" 
                                 <?php if ($movers->mv_rating == "0") {
                                    echo "selected";
                                    } ?>>0
                              </option>
                              <option value="1" 
                                 <?php if ($movers->mv_rating == "1") {
                                    echo "selected";
                                    } ?>>1
                              </option>
                              <option value="2" 
                                 <?php if ($movers->mv_rating == "2") {
                                    echo "selected";
                                    } ?>>2
                              </option>
                              <option value="3" 
                                 <?php if ($movers->mv_rating == "3") {
                                    echo "selected";
                                    } ?>>3
                              </option>
							  <option value="4" 
                                 <?php if ($movers->mv_rating == "4") {
                                    echo "selected";
                                    } ?>>4
                              </option>
							  <option value="5" 
                                 <?php if ($movers->mv_rating == "5") {
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
                                 <?php echo get_msg('From City') ?>
                                 </label>
                                 <?php echo form_input(array(
                                    'name' => 'from_city',
                                    'value' => set_value('from_city', show_data(@$movers->from_city), false),
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => get_msg('From City'),
                                    'id' => 'from_city'
                                    
                                    )); ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                 <span style="font-size: 17px; color: red;">*</span>
                                 <?php echo get_msg('To City') ?>
                                 </label>
                                 <?php echo form_input(array(
                                    'name' => 'to_city',
                                    'value' => set_value('to_city', show_data(@$movers->to_city), false),
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => get_msg('To City'),
                                    'id' => 'to_city'
                                    
                                    )); ?>
                              </div>
                           </div>
                        </div>

				        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                 <span style="font-size: 17px; color: red;">*</span>
                                 <?php echo get_msg('From Floor No') ?>
                                 </label>
                                 <?php echo form_input(array(
                                    'name' => 'from_floor_no',
                                    'value' => set_value('from_floor_no', show_data(@$movers->from_floor_no), false),
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => get_msg('From Floor No'),
                                    'id' => 'from_floor_no'
                                    
                                    )); ?>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                 <span style="font-size: 17px; color: red;">*</span>
                                 <?php echo get_msg('To Floor No') ?>
                                 </label>
                                 <?php echo form_input(array(
                                    'name' => 'to_floor_no',
                                    'value' => set_value('to_floor_no', show_data(@$movers->to_floor_no), false),
                                    'class' => 'form-control form-control-sm',
                                    'placeholder' => get_msg('To Floor No'),
                                    'id' => 'to_floor_no'
                                    
                                    )); ?>
                              </div>
                           </div>
                        </div>

					   	<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('From Address') ?>
                           </label>
                           <?php echo form_textarea(array(
                              'name' => 'from_address',
                              'value' => set_value('from_address', show_data(@$movers->from_address), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('From Address'),
                              'id' => 'from_address',
                              'rows' => "3"
                              )); ?>
                        </div>

						<div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('To Address') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'to_address',
                        'value' => set_value('to_address', show_data(@$movers->to_address), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('To Address'),
                        'id' => 'to_address',
                        'rows' => "3"
                        )); ?>
                  </div> 

                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Date To Shift') ?>
                     </label>
                     <?php echo form_input(array(
                        'name' => 'date_to_shift',
                        'value' => set_value('date_to_shift', show_data(@$movers->date_to_shift), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('To Floor No'),
                        'id' => 'date_to_shift'
                        
                        )); ?>
                  </div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           Home Size
                           </label>
                           <select name="home_size" class="form-control">
                              <?php if (empty($movers->home_size)) { ?>
                              <option value="">Select Home Size</option>
                              <?php } ?>
                              <option value="1rk" 
                                 <?php if ($movers->home_size == "1rk") {
                                    echo "selected";
                                    } ?>>1RK
                              </option>
                              <option value="1bhk" 
                                 <?php if ($movers->home_size == "1bhk") {
                                    echo "selected";
                                    } ?>>1BHK
                              </option>
                              <option value="2bhk" 
                                 <?php if ($movers->home_size == "2bhk") {
                                    echo "selected";
                                    } ?>>2BHK
                              </option>
                              <option value="3bhk" 
                                 <?php if ($movers->home_size == "3bhk") {
                                    echo "selected";
                                    } ?>>3BHK
                              </option>
                           </select>
                        </div> 

                
                  <div class="form-group">
                     <label>
                     <span style="font-size: 17px; color: red;">*</span>
                     <?php echo get_msg('Shipping Details') ?>
                     </label>
                     <?php echo form_textarea(array(
                        'name' => 'shipping_details',
                        'value' => set_value('shipping_details', show_data(@$movers->shipping_details), false),
                        'class' => 'form-control form-control-sm',
                        'placeholder' => get_msg('Shipping Details'),
                        'id' => 'shipping_details',
                        'rows' => "3"
                        )); ?>
                  </div> 

                  <div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Listed User Id')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'listed_user_id',
								'value' => set_value( 'listed_user_id', show_data( @$movers->listed_user_id ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Listed User Id' ),
								'id' => 'listed_user_id'
							)); ?>
	               </div>




						<div class="form-group" style="padding-top: 30px;" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'is_open',
                                 'id' => 'is_open',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('is_open', 1, (@$movers->is_open == 1) ? true : false),
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
                                 'checked' => set_checkbox('is_like', 1, (@$movers->is_like == 1) ? true : false),
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