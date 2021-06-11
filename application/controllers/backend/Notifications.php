<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 */
class Notifications extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {
		
		
		parent::__construct( MODULE_CONTROL, 'notifications_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";
		// get rows count
		$this->data['rows_count'] = $this->Notifications_modal->count_all_by( $conds );
		
		// get categories
		$this->data['notifications'] = $this->Notifications_modal->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_search' );
		
		// condition with search term
		$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "added_date";
		$conds['order_by_type'] = "desc";


		// pagination
		$this->data['rows_count'] = $this->Notifications_modal->count_all_by( $conds );

		// search data
		$this->data['notifications'] = $this->Notifications_modal->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
//	function add() {
//
//		// breadcrumb urls
//		$this->data['action_title'] = get_msg( 'Add Business Users' );
//
//		// call the core add logic
//		parent::add();
//	}

	/**
	 * Update the existing one
	 */
//	function edit( $id ) {
//
//		// breadcrumb urls
//		$this->data['action_title'] = get_msg( 'Edit Business Users' );
//
//		// load user
//		$this->data['category'] = $this->Notifications_modal->get_one( $id );
//
//		// call the parent edit logic
//		parent::edit( $id );
//	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save category
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
//	function save( $id = false ) {
//		// start the transaction
//		$this->db->trans_start();
//		
//		/** 
//		 * Insert Category Records 
//		 */
//		$data = array();
//
//		// prepare cat name
//		if ( $this->has_data( 'cat_name' )) {
//			$data['cat_name'] = $this->get_data( 'cat_name' );
//		}
//
//
//		// save category
//		if ( ! $this->Notifications_modal->save( $data, $id )) {
//		// if there is an error in inserting user data,	
//
//			// rollback the transaction
//			$this->db->trans_rollback();
//
//			// set error message
//			$this->data['error'] = get_msg( 'err_model' );
//			
//			return;
//		}
//
//		/** 
//		 * Upload Image Records 
//		 */
//		if ( !$id ) {
//			if ( ! $this->insert_icon_images( $_FILES, 'category', $data['cat_id'], "cover" )) {
//				// if error in saving image
//
//					// commit the transaction
//					$this->db->trans_rollback();
//					
//					return;
//				}
//			if ( ! $this->insert_icon_images( $_FILES, 'category-icon', $data['cat_id'], "icon" )) {
//				// if error in saving image
//
//					// commit the transaction
//					$this->db->trans_rollback();
//					
//					return;
//				}	
//		}
//
//		/** 
//		 * Check Transactions 
//		 */
//
//		// commit the transaction
//		if ( ! $this->check_trans()) {
//        	
//			// set flash error message
//			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
//		} else {
//
//			if ( $id ) {
//			// if user id is not false, show success_add message
//				
//				$this->set_flash_msg( 'success', get_msg( 'success_cat_edit' ));
//			} else {
//			// if user id is false, show success_edit message
//
//				$this->set_flash_msg( 'success', get_msg( 'success_cat_add' ));
//			}
//		}
//
//		redirect( $this->module_site_url());
//	}


	

	/**
	 * Delete the record
	 * 1) delete category
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
//	function delete( $id ) {
//
//		// start the transaction
//		$this->db->trans_start();
//
//		// check access
//		$this->check_access( DEL );
//		
//		// delete categories and images
//		if ( !$this->ps_delete->delete_category( $id )) {
//
//			// set error message
//			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
//
//			// rollback
//			$this->trans_rollback();
//
//			// redirect to list view
//			redirect( $this->module_site_url());
//		}
//			
//		/**
//		 * Check Transcation Status
//		 */
//		if ( !$this->check_trans()) {
//
//			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
//		} else {
//        	
//			$this->set_flash_msg( 'success', get_msg( 'success_cat_delete' ));
//		}
//		
//		redirect( $this->module_site_url());
//	}



	/**
	 * Publish the record
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function ajx_publish( $id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$data = array( 'is_verified'=> 1 );
			
		// save data
		if ( $this->Notifications_modal->save( $data, $id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function ajx_unpublish( $id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$data = array( 'is_verified'=> 0 );
			
		// save data
		if ( $this->Notifications_modal->save( $data, $id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}
}