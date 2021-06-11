<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users crontroller for BE_USERS table
 */
class Payrents extends BE_Controller {

	/**
	 * Constructs required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'payrent_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Payrent->count_all_by( $conds );

		$this->data['payrents'] = $this->Payrent->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

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
		$this->data['rows_count'] = $this->Payrent->count_all_by( $conds );

		// search data

		$this->data['payrents'] = $this->Payrent->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
        
		// load add list
		parent::search();
	}


}