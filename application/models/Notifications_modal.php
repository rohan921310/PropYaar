<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model for core_USERS table
 */
class Notifications_modal extends PS_Model {


	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_push_notifications', 'id', 'push_Noti_' );

	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// default where clause

//		if ( isset( $conds['is_realty_share_property_enable'] )) {
//			$this->db->where( 'is_realty_share_property_enable', $conds['is_realty_share_property_enable'] );
//		}

		// User Id 
		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}

		// is_read 
		if ( isset( $conds['is_read'] )) {
			$this->db->where( 'is_read', $conds['is_read'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->group_start();
			$this->db->like( 'title', $conds['searchterm'] );
			//$this->db->or_like( 'email', $conds['searchterm'] );
			//$this->db->or_like( 'phone', $conds['searchterm'] );
			//$this->db->or_like( 'city', $conds['searchterm'] );
			//$this->db->or_like( 'company_name', $conds['searchterm'] );
			$this->db->group_end();
		}
		
		// order by
		if ( isset( $conds['order_by'] )) {
			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];
			
			$this->db->order_by( 'bs_push_notifications.'.$order_by_field, $order_by_type);
		}

		// user_id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( $this->primary_key, $conds['id'] );
		}

		$this->db->order_by('added_date', 'desc');
	}


}