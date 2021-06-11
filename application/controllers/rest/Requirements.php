<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Requirements extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Requirement' );

		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST,');
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

		}

		return $conds;
    }
    


	function add_post() {

		$data = array(
		  "id" => $this->post('id'), 
          "user_id" => $this->post('user_id'),
		  "location_id" => $this->post('location_id'),
		  "cat_id" => $this->post('cat_id'),
		  "sub_cat_id" => $this->post('sub_cat_id'),
          "requirement" => $this->post('requirement'),
		);

		$id = $data['id'];

		if($id != ""){
		    $response = $this->Requirement->save($data,$id);
		    if($response){
			  $this->success_response( get_msg( 'The Requirement has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Requirement->save($data);
			if($response){

				$this->success_response( get_msg( 'The Requirement has been successfully Added'));
				//$id = $data['id'];
				//$obj = $this->Requirement->get_one( $id );
				//$this->custom_response( $obj );

			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}

	}

	function requirement_delete_post( ){

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
		
		if ( !$this->Requirement->delete_by( $conds_id )) {

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

		$this->ps_adapter->convert_user_contactinfo( $obj );

	}

}