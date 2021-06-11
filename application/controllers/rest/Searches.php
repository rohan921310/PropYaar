<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Searches extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Search' );
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
			$setting = $this->Api->get_one_by( array( 'api_constant' => GET_ALL_SEARCHES));

			$conds['order_by'] = 1;
			$conds['order_by_field'] = $setting->order_by_field;
			$conds['order_by_type'] = $setting->order_by_type;
		}

		return $conds;
	}


    
	function add_post() {

	  	$item_data = array(

            "id" => $this->post('id'),
        	"cat_id" => $this->post('cat_id'), 
        	"sub_cat_id" => $this->post('sub_cat_id'),
        	"item_type_id" => $this->post('item_type_id'),
            "item_price_type_id" => $this->post('item_price_type_id'),
            "order_by" => $this->post('order_by'),
            "order_type" => $this->post('order_type'),
        	"item_currency_id" => $this->post('item_currency_id'), 
        	"condition_of_item_id" => $this->post('condition_of_item_id'),
        	"item_location_id" => $this->post('item_location_id'),
        	"deal_option_id" => $this->post('deal_option_remark'),
        	"max_price" => $this->post('max_price'),
        	"min_price" => $this->post('min_price'),
        	"brand" => $this->post('brand'),
        	"lat" => $this->post('lat'),
            "lng" => $this->post('lng'),
            "miles"=>$this->post('miles'),
            "is_paid"=>$this->post('is_paid'),
            "status" => $this->post('status'),
            "searchterm"=>$this->post('searchterm'),
            "limit_fetch" => $this->post('limit_fetch'),
            "offset" => $this->post('offset'),
            "user_id"=>$this->post('user_id'),
            "save_search_name"=>$this->post('save_search_name'),
			"api_key"=>$this->post('api_key'),
			"bedrooms"=>$this->post('bedrooms'),
			"bathrooms"=>$this->post('bathrooms'),
        	
        );

		$id = $item_data['id'];
		
		if($id != ""){
		 	$this->Search->save($item_data,$id);

		} else{
		 	$this->Search->save($item_data);

		 	$id = $item_data['id'];

		}
		 
		$obj = $this->Search->get_one( $id );
		
		//$this->ps_adapter->convert_search( $obj );
		$this->custom_response( $obj );

	}

}