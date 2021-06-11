<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Requirement extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_requirements', 'id', 'reqmt_' );
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

		// user_id condition
		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}


		// location condition
		if ( isset( $conds['location_id'] )) {
			$this->db->where( 'location_id', $conds['location_id'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'id', $conds['searchterm'] );
			$this->db->or_like( 'location', $conds['searchterm'] );
			$this->db->group_end();
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_requirements.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'id' );
		}
	}
}