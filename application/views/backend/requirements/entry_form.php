
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
								<?php echo get_msg('Owner Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'owner_name',
								'value' => set_value( 'owner_name', show_data( @$click_earn->owner_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Owner Name' ),
								'id' => 'owner_name'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Owner Phone Number')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'owner_phone_number',
								'value' => set_value( 'owner_phone_number', show_data( @$click_earn->owner_phone_number ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Owner Phone Number' ),
								'id' => 'owner_phone_number'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Email')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'email',
								'value' => set_value( 'email', show_data( @$click_earn->email ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Email' ),
								'id' => 'email'
							)); ?>
	              		</div>

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
								'value' => set_value( 'city_name', show_data( @$click_earn->city_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'City Name' ),
								'id' => 'city_name'
							)); ?>
	              		</div>

						<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
						     Property Type
                           </label>
                           <select name="property_type" class="form-control">
                              <?php if (empty($click_earn->property_type)) { ?>
                              <option value="">Select Property Type</option>
                              <?php } ?>
                              <option value="rent" 
                                 <?php if ($click_earn->property_type == "rent") {
                                    echo "selected";
                                    } ?>>Rent
                              </option>
                              <option value="pg" 
                                 <?php if ($click_earn->property_type == "pg") {
                                    echo "selected";
                                    } ?>>PG
                              </option>
                              <option value="resale" 
                                 <?php if ($click_earn->property_type == "resale") {
                                    echo "selected";
                                    } ?>>Resale
                              </option>
							  <option value="commercial rent" 
                                 <?php if ($click_earn->property_type == "commercial rent") {
                                    echo "selected";
                                    } ?>>Commercial Rent
                              </option>
							  <option value="commercial resale" 
                                 <?php if ($click_earn->property_type == "commercial resale") {
                                    echo "selected";
                                    } ?>>Commercial Resale
                              </option>
                           </select>
                        </div>

				      	<div class="form-group">
                           <label>
                           <span style="font-size: 17px; color: red;">*</span>
                           <?php echo get_msg('itm_address_label') ?>
                           </label>
                           <?php echo form_textarea(array(
                              'name' => 'address',
                              'value' => set_value('address', show_data(@$click_earn->address), false),
                              'class' => 'form-control form-control-sm',
                              'placeholder' => get_msg('itm_address_label'),
                              'id' => 'address',
                              'rows' => "5"
                              )); ?>
                        </div>


						<?php if ( !isset( $click_earn )): ?>

                            <div class="form-group">
                            	<span style="font-size: 17px; color: red;">*</span>
                            	<label><?php echo get_msg('Image')?>
                            		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            			<span class='glyphicon glyphicon-info-sign menu-icon'>
                            		</a>
                            	</label>
                            
                            	<br/>
                            
                            	<input class="btn btn-sm" type="file" name="images1">
                            </div>
                            
                            <?php else: ?>
                            <span style="font-size: 17px; color: red;">*</span>
                            <label><?php echo get_msg('Image')?>
                            	<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            		<span class='glyphicon glyphicon-info-sign menu-icon'>
                            	</a>
                            </label> 
                            
                            <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadImage">
                            	<?php echo get_msg('btn_replace_photo')?>
                            </div>
                            
                            <hr/>
                            
                            <?php
                            	$conds = array( 'img_type' => 'click_earn', 'img_parent_id' => $click_earn->id );
                            	$images = $this->Image->get_all_by( $conds )->result();
                            ?>
                            	
                            <?php if ( count($images) > 0 ): ?>
                            	
                            	<div class="row">
                            
                            	<?php $i = 0; foreach ( $images as $img ) :?>
                            
                            		<?php if ($i>0 && $i%3==0): ?>
                            				
                            		</div><div class='row'>
                            		
                            		<?php endif; ?>
                            			
                            		<div class="col-md-4" style="height:100">
                            
                            			<div class="thumbnail">
                            
                            				<img src="<?php echo base_url().'uploads/' . $img->img_path; ?>" class='img-thumbnail'>
                            
                            				<br/>
                            				
                            				<p class="text-center">
                            					
                            					<a data-toggle="modal" data-target="#deletePhoto" class="delete-img" id="<?php echo $img->img_id; ?>"   
                            						image="<?php echo $img->img_path; ?>">
                            						<?php echo get_msg('remove_label'); ?>
                            					</a>
                            				</p>
                            
                            			</div>
                            
                            		</div>
                            
                            	<?php $i++; endforeach; ?>
                            
                            	</div>
                            
                            <?php endif; ?>
                            
                        <?php endif; ?>	
                        <!-- End 3D arvr photo -->

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