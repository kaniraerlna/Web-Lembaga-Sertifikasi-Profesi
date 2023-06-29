<?php
  require('../config/config.php');

  session_start();

  $error = '';
  $success = '';
  $errorCaptcha = '';
  $query = '';

  // mengecek apakah session email tersedia atau tidak, kalau ada nanti dia langsung ke index
  if(isset($_SESSION['email'])) {
      if($_SESSION['type'] == "A"){
          header('Location: admin/dashboard_admin.php');
      } elseif($_SESSION['type'] == "U"){
          header('Location: asesi/dashboard_asesi.php');
      }
  }

  // fungsi tombol submit
  if(isset($_POST['submit'])){
    // menghilangkan backlashes
    $email = stripslashes($_POST['email']);
    // menghindari sql injection
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // validasi form kosong
    if(!empty(trim($email)) && !empty(trim($password))){
        // mengambil data dari database berdasarkan email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        // cek password pas email udah ketemu
        if($rows != 0){
            $hash = mysqli_fetch_assoc($result)['password'];
            if(password_verify($password, $hash) && $_SESSION['code'] == $_POST['captchaCode']){
                $_SESSION['email'] = $email;
                //multiuser check
                $result = mysqli_query($conn, $query);
                $type = mysqli_fetch_assoc($result)['type'];
                if($type == 'U' ){
                    $_SESSION['type'] = $type;
                    header('Location: asesi/dashboard_asesi.php');
                }elseif ($type == 'A' ){
                    $_SESSION['type'] = $type;
                    header('Location: admin/dashboard_admin.php');
                }
            } else {
              $error = 'Upss.. Incorrect password';
            }
        // gagal akan menampilkan pesan error
        } else {
            $error = 'Login failed! Please enter the right email and password.';
        }
    } else {
        $error = 'Data must not empty!';
    }

    // validasi kode captcha
    if($_SESSION['code'] != $_POST['captchaCode']){
        $errorCaptcha = "Invalid captcha value!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login | LSP</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container main">
    <div class="row shadow rounded gx-5 m-5">
      <div class="col-md-5 p-0 m-0">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner rounded-start">
            <div class="carousel-item active" data-bs-interval="3000">
              <img src="../assets/img/cover-4.png" style="width: 917px" alt="cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>LSP TELEMATIKA</h5>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <img src="../assets/img/cover.png" style="width: 917px" alt="cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>LSP TELEMATIKA</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../assets/img/cover-3.png" style="width: 917px" alt="cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>LSP TELEMATIKA</h5>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-7 p-0">
        <form action="login.php" method="post" class="form">
          <center><h2 class="mb-2 fs-bold">Hello Again!</h2></center>
          <center><p class="mb-4 fs-bold">Sign into your account here</p></center>

          <?php if($error != ''){ ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?=$error; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  </button>
              </div>
          <?php } ?>

          <div class="form-input mb-3 icon form-container d-flex">
              <span><i class="fa-solid fa-user"></i></span>
              <input type="text" class="form-control" required name="email" id="email" autocomplete="off" placeholder="Email">
          </div>
          <div class="form-input mb-3 icon form-container d-flex">
              <span><i class="fa-solid fa-lock"></i></span>
              <input type="password" class="form-control" minlength=6 maxlength=8 required name="password" id="password" autocomplete="off" placeholder="Password">
          </div>
          <div class="mb-3">
              <span>Enter Security Code</span>
              <div class="d-flex captcha mt-2">
                <input type="text" class="form-control" required name="captchaCode" maxlength="6">
                <img src="captcha/captcha.php">
              </div>
              <?php if($errorCaptcha != ''){ ?>
                <p class="text-danger">Invalid captcha value!</p>
              <?php } ?>
          </div>
          <div class="d-flex justify-content-between mb-3">
              <div class="checkbox-content">
                  <input type="checkbox" id="logCheck">
                  <label for="logCheck" class="text">Remember Me</label>
              </div>
              <a href="#">Forgot Password?</a>
          </div>
          <div class="d-grid gap-2 col-14 mb-3">
              <button class="btn btn-primary" type="submit" name="submit">Login</button>
          </div>

          <div class="login-signup text-center">
              <span class="text">New to LSP UWIW?
                  <a href="register.php" class="signup-text">Register now</a>
              </span>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>