<?php

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        header('location: index.php');
    }

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $conn->prepare('SELECT * FROM products WHERE id = :id');
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        try {
            $name = $_REQUEST['name'];
            $description = $_REQUEST['description'];
            $type = $_REQUEST['type'];
            $price = $_REQUEST['price'];
            $amount = $_REQUEST['amount'];
            $status = $_REQUEST['status'];

            $update_stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, type = :type, price = :price, amount = :amount, status = :status WHERE id = :id");
            $update_stmt->bindParam(':name', $name);
            $update_stmt->bindParam(':description', $description);
            $update_stmt->bindParam(':type', $type);
            $update_stmt->bindParam(':price', $price);
            $update_stmt->bindParam(':amount', $amount);
            $update_stmt->bindParam(':status', $status);
            $update_stmt->bindParam(':id', $id);
            $update_stmt->execute();

            header("location: admin_product.php");
            
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br>
    <form action="" method="POST">
    <h2 style="text-align:center">แก้ไขข้อมูลสินค้า</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label">ชื่อสินค้า</label>
                        <input type="text" class="form-control" name="name" aria-describebdy="name" value="<?php echo $row['name'];?>" placeholder="<?php echo $row['name'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">คำอธิบาย</label>
                        <input type="text" class="form-control" name="description" aria-describebdy="description" value="<?php echo $row['description'];?>" placeholder="<?php echo $row['description'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">ประเภท</label>
                        <input type="text" class="form-control" name="type" aria-describebdy="type" value="<?php echo $row['type'];?>" placeholder="<?php echo $row['type'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">ราคา</label>
                        <input type="text" class="form-control" name="price" aria-describebdy="price" value="<?php echo $row['price'];?>" placeholder="<?php echo $row['price'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">จำนวนที่เหลือ</label>
                        <input type="text" class="form-control" name="amount" aria-describebdy="amount" value="<?php echo $row['amount'];?>" placeholder="<?php echo $row['amount'];?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">สถานะ</label>
                        <input type="text" class="form-control" name="status" aria-describebdy="status" value="<?php echo $row['status'];?>" placeholder="<?php echo $row['status'];?>" readonly>
                    </div>
                    <div>
                        <input type="submit" name="btn_update" class="btn btn-success" value="แก้ไขข้อมูล">
                        <a href="admin_product.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
    </div>
</body>
</html>