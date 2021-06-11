
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
								<?php echo get_msg('Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'name',
								'value' => set_value( 'name', show_data( @$banners->name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Name' ),
								'id' => 'name'
							)); ?>
	              		</div>


<!------
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
------------>


						<?php if ( !isset( $banners )): ?>

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
                            	$conds = array( 'img_type' => 'banner', 'img_parent_id' => $banners->id );
                            	$images = $this->Image->get_all_by( $conds )->result();
                            ?>
                            	
                            <?php if ( count($images) > 0 ): ?>
                            	
                            	<div class="row">
                            
                            	<?php $i = 0; foreach ( $images as $img ) :?>
                            
                            		<?php if ($i>0 && $i%3==0): ?>
                            				
                            		</div><div class='row'>
                            		
                            		<?php endif; ?>
                            			
                            		<div class="col-md-4" style="height:400">
                            
                            			<div class="thumbnail">

                            
                            				<img src="<?php echo base_url().'uploads/' . $img->img_path; ?>" class='' height="400" width="650">
                            
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