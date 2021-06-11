<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Users_share_properties extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_users_shares_property', 'id', 'UR_shr_pr_' );
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

		if ( isset( $conds['is_paid'] )) {
			$this->db->where( 'is_paid', $conds['is_paid'] );
		}

		if ( isset( $conds['realty_share_property_id'] )) {
			$this->db->where( 'realty_share_property_id', $conds['realty_share_property_id'] );
		}

		if ( isset( $conds['is_following'] )) {
			$this->db->where( 'is_following', $conds['is_following'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'user_id', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_users_shares_property.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'id' );
		}
	}

	function item_id($title){
		$this->db->where('title', $title);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() === 1){
			return $query->result();
		}else{
			return false;
		}
	}

	function delete_User_share_property(){
		$this->db->where('is_paid', 0);
		$this->db->where('amount_paid', 0);
		$this->db->where('is_following', 0);
		$this->db->delete('bs_users_shares_property');
	}

	function investors_count($share_property_id){

		$this->db->where('realty_share_property_id', $share_property_id);
		$this->db->where('is_paid', 1);
		$this->db->from('bs_users_shares_property');
		$query = $this->db->get();
		$count = $query->num_rows();
		$this->db->set('no_investors', $count);
		$this->db->where('id', $share_property_id);
		$this->db->update('bs_realty_shares_property');

	}

}