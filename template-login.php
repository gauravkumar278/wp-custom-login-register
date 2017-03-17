<?php 
ob_start();
/*
*Template Name: Login Page
*/
?>
<?php
$post = $wp_query->post;

get_header(); 

if(is_user_logged_in()){
   wp_redirect(home_url( '/myaccount/' ));
}

$layout = 'fullwidth';



if(get_post_meta(waxom_get_id(), 'page_layout', true)) {

	$layout = get_post_meta(waxom_get_id(), 'page_layout', true);

}



$page_width = get_post_meta(waxom_get_id(), 'page_width', true);

if(!$page_width) $page_width = 'content';

$page_links = '';

?>



<div class="page-holder page-layout-<?php echo esc_attr($layout); ?>">

	

	<?php 

	

	// If Visual Composer is not enabled for the page

	if(!waxom_vc_active() || $layout == 'sidebar_right' || $layout == 'sidebar_left' || post_password_required(get_the_ID())) {

		echo '<div class="inner">';		

	}

	

	if($layout != "fullwidth" || $layout == 'fullwidth' && !waxom_vc_active() || post_password_required(get_the_ID())) {

		echo '<div class="page_inner">';

	}

	
 require_once TEMPLATEPATH .'/includes/login-action.php';
	?>
	<div class="row">
	  <div class="col-md-4 col-md-offset-4">
	  <h1>Login</h1>
	  <?php
	  if ( is_wp_error( $reg_errors ) ) {
 
			foreach ( $reg_errors->get_error_messages() as $error ) {
			 
				echo '<div style="color:red;">';
				echo '<strong>ERROR</strong>:';
				echo $error . '<br/>';
				echo '</div>';
				 
			}
		 
		}
     ?>
     <form class="form-horizontal" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
  <fieldset>
    <div class="form-group">
      <!-- Username -->
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="Username" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- Password-->
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
      </div>
    </div>

    <div class="form-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" name="login" class="btn btn-success">Login</button>
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>
   <?php	

	

	if($layout != "fullwidth" || $layout == 'fullwidth' && !waxom_vc_active() || post_password_required(get_the_ID())) {

		echo '</div>';		

	}

	

	if($layout != "fullwidth") {

		get_sidebar();    

	}



	if(!waxom_vc_active() || $layout == 'sidebar_right' || $layout == 'sidebar_left' || post_password_required(get_the_ID())) echo '</div>';

	

	if($page_links == 'yes') {

		wp_link_pages();

	}

	

	?>



</div>



<?php get_footer(); ?>