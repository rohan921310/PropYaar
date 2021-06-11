<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Home_services extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Home_service' );
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

		$data = array(
		  "id" => $this->post('id'), 
          "user_id" => $this->post('user_id'),
          "home_services_category" => $this->post('home_services_category'),
		  "location" => $this->post('location'),
          "address" => $this->post('address'),
		);

		$id = $data['id'];

		if($id != ""){
		    $response = $this->Home_service->save($data,$id);
		    if($response){
		  	$this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Home_service->save($data);
			if($response){
				$this->success_response( get_msg( 'The data has been successfully added'));
			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}

	}

	function builders_delete_post( ){

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
		
		if ( !$this->Home_service->delete_by( $conds_id )) {

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