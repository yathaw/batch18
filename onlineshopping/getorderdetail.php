<?php 
		
	require ("db_connect.php");
	
	$orderid = $_POST['id'];

	$sql = "SELECT * FROM item_order
    		INNER JOIN items
    		ON item_order.item_id = items.id
    		WHERE item_order.order_id = :value1";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1',$orderid);
    $stmt->execute();
    $orderdetails = $stmt->fetchAll();

	echo json_encode($orderdetails);


?>