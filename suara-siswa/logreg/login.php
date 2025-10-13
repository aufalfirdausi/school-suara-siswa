<?php

session_start();
include ('../config/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = mysql_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];

  //cek di table students
  $query_student = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");

  //cek di table admins
  $query_admin = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");


  if(mysqli_num_rows($query_student) > 0) {
    $user = mysqli_fetch_assoc($query_student);
    if(password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id_student'];
      $_SESSION['role'] = 'student';
      header("Location: ../students/dashboard.php");
      exit;
    } else {
      echo "password mu salah";
    }
  } elseif(mysqli_num_rows($query_admin) > 0) {
    $admin = mysqli_fetch_assoc($query_admin);
    if (password_verify($password, $admin['password'])) {
     $_SESSION['user_id'] = $admin['id_admin'];
     $_SESSION['role'] = $admin['role'];
     header("Location: ../admins/dashboard.php");
     exit;
  } else {
    echo "password mu salah";
  }
} else {
  echo "user tidak ditemukan"; 
} 
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <form action="" method="post">
      <h2>Login</h2>
      <label for="">Email</label>
      <input type="email" name="email" required /><br />
      <label for="">Passrord</label>
      <input type="password" name="password" required /><br />
      <button type="submit">Login</button>
    </form>
  </body>
</html>
