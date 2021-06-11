<script>
	<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>

	function jqvalidate() {

		$('#item-form').validate({
			rules:{
				title:{
					blankCheck : "",
					minlength: 3,
					remote: "<?php echo $module_site_url .'/ajx_exists/'.@$item->id; ?>"
				},
				cat_id: {
		       		indexCheck : ""
		      	},
		      	sub_cat_id: {
		       		indexCheck : ""
		      	}
			},
			messages:{
				title:{
					blankCheck : "<?php echo get_msg( 'err_Prd_name' ) ;?>",
					minlength: "<?php echo get_msg( 'err_Prd_len' ) ;?>",
					remote: "<?php echo get_msg( 'err_Prd_exist' ) ;?>."
				},
				cat_id:{
			       indexCheck: "<?php echo $this->lang->line('f_item_cat_required'); ?>"
			    },
			    sub_cat_id:{
			       indexCheck: "<?php echo $this->lang->line('f_item_subcat_required'); ?>"
			    }
			},

			submitHandler: function(form) {
		        if ($("#item-form").valid()) {
		            form.submit();
		        }
		    }

		});
		
		jQuery.validator.addMethod("indexCheck",function( value, element ) {
			
		   if(value == 0) {
		    	return false;
		   } else {
		    	return true;
		   };
			   
		});

		jQuery.validator.addMethod("blankCheck",function( value, element ) {
			
		   if(value == "") {
		    	return false;
		   } else {
		   	 	return true;
		   }
		});
			

	}

	<?php endif; ?>
	function runAfterJQ() {

		$('#cat_id').on('change', function() {

				var value = $('option:selected', this).text().replace(/Value\s/, '');

				var catId = $(this).val();

				$.ajax({
					url: '<?php echo $module_site_url . '/get_all_sub_categories/';?>' + catId,
					method: 'GET',
					dataType: 'JSON',
					success:function(data){
						$('#sub_cat_id').html("");
						$.each(data, function(i, obj){
						    $('#sub_cat_id').append('<option value="'+ obj.id +'">' + obj.name+ '</option>');
						});
						$('#name').val($('#name').val() + " ").blur();
						$('#sub_cat_id').trigger('change');
					}
				});
			});
        
		 $(function() {
			var selectedClass = "";
			$(".filter").click(function(){
			selectedClass = $(this).attr("data-rel");
			$("#gallery").fadeTo(100, 0.1);
			$("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
			setTimeout(function() {
			$("."+selectedClass).fadeIn().addClass('animation');
			$("#gallery").fadeTo(300, 1);
			}, 300);
			});
		});

	}

</script>
<?php 
	// replace cover photo modal
	$data = array(
		'title' => get_msg('upload_photo'),
		'img_type' => 'item',
		'img_parent_id' => @$item->id
	);

	$this->load->view( $template_path .'/components/photo_upload_modal', $data );

	// delete cover photo modal
	$this->load->view( $template_path .'/components/delete_cover_photo_modal' ); 
?>




<!--project files Modal -->
<div class="modal" id="delete_file_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-bold" id="manipulate_project_Label">Delete File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		    	<div id="replace_file_form_div">
		        <form method="post" id="delete_project_files_form" enctype='multipart/form-data'>
			          <input type="hidden" class="form-control" value="<?php echo $item->id;?>" id="id_item"  name="id_item" readonly>
			          <input type="hidden" class="form-control"  id="id_flat"  name="id_flat" readonly>
			          <input type="hidden" class="form-control"  id="old_file" name="old_file"  readonly>
                   <input type="hidden" class="form-control"  id="project_or_flats" name="project_or_flats"  readonly>

                   <h5 class="pb-5"  >Do you still want to delete this file?</h5>
			          <button type="submit" class="btn btn-primary">Yes </button>
			          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      </form>
               <div id="delete_msg_box"></div>
		    	</div>
		  </div>
    </div>
  </div>
</div>

<!--END project files Modal -->


<!--Delete flat row  -->
<script>
    function deleteFlatrow($no){

      var delrow = ".flat_row"+$no;
      
      $(delrow).remove();
    }

</script>
<!--END Delete flat row  -->


<!------ Add New Flat Form------->
<script>

     // var rowcount = $('.flat_row').length();

  $( "#add_new_flat" ).click(function() {

      var rows_count = $("#new_flat_row > div").length;
      var row_count = rows_count+1; 
      //console.log(row_count);

		$('#new_flat_row').append(`
		    <div class="row flat_row${row_count}" id="flat_row"  style="padding-top: 14px;">
          <div class="row">
               <div class="col-md-1" >
                   <h5 class="text-center text-bold mt-4">Flat${row_count}:</h5>
                   <input type="hidden" value="" class="form-control form-control-sm" id="flat_id" name="flat_id[]">                  
               </div>
               <div class="col-md-11">
                   <div class="row">
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                              Property Type
                           </label>
                           <select name="property_type[]" class="form-control">
                              <option value="">Select property </option>
                              <option value="apartments">Apartments</option>
                              <option value="villa">Villa</option>
                           </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                              Flat Type
                           </label>
                           <select name="flat_type[]" class="form-control">
                              <option value="">Select Flat </option>
                              <option value="1bhk">1BHK</option>
                              <option value="2bhk">2BHK</option>
                              <option value="3bhk">3BHK</option>
                              <option value="4bhk">4BHK</option>
                              <option value="5bhk">5BHK</option>
                           </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                          <div class="form-group">
                             <label>
                               Bedrooms
                             </label>
                             <input type="text" class="form-control form-control-sm" placeholder="Bedrooms" id="flat_bed" name="flat_bed[]">
                          </div>
                      </div>
                      <div class="col-md-1">
                          <div class="form-group">
                             <label>
                               Bathrooms
                             </label>
                             <input type="text" class="form-control form-control-sm" placeholder="Bath" id="flat_bathrooms" name="flat_bathrooms[]">
                          </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label >
                               Price
                           </label>
                           <input type="text" class="form-control form-control-sm" placeholder="Price" id="flat_price" name="flat_price[]">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                                Area
                           </label>
                           <input type="text" class="form-control form-control-sm" placeholder="Area" id="flat_area" name="flat_area[]">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                               Area Type
                           </label>
                           <select name="flat_area_type[]" class="form-control">
                              <option value="">Select Area Type </option>
                              <option value="Sq.Ft">Sq.Ft</option> 
                              <option value="Sq.Mt">Sq.Mt</option>
                              <option value="Sq.Yds">Sq.Yds</option>
                              <option value="Acres">Acres</option>
                           </select>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                             Carpet Area
                           </label>
                           <input type="text" class="form-control form-control-sm" placeholder="Carpet Area" id="flat_carpet_area" name="flat_carpet_area[]">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                               Balcony
                           </label>
                           <input type="text" class="form-control form-control-sm" placeholder="Balcony" id="flat_balcony" name="flat_balcony[]">
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group">
                           <label>
                               Available
                           </label>
                           <input type="text" class="form-control form-control-sm" placeholder="Available" id="flat_available" name="flat_available[]">
                        </div>
                      </div>    
                      <div class="col-md-1">
                        <div class="form-group">
                            <label><?php echo get_msg(' Layout Image')?>
                               <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                               </a>
                            </label>
                            <br/>
                            <input type="hidden" value="" class="form-control form-control-sm" id="flat_img_old_name" name="flat_img_old_name[]">
                            <input class="btn btn-sm" type="file" name="flat_image_url[]">
                         </div>
                      </div>
			            	  <div class="col-md-1 py-4">
                          <button type="button" class='btn btn-sm btn-danger' onClick="deleteFlatrow(${row_count})" id="delete_flatrow_btn">
                              <i style='font-size: 14px;' class='fa fa-trash-o'><span style='padding-left:4px;'>Delete</span></i>
					                </button>              
                      </div>                   
                   </div>
               </div>             
          </div>
			</div>
		`
    );
  });
</script>



<!------END Add New Flat Form------->

<!------Image or PDF Files  Delete------->
<script>

    
  $("button").click(function() {

       $("#delete_msg_box").empty();

        var file_path = $(this).val();
        var project_or_flat_id = $(this).attr('data-id');
        var project_or_flats = $(this).attr('data-type');

        if(file_path != ''){           

           $('#old_file').val(file_path);
           $('#id_flat').val(project_or_flat_id);
           $('#project_or_flats').val(project_or_flats);
 
           $('#delete_file_modal').modal('show');

        }
     
    });
</script>


<script>
    $('#delete_project_files_form').on('submit', function(e){
	    e.preventDefault();


       var id_item =  $("#id_item").val();
       var id_flat =  $("#id_flat").val();
       var old_file = $("#old_file").val();
	     var file_action =$('#file_action').val();

       var project_form_data = new FormData(this);
       if(id_item == "" || id_flat == '' || old_file == '' ||  file_action == '')
       {
           alert("Something went wrong try again...");
           return false;
       }
       else{
		   //console.log(project_form_data);
           $.ajax({
               url: "<?php echo base_url();?>index.php/admin/items/delete_project_files",
               method:"POST",
		         data:project_form_data, //new FormData(this),
               contentType:false,
		         cache:false,
		         processData:false,
               success:function(data){
                     if(data == 1){
                        $("#delete_msg_box").append(`
                           <p class="text-success text-bold px-2 py-3">File Deleted successfully.</p>
                        `);
                     }else{
                        $("#delete_msg_box").append(`
                           <p class="text-danger text-bold px-2 py-3">Failed Try Again.</p>
                        `); 
                     }
                     setTimeout(function () { 
			                  location.reload(true); 
			              }, 2000);
               }
           });
       }
   });
</script>

<!----- END Image or PDF Files  Delete-------->
