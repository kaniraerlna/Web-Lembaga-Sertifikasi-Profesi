<!-- panggil config -->
<?php 
    require "../../config/config.php";
    session_start();
    $email = $_SESSION['email'];
    $type = $_SESSION['type'] ==  "U";
    if(!isset($email) && !isset($type)){
        $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
        header('Location: ../login.php');
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    $id_user = mysqli_fetch_assoc($result)['id_user'];
?>

<!-- create the form -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
        <link rel="stylesheet" href="../../assets/css/dashboard_style.css">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <!-- FONT AWESOME -->
        <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulir Biodata Calon Peserta Uji Kompetensi</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            /* Always display the drop down caret */
            input[type="date"]::-webkit-calendar-picker-indicator {
                color: #2c3e50;
            }

            /* A few custom styles for date inputs */
            input[type="date"] {
                appearance: none;
                -webkit-appearance: none;
                color: #95a5a6;
                /*font-family: "Helvetica", arial, sans-serif;*/
                font-size: 15px;
                border:1px solid #95a5a6;
                /*background:whitesmoke;*/
                padding:5px;
                display: inline-block !important;
                visibility: visible !important;
            }

            input[type="date"], focus {
                color: #95a5a6;
                box-shadow: none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
            }
        </style>
    </head>
<body style="height: 100%">

    <!-- sidebar -->
    <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">LSP TELEMATIKA</span>
    </div>
    <ul class="nav-links">
        <li>
          <a href="../dashboard_asesi.php">
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
          <a href="../create_asesi.php">
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
            <span class="dashboard">Pendaftaran Asesi</span>
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
            <div class="container" style="padding: 0 0 50px 0;">
                <div style="color: red;">
                    <?php
                        if($_GET['id_schema'] == null) {
                            header("location: skema/list_skema.php");
                        }

                        //ambil data schema
                        $id_schema = $_GET['id_schema']; 
                        $script = "SELECT * FROM certification_schema WHERE id_schema = $id_schema"; 
                        $query = mysqli_query($conn, $script); 
                        $data = mysqli_fetch_array($query); 

                        // check if the form has been submitted
                        if(isset($_POST['submit'])) {
                            if(isset($_FILES['accession_photo'])){
                                $ktp = $_POST['ktp'];
                                $accession_name = $_POST['accession_name'];
                                $gender = $_POST['gender'];
                                $phone = $_POST['phone'];
                                $email = $_POST['email'];
                                $birth_date = $_POST['birth_date'];
                                $birth_place = $_POST['birth_place'];
                                $address = $_POST['address'];
                                $education = $_POST['education'];
                                $university = $_POST['university'];
                                $program = $_POST['program'];
                                $semester = $_POST['semester'];
                                $internship_company = $_POST['internship_company'];
                                $business_field = $_POST['business_field'];
                                $id_schema = $_POST['id_schema'];
                                $id_user;

                                //foto asesi
                                $file_tmp = $_FILES['accession_photo']['tmp_name'];
                                $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                                $data = file_get_contents($file_tmp);
                                $accession_photo = 'data:assets/img/' . $type . ';base64,' . base64_encode($data);

                                // insert the form data into the database
                                $query = "INSERT INTO accession SET ktp='$ktp', accession_name='$accession_name', accession_photo='$accession_photo', gender='$gender', phone='$phone', email='$email', birth_date='$birth_date',
                                            birth_place='$birth_place', address='$address', education='$education', university='$university', program='$program', semester='$semester',
                                            internship_company='$internship_company', business_field='$business_field', id_schema='$id_schema,', id_user='$id_user'";

                                $result = mysqli_query($conn, $query);

                                if($result) {
                                    header("location: detail_asesi.php");
                                }else{
                                    echo "gagal mengupload data";
                                }
                            }
                        }
                    ?>
                </div>

                <h1 class="text-center">Formulir Biodata Calon Peserta Uji Kompetensi</h1>
                <div class="col-xs-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <!-- Informasi Skema -->
                        <h4 class="text-center" style="background-color: #0A2558; padding: 5px; color: white;">Informasi Skema</h4>
                        <div class="form-group">
                            <label>ID Skema</label>
                            <input type="number" class="form-control" name="id_schema" value="<?= $data['id_schema']?>" required autocomplete="off">
                        </div>
                        <!-- Personal -->
                        <h4 class="text-center" style="background-color: #0A2558; padding: 5px; color: white;">Informasi Personal</h4>
                        <div class="form-group">
                            <td><label for="ktp">No.KTP</label></td>
                            <td><input type="text" required class="form-control" placeholder="NO KTP" name="ktp" required></td>
                        </div>
                        <div class="form-group">
                            <td><label for="accession_photo">Pas Foto (Ukuran 3x4)</label></td>
                            <td><input type="file" required class="form-control" name="accession_photo" required></td>
                        </div>
                        <div class="form-group">
                            <td><label for="name">Nama Lengkap</label></td>
                            <td><input type="text" required class="form-control" placeholder="Nama Lengkap" name="accession_name" required></td>
                        </div>
                        <div class="form-group">
                            <td><label for="gender">Jenis Kelamin</label></td><br>
                            <td><input type="radio" name="gender" value="Laki-Laki">     Laki-Laki <br>
                            <input type="radio" name="gender" value="Perempuan">     Perempuan</td>
                        </div>
                        <div class="form-group">
                            <td><label for="phone">No Telp</label></td>
                            <td><input type="tel" required class="form-control" placeholder="Nomor Hp yg aktif" name="phone"></td>
                        </div>
                        <div class="form-group">
                            <td><label for="email">Email</label></td>
                            <td><input type="email" required class="form-control" placeholder="Email Pribadi" name="email" required></td>
                        </div>
                        <div class="form-group">
                            <td><label for="birth_date">Tanggal Lahir</label></td>
                            <td><input type="date" required class="form-control" name="birth_date"></td>
                        </div>
                        <div class="form-group">
                            <td><label for="birth_place">Provinsi Tempat Lahir</label></td>
                            <td><select class="combobox form-control select2" name="birth_place">
                                <option value="aceh">Aceh</option>
                                <option value="Sumut">Sumatera Utara</option>
                                <option value="sumbar">Sumatera Barat</option>
                                <option value="Riau">Riau</option>
                                <option value="Jambi">Jambi</option>
                                <option value="Sumsel">Sumatera Selatan</option>
                                <option value="Bengkulu">Bengkulu</option>
                                <option value="Lampung">Lampung</option>
                                <option value="BaBel">Kep. Bangka Belitung</option>
                                <option value="kepRiau">Kepulauan Riau</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Jabar">Jawa Barat</option>
                                <option value="Banten">Banten</option>
                                <option value="Jateng">Jawa Tengah</option>
                                <option value="Yogyakarta">Yogyakarta</option>
                                <option value="Jatim">Jawa Timur</option>
                                <option value="Kalbar">Kalimantan Barat</option>
                                <option value="Kalteng">Kalimantan Tengah</option>
                                <option value="Kalsel">Kalimantan Selatan</option>
                                <option value="Kaltim">Kalimantan Timur</option>
                                <option value="Kaltra">Kalimantan Utara</option>
                                <option value="Bali">Bali</option>
                                <option value="NTT">Nusa Tenggara Timur</option>
                                <option value="NTB">Nusa Tenggara Barat</option>
                                <option value="Sulut">Sulawesi Utara</option>
                                <option value="Sulteng">Sulawesi Tengah</option>
                                <option value="Sulsel">Sulawesi Selatan</option>
                                <option value="Sultengg">Sulawesi Tenggara</option>
                                <option value="Sulbar">Sulawesi Barat</option>
                                <option value="Gorontalo">Gorontalo</option>
                                <option value="Maluku">Maluku</option>
                                <option value="Maluku Utara">Maluku Utara</option>
                                <option value="Papua">Papua</option>
                                <option value="Papua Barat">Papua Barat</option>
                            </select></td>
                        </div>
                        <div class="form-group">
                            <td><label for="address">Alamat</label></td>
                            <td><textarea class="form-control" placeholder="Alamat lengkap sesuai KTP" name="address"></textarea></td>
                        </div>
                        <!-- Pendidikan -->
                        <h4 class="text-center" style="background-color: #0A2558; padding: 5px; color: white;">Informasi Pendidikan</h4>
                        <div class="form-group">
                            <td><label for="education">Pendidikan Terakhir</label></td>
                            <td><select class="form-control" name="education">
                                <option value="S3">S3</option>
                                <option value="S2">S2</option>
                                <option value="S1">S1</option>
                                <option value="d4">D4</option>
                                <option value="d3">D3</option>
                                <option value="d2">D2</option>
                                <option value="d1">D1</option>
                                <option value="SMA">SMA/SEDERAJAT</option>
                                <option value="SMP">SMP</option>
                            </select></td>
                        </div>
                        <div class="form-group">
                            <td><label for="university">Universitas</label></td>
                            <td><input type="text" required class="form-control" placeholder="Lembaga atau Institusi Pendidikan" name="university"></td>
                        </div>    
                        <div class="form-group">            
                            <td><label for="program">Program Studi</label></td>
                            <td><input type="text" required class="form-control" placeholder="Jurusan" name="program"></td>
                        </div>
                        <div class="form-group">
                            <td><label for="semester">Semester</label></td>
                            <td><input type="number" required class="form-control" placeholder="Semester" name="semester"></td>
                        </div>
                        <div class="form-group">
                            <td><label for="internship_company">Perusahaan Tempat Magang</label></td>
                            <td><input type="text" required class="form-control" placeholder="Nama perusahaan tempat praktek kerja" name="internship_company"></td>
                        </div>
                        <div class="form-group">
                            <td><label for="business_field">Bidang Usaha</label></td>
                            <td><input type="text" required class="form-control" placeholder="Bidang usaha perusahaan tempat praktek" name="business_field"></td>
                        </div>
                        <div class="form-group" style="padding-top:10px;padding-bottom:10px;">
                            <input style="padding:5px;width: 100%" class="btn btn-success btn-lg col-xs-12" type="submit" name="submit" value="Daftar">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </section>
</body>
    <script src="../../assets/js/script.js"></script>
    <script src="https://ui.lspbnsp.id/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://ui.lspbnsp.id/assets/plugins/select2-4.0.3/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.js"></script>
</html>