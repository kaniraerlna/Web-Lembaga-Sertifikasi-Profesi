<?php
    if(isset($_POST["id_accession"]) && !empty($_POST["id_accession"])){

        require_once "../../../config/config.php";

        $sql = "DELETE FROM accession WHERE id_accession = ?";

        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id_accession);

            $param_id_accession = trim($_POST["id_accession"]);

            if(mysqli_stmt_execute($stmt)){
                header("location: list_asesi.php");
                exit();
            } else {
                echo "Oops! SOmething went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    } else {
        if(empty(trim($_GET["id_accession"]))){
            header("location: error.php");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Delete Asesi</title>
    <link rel="stylesheet" href="../../../assets/css/dashboard_style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<head>

<body>
<!-- sidebar -->
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">LSP TELEMATIKA</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="../dashboard_admin.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../asesor/list_asesor.php">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span class="links_name">Asesor</span>
          </a>
        </li>
        <li>
          <a href="list_asesi.php" class="active">
            <i class="fa-solid fa-users"></i>
            <span class="links_name">Asesi</span>
          </a>
        </li>
        <li>
          <a href="../skema/list_skema.php">
          <i class="fa-solid fa-folder-open"></i>
            <span class="links_name">Skema</span>
          </a>
        </li>
        <li>
          <a href="../lsp_graph.php">
            <i class="fa-solid fa-chart-pie"></i>
            <span class="links_name">Graph</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
        <!-- navigation -->
        <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Dashboard</span>
        </div>
        <form method="get" class="search-box">
            <input type="text" name="search" placeholder="Search...">
            <i class='bx bx-search' ></i>
        </form>
        <div class="profile-details">
            <span class="admin_name">Prem Shahi</span>
            <i class='bx bx-chevron-down' ></i>
        </div>
        </nav>

        <div class="home-content">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                            <div class="page-header">
                                <h1>Hapus Data Asesi</h1>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="alert alert-danger fade in">
                                    <input type="hidden" name="id_accession" value="<?php echo trim($_GET["id_accession"]); ?>"/>
                                    <p>Are you sure want to delete this data?</p></br>
                                    <p>
                                        <a href="list_asesi.php" class="btn btn-danger">No</a>
                                        <input type="submit" value="Yes" class="btn btn-success">
                                    </p>
                                </div>
                            </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>