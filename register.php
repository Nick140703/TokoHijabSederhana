<?php

require_once("config.php");

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO users (name, username, email, password) 
            VALUES (:name, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":name" => $name,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: login.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styledaftar.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    
    <title>HijabStore</title>
  </head>
  <body>
    <div class="container">
      <form action="" method="POST" class="form-container">
        
  <h1 class="mb-3 text-judul">Daftar</h1>
  <div>
    <label for="nama" class="form-label text-form">Nama Lengkap</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
   <input class="form-control" type="text" name="name" placeholder="Nama kamu" />

  </div>
  </div>

  <div>
    <label for="username" class="form-label text-form">Username</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
<input class="form-control" type="text" name="username" placeholder="Username" />

  </div>
  </div>
  <div class="row">
  <div class="col-md-6 mb-1">
    <label for="email" class="form-label text-form">E-mail</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
    <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
  </div>
  </div>
  <div class="col-md-6 mb-1">
    <label for="password" class="form-label text-form">Password</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
<input class="form-control" type="password" name="password" placeholder="Password" />
  </div>
   </div>
  

  <div class="d-grid">
<input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
  </div>

  <div>
    <spam class="mt-1">Sudah Punya Akun?<a href="login.php" class="text-form text-hover"> Login Disini</a></spam>
  </div>
  
  </div>
</form>
     </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
  </body>
</html>