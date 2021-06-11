<script>

	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#condition-form').validate({
			rules:{
				name:{
					blankCheck : "",
					minlength: 3,
					remote: "<?php echo $module_site_url .'/ajx_exists/'.@$builders->id; ?>"
				}
			},
			messages:{
				name:{
					blankCheck : "<?php echo get_msg( 'err_condition_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_condition_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_condition_exist' ) ;?>."
				}
			}
		});
		// custom validation
		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
			   if(value == "") {
			    	return false;
			   } else {
			    	return true;
			   }
		})
	}

	<?php endif; ?>

	$('#property_name').on('change', function() {
        var title = this.value;
		$.ajax({
			url: '<?php echo $module_site_url . '/get_item_id/';?>',
			method: 'POST',
			dataType:"json",
			data:{property_title:title,},
			success:function(data){
				if(data != ""){
					var info = data;
                    info.forEach(element => {
						$('#item_id').val(element.id);
						$('#price').val(element.price);
					});	
				}else{
					alert("No Property is there");
				}
			}
		});
    });


</script>	