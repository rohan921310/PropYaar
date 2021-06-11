<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Home_service extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_home_services', 'id', 'hm_sr_' );
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

		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}

		if ( isset( $conds['home_services_category'] )) {
			$this->db->where( 'home_services_category', $conds['home_services_category'] );
		}

		if ( isset( $conds['location'] )) {
			$this->db->where( 'location', $conds['location'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->group_start();
			$this->db->like( 'location', $conds['searchterm'] );
			$this->db->or_like( 'home_services_category', $conds['searchterm'] );
			$this->db->group_end();
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_home_services.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'id' );
		}
	}
}