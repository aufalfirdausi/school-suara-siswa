<?php
session_start();
include('../config/connection.php');

// pastikan hanya student yang login yang bisa menghapus
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
  header("Location: ../logreg/login.php");
  exit;
}

// pastikan parameter id dikirim
if (isset($_GET['id'])) {
  $id = intval($_GET['id']); // amankan dari SQL Injection
  $id_student = $_SESSION['user_id'];

  // pastikan aspirasi milik siswa ini sendiri
  $check = mysqli_query($conn, "SELECT * FROM aspirations WHERE id_aspiration='$id' AND id_student='$id_student'");

  if (mysqli_num_rows($check) > 0) {
    // hapus aspirasi
    $delete = mysqli_query($conn, "DELETE FROM aspirations WHERE id_aspiration='$id'");

    if ($delete) {
      echo "<script>alert('Aspirasi berhasil dihapus!'); window.location='dashboard.php';</script>";
    } else {
      echo "<script>alert('Gagal menghapus aspirasi!'); window.location='dashboard.php';</script>";
    }
  } else {
    echo "<script>alert('Aspirasi tidak ditemukan atau bukan milik Anda!'); window.location='dashboard.php';</script>";
  }
} else {
  echo "<script>alert('ID aspirasi tidak ditemukan!'); window.location='dashboard.php';</script>";
}
?>
