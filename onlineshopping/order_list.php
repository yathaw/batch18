<?php
    require 'db_connect.php';
    include('backendheader.php');

    $pending = "Order";
    $confirm = "Confirm";
    $cancel = "Delete";


    $sql = "SELECT * FROM orders WHERE status = :value1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $pending);
    $stmt->execute();
    $pending_orders = $stmt->fetchAll();

    $sql = "SELECT * FROM orders WHERE status = :value1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $confirm);
    $stmt->execute();
    $confirm_orders = $stmt->fetchAll();

    $sql = "SELECT * FROM orders WHERE status = :value1 ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $cancel);
    $stmt->execute();
    $cancel_orders = $stmt->fetchAll();
?>


    <!-- main content -->
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Order </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true"> Order - Pending </a>
                            <a class="nav-link" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false"> Order - Confirm </a>
                            <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false"> Order - Cancel </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active py-4" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display" >
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Date </th>
                                            <th> Voucher No </th>
                                            <th> Total </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($pending_orders as $pending_order):

                                            $id = $pending_order['id'];
                                            $orderdate = $pending_order['orderdate'];
                                            $voucherno = $pending_order['voucherno'];
                                            $total = $pending_order['total'];
                                            $status = $pending_order['status']; 

                                        ?>
                                        <tr>
                                            <td> <?php echo $i++; ?>. </td>
                                            <td> <?= $orderdate; ?> </td>
                                            <td> <?= $voucherno; ?> </td>
                                            <td> <?= $total; ?> </td>
                                            <th> <?= $status ?> </th>
                                            <td>
                                                <a href="order_detail.php?voucherno=<?= $voucherno ?> " class="btn btn-outline-info">
                                                    <i class="icofont-info"></i>
                                                </a>
                                                
                                                <a href="order_confirm.php?id=<?= $id ?> " class="btn btn-outline-success">
                                                    <i class="icofont-ui-check"></i>
                                                </a>

                                                <a href="order_delete.php?id=<?= $id ?> " class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        
                        <div class="tab-pane fade py-4" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Date </th>
                                            <th> Voucher No </th>
                                            <th> Total </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($confirm_orders as $confirm_order):

                                            $id = $confirm_order['id'];
                                            $orderdate = $confirm_order['orderdate'];
                                            $voucherno = $confirm_order['voucherno'];
                                            $total = $confirm_order['total'];
                                            $status = $confirm_order['status']; 

                                        ?>
                                        <tr>
                                            <td> <?php echo $i++; ?>. </td>
                                            <td> <?= $orderdate; ?> </td>
                                            <td> <?= $voucherno; ?> </td>
                                            <td> <?= $total; ?> </td>
                                            <th> <?= $status ?> </th>
                                            <td>
                                                <a href="order_detail.php?voucherno=<?= $voucherno ?> " class="btn btn-outline-info">
                                                    <i class="icofont-info"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                        <div class="tab-pane fade py-4" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered display">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Date </th>
                                            <th> Voucher No </th>
                                            <th> Total </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($cancel_orders as $cancel_order):

                                            $id = $cancel_order['id'];
                                            $orderdate = $cancel_order['orderdate'];
                                            $voucherno = $cancel_order['voucherno'];
                                            $total = $cancel_order['total'];
                                            $status = $cancel_order['status']; 

                                        ?>
                                        <tr>
                                            <td> <?php echo $i++; ?>. </td>
                                            <td> <?= $orderdate; ?> </td>
                                            <td> <?= $voucherno; ?> </td>
                                            <td> <?= $total; ?> </td>
                                            <th> <?= $status ?> </th>
                                            <td>
                                                <a href="order_detail.php?voucherno=<?= $voucherno ?> " class="btn btn-outline-info">
                                                    <i class="icofont-info"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

<?php
   require('backendfooter.php');
?>