<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PanaceaSoft Authentication
 */
class PS_Adapter {

	// codeigniter instance
	protected $CI;

	// login user
	protected $login_user_id;

	/**
	 * Constructor
	 */
	function __construct()
	{
		// get CI instance
		$this->CI =& get_instance();
	}

	/**
	 * Sets the login user.
	 */
	function set_login_user_id( $user_id )
	{
		$this->login_user_id = $user_id;
	}
	
	/**
	 * Gets the default photo.
	 *
	 * @param      <type>  $id     The identifier
	 * @param      <type>  $type   The type
	 */
	function get_default_photo( $id, $type )
	{
		$default_photo = "";

		// get all images
		$img = $this->CI->Image->get_all_by( array( 'img_parent_id' => $id, 'img_type' => $type ))->result();

		if ( count( $img ) > 0 ) {
		// if there are images for wallpaper,
			
			$default_photo = $img[0];
		} else {
		// if no image, return empty object

			$default_photo = $this->CI->Image->get_empty_object();
		}

		return $default_photo;
	}


	/**
	 * Customize wallpaper object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_image( &$obj )
	{

	}


	/**
	 * Customize Price format
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_price( $price_items )
	{
		$price_digit_count = mb_strlen($price_items);

        if($price_digit_count == 6 ||$price_digit_count == 7){
			$item_price_change = number_format($price_items/100000,2);
			$ext = "Lac";
			$items_price = $item_price_change/1.00.' '.$ext;
		}elseif($price_digit_count == 8 ||$price_digit_count == 9){
			$item_price_change = number_format($price_items/10000000,2);
			$ext = "Cr";
			$items_price = $item_price_change/1.00.' '.$ext;
		}else{
			$items_price = number_format($price_items);
		}
		return $items_price;
	}


			/**	
	 * convert poted time	
	 *	
	 * @param      <type>  $obj    The object	
	 */	
	function convert_posted_time( $posted_time )	
	{	
		date_default_timezone_set("Asia/Kolkata");	
 	
        $current_time =  date_create(date("Y-m-d H:i:s"));	
		$time_posted = date_create($posted_time);	
		$etime =  date_diff($current_time, $time_posted);	
		//return $etime;	
		if($etime->y > 0){	
			if($etime->y == 1){	
				return $etime->y. " Year ago";	
			}else{	
				return $etime->y. " Years ago";	
			}  	
		}	
		elseif($etime->m > 0){ 	
			if($etime->m == 1){	
				return $etime->m. " Month ago";	
			}else{	
				return $etime->m. " Months ago";	
			}  	
		}	
		elseif($etime->d > 0){	
			if($etime->d == 1){	
				return $etime->d. " Day ago";	
			}else{	
				if($etime->d == 7 ){	
					return "1 Week ago";	
				}elseif($etime->d == 14 ){	
					return "2 Weeks ago";	
				}elseif($etime->d == 21 ){	
					return "3 Weeks ago";	
				}elseif($etime->d == 28 ){	
					return "4 Weeks ago";	
				}else{	
					return $etime->d. " Days ago";	
				}	
			}  		
			//return $etime->d. " Days ago";	
		}	
		elseif($etime->h > 0){	
			if($etime->h == 1){	
				return $etime->h. " Hour ago";	
			}else{	
				return $etime->h. " Hours ago";	
			}	
		}	
		elseif($etime->i > 0){ 	
			if($etime->i == 1){	
				return $etime->i. " Minute ago";	
			}else{	
				return $etime->i. " Minutes ago";	
			}	
		}	
		elseif($etime->s > 0){	
			if($etime->s == 1){	
				return $etime->s. " Second ago";	
			}else{	
				return $etime->s. " Seconds ago";	
			}	
		}	
		else {	
			return "just now";	
		}	
			
	}


	/**
	 * Customize category object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_category( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->cat_id, 'category' );

		//set default icon
		$obj->default_icon = $this->get_default_photo( $obj->cat_id, 'category-icon' );
	}


	function convert_project_flats( &$obj )
	{

		// set project flat1 details 
		$obj->project_flat1 = $this->CI->Project_flats->get_flat_id($obj->id, 'flat1');

		// set project flat2 details 
		$obj->project_flat2 = $this->CI->Project_flats->get_flat_id($obj->id, 'flat2');
		
		// set project flat3 details 
		$obj->project_flat3 = $this->CI->Project_flats->get_flat_id($obj->id, 'flat3');
		
		// set project flat4 details 
		$obj->project_flat4 = $this->CI->Project_flats->get_flat_id($obj->id, 'flat4');

	}


	function convert_items_info( &$obj ){

		$obj->item_info = $this->realty_share_properties( $obj->item_id );

		$price_info = $this->CI->Item->get_one( $obj->item_id );


		//Posted time ago
		//$posted_time = $price_info->added_date;
		//$obj->posted_time_ago = $posted_time;
		$posted_time = $price_info->added_date;	
		$converted_posted_time_ago = $this->convert_posted_time($posted_time);	
		$obj->posted_time_ago = $converted_posted_time_ago;

		//possession_start_date_Convert
		$possession_start_date_info = $price_info->possession_start_date;
		$year = substr(date_format(date_create($possession_start_date_info),"Y"), -2);
		$month = date("n", strtotime($possession_start_date_info));
		$dt = DateTime::createFromFormat('!m', $month);
		$month_name = substr($dt->format('F'), 0, 3); 
		$convert_date_possession =$month_name."' ".$year;
		$obj->possession_start_date_convert = $convert_date_possession;


		//launch_date Convert
		$launch_date_info = $price_info->launch_date;
		$year = date_format(date_create($launch_date_info),"Y");
		$day = date_format(date_create($launch_date_info),"d");
		$month = date("n", strtotime($launch_date_info));
		$dt = DateTime::createFromFormat('!m', $month);
		$month_name = substr($dt->format('F'), 0, 3); 
		$convert_date_launch =$month_name." ".$day.", ".$year;
		$obj->launch_date_convert = $convert_date_launch;




		//price Convert
		 $price_items = $price_info->price;

		$convert_items_price = $this->convert_price($price_items);

		$obj->item_price = $convert_items_price;

		//End price Convert
		$price_items = $price_info->price_end;

		$convert_items_price_end = $this->convert_price($price_items);

		$obj->item_price_end = $convert_items_price_end;
		
		$obj->photo_count = $this->CI->Image->count_all_by(array('img_parent_id' => $obj->item_id));
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->item_id, 'item' );


		// set project details
		// set project details
		if ( isset( $obj->project_id )) {

			$tmp_project = $this->CI->Project->get_one( $obj->project_id );

			//$this->convert_project_flats( $tmp_project );

			$obj->project_details = $tmp_project;
		} 
		//$obj->project_details = $this->CI->Project->get_one( $obj->project_id );


		// category object
		if ( isset( $obj->item_info->cat_id )) {
			
			$tmp_category = $this->CI->Category->get_one( $obj->item_info->cat_id );

			$this->convert_category( $tmp_category );

			$obj->category = $tmp_category;
		}

		// Sub Category Object
		if ( isset( $obj->item_info->sub_cat_id )) {

			$tmp_sub_category = $this->CI->Subcategory->get_one( $obj->item_info->sub_cat_id );

			$this->convert_subcategory( $tmp_sub_category );

			$obj->sub_category = $tmp_sub_category;
		}

		// furnishing Object
		if ( isset( $obj->item_info->furnishing_id )) {
			
			$tmp_furnishing = $this->CI->Furnished->get_one( $obj->item_info->furnishing_id );
			
			//$this->convert_furnishing( $tmp_sub_category );
			
			$obj->furnishing = $tmp_furnishing;
	
		}

		// organisation Object
		if ( isset( $obj->item_info->org_id )) {
	
			$tmp_organisation = $this->CI->Organisation_model->get_one( $obj->item_info->org_id );
			
			$obj->organisation = $tmp_organisation;
	
		}

		// Itemtype Object
		if ( isset( $obj->item_info->item_type_id )) {

			$tmp_item_type = $this->CI->Itemtype->get_one( $obj->item_info->item_type_id );
			$obj->item_type = $tmp_item_type;
		}

		// Itemprice Object
		if ( isset( $obj->item_info->item_price_type_id )) {

			$tmp_item_price_type = $this->CI->Pricetype->get_one( $obj->item_info->item_price_type_id );
			$obj->item_price_type = $tmp_item_price_type;
		}

		// Itemcurrency Object
		if ( isset( $obj->item_info->item_currency_id )) {

			$tmp_item_currency = $this->CI->Currency->get_one( $obj->item_info->item_currency_id );
			$obj->item_currency = $tmp_item_currency;
		}

		// Itemlocation Object
		if ( isset( $obj->item_info->item_location_id )) {

			$tmp_item_location= $this->CI->Itemlocation->get_one( $obj->item_info->item_location_id );
			$obj->item_location = $tmp_item_location;
		}

		// condition of item id Object
		if ( isset( $obj->item_info->condition_of_item_id )) {

			$tmp_condition_item= $this->CI->Condition->get_one( $obj->item_info->condition_of_item_id );
			$obj->condition_of_item = $tmp_condition_item;
		}

		// condition of deal option id
		if ( isset( $obj->item_info->deal_option_id )) {

			$tmp_deal_option = $this->CI->Option->get_one( $obj->item_info->deal_option_id );
			$obj->deal_option = $tmp_deal_option ;
		}

		// Paid users info
		
		if ( isset( $obj->id )) {

			$paid_users = $this->convert_paid_users( $obj->id );

			$obj->paid_users_info = $paid_users;
		
		}			
	}
	
	function convert_paid_users( $id ){

		$paid_users = $this->CI->Users_share_properties->get_all_by( array( 'realty_share_property_id' => $obj->id, 'is_paid' => 1 ))->result();

		foreach($paid_users as $paid_user){
			$user[] = $paid_user;
			$this->paid_users( $paid_user );
		}
		return $user;

	}

	function paid_users( &$obj ){

		$obj->user = $this->CI->User->get_one( $obj->user_id );

	}

	function convert_realty_shares( &$obj ){

		$obj->realty_shares_info = $this->CI->Realty_share_properties->get_one( $obj->realty_share_property_id );

	     $this->convert_items_info( $obj->realty_shares_info);
	}



	function realty_share_properties( $itemid ){
		
		$item_info = "";

		$items = $this->CI->Item->get_all_by( array( 'id' => $itemid ))->result();
		if ( count( $items ) > 0 ) {			
			$item_info = $items[0];
		} else {
			$item_info = $this->CI->Item->get_empty_object();
		}
		return $item_info;
	}




		/**
	 * Customize category object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_news_category( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->cat_id, 'news_category' );

		//set default icon
		$obj->default_icon = $this->get_default_photo( $obj->cat_id, 'news-category-icon' );
	}


	/**
	 * Customize category object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_item( &$obj )
	{
		$conds['item_id'] = $obj->id;
		$conds['id'] = $obj->history_id;
		$paid_history = $this->CI->Paid_item->get_all_by($conds)->result();
		
		$today_date = date('Y-m-d H:i:s');
		if (count($paid_history) > 1) {

			foreach ($paid_history as $paid) {
				$tmp_result .= $paid->item_id .",";
				  
			}
			$paid_his_item_id = rtrim($tmp_result,",");
			$item_id = explode(",", $paid_his_item_id);
			
			$progress = $this->CI->Paid_item->get_item_by_paid_progress($item_id)->result();
			//for progress and finished
			if ( !empty($progress) ) {
				
				foreach ($progress as $pro) {
					if ($today_date >= $pro->start_date && $today_date <= $pro->end_date) {
						$obj->paid_status = get_msg('progress_label');
					} else {
						$obj->paid_status = get_msg('not_yet_start_label');
					}
				}
			} else {
				
				$obj->paid_status = get_msg('finished_label');
			}
			
			
		} elseif (count($paid_history)==1) {
			$start_date = $paid_history[0]->start_date;
			$end_date = $paid_history[0]->end_date;
			if ($today_date >= $start_date && $today_date <= $end_date) {
				$obj->paid_status = get_msg('progress_label');
			} elseif ($today_date > $start_date && $today_date > $end_date) {
				$obj->paid_status = get_msg('finished_label');
			} else {
				$obj->paid_status = get_msg('not_yet_start_label');
			}
		} else {
			$obj->paid_status = "not_available";
		}
		
		unset($obj->history_id);
		// photo count
		$obj->photo_count = $this->CI->Image->count_all_by(array('img_parent_id' => $obj->id));
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'item' );

		// set project details
		if ( isset( $obj->project_id )) {

			$tmp_project = $this->CI->Project->get_one( $obj->project_id );

			//$this->convert_project_flats( $tmp_project );

			$obj->project_details = $tmp_project;
		} 
		//$obj->project_details = $this->CI->Project->get_one( $obj->project_id );


		$items_price = $item_price_change/1.00.' '.$ext;

		$price_info = $this->CI->Item->get_one( $obj->id );


		//Posted time ago
		//$posted_time = $price_info->added_date;
		//$obj->posted_time_ago = $posted_time;
		$posted_time = $price_info->added_date;	
		$converted_posted_time_ago = $this->convert_posted_time($posted_time);	
		$obj->posted_time_ago = $converted_posted_time_ago;
		
		//possession_start_date_Convert
		if($price_info->possession_start_date != ''){
			$possession_start_date_info = $price_info->possession_start_date;
			$year = substr(date_format(date_create($possession_start_date_info),"Y"), -2);
			$month = date("n", strtotime($possession_start_date_info));
			$dt = DateTime::createFromFormat('!m', $month);
			$month_name = substr($dt->format('F'), 0, 3); 
			$convert_date_possession =$month_name."' ".$year;
			$obj->possession_start_date_convert = $convert_date_possession;
		}else{
			$obj->possession_start_date_convert = '';
		}


		
		//launch_date Convert  
		if($price_info->launch_date != '0000-00-00 00:00:00'){
			$launch_date_info = $price_info->launch_date;
			$year = date_format(date_create($launch_date_info),"Y");
			$day = date_format(date_create($launch_date_info),"d");
			$month = date("n", strtotime($launch_date_info));
			$dt = DateTime::createFromFormat('!m', $month);
			$month_name = substr($dt->format('F'), 0, 3); 
			$convert_date_launch =$month_name." ".$day.", ".$year;
			$obj->launch_date_convert = $convert_date_launch;
		}else{
			$obj->launch_date_convert = '';			
		}



        //Price Convert
		$price_items = $price_info->price;

	    $convert_items_price = $this->convert_price($price_items);
 
		$obj->item_price = $convert_items_price;
		
		//End price Convert
		$price_items = $price_info->price_end;

		$convert_items_price_end = $this->convert_price($price_items);

		$obj->item_price_end = $convert_items_price_end;


		// category object
		if ( isset( $obj->cat_id )) {

			$tmp_category = $this->CI->Category->get_one( $obj->cat_id );

			$this->convert_category( $tmp_category );

			$obj->category = $tmp_category;
		}

		// Sub Category Object
		if ( isset( $obj->sub_cat_id )) {

			$tmp_sub_category = $this->CI->Subcategory->get_one( $obj->sub_cat_id );

			$this->convert_subcategory( $tmp_sub_category );

			$obj->sub_category = $tmp_sub_category;
		}

		// furnishing Object
		if ( isset( $obj->furnishing_id )) {
			
			$tmp_furnishing = $this->CI->Furnished->get_one( $obj->furnishing_id );
			
			//$this->convert_furnishing( $tmp_sub_category );
			
			$obj->furnishing = $tmp_furnishing;
	
		}

		// organisation Object
		if ( isset( $obj->org_id )) {
	
			$tmp_organisation = $this->CI->Organisation_model->get_one( $obj->org_id );
			
			$obj->organisation = $tmp_organisation;
	
		}

		// Itemtype Object
		if ( isset( $obj->item_type_id )) {

			$tmp_item_type = $this->CI->Itemtype->get_one( $obj->item_type_id );
			$obj->item_type = $tmp_item_type;
		}

		// Itemprice Object
		if ( isset( $obj->item_price_type_id )) {

			$tmp_item_price_type = $this->CI->Pricetype->get_one( $obj->item_price_type_id );
			$obj->item_price_type = $tmp_item_price_type;
		}

		// Itemcurrency Object
		if ( isset( $obj->item_currency_id )) {

			$tmp_item_currency = $this->CI->Currency->get_one( $obj->item_currency_id );
			$obj->item_currency = $tmp_item_currency;
		}

		// Itemlocation Object
		if ( isset( $obj->item_location_id )) {

			$tmp_item_location= $this->CI->Itemlocation->get_one( $obj->item_location_id );
			$obj->item_location = $tmp_item_location;
		}

		// condition of item id Object
		if ( isset( $obj->condition_of_item_id )) {

			$tmp_condition_item= $this->CI->Condition->get_one( $obj->condition_of_item_id );
			$obj->condition_of_item = $tmp_condition_item;
		}

		// condition of deal option id
		if ( isset( $obj->deal_option_id )) {

			$tmp_deal_option = $this->CI->Option->get_one( $obj->deal_option_id );
			$obj->deal_option = $tmp_deal_option ;
		}

		//print_r($obj->added_user_id . "$$");die;
		// User Object
		if ( isset( $obj->added_user_id )) {
			$tmp_item_user = $this->CI->User->get_one( $obj->added_user_id );

			$this->convert_user( $tmp_item_user );
			$obj->user = $tmp_item_user;
		}

		//Need to check for Like and Favourite
		$obj->is_favourited = 0;
		$obj->is_owner = 0;

		if($this->get_login_user_id() != "") {
			//echo "1";
			//Need to check for Fav
			$conds['item_id'] = $obj->id;
			$conds['user_id']    = $this->get_login_user_id();
			$login_user_id = $conds['user_id'];


			if($obj->added_user_id == $login_user_id) {
				$obj->is_owner = 1;
			} else {
				$obj->is_owner = 0;
			}

			$fav_id = $this->CI->Favourite->get_one_by($conds)->id;
			$obj->is_favourited = 0;
			if($fav_id != "") {
				$obj->is_favourited = 1;
			} else {
				$obj->is_favourited = 0;
			}

		} else if($obj->login_user_id_post != "") {
			//echo "2";
			$conds['item_id'] 	= $obj->id;
			$conds['user_id']    = $obj->login_user_id_post;
			$login_user_id = $conds['user_id'];

			// checking for like product by user

			$obj->is_owner = 0;
			if($obj->added_user_id == $login_user_id) {
				$obj->is_owner = 1;
			} else {
				$obj->is_owner = 0;
			}
			
			$fav_id = $this->CI->Favourite->get_one_by($conds)->id;
			$obj->is_favourited = 0;
			if($fav_id != "") {
				$obj->is_favourited = 1;
			} else {
				$obj->is_favourited = 0;
			}

		}
		//die;

		//print_r($obj->added_user_id);die;
		//unset($obj->login_user_id_post);

		$obj->is_favourited = $obj->is_favourited;
		$obj->is_owner = $obj->is_owner;

	}

	/**
	 * Customize chatitem object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_chatitem( &$obj )
	{
			
		// photo count
		$obj->photo_count = $this->CI->Image->count_all_by(array('img_parent_id' => $obj->id));
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'item' );

		// category object
		if ( isset( $obj->cat_id )) {
			$tmp_category = $this->CI->Category->get_one( $obj->cat_id );

			$this->convert_category( $tmp_category );

			$obj->category = $tmp_category;
		}

		// Sub Category Object
		if ( isset( $obj->sub_cat_id )) {
			$tmp_sub_category = $this->CI->Subcategory->get_one( $obj->sub_cat_id );

			$this->convert_subcategory( $tmp_sub_category );

			$obj->sub_category = $tmp_sub_category;
		}

		// furnishing Object
		if ( isset( $obj->furnishing_id )) {
	
			$tmp_furnishing = $this->CI->Furnished->get_one( $obj->furnishing_id );
			
			//$this->convert_furnishing( $tmp_sub_category );
			
			$obj->furnishing = $tmp_furnishing;
	
		}


		// organisation Object
		if ( isset( $obj->org_id )) {

			$tmp_organisation = $this->CI->Organisation_model->get_one( $obj->org_id );
			
			//$this->convert_furnishing( $tmp_sub_category );
			
			$obj->organisation = $tmp_organisation;
	
		}



		// Itemtype Object
		if ( isset( $obj->item_type_id )) {
			$tmp_item_type = $this->CI->Itemtype->get_one( $obj->item_type_id );

			$obj->item_type = $tmp_item_type;
		}

		// Itemprice Object
		if ( isset( $obj->item_price_type_id )) {
			$tmp_item_price_type = $this->CI->Pricetype->get_one( $obj->item_price_type_id );

			$obj->item_price_type = $tmp_item_price_type;
		}

		// Itemcurrency Object
		if ( isset( $obj->item_currency_id )) {
			$tmp_item_currency = $this->CI->Currency->get_one( $obj->item_currency_id );

			$obj->item_currency = $tmp_item_currency;
		}

		// Itemlocation Object
		if ( isset( $obj->item_location_id )) {
			$tmp_item_location= $this->CI->Itemlocation->get_one( $obj->item_location_id );

			$obj->item_location = $tmp_item_location;
		}

		// condition of item id Object
		if ( isset( $obj->condition_of_item_id )) {
			$tmp_condition_item= $this->CI->Condition->get_one( $obj->condition_of_item_id );

			$obj->condition_of_item = $tmp_condition_item;
		}

		// Chat User Object
		if ( isset( $obj->chat_user_id )) {
			$conds['chat_user_id'] = $obj->chat_user_id;

			$tmp_item_user = $this->CI->User->get_all_in_user($conds)->result();
			//print_r($tmp_item_user);die;

			$this->convert_user( $tmp_item_user );

			$obj->chat_user = $tmp_item_user;
		}


		//Need to check for Like and Favourite
		$obj->is_favourited = 0;
		$obj->is_owner = 0;
		
		if($this->get_login_user_id() != "") {
			//Need to check for Fav
			$conds['item_id'] = $obj->id;
			$conds['user_id'] = $this->get_login_user_id();
			$login_user_id    = $conds['user_id'];
		
			// checking for item by user
			if($obj->added_user_id == $login_user_id) {
				$obj->is_owner = 1;
			} else {
				$obj->is_owner = 0;
			}


			$fav_id = $this->CI->Favourite->get_one_by($conds)->fav_id;

			$obj->is_favourited = 0;
			if($fav_id != "") {
				$obj->is_favourited = 1;
			} else {
				$obj->is_favourited = 0;
			}

		} else if($obj->login_user_id_post != "") {
			$conds['item_id'] = $obj->id;
			$conds['user_id'] = $obj->login_user_id_post;
			$login_user_id    = $conds['user_id'];

			// checking for like product by user
			$obj->is_owner = 0;
			if($obj->added_user_id == $login_user_id) {
				$obj->is_owner = 1;
			} else {
				$obj->is_owner = 0;
			}

			$fav_id = $this->CI->Favourite->get_one_by($conds)->id;
			$obj->is_favourited = 0;
			if($fav_id != "") {
				$obj->is_favourited = 1;
			} else {
				$obj->is_favourited = 0;
			}

		}

		
		unset($obj->login_user_id_post);

		$obj->is_favourited = $obj->is_favourited;
		$obj->is_owner = $obj->is_owner;

	}


	/**
	 * Sets the login user.
	 */
	function get_login_user_id()
	{
		return $this->login_user_id;
	}


	
	/**
	 * Customize follower user object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_user_follow( &$obj )
	{
		// user object
		if ( isset( $obj->followed_user_id )) {
			$tmp_user = $this->CI->User->get_one( $obj->followed_user_id );

			$this->convert_user( $tmp_user );

			$obj->user_followed = $tmp_user;
		}
	}



	/**
	 * Customize about object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_about( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->about_id, 'about' );

	}

	/**
	 * Customize user object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_user( &$obj , $need_return = false)
	{
		
		$conds['added_user_id'] = $obj->user_id;
		//print_r($obj->user_id);die;
		$obj->rating_count = $this->CI->Rate->count_all_by(array('to_user_id' => $obj->user_id));

        //is follower or not

		$obj->is_followed = 0;
		
		 if($obj->followed_user_id != "") {
			
			$conds1['user_id']    = $obj->following_user_id;
			$conds1['followed_user_id'] = $obj->followed_user_id;
			
			// checking follower
			
			$followed_user_id = $this->CI->Userfollow->get_one_by($conds1)->id;
			//print_r($followed_user_id);die;
			$obj->is_followed = 0;
			if($followed_user_id != "") {
				$obj->is_followed = 1;
			} else {
				$obj->is_followed = 0;
			}

		}
		

		
		unset($obj->following_user_id);
		unset($obj->followed_user_id);
		unset($obj->user_password);
		
		$obj->is_followed = $obj->is_followed;

        //rating details 
		
		$total_rating_count = 0;
		$total_rating_value = 0;

		$five_star_count = 0;
		$five_star_percent = 0;

		$four_star_count = 0;
		$four_star_percent = 0;

		$three_star_count = 0;
		$three_star_percent = 0;

		$two_star_count = 0;
		$two_star_percent = 0;

		$one_star_count = 0;
		$one_star_percent = 0;


		

		//Rating Total how much ratings for this product
		$conds_rating['to_user_id'] = $obj->user_id;
		$total_rating_count = $this->CI->Rate->count_all_by($conds_rating);
		$sum_rating_value = $this->CI->Rate->sum_all_by($conds_rating)->result()[0]->rating;


		//Rating Value such as 3.5, 4.3 and etc
		if($total_rating_count > 0) {
			$total_rating_value = number_format((float) ($sum_rating_value  / $total_rating_count), 1, '.', '');
		} else {
			$total_rating_value = 0;
		}

		//For 5 Stars rating
		$conds_five_star_rating['rating'] = 5;
		$conds_five_star_rating['to_user_id'] = $obj->user_id;
		$five_star_count = $this->CI->Rate->count_all_by($conds_five_star_rating);
		if($total_rating_count > 0) {
			$five_star_percent = number_format((float) ((100 / $total_rating_count) * $five_star_count), 1, '.', '');
		} else {
			$five_star_percent = 0;
		}

		//For 4 Stars rating
		$conds_four_star_rating['rating'] = 4;
		$conds_four_star_rating['to_user_id'] = $obj->user_id;
		$four_star_count = $this->CI->Rate->count_all_by($conds_four_star_rating);
		if($total_rating_count > 0) {
			$four_star_percent = number_format((float) ((100 / $total_rating_count) * $four_star_count), 1, '.', '');
		} else {
			$four_star_percent = 0;
		}


		//For 3 Stars rating
		$conds_three_star_rating['rating'] = 3;
		$conds_three_star_rating['to_user_id'] = $obj->user_id;
		$three_star_count = $this->CI->Rate->count_all_by($conds_three_star_rating);
		if($total_rating_count > 0) {
			$three_star_percent = number_format((float) ((100 / $total_rating_count) * $three_star_count), 1, '.', '');
		} else {
			$three_star_percent = 0;
		}


		//For 2 Stars rating
		$conds_two_star_rating['rating'] = 2;
		$conds_two_star_rating['to_user_id'] = $obj->user_id;
		$two_star_count = $this->CI->Rate->count_all_by($conds_two_star_rating);

		if($total_rating_count > 0) {
			$two_star_percent = number_format((float) ((100 / $total_rating_count) * $two_star_count), 1, '.', '');
		} else {
			$two_star_percent = 0;
		}

		//For 1 Stars rating
		$conds_one_star_rating['rating'] = 1;
		$conds_one_star_rating['to_user_id'] = $obj->user_id;
		$one_star_count = $this->CI->Rate->count_all_by($conds_one_star_rating);

		if($total_rating_count > 0) {
		$one_star_percent = number_format((float) ((100 / $total_rating_count) * $one_star_count), 1, '.', '');
		} else {
			$one_star_percent = 0;
		}


		$rating_std = new stdClass();
		@$rating_std->five_star_count = $five_star_count; 
		$rating_std->five_star_percent = $five_star_percent;

		$rating_std->four_star_count = $four_star_count;
		$rating_std->four_star_percent = $four_star_percent;

		$rating_std->three_star_count = $three_star_count;
		$rating_std->three_star_percent = $three_star_percent;

		$rating_std->two_star_count = $two_star_count;
		$rating_std->two_star_percent = $two_star_percent;

		$rating_std->one_star_count = $one_star_count;
		$rating_std->one_star_percent = $one_star_percent;

		//print_r($total_rating_count . "##" . $total_rating_value);die;

		$rating_std->total_rating_count = $total_rating_count;
		$rating_std->total_rating_value = $total_rating_value;


		$obj->rating_details = $rating_std;

		if($need_return)
		{
			return $obj;
		} 

	}



	function convert_business_user( &$obj , $need_return = false)
	{

		
		$conds['added_user_id'] = $obj->user_id;
		//print_r($obj->user_id);die;
		$obj->rating_count = $this->CI->Rate->count_all_by(array('to_user_id' => $obj->user_id));

        //is follower or not

		$obj->is_followed = 0;
		
		 if($obj->followed_user_id != "") {
			
			$conds1['user_id']    = $obj->following_user_id;
			$conds1['followed_user_id'] = $obj->followed_user_id;
			
			// checking follower
			
			$followed_user_id = $this->CI->Userfollow->get_one_by($conds1)->id;
			//print_r($followed_user_id);die;
			$obj->is_followed = 0;
			if($followed_user_id != "") {
				$obj->is_followed = 1;
			} else {
				$obj->is_followed = 0;
			}

		}
		

		
		unset($obj->following_user_id);
		unset($obj->followed_user_id);
		unset($obj->user_password);
		
		$obj->is_followed = $obj->is_followed;

        //rating details 
		
		$total_rating_count = 0;
		$total_rating_value = 0;

		$five_star_count = 0;
		$five_star_percent = 0;

		$four_star_count = 0;
		$four_star_percent = 0;

		$three_star_count = 0;
		$three_star_percent = 0;

		$two_star_count = 0;
		$two_star_percent = 0;

		$one_star_count = 0;
		$one_star_percent = 0;


		

		//Rating Total how much ratings for this product
		$conds_rating['to_user_id'] = $obj->user_id;
		$total_rating_count = $this->CI->Rate->count_all_by($conds_rating);
		$sum_rating_value = $this->CI->Rate->sum_all_by($conds_rating)->result()[0]->rating;


		//Rating Value such as 3.5, 4.3 and etc
		if($total_rating_count > 0) {
			$total_rating_value = number_format((float) ($sum_rating_value  / $total_rating_count), 1, '.', '');
		} else {
			$total_rating_value = 0;
		}

		//For 5 Stars rating
		$conds_five_star_rating['rating'] = 5;
		$conds_five_star_rating['to_user_id'] = $obj->user_id;
		$five_star_count = $this->CI->Rate->count_all_by($conds_five_star_rating);
		if($total_rating_count > 0) {
			$five_star_percent = number_format((float) ((100 / $total_rating_count) * $five_star_count), 1, '.', '');
		} else {
			$five_star_percent = 0;
		}

		//For 4 Stars rating
		$conds_four_star_rating['rating'] = 4;
		$conds_four_star_rating['to_user_id'] = $obj->user_id;
		$four_star_count = $this->CI->Rate->count_all_by($conds_four_star_rating);
		if($total_rating_count > 0) {
			$four_star_percent = number_format((float) ((100 / $total_rating_count) * $four_star_count), 1, '.', '');
		} else {
			$four_star_percent = 0;
		}


		//For 3 Stars rating
		$conds_three_star_rating['rating'] = 3;
		$conds_three_star_rating['to_user_id'] = $obj->user_id;
		$three_star_count = $this->CI->Rate->count_all_by($conds_three_star_rating);
		if($total_rating_count > 0) {
			$three_star_percent = number_format((float) ((100 / $total_rating_count) * $three_star_count), 1, '.', '');
		} else {
			$three_star_percent = 0;
		}


		//For 2 Stars rating
		$conds_two_star_rating['rating'] = 2;
		$conds_two_star_rating['to_user_id'] = $obj->user_id;
		$two_star_count = $this->CI->Rate->count_all_by($conds_two_star_rating);

		if($total_rating_count > 0) {
			$two_star_percent = number_format((float) ((100 / $total_rating_count) * $two_star_count), 1, '.', '');
		} else {
			$two_star_percent = 0;
		}

		//For 1 Stars rating
		$conds_one_star_rating['rating'] = 1;
		$conds_one_star_rating['to_user_id'] = $obj->user_id;
		$one_star_count = $this->CI->Rate->count_all_by($conds_one_star_rating);

		if($total_rating_count > 0) {
		$one_star_percent = number_format((float) ((100 / $total_rating_count) * $one_star_count), 1, '.', '');
		} else {
			$one_star_percent = 0;
		}


		$rating_std = new stdClass();
		@$rating_std->five_star_count = $five_star_count; 
		$rating_std->five_star_percent = $five_star_percent;

		$rating_std->four_star_count = $four_star_count;
		$rating_std->four_star_percent = $four_star_percent;

		$rating_std->three_star_count = $three_star_count;
		$rating_std->three_star_percent = $three_star_percent;

		$rating_std->two_star_count = $two_star_count;
		$rating_std->two_star_percent = $two_star_percent;

		$rating_std->one_star_count = $one_star_count;
		$rating_std->one_star_percent = $one_star_percent;

		//print_r($total_rating_count . "##" . $total_rating_value);die;

		$rating_std->total_rating_count = $total_rating_count;
		$rating_std->total_rating_value = $total_rating_value;


		$obj->rating_details = $rating_std;

		if($need_return)
		{
			return $obj;
		} 

	}




	/**
	 * Customize noti object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_noti_message( &$obj )
	{
		
		
		if($this->get_login_user_id() != "") {
			$noti_user_data = array(
	        	"noti_id" => $obj->id,
	        	"user_id" => $this->get_login_user_id()
	    	);
			if ( !$this->CI->Notireaduser->exists( $noti_user_data )) {
				$obj->is_read = 0;
			} else {
				$obj->is_read = 1;
			}
		} 
		


		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'noti' );
	}

	/**
	 * Customize noti object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_noti( &$obj )
	{
		
		
		if($this->get_login_user_id() != "") {
			$noti_user_data = array(
	        	"noti_id" => $obj->id,
	        	"user_id" => $this->get_login_user_id()
	    	);
			if ( !$this->CI->Notireaduser->exists( $noti_user_data )) {
				$obj->is_read = 0;
			} else {
				$obj->is_read = 1;
			}

		} 
		


		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'noti' );
	}

	/**
	 * Customize request category object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_request_category( &$obj )
	{
		
	}

	/**
	 * Customize request category object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_subcategory( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'sub_category' );

		//set default icon
		$obj->default_icon = $this->get_default_photo( $obj->id, 'subcat_icon' );
	}

	/*
	 * Customize feed object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_feed( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'blog' );

	}

	//user contact info
	
	function convert_user_contactinfo(&$obj)
	{
		$contact_info = $this->CI->User->get_one( $obj->user_id );
		$obj->user_name = $contact_info->user_name ;
		$obj->user_phone = $contact_info->user_phone ;
		$obj->user_email = $contact_info->user_email ;
		$obj->user_city  = $contact_info->city ;
		$obj->profile_photo  = $contact_info->user_profile_photo ;

		// category object
		if ( isset( $obj->cat_id )) {
	
			$tmp_category = $this->CI->Category->get_one( $obj->cat_id );

			$this->convert_category( $tmp_category );

			$obj->category = $tmp_category;
		}

		// Sub Category Object
		if ( isset( $obj->sub_cat_id )) {

			$tmp_sub_category = $this->CI->Subcategory->get_one( $obj->sub_cat_id );

			$this->convert_subcategory( $tmp_sub_category );

			$obj->sub_category = $tmp_sub_category;
		}

		// Itemlocation Object
		if ( isset( $obj->location_id )) {
			$tmp_item_location= $this->CI->Itemlocation->get_one( $obj->location_id );

			$obj->item_location = $tmp_item_location;
		}
	}

	//review image
	
	function convert_review_img( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'review' );

	}

	//review image
	
	function convert_clickearn_img( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'click_earn' );

	}

	/*
	 * Customize banner object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_banner( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'banner' );

	}

		/*
	 * Customize LRS_post object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_lrs( &$obj )
	{
		// set default photo
		$obj->default_photo = $this->get_default_photo( $obj->id, 'LRS_post' );

	}

	/*
	 * Customize feed object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_paid_history( &$obj )
	{
		$today_date = date('Y-m-d H:i:s');
		if ($today_date >= $obj->start_date && $today_date <= $obj->end_date) {
			$obj->paid_status = get_msg('progress_label');
		} elseif ($today_date > $obj->start_date && $today_date > $obj->end_date) {
			$obj->paid_status = get_msg('finished_label');
		} elseif ($today_date < $obj->end_date && $today_date < $obj->end_date) {
			$obj->paid_status = get_msg('not_yet_start_label');
		} else {
			$obj->paid_status = get_msg('not_available');
		}
		// item object
		if ( isset( $obj->item_id )) {
			$tmp_item = $this->CI->Item->get_one( $obj->item_id );
			$tmp_item->history_id = $obj->id;

			$this->convert_item( $tmp_item );

			$obj->item = $tmp_item;
		}

	}

	/**
	 * Customize tag object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_rating( &$obj )
	{
		// set user object

		if ( is_array( $obj )) {
			
			for ($i=0; $i < count($obj) ; $i++) { 
				if ( isset( $obj[$i]->from_user_id )) {

					$tmp_from_user_id = $this->CI->User->get_one( $obj[$i]->from_user_id );
					//print_r($tmp_from_user_id);die;
					$this->convert_user( $tmp_from_user_id );
					//print_r($a);die;
					$obj[$i]->from_user = $tmp_from_user_id;
				}


				// set user object
				if ( isset( $obj[$i]->to_user_id )) {
					$tmp_to_user_id = $this->CI->User->get_one( $obj[$i]->to_user_id );

					$this->convert_user( $tmp_to_user_id );

					$obj[$i]->to_user = $tmp_to_user_id;
				}
			}
			

		}else {

			if ( isset( $obj->from_user_id )) {

					$tmp_from_user_id = $this->CI->User->get_one( $obj->from_user_id );
					//print_r($tmp_from_user_id);die;
					$this->convert_user( $tmp_from_user_id );
					//print_r($a);die;
					$obj->from_user = $tmp_from_user_id;
				}


				// set user object
				if ( isset( $obj->to_user_id )) {
					$tmp_to_user_id = $this->CI->User->get_one( $obj->to_user_id );

					$this->convert_user( $tmp_to_user_id );

					$obj->to_user = $tmp_to_user_id;
				}

		}
	}

	/**
	 * Customize chatitem object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_chathistory( &$obj )
	{
		if ( is_array( $obj )) {
			for ($i=0; $i < count($obj) ; $i++) { 

				if ( $obj[$i]->nego_price == '0') {
					$obj[$i]->is_offer = 0;
					$obj[$i]->offer_amount = 0;
					
				} else {
					$obj[$i]->is_offer = 1;
					$obj[$i]->offer_amount = $obj[$i]->nego_price;

				}
				// item object
				if ( isset( $obj[$i]->item_id )) {
					$tmp_item = $this->CI->Item->get_one( $obj[$i]->item_id );

					$this->convert_item( $tmp_item );

					$obj[$i]->item = $tmp_item;
				}

				//set users objects
				if ( isset( $obj[$i]->buyer_user_id )) {

					$tmp_buyer_user_id = $this->CI->User->get_one( $obj[$i]->buyer_user_id );
					$this->convert_user( $tmp_buyer_user_id );
					$obj[$i]->buyer = $tmp_buyer_user_id;
				}

				if ( isset( $obj[$i]->seller_user_id )) {
					$tmp_seller_user_id = $this->CI->User->get_one( $obj[$i]->seller_user_id );

					$this->convert_user( $tmp_seller_user_id );

					$obj[$i]->seller = $tmp_seller_user_id;
				}
			}
		} else {


			if ( $obj->nego_price == '0') {
				$obj->is_offer = 0;
				$obj->offer_amount = 0;
				
			} else {
				$obj->is_offer = 1;
				$obj->offer_amount = $obj->nego_price;

			}

			if ( isset( $obj->item_id )) {
				$tmp_item = $this->CI->Item->get_one( $obj->item_id );

				$this->convert_item( $tmp_item );

				$obj->item = $tmp_item;
			}

			// set users objects
			
			if ( isset( $obj->buyer_user_id )) {

				$tmp_buyer_user_id = $this->CI->User->get_one( $obj->buyer_user_id );
				$this->convert_user( $tmp_buyer_user_id );
				$obj->buyer = $tmp_buyer_user_id;
			}


			if ( isset( $obj->seller_user_id )) {
				$tmp_seller_user_id = $this->CI->User->get_one( $obj->seller_user_id );

				$this->convert_user( $tmp_seller_user_id );

				$obj->seller = $tmp_seller_user_id;
			}

		}	
	}


	/**
	 * Customize follwing user object
	 *
	 * @param      <type>  $obj    The object
	 */
	function convert_follow_user( &$obj )
	{
		// user object
		if ( isset( $obj->user_id )) {
			$tmp_user = $this->CI->User->get_one( $obj->user_id );

			$this->convert_user( $tmp_user );

			$obj->user_followed = $tmp_user;
		}
	}

	function convert_follow_user_list( &$obj, $followed_user_id )
	{

		if ( is_array( $obj )) {

			for ($i=0; $i < count($obj) ; $i++) { 

				$obj[$i]->is_followed = 0;
			
				 if($followed_user_id != "") {
					
					// $conds1['user_id']    = $following_user_id;
					// $conds1['followed_user_id'] = $obj[$i]->user_id;
					$conds1['user_id']    = $obj[$i]->user_id;
					$conds1['followed_user_id'] = $followed_user_id;
					// checking follower
					
					$followed_user_id = $this->CI->Userfollow->get_one_by($conds1)->id;
					//print_r($followed_user_id);die;
					$obj[$i]->is_followed = 0;
					if($followed_user_id != "") {
						$obj[$i]->is_followed = 1;
					} else {
						$obj[$i]->is_followed = 0;
					}

				}
				
				unset($followed_user_id);

				$obj[$i]->is_followed = $obj[$i]->is_followed;

				if ( isset( $obj[$i]->user_id )) {

					$obj[$i]->rating_count = $this->CI->Rate->count_all_by(array('to_user_id' => $obj[$i]->user_id));

						//rating details 
					$total_rating_count = 0;
					$total_rating_value = 0;

					$five_star_count = 0;
					$five_star_percent = 0;

					$four_star_count = 0;
					$four_star_percent = 0;

					$three_star_count = 0;
					$three_star_percent = 0;

					$two_star_count = 0;
					$two_star_percent = 0;

					$one_star_count = 0;
					$one_star_percent = 0;

					//Rating Total how much ratings for this product
					$conds_rating['to_user_id'] = $obj[$i]->user_id;
					
					$total_rating_count = $this->CI->Rate->count_all_by($conds_rating);
					$sum_rating_value = $this->CI->Rate->sum_all_by($conds_rating)->result()[0]->rating;


					//Rating Value such as 3.5, 4.3 and etc
					if($total_rating_count > 0) {
						$total_rating_value = number_format((float) ($sum_rating_value  / $total_rating_count), 1, '.', '');
					} else {
						$total_rating_value = 0;
					}

					//For 5 Stars rating

					$conds_five_star_rating['rating'] = 5;
					$conds_five_star_rating['to_user_id'] = $obj->id;
					$five_star_count = $this->CI->Rate->count_all_by($conds_five_star_rating);
					if($total_rating_count > 0) {
						$five_star_percent = number_format((float) ((100 / $total_rating_count) * $five_star_count), 1, '.', '');
					} else {
						$five_star_percent = 0;
					}

					//For 4 Stars rating
					$conds_four_star_rating['rating'] = 4;
					$conds_four_star_rating['to_user_id'] = $obj->id;
					$four_star_count = $this->CI->Rate->count_all_by($conds_four_star_rating);
					if($total_rating_count > 0) {
						$four_star_percent = number_format((float) ((100 / $total_rating_count) * $four_star_count), 1, '.', '');
					} else {
						$four_star_percent = 0;
					}


					//For 3 Stars rating
					$conds_three_star_rating['rating'] = 3;
					$conds_three_star_rating['to_user_id'] = $obj->id;
					$three_star_count = $this->CI->Rate->count_all_by($conds_three_star_rating);
					if($total_rating_count > 0) {
						$three_star_percent = number_format((float) ((100 / $total_rating_count) * $three_star_count), 1, '.', '');
					} else {
						$three_star_percent = 0;
					}


					//For 2 Stars rating
					$conds_two_star_rating['rating'] = 2;
					$conds_two_star_rating['to_user_id'] = $obj->id;
					$two_star_count = $this->CI->Rate->count_all_by($conds_two_star_rating);

					if($total_rating_count > 0) {
						$two_star_percent = number_format((float) ((100 / $total_rating_count) * $two_star_count), 1, '.', '');
					} else {
						$two_star_percent = 0;
					}

					//For 1 Stars rating
					$conds_one_star_rating['rating'] = 1;
					$conds_one_star_rating['to_user_id'] = $obj->id;
					$one_star_count = $this->CI->Rate->count_all_by($conds_one_star_rating);

					if($total_rating_count > 0) {
					$one_star_percent = number_format((float) ((100 / $total_rating_count) * $one_star_count), 1, '.', '');
					} else {
						$one_star_percent = 0;
					}


					$rating_std = new stdClass();
					@$rating_std->five_star_count = $five_star_count; 
					$rating_std->five_star_percent = $five_star_percent;

					$rating_std->four_star_count = $four_star_count;
					$rating_std->four_star_percent = $four_star_percent;

					$rating_std->three_star_count = $three_star_count;
					$rating_std->three_star_percent = $three_star_percent;

					$rating_std->two_star_count = $two_star_count;
					$rating_std->two_star_percent = $two_star_percent;

					$rating_std->one_star_count = $one_star_count;
					$rating_std->one_star_percent = $one_star_percent;

					$rating_std->total_rating_count = $total_rating_count;
					$rating_std->total_rating_value = $total_rating_value;

					$obj[$i]->rating_details = $rating_std;	
					
				}

			
			}

		} else {
			$obj->is_followed = 0;
			
			 if($followed_user_id != "") {
				
				// $conds1['user_id']    = $following_user_id;
				// $conds1['followed_user_id'] = $obj[$i]->user_id;
				$conds1['user_id']    = $obj[$i]->user_id;
				$conds1['followed_user_id'] = $followed_user_id;
				// checking follower
				
				$followed_user_id = $this->CI->Userfollow->get_one_by($conds1)->id;
				//print_r($followed_user_id);die;
				$obj->is_followed = 0;
				if($followed_user_id != "") {
					$obj->is_followed = 1;
				} else {
					$obj->is_followed = 0;
				}

			}
			
			unset($followed_user_id);

			$obj->is_followed = $obj->is_followed;
			$obj->rating_count = $this->CI->Rate->count_all_by(array('to_user_id' => $obj->user_id));
			//rating details 
			$total_rating_count = 0;
			$total_rating_value = 0;

			$five_star_count = 0;
			$five_star_percent = 0;

			$four_star_count = 0;
			$four_star_percent = 0;

			$three_star_count = 0;
			$three_star_percent = 0;

			$two_star_count = 0;
			$two_star_percent = 0;

			$one_star_count = 0;
			$one_star_percent = 0;

			//Rating Total how much ratings for this product
			$conds_rating['to_user_id'] = $obj->to_user_id;
			$total_rating_count = $this->CI->Rate->count_all_by($conds_rating);
			$sum_rating_value = $this->CI->Rate->sum_all_by($conds_rating)->result()[0]->rating;

			//Rating Value such as 3.5, 4.3 and etc
			if($total_rating_count > 0) {
				$total_rating_value = number_format((float) ($sum_rating_value  / $total_rating_count), 1, '.', '');
			} else {
				$total_rating_value = 0;
			}

			//For 5 Stars rating

			$conds_five_star_rating['rating'] = 5;
			$conds_five_star_rating['to_user_id'] = $obj->id;
			$five_star_count = $this->CI->Rate->count_all_by($conds_five_star_rating);
			if($total_rating_count > 0) {
				$five_star_percent = number_format((float) ((100 / $total_rating_count) * $five_star_count), 1, '.', '');
			} else {
				$five_star_percent = 0;
			}

			//For 4 Stars rating
			$conds_four_star_rating['rating'] = 4;
			$conds_four_star_rating['to_user_id'] = $obj->id;
			$four_star_count = $this->CI->Rate->count_all_by($conds_four_star_rating);
			if($total_rating_count > 0) {
				$four_star_percent = number_format((float) ((100 / $total_rating_count) * $four_star_count), 1, '.', '');
			} else {
				$four_star_percent = 0;
			}


			//For 3 Stars rating
			$conds_three_star_rating['rating'] = 3;
			$conds_three_star_rating['to_user_id'] = $obj->id;
			$three_star_count = $this->CI->Rate->count_all_by($conds_three_star_rating);
			if($total_rating_count > 0) {
				$three_star_percent = number_format((float) ((100 / $total_rating_count) * $three_star_count), 1, '.', '');
			} else {
				$three_star_percent = 0;
			}


			//For 2 Stars rating
			$conds_two_star_rating['rating'] = 2;
			$conds_two_star_rating['to_user_id'] = $obj->id;
			$two_star_count = $this->CI->Rate->count_all_by($conds_two_star_rating);

			if($total_rating_count > 0) {
				$two_star_percent = number_format((float) ((100 / $total_rating_count) * $two_star_count), 1, '.', '');
			} else {
				$two_star_percent = 0;
			}

			//For 1 Stars rating
			$conds_one_star_rating['rating'] = 1;
			$conds_one_star_rating['to_user_id'] = $obj->id;
			$one_star_count = $this->CI->Rate->count_all_by($conds_one_star_rating);

			if($total_rating_count > 0) {
			$one_star_percent = number_format((float) ((100 / $total_rating_count) * $one_star_count), 1, '.', '');
			} else {
				$one_star_percent = 0;
			}


			$rating_std = new stdClass();
			@$rating_std->five_star_count = $five_star_count; 
			$rating_std->five_star_percent = $five_star_percent;

			$rating_std->four_star_count = $four_star_count;
			$rating_std->four_star_percent = $four_star_percent;

			$rating_std->three_star_count = $three_star_count;
			$rating_std->three_star_percent = $three_star_percent;

			$rating_std->two_star_count = $two_star_count;
			$rating_std->two_star_percent = $two_star_percent;

			$rating_std->one_star_count = $one_star_count;
			$rating_std->one_star_percent = $one_star_percent;

			$rating_std->total_rating_count = $total_rating_count;
			$rating_std->total_rating_value = $total_rating_value;


			$obj[$i]->rating_details = $rating_std;	

		}


	}
			

}