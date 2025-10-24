<?php
session_start();
include('../config/connection.php');

// Pastikan user sudah login dan rolenya student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
  header("Location: ../logreg/login.php");
  exit;
}

// Ambil ID student dari session
$id_student = $_SESSION['user_id'];

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  // Simpan ke database
  $query = "INSERT INTO aspirations (id_student, title, content, status)
            VALUES ('$id_student', '$title', '$content', 'Pending')";

  if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Aspirasi berhasil dikirim!');
            window.location.href = 'dashboard.php';
          </script>";
  } else {
    echo "<script>alert('Gagal mengirim aspirasi: " . mysqli_error($conn) . "');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Aspirasi Baru</title>
</head>
<body>
  <h2>Buat Aspirasi Baru</h2>
  <form action="" method="POST">
    <label>Judul:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Isi Aspirasi:</label><br>
    <textarea name="content" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">Kirim Aspirasi</button>
  </form>

  <br>
  <a href="dashboard.php">⬅ Kembali ke Dashboard</a>
</body>
</html>
