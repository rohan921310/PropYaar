<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Realty_share_properties extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_realty_shares_property', 'id', 'RL_shr_pr_' );
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
        
		if ( isset( $conds['item_id'] )) {
			$this->db->where( 'item_id', $conds['item_id'] );
		}

		if ( isset( $conds['property_name'] )) {
			$this->db->where( 'property_name', $conds['property_name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'property_name', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_realty_shares_property.'.$order_by_field, $order_by_type );
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



}