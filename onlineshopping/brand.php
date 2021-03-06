<?php

	require('frontendheader.php');

	$bid = $_GET['id'];

	// Brand
		$sql = "SELECT * FROM brands
				WHERE id =:id ORDER BY name ASC";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':id',$bid);
	    $stmt->execute();
	    $brand = $stmt->fetch(PDO::FETCH_ASSOC);
    // ----------------------------------


	// Item
		$sql = "SELECT items.*, brands.name as bname
				FROM items 
				LEFT JOIN brands
	        	ON items.brand_id = brands.id
				WHERE brand_id =:id ORDER BY name ASC";
	    $stmt = $conn->prepare($sql);
	    $stmt->bindParam(':id',$bid);
	    $stmt->execute();
	    $items = $stmt->fetchAll();
    // ----------------------------------
?>

	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> 
    			<?= $brand['name']; ?> 
    		</h1>
  		</div>
	</div>

		<!-- Content -->
	<div class="container mt-5">


		<div class="row">
            <div class="col">
                <div class="bbb_viewed_title_container">
                    <h3 class="bbb_viewed_title"> <?= $brand['name']; ?>'s Product  </h3>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
                <?php if ($items): ?>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">
						<?php 
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
					    <div class="owl-item">
					        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
					        	<a href="detail.php?id=<?= $itid ?>" class="text-decoration-none text-secondary">
						            <div class="pad15">
						        		<img src="<?= $itphoto ?>" class="img-fluid" style="height: 150px; object-fit: cover;">
						            	<p > 
						            		<?= substr($itname, 0, 7) . '...'; ?>  
						            	</p>
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

										<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" 
										data-id="<?= $itid ?>"
										data-name="<?= $itname; ?>" data-photo="<?= $itphoto; ?>" data-codeno="<?= $itcodeno; ?>" data-price="<?= $itprice; ?>" data-discount="<?= $itdiscount; ?>" >Add to Cart</a>
						        	</div>
						        </a>
					        </div>
					    </div>

					<?php endforeach;?>
					</div>
                </div>
				
				<?php else: ?>
                <div class="col-12">
					<img src="frontend/image/no_products_found.png" class="img-fluid mx-auto d-block">
				</div>

				<?php endif; ?>
            </div>
        </div>

	</div>


<?php 
	require('frontendfooter.php');
?>