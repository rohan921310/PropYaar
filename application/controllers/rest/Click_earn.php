<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Click_earn extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Clickearn_model' );
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
          "owner_name" => $this->post('owner_name'),
          "email" => $this->post('email'),
		  "owner_phone_number" => $this->post('owner_phone_number'),
		  "property_type" => $this->post('property_type'),
		  "city_name" => $this->post('city'),
          "address" => $this->post('address'),
		);

		$id = $data['id'];

		if($id != ""){
		    $response = $this->Clickearn_model->save($data,$id);
		    if($response){
			  //$this->success_response( get_msg( 'The data has been successfully Updated'));
			  $id = $data['id'];
			  $obj = $this->Clickearn_model->get_one( $id );
			  $this->custom_response( $obj );
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Clickearn_model->save($data);
			if($response){

				//$this->success_response( get_msg( 'The data has been successfully added'));
				$id = $data['id'];
				$obj = $this->Clickearn_model->get_one( $id );
				$this->custom_response( $obj );

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
		
		if ( !$this->Clickearn_model->delete_by( $conds_id )) {

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

		$this->ps_adapter->convert_clickearn_img( $obj );

	}

}