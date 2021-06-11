<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for News
 */
class Realty_share_property extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Realty_share_properties' );
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

			if($this->post('item_id') != "") {
				$conds['item_id']   = $this->post('item_id');
            }
            
            if($this->post('property_name') != "") {
				$conds['property_name']   = $this->post('property_name');
			}

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

		$this->ps_adapter->convert_items_info( $obj );
	}

}