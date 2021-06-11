<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Users_share_property extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'users_share_property_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		//$conds = array('is_shares_property' => 1);

		// get rows count
		$this->data['rows_count'] = $this->Users_share_properties->count_all_by( $conds );
		
		// get conditions
		$this->data['users_share_properties'] = $this->Users_share_properties->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'cond_search' );
		
	//	// condition with search term
	//	$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
	//	// no publish filter
	//	$conds['no_publish_filter'] = 1;
	//	$conds['order_by'] = 1;
	//	$conds['order_by_field'] = "id";
	//	$conds['order_by_type'] = "desc";


		// pagination
		$this->data['rows_count'] = $this->Users_share_properties->count_all_by( $conds );

		// search data
		$this->data['users_share_properties'] = $this->Users_share_properties->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Add Users Share Properties' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Edit Users Share Properties' );

		// load user
		$this->data['users_share_properties'] = $this->Users_share_properties->get_one( $id );

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

		if ( $this->has_data( 'property_name' )) {
			$data['property_name'] = $this->get_data( 'property_name' );
        }
        
		if ( $this->has_data( 'item_id' )) {
			$data['item_id'] = $this->get_data( 'item_id' );
		}
		
		if ( $this->has_data( 'no_users' )) {
			$data['no_users'] = $this->get_data( 'no_users' );
		}
		
		if ( $this->has_data( 'price' )) {
			$data['price'] = $this->get_data( 'price' );
		}
		
		if ( $this->has_data( 'per_annual_return' )) {
			$data['per_annual_return'] = $this->get_data( 'per_annual_return' );
		}
		
		if ( $this->has_data( 'no_investors' )) {
			$data['no_investors'] = $this->get_data( 'no_investors' );
		}
		
		if ( $this->has_data( 'no_waitlist' )) {
			$data['no_waitlist'] = $this->get_data( 'no_waitlist' );
		}
		
		if ( $this->has_data( 'financed_amount' )) {
			$data['financed_amount'] = $this->get_data( 'financed_amount' );
		}
		
		if ( $this->has_data( 'purchase_price' )) {
			$data['purchase_price'] = $this->get_data( 'purchase_price' );
		}
		
		if ( $this->has_data( 'raised_amount' )) {
			$data['raised_amount'] = $this->get_data( 'raised_amount' );
		}
		
		// if 'is_live' is checked,
		if ( $this->has_data( 'is_live' )) {
			$data['is_live'] = 1;
		} else {
			$data['is_live'] = 0;
		}

		// if 'is_funded' is checked,
		if ( $this->has_data( 'is_funded' )) {
			$data['is_funded'] = 1;
		} else {
			$data['is_funded'] = 0;
		}


		// save category
		if ( ! $this->Users_share_properties->save( $data, $id )) {
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
		if ( !$this->ps_delete->delete_users_share_property( $id )) {

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

	//get item id
	function get_item_id()
	{
		if ( $this->input->post('property_title')) {
			$title = $this->input->post('property_title');
			$itemid = $this->Users_share_properties->item_id($title);
			echo json_encode($itemid);
		}
	}

	
	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) {
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'property_name', get_msg( 'property_name' ), $rule);

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

		 $conds['property_name'] = $name;

			
		 	if( $id != "") {
				if ( strtolower( $this->Users_share_properties->get_one( $id )->property_name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Users_share_properties->exists( ($conds ))) {
					// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				if ( $this->Users_share_properties->exists( ($conds ))) {
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

		$name = $_REQUEST['property_name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the condition name is valid,
			
			echo "true";
		} else {
		// if invalid condition name,
			
			echo "false";
		}
	}

	

}