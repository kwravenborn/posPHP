<?php

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        header('location: index.php');
    }

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        try {
            $username = $_REQUEST['username'];
            $firstname = $_REQUEST['firstname'];
            $lastname = $_REQUEST['lastname'];
            $address = $_REQUEST['address'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $birthday = $_REQUEST['birthday'];
            $urole = $_REQUEST['urole'];

            $update_stmt = $conn->prepare("UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname, address = :address, phone = :phone, email = :email, birthday = :birthday, urole = :urole WHERE id = :id");
            $update_stmt->bindParam(':username', $name);
            $update_stmt->bindParam(':firstname', $firstname);
            $update_stmt->bindParam(':lastname', $lastname);
            $update_stmt->bindParam(':address', $address);
            $update_stmt->bindParam(':phone', $phone);
            $update_stmt->bindParam(':email', $email);
            $update_stmt->bindParam(':birthday', $birthday);
            $update_stmt->bindParam(':urole', $urole);
            $update_stmt->execute();
            header("location: admin_user.php");
            
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
    <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" aria-describebdy="username" value="<?php echo $row['username'];?>" placeholder="<?php echo $row['username'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="firstname" aria-describebdy="firstname" value="<?php echo $row['firstname'];?>" placeholder="<?php echo $row['firstname'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" aria-describebdy="lastname" value="<?php echo $row['lastname'];?>" placeholder="<?php echo $row['lastname'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" name="address" aria-describebdy="address" value="<?php echo $row['address'];?>" placeholder="<?php echo $row['address'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="phone" aria-describebdy="phone" value="<?php echo $row['phone'];?>" placeholder="<?php echo $row['phone'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="text" class="form-control" name="email" aria-describebdy="email" value="<?php echo $row['email'];?>" placeholder="<?php echo $row['email'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">วันเกิด</label>
                        <input type="date" class="form-control" name="birthday" aria-describebdy="birthday">
                    </div>
                    <div class="mb-3">
                        <label for="urole" class="form-label">ระดับสมาชิก</label>
                        <br>
                        <select name="urole">
                            <option value="Employee">พนักงาน</option>
                            <option value="Admin">แอดมิน</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" name="btn_update" class="btn btn-success" value="แก้ไขข้อมูล">
                        <a href="admin_user.php" class="btn btn-danger">ยกเลิก</a>
                    </div>
                </form>
    </div>
</body>
</html>