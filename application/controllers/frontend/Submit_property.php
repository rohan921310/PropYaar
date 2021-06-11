<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Front End Controller
 */
class Submit_property extends FE_Controller 
{

	/**
	 * constructs required variables
	 */
	function __construct()
	{
		parent::__construct( NO_AUTH_CONTROL, 'SUBMIT_PROPERTY' );

	}

	/**
	 * Home Page
	 */
	// function privacy_policy()
	// {
	// 	$content = $this->Privacy_policy->get_one('privacy1')->content;
	// 	$this->data['content'] = $content;
	// 	$this->load_template( 'frontend/home' );
	// }
	public function index()
	{
	   $data['view_page'] = 'frontend/submit_property';
       $this->load->view('frontend/partials/index',$data);
	}

	public function properties_grid_fullwidth()
	{
		$this->load->view('frontend/properties-grid-fullwidth');
	}
	
}