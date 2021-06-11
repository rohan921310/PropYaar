<?php
	$attributes = array('id' => 'user-form');
	echo form_open( '', $attributes );
?>
<section class="content animated fadeInRight">

	<div class="card card-info">
	    <div class="card-header">
	      <h3 class="card-title"><?php echo get_msg('user_info')?></h3>
	    </div>

	   
  		<div class="card-body">
    		<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label><?php echo get_msg('user_name'); ?></label>
						<?php echo form_input( array(
							'name' => 'user_name',
							'value' => set_value( 'user_name', show_data( @$user->user_name ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'user_name' ),
							'id' => 'user_name'
						)); ?>
					</div>

					<?php if($user->email_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('user_email'); ?></label>
						<?php echo form_input( array(
							'name' => 'user_email',
							'value' => set_value( 'user_email', show_data( @$user->user_email ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'user_email' ),
							'id' => 'user_email'
						)); ?>
					</div>
					<?php endif; ?>

					<?php if($user->phone_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('user_phone'); ?></label>
						<?php echo form_input( array(
							'name' => 'user_phone',
							'value' => set_value( 'user_phone', show_data( @$user->user_phone ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'user_phone' ),
							'id' => 'user_phone'
						)); ?>
					</div>
					<?php endif; ?>

					<div class="form-group">
						<label><?php echo get_msg('Follower Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'follower_count',
							'value' => set_value( 'follower_count', show_data( @$user->follower_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Follower Count' ),
							'id' => 'follower_count'
						)); ?>
					</div>

					<div class="form-group">
						<label><?php echo get_msg('Following Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'following_count',
							'value' => set_value( 'following_count', show_data( @$user->following_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Following Count' ),
							'id' => 'following_count'
						)); ?>
					</div>

					<?php if($user->facebook_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('Facebook Verify'); ?></label>
						<?php echo form_input( array(
							'name' => 'facebook_verify',
							'value' => set_value( 'facebook_verify', show_data( @$user->facebook_verify ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Facebook Verify' ),
							'id' => 'facebook_verify'
						)); ?>
					</div>
					<?php endif; ?>

					<?php if($user->google_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('Google Verify'); ?></label>
						<?php echo form_input( array(
							'name' => 'google_verify',
							'value' => set_value( 'google_verify', show_data( @$user->google_verify ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Google Verify' ),
							'id' => 'google_verify'
						)); ?>
					</div>
					<?php endif; ?>

					<?php if($user->apple_verify == 1): ?>
					<div class="form-group">
						<label><?php echo get_msg('Apple Verify'); ?></label>
						<?php echo form_input( array(
							'name' => 'apple_verify',
							'value' => set_value( 'apple_verify', show_data( @$user->apple_verify ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Apple Verify' ),
							'id' => 'apple_verify'
						)); ?>
					</div>
					<?php endif; ?>

					<div class="form-group">
						<label><?php echo get_msg('Listings Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'listings_count',
							'value' => set_value( 'listings_count', show_data( @$user->listings_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Listings Count' ),
							'id' => 'listings_count'
						)); ?>
					</div>

					<div class="form-group">
						<label><?php echo get_msg('Indrafts Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'indrafts_count',
							'value' => set_value( 'indrafts_count', show_data( @$user->indrafts_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Indrafts Count' ),
							'id' => 'indrafts_count'
						)); ?>
					</div>

					<div class="form-group">
						<label><?php echo get_msg('Pendings Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'pendings_count',
							'value' => set_value( 'pendings_count', show_data( @$user->pendings_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Pendings Count' ),
							'id' => 'pendings_count'
						)); ?>
					</div>

					<div class="form-group">
						<label><?php echo get_msg('Rejected Count'); ?></label>
						<?php echo form_input( array(
							'name' => 'rejected_count',
							'value' => set_value( 'rejected_count', show_data( @$user->rejected_count ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Rejected Count' ),
							'id' => 'rejected_count'
						)); ?>
					</div>

				</div>

				<div class="col-md-6">
					<div class="form-group">	
						<label><?php echo get_msg('user_address'); ?></label>
						<?php echo form_input( array(
							'name' => 'user_address',
							'value' => set_value( 'user_address', show_data( @$user->user_address ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'user_address' ),
							'id' => 'user_address'
						)); ?>
					</div>
					<div class="form-group">	
						<label><?php echo get_msg('user_city'); ?></label>
						<?php echo form_input( array(
							'name' => 'city',
							'value' => set_value( 'city', show_data( @$user->city ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'city' ),
							'id' => 'city'
						)); ?>
					</div>
					<div class="form-group">	
						<label><?php echo get_msg('about_me'); ?></label>
						<?php echo form_input( array(
							'name' => 'user_about_me',
							'value' => set_value( 'user_about_me', show_data( @$user->user_about_me ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'about_me' ),
							'id' => 'user_about_me'
						)); ?>
					</div>
					<div class="form-group">	
						<label><?php echo get_msg('Listing By'); ?></label>
						<?php echo form_input( array(
							'name' => 'listing_by',
							'value' => set_value( 'listing_by', show_data( @$user->listing_by ), false ),
							'class' => 'form-control form-control-sm',
							'placeholder' => get_msg( 'Listing By' ),
							'id' => 'listing_by'
						)); ?>
					</div>
				</div>
			</div>
		</div>
		 <!-- /.card-body -->

		<div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_save')?>
			</button>

			<a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
				<?php echo get_msg('btn_cancel')?>
			</a>
        </div>
	</div>
</section>

<?php echo form_close(); ?>