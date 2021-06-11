<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * blogs Controller
 */
class Videos extends BE_Controller {

	/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'video_module' );
		$this->load->model('csv_import_model');
		$this->load->library('csvimport');
	}

	/**
	 * List down the registered users
	 */
	function index() {
		
		// no delete flag
		// no publish filter
		$conds['no_publish_filter'] = 1;

		// get rows count
		$this->data['rows_count'] = $this->Video->count_all_by( $conds );

		// get videos
		$this->data['videos'] = $this->Video->get_all_by( $conds , $this->pag['per_page'], $this->uri->segment( 4 ) );

		// load index logic
		parent::index();
	}

	/**
	 * Searches for the first match.
	 */
	function search() {
		

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'blog_search' );
		
		// condition with search term
		$conds = array( 'searchterm' => $this->searchterm_handler( $this->input->post( 'searchterm' )) );
		// no publish filter
		$conds['no_publish_filter'] = 1;

		// pagination
		$this->data['rows_count'] = $this->Video->count_all_by( $conds );

		// search data

		$this->data['videos'] = $this->Video->get_all_by( $conds, $this->pag['per_page'], $this->uri->segment( 4 ) );
		
		// load add list
		parent::search();
	}

	/**
	 * Create new one
	 */
	function add() {

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'blog_add' );

		// call the core add logic
		parent::add();
	}

	
	/**
	 * Saving Logic
	 * 1) upload image
	 * 2) save blog
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
		 * Insert blog Records 
		 */
		$data = array();

		// prepare blog title
		if ( $this->has_data( 'name' )) {
			$data['name'] = $this->get_data( 'name' );
		}
		

		// prepare blog description
		if ( $this->has_data( 'description' )) {
			$data['description'] = $this->get_data( 'description' );
		}

		// prepare blog url
		if ( $this->has_data( 'video_link' )) {
			$data['video_link'] = $this->get_data( 'video_link' );
		}

		
		$data['status'] = 1;
		
		// set timezone
		$data['added_user_id'] = $logged_in_user->user_id;

		if($id == "") {
			//save
			$data['added_date'] = date("Y-m-d H:i:s");
		} else {
			//edit
			unset($data['added_date']);
			$data['updated_date'] = date("Y-m-d H:i:s");
			$data['updated_user_id'] = $logged_in_user->user_id;
		}

		//save category
		if ( ! $this->Video->save( $data, $id )) {
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
				
				$this->set_flash_msg( 'success', get_msg( 'success_blog_edit' ));
			} else {
			// if user id is false, show success_edit message

				$this->set_flash_msg( 'success', get_msg( 'success_blog_add' ));
			}
		}
	
		//get inserted product id
		$id = ( !$id )? $data['id']: $id ;
		
		if ( $this->has_data( 'gallery' )) {

		// if there is gallery, redirecti to gallery
			redirect( $this->module_site_url( 'gallery/' .$id ));
		}
		else {
		// redirect to list view
			redirect( $this->module_site_url() );
		}
	}

	/**
	 * Show Gallery
	 *
	 * @param      <type>  $id     The identifier
	 */
	function gallery( $id ) {
		// breadcrumb urls
		$edit_blog = get_msg('blog_edit');

		$this->data['action_title'] = array( 
			array( 'url' => 'edit/'. $id, 'label' => $edit_blog ), 
			array( 'label' => get_msg( 'blog_gallery' ))
		);
		
		$_SESSION['parent_id'] = $id;
		$_SESSION['type'] = 'blog';
    	    	
    	$this->load_gallery();
    }

	/**
 	* Update the existing one
	*/
	function edit( $id ) 
	{

		// breadcrumb urls
		$this->data['action_title'] = get_msg( 'blog_edit' );

		// load user
		$this->data['blog'] = $this->Video->get_one( $id );

		// call the parent edit logic
		parent::edit( $id );

	}

	/**
	 * Determines if valid input.
	 *
	 * @return     boolean  True if valid input, False otherwise.
	 */
	function is_valid_input( $id = 0 ) 
	{
		
		$rule = 'required|callback_is_valid_name['. $id  .']';

		$this->form_validation->set_rules( 'name', get_msg( 'title' ), $rule);
		
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
				if ( strtolower( $this->Video->get_one( $id )->name ) == strtolower( $name )) {
				// if the name is existing name for that user id,
					return true;
				} 
			} else {
				if ( $this->Video->exists( ($conds ))) {
				// if the name is existed in the system,
					$this->form_validation->set_message('is_valid_name', get_msg( 'err_dup_name' ));
					return false;
				}
			}
			return true;
	}


	/**
	 * Delete the record
	 * 1) delete blog
	 * 2) delete image from folder and table
	 * 3) check transactions
	 */
	function delete( $blog_id ) {

		// start the transaction
		$this->db->trans_start();

		// check access
		$this->check_access( DEL );

		// delete categories and images
		$enable_trigger = true; 
		
		// delete categories and images
		if ( !$this->ps_delete->delete_feed( $blog_id, $enable_trigger )) {

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
        	
			$this->set_flash_msg( 'success', get_msg( 'success_blog_delete' ));
		}
		
		redirect( $this->module_site_url());
	}


	/**
	 * Check blog name via ajax
	 *
	 * @param      boolean  $cat_id  The cat identifier
	 */
	function ajx_exists( $id = false )
	{
		// get blog name
		$name = $_REQUEST['name'];
		if ( $this->is_valid_name( $name, $id )) {
		// if the blog name is valid,
			echo "true";
		} else {
		// if invalid blog name,
			
			echo "false";
		}
	}

	/**
	 * Publish the record
	 *
	 * @param      integer  $feed_id  The blog identifier
	 */
	function ajx_publish( $feed_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$feed_data = array( 'status'=> 1 );
			
		// save data
		if ( $this->Feed->save( $feed_data, $feed_id )) {
			echo true;
		} else {
			echo false;
		}
	}
	
	/**
	 * Unpublish the records
	 *
	 * @param      integer  $feed_id  The category identifier
	 */
	function ajx_unpublish( $feed_id = 0 )
	{
		// check access
		$this->check_access( PUBLISH );
		
		// prepare data
		$feed_data = array( 'status'=> 0 );
			
		// save data
		if ( $this->Feed->save( $feed_data, $feed_id )) {
			echo true;
		} else {
			echo false;
		}
	}

	function RandomStringimgid($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++) {
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'vid'.$key;
	}

	function RandomString($length) {
	    $keys = array_merge(range(0,9), range('a', 'z'));
	    $key = "";
	    for($i=0; $i < $length; $i++){
	        $key .= $keys[mt_rand(0, count($keys) - 1)];
	    }
	    return 'video'.$key;
	}

		// bulk upload items
		function import()
		{
			if($_FILES["csv_file"]["name"] != '')
			{
	
				$random_id = $this->RandomString(25);
	
				$config['upload_path'] = './uploads/';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				for($count = 0; $count<count($_FILES["csv_file"]["name"]); $count++)
				{
	
					$img_id =$this->RandomStringimgid(24);
					
					$extence= explode('.',$_FILES["csv_file"]["name"][$count]);
					$extention=strtolower(end($extence));
					$extention_array=array('gif','jpeg','jpg','png');
					if(in_array($extention,$extention_array) )
					{
						$_FILES["file"]["name"] = $_FILES["csv_file"]["name"][$count];
						$_FILES["file"]["type"] = $_FILES["csv_file"]["type"][$count];
						$_FILES["file"]["tmp_name"] = $_FILES["csv_file"]["tmp_name"][$count];
						$_FILES["file"]["error"] = $_FILES["csv_file"]["error"][$count];
						$_FILES["file"]["size"] = $_FILES["csv_file"]["size"][$count];
						$this->upload->do_upload('file');
						$image_data[] = array(
							'img_id' => $img_id,
							'img_parent_id'=> $random_id,
							'img_type'=>'video',
							'img_path'=>$this->upload->data('file_name'),
							'img_width'=>$this->upload->data('image_width'),
							'img_height'=>$this->upload->data('image_height')
						);
	
					}
					else{
						$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"][$count]);
						foreach($file_data as $row)
						{
							$data[] = array(
								'id' => $random_id, 
								'name' => $row['name'],
								'description' => $row['description'],
								'added_user_id' => 'c4ca4238a0b923820dcc509a6f75849b',
								'updated_user_id' => 'c4ca4238a0b923820dcc509a6f75849b',
								'status' => 1,
								'video_link' => $row['url'],
								'added_date' => date("Y-m-d H:i:s"),
								'updated_date' => date("Y-m-d H:i:s")
							);
							// echo "<pre>",print_r($data);die;
						}
					}
	
	
				}
				$this->csv_import_model->insert_video($data);
				$this->csv_import_model->insert_images($image_data);
	
				echo '1';
	
			}
	
		}

	 

}