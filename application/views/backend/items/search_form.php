<?php
	$attributes = array('id' => 'search-form', 'enctype' => 'multipart/form-data');
	echo form_open( $module_site_url .'/search', $attributes);
?>

<div class='row my-3'>
	<div class="col-12">
		<div class='form-inline'>
			<div class="form-group" style="padding-top: 3px;padding-right: 2px;">

				<?php echo form_input(array(
					'name' => 'searchterm',
					'value' => set_value( 'searchterm', $searchterm ),
					'class' => 'form-control form-control-sm mr-3',
					'placeholder' => get_msg( 'btn_search' )
				)); ?>

		  	</div>

		  	<div class="form-group" style="padding-top: 3px;padding-right: 2px;">

				<?php
					$options=array();
					$options[0]=get_msg('Prd_search_cat');
					
					$categories = $this->Category->get_all( );
					foreach($categories->result() as $cat) {
						
							$options[$cat->cat_id]=$cat->cat_name;
					}
					
					echo form_dropdown(
						'cat_id',
						$options,
						set_value( 'cat_id', show_data( $cat_id ), false ),
						'class="form-control form-control-sm mr-3" id="cat_id"'
					);
				?> 

		  	</div>

	  		<div class="form-group" style="padding-top: 3px;">

				<?php
					if($selected_cat_id != "") {

						$options=array();
						$options[0]=get_msg('Prd_search_subcat');
						$conds['cat_id'] = $selected_cat_id;
						$sub_cat = $this->Subcategory->get_all_by($conds);
						foreach($sub_cat->result() as $subcat) {
							$options[$subcat->id]=$subcat->name;
						}
						echo form_dropdown(
							'sub_cat_id',
							$options,
							set_value( 'sub_cat_id', show_data( $sub_cat_id ), false ),
							'class="form-control form-control-sm mr-3" id="sub_cat_id"'
						);

					} else {

						$conds['cat_id'] = $selected_cat_id;
						$options=array();
						$options[0]=get_msg('Prd_search_subcat');

						echo form_dropdown(
							'sub_cat_id',
							$options,
							set_value( 'sub_cat_id', show_data( $sub_cat_id ), false ),
							'class="form-control form-control-sm mr-3" id="sub_cat_id"'
						);
					}
				?>

		  	</div>

		  	<div class="form-group" style="padding-top: 3px;padding-right: 2px;">

				<?php
					$options=array();
					$options[0]=get_msg('itm_select_type');
					
					$itemtypes = $this->Itemtype->get_all( );
					foreach($itemtypes->result() as $type) {
						
						$options[$type->id]=$type->name;
					}
					
					echo form_dropdown(
						'item_type_id',
						$options,
						set_value( 'item_type_id', show_data( $item_type_id ), false ),
						'class="form-control form-control-sm mr-3" id="item_type_id"'
					);
				?> 

		  	</div>

		  	<div class="form-group" style="padding-top: 3px;padding-right: 2px;">

				<?php
					$options=array();
					$options[0]=get_msg('itm_select_price');
					
					$pricetypes = $this->Pricetype->get_all( );
					foreach($pricetypes->result() as $price) {
						
						$options[$price->id]=$price->name;
					}
					
					echo form_dropdown(
						'item_price_type_id',
						$options,
						set_value( 'item_price_type_id', show_data( $item_price_type_id ), false ),
						'class="form-control form-control-sm mr-3" id="item_price_type_id"'
					);
				?> 

		  	</div>
<!-----
		  	<div class="form-group mr-3" style="padding-top: 3px;padding-right: 2px;">

				<?php
					$options=array();
					$options[0]=get_msg('itm_select_currency');
					
					$currencies = $this->Currency->get_all( );
					foreach($currencies->result() as $currency) {
						
						$options[$currency->id]=$currency->currency_short_form;
					}
					
					echo form_dropdown(
						'item_currency_id',
						$options,
						set_value( 'item_currency_id', show_data( $item_currency_id ), false ),
						'class="form-control form-control-sm mr-3" id="item_currency_id"'
					);
				?> 

		  	</div>

			  -------->

		  	<div class="form-group" style="padding-top: 3px;padding-right: 2px;">
						
				<select class="form-control form-control-sm mr-3" name="status" id="status">
							
					<option value="0"><?php echo get_msg('select_status_label');?></option>

						<?php
							$array = array('Published' => 1, 'Disable' => 2);
	    					foreach ($array as $key=>$value) {

	    						if($value == $status) {
		    						echo '<option value="'.$value.'" selected>'.$key.'</option>';
		    					} else {
		    						echo '<option value="'.$value.'">'.$key.'</option>';
		    					}
	    					}
						?>
				</select> 
			</div>
                     
			<div class="form-group" style="padding-top: 3px;padding-right: 2px;">
						
				<select class="form-control form-control-sm mr-3" name="price_filter" id="price_filter">			
					<option value=""><?php echo get_msg('Select Price');?></option>
					<option value="Low to high">Low to high</option>
					<option value="high to low">high to low</option>
				</select> 
			</div>


		  	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<button type="submit" value="submit" name="submit" class="btn btn-sm btn-primary">
			  		<?php echo get_msg( 'btn_search' )?>
			  	</button>
		  	</div>
		
			<div class="form-group" style="padding-top: 3px;">
			  	<a href='<?php echo $module_site_url .'/index';?>' class='btn btn-sm btn-primary'>
					<?php echo get_msg( 'btn_reset' )?>
				</a>
		  	</div>

		</div>
	</div>

</div>
<style type="text/css">
	.btnnn li{
		list-style: none;
		float: left;
		margin-left: 10px;
	}
</style>
<div class="row my-3">	
	<!-- end form-inline -->
	<div class="col-md-9"></div>
	<div class='col-md-3 '>
	    <ul class="btnnn">	
		    <li>
				<div class="form-group" style="display: inline-block;">
				    <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				       <span class='fa fa-plus'></span> 
				    		Map
                    </a>
				</div>
			</li>
			<li>
				<div class="form-group" style="display: inline-block;">
					<button type="button" class='btn btn-sm btn-primary pull-right' data-toggle="modal" data-target="#exampleModal">
						<span class='fa fa-plus'></span> 
						Bulk Upload
					</button>
				</div>
			</li>
			<li>
				<div class="form-group" style="display: inline-block;">
					<a href='<?php echo $module_site_url .'/add';?>' class='btn btn-sm btn-primary pull-right'>
						<span class='fa fa-plus'></span> 
						<?php echo get_msg( 'prd_add' )?>
					</a>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php echo form_close(); ?>


<!-----------properties location on map------------------>

<style>
.title{
	font-size: 20px;
	font-weight: bold;
}
.itemdata{
	font-size: 15px;
}
.action{
	font-size: 15px;
	font-weight: bold;
}
.del{
	color: red;
}
.iteminfo{
	background-color: #D5D8DC;
}
.mapitem_info{
	width:100%;
	background-color: white;
	margin-top:6px;
}
.item_location{
	width:100%;
	background-color: white;
	margin-top:6px;
	margin-bottom:6px; 
	transition: all 350ms ease-in-out;
}
.item_location:hover {
  transform: translate(0, -.3rem);	
  box-shadow: 0 5px 14px rgba(36,44,43,.8); 
  transition: 0.4s;
}
</style>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
  <div  style="height:690px; width:100%;">
		    <div id ='dataitem'style="display:none;">
			   <?php
				  $item = $items->result();
				  echo json_encode($item);
			   ?>
			</div>
		    <div id="map" style="height:690px; width:76%;float:left;"></div>
			<div class="iteminfo" style="height:690px; width:23%; overflow: scroll; float:left; margin-left:10px; ">
			    <div id="propertydata" style="margin: 10px 10px 5px;">
				   <?php
					  echo '<h4 class="text-primary">'.count($item).' Total Properties</h4>';
					?>
					<div style="padding-top:15px;">
					<?php
						if(isset($mapitem)){
                            ?>

							    <div class="mapitem_info btn text-left pl-2">
							     	<?php echo '<h4>'.$mapitem->title.'</h4>'; ?>
									<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						        	    <div class="carousel-inner">
										<?php
											$conds = array('img_type' => 'item', 'img_parent_id' => $mapitem->id);
											$images = $this->Image->get_all_by($conds)->result();
											$num=0;
										    foreach ($images as $img){
												if($num == 0){
													$active = "active";
												}else{
													$active = "";
												}
								                echo '<div class="carousel-item '.$active.'">
							                    	    <img class="d-block w-100" src="'.img_url($img->img_path).'"  alt="First slide">
													  </div>';
												$num++;	  	  
							                }
							            ?>
						        	    </div>
						        	    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						        	      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						        	      <span class="sr-only">Previous</span>
						        	    </a>
						        	    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						        	      <span class="carousel-control-next-icon" aria-hidden="true"></span>
						        	      <span class="sr-only">Next</span>
						        	    </a>
									</div>
									<p>
									   Location : <?php echo $this->Itemlocation->get_one( $mapitem->item_location_id )->name; ?></br>
									   Category Name : <?php echo $this->Category->get_one( $mapitem->cat_id )->cat_name ;?></br>
									   Price : <?php echo $mapitem->price; ?></br>
									   Item for : <?php echo $this->Itemtype->get_one( $mapitem->item_type_id )->name ;?></br>

									</p>
								    <?php
								       
								    ?>	
								</div>
						<?php								
						 }else{
							foreach($items->result() as $item){
								$title = '<h4 class="text">'.$item->title.'</h4>';
								$locations = $this->Itemlocation->get_one($item->item_location_id);
								$locationname =$locations->name;  
								$locationname = '<p class="">'.$locationname.'</br>';
								$price = ''.$item->price.': Price</p>';
								echo '<a href="'.$module_site_url .'/map_item/'. $item->id.'" style="text-decoration: none;">
									 	<div class="item_location btn text-left pl-4">'.$title.''.$locationname.''.$price.'</div>
									  </a>';
							} 
						 } 
					?>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>


<!-----------properties location on map END------------------>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bulk Upload Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="import_csv" enctype="multipart/form-data">
        	<input type="hidden" name="csrf_test_name" value="28147c3a4942b0ea4ef77b23d64deade">
        	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>File Items Upload (*)</label>
			  	<input type="file" name="csv_file" id="csv_file" class="form-control" required accept=".csv" /><br>
		  	</div>
		  	<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
		  	<div class="form-group" style="padding-top: 3px;padding-right: 5px;">
			  	<label>Download Items Sample</label>
			  	<a href="<?php echo base_url();?>csv_sample/book1.csv" download>Download bulk upload items sample file</a>
		  	</div>
			<div id="message" style="display: none;">
				<div class="alert alert-success" role="alert">
				  Bulk upload items saved successfully!
				</div>
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	
<?php if ( $this->config->item( 'client_side_validation' ) == true ): ?>
	function jqvalidate() {
	$('#cat_id').on('change', function() {

			var catId = $(this).val();
			
			$.ajax({
				url: '<?php echo $module_site_url . '/get_all_sub_categories/';?>' + catId,
				method: 'GET',
				dataType: 'JSON',
				success:function(data){
					$('#sub_cat_id').html("");
					$.each(data, function(i, obj){
					    $('#sub_cat_id').append('<option value="'+ obj.id +'">' + obj.name + '</option>');
					});
					$('#name').val($('#name').val() + " ").blur();
				}
			});
		});
}
	<?php endif; ?>

$('#import_csv').on('submit', function(event){
	event.preventDefault();
	$.ajax({
		url:"<?php echo $module_site_url .'/import';?>",
		method:"POST",
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		beforeSend:function(){
			$('#import_csv_btn').html('Importing...');
		},
		success:function(data)
		{
			$('#import_csv')[0].reset();
			$('#import_csv_btn').attr('disabled', false);
			if(data == 1){
				$('#import_csv_btn').html('Import Done');
				$("#message").show();
				setTimeout(function () { 
			        location.reload(true); 
			    }, 1000); 
			}

		}
	})
});
</script>

<!---google maps---->



<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLrf_zz0R_S7I3bAYXMmy9e3W0Fz4qMRE&callback=initMap&libraries=&v=weekly"></script>

<script>

function initMap() {

var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 
	  <?php 
	  	if(($mapitem->lat == 0.000000 || $mapitem->lat == null) && ($mapitem->lng == 0.000000 || $mapitem->lng == null ) ){
             echo 7;
		}elseif($mapitem){
			 echo 15;
		}elseif(count($items->result()) == 1){
			 echo 15;
		 }else{
			 echo 7;
		 }
		?>,
  center: {
		<?php
		    if(($mapitem->lat == 0.000000 || $mapitem->lat == null) && ($mapitem->lng == 0.000000 || $mapitem->lng == null ) ){
              echo 'lat: 17.3850,lng: 78.4867' ;
		    }elseif($mapitem){
			echo 'lat:'. $mapitem->lat.',lng:'.$mapitem->lng.'';
		    }elseif(count($items->result()) == 1){
		  	 echo 'lat:'. $item->lat.',lng:'.$item->lng.'';
		   }else{
			 echo 'lat: 17.3850,lng: 78.4867';
		   }
		?>
         }
});
var infoWin = new google.maps.InfoWindow();

var markers = locations.map(function(location, i) {
  var marker = new google.maps.Marker({
	position: location
  });
  google.maps.event.addListener(marker, 'click', function(evt) {
	infoWin.setContent(location.info);
	infoWin.open(map, marker);
  })
  return marker;
});

// Add a marker clusterer to manage the markers.
var markerCluster = new MarkerClusterer(map, markers, {
  imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
});

}


var locations =[
	<?php foreach($items->result() as $item){ 
		$showitem = '<a href='.$module_site_url .'/map_item/'. $item->id.'><span onclick='.'propertyinfo('.$item->id.')'.'>Showinfo</span></a>';
		$locations = $this->Itemlocation->get_one($item->item_location_id);
		$locationname =$locations->name;
		$edit = '<a href='. $module_site_url .'/edit/' .  $item->id.'>Edit</a>';
		$delete = '<a herf='.'#'.' class='.'btn-delete'.' data-toggle='.'modal'.' data-target='.'#myModal'.' id='.$item->id.'><span class='.'del'.'>Delete</span></a>';
		$actions = '<span class='.'action'.'>'.$edit.'<span>, <span class='.'action del'.'>'.$delete.'<span>, <span class='.'action del'.'>'.$showitem.'<span>';

		$itemdata = '<div><p><span class='.'title'.'>'.$item->title.'</span></br><span  class='.'itemdata'.'>'.$locationname.'</span></br><span  class='.'itemdata'.'>'.$item->price.'</span></p><p class='.'action'.'> Actions :'.$actions.'</p></div>';
		if(($item->lat == 0.000000 || $item->lat == null) && ($item->lng == 0.000000 || $item->lng == null ) ){
			$markerlocation = ''; 
		}else{
			$markerlocation = '{ lat: '. $item->lat . ', lng: ' . $item->lng . ', info: ' . '"' .$itemdata. '"'. ' },'; 
		}
		echo $markerlocation;
	} ?>
]
function propertyinfo(getitemdata) {
  document.getElementById("propertydata").innerHTML = "<p class='text-bold>" + itm + "</p>";
}



google.maps.event.addDomListener(window, "load", initMap);

</script>
