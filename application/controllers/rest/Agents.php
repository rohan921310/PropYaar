<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Agents extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Agents_model' );
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
    
    function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++){
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'agents_'.$key;
	}

	function add_post() {
        
        $random_id = $this->RandomString(20);

		if ( $is_paid != "1" ) {
		  	$agents_data = array(
		  		"id" => $random_id, 
                "name" => $this->post('name'),
                "phone_number" => $this->post('phone_number'),
                "location" => $this->post('location'),
                "info" => $this->post('info'),
                "rating" => $this->post('rating'),
                "is_open" => $this->post('is_open'),
                "is_like" => $this->post('is_like'),
		  	);
		

	  		$this->Agents_model->save($agents_data);

	  		$this->success_response( get_msg( 'The data has been successfully added'));
	  	} else {
	  		$this->error_response( get_msg( 'Failed try again...'));
	  	}

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