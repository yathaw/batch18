<?php
	ob_start();

	require "frontendheader.php";
    
    if (!isset($_SESSION['login_user'])){
      	header("Location: login.php");
      	exit();
    }

    



    $id = $_SESSION['login_user']['id'];

    $sql = "SELECT * FROM users WHERE id = :value1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $row['name'];
    $profile = $row['profile'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $status = $row['status'];
    $password = $row['password'];


?>
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Profile </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
		<form action="profile_update.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">

            	<input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="oldphoto" value="<?= $profile; ?>">
                <input type="hidden" name="status" value="<?= $status; ?>">
                <input type="hidden" name="password" value="<?= $password; ?>">


                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 order-1 align-items-center justify-content-between">
                    <div class="avatar-upload">
                        <div class="avatar-edit">

                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="newphoto" disabled="" data-user_id = "<?= $id ?>" value="<?= $profile; ?>" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('<?= $profile; ?>');">
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 order-xl-2 order-lg-2 order-md-3 order-sm-3 order-3">
                    
                        <fieldset disabled>
                            <?php if(isset($_SESSION['profile_msg'])) { ?>
                                <h6 class="text-success"> <?= $_SESSION['profile_msg'] ?> </h6>
                            <?php } ?>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputName"> Name</label>
                                        <input class="form-control py-4" id="inputName" type="text" placeholder="Enter Name" name="name" value="<?= $name ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="phone">Phone Number</label>
                                        <input class="form-control py-4" id="phone" type="text" placeholder="Enter Phone Number" name="phone" value="<?= $phone ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" value="<?= $email ?>"/>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label class="small mb-1" for="address"> Address </label>
                                <textarea class="form-control" name="address"><?= $address ?></textarea>
                            </div>

                            <div class="form-group hideForm d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-outline-primary"> Save </button>
                            </div>
                        </fieldset>
                    
                </div>
                
                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12 order-xl-3 order-lg-3 order-md-2 order-sm-2 order-2">
                    <button class="btn btn-warning float-right profile_editBtn" type="button"> 
                        <i class="icofont-ui-settings"></i>
                    </button>
                    <button class="btn btn-danger float-right profile_cancelBtn" type="button"> 
                        <i class="icofont-close-line"></i>
                    </button>
                </div>
            </div>
        </form>
		

	</div>
	
<?php 
	require('frontendfooter.php');
?>