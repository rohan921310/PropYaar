<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Items extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Item' );

		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}

	}

	/**
	 * Default Query for API 
	 * @return [type] [description]
	 */
	function default_conds()
	{
		$conds = array();

		if ( $this->is_get ) {
		// if is get record using GET method

			// get default setting for GET_ALL_CATEGORIES
			//$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_CATEGORIES ));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}

		if ( $this->is_search ) {

			//$setting = $this->Api->get_one_by( array( 'api_constant' => SEARCH_WALLPAPERS ));


			if($this->post('id') != "") {
				$conds['id']   = $this->post('id');
			}

			if($this->post('searchterm') != "") {
				$conds['searchterm']   = $this->post('searchterm');
			}

			if($this->post('is_shares_property') != "") {
				$conds['is_shares_property']   = $this->post('is_shares_property');
			}

			if($this->post('is_best_deal') != "") {
				$conds['is_best_deal']   = $this->post('is_best_deal');
			}

			if($this->post('is_limited_offer') != "") {
				$conds['is_limited_offer']   = $this->post('is_limited_offer');
			}

			if($this->post('area') != "") {
				$conds['area']   = $this->post('area');
			}

			if($this->post('brand_id') != "") {
				$conds['brand_id']   = $this->post('brand_id');
			}

			if($this->post('cat_id') != "") {
				$conds['cat_id']   = $this->post('cat_id');
			}

			if($this->post('furnishing_id') != "") {
				$conds['furnishing_id']   = $this->post('furnishing_id');
			}

			if($this->post('sub_cat_id') != "") {
				$conds['sub_cat_id']   = $this->post('sub_cat_id');
			}

			if($this->post('item_type_id') != "") {
				$conds['item_type_id']   = $this->post('item_type_id');
			}

			if($this->post('item_price_type_id') != "") {
				$conds['item_price_type_id']   = $this->post('item_price_type_id');
			}

			if($this->post('item_currency_id') != "") {
				$conds['item_currency_id']   = $this->post('item_currency_id');
			}
			if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') != "") {
				$conds['item_location_id']   = $this->post('item_location_id');
			} if($this->post('lat') != "" && $this->post('lng') != "" && $this->post('miles') != "" && $this->post('item_location_id') == "") {
				$conds['item_location_id']   ="";
			} else {
				if($this->post('item_location_id') != "") {
					$conds['item_location_id']   = $this->post('item_location_id');
				}
			}

			if($this->post('deal_option_id') != "") {
				$conds['deal_option_id']   = $this->post('deal_option_id');
			}

			if($this->post('condition_of_item_id') != "") {
				$conds['condition_of_item_id']   = $this->post('condition_of_item_id');
			}

			if($this->post('min_price') != "") {
				$conds['min_price']   = $this->post('min_price');
			}

			if($this->post('max_price') != "") {
				$conds['max_price']   = $this->post('max_price');
			}

			if($this->post('project_name') != "") {
				$conds['project_name']   = $this->post('project_name');
			}

			if($this->post('lat') != "") {
				$conds['lat']   = $this->post('lat');
			}

			if($this->post('lng') != "") {
				$conds['lng']   = $this->post('lng');
			}

			if($this->post('miles') != "") {
				$conds['miles']   = $this->post('miles');
			}

			if($this->post('added_user_id') != "") {
				$conds['added_user_id']   = $this->post('added_user_id');
			}

			if($this->post('is_paid') != "") {
				$conds['is_paid']   = $this->post('is_paid');
			}

			if($this->post('status') != "") {
				$conds['status']   = $this->post('status');
			}

			if($this->post('price_filter') != "") {
				$conds['price_filter'] = $this->post('price_filter');	
			}

			if($this->post('bedrooms') != "") {
				$conds['bedrooms'] = $this->post('bedrooms');	
			}

			if($this->post('bathrooms') != "") {
				$conds['bathrooms'] = $this->post('bathrooms');	
			}

			if($this->post('map_layout_id') != "") {
				$conds['map_layout_id'] = $this->post('map_layout_id');	
			}

			$conds['item_search'] = 1;
			$conds['order_by'] = 1;
			$conds['order_by_field']    = $this->post('order_by');
			$conds['order_by_type']     = $this->post('order_type');
				
		}

		return $conds;
	}

    function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++){
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'org_'.$key;
	}


	function add_post() {
		
		$approval_enable = $this->App_setting->get_one('app1')->is_approval_enabled;
		if ($approval_enable == 1) {
			$status = 0;
		} else {
			$status = 1;
		}
		$lat = $this->post('lat');
		$lng = $this->post('lng');
		// $location = location_check($lat,$lng);
		

		$main_id = $this->post('id');
		if($main_id != ""){
			$obj = $this->Item->get_one( $main_id );

			$rand_id = $obj->org_id;
		}else{

			$rand_id = $this->RandomString(20);
		}

	  	$item_data = array(

			"cat_id" => $this->post('cat_id'),
			"furnishing_id" => $this->post('furnishing_id'), 
        	"sub_cat_id" => $this->post('sub_cat_id'),
        	"item_type_id" => $this->post('item_type_id'),
        	"item_price_type_id" => $this->post('item_price_type_id'),
        	//"item_currency_id" => $this->post('item_currency_id'), 
        	"condition_of_item_id" => $this->post('condition_of_item_id'),
        	"item_location_id" => $this->post('item_location_id'),
        	"deal_option_remark" => $this->post('deal_option_remark'),
        	"description" => $this->post('description'),
        	"highlight_info" => $this->post('highlight_info'),
			"price" => $this->post('price'),
			"price_end" => $this->post('price_end'),
			"rent_collection_type" => $this->post('rent_collection_type'),
			"bachelors_allowed" => $this->post('bachelors_allowed'),
			"maintanance" => $this->post('maintanance'),
        	"deal_option_id" => $this->post('deal_option_id'),
        	"project_name" => $this->post('project_name'),
        	"business_mode" => $this->post('business_mode'),
        	"is_sold_out" => $this->post('is_sold_out'),
        	"title" => $this->post('title'),
            "property_id" => $this->post('property_id'),
        	"address" => $this->post('address'),
            "numberofbedrooms" => $this->post('numberofbedrooms'),
            "numberofbathrooms" => $this->post('numberofbathrooms'),
        	"lat" => $this->post('lat'),
        	"lng" => $this->post('lng'),
        	"status" => $status,
			"id" => $this->post('id'),
			"area" => $this->post('area'),
			"area_type" => $this->post('area_type'),
			'length' => $this->post('length'),
			'breadth' => $this->post('breadth'),
			"added_user_id" => $this->post('added_user_id'),
			"listed_by" => $this->post('listed_by'),
			"facing" => $this->post('facing'),
			"car_parking" => $this->post('car_parking'),
			"total_floors" => $this->post('total_floors'),
			"floor_no" => $this->post('floor_no'),
			"is_premium" => $this->post('is_premium'),
			"is_verified" => $this->post('is_verified'),
			"listed_by_name"=>$this->post('listed_by_name'),	
			"listed_by_phone"=>$this->post('listed_by_phone'),
			"org_id"=>$rand_id,
			"is_call_allowed"=>$this->post('is_call_allowed'),
			"is_whatsapp_allowed"=>$this->post('is_whatsapp_allowed'),
			"possession_start_date"=>$this->post('possession_start_date'),
			"rera_id"=>$this->post('rera_id'),
			"per_growth_rate"=>$this->post('per_growth_rate'),
			"growth_rate_duration"=>$this->post('growth_rate_duration'),
			"is_limited_offer"=>$this->post('is_limited_offer'),
			"is_best_deal"=>$this->post('is_best_deal'),
			"is_shares_property"=>$this->post('is_shares_property'),
			"launch_date"=>$this->post('launch_date'),
			"total_project_area"=>$this->post('total_project_area'),
			"total_planned_units"=>$this->post('total_planned_units'),
			"towers"=>$this->post('towers'),
			"about_builder"=>$this->post('about_builder'),
			"construction_details"=>$this->post('construction_details'),
			
			"risee_score"=>$this->post('risee_score'),
			"is_car_parking"=>$this->post('is_car_parking'),
			"is_indoor_games"=>$this->post('is_indoor_games'),
			"is_garden"=>$this->post('is_garden'),
			"is_spa_available"=>$this->post('is_spa_available'),
			"is_tennis_court"=>$this->post('is_tennis_court'),
			
			"is_gated_community"=>$this->post('is_gated_community'),
			"is_24_water_supply"=>$this->post('is_24_water_supply'),
			"is_intercom_facility"=>$this->post('is_intercom_facility'),
			"is_fire_alarm"=>$this->post('is_fire_alarm'),
			"is_swimming_pool"=>$this->post('is_swimming_pool'),
			"is_gym"=>$this->post('is_gym'),
			"is_bank_approval"=>$this->post('is_bank_approval'),
			"is_park"=>$this->post('is_park'),
			"is_jogging_track"=>$this->post('is_jogging_track'),
			"is_library"=>$this->post('is_library'),
			"no_project_floors"=>$this->post('no_project_floors'),
            "youtube_url_link"=>$this->post('youtube_url_link'),
			"price_SqYard"=>$this->post('price_SqYard'),
			"Lp_number"=>$this->post('lp_number'),
			"plot_type"=>$this->post('plot_type'),
			"is_hmda"=>$this->post('is_hmda'),
			"is_dtcp"=>$this->post('is_dtcp'),
			"is_rera_approved"=>$this->post('is_rera_approved'),
			"map_layout_id"=>$this->post('map_layout_id')
		);


		$id = $item_data['id'];
		
		if($id != ""){
		 	$this->Item->save($item_data,$id);

		} else{
		 	 $this->Item->save($item_data);

			 $id = $item_data['id'];
			 $posted_user_name = $this->User->get_one( $item_data['added_user_id'] )->user_name;
			 
			 $message = "Hello Admin, RISEE user(".$posted_user_name.") Added a property(" . $item_data['title'] .").";

			 //$error_msg = "";
			 //$success_device_log = "";
			 //$added_user_id = $this->Pending->get_one($property_id)->added_user_id;
			 $user_phone = "+918688932501";
			 $token = $this->User->get_device_token($user_phone);
			 $user_device_token = $token[0]->device_token;

			 if($user_device_token != "") {
				$devices[] = $user_device_token;
				
				$device_ids = array();
				if ( count( $devices ) > 0 ) {
					
					for($i=0; $i < count($devices); $i++) {
						$device_ids[] = $devices[0];
					}
				}
				
				$this->send_android_fcm2( $device_ids, array( "message" => $message ));

			}
		}
		 
		$obj = $this->Item->get_one( $id );

		$usr_id = $obj->added_user_id;

		$org_id=$obj->org_id;

		$org_data = array(
			"org_id"=>$org_id,
			"org_name"=>$this->post('org_name'),
			"org_type"=>$this->post('org_type'),
			"org_location"=>$this->post('org_location'),
		);

		if($main_id != ""){
			$this->Organisation_model->update_org( $org_data,$org_id);
		}else{
			$this->Organisation_model->save_org($org_data);
		}

		$locations = $this->Itemlocation->get_all();
		foreach ($locations->result() as $location) {
			$location_id = $location->id;
			$this->Item->sale_count($location_id);
			$this->Item->rent_count($location_id);
		  }

		$listing_count =  $this->Item->listing_count($usr_id);
		$pendings_count = $this->Item->pendings_count($usr_id);
		$indrafts_count = $this->Item->indrafts_count($usr_id);
		$rejected_count = $this->Item->rejected_count($usr_id);
		
		$this->ps_adapter->convert_item( $obj );
		$this->custom_response( $obj );

	}


	function status_by_admin_post(){

		$user_phone = "+918688932501";
		$token = $this->User->get_device_token($user_phone);
		$check_device_token = $token[0]->device_token;
		$device_token = $this->post('admin_device_token');
		 
		if($device_token == $check_device_token){

		    $item_id = $this->post('id');
		    $item_status = $this->post('status');
    
		    if(!$this->Item->update_status_admin($item_id,$item_status)){
		    	$this->error_response( get_msg( 'failed' ));
		    }else{
    
		    	//// Start - Send Noti /////
    
		    	$title = $this->Item->get_one($item_id)->title;
    
    
		        if($item_status == 1) {
		        	//approve so change status to publish (1)
		        	$message = get_msg( 'approve_message_1' ) . $title . get_msg( 'approve_message_2' );
		        } else if ($item_status == 3) {
		        	//reject so change status to reject (3)
		        	$message = "Your Posted Item(". $title .") has been Rejected, please post it again ";
		        }
		        $error_msg = "";
		        $success_device_log = "";
		        $added_user_id = $this->Item->get_one($item_id)->added_user_id;
		        $user_device_token = $this->User->get_one($added_user_id)->device_token;
		        //$user_name = $this->User->get_one($added_user_id)->user_name;
		        
		        //echo $user_device_token; die;
		        if($user_device_token != "") {
		        	$devices[] = $user_device_token;
		        	
		        	$device_ids = array();
		        	if ( count( $devices ) > 0 ) {
		        		
		        		for($i=0; $i < count($devices); $i++) {
		        			$device_ids[] = $devices[0];
		        		}
		        	}
		        	if(($item_status == 1) || ($item_status == 3)) {
		    			 $status = $this->send_android_fcm2( $device_ids, array( "message" => $message ));
		    			 
		    			 if($status){
		    				$this->success_response( get_msg( 'success' ));
		    			 }
		        	}
		        	
		        }
		        //// End - Send Noti /////
		    }
	    }

	}


	/**
	* Trigger to delete item related data when item is deleted
	* delete item related data
	*/

	function item_delete_post( ) {

		// validation rules for item register
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
	    );   
	    
	    // exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $id = $this->post('item_id');

		$conds['id'] = $id;
		
		$obj = $this->Item->get_one( $id );

		$usr_id = $obj->added_user_id;

        // check user id

        $item_data = $this->Item->get_one_by($conds);

        //print_r($item_data);die;


        if ( $item_data->id == "" ) {

        	$this->error_response( get_msg( 'invalid_item_id' ));

        } else {

        	$conds_id['id'] = $id;
        	$conds_item['item_id'] = $id;
        	$conds_img['img_parent_id'] = $id;

			// delete Item
			if ( !$this->Item->delete_by( $conds_id )) {

				return false;
			}

			
			// delete chat history
			if ( !$this->Chat->delete_by( $conds_item )) {

				return false;
			}

			// delete favourite
			if ( !$this->Favourite->delete_by( $conds_item )) {

				return false;
			}

			// delete item reports
			if ( !$this->Itemreport->delete_by( $conds_item )) {

				return false;
			}

			// delete touches
			if ( !$this->Touch->delete_by( $conds_item )) {

				return false;
			}

			// delete images
			if ( !$this->Image->delete_by( $conds_img )) {

				return false;
			}

			$locations = $this->Itemlocation->get_all();
			foreach ($locations->result() as $location) {
				$location_id = $location->id;
				$this->Item->sale_count($location_id);
				$this->Item->rent_count($location_id);
			  }

	
			$listing_count = $this->Item->listing_count($usr_id);
			$pendings_count = $this->Item->pendings_count($usr_id);
			$indrafts_count = $this->Item->indrafts_count($usr_id);
			$rejected_count = $this->Item->rejected_count($usr_id);
			
			$this->success_response( get_msg( 'success_delete' ));

		}
		

	}

	/**
	 * Update Price 
	 */
	function sold_out_from_itemdetails_post()
	{
		// validation rules for chat history
		$rules = array(
			array(
	        	'field' => 'item_id',
	        	'rules' => 'required'
	        )
        );


		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;
        $id = $this->post('item_id');
        $item_sold_out = array(

        	"is_sold_out" => 1, 

        );

        $this->Item->save($item_sold_out,$id);
        $conds['id'] = $id;
        
        $obj = $this->Item->get_one_by($conds);

        $this->ps_adapter->convert_item( $obj );
        $this->custom_response($obj);
    }


	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );

		// convert customize item object
		$this->ps_adapter->convert_item( $obj );
	}

}