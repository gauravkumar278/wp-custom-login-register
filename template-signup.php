<?php
/*
*Template Name: Sign Up Page
*/

get_header(); 
?>
<div class="page-holder page-layout">
<?php require_once TEMPLATEPATH .'/includes/signup-action.php'; ?>
	<div class="row">
	  <div class="col-md-4 col-md-offset-4">
	  <h1>Sign Up</h1>
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
	  <select name="usertype" class="form-control">
		  <option value="landlord" <?php if(isset($_POST['usertype']) && $_POST['usertype'] == 'landlord'){ echo 'selected="selected"'; } ?>>I'm a Landlord</option>
		  <option value="tenant" <?php if(isset($_POST['usertype']) && $_POST['usertype'] == 'tenant'){ echo 'selected="selected"'; } ?>>I'm a Tenant</option>
		  <option value="seller" <?php if(isset($_POST['usertype']) && $_POST['usertype'] == 'seller'){ echo 'selected="selected"'; } ?>>I'm a Seller</option>
	  </select>
  </div>
    <div class="form-group">
      <!-- Username -->
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){ echo trim($_POST['username']); } ?>" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- E-mail -->
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])){ echo trim($_POST['email']); } ?>" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- Password-->
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="Password" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- Password -->
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" name="register" class="btn btn-success">Register</button>
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>
</div>
<?php get_footer(); ?>