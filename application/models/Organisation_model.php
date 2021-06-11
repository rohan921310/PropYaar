<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Itemtype table
 */
class Organisation_model extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_organisation', 'org_id', 'org_' );
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
		if ( isset( $conds['org_id'] )) {
			$this->db->where( 'org_id', $conds['org_id'] );
		}

		// name condition
		if ( isset( $conds['org_name'] )) {
			$this->db->where( 'org_name', $conds['org_name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'org_name', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_organisation.'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'org_id' );
		}
	}

	function save_org($org_data)
	{
		$this->db->insert('bs_organisation',$org_data);
	}

	function update_org( $org_data,$org_id)
	{
		$this->db->where('org_id', $org_id);
		$this->db->update('bs_organisation',$org_data);
	}

}