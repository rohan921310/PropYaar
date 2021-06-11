<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Home_loans extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Home_loan' );
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
          
          $homeloan_data = array(
			"id" => $this->post('id'),
			"listed_user_id" => $this->post('listed_user_id'), 
          "aadharcard_name" => $this->post('aadharcard_name'),
          "type_of_loan" => $this->post('type_of_loan'),
          "salary" => $this->post('salary'),
          "company_name" => $this->post('company_name'),
          "any_existing_loans" => $this->post('any_existing_loans'),
        );
  
        $id = $homeloan_data['id'];

		if($id != ""){
		    $response = $this->Home_loan->save($homeloan_data,$id);
		    if($response){
		  	$this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Home_loan->save($homeloan_data);
			if($response){

				$listed_user_id = $this->post('listed_user_id');
				
				$posted_user_name = $this->User->get_one( $listed_user_id )->user_name;
				$posted_user_phone = $this->User->get_one( $listed_user_id )->user_phone;
				
				$message = " ".$posted_user_name."(".$posted_user_phone.") has posted a request for home loan";
   
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
    
    function homeloan_delete_post( ){

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
		
		if ( !$this->Home_loan->delete_by( $conds_id )) {

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