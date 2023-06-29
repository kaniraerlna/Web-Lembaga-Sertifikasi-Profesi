<?php require "../../../config/config.php";

    if($_GET['id_schema'] != null){
        $id_schema = $_GET['id_schema']; 
        $script = "SELECT * FROM certification_schema WHERE id_schema=$id_schema"; 
        $query = mysqli_query($conn, $script);
        $data = mysqli_fetch_array($query);
    }else {
        header("location: error.php");
    }

    $query2 = null;

    if(isset($_POST['hapus'])) {
        $script2 = "DELETE FROM certification_schema WHERE id_schema = $id_schema"; 
        $query2 = mysqli_query($conn, $script2);
    }

    if($query2 != null){
        header("location: list_skema.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Details Skema</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../assets/css/dashboard_style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- sidebar -->
    <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">LSP TELEMATIKA</span>
    </div>
      <ul class="nav-links p-0">
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
          <a href="../asesi/list_asesi.php">
            <i class="fa-solid fa-users"></i>
            <span class="links_name">Asesi</span>
          </a>
        </li>
        <li>
          <a href="list_skema.php"  class="active">
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
                <span class="dashboard">Data Skema</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search' ></i>
            </div>
            <div class="profile-details">
                <span class="admin_name">Prem Shahi</span>
                <i class='bx bx-chevron-down' ></i>
            </div>
        </nav>

        <div class="home-content">
          <div class="wrapper" style="padding-left: 50px;"> 
            <a href="list_skema.php" type="submit" class="btn btn-primary">< Back</a>
            <br>
            <br>
            <h1 class="text-center mb-5">Detail Skema</h1>
              <div class="row pb-5"> 
                <div class="col-4">
                  <img class="rounded-lg border border-dark" src="<?= $data['schema_cover'] ?>" width="80%" alt="">
                </div> 
                <div class="col-7 p-3 shadow" style="background-color: white;">
                  <h4>Nama Skema</h4>
                  <p><?= $data['schema_name'] ?></p>
                  <h4>Unit Skema</h4>
                  <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-info-circle-fill pe-2"></i> Deskripsi Skema
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <p class="text-break"><?= $data['description'] ?></p>      
                        </div>
                      </div>
                    </div>
                  </div>
                  <form method="post">
                    <h3>Action</h3>
                    <div class="container-fluid">
                      <a  class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Download Unit</a>
                      <a href="../asesor/create_asesor.php?id_schema=<?= $data['id_schema'] ?>" class="btn btn-info">Tambah Data Asesor</a>
                      <input type="submit" name="hapus" value="Delete" class="btn btn-danger"> 
                    </div>
                  </form> 
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    
    <!-- script -->
    <script src="../../../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>