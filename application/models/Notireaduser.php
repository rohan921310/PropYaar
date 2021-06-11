<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for about table
 */
class Notireaduser extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_push_notification_users', 'id', 'noti_red_' );
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

		// noti_id condition
		if ( isset( $conds['noti_id'] )) {
			$this->db->where( 'noti_id', $conds['noti_id'] );
		}

		// user_id condition
		if ( isset( $conds['user_id'] )) {
			$this->db->where( 'user_id', $conds['user_id'] );
		}

		// device_token condition
		if ( isset( $conds['device_token'] )) {
			$this->db->where( 'device_token', $conds['device_token'] );
		}

		// is_visible condition
		if ( isset( $conds['is_visible'] )) {
			$this->db->where( 'visible_flag', $conds['is_visible'] );
		}

		$this->db->order_by( 'added_date', 'desc' );
	}

	function delete_noti($noti_delete,$is_visible){

		$this->db->set('visible_flag',$is_visible);
		$this->db->where($noti_delete);
		$this->db->update('bs_push_notification_users');
	}

	function visible( $noti_user_data )
	{
		$this->db->where($noti_user_data);
		$this->db->limit(1);
		$query = $this->db->get('bs_push_notification_users');
		return $query->result();
	}


}