<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        header('location: index.php');
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
                            <a href="#" class="nav-link active" aria-current="page">
                                <i data-feather="package"></i>
                                <span class="ml-2">ข้อมูลสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <i data-feather="list"></i>
                                <span class="ml-2">ข้อมูลประเภทสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
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
                <h1 class="h2">รายชื่อลูกค้า</h1>

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
                                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
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