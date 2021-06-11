<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Notification
 */
class Noti_messages extends API_Controller
{
	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		// call the parent
		parent::__construct( 'Noti' );

		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}

		$this->load->model('notireaduser');
	}

	function all_notis_post() 
	{
		
		$limit = $this->get( 'limit' );
   		$offset = $this->get( 'offset' );

		$noti_obj = $this->Noti_message->get_all($limit,$offset)->result();

//		foreach ($noti_obj as $nt)
//		{
//			$noti_user_data = array(
//	        	"noti_id" 		=> $nt->id,
//	        	"user_id" 		=> $this->post('user_id'),
//				"device_token"  => $this->post('device_token'),
//	    	);
//
//
//	    	if ($this->Notireaduser->exists( $noti_user_data )) { 	
//				 $nt->is_read = 1;
//				 $result = $this->Notireaduser->visible( $noti_user_data );
//				 $visible = $result[0]->visible_flag;
//				 $nt->is_visible = $visible;
//
//	    	} else {
//				 $nt->is_read = 0;
//				 $nt->is_visible = '1';
//	    	}
//	    	
//		}

    	$this->custom_response_noti( $noti_obj );

	}

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{

		// call parent convert object
		parent::convert_object( $obj );

		// convert customize category object
		$noti_user_data = array(
        	"noti_id" => $obj->id,
        	"user_id" => $this->post('user_id'),
			//"device_token"  => $this->User->get_one($this->post('user_id'))->device_token,
		);
		


    	if ( !$this->Notireaduser->exists( $noti_user_data )) {
			
			$obj->is_read = 0;

			$obj->is_visible = '1';

    	} else {
		   		
			$obj->is_read = 1;

			$result = $this->Notireaduser->visible( $noti_user_data );
			$visible = $result[0]->visible_flag; 
			$obj->is_visible = $visible;

    	}

		// convert customize item object
		$this->ps_adapter->convert_noti_message( $obj );
	}

	function delete_noti_post(){

		// validation rules for item register
		$rules = array(
			array(
	        	'field' => 'noti_id',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'is_visible',
	        	'rules' => 'required'
	        ),
	    );   
	    
	    // exit if there is an error in validation,
		if ( !$this->is_valid( $rules )) exit;
		
		$noti_delete =array(
			'noti_id' => $this->post('noti_id'),
			'user_id' => $this->post('user_id'),
		);
		$is_visible = $this->post('is_visible');
		//print_r($noti_delete);
        //die();
		$this->Notireaduser->delete_noti($noti_delete,$is_visible);

		$this->success_response( get_msg( 'success_delete' ));

	}


}