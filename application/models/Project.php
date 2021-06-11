<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for category table
 */
class Project extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_project_details', 'id', 'PRJT_' );
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


		// cat_id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// cat_name condition
		if ( isset( $conds['name'] )) {
			$this->db->where( 'name', $conds['name'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'name', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_project_details'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'added_date' );
		}
	}


	function save_project($project_data)
	{
		$this->db->insert('bs_project_details',$project_data);
	}


	function update_project( $project_data,$id)
	{
		$this->db->set($project_data);
		$this->db->where('id', $id);
		$this->db->update('bs_project_details');
	}

	function update_project_files( $data,$id)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('bs_project_details');
	}

	function delete_project_files($project_update_files,$project_id)
	{
		$this->db->where($project_update_files);
		$this->db->where("id", $project_id);
		$this->db->delete("bs_project_details");
	}

	function delete_flat_file($id,$file){
		$this->db->set($file);
		$this->db->where('id',$id );
		$query = $this->db->update('bs_project_details');
		if($query){
			return true;
		}else{
			return false;
		}
	}




}