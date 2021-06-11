
<?php
	$attributes = array( 'id' => 'condition-form', 'enctype' => 'multipart/form-data');
	echo form_open( '', $attributes);
?>
	
<section class="content animated fadeInRight">
	<div class="col-md-6">
		<div class="card card-info">
		    <div class="card-header">
		        <h3 class="card-title"><?php echo get_msg('LRS Information')?></h3>
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
								'value' => set_value( 'name', show_data( @$arvr_data->name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'name' ),
								'id' => 'name'
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
								'value' => set_value( 'name', show_data( @$arvr_data->email ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Email' ),
								'id' => 'email'
							)); ?>
	              		</div>
					    <div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Phone')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'phone',
								'value' => set_value( 'name', show_data( @$arvr_data->phone ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Phone' ),
								'id' => 'phone'
							)); ?>
	              		</div>

						<div class="form-group">
                            <label> <span style="font-size: 17px; color: red;">*</span>
							   Property Location
                            </label>
                            <select name="property_location" id="property_location" class="form-control">
                              <?php if (empty($arvr_data->property_location)) { ?>
                                <option value="">Select Property Location</option>
                              <?php } ?>
                              <option value="Hyderabad" <?php if ($arvr_data->property_location == "Hyderabad") {
                                                  echo "selected";
                                                } ?>>Hyderabad</option>
                              <option value="Mancherial" <?php if ($arvr_data->property_location == "Mancherial") {
                                                  echo "selected";
                                                } ?>>Mancherial</option>
                              <option value="Secunderabad" <?php if ($arvr_data->property_location == "Secunderabad") {
                                                  echo "selected";
                                                } ?>>Secunderabad</option>               
                            </select>
						</div>
						



						<?php if ( !isset( $arvr_data )): ?>

                            <div class="form-group">
                            	<span style="font-size: 17px; color: red;">*</span>
                            	<label><?php echo get_msg('3D ARVR Image')?>
                            		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            			<span class='glyphicon glyphicon-info-sign menu-icon'>
                            		</a>
                            	</label>
                            
                            	<br/>
                            
                            	<input class="btn btn-sm" type="file" name="images1">
                            </div>
                            
                            <?php else: ?>
                            <span style="font-size: 17px; color: red;">*</span>
                            <label><?php echo get_msg('3D ARVR Image')?>
                            	<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            		<span class='glyphicon glyphicon-info-sign menu-icon'>
                            	</a>
                            </label> 
                            
                            <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadImage">
                            	<?php echo get_msg('btn_replace_photo')?>
                            </div>
                            
                            <hr/>
                            
                            <?php
                            	$conds = array( 'img_type' => '3D_ARVR', 'img_parent_id' => $arvr_data->id );
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
				if ( isset( $lrs_data )) { 
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