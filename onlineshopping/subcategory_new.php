<?php 
	require('backendheader.php');
    require('db_connect.php');
?>
	<div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Subategory Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="subcategory_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <form action="subcategory_add.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Choose Category </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="categoryid">

                                    <?php 
                                        $sql = "SELECT * FROM categories";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();

                                        $rows = $stmt->fetchAll();

                                        // var_dump($rows);
                                        $i = 1;
                                        foreach ($rows as $row) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                        
                                    ?>

                                        <option value="<?= $id ?>"> <?= $name; ?> </option>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
	require('backendfooter.php');
?>