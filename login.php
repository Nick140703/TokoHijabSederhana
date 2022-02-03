
<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: timeline.php");
        }
    }
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    
    <title>HijabStore</title>
  </head>
  <body>
  
    <div class="container">
      <form action="" method="post"  class="form-container">
<p>&larr; <a href="index.php">Home</a>
        <h1 class="mb-3 text-judul">Masuk</h1>
  <div class="mb-3">
    <label for="username" class="form-label text-form">Username</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
    <input class="form-control" type="text" name="username" placeholder="Username atau email" /> 

  </div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label text-form">Password</label>
    <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
<input class="form-control" type="password" name="password" placeholder="Password" /> 

  </div>
   </div>
  
   
  <div style="margin-top:30px" class="d-grid">


<input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" /> 

  <div>
    
    <spam class="mt-1">Belum Punya Akun?<a href="register.php" class="text-form text-hover"> Daftar</a></spam>
  </div>
</form>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
  </body>
</html>