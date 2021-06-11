<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Requirements extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'requirements_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Requirement->count_all_by( $conds );
		
		// get conditions
		$this->data['requirements'] = $this->Requirement->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
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
		if ( !$this->ps_delete->delete_requirements( $id )) {

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

	


	

}