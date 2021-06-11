<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Home_loan extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_homeloans', 'id', 'HL_' );
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
		if ( isset( $conds['type_of_loan'] )) {
			$this->db->where( 'type_of_loan', $conds['type_of_loan'] );
		}

		// name condition
		if ( isset( $conds['aadharcard_name'] )) {
			$this->db->where( 'aadharcard_name', $conds['aadharcard_name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'aadharcard_name', $conds['searchterm'] );
		}

		if ( isset( $conds['listed_user_id'] )) {
			$this->db->like( 'listed_user_id', $conds['listed_user_id'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_homeloans.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'id' );
		}
	}
}