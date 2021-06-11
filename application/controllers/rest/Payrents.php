<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Payrents extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Payrent' );
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

			// get default setting for GET_ALL_CATEGORIES
			$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_PAYRENTS));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}

		if ( $this->is_search ) {

			//$setting = $this->Api->get_one_by( array( 'api_constant' => SEARCH_WALLPAPERS ));

			if($this->post('id') != "") {
				$conds['id']   = $this->post('id');
			}

			if($this->post('user_id') != "") {
				$conds['user_id']   = $this->post('user_id');
			}

			if($this->post('property_id') != "") {
				$conds['property_id']   = $this->post('property_id');
			}

			$conds['item_search'] = 1;
			$conds['order_by'] = 1;
			$conds['order_by_field']    = $this->post('order_by');
			$conds['order_by_type']     = $this->post('order_type');
				
		}

		return $conds;
	}

	function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'payrent'.$key;
	}

	function RandomStringproperty($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'property'.$key;
	}


	function add_post() {

		$bill[]=$this->post('monthly_rent');
		$bill[]=$this->post('water_bill');
		$bill[]=$this->post('current_bill');
		$bill[]=$this->post('maintenance_bill');
		$total_rent= array_sum($bill);

		$random_id = $this->RandomString(20);
		$property_id = $this->RandomStringproperty(20);
	  	$item_data = array(

            "id"                    => $random_id,
            "user_id"               => $this->post('user_id'),
            "property_name"         => $this->post('property_name'),
			"property_address"      => $this->post('property_address'),
			"monthly_rent"          => $this->post('monthly_rent'),
			"water_bill"            => $this->post('water_bill'),
			"current_bill"          => $this->post('current_bill'),
			"maintenance_bill"      => $this->post('maintenance_bill'),
			"total_rent"            => $total_rent,
			"tenant_name"           => $this->post('tenant_name'),
			"tenant_phone"          => $this->post('tenant_phone'),
			"tenant_email"          => $this->post('tenant_email'),
			"notification_allowed"  => $this->post('notification_allowed'),
			"reminder_allowed"      => $this->post('reminder_allowed'),
			"property_id"           => $property_id
		);
		//print_r($item_data['id']);
		//die();


		$this->Payrent->save($item_data);
		
		$user_id = $item_data['user_id'];

		$this->Payrent->total_amt_collected($user_id);

		$this->Payrent->properties_count($user_id );
		
		$id = $item_data['id'];
		
		$obj = $this->Payrent->get_one( $id );
		
		$this->custom_response( $obj );

	}


	function payrents_update_post()
	{

		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'id',
	        	'rules' => 'required'
			),		
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'property_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'property_address',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'monthly_rent',
	        	'rules' => 'required'
	        ),
			array(
				'field' => 'water_bill',
				'rules' => 'required'
	        ),
	        array(
	        	'field' => 'current_bill',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'maintenance_bill',
	        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'tenant_name',
	        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'tenant_phone',
	        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'tenant_email',
	        	'rules' => 'required|valid_email'
	        ),
			array(
	        	'field' => 'notification_allowed',
	        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'reminder_allowed',
	        	'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;


		
		$bill[]=$this->post('monthly_rent');
		$bill[]=$this->post('water_bill');
		$bill[]=$this->post('current_bill');
		$bill[]=$this->post('maintenance_bill');
		$total_rent= array_sum($bill);

		$user_data = array(

            "property_name"         => $this->post('property_name'),
			"property_address"      => $this->post('property_address'),
			"monthly_rent"          => $this->post('monthly_rent'),
			"water_bill"            => $this->post('water_bill'),
			"current_bill"          => $this->post('current_bill'),
			"maintenance_bill"      => $this->post('maintenance_bill'),
			"total_rent"            => $total_rent,
			"tenant_name"           => $this->post('tenant_name'),
			"tenant_phone"          => $this->post('tenant_phone'),
			"tenant_email"          => $this->post('tenant_email'),
			"notification_allowed"  => $this->post('notification_allowed'),
			"reminder_allowed"      => $this->post('reminder_allowed'),
		);
        // print_r($user_data);die;

        if ( !$this->Payrent->save($user_data, $this->post('id'))) {

        	$this->error_response( get_msg( 'err_user_update' ));
		}
		else{
			$user_id = $this->post('user_id');

			$this->Payrent->total_amt_collected($user_id);
	
			$this->Payrent->properties_count($user_id );
	
			$this->success_response( get_msg( 'Your Payrent details are updated successfully.' ));
		}


	}

}