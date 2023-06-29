<!-- panggil config -->
<?php require "../../../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Data Asesor</title>
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
          <a href="dashboard_admin.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="list_asesor.php">
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
          <a href="list_skema.php">
          <i class="fa-solid fa-folder-open"></i>
            <span class="links_name">Skema</span>
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
            <span class="dashboard">Data Asesi</span>
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
              //ambil id asesi
              if($_GET['id_accession'] == null) {
                header("location: update_asesi.php");
              }

              //ambil data asesor
              $id_accession = $_GET['id_accession']; 
              $script = "SELECT * FROM accession WHERE id_accession = '$id_accession'"; 
              $query = mysqli_query($conn, $script); 
              $data = mysqli_fetch_array($query); 
              
                //inisialisasi data
              if(isset($_POST['submit'])) {
                if(isset($_FILES['accession_photo'])){
                  $ktp = $_POST['ktp'];
                  $accession_name = $_POST['accession_name'];
                  $gender = $_POST['gender'];
                  $phone = $_POST['phone'];
                  $email = $_POST['email'];
                  $birth_place = $_POST['birth_place'];
                  $birth_date = $_POST['birth_date'];
                  $address = $_POST['address'];
                  $education = $_POST['education'];
                  $university = $_POST['university'];
                  $program = $_POST['program'];
                  $semester = $_POST['semester'];
                  $internship_company = $_POST['internship_company'];
                  $business_field = $_POST['business_field'];
                  $id_user = $data['id_user'];
                  $id_schema = $data['id_schema'];
  
                  //foto asesor
                  $file_tmp = $_FILES['accession_photo']['tmp_name'];
                  $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                  $data = file_get_contents($file_tmp);
                  $accession_photo = 'data:assets/img/' . $type . ';base64,' . base64_encode($data);
  
                  // insert the form data into the database
                  $query = "UPDATE accession SET ktp='$ktp', accession_name='$accession_name', accession_photo='$accession_photo', gender='$gender', phone='$phone', email='$email', birth_date='$birth_date',
                  birth_place='$birth_place', address='$address', education='$education', university='$university', program='$program', semester='$semester',
                  internship_company='$internship_company', business_field='$business_field', id_schema='$id_schema,', id_user='$id_user' WHERE id_accession = '$id_accession'";
                  
                  
                  //check if the data inserted to database
                  $result = mysqli_query($conn, $query);
                    if($result) {
                      header("location: list_asesi.php");
                    } else {
                      echo "gagal mengupload data";
                    }
                }
              }
            ?>
            </div>
            <h1 class="text-center">Edit Data Peserta Uji Kompetensi</h1>
            <form class="p-4" method="post" enctype="multipart/form-data">
              <h2 class="text-center text-light fw-bold my-3" style="background-color: rgb(31, 45, 61)">Data Personal</h2>
              <div class="form-group">
                  <label>No.KTP</label>
                  <input type="number" min="0" class="form-control" placeholder="No. NIK" name="ktp" required value="<?= $data['ktp']; ?>">
              </div>
              <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" name="accession_name" required value="<?= $data['accession_name']; ?>">
              </div>
              <div class="form-group">
                  <label>Tempat Lahir</label>
                  <select class="form-control" name="birth_place" required>
                      <option value="">-- Pilih Kota --</option>
                      <option value="Jakarta">Jakarta</option>
                      <option value="Surabaya">Surabaya</option>
                      <option value="Medan">Medan</option>
                      <option value="Bandung">Bandung</option>
                      <option value="Bekasi">Bekasi</option>
                      <option value="Tangerang">Tangerang</option>
                      <option value="Depok">Depok</option>
                      <option value="Semarang">Semarang</option>
                      <option value="Palembang">Palembang</option>
                      <option value="Makassar">Makassar</option>
                      <option value="Bogor">Bogor</option>
                      <option value="Denpasar">Denpasar</option>
                      <option value="Malang">Malang</option>
                      <option value="Yogyakarta">Yogyakarta</option>
                      <option value="Surakarta">Surakarta</option>
                      <option value="Padang">Padang</option>
                      <option value="Pekanbaru">Pekanbaru</option>
                      <option value="Bandar Lampung">Bandar Lampung</option>
                      <option value="Samarinda">Samarinda</option>
                      <option value="Cirebon">Cirebon</option>
                      <option value="Banjarmasin">Banjarmasin</option>
                      <option value="Manado">Manado</option>
                      <option value="Batam">Batam</option>
                      <option value="Balikpapan">Balikpapan</option>
                      <option value="Pontianak">Pontianak</option>
                      <option value="Ujung Pandang">Ujung Pandang</option>
                      <option value="Ambon">Ambon</option>
                      <option value="Jayapura">Jayapura</option>
                      <option value="Mataram">Mataram</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="date" class="form-control" name="birth_date" required value="<?= $data['birth_date']; ?>">
              </div>
              <div class="form-group">
                  <label>Pas Foto</label>
                  <input style="padding: 5px;" type="file" class="form-control-file" name="accession_photo" required value="<?= $data['accession_photo']; ?>">
              </div>
              <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="laki-laki" value="Laki-laki" required>
                      <label class="form-check-label" for="laki-laki">Laki-laki</label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" required>
                      <label class="form-check-label" for="perempuan">Perempuan</label>
                  </div>
              </div>
              <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" placeholder="Alamat lengkap sesuai KTP" name="address" required value="<?= $data['address']; ?>">
              </div>
              <div class="form-group">
                  <label>No. Telp</label>
                  <input type="number" min="0" class="form-control" placeholder="Nomor Hp yg aktif" name="phone" required value="<?= $data['phone']; ?>">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="Email Pribadi" name="email" required value="<?= $data['email']; ?>">
              </div>
              <h2 class="text-center text-light fw-bold my-4" style="background-color: rgb(31, 45, 61)">Data Pendidikan</h2>
              <div class="form-group">
                  <td><label for="education">Pendidikan Terakhir</label></td>
                  <td><select class="form-control" name="education">
                      <option value="">-- Pilih Pendidikan--</option>
                      <option value="s3">S3</option>
                      <option value="s2">S2</option>
                      <option value="s1">S1</option>
                      <option value="d4">D4</option>
                      <option value="d3">D3</option>
                      <option value="d2">D2</option>
                      <option value="d1">D1</option>
                      <option value="sma">SMA/SEDERAJAT</option>
                      <option value="smp">SMP</option>
                      <option value="sd">SD</option>
                  </select></td>
              </div>
              <div class="form-group">
                  <td><label for="university">Universitas</label></td>
                  <td><input type="text" required class="form-control" placeholder="Lembaga atau Institusi Pendidikan" name="university" value="<?= $data['university']; ?>"></td>
              </div>    
              <div class="form-group">            
                  <td><label for="program">Program Studi</label></td>
                  <td><input type="text" required class="form-control" placeholder="Jurusan" name="program" value="<?= $data['program']; ?>"></td>
              </div>
              <div class="form-group">
                  <td><label for="semester">Semester</label></td>
                  <td><input type="number" min="0" required class="form-control" placeholder="Semester" name="semester" value="<?= $data['semester']; ?>"></td>
              </div>
              <div class="form-group">
                  <td><label for="internship_company">Perusahaan Tempat Magang</label></td>
                  <td><input type="text" required class="form-control" placeholder="Nama perusahaan tempat praktek kerja" name="internship_company" value="<?= $data['internship_company']; ?>"></td>
              </div>
              <div class="form-group">
                  <td><label for="business_field">Bidang Usaha</label></td>
                  <td><input type="text" required class="form-control" placeholder="Bidang usaha perusahaan tempat praktek" name="business_field" value="<?= $data['business_field']; ?>"></td>
              </div>
              <div class="form-group pt-4 text-center">
                  <input class="btn btn-success" type="submit" name="submit" value="Submit">
              </div>
            </form>
        </div>
    </div>
    </section>

    <!-- script -->
    <script src="../../../assets/js/script.js"></script>
</body>
</html>