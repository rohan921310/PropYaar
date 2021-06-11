<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for category table
 */
class Furnished extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_furnishing', 'furnishing_id', 'fur_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// default where clause
		if ( !isset( $conds['no_publish_filter'] )) {
			$this->db->where( 'status', 1 );
		}

		// cat_id condition
		if ( isset( $conds['furnishing_id'] )) {
			$this->db->where( 'furnishing_id', $conds['furnishing_id'] );
		}

		// cat_name condition
		if ( isset( $conds['name'] )) {
			$this->db->where( 'name', $conds['name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'name', $conds['searchterm'] );
		}

		// order_by

			$this->db->order_by( 'added_date' );
		
	}
}