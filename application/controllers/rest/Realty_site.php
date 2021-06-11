<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Realty_site extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Realty_sites' );
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

		$realty_sites_data = array(
			"id" => $this->post('id'), 
		  "user_id" => $this->post('user_id'),
		  "user_site_url" => $this->post('user_site_url'),
		  "no_properties" => $this->post('no_properties'),
		);

		$id = $realty_sites_data['id'];

		if($id != ""){
		    $response = $this->Realty_sites->save($realty_sites_data,$id);
		    if($response){
		  	$this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Realty_sites->save($realty_sites_data);
			if($response){
				$this->success_response( get_msg( 'The data has been successfully added'));
			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}

	}

	function delete_realty_shares_post( ){

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
		
		if ( !$this->Realty_sites->delete_by( $conds_id )) {

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