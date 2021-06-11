<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Items Controller
 */
class Items extends BE_Controller {
	/**
	 * Construt required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'item_module' );
		$this->load->model('csv_import_model');
		$this->load->model('Organisation_model');
		$this->load->library('csvimport');
	}
	/**
	 * List down the registered users
	 */
	function index() {
		// get rows count
		$this->data['rows_count'] = $this->Item->count_all_by( $conds );
		// get categories
		$this->data['items'] = $this->Item->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		//read items
		$this->Item->read_item();

		// load index logic
		parent::index();
	}
	/**
	 * Searches for the first match.
	 */
	function search() {
		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_search' );
		// condition with search term
		if($this->input->post('submit') != NULL ){
			if($this->input->post('searchterm') != "") {
				$conds['searchterm'] = $this->input->post('searchterm');
				$this->data['searchterm'] = $this->input->post('searchterm');
				$this->session->set_userdata(array("searchterm" => $this->input->post('searchterm')));
			} else {
				
				$this->session->set_userdata(array("searchterm" => NULL));
			}
			
			if($this->input->post('cat_id') != ""  || $this->input->post('cat_id') != '0') {
				$conds['cat_id'] = $this->input->post('cat_id');
				$this->data['cat_id'] = $this->input->post('cat_id');
				$this->data['selected_cat_id'] = $this->input->post('cat_id');
				$this->session->set_userdata(array("cat_id" => $this->input->post('cat_id')));
				$this->session->set_userdata(array("selected_cat_id" => $this->input->post('cat_id')));
			} else {
				$this->session->set_userdata(array("cat_id" => NULL ));
			}
			if($this->input->post('sub_cat_id') != ""  || $this->input->post('sub_cat_id') != '0') {
				$conds['sub_cat_id'] = $this->input->post('sub_cat_id');
				$this->data['sub_cat_id'] = $this->input->post('sub_cat_id');
				$this->session->set_userdata(array("sub_cat_id" => $this->input->post('sub_cat_id')));
			} else {
				$this->session->set_userdata(array("sub_cat_id" => NULL ));
			}
			if($this->input->post('item_price_type_id') != ""  || $this->input->post('item_price_type_id') != '0') {
				$conds['item_price_type_id'] = $this->input->post('item_price_type_id');
				$this->data['item_price_type_id'] = $this->input->post('item_price_type_id');
				
				$this->session->set_userdata(array("item_price_type_id" => $this->input->post('item_price_type_id')));
				
			} else {
				$this->session->set_userdata(array("item_price_type_id" => NULL ));
			}
			if($this->input->post('item_type_id') != ""  || $this->input->post('item_type_id') != '0') {
				$conds['item_type_id'] = $this->input->post('item_type_id');
				$this->data['item_type_id'] = $this->input->post('item_type_id');
				
				$this->session->set_userdata(array("item_type_id" => $this->input->post('item_type_id')));
				
			} else {
				$this->session->set_userdata(array("item_type_id" => NULL ));
			}
			if($this->input->post('item_currency_id') != ""  || $this->input->post('item_currency_id') != '0') {
				$conds['item_currency_id'] = $this->input->post('item_currency_id');
				$this->data['item_currency_id'] = $this->input->post('item_currency_id');
				
				$this->session->set_userdata(array("item_currency_id" => $this->input->post('item_currency_id')));
				
			} else {
				$this->session->set_userdata(array("item_currency_id" => NULL ));
			}
			if($this->input->post('status') != "0") {
				
				$conds['status'] = $this->input->post('status');
				$this->data['status'] = $this->input->post('status');
				$this->session->set_userdata(array("status" => $this->input->post('status')));
			
			} else {
				$this->session->set_userdata(array("status" => NULL ));
			}
		} else {
			//read from session value
			if($this->session->userdata('searchterm') != NULL){
				$conds['searchterm'] = $this->session->userdata('searchterm');
				$this->data['searchterm'] = $this->session->userdata('searchterm');
			}
			if($this->session->userdata('cat_id') != NULL){
				$conds['cat_id'] = $this->session->userdata('cat_id');
				$this->data['cat_id'] = $this->session->userdata('cat_id');
				$this->data['selected_cat_id'] = $this->session->userdata('cat_id');
			}
			if($this->session->userdata('sub_cat_id') != NULL){
				$conds['sub_cat_id'] = $this->session->userdata('sub_cat_id');
				$this->data['sub_cat_id'] = $this->session->userdata('sub_cat_id');
				$this->data['selected_cat_id'] = $this->session->userdata('cat_id');
			}
			if($this->session->userdata('item_price_type_id') != NULL){
				$conds['item_price_type_id'] = $this->session->userdata('item_price_type_id');
				$this->data['item_price_type_id'] = $this->session->userdata('item_price_type_id');
			}
			if($this->session->userdata('item_type_id') != NULL){
				$conds['item_type_id'] = $this->session->userdata('item_type_id');
				$this->data['item_type_id'] = $this->session->userdata('item_type_id');
			}
			if($this->session->userdata('item_currency_id') != NULL){
				$conds['item_currency_id'] = $this->session->userdata('item_currency_id');
				$this->data['item_currency_id'] = $this->session->userdata('item_currency_id');
			}
		
			if($this->session->userdata('status') != 0){
				$conds['status'] = $this->session->userdata('status');
				$this->data['status'] = $this->session->userdata('status');
			}
			
		}
		if ($conds['status'] == "Select Status") {
			$conds['status'] = "1";
		}

		if($this->input->post('price_filter') != ""){
			if($this->input->post('price_filter') == "Low to high"){
				$conds['price_filter'] = "asc";	
			}
			if($this->input->post('price_filter') == "high to low"){
				$conds['price_filter'] = "desc";	
			}
		}
		
		// pagination
		$this->data['rows_count'] = $this->Item->count_all_by( $conds );
		// search data
		$this->data['items'] = $this->Item->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load add list
		parent::search();
	}


	function RandomString_org($str,$length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++){
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return $str.''.$key;
	}



	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save category
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		
		$logged_in_user = $this->ps_auth->get_user_info();
		// Item id
		   if ( $this->has_data( 'id' )) {
			$data['id'] = $this->get_data( 'id' );
		}
		   // Category id
		   if ( $this->has_data( 'cat_id' )) {
			$data['cat_id'] = $this->get_data( 'cat_id' );
		}

		if($id == ""){
			$rand_id_org = $this->RandomString_org('org_',24);

			$data['org_id'] = $rand_id_org;
		}

		if($id == ""){
			$rand_id_project = $this->RandomString_org('PRJT_',24);

			$data['project_id'] = $rand_id_project;
		}

		// furnishing_id
		   if ( $this->has_data( 'furnishing_id' )) {
			$data['furnishing_id'] = $this->get_data( 'furnishing_id' );
		}
		// Sub Category id
		   if ( $this->has_data( 'sub_cat_id' )) {
			$data['sub_cat_id'] = $this->get_data( 'sub_cat_id' );
		}
		// Type id
		   if ( $this->has_data( 'item_type_id' )) {
			$data['item_type_id'] = $this->get_data( 'item_type_id' );
		}
		// Price id
		   if ( $this->has_data( 'item_price_type_id' )) {
			$data['item_price_type_id'] = $this->get_data( 'item_price_type_id' );
		}
		// Currency id
		   //if ( $this->has_data( 'item_currency_id' )) {
		//	$data['item_currency_id'] = $this->get_data( 'item_currency_id' );
		//}
		// location id
		   if ( $this->has_data( 'item_location_id' )) {
			$data['item_location_id'] = $this->get_data( 'item_location_id' );
		}
		//title
		   if ( $this->has_data( 'title' )) {
			$data['title'] = $this->get_data( 'title' );
		}
		if ( $this->has_data( 'property_id' )) {
			$data['property_id'] = $this->get_data( 'property_id' );
		}
		//condition of item
		   if ( $this->has_data( 'condition_of_item_id' )) {
			$data['condition_of_item_id'] = $this->get_data( 'condition_of_item_id' );
		}
		// description
		   if ( $this->has_data( 'description' )) {
			$data['description'] = $this->get_data( 'description' );
		}
		// highlight_info
		   if ( $this->has_data( 'highlight_info' )) {
			$data['highlight_info'] = $this->get_data( 'highlight_info' );
		}
		// price
		   if ( $this->has_data( 'price' )) {
			$data['price'] = $this->get_data( 'price' );
		}

		// price_end
		if ( $this->has_data( 'price_end' )) {
			$data['price_end'] = $this->get_data( 'price_end' );
		}

		// rent_collection_type
		if ( $this->has_data( 'rent_collection_type' )) {
			$data['rent_collection_type'] = $this->get_data( 'rent_collection_type' );
		}

		// bachelors_allowed
		if ( $this->has_data( 'bachelors_allowed' )) {
			$data['bachelors_allowed'] = $this->get_data( 'bachelors_allowed' );
		}

		// maintanance
		if ( $this->has_data( 'maintanance' )) {
			$data['maintanance'] = $this->get_data( 'maintanance' );
		}

		// project_name
		   if ( $this->has_data( 'project_name' )) {
			$data['project_name'] = $this->get_data( 'project_name' );
		}
		if ( $this->has_data( 'numberofbedrooms' )) {
			$data['numberofbedrooms'] = $this->get_data( 'numberofbedrooms' );
		}
		if ( $this->has_data( 'numberofbathrooms' )) {
			$data['numberofbathrooms'] = $this->get_data( 'numberofbathrooms' );
		}


		if ( $this->has_data( 'area' )) {
			$data['area'] = $this->get_data( 'area' );
		} 

		if ( $this->has_data( 'area_type' )) {
			$data['area_type'] = $this->get_data( 'area_type' );
		} 

		if ( $this->has_data( 'length' )) {
			$data['length'] = $this->get_data( 'length' );
		} 

		if ( $this->has_data( 'breadth' )) {
			$data['breadth'] = $this->get_data( 'breadth' );
		} 

		if ( $this->has_data( 'listed_by' )) {
			$data['listed_by'] = $this->get_data( 'listed_by' );
		}

		if ( $this->has_data( 'facing' )) {
			$data['facing'] = $this->get_data( 'facing' );
		}

		if ( $this->has_data( 'car_parking' )) {
			$data['car_parking'] = $this->get_data( 'car_parking' );
		}

		if ( $this->has_data( 'listed_by_name' )) {
			$data['listed_by_name'] = $this->get_data( 'listed_by_name' );
		}

		if ( $this->has_data( 'listed_by_phone' )) {
			$data['listed_by_phone'] = $this->get_data( 'listed_by_phone' );
		}

		if ( $this->has_data( 'total_floors' )) {
			$data['total_floors'] = $this->get_data( 'total_floors' );
		}

		if ( $this->has_data( 'floor_no' )) {
			$data['floor_no'] = $this->get_data( 'floor_no' );
		}

		// address
		   if ( $this->has_data( 'address' )) {
			$data['address'] = $this->get_data( 'address' );
		}
		// deal_option_id
		   if ( $this->has_data( 'deal_option_id' )) {
			$data['deal_option_id'] = $this->get_data( 'deal_option_id' );
		}
		// prepare Item lat
		if ( $this->has_data( 'lat' )) {
			$data['lat'] = $this->get_data( 'lat' );
		}
		// prepare Item lng
		if ( $this->has_data( 'lng' )) {
			$data['lng'] = $this->get_data( 'lng' );
		}

		if ( $this->has_data( 'possession_start_date' )) {
			$data['possession_start_date'] = $this->get_data( 'possession_start_date' );
		}

		if ( $this->has_data( 'rera_id' )) {
			$data['rera_id'] = $this->get_data( 'rera_id' );
		}

		if ( $this->has_data( 'per_growth_rate' )) {
			$data['per_growth_rate'] = $this->get_data( 'per_growth_rate' );
		}

		if ( $this->has_data( 'growth_rate_duration' )) {
			$data['growth_rate_duration'] = $this->get_data( 'growth_rate_duration' );
		}


		if ( $this->has_data( 'launch_date' )) {
			$data['launch_date'] = $this->get_data( 'launch_date' );
		}

		if ( $this->has_data( 'total_project_area' )) {
			$data['total_project_area'] = $this->get_data( 'total_project_area' );
		}

		if ( $this->has_data( 'total_planned_units' )) {
			$data['total_planned_units'] = $this->get_data( 'total_planned_units' );
		}

		if ( $this->has_data( 'towers' )) {
			$data['towers'] = $this->get_data( 'towers' );
		}

		if ( $this->has_data( 'about_builder' )) {
			$data['about_builder'] = $this->get_data( 'about_builder' );
		}

		if ( $this->has_data( 'construction_details' )) {
			$data['construction_details'] = $this->get_data( 'construction_details' );
		}

		if ( $this->has_data( 'no_project_floors' )) {
			$data['no_project_floors'] = $this->get_data( 'no_project_floors' );
		}

		if ( $this->has_data( 'youtube_url_link' )) {
			$data['youtube_url_link'] = $this->get_data( 'youtube_url_link' );
		}

		// location_short
		if ( $this->has_data( 'location_short' )) {
			$data['location_short'] = $this->get_data( 'location_short' );
		}

		//lp_number
		if ( $this->has_data( 'Lp_number' )) {
			$data['Lp_number'] = $this->get_data( 'Lp_number' );
		}

		//price_SqYard
		if ( $this->has_data( 'price_SqYard' )) {
			$data['price_SqYard'] = $this->get_data( 'price_SqYard' );
		}
		
		//plot_type
		if ( $this->has_data( 'plot_type' )) {
			$data['plot_type'] = $this->get_data( 'plot_type' );
		}		

		if ( $this->has_data( 'url_3dtour' )) {
			$data['url_3dtour'] = $this->get_data( 'url_3dtour' );
		}

		if ( $this->has_data( 'status' )) {
			$data['status'] = $this->get_data( 'status' );
		}

		if ( $this->has_data( 'risee_score' )) {
			$data['risee_score'] = $this->get_data( 'risee_score' );
		} 

		
		if ( $this->has_data( 'is_car_parking' )) {
			$data['is_car_parking'] = 1;
		} else {
			$data['is_car_parking'] = 0;
		}

		if ( $this->has_data( 'is_indoor_games' )) {
			$data['is_indoor_games'] = 1;
		} else {
			$data['is_indoor_games'] = 0;
		}

		if ( $this->has_data( 'is_garden' )) {
			$data['is_garden'] = 1;
		} else {
			$data['is_garden'] = 0;
		}

		if ( $this->has_data( 'is_spa_available' )) {
			$data['is_spa_available'] = 1;
		} else {
			$data['is_spa_available'] = 0;
		}

		if ( $this->has_data( 'is_tennis_court' )) {
			$data['is_tennis_court'] = 1;
		} else {
			$data['is_tennis_court'] = 0;
		}



		
		if ( $this->has_data( 'is_rera_approved' )) {
			$data['is_rera_approved'] = 1;
		} else {
			$data['is_rera_approved'] = 0;
		}

		if ( $this->has_data( 'is_3dtour_available' )) {
			$data['is_3dtour_available'] = 1;
		} else {
			$data['is_3dtour_available'] = 0;
		}

		if ( $this->has_data( 'is_vid_available' )) {
			$data['is_vid_available'] = 1;
		} else {
			$data['is_vid_available'] = 0;
		}

		if ( $this->has_data( 'is_gated_community' )) {
			$data['is_gated_community'] = 1;
		} else {
			$data['is_gated_community'] = 0;
		}

		if ( $this->has_data( 'is_24_water_supply' )) {
			$data['is_24_water_supply'] = 1;
		} else {
			$data['is_24_water_supply'] = 0;
		}

		if ( $this->has_data( 'is_intercom_facility' )) {
			$data['is_intercom_facility'] = 1;
		} else {
			$data['is_intercom_facility'] = 0;
		}

		if ( $this->has_data( 'is_fire_alarm' )) {
			$data['is_fire_alarm'] = 1;
		} else {
			$data['is_fire_alarm'] = 0;
		}

		if ( $this->has_data( 'is_swimming_pool' )) {
			$data['is_swimming_pool'] = 1;
		} else {
			$data['is_swimming_pool'] = 0;
		}

		if ( $this->has_data( 'is_gym' )) {
			$data['is_gym'] = 1;
		} else {
			$data['is_gym'] = 0;
		}

		if ( $this->has_data( 'is_bank_approval' )) {
			$data['is_bank_approval'] = 1;
		} else {
			$data['is_bank_approval'] = 0;
		}

		if ( $this->has_data( 'is_park' )) {
			$data['is_park'] = 1;
		} else {
			$data['is_park'] = 0;
		}

		if ( $this->has_data( 'is_jogging_track' )) {
			$data['is_jogging_track'] = 1;
		} else {
			$data['is_jogging_track'] = 0;
		}

		if ( $this->has_data( 'is_library' )) {
			$data['is_library'] = 1;
		} else {
			$data['is_library'] = 0;
		}

		if ( $this->has_data( 'is_hmda' )) {
			$data['is_hmda'] = 1;
		} else {
			$data['is_hmda'] = 0;
		}

		if ( $this->has_data( 'is_dtcp' )) {
			$data['is_dtcp'] = 1;
		} else {
			$data['is_dtcp'] = 0;
		}



		// if 'is_shares_property' is checked,
		if ( $this->has_data( 'is_shares_property' )) {
			$data['is_shares_property'] = 1;
		} else {
			$data['is_shares_property'] = 0;
		}

		// if 'is_best_deal' is checked,
		if ( $this->has_data( 'is_best_deal' )) {
			$data['is_best_deal'] = 1;
		} else {
			$data['is_best_deal'] = 0;
		}

		// if 'is_best_deal' is checked,
		if ( $this->has_data( 'is_limited_offer' )) {
			$data['is_limited_offer'] = 1;
		} else {
			$data['is_limited_offer'] = 0;
		}

		// if 'is_call_allowed' is checked,
		if ( $this->has_data( 'is_call_allowed' )) {
			$data['is_call_allowed'] = 1;
		} else {
			$data['is_call_allowed'] = 0;
		}

		// if 'is_whatsapp_allowed' is checked,
		if ( $this->has_data( 'is_whatsapp_allowed' )) {
			$data['is_whatsapp_allowed'] = 1;
		} else {
			$data['is_whatsapp_allowed'] = 0;
		}

		// if 'is_sold_out' is checked,
		if ( $this->has_data( 'is_sold_out' )) {
			$data['is_sold_out'] = 1;
		} else {
			$data['is_sold_out'] = 0;
		}
		// if 'business_mode' is checked,
		if ( $this->has_data( 'business_mode' )) {
			$data['business_mode'] = 1;
		} else {
			$data['business_mode'] = 0;
		}
		//// if 'status' is checked,
		//if ( $this->has_data( 'status' )) {
		//	$data['status'] = 1;
		//} else {
		//	$data['status'] = 0;
		//}

		// if 'is_premium' is checked,
		if ( $this->has_data( 'is_premium' )) {
			$data['is_premium'] = 1;
		} else {
			$data['is_premium'] = 0;
		}

		// if 'is_verified' is checked,
		if ( $this->has_data( 'is_verified' )) {
			$data['is_verified'] = 1;
		} else {
			$data['is_verified'] = 0;
		}

		// set timezone
		if($id == "") {
			//save
			date_default_timezone_set("Asia/Kolkata");
			$data['added_date'] = date("Y-m-d H:i:s");
			$data['added_user_id'] = $logged_in_user->user_id;
		} else {
			//edit
			unset($data['added_date']);
			date_default_timezone_set("Asia/Kolkata");
			$data['updated_date'] = date("Y-m-d H:i:s");
			$data['updated_user_id'] = $logged_in_user->user_id;
		}
		//save item
		if ( ! $this->Item->save( $data, $id )) {
		// if there is an error in inserting user data,	
			// rollback the transaction
			$this->db->trans_rollback();
			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}




    
    		//Create directory
    
			if($id != ""){
				if (!is_dir('uploads/'.$id)) {
					mkdir('./uploads/' . $id);
				}

				//Create file store path
			    $config['upload_path']   = './uploads/'.$id; 
			    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc'; 

			}else{
				if (!is_dir('uploads/'.$data['id'])) {
					mkdir('./uploads/' . $data['id']);
				}

				//Create file store path
			    $config['upload_path']   = './uploads/'.$data['id']; 
			    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc'; 
			}
    
    		$this->load->library('upload');
    		$this->upload->initialize($config);
    
    		if($id != ""){
    			$obj = $this->Item->get_one( $id );
    
    			$id_project=$obj->project_id;
    		}
    
    		//Uploading project details
    
    		$project_data['name'] = $data['project_name'];
    
    		if ( $this->has_data( 'no_units_available' )) {
    			$project_data['no_units_available'] = $this->get_data( 'no_units_available' );
			}
			
			if ( $this->has_data( 'project_website_url' )) {
				$project_data['project_website_url'] = $this->get_data( 'project_website_url' );
			}

			if ( $this->has_data( 'email_id' )) {
				$project_data['email_id'] = $this->get_data( 'email_id' );
			}

			if ( $this->has_data( 'about_project' )) {
				$project_data['about_project'] = $this->get_data( 'about_project' );
			}

		

			
    		if($id != ""){

				if ( $_FILES['project_icon']['name'] != "" ) {

					$this->upload->do_upload('project_icon');
					
					$project_data['project_icon'] = base_url().'uploads/'.$id.'/'.$this->upload->data('file_name');
				}
				// END project_icon

				if ( $_FILES['project_pdf']['name'] != "" ) {

					$this->upload->do_upload('project_pdf');
					
					$project_data['pdf_link_url'] = base_url().'uploads/'.$id.'/'.$this->upload->data('file_name');
				}
				// END project_pdf

    
    			$this->Project->update_project($project_data,$id_project);
    
    		 }else{
    			$project_data['id'] = $data['project_id'];
    
    			if ( $_FILES['project_icon']['name'] != "" ) {
    
    				$this->upload->do_upload('project_icon');
    				
					$project_data['project_icon'] = base_url().'uploads/'.$data['id'].'/'.$this->upload->data('file_name');
    			}
    			// END project_icon
    
    
    			if ( $_FILES['project_pdf']['name'] != "" ) {
    
    				$this->upload->do_upload('project_pdf');
    				
    				$project_data['pdf_link_url'] = base_url().'uploads/'.$data['id'].'/'.$this->upload->data('file_name');
    			}
    			// END project_pdf
    
    			$this->Project->save_project( $project_data );
    
    		}
    		//END  Uploading project details
    
    
			// Uploading project flats details

			$project_flat_data['flat_id'] = $this->get_data( 'flat_id' );
			$project_flat_data['flat_type'] = $this->get_data( 'flat_type' );
			$project_flat_data['property_type'] = $this->get_data( 'property_type' );
			$project_flat_data['flat_bed'] = $this->get_data( 'flat_bed' );
			$project_flat_data['flat_bathrooms'] = $this->get_data( 'flat_bathrooms' );
			$project_flat_data['flat_price'] = $this->get_data( 'flat_price' );
			$project_flat_data['flat_area'] = $this->get_data( 'flat_area' );
			$project_flat_data['flat_area_type'] = $this->get_data( 'flat_area_type' );
			$project_flat_data['flat_carpet_area'] = $this->get_data( 'flat_carpet_area' );
			$project_flat_data['flat_balcony'] = $this->get_data( 'flat_balcony' );
			$project_flat_data['flat_available'] = $this->get_data( 'flat_available' );
	
			$project_flat_data['flat_img_old_name'] = $this->get_data( 'flat_img_old_name' );
	
			$project_flat_data['name'] = $_FILES['flat_image_url']['name'];
			$project_flat_data['tmp_name'] = $_FILES['flat_image_url']['tmp_name'];
	
	
			//echo "<pre>",print_r($project_flat_data);die;
		
			$flatsCount = count($project_flat_data['flat_type']);
	
			for($i = 0; $i < $flatsCount; $i++)
			{ 
	
			   if ( $project_flat_data['flat_type'][$i] != '')
			   {
					if($id != ""){
						$project_flat['project_id'] = $id_project;
					}else{
						$project_flat['project_id'] = $data['project_id'];
					}
		
					//$project_flat['flat_id'] = $project_flat_data['flat_id'][$i];
					
					$project_flat['flat_type'] = $project_flat_data['flat_type'][$i];
	
					if ( $project_flat_data['property_type'][$i] != '') {
						$project_flat['property_type'] = $project_flat_data['property_type'][$i];	
					}
	
					if ( $project_flat_data['flat_bed'][$i] != '') {
						$project_flat['flat_bed'] = $project_flat_data['flat_bed'][$i];	
					}
					
					if ( $project_flat_data['flat_bathrooms'][$i] != '') {
						$project_flat['flat_bathrooms'] = $project_flat_data['flat_bathrooms'][$i];	
					}
		
					if ( $project_flat_data['flat_price'][$i] != '') {
						$project_flat['flat_price'] = $project_flat_data['flat_price'][$i];	
					}
		
					if ( $project_flat_data['flat_area'][$i] != '' ) {
						$project_flat['flat_area'] = $project_flat_data['flat_area'][$i];	
					}
					
					if ( $project_flat_data['flat_area_type'][$i] != '' ) {
						$project_flat['flat_area_type'] = $project_flat_data['flat_area_type'][$i];	
					}
					
					if ( $project_flat_data['flat_carpet_area'][$i] != '' ) {
						$project_flat['flat_carpet_area'] = $project_flat_data['flat_carpet_area'][$i];	
					}
					
					if ( $project_flat_data['flat_balcony'][$i] != '' ) {
						$project_flat['flat_balcony'] = $project_flat_data['flat_balcony'][$i];	
					}
		
					if ( $project_flat_data['flat_available'][$i] != '' ) {
						$project_flat['flat_available'] = $project_flat_data['flat_available'][$i];	
					}
	
	
					if ( $_FILES['flat_image_url']['name'][$i] != "") {
	
						$filename = $project_flat_data['name'][$i];
						$filename_tmp_name = $project_flat_data['tmp_name'][$i];
						
						if($id != ""){
							$upload_path  = './uploads/'.$id.'/';
						}else{
							$upload_path  = './uploads/'.$data['id'].'/';
						}
	 
		
						if(move_uploaded_file($filename_tmp_name, $upload_path . $filename))
						{
							if($id != ""){
								$project_flat['flat_image_url'] = base_url().'uploads/'.$id.'/'.$filename;
							}else{
								$project_flat['flat_image_url'] = base_url().'uploads/'.$data['id'].'/'.$filename;
							}
						}
						else{
							$project_flat['flat_image_url'] = "Image".$i." Not uploaded";
						}
	
					}else{
						$project_flat['flat_image_url'] = $project_flat_data['flat_img_old_name'][$i];
					}
	
					
		
					if($id != ""){
	  
						//$flat_id = $this->Project_flats->get_flat_id($id_project,$project_flat['flat_type'])->id;
	
						$flat_id = $project_flat_data['flat_id'][$i];
						
						if($flat_id != ''){
							$this->Project_flats->update_project_flats($project_flat,$flat_id);
						}else{
							$this->Project_flats->save( $project_flat );
						}
		
					 }else{
			
						$this->Project_flats->save( $project_flat );	
		
					}
				}
			}
	

			

		// END Uploading project flats details




		if($id != ""){
		   $obj = $this->Item->get_one( $id );

		   $org_id=$obj->org_id;

		   $org_data['org_id'] = $org_id;
		}else{
			$org_data['org_id'] = $data['org_id'];
		}


		//$org_data['org_id'] = $data['org_id'];

		   if ( $this->has_data( 'org_name' )) {
			$org_data['org_name'] = $this->get_data( 'org_name' );
		}
		else{
			$org_data['org_name'] = $this->get_data( 'listed_by_name' );
		}

		if ( $this->has_data( 'org_type' )) {
			$org_data['org_type'] = $this->get_data( 'org_type' );
		}

		if ( $this->has_data( 'org_location' )) {
			$org_data['org_location'] = $this->get_data( 'org_location' );
		}

		if($id != ""){
			$this->Organisation_model->update_org( $org_data,$org_id);
		}
		else{
			$this->Organisation_model->save_org( $org_data);
		}

		if($id != ""){
			$obj = $this->Item->get_one( $id );
			$usr_id = $obj->added_user_id;
		}else{
			$usr_id = $logged_in_user->user_id;
		}

		$listing_count = $this->Item->listing_count($usr_id);
		$pendings_count = $this->Item->pendings_count($usr_id);
		$indrafts_count = $this->Item->indrafts_count($usr_id);
		$rejected_count = $this->Item->rejected_count($usr_id);

		$locations = $this->Itemlocation->get_all();
		foreach ($locations->result() as $location) {
			$location_id = $location->id;
			$this->Item->sale_count($location_id);
			$this->Item->rent_count($location_id);
		}

		/** 
		 * Check Transactions 
		 */
		// commit the transaction
		if ( ! $this->check_trans()) {
			
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {
			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_prd_edit' ));
			} else {
			// if user id is false, show success_edit message
				$this->set_flash_msg( 'success', get_msg( 'success_prd_add' ));
			}
		}
	//get inserted item id	
	$id = ( !$id )? $data['id']: $id ;

	//// Start - Send Noti /////
	if($data['status'] == 1) {
		//approve so change status to publish (1)
		$title = 'Approved';
		$message = get_msg( 'approve_message_1' ) . $data['title'] . get_msg( 'approve_message_2' );
	} else if ($data['status'] == 2) {
		//disable so change status to publish (2)
		$title = 'Disabled';
		$message = "Your Posted Item(". $data['title'] .") has been Disabled.";
	} else if ($data['status'] == 3) {
		//reject so change status to reject (3)
		$title = 'Rejected';
		$message = "Your Posted Item(". $data['title'] .") has been Rejected.";
	}
	$error_msg = "";
	$success_device_log = "";
	$added_user_id = $this->Item->get_one($id)->added_user_id;
	$user_device_token = $this->User->get_one($added_user_id)->device_token;
	$user_name = $this->User->get_one($added_user_id)->user_name;
	
	//echo $user_device_token; die;
	if($user_device_token != "") {
		$devices[] = $user_device_token;
		
		$device_ids = array();
		if ( count( $devices ) > 0 ) {
			
			for($i=0; $i < count($devices); $i++) {
				$device_ids[] = $devices[0];
			}
		}
		if(($data['status'] == 1) || ($data['status'] == 2) || ($data['status'] == 3)) {
			 $status = $this->send_android_fcm2( $device_ids, array( "message" => $message ));
			
			 //saving notification data for web
			 $notification_data = array(
				 'title' => $title,
				 'description' => $message,
				 'item_id' => $id,
				 'user_id' => $added_user_id,
			 );
			 $this->Notifications_modal->save($notification_data);
			 //print_r($notification_data);
			 //die();
		}
		
	}
	//// End - Send Noti /////

				
	
	// Item Id Checking 
	if ( $this->has_data( 'gallery' )) {
	// if there is gallery, redirecti to gallery
		redirect( $this->module_site_url( 'gallery/' .$id ));
	} else if ( $this->has_data( 'promote' )) {
		redirect( site_url( ) . '/admin/paid_items/add/'.$id);
	}
	else {
	// redirect to list view
		redirect( $this->module_site_url() );
	}
}


//   delete project or flat files(image or icon or pdf)
function delete_project_files()
{

	$replace_delete['id_item'] = $this->input->post('id_item');
	$replace_delete['id_flat'] = $this->input->post('id_flat');
	$replace_delete['project_or_flats'] = $this->input->post('project_or_flats');
	$replace_delete['old_file'] = $this->input->post('old_file');

	$parts = explode('/', $replace_delete['old_file']); 
	$last = end($parts);
	$replace_delete['old_file'] = $last;

	//file_exists('uploads/'.$replace_delete['id_item'].'/'.$replace_delete['old_file']);

	unlink('uploads/'.$replace_delete['id_item'].'/'.$replace_delete['old_file']);

	
	if($replace_delete['project_or_flats'] == 'flats'){
		$new_file_path = '';
		$this->Project_flats->delete_flat_file($replace_delete['id_flat'],$new_file_path);
		
	}elseif ($replace_delete['project_or_flats'] == 'flats_row'){
		
		$this->Project_flats->delete_flat_row($replace_delete['id_flat']);

	}else{
		if($replace_delete['project_or_flats'] == "PDF")
		{
			$new_file_path['pdf_link_url'] = '';
		}else{
			$new_file_path['project_icon'] = '';
		}
		$this->Project->delete_flat_file($replace_delete['id_flat'],$new_file_path);
	}

	echo 1;

	//if($delete_file){
	//    echo 1;
	//}else{
	//    echo 0;
	//}
	
}





	//get all subcategories when select category
	function get_all_sub_categories( $cat_id )
    {
    	$conds['cat_id'] = $cat_id;
    	
    	$sub_categories = $this->Subcategory->get_all_by($conds);
		echo json_encode($sub_categories->result());
    }
    /**
	 * Show Gallery
	 *
	 * @param      <type>  $id     The identifier
	 */
	function gallery( $id ) {
		// breadcrumb urls
		$edit_item = get_msg('prd_edit');
		$this->data['action_title'] = array( 
			array( 'url' => 'edit/'. $id, 'label' => $edit_item ), 
			array( 'label' => get_msg( 'item_gallery' ))
		);
		$_SESSION['parent_id'] = $id;
		$_SESSION['type'] = 'item';
    	    	
    	$this->load_gallery();
    }
    /**
	 * Create new one
	 */
	function add() {
		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_add' );
		// call the core add logic
		parent::add();
	}
	function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'item_'.$key;
	}
	function RandomStringImg($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'img'.$key;
	}
	// bulk upload items
	function import()
	{
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		foreach($file_data as $row)
		{
			$rand_id = $this->RandomString_org('org_',24);
			$rand_id = $rand_id;

			$project_rand_id = $this->RandomString_org('PRJT_',24);
			$project_rand_id = $project_rand_id;
			
			$random_id = $this->RandomString(24);
			$random_id = $random_id;
			$data[] = array(
				'id' => $random_id,
				'cat_id' => $row['category'],
//				'furnishing_id' => $row['furnishing_id'],
				'sub_cat_id' => $row['subcategory'],
				'item_type_id' => $row['item_type'],
				'item_price_type_id' => $row['price_type'],
//				//'item_currency_id' => $row['currency'],
				'item_location_id' => $row['location_id'],
//				'condition_of_item_id' => $row['condition_item'],
				'description' => $row['descriptio'],
//				'highlight_info' => $row['informatio'],
				'price' => $row['price'],
//				'price_end' => $row['price_end'],
//				"rent_collection_type" => $row['collect_rent_type'],
//				"bachelors_allowed" => $row['bachelors_allowed'],
//				"maintanance" => $row['maintanance'],
				'project_name' => $row['project_name'],
//				'is_sold_out' => $row['sold_ou'],
				'title' => $row['itle'],
                'property_id' => $row['property_id'],
//				'address' => $row['address'],
//				'lat' => $row['lati'],
//				'lng' => $row['lng'],
				'status' => $row['status'],
				'area' => $row['area'],
				'area_type' => $row['area_type'],
				'length' => $row['length'],
				'breadth' => $row['breadth'],
//				'listed_by' => $row['listed_by'],
//				'facing' => $row['facing'],
//				'car_parking' => $row['car_parking'],
//				'total_floors' => $row['floors_total'],
//				'floor_no' => $row['floor_no'],
//              'numberofbedrooms' => $row['bedrooms'],
//				'numberofbathrooms' => $row['bathrooms'],
				'listed_by_name' => $row['listed_by_name'],
				'listed_by_phone' => $row['listed_by_phone'],
//				'is_premium' => $row['is_premium'],
//				"is_verified" => $row['is_verified'],
//				"org_id" => $rand_id,
//				"project_id" => $project_rand_id,
//				"added_user_id" => $row['added_user_id'],				
//				"is_gated_community" => $row['is_gated_community'],				
//				"is_24_water_supply" => $row['is_24_water_supply'],				
//				"is_intercom_facility" => $row['is_intercom_facility'],				
//				"is_fire_alarm" => $row['is_fire_alarm'],				
//				"is_swimming_pool" => $row['is_swimming_pool'],				
//				"is_gym" => $row['is_gym'],				
//				"is_bank_approval" => $row['is_bank_approval'],				
//				"is_park" => $row['is_park'],				
//				"is_jogging_track" => $row['is_jogging_track'],
//				"is_library" => $row['is_library'],
//				"is_call_allowed"=>$row['is_call_allowed'],
//				"is_whatsapp_allowed"=>$row['is_whatsapp_allowed'],
//				"possession_start_date"=>$row['possession_start_date'],
//				"rera_id"=>$row['rera_id'],
//				"youtube_url_link"=>$row['youtube_url_link'],
//				"per_growth_rate"=>$row['per_growth_rate'],
//				"growth_rate_duration"=>$row['growth_rate_duration'],
//				"launch_date"=>$row['launch_date'],
//				"total_project_area"=>$row['project_area_total'],
//				"total_planned_units"=>$row['planned_units_total'],
//				"towers"=>$row['towers'],
//				"no_project_floors"=>$row['project_floors'],
//				"about_builder"=>$row['about_builders'],
//				"construction_details"=>$row['construction_details'],
//				"url_3dtour"=>$row['3dtour_link'],
//				"location_short"=>$row['location_short'],
                "is_hmda" => $row['is_hmda'],
				"is_dtcp" => $row['is_dtcp'],
			);
			 //echo "<pre>",print_r($data);die;

			//$org_id = $data['org_id'];
//			$org_data[] = array(
//				'org_id' => $rand_id,
//				'org_name' => $row['org_name'],
//				'org_type' => $row['org_type'],
//				'org_location' => $row['org_locatio'],
//			);

//			$project_data[] = array(
//				'id' => $project_rand_id,
//				'name' => $row['project_name'],
//				'project_icon' => base_url().'uploads/'.$random_id.'/'.$row['icon_projects'],
//				'pdf_link_url' => base_url().'uploads/'.$random_id.'/'.$row['pdf_link_url'],
//				'no_units_available' => $row['available_units'],
//				'project_website_url' => $row['project_website_url'],
//				'email_id' => $row['project_email'],
//				'about_project' => $row['about_projects'],
//			);


		}
		//echo "<pre>",print_r($data);
		//echo "<pre>",print_r($org_data);
		//echo "<pre>",print_r($project_data);
		//die();
		
		$this->csv_import_model->insert($data);
		//$this->csv_import_model->insert_org( $org_data);
		//$this->csv_import_model->insert_project( $project_data);

		$locations = $this->Itemlocation->get_all();
		foreach ($locations->result() as $location) {
			$location_id = $location->id;
			$this->Item->sale_count($location_id);
			$this->Item->rent_count($location_id);
		  }

		echo "1";
	}



	function image_upload(){
		$file_img_data = $this->csvimport->get_array($_FILES["csv_img_file"]["tmp_name"]);
		$random_id = $this->input->post('id');
		foreach ($file_img_data as $key => $row) {
			$rand_id = $this->RandomStringImg(30);
			$data1[] = array(
				'img_id ' => $rand_id,
				'img_parent_id' => $random_id,
				'img_type' => $row['img_type'],
				'img_path' => $row['img_path'],
				'img_width' => $row['img_width'],
				'img_height' => $row['img_heigh'],
				'img_desc' => $row['img_desc'],
			);
			// echo "<pre>",print_r($data1);die;
		}
		 //echo "<pre>",print_r($data1);die;
		$this->csv_import_model->insert_img($data1);
		echo "1";
	}


	function map_item( $id ) 
	{
		// breadcrumb urls
		//$this->data['action_title'] = get_msg( 'prd_edit' );
		// get rows count
		$this->data['rows_count'] = $this->Item->count_all_by( $conds );
		// load user
		$this->data['items'] = $this->Item->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		$this->data['mapitem'] = $this->Item->get_one( $id );
		// call the parent edit logic
		parent::index($id);
	}
	/**
 	* Update the existing one
	*/
	function edit( $id ) 
	{
		
		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'prd_edit' );
		// load user
		$this->data['item'] = $this->Item->get_one( $id );
		// call the parent edit logic
		parent::edit( $id );
	}
	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) 
	{
		
		$rule = 'required|callback_is_valid_name['. $id  .']';
		$this->form_validation->set_rules( 'title', get_msg( 'name' ), $rule);
		
		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating,
			return false;
		}
		return true;
	}
	/**
	 * Determines if valid name.
	 *
	 * @param      <type>   $name  The  name
	 * @param      integer  $id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $id = 0 )
	{		
		 $conds['title'] = $name;
		
		if ( strtolower( $this->Item->get_one( $id )->title ) == strtolower( $name )) {
		// if the name is existing name for that user id,
			return true;
		} else if ( $this->Item->exists( ($conds ))) {
		// if the name is existed in the system,
			$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
			return false;
		}
		return true;
	}
	/**
	 * Delete the record
	 * 1) delete Item
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $id ) 
	{
		$obj = $this->Item->get_one( $id );

		$usr_id = $obj->added_user_id;

		// start the transaction
		$this->db->trans_start();
		// check access
		$this->check_access( DEL );
		// delete categories and images
		$enable_trigger = true; 
		
		// delete categories and images
		//if ( !$this->ps_delete->delete_product( $id, $enable_trigger )) {
		$type = "item";
		if ( !$this->ps_delete->delete_history( $id, $type, $enable_trigger )) {
			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
			// rollback
			$this->trans_rollback();
			// redirect to list view
			redirect( $this->module_site_url());
		}
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_prd_delete' ));
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
		
		redirect( $this->module_site_url());
	}
	/**
	 * Check Item name via ajax
	 *
	 * @param      boolean  $Item_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		
		// get Item name
		$name = $_REQUEST['title'];
		
		if ( $this->is_valid_name( $name, $id )) {
		// if the Item name is valid,
			
			echo "true";
		} else {
		// if invalid Item name,
			
			echo "false";
		}
	}
	/**
	 * Publish the record
	 *
	 * @param      integer  $prd_id  The Item identifier
	 */
	function ajx_publish( $item_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$prd_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Item->save( $prd_data, $item_id )) {
			//Need to delete at history table because that wallpaper need to show again on app
			$data_delete['item_id'] = $item_id;
			$this->Item_delete->delete_by($data_delete);
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $prd_id  The category identifier
	 */
	function ajx_unpublish( $item_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$prd_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Item->save( $prd_data, $item_id )) {
			//Need to save at history table because that wallpaper no need to show on app
			$data_delete['item_id'] = $item_id;
			$this->Item_delete->save($data_delete);
			echo 'true';
		} else {
			echo 'false';
		}
	}

	function count_unread(){
	  $result =	$this->Item->unread_count();	
	  echo $result; 
	}

 }