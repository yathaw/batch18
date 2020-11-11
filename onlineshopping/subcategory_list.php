<?php 
	require('backendheader.php');
	require('db_connect.php');
?>
	<div class="app-title">
	    <div>
	        <h1> <i class="icofont-list"></i> Subcategory </h1>
	    </div>
	    <ul class="app-breadcrumb breadcrumb side">
	        <a href="subcategory_new.php" class="btn btn-outline-primary">
	            <i class="icofont-plus"></i>
	        </a>
	    </ul>
	</div>

	<div class="row">
	    <div class="col-md-12">
	        <div class="tile">
	            <div class="tile-body">
	                <div class="table-responsive">
	                    <table class="table table-hover table-bordered" id="sampleTable">
	                        <thead>
	                            <tr>
	                              <th>#</th>
	                              <th>Name</th>
	                              <th> Category </th>
	                              <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>

	                        	<?php 
	                        		$sql = "SELECT *  FROM subcategories";

	                        		$sql = "SELECT subcategories.*, 
	                        				categories.id as cid,
	                        				categories.name as cname 
	                        				FROM subcategories
	                        				INNER JOIN categories ON 
	                        				subcategories.category_id = categories.id

	                        				";
	                        		$stmt = $conn->prepare($sql);
	                        		$stmt->execute();

	                        		$rows = $stmt->fetchAll();

	                        		// var_dump($rows);
	                        		$i = 1;
	                        		foreach ($rows as $row) {
	                        			$id = $row['id'];
	                        			$name = $row['name'];

	                        			$categoryid = $row['category_id'];
	                        			$categoryname = $row['cname'];
	                        		
	                        	?>

	                            <tr>
	                                <td> <?php echo $i++ ?>. </td>
	                                <td> <?= $name ?> </td>
	                                <td> <?= $categoryname ?> </td>
	                                <td>
	                                    <a href="subcategory_edit.php?cid=<?= $id ?>" class="btn btn-warning">
	                                        <i class="icofont-ui-settings"></i>
	                                    </a>

	                                    <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" method="POST" action="subcategory_delete.php">

	                                    	<input type="hidden" name="id" value="<?= $id ?>">

	                                    	<button class="btn btn-outline-danger">
	                                    		<i class="icofont-close"></i>
	                                    	</button>

	                                    </form>
	                                </td>

	                            </tr>

	                            <?php } ?>


	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

<?php 
	require('backendfooter.php');
?>