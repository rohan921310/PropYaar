<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for category table
 */
class Project_flats extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_project_item_details', 'id', 'PRJT_ITM_' );
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

		// project_id condition
		if ( isset( $conds['project_id'] )) {
			$this->db->where( 'project_id', $conds['project_id'] );
        }
        
        // flat condition
		if ( isset( $conds['flat'] )) {
			$this->db->where( 'flat', $conds['flat'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->like( 'flat', $conds['searchterm'] );
		}

		// order_by
		if ( isset( $conds['order_by'] )) {

			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];

			$this->db->order_by( 'bs_project_item_details'.$order_by_field, $order_by_type );
		} else {

			$this->db->order_by( 'added_date' );
		}
    }
    
    function get_flats_data($id)
    {
        $this->db->where('project_id', $id);
		$this->db->from('bs_project_item_details');
        $query = $this->db->get();
        return $query->result();
    }

    function update_project_flats( $flats_data,$id)
	{
		$this->db->set($flats_data);
		$this->db->where('id', $id);
		$this->db->update('bs_project_item_details');
	}

	function delete_flat_row($id){
		$this->db->where('id', $id);
		$this->db->delete('bs_project_item_details');
	}
	
	function get_flat_id($id,$flat_type)
    {
		$this->db->where('project_id', $id);
		$this->db->where('flat_type', $flat_type);
		$this->db->from('bs_project_item_details');
        $query = $this->db->get();
        return $query->row();
	}


	function delete_flat_file($id,$file){
		$this->db->set('flat_image_url',$file);
		$this->db->where('id',$id );
		$query = $this->db->update('bs_project_item_details');
		if($query){
			return true;
		}else{
			return false;
		}
	}


}