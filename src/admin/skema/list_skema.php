<?php require "../../../config/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>List Skema</title>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="../../../assets/css/dashboard_style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
            <form method="get">
                <div class="search-box">
                    <input type="text" autocomplete="off" type="search" id="form1" placeholder="Search schema's name..." aria-label="Search" name="search">
                    <i class='bx bx-search'></i>
                    <!-- <input type="submit" class="btn btn-success" value="Search"> -->
                </div>
            </form>
            <div class="profile-details">
                <span class="admin_name">Prem Shahi</span>
                <i class='bx bx-chevron-down' ></i>
            </div>
        </nav>

        <div class="home-content px-5">
            <h1 class="text-center mb-5">List Skema</h1>
            <ul><a href="create_skema.php"
                class="btn btn-link text-decoration-none rounded"
                style="background-color: #1a5cd9; color: white">
                <i class="bi bi-person-add"></i> Tambah Skema</a>
            </ul>
                <div class="row mt-5" style="padding-left: 50px; padding-right: 50px;">
                    <?php
                        // pagination, batas itu contentnya ada berapa dalam satu page
                        $batas = 3; 
                        $halaman = $_GET['halaman'] ?? null;

                        if(empty($halaman)){
                            $posisi = 0; $halaman = 1;
                        }else{
                            $posisi = ($halaman-1) * $batas;
                        }

                        if(isset($_GET['search'])){ 
                            $search = $_GET['search']; 
                            $sql="SELECT * FROM certification_schema WHERE schema_name LIKE '%$search%' ORDER BY id_schema ASC LIMIT $posisi, $batas"; 
                        }else{ 
                            $sql="SELECT * FROM certification_schema ORDER BY id_schema ASC LIMIT $posisi, $batas";
                        }

                        // mengambil data dari database
                        $hasil=mysqli_query($conn, $sql); 
                        while ($data = mysqli_fetch_array($hasil)) {
                    ?>

                    <div class="col-md-3 pe-4">
                        <a href="detail_skema.php?id_schema=<?= $data['id_schema'] ?>">
                            <div class="card">
                                <img src="<?= $data['schema_cover'] ?>" width="100%" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h6 class="card-title text-capitalize"><?= $data['schema_name'] ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>

                    <?php
                        if(isset($_GET['search'])){
                            $search= $_GET['search']; 
                            $query2="SELECT * FROM certification_schema WHERE schema_name LIKE '%$search%' ORDER BY id_schema ASC"; 
                        }else{ 
                            $query2="SELECT * FROM certification_schema ORDER BY id_schema ASC";
                        }
                        
                        $result2 = mysqli_query($conn, $query2); 
                        $jmldata = mysqli_num_rows($result2); 
                        $jmlhalaman = ceil($jmldata/$batas);
                    ?>
                </div> 
        </div>
    </section>
    
    <!-- script -->
    <script src="../../../assets/js/script.js"></script>
</body>
</html>