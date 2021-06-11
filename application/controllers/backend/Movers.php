<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item_conditions Controller
 */
class Movers extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'movers_module' );
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// get rows count
		$this->data['rows_count'] = $this->Movers_model->count_all_by( $conds );
		
		// get conditions
		$this->data['movers'] = $this->Movers_model->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );
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
		$this->data['rows_count'] = $this->Movers_model->count_all_by( $conds );

		// search data
		$this->data['movers'] = $this->Movers_model->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Add Movers' );

		// call the core add logic
		parent::add();
	}

	/**
	 * Update the existing one
	 */
	function edit( $id ) {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'Edit Movers' );

		// load user
		$this->data['movers'] = $this->Movers_model->get_one( $id );

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

		// Agents name
		if ( $this->has_data( 'mv_name' )) {
			$data['mv_name'] = $this->get_data( 'mv_name' );
        }
        
        // Agents phone number
		if ( $this->has_data( 'mv_phone_number' )) {
			$data['mv_phone_number'] = $this->get_data( 'mv_phone_number' );
        }
        
        // Agents location
		if ( $this->has_data( 'mv_location' )) {
			$data['mv_location'] = $this->get_data( 'mv_location' );
        }
        
        // Agents info
		if ( $this->has_data( 'mv_info' )) {
			$data['mv_info'] = $this->get_data( 'mv_info' );
        }
        
        // Agents rating
		if ( $this->has_data( 'mv_rating' )) {
			$data['mv_rating'] = $this->get_data( 'mv_rating' );
		}
		
		if ( $this->has_data( 'from_city' )) {
			$data['from_city'] = $this->get_data( 'from_city' );
		}
		
		if ( $this->has_data( 'to_city' )) {
			$data['to_city'] = $this->get_data( 'to_city' );
		}
		
		if ( $this->has_data( 'from_address' )) {
			$data['from_address'] = $this->get_data( 'from_address' );
		}
		
		if ( $this->has_data( 'to_address' )) {
			$data['to_address'] = $this->get_data( 'to_address' );
		}
		
		if ( $this->has_data( 'from_floor_no' )) {
			$data['from_floor_no'] = $this->get_data( 'from_floor_no' );
		}
		
		if ( $this->has_data( 'to_floor_no' )) {
			$data['to_floor_no'] = $this->get_data( 'to_floor_no' );
		}
		
		if ( $this->has_data( 'home_size' )) {
			$data['home_size'] = $this->get_data( 'home_size' );
		}

		if ( $this->has_data( 'date_to_shift' )) {
			$data['date_to_shift'] = $this->get_data( 'date_to_shift' );
		}

		if ( $this->has_data( 'shipping_details' )) {
			$data['shipping_details'] = $this->get_data( 'shipping_details' );
		}

		if ( $this->has_data( 'listed_user_id' )) {
			$data['listed_user_id'] = $this->get_data( 'listed_user_id' );
		}

		$data['user_id'] = $logged_in_user->user_id;


        
        // if 'is_open' is checked,
		if ( $this->has_data( 'is_open' )) {
			$data['is_open'] = 1;
		} else {
			$data['is_open'] = 0;
        }
        
        // if 'is_like' is checked,
		if ( $this->has_data( 'is_like' )) {
			$data['is_like'] = 1;
		} else {
			$data['is_like'] = 0;
		}



		// save category
		if ( ! $this->Movers_model->save( $data, $id )) {
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
		if ( !$this->ps_delete->delete_movers( $id )) {

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

		$this->form_validation->set_rules( 'mv_name', get_msg( 'mv_name' ), $rule);

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

		 $conds['mv_name'] = $name;

			
		 	if( $id != "") {
				if ( strtolower( $this->Movers_model->get_one( $id )->mv_name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} else if ( $this->Movers_model->exists( ($conds ))) {
					// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			} else {
				if ( $this->Movers_model->exists( ($conds ))) {
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

		$name = $_REQUEST['mv_name'];

		if ( $this->is_valid_name( $name, $id )) {

		// if the condition name is valid,
			
			echo "true";
		} else {
		// if invalid condition name,
			
			echo "false";
		}
	}

	

}