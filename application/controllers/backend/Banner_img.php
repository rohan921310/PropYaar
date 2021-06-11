<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Banner_img extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'banner_img_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// get rows count
		$this->data['rows_count'] = $this->Banner_imgs->count_all_by( $conds );
		
		// get conditions
		$this->data['banners'] = $this->Banner_imgs->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Search Banners' );
		
		// condition with search term
		$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
		// no publish filter
		$conds['no_publish_filter'] = 1;
		$conds['order_by'] = 1;
		$conds['order_by_field'] = "id";


		// pagination
		$this->data['rows_count'] = $this->Banner_imgs->count_all_by( $conds );

		// search data
		$this->data['banners'] = $this->Banner_imgs->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Add Banner' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Edit Banner' );

		// load user
		$this->data['banners'] = $this->Banner_imgs->get_one( $id );

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
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
        }

 		// set timezone
         if($id == "") {
			//save
			date_default_timezone_set("Asia/Kolkata");
			$data['added_date'] = date("Y-m-d H:i:s");
			$data['added_user_id'] = $logged_in_user->user_id;
		} else {
			//edit
			unset($data['added_date']);
			date_default_timezone_set("Asia/Kolkata");
			$data['updated_date'] = date("Y-m-d H:i:s");
			$data['updated_user_id'] = $logged_in_user->user_id;
		}
	


		// save category
		if ( ! $this->Banner_imgs->save( $data, $id )) {
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
			if ( ! $this->insert_icon_images( $_FILES, 'banner', $data['id'], "cover" )) {
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
		if ( !$this->ps_delete->delete_banner( $id )) {

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

		$this->form_validation->set_rules( 'name', get_msg( 'Name' ), $rule);

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

		 $conds['name'] = $name;

			
		 	if( $id != "") {
				if ( strtolower( $this->Banner_imgs->get_one( $id )->name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Banner_imgs->exists( ($conds ))) {
					// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				if ( $this->Banner_imgs->exists( ($conds ))) {
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

		$name = $_REQUEST['name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the condition name is valid,
			
			echo "true";
		} else {
		// if invalid condition name,
			
			echo "false";
		}
	}

	

}