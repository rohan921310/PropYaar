<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model class for Item table
 */
class Item extends PS_Model {

	/**
	 * Constructs the required data
	 */
	function __construct() 
	{
		parent::__construct( 'bs_items', 'id', 'itm_' );
	}

	/**
	 * Implement the where clause
	 *
	 * @param      array  $conds  The conds
	 */
	function custom_conds( $conds = array())
	{
		// Price filter low to high and high to low
		if (isset( $conds['price_filter'] )) {
			$this->db->order_by( 'price', $conds['price_filter'] );
		}

		if (isset( $conds['is_shares_property'] )) {
			$this->db->where( 'is_shares_property', $conds['is_shares_property'] );
		}

		if (isset( $conds['is_live'] )) {
			$this->db->where( 'is_live', $conds['is_live'] );
		}

		if (isset( $conds['is_funded'] )) {
			$this->db->where( 'is_funded', $conds['is_funded'] );
		}

		// Best Deal
		if (isset( $conds['is_best_deal'] )) {
			$this->db->where( 'is_best_deal', $conds['is_best_deal'] );
		}

		// Limited Offer
		if (isset( $conds['is_limited_offer'] )) {
			$this->db->where( 'is_limited_offer', $conds['is_limited_offer'] );
		}

		// default where clause
		if (isset( $conds['area'] )) {
			$this->db->where( 'area', $conds['area'] );
		}

		// numberofbedrooms
		if (isset( $conds['bedrooms'] )) {
			$this->db->where( 'numberofbedrooms', $conds['bedrooms'] );
		}

		// numberofbathrooms
		if (isset( $conds['bathrooms'] )) {
			$this->db->where( 'numberofbathrooms', $conds['bathrooms'] );
		}
		
		// status
		if (isset( $conds['status'] )) {
			$this->db->where( 'status', $conds['status'] );
		}
		
		// is_paid condition
		if (isset( $conds['is_paid'] )) {
			$this->db->where( 'is_paid', $conds['is_paid'] );
		}

		// order by
		if ( isset( $conds['order_by_field'] )) {
			$order_by_field = $conds['order_by_field'];
			$order_by_type = $conds['order_by_type'];
			
			$this->db->order_by( 'bs_items.'.$order_by_field, $order_by_type);
		} else {
			$this->db->order_by('added_date', 'desc' );
		}

		// id condition
		if ( isset( $conds['id'] )) {
			$this->db->where( 'id', $conds['id'] );
		}

		// id condition
		if ( isset( $conds['added_user_id'] )) {
			$this->db->where( 'added_user_id', $conds['added_user_id'] );
		}

		// category id condition
		if ( isset( $conds['cat_id'] )) {
			
			if ($conds['cat_id'] != "") {
				if($conds['cat_id'] != '0'){
					$this->db->where( 'cat_id', $conds['cat_id'] );	
				}

			}			
		}


		// furnishing_id id condition
		if ( isset( $conds['furnishing_id'] )) {
	
			if ($conds['furnishing_id'] != "") {
				if($conds['furnishing_id'] != '0'){
					$this->db->where( 'furnishing_id', $conds['furnishing_id'] );	
				}

			}			
		}

		//  sub category id condition 
		if ( isset( $conds['sub_cat_id'] )) {
			
			if ($conds['sub_cat_id'] != "") {
				if($conds['sub_cat_id'] != '0'){
				
					$this->db->where( 'sub_cat_id', $conds['sub_cat_id'] );	
				}

			}			
		}

		// Type id
		if ( isset( $conds['item_type_id'] )) {
			
			if ($conds['item_type_id'] != "") {
				if($conds['item_type_id'] != '0'){
				
					$this->db->where( 'item_type_id', $conds['item_type_id'] );	
				}

			}			
		}
	  
		// Price id
		if ( isset( $conds['item_price_type_id'] )) {
			
			if ($conds['item_price_type_id'] != "") {
				if($conds['item_price_type_id'] != '0'){
				
					$this->db->where( 'item_price_type_id', $conds['item_price_type_id'] );	
				}

			}			
		}
	   
		// Currency id
		if ( isset( $conds['item_currency_id'] )) {
			
			if ($conds['item_currency_id'] != "") {
				if($conds['item_currency_id'] != '0'){
				
					$this->db->where( 'item_currency_id', $conds['item_currency_id'] );	
				}

			}			
		}

		// location id
		if ( isset( $conds['item_location_id'] )) {
			
			if ($conds['item_location_id'] != "") {
				if($conds['item_location_id'] != '0'){
				
					$this->db->where( 'item_location_id', $conds['item_location_id'] );	
				}

			}			
		}

		// condition_of_item id condition
		if ( isset( $conds['condition_of_item_id'] )) {
			$this->db->where( 'condition_of_item_id', $conds['condition_of_item_id'] );
		}

		// description condition
		if ( isset( $conds['description'] )) {
			$this->db->where( 'description', $conds['description'] );
		}

		// highlight_info condition
		if ( isset( $conds['highlight_info'] )) {
			$this->db->where( 'highlight_info', $conds['highlight_info'] );
		}

		// deal_option_id condition
		if ( isset( $conds['deal_option_id'] )) {
			$this->db->where( 'deal_option_id', $conds['deal_option_id'] );
		}

		// brand condition
		if ( isset( $conds['project_name'] )) {
			$this->db->where( 'project_name', $conds['project_name'] );
		}

		// business_mode condition
		if ( isset( $conds['business_mode'] )) {
			$this->db->where( 'business_mode', $conds['business_mode'] );
		}

		// title condition
		if ( isset( $conds['title'] )) {
			$this->db->like( 'title', $conds['title'] );
		}
		// property_id condition
		if ( isset( $conds['property_id'] )) {
			$this->db->like( 'property_id', $conds['property_id'] );
		}

		// map_layout_id condition
		if ( isset( $conds['map_layout_id'] )) {
			$this->db->like( 'map_layout_id', $conds['map_layout_id'] );
		}

		// searchterm
		if ( isset( $conds['searchterm'] )) {
			$this->db->group_start();
			$this->db->like( 'title', $conds['searchterm'] );
//			$this->db->or_like( 'description', $conds['searchterm'] );
//			$this->db->or_like( 'condition_of_item_id', $conds['searchterm'] );
//			$this->db->or_like( 'highlight_info', $conds['searchterm'] );
			$this->db->group_end();
		}

		if( isset($conds['max_price']) ) {
			if( $conds['max_price'] != 0 ) {
				$this->db->where( 'price <=', $conds['max_price'] );
			}	

		}

		if( isset($conds['min_price']) ) {

			if( $conds['min_price'] != 0 ) {
				$this->db->where( 'price >=', $conds['min_price'] );
			}

		}
		
	}

	function listing_count($usr_id)
	{
		$this->db->where('added_user_id', $usr_id);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$count = $query->num_rows();
		}else{
			$count = 0;
		}
		$this->db->set('listings_count',$count);
		$this->db->where('user_id', $usr_id);
		$this->db->update('core_users');
	}

	function pendings_count($usr_id)
	{
		$this->db->where('added_user_id', $usr_id);
		$this->db->where('status', 0);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$count = $query->num_rows();
		}else{
			$count = 0;
		}
		$this->db->set('pendings_count',$count);
		$this->db->where('user_id', $usr_id);
		$this->db->update('core_users');
	}

	function indrafts_count($usr_id)
	{
		$this->db->where('added_user_id', $usr_id);
		$this->db->where('status', 4);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$count = $query->num_rows();
		}else{
			$count = 0;
		}
		$this->db->set('indrafts_count',$count);
		$this->db->where('user_id', $usr_id);
		$this->db->update('core_users');
	}

	function rejected_count($usr_id)
	{
		$this->db->where('added_user_id', $usr_id);
		$this->db->where('status', 3);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$count = $query->num_rows();
		}else{
			$count = 0;
		}
		$this->db->set('rejected_count',$count);
		$this->db->where('user_id', $usr_id);
		$this->db->update('core_users');
	}

	function sale_count($location_id)
	{
		$this->db->where('item_location_id', $location_id);
		$this->db->where('item_type_id', 4);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$sale_count = $query->num_rows();
		}else{
			$sale_count = 0;
		}
		$this->db->where('item_location_id', $location_id);
		$this->db->set('for_sale_count',$sale_count);
		$this->db->update('bs_items');
	}

	function rent_count($location_id)
	{
		$this->db->where('item_location_id', $location_id);
		$this->db->where('item_type_id', 2);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$rent_count = $query->num_rows();
		}else{
			$rent_count = 0;
		}
		$this->db->where('item_location_id', $location_id);
		$this->db->set('for_rent_count',$rent_count);
		$this->db->update('bs_items');
	}

	function read_item(){
		$this->db->set('is_read',1);
		$this->db->where('is_read', 0);
		$this->db->update('bs_items');
	}

	function unread_count(){

		$this->db->where('is_read', 0);
		$this->db->from('bs_items');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			echo $query->num_rows();
		}else{
			echo 0;
		}
	}

	function update_status_admin($item_id,$item_status){
		$this->db->set('status',$item_status);
		$this->db->where('id', $item_id);
		$query = $this->db->update('bs_items');
	    if($query){
			return true;
		}else{
			return false;
		}
	}

}