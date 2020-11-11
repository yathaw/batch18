<?php

	include 'frontendheader.php';

	$itid = $_GET['id'];


	// Item
	$sql = "SELECT items.*, brands.name as bname, categories.name as cname, subcategories.name as sname, subcategories.id as sid
			FROM items 
			LEFT JOIN brands
        	ON items.brand_id = brands.id
        	LEFT JOIN subcategories
        	ON items.subcategory_id = subcategories.id
        	LEFT JOIN categories
        	ON subcategories.category_id = categories.id
			WHERE items.id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$itid);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    $itname = $item['name'];
    $itphotos = $item['photo'];
    $itcodeno = $item['codeno'];
    $itprice = $item['price'];
    $itdiscount = $item['discount'];
    $itdescription = $item['description'];

    $itphotos_arr = explode("|",$itphotos);
	$itphoto = $itphotos_arr[0];

    $bname = $item['bname'];
    $sname = $item['sname'];
    $cname = $item['cname'];
    $sid = $item['sid'];
    // ----------------------------------

    // Related Item
    $rsql = "SELECT * FROM items 
    		WHERE subcategory_id=$sid ORDER BY rand() limit 4";
    $rstmt = $conn->prepare($rsql);
    $rstmt->execute();

    $ritems = $rstmt->fetchAll();
    // ----------------------------------


?>


	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> <?= $itcodeno ?> </h1>
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
				<img src="<?= $itphoto ?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?= $itname ?> </h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<p>
					<?= $itdescription ?>
				</p>

				<p> 
					<span class="text-uppercase "> Current Price : </span>

					<?php if($itdiscount):?>

			        	<span class="maincolor ml-3 font-weight-bolder"><?= $itdiscount ?> Ks</span>
			        	<strike> <?= $itprice ?> Ks </strike> 


			       	<?php else: ?>
			        	<span class="maincolor ml-3 font-weight-bolder"><?= $itprice ?> Ks</span>

					<?php endif ?>
				</p>

				<p> 
					<span class="text-uppercase "> Brand : </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"> <?= $bname; ?> </a> </span>
				</p>


				<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $itid ?>"
										data-name="<?= $itname; ?>" data-photo="<?= $itphoto; ?>" data-codeno="<?= $itcodeno; ?>" data-price="<?= $itprice; ?>" data-discount="<?= $itdiscount; ?>">
					<i class="icofont-shopping-cart mr-2"></i> Add to Cart
				</a>
				
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			
			<?php 
				foreach ($ritems as $ritem):
			    $ritid = $ritem['id'];
			    $ritphotos = $ritem['photo'];

			    $ritphotos_arr = explode("|",$ritphotos);
				$ritphoto = $ritphotos_arr[0];


			?>
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="detail.php?id=<?= $ritid ?>">
					<img src="<?= $ritphoto ?>" class="img-fluid" style="height: 150px; object-fit: cover;">
				</a>
			</div>

			<?php endforeach; ?>

			
		</div>

		
	</div>

<?php  
	include ('frontendfooter.php');
?>