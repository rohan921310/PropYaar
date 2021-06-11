<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Realty_site extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'realty_site_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// get rows count
		$this->data['rows_count'] = $this->Realty_sites->count_all_by( $conds );
		
		// get conditions
		$this->data['realty_sites'] = $this->Realty_sites->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cond_search' );
		
		// condition with search term
		$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "id";
		$conds['order_by_type'] = "desc";


		// pagination
		$this->data['rows_count'] = $this->Realty_sites->count_all_by( $conds );

		// search data
		$this->data['realty_sites'] = $this->Realty_sites->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Add Realty Shares' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Edit Realty Shares' );

		// load user
		$this->data['realty_sites'] = $this->Realty_sites->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );
	}

	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save category
	 * 3) save image
	 * 4) check transaction status
	 *
	 * @param      boolean  $id  The user identifier
	 */
	function save( $id = false ) {
		// start the transaction
		$this->db->trans_start();
		
		$logged_in_user = $this->ps_auth->get_user_info();

		/** 
		 * Insert Category Records 
		 */
		$data = array();

	
		
		if ( $this->has_data( 'user_id' )) {
			$data['user_id'] = $this->get_data( 'user_id' );
		}
		
		if ( $this->has_data( 'user_site_url' )) {
			$data['user_site_url'] = $this->get_data( 'user_site_url' );
		}
		
		if ( $this->has_data( 'no_properties' )) {
			$data['no_properties'] = $this->get_data( 'no_properties' );
		}


		// save category
		if ( ! $this->Realty_sites->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		

		/** 
		 * Check Transactions 
		 */

		// commit the transaction
		if ( ! $this->check_trans()) {
        	
			// set flash error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));
		} else {

			if ( $id ) {
			// if user id is not false, show success_add message
				
				$this->set_flash_msg( 'success', get_msg( 'success_condition_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_condition_add' ));
			}
		}

		redirect( $this->module_site_url());
	}


	

	/**
	 * Delete the record
	 * 1) delete condition
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_realty_sites( $id )) {

			// set error message
			$this->set_flash_msg( 'error', get_msg( 'err_model' ));

			// rollback
			$this->trans_rollback();

			// redirect to list view
			redirect( $this->module_site_url());
		}
			
		/**
		 * Check Transcation Status
		 */
		if ( !$this->check_trans()) {

			$this->set_flash_msg( 'error', get_msg( 'err_model' ));	
		} else {
        	
			$this->set_flash_msg( 'success', get_msg( 'success_condition_delete' ));
		}
		
		redirect( $this->module_site_url());
	}

	
	
	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'user_id', get_msg( 'user_id' ), $rule);

		if ( $this->form_validation->run() == FALSE ) {
		// if there is an error in validating,

			return false;
		}

		return true;
	}

	/**
	 * Determines if valid name.
	 *
	 * @param      <type>   $name  The  name
	 * @param      integer  $id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $id = 0 )
	{		

		 $conds['user_id'] = $name;

			
		 	if( $id != "") {
				if ( strtolower( $this->Realty_sites->get_one( $id )->user_id ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Realty_sites->exists( ($conds ))) {
					// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				if ( $this->Realty_sites->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			}
			return true;
	}

	/**
	 * Check condition name via ajax
	 *
	 * @param      boolean  $condition_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		// get condition name

		$name = $_REQUEST['user_id'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the condition name is valid,
			
			echo "true";
		} else {
		// if invalid condition name,
			
			echo "false";
		}
	}

	

}