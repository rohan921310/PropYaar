<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

/**
 * Front End Controller
 */
class Home extends CI_Controller 
{

	/**
	 * constructs required variables
	 */
	// function __construct()
	// {
	// 	parent::__construct( NO_AUTH_CONTROL, 'HOME' );

	// }

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
		$data['view_page'] = 'frontend/home';
       $this->load->view('frontend/partials/index',$data);
	}
	public function SubmitProperty()
	{
	   $data['view_page'] = 'frontend/submit_property';
       $this->load->view('frontend/partials/index',$data);
	}
	public function terms_and_conditions()
	{
	   $data['view_page'] = 'frontend/terms_and_conditions';
       $this->load->view('frontend/partials/index',$data);
	}
}