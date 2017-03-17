<?php 
/*
*Template Name: Login Page
*/

get_header(); 
?>



<div class="page-holder page-layout">
<?php require_once TEMPLATEPATH .'/includes/login-action.php'; ?>
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
</div>



<?php get_footer(); ?>