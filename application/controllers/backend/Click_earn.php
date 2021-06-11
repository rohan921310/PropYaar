<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Click_earn extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'click_earn_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// get rows count
		$this->data['rows_count'] = $this->Clickearn_model->count_all_by( $conds );
		
		// get conditions
		$this->data['click_earn'] = $this->Clickearn_model->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
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
		$this->data['rows_count'] = $this->Clickearn_model->count_all_by( $conds );

		// search data
		$this->data['click_earn'] = $this->Clickearn_model->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Add Click & Earn' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Edit Click & Earn' );

		// load user
		$this->data['click_earn'] = $this->Clickearn_model->get_one( $id );

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

		//  name
		if ( $this->has_data( 'owner_name' )) {
			$data['owner_name'] = $this->get_data( 'owner_name' );
        }

        // Email
		if ( $this->has_data( 'email' )) {
			$data['email'] = $this->get_data( 'email' );
        }
        
        //  phone number
		if ( $this->has_data( 'owner_phone_number' )) {
			$data['owner_phone_number'] = $this->get_data( 'owner_phone_number' );
        }

		if ( $this->has_data( 'property_type' )) {
			$data['property_type'] = $this->get_data( 'property_type' );
		}
		
		if ( $this->has_data( 'city_name' )) {
			$data['city_name'] = $this->get_data( 'city_name' );
		}
		
		if ( $this->has_data( 'address' )) {
			$data['address'] = $this->get_data( 'address' );
		}
	


		// save category
		if ( ! $this->Clickearn_model->save( $data, $id )) {
		// if there is an error in inserting user data,	

			// rollback the transaction
			$this->db->trans_rollback();

			// set error message
			$this->data['error'] = get_msg( 'err_model' );
			
			return;
		}

		/** 
		 * Upload Image Records 
		 */
		if ( !$id ) {
			if ( ! $this->insert_icon_images( $_FILES, 'click_earn', $data['id'], "cover" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}	
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
		if ( !$this->ps_delete->delete_click_earn( $id )) {

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

		$this->form_validation->set_rules( 'owner_name', get_msg( 'Owner Name' ), $rule);

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

		 $conds['owner_name'] = $owner_name;

			
		 	if( $id != "") {
				if ( strtolower( $this->Clickearn_model->get_one( $id )->owner_name ) == strtolower( $owner_name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Clickearn_model->exists( ($conds ))) {
					// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				if ( $this->Clickearn_model->exists( ($conds ))) {
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

		$name = $_REQUEST['owner_name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the condition name is valid,
			
			echo "true";
		} else {
		// if invalid condition name,
			
			echo "false";
		}
	}

	

}