<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Arvr_model extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_3d_arvr', 'id', '3d_arvr');
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
		if ( isset( $conds['property_location'] )) {
			
			if ($conds['property_location'] != "") {
				if($conds['property_location'] != '0'){
				
					$this->db->where( 'property_location', $conds['property_location'] );	
				}

			}			
		}

		
	}

	function insert_images($image_data)
	{
		$this->db->insert('core_images',$image_data);
	}




}