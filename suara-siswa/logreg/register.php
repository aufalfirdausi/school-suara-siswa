<?php
include ('../config/connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Pastikan semua pakai mysqli_
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Hash password biar lebih aman
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Cek apakah email sudah terdaftar
  $check = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
  if(mysqli_num_rows($check) > 0) {
    echo "Email sudah terdaftar!";
  } else {
    // Masukkan data baru ke tabel students
    $query = "INSERT INTO students (name, email, password)
              VALUES ('$name', '$email', '$hashed_password')";

    if(mysqli_query($conn, $query)) {
      echo "Registrasi berhasil! <a href='login.php'>Login</a>";
    } else {
      echo "Error: " . mysqli_error($conn);
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
      <h2>Registrasi Siswa</h2>
      <label for="">Name</label>
      <input type="text" name="name" required /><br />

      <label for="">Email</label>
      <input type="email" name="email" required /><br />

      <label for="">Password</label>
      <input type="password" name="password" required /><br />

      <button type="submit">Kirim</button>
    </form>
  </body>
</html>
