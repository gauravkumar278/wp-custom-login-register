<?php
if(isset($_POST['login'])){

//echo '<pre>'; print_r($_POST); echo '</pre>';
    global $reg_errors;
    $reg_errors = new WP_Error;
    
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	 // preparing credentials array
	$credentials = array();
	$credentials['user_login'] = trim($_POST['username']);
	$credentials['user_password'] = trim($_POST['password']);
	
	$user = get_user_by('login', $credentials['user_login']);
	
	 // auto login the user
	$users = wp_signon($credentials, false);
	
	if ( empty( $username ) || empty( $password ) ) {
       $reg_errors->add('field', 'All form fields are required.');
    }else if (!$user->ID) {
           $reg_errors->add('user_name','The username you have entered does not exist.');
    }else if (is_wp_error($users)) {
                $reg_errors->add('login','Username or Password is wrong.');
    } else {         
	   // Set the global user object
		$current_user = get_user_by( 'id', $users->data->ID );
		// set the WP login cookie
		$secure_cookie = is_ssl() ? true : false;
		wp_set_auth_cookie( $users->data->ID, true, $secure_cookie );

		wp_redirect( home_url( '/myaccount/' ) );
		exit();    
    }

}
?>