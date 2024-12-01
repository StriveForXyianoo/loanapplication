<?php
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/sidebar.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports    </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">School</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class=" card card-outline card-warning">
          <div class="card-header">
            <h3 class="card-title">Reports</h3>
          </div>
          <div class="card-body">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Report</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Membership Report</td>
                  <td><a href="clientreport.php"  target="__blank" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                <tr>
                  <td>Loan  Reports</td>
                  <td><a href="loanreport.php" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                <tr>
                  <td>Monthly Collection Report</td>
                  <td><a href="index" class="btn btn-primary btn-sm">View</a></td>
                </tr>
               
              </tbody>
            </table>
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

<?php
include 'includes/footer.php';
?>