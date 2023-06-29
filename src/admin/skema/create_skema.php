<!-- panggil config -->
<?php require "../../../config/config.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Skema</title>
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
            <div class="container" style="padding-bottom: 50px;">
                <div style="color: red;">
                    <?php 
                        if(isset($_POST['submit'])){
                            if(isset($_FILES['schema_cover'])){
                                if(isset($_FILES['schema_unit'])){
                                    $schema_name = $_POST['schema_name']; 
                                    $description = $_POST['description'];
                                    
                                    //schema_cover
                                    $file_tmp= $_FILES['schema_cover']['tmp_name'];
                                    $type = pathinfo($file_tmp, PATHINFO_EXTENSION); 
                                    $data = file_get_contents($file_tmp);
                                    $schema_cover = 'data:assets/img/' . $type . ';base64,' . base64_encode($data);
                                    
                                    $file_tmp= $_FILES['schema_cover']['tmp_name'];
                                    $type = pathinfo($file_tmp, PATHINFO_EXTENSION); 
                                    $data = file_get_contents($file_tmp);
                                    $schema_cover = 'data:assets/img/' . $type . ';base64,' . base64_encode($data);
    
                                    $script = "INSERT INTO certification_schema SET schema_name='$schema_name', description='$description', schema_unit='$schema_unit', 
                                    schema_cover='$schema_cover'";
    
                                    $query = mysqli_query($conn, $script); 
                                    
                                    if($query) {
                                        header("location: list_skema.php");
                                    }else{
                                        echo "gagal mengupload data";
                                    }
                                }
                            }
                        }
                    ?>
                    
                </div>

                <form method="post" enctype="multipart/form-data">
                    <h1 class="text-center">Tambah Data Skema</h1>
                    <div class="form-group">
                        <label>Nama Skema</label>
                        <input type="text" class="form-control" name="schema_name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea type="text" class="form-control" name="description" required cols="30" rows="10" autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Unit Skema (File bereksistensi .pdf)</label>
                        <input type="file" class="form-control" name="schema_unit" style="padding: 5px;" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Cover Skema</label>
                        <input type="file" class="form-control" name="schema_cover" style="padding: 5px;" required>
                    </div>
                    <input type="submit" class="btn btn-success" name="submit" value="Add">
                </form>
            </div>
        </div>
    </section>

    <!-- script -->
    <script src="../../../assets/js/script.js"></script>
</body>
</html>