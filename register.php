<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['Password']); // corrected the input password field
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];

    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if ($result && $result->num_rows == 0) {
            $sql = "INSERT INTO user (Uuserid, username, Password, email, namalengkap, alamat)
                    VALUES ('$userid', '$username', '$password', '$email', '$namalengkap', '$alamat')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $userid = isset($userid) ? $userid : '';
                $username = "";
                $email = "";
                $_POST['Password'] = ""; // corrected the input password field
                $_POST['cpassword'] = "";
                $namalengkap = "";
                $alamat = ""; // corrected the variable name
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
</head>
<body>
    <!-- Your body content here -->
</body>
</html>
