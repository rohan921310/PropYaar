<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Ar_vr extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Arvr_model' );
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
			$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_3D_ARVR));

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


    function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return '3D_ARVR'.$key;
	}

	function RandomStringimgid($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'ARVR_img'.$key;
	}


	function add_post() {

		$random_id = $this->RandomString(20);

	  	$item_data = array(

            "id"                => $random_id,
            "name"              => $this->post('name'),
            "phone"             => $this->post('phone'),
            "email"             => $this->post('email'),
			"property_location" => $this->post('property_location')
		);
		//print_r($item_data['id']);
		//die();

		$this->Arvr_model->save($item_data);

		$id = $item_data['id'];
		
		$obj = $this->Arvr_model->get_one( $id );
        
		$id = $obj->id;

		$data = base64_decode($this->post('arvr_img'));

		$imagename = $this->RandomString(6).'.png';
		$img_id =$this->RandomStringimgid(20);
		$img_path = $imagename;
		
		$image_data = array(
			'img_id' => $img_id,
			'img_parent_id'=> $id,
			'img_type'=>'3D_ARVR',
			'img_path'=>$img_path,
			'img_width'=>'',
			'img_height'=>'',
		);

		file_put_contents('uploads/'.$img_path, $data);
		$this->Arvr_model->insert_images($image_data);
		

        $subject = get_msg('post_receive_message');
        send_contact_us_emails( $id, $subject );
        $this->success_response( get_msg( 'success_post '));

    }
    

}