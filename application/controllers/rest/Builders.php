<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Builders extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Builders_model' );
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

		$builders_data = array(
			"id" => $this->post('id'), 
		  "name" => $this->post('name'),
		  "phone_number" => $this->post('phone_number'),
		  "location" => $this->post('location'),
		  "info" => $this->post('info'),
		  "rating" => $this->post('rating'),
		  "is_open" => $this->post('is_open'),
		  "is_like" => $this->post('is_like'),
		  "city_name" => $this->post('city_name'),
		  "floor_plan" => $this->post('floor_plan'),
		  "builtup_area" => $this->post('builtup_area'),
		  "purpose" => $this->post('purpose'),
		  "is_kitchen" => $this->post('is_kitchen'),
		  "wardobe_count" => $this->post('wardobe_count'),
		  "entertainment_count" => $this->post('entertainment_count'),
		  "study_count" => $this->post('study_count'),
		  "cockery_count" => $this->post('cockery_count'),
		  "user_id" => $this->post('user_id'),
		);

		$id = $builders_data['id'];

		if($id != ""){
		    $response = $this->Builders_model->save($builders_data,$id);
		    if($response){
		  	$this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Builders_model->save($builders_data);
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
		
		if ( !$this->Builders_model->delete_by( $conds_id )) {

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