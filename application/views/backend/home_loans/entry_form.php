
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
								<?php echo get_msg('Aadharcard Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'aadharcard_name',
								'value' => set_value( 'aadharcard_name', show_data( @$homeloans->aadharcard_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Aadharcard Name' ),
								'id' => 'aadharcard_name'
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
								'value' => set_value( 'listed_user_id', show_data( @$homeloans->listed_user_id ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Listed User Id' ),
								'id' => 'listed_user_id'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Type Of Loan')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'type_of_loan',
								'value' => set_value( 'type_of_loan', show_data( @$homeloans->type_of_loan ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Type Of Loan' ),
								'id' => 'type_of_loan'
							)); ?>
	              		</div>

						<div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Salary')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'salary',
								'value' => set_value( 'salary', show_data( @$homeloans->salary ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Salary' ),
								'id' => 'salary'
							)); ?>
						  </div>
						  
						  <div class="form-group">
	                   		<label>
	                   			<span style="font-size: 17px; color: red;">*</span>
								<?php echo get_msg('Company Name')?>
								<a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_name_tooltips')?>">
									<span class='glyphicon glyphicon-info-sign menu-icon'>
								</a>
							</label>

							<?php echo form_input( array(
								'name' => 'company_name',
								'value' => set_value( 'company_name', show_data( @$homeloans->company_name ), false ),
								'class' => 'form-control form-control-sm',
								'placeholder' => get_msg( 'Company Name' ),
								'id' => 'company_name'
							)); ?>
	              		</div>


						<div class="form-group" style="padding-top: 30px;" >
                             <div class="form-check">
                              <label>
                              <?php echo form_checkbox(array(
                                 'name' => 'any_existing_loans',
                                 'id' => 'any_existing_loans',
                                 'value' => 'accept',
                                 'checked' => set_checkbox('any_existing_loans', 1, (@$homeloans->any_existing_loans == 1) ? true : false),
                                 'class' => 'form-check-input'
                                 )); ?>
                              <?php echo get_msg('Existing Loans'); ?>
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