<?php

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        header('location: index.php');
    }

    if (isset($_POST['edituser'])) {

        $id = $_POST['edituser'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $Uname = $row['username'];
        $Fname = $row['firstname'];
        $Lname = $row['lastname'];
        $Add = $row['address'];
        $Phone = $row['phone'];
        $Email = $row['email'];
        $Bday = $row['birthday'];
        $Pword = $row['password'];
        $Urole = $row['urole'];
    }

    if (isset($_POST['updateuser'])) {

        $uname = $_POST['username'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $add = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $bday = $_POST['birthday'];
        $pword = $_POST['password'];
        $urole = $_POST['urole'];

    }
?>