<?php
if(isset($_POST['register'])){

    global $reg_errors;
    $reg_errors = new WP_Error;
    
	$username = trim($_POST['username']);
	$usertype = $_POST['usertype'];
	$password = trim($_POST['password']);
	$cnfpass  = trim($_POST['password_confirm']);
	$email    = trim($_POST['email']);
	
	
	if ( empty( $username ) || empty( $password ) || empty( $email ) || empty( $name ) ) {
       $reg_errors->add('field', 'All form fields are required.');
    }
    
	if ( username_exists( $username ) ) {
       $reg_errors->add('user_name', 'Sorry, that username already exists!');
	}
	
	if ( ! validate_username( $username ) ) {
       $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
    }
	
	if ( !is_email( $email ) ) {
      $reg_errors->add( 'email_invalid', 'Email is not valid' );
    }
	
	if ( email_exists( $email ) ) {
      $reg_errors->add( 'email', 'Email Already in use' );
    }
	
	if ( $password != $cnfpass ) {
      $reg_errors->add( 'password', 'Password is mismatch.' );
    }
	
	 if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'nickname'      =>   $username,
		'display_name'  =>   $username,
		'role'          =>   $usertype
        );
        $user_id = wp_insert_user( $userdata );
		
		$to = get_option('admin_email');
		// using content type html for emails
        $headers = array('Content-Type: text/html; charset=UTF-8');
		
		 //Make body of admin message
        $userprofile.= '<br><strong>' . __('Username : ') . '</strong>' . $userdata['user_login'];
        $userprofile.= '<br><strong>' . __('Email : ') . '</strong>' . $userdata['user_email'];
        $userprofile.='<br><strong>' . __('Password :') . '</strong>' . __(' As choosen at time of registration');
		
		$message = sprintf(__('A new user has registered on %s with following details:'), get_option('blogname'));
		
		$footer  = '<br><br>' . __('Thanks.');

        $body    = $message . $userprofile . $footer;
		
		$subject = get_option('blogname') . ' | New user registered';
		
		wp_mail($to, $subject, $body, $headers);
		// Set the global user object
        $current_user = get_user_by( 'id', $user_id );
		// set the WP login cookie
		$secure_cookie = is_ssl() ? true : false;
		wp_set_auth_cookie( $user_id, true, $secure_cookie );

		wp_redirect( home_url() );
		exit();    
    }
}
?>