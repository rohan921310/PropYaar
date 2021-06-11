
<?php
	$attributes = array( 'id' => 'lrs-form', 'enctype' => 'multipart/form-data');
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
								'value' => set_value( 'name', show_data( @$lrs_data->name ), false ),
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
								'value' => set_value( 'name', show_data( @$lrs_data->email ), false ),
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
								'value' => set_value( 'name', show_data( @$lrs_data->phone ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Phone' ),
								'id' => 'phone'
							)); ?>
	              		</div>
						
						<div class="form-group">
                            <label> <span style="font-size: 17px; color: red;">*</span>
							   Property Type
                            </label>
                            <select name="property_type" id="property_type" class="form-control">
                              <?php if (empty($lrs_data->property_type)) { ?>
                                <option value="">Select Property Location</option>
                              <?php } ?>
                              <option value="Individual Plot" <?php if ($lrs_data->property_type == "Individual Plot") {
                                                  echo "selected";
                                                } ?>>Individual Plot</option>
                              <option value="Layout" <?php if ($lrs_data->property_type == "Layout") {
                                                  echo "selected";
                                                } ?>>Layout</option>               
                            </select>
                        </div>  						    
						  
						<div class="form-group">
                            <label> <span style="font-size: 17px; color: red;">*</span>
							   Property Location
                            </label>
                            <select name="property_location" id="property_location" class="form-control">
                              <?php if (empty($lrs_data->property_location)) { ?>
                                <option value="">Select Property Location</option>
                              <?php } ?>
                              <option value="Hyderabad" <?php if ($lrs_data->property_location == "Hyderabad") {
                                                  echo "selected";
                                                } ?>>Hyderabad</option>
                              <option value="Mancherial" <?php if ($lrs_data->property_location == "Mancherial") {
                                                  echo "selected";
                                                } ?>>Mancherial</option>
                              <option value="Secunderabad" <?php if ($lrs_data->property_location == "Secunderabad") {
                                                  echo "selected";
                                                } ?>>Secunderabad</option>               
                            </select>
                        </div> 

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Type')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_type',
								'value' => set_value( 'plot_type', show_data( @$lrs_data->plot_type ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Type' ),
								'id' => 'plot_type'
							)); ?>
	              		</div> 

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Category')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_category',
								'value' => set_value( 'plot_category', show_data( @$lrs_data->plot_category ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Category' ),
								'id' => 'plot_category'
							)); ?>
	              		</div>  

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Corporation')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_corporation',
								'value' => set_value( 'plot_corporation', show_data( @$lrs_data->plot_corporation ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Corporation' ),
								'id' => 'plot_corporation'
							)); ?>
	              		</div>   
                         
						
						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Zone')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_zone',
								'value' => set_value( 'plot_zone', show_data( @$lrs_data->plot_zone ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Zone' ),
								'id' => 'plot_zone'
							)); ?>
	              		</div>   

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Circle')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_circle',
								'value' => set_value( 'plot_circle', show_data( @$lrs_data->plot_circle ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Circle' ),
								'id' => 'plot_circle'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Plot Ward')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'plot_ward',
								'value' => set_value( 'plot_ward', show_data( @$lrs_data->plot_ward ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Plot Ward' ),
								'id' => 'plot_ward'
							)); ?>
	              		</div>        

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Father Or Spouse Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'father_or_spouse_name',
								'value' => set_value( 'father_or_spouse_name', show_data( @$lrs_data->father_or_spouse_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Father Or Spouse Name' ),
								'id' => 'father_or_spouse_name'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Aadhaar Number')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'aadhaar_number',
								'value' => set_value( 'aadhaar_number', show_data( @$lrs_data->aadhaar_number ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Aadhaar Number' ),
								'id' => 'aadhaar_number'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Gender')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'gender',
								'value' => set_value( 'gender', show_data( @$lrs_data->gender ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Gender' ),
								'id' => 'gender'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('House No')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'house_no',
								'value' => set_value( 'house_no', show_data( @$lrs_data->house_no ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'House No' ),
								'id' => 'house_no'
							)); ?>
	              		</div> 

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Street Colony Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'street_colony_name',
								'value' => set_value( 'street_colony_name', show_data( @$lrs_data->street_colony_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Street Colony Name' ),
								'id' => 'street_colony_name'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Locality')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'locality',
								'value' => set_value( 'locality', show_data( @$lrs_data->locality ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Locality' ),
								'id' => 'locality'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Town City Village')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'town_city_village',
								'value' => set_value( 'town_city_village', show_data( @$lrs_data->town_city_village ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Town City Village' ),
								'id' => 'town_city_village'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('District')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'district',
								'value' => set_value( 'district', show_data( @$lrs_data->district ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'District' ),
								'id' => 'district'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Pincode')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'pincode',
								'value' => set_value( 'pincode', show_data( @$lrs_data->pincode ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Pincode' ),
								'id' => 'pincode'
							)); ?>
	              		</div>
<!-------
						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Email Id')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'email_id',
								'value' => set_value( 'email_id', show_data( @$lrs_data->email_id ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Email Id' ),
								'id' => 'email_id'
							)); ?>
	              		</div>


						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Alternate Phone Number')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'alternate_phone_number',
								'value' => set_value( 'alternate_phone_number', show_data( @$lrs_data->alternate_phone_number ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Alternate Phone Number' ),
								'id' => 'alternate_phone_number'
							)); ?>
	              		</div>                 
-------->

						<?php if ( !isset( $lrs_data )): ?>
<!-----
                            <div class="form-group">
                            	<span style="font-size: 17px; color: red;">*</span>
                            	<label><?php echo get_msg('LRS Image')?>
                            		<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            			<span class='glyphicon glyphicon-info-sign menu-icon'>
                            		</a>
                            	</label>
                            
                            	<br/>
                            
                            	<input class="btn btn-sm" type="file" name="images1">
								
                            </div>
  ------>                          
                            <?php else: ?>
                            <span style="font-size: 17px; color: red;">*</span>
                            <label><?php echo get_msg('LRS Image')?>
                            	<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                            		<span class='glyphicon glyphicon-info-sign menu-icon'>
                            	</a>
                            </label> 
                            
                            <div class="btn btn-sm btn-primary btn-upload pull-right" data-toggle="modal" data-target="#uploadImage">
                            	<?php echo get_msg('btn_replace_photo')?>
                            </div>
                            
                            <hr/>
                            
                            <?php
                            	$conds = array( 'img_type' => 'lrs', 'img_parent_id' => $lrs_data->id );
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