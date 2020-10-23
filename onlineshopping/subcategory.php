<?php 
	require('frontendheader.php');

	$sid = $_GET['id'];

	// Item
		$sql = "SELECT items.*, subcategories.name as sname 
				FROM items 
				LEFT JOIN subcategories
	        	ON items.subcategory_id = subcategories.id
				WHERE subcategory_id =:id ORDER BY name ASC";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':id',$sid);
	    $stmt->execute();
	    $items = $stmt->fetchAll();
    // ----------------------------------

    // Subcategory
	    $sql = "SELECT subcategories.*, categories.name as cname, categories.id as cid 
	    		FROM subcategories
	    		LEFT JOIN categories
	    		ON subcategories.category_id = categories.id
	    		WHERE subcategories.id =:id
	    		ORDER BY name ASC";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':id',$sid);
	    $stmt->execute();
	    $subcategory = $stmt->fetch(PDO::FETCH_ASSOC);

	    $sname = $subcategory['name'];
	    $cid = $subcategory['cid'];
	    $cname = $subcategory['cname'];
    // ----------------------------------

	// Subcategories
	    $sql = "SELECT subcategories.*, categories.name as cname, categories.id as cid 
	    		FROM subcategories
	    		LEFT JOIN categories
	    		ON subcategories.category_id = categories.id
	    		WHERE subcategories.category_id =:id
	    		ORDER BY name ASC";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':id',$cid);
	    $stmt->execute();
	    $subcategories = $stmt->fetchAll();


    // ----------------------------------
?>
	
		<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> 
    			<?= $sname; ?>
    		</h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category </a>
		    	</li>
		    	<li class="breadcrumb-item text-muted">
		    		<?= $cname; ?>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
    				<?= $sname; ?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<ul class="list-group">
					
					<?php 
						foreach ($subcategories as $sub):
						$subid = $sub['id'];
						$subname = $sub['name'];

					?>

				  	<li class="list-group-item <?php if($subid == $sid) echo "active" ?>">
				  		<a href="subcategory.php?id=<?= $subid ?>" class="text-decoration-none secondarycolor"> <?= $subname ?> </a>
				  	</li>

				  <?php endforeach; ?>
				  	
				</ul>
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

				<div class="row">
					<?php 

					if($items):

					foreach($items as $item):
					    $itid = $item['id'];
				        $itname = $item['name'];
				        $itphotos = $item['photo'];
				        $itcodeno = $item['codeno'];
				        $itprice = $item['price'];
				        $itdiscount = $item['discount'];

				        $itphotos_arr = explode("|",$itphotos);
						$itphoto = $itphotos_arr[0];
					?>
					
					<a href="detail.php?id=<?= $itid ?>" class="text-decoration-none text-secondary">
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
							<div class="card pad15 mb-3">
							  	<img src="<?= $itphoto ?>" class="card-img-top" alt="...">
							  	
							  	<div class="card-body text-center">
							    	<h5 class="card-title text-truncate">
							    		<?= $itname; ?>
							    	</h5>
							    	
							    	<p class="item-price">
			                        	<?php if($itdiscount):?>

							        	<strike> <?= $itprice ?> Ks </strike> 
							        	<span class="d-block"><?= $itdiscount ?> Ks</span>

							        	<?php else: ?>
							        	<span class="d-block"><?= $itprice ?> Ks</span>

										<?php endif ?>
			                        </p>

			                        <div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
											<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
										</ul>
									</div>

									<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $itid ?>"
										data-name="<?= $itname; ?>" data-photo="<?= $itphoto; ?>" data-codeno="<?= $itcodeno; ?>" data-price="<?= $itprice; ?>" data-discount="<?= $itdiscount; ?>">Add to Cart</a>
							  	</div>
							</div>
						</div>
					</a>

					<?php 
						endforeach; 
						else:
					?>

					<div class="col-12">
						<img src="frontend/image/no_products_found.png" class="img-fluid mx-auto d-block">
					</div>

					<?php endif; ?>

				</div>


				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end">
					    <li class="page-item disabled">
					      	<a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="icofont-rounded-left"></i>
					      	</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">1</a>
					    </li>
					    <li class="page-item active">
					    	<a class="page-link" href="#">2</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">3</a>
					    </li>
					    <li class="page-item">
					      	<a class="page-link" href="#">
					      		<i class="icofont-rounded-right"></i>
					      	</a>
					    </li>
					</ul>
				</nav>
			</div>
		</div>

		
	</div>

<?php 
	require('frontendfooter.php');
?>

