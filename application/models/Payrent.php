<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Payrent extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_payrent', 'id', 'payrent');
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

		// user id condition
		if ( isset( $conds['user_id'] )) {
			
			if ($conds['user_id'] != "") {
				if($conds['user_id'] != '0'){
					$this->db->where( 'user_id', $conds['user_id'] );	
				}

			}			
		}

		//  property name condition 
		if ( isset( $conds['property_name'] )) {
			
			if ($conds['property_name'] != "") {
				if($conds['property_name'] != '0'){
				
					$this->db->where( 'property_name', $conds['property_name'] );	
				}

			}			
		}
		// property_id condition
		if ( isset( $conds['property_id'] )) {
			
			if ($conds['property_id'] != "") {
				if($conds['property_id'] != '0'){
				
					$this->db->where( 'property_id', $conds['property_id'] );	
				}

			}			
		}
		
	}


	function properties_count($user_id ){

		$this->db->where('user_id', $user_id);
		$this->db->from('bs_payrent');
		$query = $this->db->get();
		$count = $query->num_rows();
		$this->db->set('rent_properties_count',$count);
		$this->db->where('user_id', $user_id);
		$this->db->update('bs_payrent');
	}

	function total_amt_collected($user_id){
		$this->db->select_sum('total_rent');
		$this->db->from('bs_payrent');
		$this->db->where( 'user_id', $user_id );
		$query=$this->db->get();
		$total= $query->row()->total_rent;
		$this->db->set('total_amt_collected',$total);
		$this->db->where('user_id', $user_id);
		$this->db->update('bs_payrent');
	}

}