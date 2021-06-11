<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users crontroller for BE_USERS table
 */
class Lrs extends BE_Controller {

	/**
	 * Constructs required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'lrs_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Lrs_model->count_all_by( $conds );

		$this->data['lrs_data'] = $this->Lrs_model->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

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
		$this->data['rows_count'] = $this->Lrs_model->count_all_by( $conds );

		// search data

		$this->data['lrs_data'] = $this->Lrs_model->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
        
		// load add list
		parent::search();
	}


	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'lrs_add' );

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
		$this->data['lrs_data'] = $this->Lrs_model->get_one( $id );

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
		 * Insert LRS Records 
		 */
		$data = array();

		// prepare lrs name
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}
		

		// prepare lrs email
		if ( $this->has_data( 'email' )) {
			$data['email'] = $this->get_data( 'email' );
		}

		// prepare lrs phone
		if ( $this->has_data( 'phone' )) {
			$data['phone'] = $this->get_data( 'phone' );
		}

		// prepare lrs property_type
		if ( $this->has_data( 'property_type' )) {
			$data['property_type'] = $this->get_data( 'property_type' );
		}

		// prepare lrs property_location
		if ( $this->has_data( 'property_location' )) {
			$data['property_location'] = $this->get_data( 'property_location' );
		}

		if ( $this->has_data( 'plot_type' )) {
			$data['plot_type'] = $this->get_data( 'plot_type' );
		}

		if ( $this->has_data( 'plot_category' )) {
			$data['plot_category'] = $this->get_data( 'plot_category' );
		}

		if ( $this->has_data( 'plot_corporation' )) {
			$data['plot_corporation'] = $this->get_data( 'plot_corporation' );
		}

		if ( $this->has_data( 'plot_zone' )) {
			$data['plot_zone'] = $this->get_data( 'plot_zone' );
		}

		if ( $this->has_data( 'plot_circle' )) {
			$data['plot_circle'] = $this->get_data( 'plot_circle' );
		}

		if ( $this->has_data( 'plot_ward' )) {
			$data['plot_ward'] = $this->get_data( 'plot_ward' );
		}

		if ( $this->has_data( 'father_or_spouse_name' )) {
			$data['father_or_spouse_name'] = $this->get_data( 'father_or_spouse_name' );
		}

		if ( $this->has_data( 'aadhaar_number' )) {
			$data['aadhaar_number'] = $this->get_data( 'aadhaar_number' );
		}

		if ( $this->has_data( 'gender' )) {
			$data['gender'] = $this->get_data( 'gender' );
		}

		if ( $this->has_data( 'house_no' )) {
			$data['house_no'] = $this->get_data( 'house_no' );
		}

		if ( $this->has_data( 'street_colony_name' )) {
			$data['street_colony_name'] = $this->get_data( 'street_colony_name' );
		}

		if ( $this->has_data( 'locality' )) {
			$data['locality'] = $this->get_data( 'locality' );
		}

		if ( $this->has_data( 'town_city_village' )) {
			$data['town_city_village'] = $this->get_data( 'town_city_village' );
		}

		if ( $this->has_data( 'district' )) {
			$data['district'] = $this->get_data( 'district' );
		}

		if ( $this->has_data( 'pincode' )) {
			$data['pincode'] = $this->get_data( 'pincode' );
		}

		//if ( $this->has_data( 'email_id' )) {
		//	$data['email_id'] = $this->get_data( 'email_id' );
		//}

		//if ( $this->has_data( 'alternate_phone_number' )) {
		//	$data['alternate_phone_number'] = $this->get_data( 'alternate_phone_number' );
		//}
	

		//save lrs
		if ( ! $this->Lrs_model->save( $data, $id )) {
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
		//if ( !$id ) {
		//	if ( ! $this->insert_icon_images( $_FILES, 'lrs', $data['id'], "cover" )) {
		//		// if error in saving image
//
		//			// commit the transaction
		//			$this->db->trans_rollback();
		//			
		//			return;
		//		}	
		//}

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
				
				$this->set_flash_msg( 'success', get_msg( 'LRS has been successfully updated' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'LRS has been successfully updated' ));
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
	function delete( $lrs_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_lrs( $lrs_id )) {

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
        	
			$this->set_flash_msg( 'success', get_msg( 'LRS has been successfully deleted' ));
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