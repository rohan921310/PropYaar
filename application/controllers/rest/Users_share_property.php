<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Users_share_property extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Users_share_properties' );
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

		if ( $this->is_search ) {

			if($this->post('id') != "") {
				$conds['id']   = $this->post('id');
			}

			if($this->post('realty_share_property_id') != "") {
				$conds['realty_share_property_id']   = $this->post('realty_share_property_id');
			}

			if($this->post('user_id') != "") {
				$conds['user_id']   = $this->post('user_id');
			}

			if($this->post('is_paid') != "") {
				$conds['is_paid']   = $this->post('is_paid');
			}

			if($this->post('is_following') != "") {
				$conds['is_following']   = $this->post('is_following');
			}

		}

		return $conds;
    }


	function add_post() {

		if($this->post('amount_paid') != "" && $this->post('amount_paid') > 0 ){
			$is_paid = 1;
		}else{
			$is_paid = 0;
		}

		$users_shares_data = array(
		  "id" => $this->post('id'),
		  "user_id" => $this->post('user_id'),
		  "realty_share_property_id" => $this->post('realty_share_property_id'),
		  "is_paid" => $is_paid,
		  "amount_paid" => $this->post('amount_paid'),
		  "is_following" => $this->post('is_following'),
		);

		$id = $users_shares_data['id'];
		$share_property_id =$users_shares_data['realty_share_property_id'];

		if($id != ""){
		    $response = $this->Users_share_properties->save($users_shares_data,$id);
		    if($response){

				$investors_count = $this->Users_share_properties->investors_count($share_property_id);

				$this->Users_share_properties->delete_User_share_property();
		  	    $this->success_response( get_msg( 'The data has been successfully Updated'));
		    }else{
		  	    $this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Users_share_properties->save($users_shares_data);
			if($response){

				$investors_count = $this->Users_share_properties->investors_count($share_property_id);

				$this->success_response( get_msg( 'The data has been successfully added'));
			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}

	}

	function user_share_post() {

	}

	//function delete_realty_shares_post( ){
//
	//	// validation rules for item register
	//	$rules = array(
	//		array(
	//			'field' => 'id',
	//			'rules' => 'required'
	//		)
	//	);   
	//	
	//	// exit if there is an error in validation,
	//	if ( !$this->is_valid( $rules )) exit;
//
	//	$id = $this->post('id');
	//	
	//	$conds_id['id'] = $id;
	//	
	//	if ( !$this->Users_share_properties->delete_by( $conds_id )) {
//
	//		return false;
	//	}
	//	$this->success_response( get_msg( 'success_delete' ));
	//}

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );
		                                          
		$this->ps_adapter->convert_realty_shares( $obj );
	}

}