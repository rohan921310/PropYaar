<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for category table
 */
class Ad_type extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_ad_type', 'ad_type_id', 'Ad_type_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{

		if ( isset( $conds['ad_type_id'] )) {
			$this->db->where( 'ad_type_id', $conds['ad_type_id'] );
        }
        
        if ( isset( $conds['ad_type_name'] )) {
			$this->db->where( 'ad_type_name', $conds['ad_type_name'] );
		}
		
	}
}