<?php
session_start();
include('../config/connection.php');

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
  header("Location: ../logreg/login.php");
  exit;
}

// Proses update status aspirasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);

  // Update status di database
  $update = mysqli_query($conn, "UPDATE aspirations SET status='$status' WHERE id_aspiration='$id'");

  if ($update) {
    // Redirect kembali ke dashboard admin
    header("Location: dashboard.php");
    exit;
  } else {
    echo "<script>alert('Gagal update status!'); window.location='dashboard.php';</script>";
  }
} else {
  // Jika akses langsung, redirect ke dashboard
  header("Location: dashboard.php");
  exit;
}
?>