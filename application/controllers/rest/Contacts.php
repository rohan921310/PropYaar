<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Ratings
 */
class Contacts extends API_Controller
{
	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		// call the parent
		parent::__construct( 'Contact' );

		header('Access-Control-Allow-Origin: https://www.riseerealty.com/');
        header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}

		// set the validation rules for create and update
		$this->validation_rules();
	}

	/**
	 * Determines if valid input.
	 */
	function validation_rules()
	{
		// validation rules for create
		$this->create_validation_rules = array(
			array(
	        	'field' => 'contact_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'contact_email',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'contact_message',
	        	'rules' => 'required'
	        )
        );
	}

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{
		if ( $this->is_add ) {
			$contact_id = $obj->contact_id;
			$subject = get_msg('contact_receive_message');
			send_contact_us_emails( $contact_id, $subject );
			$this->success_response( get_msg( 'success_contact '));
		}
	}	
}