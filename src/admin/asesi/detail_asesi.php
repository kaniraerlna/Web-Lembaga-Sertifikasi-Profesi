<?php require "../../../config/config.php"?>

<!DOCTYPE html>
<html>
<head>
    <title>View Detail Asesi</title>
    <link rel="stylesheet" href="../../../assets/css/dashboard_style.css">
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
  <div class="detail-asesi">
    <div class="container">
      <div class="card p-4 shadow">
        <div class="card-body">
          <a href="list_asesi.php" type="submit" class="btn btn-primary">< Back</a>
          <h1 class="text-center p-3 mb-5"><i class="bi bi-person"></i> View Detail Asesi</h1>
          <div class="row mb-3">
            <div class="col-4">
              <img class="rounded border border-dark" src="../../../assets/img/cover-3.png" width="90%" alt="">
              <?php
                    // Retrieve data from the database
                    $sql = "SELECT * FROM accession WHERE id_accession='".$_GET['id_accession']."'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
              ?>
              <h3 class="mt-3 text-capitalize text-break" style="width: 80%"><?= $row['accession_name']; ?></h3>
              <div class="card mt-4" style="width: 90%">
                <div class="card-body">
                  <i class="fa-solid fa-award text-warning pe-1 fs-4"></i>
                  <strong class="fs-5">Grade</strong>
                  <p class="m-0 mt-1 fs-4">90</p>
                </div>
              </div>
            </div>
            <div class="col-8">
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <?php
                        echo 
                        "<tr>
                          <th>NIK</th>
                          <td>".$row["ktp"]."</td>
                        </tr>
                        <tr>
                          <th>Tempat Lahir</th>
                          <td>".$row["birth_place"]."</td>
                        </tr>
                        <tr>
                          <th>Tanggal Lahir</th>
                          <td>".$row["birth_date"]."</td>
                        </tr>
                        <tr>
                          <th>Jenis Kelamin</th>
                          <td>".$row["gender"]."</td>
                        </tr>
                        <tr>
                          <th>Alamat</th>
                          <td>".$row["address"]."</td>
                        </tr>
                        <tr>
                          <th>No. Telp</th>
                          <td>".$row["phone"]."</td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td>".$row["email"]."</td>
                        </tr>
                        <tr>
                          <th>Pendidikan Terakhir</th>
                          <td>".$row["education"]."</td>
                        </tr>
                        <tr>
                          <th>Universitas</th>
                          <td>".$row["university"]."</td>
                        </tr>
                        <tr>
                          <th>Program Studi</th>
                          <td>".$row["program"]."</td>
                        </tr>
                        <tr>
                          <th>Semester</th>
                          <td>".$row["semester"]."</td>
                        </tr>
                        <tr>
                          <th>Perusahan Tempat Magang</th>
                          <td>".$row["internship_company"]."</td>
                        </tr>
                        <tr>
                          <th>Bidang Usaha</th>
                          <td>".$row["business_field"]."</td>
                        </tr>";
                      }
                    } else {
                        echo "0 results";
                    }
                    // Close the connection
                    mysqli_close($conn);
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
  