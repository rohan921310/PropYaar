<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users crontroller for BE_USERS table
 */
class Ar_vr extends BE_Controller {

	/**
	 * Constructs required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'ar_vr_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Arvr_model->count_all_by( $conds );

		$this->data['arvr_data'] = $this->Arvr_model->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load index logic
		parent::index();
    }
    

    	/**
	 * Searches for the Searches details
	 */
	function search() {

		// breadcrumb urls
        $this->data['action_title'] = get_msg( 'search_payrent' );
		
		// condition with search term
		$search_term = $this->searchterm_handler( $this->input->post( 'searchterm' ));
        
		// condition
		$conds = array( 'searchterm' => $search_term );

        // pagination
		$this->data['rows_count'] = $this->Arvr_model->count_all_by( $conds );

		// search data

		$this->data['arvr_data'] = $this->Arvr_model->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
        
		// load add list
		parent::search();
	}


	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_add' );

		// call the core add logic
		parent::add();
	}


		/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cat_edit' );

		// load user
		$this->data['arvr_data'] = $this->Arvr_model->get_one( $id );

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
		//$logged_in_user = $this->ps_auth->get_user_info();
		
		/** 
		 * Insert 3D ARVR Records 
		 */
		$data = array();

		// prepare 3D ARVR name
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}
		

		// prepare 3D ARVR email
		if ( $this->has_data( 'email' )) {
			$data['email'] = $this->get_data( 'email' );
		}

		// prepare 3D ARVR phone
		if ( $this->has_data( 'phone' )) {
			$data['phone'] = $this->get_data( 'phone' );
		}

		// prepare 3D ARVR property_location
		if ( $this->has_data( 'property_location' )) {
			$data['property_location'] = $this->get_data( 'property_location' );
		}
	

		//save 3D ARVR
		if ( ! $this->Arvr_model->save( $data, $id )) {
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
			if ( ! $this->insert_icon_images( $_FILES, '3D_ARVR', $data['id'], "cover" )) {
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
				
				$this->set_flash_msg( 'success', get_msg( '3D ARVR has been successfully updated' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( '3D ARVR has been successfully updated' ));
			}
		}

		redirect( $this->module_site_url());
	

	}


			/**
	 * Delete the record
	 * 1) delete lrs details
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $arvr_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_arvr( $arvr_id )) {

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
        	
			$this->set_flash_msg( 'success', get_msg( '3D ARVR has been successfully deleted' ));
		}
		
		redirect( $this->module_site_url());
	}

			/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) 
	{
		
		$rule = 'required|callback_is_valid_name['. $module_id  .']';

		$this->form_validation->set_rules( 'name', get_msg( 'name' ), $rule);
		
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
	 * @param      integer  $group_id     The  identifier
	 *
	 * @return     boolean  True if valid name, False otherwise.
	 */
	function is_valid_name( $name, $id = 0 )
	{		
		 $conds['module_name'] = $name;
			if ( strtolower( $this->Module->get_one( $module_id )->module_name ) == strtolower( $name )) {
			// if the name is existing name for that user id,
				return true;
			} else if ( $this->Module->exists( ($conds ))) {
			// if the name is existed in the system,
				$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
				return false;
			}
			return true;
	}

		/**
	 * Check category name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		// get category name

		$name = $_REQUEST['name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the category name is valid,
			
			echo "true";
		} else {
		// if invalid category name,
			
			echo "false";
		}
	}



}