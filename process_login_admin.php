<?php
  session_start();
  // session_start() digunakan sebagai tanda bahwa kita akan menggunakan session pada halaman ini (login_admin.php)
  // session_start() harus diletakkan pada BARIS PERTAMA.

  include("config.php");

  //tampung data username dan Password
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_admin"])) {
    $sql = "select * from admin
            where username = '$username'
            and password = '$password'";
    // eksekusi query
    $query = mysqli_query($connect, $sql);
    $jumlah = mysqli_num_rows($query);
    // mysqli_num_rows digunakan untuk menghitung jumlah data hasil dari query

    if ($jumlah > 0) {
      // jika jumlahnya lebih dari nol, artinya terdapat data admin yang sesuai
      // dengan username dan password yang diinputkan.

      // kita ubah hasil query ke array
      $admin = mysqli_fetch_array($query);

      // membuat session
      $_SESSION["id_admin"] = $admin["id_admin"];
      $_SESSION["nama"] = $admin["nama"];

      // Redirect jika berhasil login
      header("location:admin.php");
    } else{
      // jika jumlahnya nol, artinya tidak ada data admin yang sesuai dengan
      // username dan password yang diinputkan

      // Redirect jika login gagal
      header("location:login_admin.php");
    }
  }

  if (isset($_GET["logout"])) {
    // proses logout
    session_destroy(); // menghapus session yang telah dibuat.

    header("location:login_admin.php"); // Redirect
  }
 ?>
