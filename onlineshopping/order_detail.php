<?php 
	
	require 'db_connect.php';
    include('backendheader.php');

    // get the id from address bar
    $voucherno = $_GET['voucherno'];

    // draw out the query from db 
    $sql ="SELECT orders.*,
    				users.name as uname, 
    				users.address as uaddress,
    				users.phone as uphone,
    				users.email as uemail
    		FROM orders
    		INNER JOIN users
    		ON orders.user_id = users.id 
    		WHERE orders.voucherno= :voucherno";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':voucherno', $voucherno);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM item_order
    		INNER JOIN items
    		ON item_order.item_id = items.id
    		WHERE item_order.order_id = :value1";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1',$order['id']);
    $stmt->execute();
    $orderdetails = $stmt->fetchAll();

?>
	
	<!-- main content -->
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Invoice</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="order_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <section class="invoice">
	              	<div class="row mb-4">
	                	<div class="col-6">
	                  		<img src="logo/logo_med.jpg" class="img-fluid">
	                	</div>
	                	<div class="col-6">
	                  		<h5 class="text-right">Date:
	                  			<?= $order['orderdate']; ?>
	                  		</h5>
	                	</div>
	              	</div>
          
		            <div class="row invoice-info">
		                <div class="col-4">From
		                  	<address><strong>Shopules Inc.</strong><br>518 Akshar Avenue<br>Gandhi Marg<br>New Delhi<br>Email: <?= $_SESSION['login_user']['email']; ?></address>
		                </div>
		                <div class="col-4">To
		                  	<address>
		                  		<strong> <?= $order['uname']; ?> 
		                  		</strong><br>
		                  		<?= $order['uaddress'];  ?> <br>
		                  		Email: <?= $order['uemail']; ?> </address>
		                </div>
		                <div class="col-4"><b>Invoice #<?= $order['voucherno']; ?>
		                </b><br><br>
		                <b>Total:</b> <?= $order['total']; ?> </div>
		            </div>
		            <div class="row">
		                <div class="col-12 table-responsive">
			                <table class="table table-striped">
			                    <thead>
			                      	<tr>
			                        	<th> Qty </th>
			                        	<th> Product </th>
			                        	<th> Serial # </th>
			                        	<th> Unit Price </th>

			                        	<th>Subtotal</th>
			                      	</tr>
			                    </thead>
			                    <tbody>

			                    <?php 
			                    	foreach ($orderdetails as $orderdetail):

			                    	$qty = $orderdetail['qty'];
			                    	$name = $orderdetail['name'];
			                    	$codeno = $orderdetail['codeno'];

			                    	$unitprice = $orderdetail['price'];
			                    	$discount = $orderdetail['discount'];

			                    	if ($discount) {
			                    		$price = $discount;
			                    	}
			                    	else{
			                    		$price = $unitprice;
			                    	}

			                    	$subtotal = $qty * $price;

			                    ?>

								<tr>
									<td> <?= $qty ?> </td>
									<td> <?= $name ?> </td>
									<td> <?= $codeno ?> </td>
									<td> <?= $price ?> </td>
									<td> <?= $subtotal ?> </td>

								</tr>

			                	<?php endforeach; ?>
			                    	
			                    </tbody>
			                </table>
		                </div>
		            </div>
          <div class="row d-print-none mt-2">
            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
          </div>
        </section>
            </div>
        </div>
    </div>

<?php
   require('backendfooter.php');
?>