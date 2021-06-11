<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Risee_category extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'core_risee_menu_group', 'cat_id', 'riseecategory');
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{

		if ( isset( $conds['is_visible'] )) {
			$this->db->where( 'is_visible', $conds['is_visible'] );
		}

		// group_id condition
		if ( isset( $conds['group_id'] )) {
			$this->db->where( 'group_id', $conds['group_id'] );
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