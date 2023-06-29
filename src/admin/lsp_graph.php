<?php
require "../../config/config.php";

$sql = "SELECT COUNT(id_assessor) as total, id_assessor FROM assessor GROUP BY id_assessor";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$sql2 = "SELECT schema_name FROM certification_schema";
$result2 = mysqli_query($conn, $sql2);

$schema_name = array();
while ($row = mysqli_fetch_assoc($result2)) {
    $schema_name[] = $row['schema_name'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Data Asesor</title>
    <link rel="stylesheet" href="../../assets/css/dashboard_style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/021b758c3a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
          <a href="asesor/list_asesor.php">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span class="links_name">Asesor</span>
          </a>
        </li>
        <li>
          <a href="../list_asesi.php">
            <i class="fa-solid fa-users"></i>
            <span class="links_name">Asesi</span>
          </a>
        </li>
        <li>
          <a href="skema/list_skema.php">
          <i class="fa-solid fa-folder-open"></i>
            <span class="links_name">Skema</span>
          </a>
        </li>
        <li>
          <a href="lsp_graph.php" class="active">
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
        <div class="container px-5">
            <div>  
                <p> Melihat Presentase Assessor Grafik Bar</a></p>
            </div>
            <div style="width: 608px;height: 680px">
                <canvas id="myChart"></canvas>
            </div>

			<script>
			// === include 'setup' then 'config' above ===
			const labels = <?php echo json_encode($schema_name) ?>;
				const data = {
					labels: labels,
					datasets: [{
					label: 'Total jumlah Assessor/Skema: ',
					data: <?php echo json_encode(array_column($data, 'total')) ?>,
					backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            };
            
            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtOne: true,
                            max: 10,
                            min: 0
                        }
                    }
                },
            };
            
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
                );
            </script>
	    </div>
</body>
</html>
