<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        header('location: index.php');
    }

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $conn->prepare('SELECT * FROM customers WHERE id = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        
        $delete_stmt = $conn->prepare('DELETE FROM customers WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("location: admin_customer.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>
<body>

    <!-- start เมนูข้างบน -->
    <nav class="navbar navbar-light p-3" style="background-color: #85bdff;">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a href="" class="navbar-brand">POS SHOP</a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle Navigation">
              <span class="navbar-toggler-icon"></span>  
            </button>
        </div>

        <div class="col-12 col-md-4 col-lg-2">
            <input type="text" class="form-control form-control-dark" placeholder="Search" aria-label="Search">
        </div>

        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn" type="button">
                    <a href="logout.php" class="dropdown-item">Logout <i data-feather="log-out"></i></a>                    
                </button>
            </div>
        </div>
    </nav>
    <!-- end เมนูข้างบน -->
    <!-- The Modal เพิ่มข้อมูล -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มข้อมูลพนักงาน</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="admin_add_customer.php" method="POST">
                    <?php if(isset($_SESSION['error'])) { ?>
                         <div class="alert alert-danger" role="alert">
                             <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                             ?>
                         </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success'])) { ?>
                         <div class="alert alert-success" role="alert">
                             <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                             ?>
                         </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['warning'])) { ?>
                         <div class="alert alert-warning" role="alert">
                             <?php 
                                echo $_SESSION['warning'];
                                unset($_SESSION['warning']);
                             ?>
                         </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" name="firstname" aria-describebdy="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" aria-describebdy="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <input type="text" class="form-control" name="address" aria-describebdy="address">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="phone" aria-describebdy="phone">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="text" class="form-control" name="email" aria-describebdy="email">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">วันเกิด</label>
                        <input type="date" class="form-control" name="birthday" aria-describebdy="birthday">
                    </div>
                                <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" name="addcustomer" class="btn btn-success" value="เพิ่มข้อมูล">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collpase" style="background-color: #B7D8FF;">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link active" aria-current="page">
                                <i data-feather="home"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_user.php" class="nav-link active" aria-current="page">
                                <i data-feather="user"></i>
                                <span class="ml-2">ข้อมูลพนักงาน</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <i data-feather="users"></i>
                                <span class="ml-2">ข้อมูลลูกค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_product.php" class="nav-link active" aria-current="page">
                                <i data-feather="package"></i>
                                <span class="ml-2">ข้อมูลสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_stock.php" class="nav-link active" aria-current="page">
                                <i data-feather="archive"></i>
                                <span class="ml-2">ข้อมูล Stock สินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_order.php" class="nav-link active" aria-current="page">
                                <i data-feather="bar-chart-2"></i>
                                <span class="ml-2">ข้อมูลการขาย</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Customers</li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <h1 class="h2">รายชื่อลูกค้า
                <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">เพิ่มข้อมูล <i data-feather="plus"></i></a>
                </h1>
                <div class="row">
                    <div class="col-12 col-xl-20 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Customers List</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">ชื่อ</th>
                                                <th scope="col">นามสกุล</th>
                                                <th scope="col">ที่อยู่</th>
                                                <th scope="col">เบอร์โทรศัพท์</th>
                                                <th scope="col">อีเมล</th>
                                                <th scope="col">วันเกิด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $check_data = $conn->prepare("SELECT * FROM customers");
                                                $check_data->execute();
                                                
                                                while ($row = $check_data->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['id']; ?></th>
                                                    <td><?php echo $row['firstname']; ?></td>
                                                    <td><?php echo $row['lastname']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['birthday']; ?></td>
                                                    <td><a href="admin_edit_customer.php?update_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a></td>
                                                    <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" >Delete</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="" class="btn btn-block btn-light">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>feather.replace()</script>


</body>
</html>