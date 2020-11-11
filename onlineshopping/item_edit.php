<?php 
	include 'backendheader.php';
	include 'db_connect.php';

	// get id from address bar
    $id = $_GET['cid'];

    // draw out the query from db
    $sql = "SELECT * FROM items WHERE id = :value1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
	  	<h1 class="h3 mb-4 text-gray-800">
	  		<i class="fas fa-dolly pr-3"></i> 
	  		Item 
	  	</h1>

		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col-10">
						<h4 class="m-0 font-weight-bold text-primary"> 
			            	Edit Existing Item 
			            </h4>
					</div>

					<div class="col-2">
						<a href="item_list.php" class="btn btn-outline-primary btn-block float-right"> 
		            		<i class="fa fa-backward pr-2"></i>	Go Back 
		            	</a>
					</div>
				</div>

	        </div>
	        <div class="card-body">
	            <form action="item_update.php" method="POST" enctype="multipart/form-data">

	            	<input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="codeno" value="<?= $row['codeno'] ?>">
                    <input type="hidden" name="oldphoto" value="<?= $row['photo'] ?>">


	            	<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Photo  </label>
				    	
				    	<div class="col-sm-10">
				      		<nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo</a>
                                    <a class="nav-link" id="newPhotoTab-tab" data-toggle="tab" href="#newPhotoTab" role="tab" aria-controls="newPhotoTab" aria-selected="false">New Photo </a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <img src="<?= $row['photo'] ?>" class="img-fluid">
                                </div>
                                <div class="tab-pane fade" id="newPhotoTab" role="tabpanel" aria-labelledby="newPhotoTab-tab">
                                    
                                    <input type="file" id="photo_id" name="newphoto">
                                    
                                </div>
                            </div>
				    	</div>
					</div>

					<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Name </label>
				    	
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="categoryName" placeholder="Enter Brand Name" name="name" value="<?= $row['name'] ?>">
				    	</div>
					</div>

					<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Price </label>
				    	
				    	<div class="col-sm-10">
				      		<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
							    	<a class="nav-item nav-link active" id="nav-price-tab" data-toggle="tab" href="#nav-price" role="tab" aria-controls="nav-price" aria-selected="true"> Unit Price </a>
							    	
							    	<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> Discount </a>
							  	</div>
							</nav>
							
							<div class="tab-content mt-3" id="nav-tabContent">
							  	<div class="tab-pane fade show active" id="nav-price" role="tabpanel" aria-labelledby="nav-price-tab">
							  		<input type="number" class="form-control" id="categoryName" placeholder="Enter Unit Price" name="unitprice" value="<?= $row['price'] ?>">
							  	</div>
							  	
							  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							  		<input type="text" class="form-control" id="categoryName" placeholder="Enter Discount Price" name="discount" value="<?= $row['discount'] ?>">
							  	</div>
							</div>
				    	</div>
					</div>

					<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Description </label>
				    	
				    	<div class="col-sm-10">
				      		<textarea class="form-control summernote" name="description"><?= $row['description'] ?></textarea>
				    	</div>
					</div>

					<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Brand </label>
				    	
				    	<div class="col-sm-10">
				      		<select class="form-control select2 form-control-lg" name="brand">
				      			<option> Choose Brand </option>
								
								<?php 
									$sql="SELECT * from brands ORDER BY name ASC";
						        	$stmt=$pdo->prepare($sql);
						        	$stmt->execute();
						        	$rows= $stmt->fetchAll();

						        	$i=1;
	        						foreach ($rows as $brand):

	        						$id = $brand['id'];
	        						$name = $brand['name']; 

								?>
									
										<option value="<?= $id; ?>" > 
											<?= $name; ?> 
										</option>

								<?php endforeach; ?>

				      		</select>
				    	</div>
					</div>

					<div class="form-group row">
						<label for="categoryName" class="col-sm-2 col-form-label"> Sub-category </label>
				    	
				    	<div class="col-sm-10">
				      		<select class="form-control select2 form-control-lg" name="category">
				      			<option> Choose Sub-category </option>
								
								<?php 
									$sql="SELECT * from subcategories ORDER BY name ASC";
						        	$stmt=$pdo->prepare($sql);
						        	$stmt->execute();
						        	$rows= $stmt->fetchAll();

						        	$i=1;
	        						foreach ($rows as $category):

	        						$id = $category['id'];
	        						$name = $category['name']; 

								?>
									
										<option value="<?= $id; ?>" <?php if(isset($categoryid) && $id == $categoryid ) echo "selected" ?> > 
											<?= $name; ?> 
										</option>

								<?php endforeach; ?>

				      		</select>
				    	</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-2"></div>
					    <div class="col-sm-10">
					      <button type="submit" class="btn btn-primary">
					      	<i class="fa fa-save"></i> Save
					      </button>
					    </div>
					</div>

				</form>

	        </div>
		</div>

	</div>
<!-- /.container-fluid -->

<?php 
	include 'backendfooter.php'; 
?>