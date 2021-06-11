<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Realty_category extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'core_realty_categories', 'cat_id', 'realtycat');
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{

        // cat_id condition
		if ( isset( $conds['cat_id'] )) {
			$this->db->where( 'cat_id', $conds['cat_id'] );
		}

		// group_lang_key condition
		if ( isset( $conds['group_lang_key'] )) {
			
			if ($conds['group_lang_key'] != "") {
				if($conds['group_lang_key'] != '0'){
					$this->db->where( 'group_lang_key', $conds['group_lang_key'] );	
				}

			}			
		}

		// group_name condition
		if ( isset( $conds['group_name'] )) {
			
			if ($conds['group_name'] != "") {
				if($conds['group_name'] != '0'){
				
					$this->db->where( 'group_name', $conds['group_name'] );	
				}

			}			
		}
	  

		
	}

}