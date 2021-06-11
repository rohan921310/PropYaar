<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Lrs_model extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_lrs', 'id', 'lrs');
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// user id condition
		if ( isset( $conds['phone'] )) {
			
			if ($conds['phone'] != "") {
				if($conds['phone'] != '0'){
					$this->db->where( 'phone', $conds['phone'] );	
				}

			}			
		}

		//  property name condition 
		if ( isset( $conds['property_type'] )) {
			
			if ($conds['property_type'] != "") {
				if($conds['property_type'] != '0'){
				
					$this->db->where( 'property_type', $conds['property_type'] );	
				}

			}			
		}
		// property_id condition
		if ( isset( $conds['property_id'] )) {
			
			if ($conds['property_id'] != "") {
				if($conds['property_id'] != '0'){
				
					$this->db->where( 'property_id', $conds['property_id'] );	
				}

			}			
		}
		
	}

	function insert_images($image_data)
	{
		$this->db->insert('core_images',$image_data);
	}




}