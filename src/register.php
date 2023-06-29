<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- icon -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        // import config
        require("../config/config.php");

        // inisialisasi session
        session_start();

        // field variabel
        $error = '';
        $validate = '';

        // ngecek data username kosong atau enggak
        if(isset($_SESSION['user'])){
            header('Location: index.php');
        } 

        // mengecek apakah username udah diinput sama user
        if(isset($_POST['submit'])){
            $fullname = stripslashes($_POST['fullname']);
            $fullname = mysqli_real_escape_string($conn, $fullname);

            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($conn, $email);

            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $repass = stripslashes($_POST['repass']);
            $repass = mysqli_real_escape_string($conn, $repass);

            // validasi inputan kosong atau tidak
            if(!empty(trim($fullname)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
                // validasi password sama confirm password sama atau engga
                if($password == $repass){
                    // function check_name untuk ngecek apakah username udah ada di database atau belum
                    if(check_email($email, $conn) == 0 ){
                        $pass = password_hash($password, PASSWORD_DEFAULT);
                        $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$pass')";
                        $result = mysqli_query($conn, $query);
                        if($result){
                            header('Location: login.php');
                        } else{
                            $error = 'Register failed!';
                        } 
                    } else {
                        $error = 'Username already exist.';
                    } 
                } else {
                    $validate = "Password doesn't match!";
                }
            } else {
                $error = 'Data must not empty!';
            }
        }

        // fungsi ngecek username sama di database
        function check_email($email, $conn){
            $email = mysqli_real_escape_string($conn, $email);
            $query = "SELECT * FROM users WHERE email = '$email'";
            if($result = mysqli_query($conn, $query)) return mysqli_num_rows($result);
        }


    ?>
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
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
              <img src="../assets/img/cover.png" style="width: 917px" alt="cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../assets/img/cover-3.png" style="width: 917px" alt="cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-7 p-0">
        <form action="register.php" method="post" class="form">
          <center><h2 class="mb-2 fs-bold">Join LSP UWIW today!</h2></center>
          <center><p class="mb-4 fs-bold">Sign up now to get your own personalized timeline!</p></center>

          <?php if($error != ''){?>
              <div class= "alert alert-danger" role="alert" style="margin-top: 10px"><?= $error; ?></div>
          <?php } ?>

          <div class="form-input mb-3 icon form-container d-flex">
              <span><i class="fa-solid fa-user"></i></span>
              <input type="text" class="form-control" required name="fullname" id="fullname" autocomplete="off" placeholder="FullName">
          </div>
          <div class="form-input mb-3 icon form-container d-flex">
              <span><i class="fa-solid fa-envelope"></i></span>
              <input type="text" class="form-control" required name="email" id="email" autocomplete="off" placeholder="Email">
          </div>
          <div class="form-input mb-3 icon form-container d-flex">
              <span><i class="fa-solid fa-lock"></i></span>
              <input type="password" class="form-control" minlength=6 maxlength=8 required name="password" id="password" autocomplete="off" placeholder="Password">
          </div>
          <?php if($validate != ''){?>
              <div class= "text-danger"><?= $validate; ?></div>
          <?php } ?>
          <div class="form-input mb-4 icon form-container d-flex">
              <span><i class="fa-solid fa-lock"></i></span>
              <input type="password" class="form-control" minlength=6 maxlength=8 required name="repass" id="repass" autocomplete="off" placeholder="Confirm Password">
          </div>
          <div class="d-grid gap-2 col-14 mb-3">
              <button type="submit" name="submit" class="btn btn-primary">Register</button>
          </div>
          <div class="login-signup text-center">
            <span class="text">Already have an account?
                <a href="login.php" class="signup-text">Login now</a>
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