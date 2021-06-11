<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Movers extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Movers_model' );
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

		}

		return $conds;
    }

	function add_post() {

		$movers_data = array(
			"id" => $this->post('id'), 
		  "mv_name" => $this->post('mv_name'),
		  "mv_phone_number" => $this->post('mv_phone_number'),
		  "mv_location" => $this->post('mv_location'),
		  "mv_info" => $this->post('mv_info'),
		  "mv_rating" => $this->post('mv_rating'),
		  "is_open" => $this->post('is_open'),
		  "is_like" => $this->post('is_like'),
		  "from_city" =>$this->post('from_city'),
		  "to_city" =>$this->post('to_city'),
		  "from_address" =>$this->post('from_address'),
		  "to_address" =>$this->post('to_address'),
		  "from_floor_no" =>$this->post('from_floor_no'),
		  "to_floor_no" =>$this->post('to_floor_no'),
		  "home_size" =>$this->post('home_size'),
		  "date_to_shift" =>$this->post('date_to_shift'),
		  "shipping_details" =>$this->post('shipping_details'),
		  "listed_user_id" =>$this->post('listed_user_id'),
		);
		
		$id = $movers_data['id'];
		if($id != ""){
		    $response = $this->Movers_model->save($movers_data,$id);
		    if($response){
		  	$this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Movers_model->save($movers_data);
			if($response){


				$listed_user_id = $this->post('listed_user_id');
				$from_address = $this->post('from_address');
				$to_address = $this->post('to_address');

				$posted_user_name = $this->User->get_one( $listed_user_id )->user_name;
				$posted_user_phone = $this->User->get_one( $listed_user_id )->user_phone;
				
				$message = " ".$posted_user_name."(".$posted_user_phone.")  has requested to move from ".$from_address." to ".$to_address."";
   
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

			   $this->success_response( get_msg( 'The data has been successfully added'));

			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}

	}

	function movers_delete_post( ){

		// validation rules for item register
		$rules = array(
			array(
				'field' => 'id',
				'rules' => 'required'
			)
		);   
		
		// exit if there is an error in validation,
		if ( !$this->is_valid( $rules )) exit;

		$id = $this->post('id');
		
		$conds_id['id'] = $id;

		if ( !$this->Movers_model->delete_by( $conds_id )) {

			return false;
		}
		$this->success_response( get_msg( 'success_delete' ));
	} 

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );
	}

}