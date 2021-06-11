<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users crontroller for BE_USERS table
 */
class Searches extends BE_Controller {

	/**
	 * Constructs required variables
	 */
	function __construct() {
		parent::__construct( MODULE_CONTROL, 'search_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {

		// get rows count
		$this->data['rows_count'] = $this->Search->count_all_by( $conds );

		$this->data['save_search'] = $this->Search->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load index logic
		parent::index();
	}


}