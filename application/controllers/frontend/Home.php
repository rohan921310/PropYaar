<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
/**
 * Front End Controller
 */
class Home extends FE_Controller 
{

	/**
	 * constructs required variables
	 */
	function __construct()
	{
	    //die("front");
		parent::__construct( NO_AUTH_CONTROL, 'HOME' );

        $this->load->helper('front_helper');

	}

	function index(){
        $data['view_page'] = 'frontend/submit_property';
        $this->load->view('frontend/partials/index',$data);
    }

    public function submit_property()
    {
        //$data['view_page'] = 'frontend/submit_property';
        //$this->load->view('frontend/partials/index',$data);

        $this->data['view_page'] = 'frontend/submit_property';
        $this->load_template('dashboard/dashboard');
        //$this->load_template('submit_property');
    }

    public function dashboard()
    {
        //$data['view_page'] = 'frontend/submit_property';
        //$this->load->view('frontend/partials/index',$data);

        $this->data['view_page'] = 'frontend/dashboard';
        $this->load_template('dashboard/dashboard');
        //$this->load_template('submit_property');
    }

    public function myprofile()
    {
        $this->data['view_page'] = 'frontend/my-profile';
        $this->load_template('dashboard/dashboard');
    }

    public function myproperties()
    {
        $this->data['view_page'] = 'frontend/my-properties';
        $this->load_template('dashboard/dashboard');
    }

    public function favorited_properties()
    {
        $this->data['view_page'] = 'frontend/favorited-properties';
        $this->load_template('dashboard/dashboard');
    }

    public function messages()
    {
        $this->data['view_page'] = 'frontend/messages';
        $this->load_template('dashboard/dashboard');
    }

    public function bookings()
    {
        $this->data['view_page'] = 'frontend/bookings';
        $this->load_template('dashboard/dashboard');
    }

    public function myinvoices()
    {
        $this->data['view_page'] = 'frontend/my-invoices';
        $this->load_template('dashboard/dashboard');
    }


    public function total_items(){

        $limit = $this->input->post('limit');

        $offset = $this->input->post('offset');

        /* Init cURL resource */
        $ch = curl_init();
        
        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_URL, base_url().'index.php/rest/items/get/api_key/rappikey/limit/'.$limit.'/offset/'.$offset.'/');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 

         /* set the content type json */
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        // return the transfer as a string, also with setopt()
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        /* execute request */
        $result = curl_exec($ch);

        echo  $result;
                 
        /* close cURL resource */
        curl_close($ch);
    }
    

    public function properties()
    {
         $this->data['view_page'] = 'frontend/properties';
         $this->load_template('partials/index');
    }


    public function services(){

        //$this->load_template('services');
        $this->data['view_page'] = 'frontend/services';
        $this->load_template('partials/index');
    }

    public function new_services(){
        die("services");
        $this->load_template('services');
    }

    public function terms_and_conditions()
    {

        //echo 'page';

         //get_page('terms_and_conditions');
        //die("private policy");
        //$data['view_page'] = 'frontend/terms_and_conditions';
        //$this->load->view('frontend/partials/index',$data);

        //$this->data['view_page'] = 'frontend/terms_and_conditions';
        //$this->load_template('partials/index');

        $this->load_template('terms_and_conditions');
    }

    public function faq(){
        //$this->load_template('faq');blog-columns-3col
        $this->data['view_page'] = 'frontend/faq';
        $this->load_template('partials/index');
    }

    public function blog(){
        $this->data['view_page'] = 'frontend/blogs';
        $this->load_template('partials/index');
    }

    public function aboutus(){
        $this->data['view_page'] = 'frontend/about';
        $this->load_template('partials/index');
    }

    public function contactus(){
        $this->data['view_page'] = 'frontend/contact';
        $this->load_template('partials/index');
    }

    public function submit_contact(){
    
        /* API URL */
         $url = base_url().'rest/contacts/add/api_key/rappikey';

         /* Init cURL resource */
         $ch = curl_init($url);
        
         /* Array Parameter Data */
         $data = ['contact_name'   =>  $this->input->post('name'),
                  'contact_email'  =>  $this->input->post('email'),
                  'contact_phone'  =>  $this->input->post('number'),
                  'contact_message'=>  $this->input->post('message')
                 ];
         $data = json_encode($data);

         /* pass encoded JSON string to the POST fields */
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                 
         /* set the content type json */
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                 
         /* set return type json */
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 
         /* execute request */
         $result = curl_exec($ch);
                  
         /* close cURL resource */
         curl_close($ch);

         echo  $result;
    }

    public function lrs_form(){
        $this->data['view_page'] = 'frontend/lrs_post';
        $this->load_template('partials/index');
    }


    public function submit_lrs_post(){

        /* API URL */
         $url = base_url().'rest/lrs/add/api_key/rappikey';

         /* Init cURL resource */
         $ch = curl_init($url);
   
         $file_tmp = $_FILES['lrs_img']['tmp_name'];

         
         $lrs_image = base64_encode(file_get_contents($file_tmp));

               
         /* Array Parameter Data */
         $data = ['name'   =>  $this->input->post('name'),
                  'email'  =>  $this->input->post('email'),
                  'phone'  =>  $this->input->post('phone'),
                  'property_location'=>  $this->input->post('property_location'),
                  'property_type'=>  $this->input->post('property_type'),
                  'lrs_img'=>  $lrs_image,
                 ];
         $data = json_encode($data);

         /* pass encoded JSON string to the POST fields */
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                 
         /* set the content type json */
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                 
         /* set return type json */
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 
         /* execute request */
         $result = curl_exec($ch);
                  
         /* close cURL resource */
         curl_close($ch);

         echo  $result;
    }

    public function arvr_form(){
        $this->data['view_page'] = 'frontend/arvr_post';
        $this->load_template('partials/index');
    }

    public function submit_arvr_post(){

        /* API URL */
         $url = base_url().'rest/ar_vr/add/api_key/rappikey';

         /* Init cURL resource */
         $ch = curl_init($url);
   
         $file_tmp = $_FILES['arvr_img']['tmp_name'];

         
         $lrs_image =trim(base64_encode(file_get_contents($file_tmp))) ;

               
         /* Array Parameter Data */
         $data = ['name'   =>  $this->input->post('name'),
                  'email'  =>  $this->input->post('email'),
                  'phone'  =>  $this->input->post('phone'),
                  'property_location'=>  $this->input->post('property_location'),
                  'arvr_img'=>  $lrs_image,
                 ];
         $data = json_encode($data);

         /* pass encoded JSON string to the POST fields */
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                 
         /* set the content type json */
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                 
         /* set return type json */
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                 
         /* execute request */
         $result = curl_exec($ch);
                  
         /* close cURL resource */
         curl_close($ch);

         echo  $result;
    }

	

	/**
	 * Home Page
	 */
	function privacy_policy()
	{


	}
}