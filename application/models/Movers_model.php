<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Movers_model extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_movers', 'id', 'mv_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// default where clause
		//if ( !isset( $conds['no_publish_filter'] )) {
		//	$this->db->where( 'status', 1 );
		//}

		// id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// name condition
		if ( isset( $conds['mv_name'] )) {
			$this->db->where( 'mv_name', $conds['mv_name'] );
		}

		if ( isset( $conds['listed_user_id'] )) {
			$this->db->where( 'listed_user_id', $conds['listed_user_id'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'mv_name', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_movers.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'id' );
		}
	}
}