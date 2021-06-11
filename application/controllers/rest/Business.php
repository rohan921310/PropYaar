<?php
require_once( APPPATH .'libraries/REST_Controller.php' );

/**
 * REST API for Users
 */
class Business extends API_Controller
{

	/**
	 * Constructs Parent Constructor
	 */
	function __construct()
	{
		parent::__construct( 'Business_modal' );

		//header('Access-Control-Allow-Origin: https://www.riseerealty.com/');
        //header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        //header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        //$method = $_SERVER['REQUEST_METHOD'];
        //if($method == "OPTIONS") {
        //    die();
		//}
		header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST,');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
		}

	}	

	/**
	 * Default Query for API
	 * @return [type] [description]
	 */
	function default_conds()
	{
		$conds = array();

		if ( $this->is_search ) {

			if($this->post('login_user_id') != "") {
				$conds['added_user_id']   = $this->post('login_user_id');
			}
		}

		return $conds;

	}

	/**
	 * Convert Object
	 */
	function convert_object( &$obj )
	{
		// call parent convert object
		parent::convert_object( $obj );

		// convert customize category object
		$this->ps_adapter->convert_business_user( $obj );
	}



    function business_register_post()
	{
		$rules = array(
	        array(
	        	'field' => 'name',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'email',
	        	'rules' => 'required|valid_email|is_unique[core_business_account.email]'
	        ),
			array(
	        	'field' => 'phone',
	        	'rules' => 'required|is_unique[core_business_account.phone]'
			),
			array(
	        	'field' => 'city',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'company_name',
	        	'rules' => 'required'
			),
			array(
	        	'field' => 'password',
	        	'rules' => 'required'
			),
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $data = array(
        	
        	"name" => $this->post('name'), 
        	"email" => $this->post('email'),
            "phone" => $this->post('phone'),
            "city" => $this->post('city'),
            "company_name" => $this->post('company_name'), 
			"password" => md5($this->post('password')), 

        );

        if ( !$this->Business_modal->save($data)) {

        	$this->error_response( get_msg( 'err_user_register' ));

        } else {

            $this->success_response( get_msg( 'Registration Success. Risee Business team will contact You.'));

        }

	}




	
	/**
	 * Users Registration
	 */
	function add_post()
	{
		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email|callback_email_check'
	        ),
	        array(
	        	'field' => 'user_password',
	        	'rules' => 'required'
	        )

        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $code = generate_random_string(5);

        $user_data = array(
        	
        	"user_name" => $this->post('user_name'), 
        	"user_email" => $this->post('user_email'), 
        	'user_password' => md5($this->post('user_password')),
        	"device_token" => $this->post('device_token'),
        	"code" =>  $code,
        	"email_verify" => 1,
        	"status" => 2 //Need to verified status

        );

        $conds['user_email'] = $user_data['user_email'];
        $conds['status'] = 2;
       	$user_infos = $this->User->user_exists($conds)->result();

       	if (empty($user_infos)) {

       		if ( !$this->User->save($user_data)) {

        	$this->error_response( get_msg( 'err_user_register' ));

        	} else {

        	$noti_data = array(

					"user_id" => $user_data['user_id'],
					"device_token" => $user_data['device_token']
				);

	        	if ( $this->Noti->exists( $noti_data )) {
		        // if the noti data is already existed, return success
		        	$this->success_response( get_msg( 'token_already_exist '));
		        } else {
		        	$this->Noti->save( $noti_data, $push_noti_token_id );
		        }


	        	$subject = get_msg('user_acc_reg_label');
				

	        	if ( !send_user_register_email( $user_data['user_id'], $subject )) {

					$this->error_response( get_msg( 'user_register_success_but_email_not_send' ));
				
				} 
        	}

       	} else {

       		//$this->error_response( get_msg( 'need_to_verify' ));
       		$user_id = $user_infos[0]->user_id;
       		$subject = get_msg('user_acc_reg_label');

       		if ( !send_user_register_email( $user_id, $subject )) {

					$this->error_response( get_msg( 'user_register_success_but_email_not_send' ));
				
				} 

       		$this->custom_response($this->User->get_one($user_id));

       	}

        
        $this->custom_response($this->User->get_one($user_data["user_id"]));

	}


	/**
	 * Email Checking
	 *
	 * @param      <type>  $email     The identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	function email_check( $email )
    {
        if ( $this->User->exists( array( 'user_email' => $email, 'status' => 1 ))) {
        	
            $this->form_validation->set_message('email_check', 'Email Exist');
            return false;
        } 

        return true;
    }

    /**
	 * Users Login
	 */
    /**
	 * Users Login
	 */
	function login_post()
	{

		// validation rules for user register
		$rules = array(
	        array(
	        	'field' => 'email',
	        	'rules' => 'required|valid_email'
	        ),
	        array(
	        	'field' => 'password',
	        	'rules' => 'required'
			),
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

		$data = array(
        	"email" => $this->post('email'),
			"password" => md5($this->post('password')), 
        );
        
		// checking the email and password 
        if ( $this->Business_modal->login_action($data) !== false) {

		    $verified_data = array(
            	"email" => $this->post('email'),
		    	"password" => md5($this->post('password')),
				"is_verified" => 1, 
            );
			$business_user = $this->Business_modal->login_action($verified_data);		
		    // checking account is verified or not  
			if($business_user->is_verified === '1'){
				//$this->success_response( get_msg( 'Login Success.'));
				$this->custom_response($this->Business_modal->get_one($business_user->user_id));
			}else{
				$this->error_response( get_msg( 'Sorry Your account is not verified. Risee Business team will contact You.' ));
			}
			
        }else{
        	$this->error_response( get_msg( 'Invalid email and password.' ));
        	//$this->error_response( get_msg( 'err_user_not_exist' ));

        }

	}

	/**
	* User Reset Password
	*/
	function reset_post()
	{
		// validation rules for user register
		$rules = array(
	        array(
	        	'field' => 'user_email',
	        	'rules' => 'required|valid_email'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $user_info = $this->User->get_one_by( array( "user_email" => $this->post( 'user_email' )));

        if ( isset( $user_info->is_empty_object )) {
        // if user info is empty,
        	
        	$this->error_response( get_msg( 'err_user_not_exist' ));
        }

        // generate code
        $code = md5(time().'teamps');

        // insert to reset
        $data = array(
			'user_id' => $user_info->user_id,
			'code' => $code
		);

		if ( !$this->ResetCode->save( $data )) {
		// if error in inserting,

			$this->error_response( get_msg( 'err_model' ));
		}

		// Send email with reset code
		$to = $user_info->user_email;
	    $subject = get_msg( 'pwd_reset_label' );
		$hi = get_msg( 'hi_label' );
		$msg = "<p>".$hi.",". $user_info->user_name ."</p>".
					"<p>".get_msg( 'pwd_reset_link' )."<br/>".
					"<a href='". site_url( $this->config->item( 'reset_url') .'/'. $code ) ."'>".get_msg( 'reset_link_label' )."</a></p>".
					"<p>".get_msg( 'best_regards_label' ).",<br/>". $sender_name ."</p>";
		// send email from admin
		if ( ! $this->ps_mail->send_from_admin( $to, $subject, $msg ) ) {

			$this->error_response( get_msg( 'err_email_not_send' ));
		}
		
		$this->success_response( get_msg( 'success_email_sent' ));
	}

	/**
	* User Profile Update
	*/

	function profile_update_post()
	{

		// validation rules for user register
		$rules = array(
			array(
	        	'field' => 'user_id',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_name',
	        	'rules' => 'required'
	        ),
	        array(
	        	'field' => 'user_email',
	        	// 'rules' => 'required|valid_email'
	        ),
	        array(
	        	'field' => 'user_phone',
	        	'rules' => 'required'
	        ),
			array(
	        	'field' => 'user_whatsapp_number',
	        ),
	        array(
	        	'field' => 'user_about_me',
	        	// 'rules' => 'required'
			),
			array(
	        	'field' => 'listing_by',
	        	// 'rules' => 'required'
	        )
        );

		// exit if there is an error in validation,
        if ( !$this->is_valid( $rules )) exit;

        $user_id = $this->post('user_id');
        // user email checking
        $user_email = $this->User->get_one($user_id)->user_email;
        if ($user_email == $this->post('user_email')) {
        	$email = $this->post('user_email');
        } else {
        	$conds['user_email'] = $this->post('user_email');
        	$conds['status'] = 1;
       		$user_infos = $this->User->user_exists($conds)->result();
        	if (empty($user_infos)) {
        		$email = $this->post( 'user_email' );
        	} else {
        		
		    	$this->error_response( get_msg( 'err_user_email_exist' ));
		    }
		 
        }

        // user phone checking
        $user_phone = $this->User->get_one($user_id)->user_phone;
        if ($user_phone == $this->post('user_phone')) {
        	$phone = $this->post('user_phone');
        } else {
        	$conds['user_phone'] = $this->post('user_phone');
        	$conds['status'] = 1;
       		$user_infos = $this->User->get_one_user_phone($conds)->result();
        	if (empty($user_infos)) {
        		$phone = $this->post( 'user_phone' );
        	} else {
        		
		    	$this->error_response( get_msg( 'err_user_phone_exist' ));
		    }
		 
        }

        $user_data = array(
        	"user_name"     => $this->post('user_name'), 
        	"user_email"    => $this->post('user_email'), 
			"user_phone"    => $this->post('user_phone'),
        	"user_whatsapp_number" => $this->post('user_whatsapp_number'),
        	"user_address"  => $this->post('user_address'),
        	"city"			=> $this->post('city'),
        	"user_about_me" => $this->post('user_about_me'),
			"device_token"  => $this->post('device_token'),
			"listing_by"    => $this->post('listing_by')
        );
        // print_r($user_data);die;

        if ( !$this->User->save($user_data, $this->post('user_id'))) {

        	$this->error_response( get_msg( 'err_user_update' ));
        }

        $this->success_response( get_msg( 'success_profile_update' ));

	}



}