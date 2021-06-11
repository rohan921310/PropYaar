<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Search extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_searches', 'id', 'search');
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

		// category id condition
		if ( isset( $conds['cat_id'] )) {
			
			if ($conds['cat_id'] != "") {
				if($conds['cat_id'] != '0'){
					$this->db->where( 'cat_id', $conds['cat_id'] );	
				}

			}			
		}

		//  sub category id condition 
		if ( isset( $conds['sub_id'] )) {
			
			if ($conds['sub_id'] != "") {
				if($conds['sub_id'] != '0'){
				
					$this->db->where( 'sub_id', $conds['sub_id'] );	
				}

			}			
		}
		// Type id
		if ( isset( $conds['search_name'] )) {
			
			if ($conds['search_name'] != "") {
				if($conds['search_name'] != '0'){
				
					$this->db->where( 'search_name', $conds['search_name'] );	
				}

			}			
		}
	  

		
	}

}