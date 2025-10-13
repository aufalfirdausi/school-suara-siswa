<?php

include ('../config/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysql_real_escape_string($conn, $_POST['name']);
  $email = mysql_real_escape_string($conn, $_POST('email'));
  $password = mysql_real_escape_string($conn, $_POST['password']);

  //untuk hash passord biar lebih aman
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  //ngecek email kalo udah terdaftar/ada
  $check = mysql_query($conn, "SELECT * FROM students WHERE email='$email'");
  if(mysql_num_rows($check) > 0) {
    echo "email sudah terdaftar";
  } else {
    $query = "INSERT INTO students (name, email, password)
              VALUE ('$name', '$email', '$hashed_password')";
      if(mysql_query($conn, $query)) {
        echo "registrasi berhasil <a herf='login.php'>Login</a>";
      } else {
        echo "Error: " . mysql_error($conn);
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
  </head>
  <body>
    <form action="" method="post">
      <h2>Registrasi siswa</h2>
      <label for="">Name</label>
      <input type="text" name="name" required /><br />
      <label for="">Email</label>
      <input type="email" name="email" required /><br />
      <label for="">Password</label>
      <input type="password" name="password" required /><br />
      <button type="submit">kirim</button>
    </form>
  </body>
</html>
