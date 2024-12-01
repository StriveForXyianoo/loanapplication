<?php
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/sidebar.php';

//count the pending
$csql = "SELECT COUNT(ID) as count FROM clientloan WHERE STATUS = 'PENDING'";
$cquery = mysqli_query($conn, $csql);
$crow = mysqli_fetch_assoc($cquery);
$pending = $crow['count'];

//count the approved
$csql = "SELECT COUNT(ID) as count FROM clientloan WHERE STATUS = 'APPROVED'";
$cquery = mysqli_query($conn, $csql);
$crow = mysqli_fetch_assoc($cquery);
$approved = $crow['count'];


//coun the number of approve  client
$csql = "SELECT COUNT(ID) as count FROM clientinformation WHERE REGISTRATIONSTATUS = 'APPROVED'";
$cquery = mysqli_query($conn, $csql);
$crow = mysqli_fetch_assoc($cquery);
$approvedclient = $crow['count'];

//coun the number of pending  client
$csql = "SELECT COUNT(ID) as count FROM clientinformation WHERE REGISTRATIONSTATUS = 'PENDING'";
$cquery = mysqli_query($conn, $csql);
$crow = mysqli_fetch_assoc($cquery);
$pendingclient = $crow['count'];


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">DASHBOARD    </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                  <?php
                  echo $pending;
                  ?>
                  </h3>

                  <p>Pending Application</p>
                </div>
                <div class="icon">
                <i class="fa fa-hourglass-start" aria-hidden="true"></i>
               
                </div>
                
              </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <?php
                echo $approved;
                ?>
                </h3>

                <p>Approved Loans</p>
              </div>
              <div class="icon">
              <i class="fa fa-credit-card" aria-hidden="true"></i>
              </div>
              
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                <?php
                echo $approvedclient;
                ?>
                </h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>

                <?php
                echo $pendingclient;
                ?>
                
                </h3>

                <p>Unvefied Users</p>
              </div>
              <div class="icon">
              <i class="fa fa-user-times" aria-hidden="true"></i>
              </div>
              
            </div>
            
          </div>

      </div>
      <div class="row">
        <div class="col-lg-7 col-sm-12">
              <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                          Monthly Collection
                      </h3>
                      
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                            style="position: relative; height: 300px;">
                            <canvas id="revenue" height="300" style="height: 300px;width:100%"></canvas>                         
                        </div>
                        
                      </div>
                    </div><!-- /.card-body -->
                  </div>
              </div>
              <div class="col-lg-5 col-sm-12">
              <div class="card">
                    <div class="card-header">
                      <h3 class="card-title text-center">
                        <i class="fas fa-chart-pie mr-1"></i>
                          Loan Type Avail
                      </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                            style="position: relative; height: 300px;">
                            <canvas id="loantype" height="300" style="height: 300px;"></canvas>                         
                        </div>
                        
                      </div>
                    </div><!-- /.card-body -->
                </div>
              </div>
          </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  
<?php
include 'includes/script.php';
?>
 <script>
        // Fetch data from the backend
        fetch('monthly.php') // Replace with the path to your PHP file
            .then(response => response.json())
            .then(data => {
                // Extract labels and data from the fetched data
                const labels = data.map(item => item.month); // X-axis: Months
                const collections = data.map(item => item.total_collections); // Y-axis: Total collections

                // Create the bar chart
                const ctx = document.getElementById('revenue').getContext('2d');
                new Chart(ctx, {
                    type: 'bar', // Chart type
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Monthly Collections (₱)',
                            data: collections,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true // Start Y-axis at 0
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
    <script>
        // Fetch data from the PHP backend
        fetch('loantype.php') // Replace with the correct path to your PHP file
            .then(response => response.json())
            .then(data => {
                // Extract the loan types and their counts
                const labels = data.map(item => item.LOANTYPE); // Loan types
                const counts = data.map(item => item.count); // Loan type counts

                // Create the pie chart
                const ctx = document.getElementById('loantype').getContext('2d');
                new Chart(ctx, {
                    type: 'pie', // Pie chart type
                    data: {
                        labels: labels, // Loan types as labels
                        datasets: [{
                            label: 'Loan Type Distribution',
                            data: counts, // Total counts per loan type
                            backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#FFFF33'], // Colors for each slice
                            borderColor: '#fff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const label = tooltipItem.label || '';
                                        const value = tooltipItem.raw || 0;
                                        return `${label}: ${value}`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
<?php
include 'includes/footer.php';
?>