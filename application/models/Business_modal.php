<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model for core_USERS table
 */
class Business_modal extends PS_Model {

	// table name for module
	protected $module_table_name;

	// table name for permission
	protected $permission_table_name;

	// table name for role access
	protected $role_access_table_name;

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'core_business_account', 'user_id', 'bs_ac' );

		// initialize table names
		$this->module_table_name = "core_modules";
		$this->permission_table_name = "core_permissions";
		$this->role_access_table_name = "core_role_access";
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

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->group_start();
			$this->db->like( 'name', $conds['searchterm'] );
			$this->db->or_like( 'email', $conds['searchterm'] );
			$this->db->or_like( 'phone', $conds['searchterm'] );
			$this->db->or_like( 'city', $conds['searchterm'] );
			$this->db->or_like( 'company_name', $conds['searchterm'] );
			$this->db->group_end();
		}
		
		// order by
		if ( isset( $conds['order_by'] )) {
			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];
			
			$this->db->order_by( 'core_business_account.'.$order_by_field, $order_by_type);
		}

		// user_id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( $this->primary_key, $conds['id'] );
		}

		$this->db->order_by('added_date', 'desc');
	}

	function login_action($data){
        $this->db->where($data);      
        $query = $this->db->get('core_business_account');  
        if ($query->num_rows() == 1)  
        {  
            return $query->row();
        } else {  
            return false;  
        } 
	}

}