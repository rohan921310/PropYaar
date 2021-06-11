<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Lrs extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Lrs_model' );
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
			$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_LRS));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}

		return $conds;
	}

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{
		// call parent convert object
		parent::convert_object( $obj );

		// convert customize lrs object
		$this->ps_adapter->convert_lrs( $obj );

	}


	function RandomStringimgid($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'img'.$key;
	}


	function add_post() {

	  	$lrs_data = array(

            "id"                    => $this->post('id'),
            "name"                  => $this->post('name'),
            "phone"                 => $this->post('phone'),
            "email"                 => $this->post('email'),
			"property_type"         => $this->post('property_type'),
			"property_location"     => $this->post('property_location'),
			"plot_type"             => $this->post('plot_type'),
			"plot_category"         => $this->post('plot_category'),
			"plot_corporation"      => $this->post('plot_corporation'),
			"plot_zone"             => $this->post('plot_zone'),
			"plot_circle"           => $this->post('plot_circle'),
			"plot_ward"             => $this->post('plot_ward'),
			"father_or_spouse_name" => $this->post('father_or_spouse_name'),
			"aadhaar_number"        => $this->post('aadhaar_number'),
			"gender"                => $this->post('gender'),
			"house_no"              => $this->post('house_no'),
			"street_colony_name"    => $this->post('street_colony_name'),
			"locality"              => $this->post('locality'),
			"town_city_village"     => $this->post('town_city_village'),
			"district"              => $this->post('district'),
			"pincode"               => $this->post('pincode'),
			//"email_id"              => $this->post('email_id'),
			//"alternate_phone_number"=> $this->post('alternate_phone_number'),
		);
		//print_r($item_data['id']);
		//die();

		$id = $lrs_data['id'];

		if($id != ""){
		    $response = $this->Lrs_model->save($lrs_data,$id);
		    if($response){
			  $this->success_response( get_msg( 'Your post has been successfully Updated'));
			  
		    }else{
		  	$this->error_response( get_msg( 'Failed try again...')); 
		    }				  
		}else{
			$response = $this->Lrs_model->save($lrs_data);
			if($response){
				$this->success_response( get_msg( 'Your post has been successfully added'));
			 }else{
				$this->error_response( get_msg( 'Failed try again...')); 
			}		
		}
		
		//$this->Lrs_model->save($item_data);

		//if($id != ""){
		//	$id = $lrs_data['id'];			
		//}
		//else{
		//	$id = $lrs_data['id'];
		//
		//	$obj = $this->Lrs_model->get_one( $id );
		//	
		//	$id = $obj->id;
		//}
//
		//$data = base64_decode($this->post('lrs_img'));
		//$imageName = $this->RandomString(6).'.png';
		//$img_id =$this->RandomStringimgid(20);
		//$img_path = $imageName;
		//
		//$image_data = array(
		//	'img_id' => $img_id,
		//	'img_parent_id'=> $id,
		//	'img_type'=>'lrs',
		//	'img_path'=>$img_path,
		//	'img_width'=>'',
		//	'img_height'=>'',
		//);
//
		//file_put_contents('uploads/'.$imageName, $data);
		//$this->Image->save($image_data,$id);

		

        //$subject = get_msg('post_receive_message');
        //send_contact_us_emails( $id, $subject );
       // $this->success_response( get_msg( 'success_post '));

	}

	function lrs_delete_post( ){

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
		$conds_img['img_parent_id'] = $id;
		
		if ( !$this->Lrs_model->delete_by( $conds_id )) {

			return false;
		}

		//if ( !$this->Image->delete_by( $conds_img )) {
		//	return false;
		//}

		$this->success_response( get_msg( 'success_delete' ));
	}
	
    
}