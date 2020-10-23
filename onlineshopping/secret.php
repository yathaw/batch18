<?php
	ob_start();

	require "frontendheader.php";
	
    if (!isset($_SESSION['login_user'])){
      	header("Location: login.php");
      	exit();
    }



?>
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Change Password </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">

		<div class="row justify-content-center">

        	<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 order-xl-2 order-lg-2 order-md-3 order-sm-3 order-3">

        		<?php if(isset($_SESSION['chpassword_fail'])){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  	<h2>  🚨 Oops! </h2>
				  	<hr>
				  	<p> <?= $_SESSION['chpassword_fail']; ?> </p>

				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
				  	</button>
				</div>

				<?php } unset($_SESSION['chpassword_fail']); ?>
		
				<!-- Shopping Cart Div -->
				<form action="changepassword.php" method="POST">
		            <fieldset>

		              	<div class="form-row">
		                	<div class="col-md-6">
		                    	<div class="form-group">
		                        	<label class="small mb-1" for="inputPassword"> Change Password </label>
		                        	<input class="form-control py-4" id="inputPassword" type="password" name="changepassword" />
                              		<font id="error" color="red"></font>

		                    	</div>
		                	</div>
		                	<div class="col-md-6">
		                    	<div class="form-group">
		                        	<label class="small mb-1" for="inputConfirmPassword"> Confirm Password </label>
		                        	<input class="form-control py-4" id="inputConfirmPassword" type="password" name="confirmpassword"/>
                              		<font id="cerror" color="red"></font>

		                    	</div>
		                	</div>
		              	</div>

		              	<div class="form-group">
		                	<label class="small mb-1" for="crpassword"> Current Password </label>
		                	<input class="form-control py-4" id="crpassword" type="password" name="currentpassword" />
		                	<small> (we need your current password to confirm your changes) </small>
		              	</div>

		              

		              	<div class="form-group hideForm d-flex align-items-center justify-content-between mt-4 mb-0">
		                	<button type="submit" class="btn btn-outline-primary"> Save </button>
		              	</div>
		            </fieldset>
		        </form>
		    </div>
		</div>
		

	</div>
	
<?php 
	require('frontendfooter.php');
?>