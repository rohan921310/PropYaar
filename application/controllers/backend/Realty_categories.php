<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users crontroller for BE_USERS table
 */
class Realty_categories extends BE_Controller {

	/**
	 * Constructs required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'realty_categories_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Realty_category->count_all_by( $conds );

		$this->data['realty_category'] = $this->Realty_category->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

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
		$this->data['rows_count'] = $this->Realty_category->count_all_by( $conds );

		// search data

		$this->data['realty_category'] = $this->Realty_category->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
        
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
		$this->data['category'] = $this->Realty_category->get_one( $id );

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
		
		/** 
		 * Insert Category Records 
		 */
		$data = array();

		// prepare cat name
		if ( $this->has_data( 'group_name' )) {
			$data['group_name'] = $this->get_data( 'group_name' );
		}

		// if 'is_visible' is checked,
		if ( $this->has_data( 'is_visible' )) {
			$data['is_visible'] = 1;
		} else {
			$data['is_visible'] = 0;
		}

		if ( $this->has_data( 'is_new' )) {
			$data['is_new'] = 1;
		} else {
			$data['is_new'] = 0;
		}

		if ( $this->has_data( 'is_comingsoon' )) {
			$data['is_comingsoon'] = 1;
		} else {
			$data['is_comingsoon'] = 0;
		}


		// save category
		if ( ! $this->Realty_category->save( $data, $id )) {
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
			if ( ! $this->insert_icon_images( $_FILES, 'category', $data['cat_id'], "cover" )) {
				// if error in saving image

					// commit the transaction
					$this->db->trans_rollback();
					
					return;
				}
			if ( ! $this->insert_icon_images( $_FILES, 'category-icon', $data['cat_id'], "icon" )) {
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
				
				$this->set_flash_msg( 'success', get_msg( 'success_cat_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_cat_add' ));
			}
		}

		redirect( $this->module_site_url());
	}



	/**
	 * Delete the record
	 * 1) delete category
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $category_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );
		
		// delete categories and images
		if ( !$this->ps_delete->delete_realty_category($category_id )) {

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
        	
			$this->set_flash_msg( 'success', get_msg( 'success_cat_delete' ));
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

		$this->form_validation->set_rules( 'group_name', get_msg( 'group_name' ), $rule);

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
	function is_valid_name( $name, $cat_id = 0 )
	{		

		 $conds['group_name'] = $name;

			
		 	if( $cat_id != "") {
		 		// echo "bbbb";die;
				if ( strtolower( $this->Realty_category->get_one( $id )->group_name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} 
			} else {
				// echo "aaaa";die;
				if ( $this->Realty_category->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			}
			return true;
	}

	/**
	 * Check category name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $cat_id = false )
	{
		// get category name

		$name = $_REQUEST['group_name'];

		if ( $this->is_valid_name( $name, $cat_id )) {

		// if the category name is valid,
			
			echo "true";
		} else {
		// if invalid category name,
			
			echo "false";
		}
	}

	/**
	 * Publish the record
	 *
	 * @param      integer  $category_id  The category identifier
	 */
	function ajx_publish( $category_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$category_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Realty_category->save( $category_data, $category_id )) {
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
	function ajx_unpublish( $category_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$category_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Realty_category->save( $category_data, $category_id )) {
			echo 'true';
		} else {
			echo 'false';
		}
	}


}