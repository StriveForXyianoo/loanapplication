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
            <h1 class="m-0 text-dark">Loans  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loans</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Loan Information</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Loan Type</th>
                                <th>Amount</th>
                                <th>Loan Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT clientinformation.*,clientloan.*,clientloan.ID as LOID,loantype.* FROM clientinformation INNER JOIN clientloan ON clientinformation.ID = clientloan.CLIENTID INNER JOIN loantype ON clientloan.LOANID = loantype.ID";
                        $result = $conn->query($sql);
                        foreach($result as $row){
                          if($row['MIDDLENAME']==''){
                            $name = $row['FIRSTNAME'].' '.$row['LASTNAME'];
                          }else{
                            $name = $row['FIRSTNAME'].' '.$row['MIDDLENAME'].' '.$row['LASTNAME'];
                          }
                          ?>
                          <tr>
                            <td><?php echo $name?></td>
                            <td><?php echo $row['DEPARTMENT']?></td>
                            <td><?php echo $row['POSITION']?></td>
                            <td><?php echo $row['LOANTYPE']?></td>
                            <td><?php echo $row['LOANAMOUNT']?></td>
                            <td><?php echo $row['STATUS']?></td>
                            <?php
                            if($_SESSION['role'] == 'ADMIN'){
                              ?>
                              <td>
                                <?php
                                if($row['STATUS'] == 'PENDING'){
                                  ?>
                                  <button onclick="approved(<?php echo $row['LOID']?>)" class="btn-sm btn btn-success">Approve</button>
                                  <button onclick="disapproved(<?php echo $row['LOID']?>)" class="btn-sm btn btn-danger">Disapprove</button>
                                  
                                  <?php
                                }else{
                                  ?>
                                  <a href="loan_view.php?id=<?php echo $row['LOID']?>" class="btn btn-warning btn-sm">View Loan</a>
                                  <?php
                                }
                                ?>
                                
                              </td>
                              <?php
                            }else{
                              ?>
                              <td>
                                <a href="loan_view.php?id=<?php echo $row['LOID']?>" class="btn btn-warning btn-sm">View Loan</a>
                              </td>
                              <?php
                            }
                            ?>

                          </tr>

                          <?php
                        }
                        ?>
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

<script>
  function approved(approveid) {
    // Add Sweet Alert confirmation
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to approve this loan?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Show a loading indicator
        Swal.fire({
          title: 'Processing...',
          text: 'Please wait while the loan is being approved.',
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading(); // Start the loader
          }
        });

        // Perform the AJAX call
        $.ajax({
          url: 'controllers/loanapproval.php',
          type: 'POST',
          data: { approveid: approveid },
          success: function(data) {
           //location reload
            location.reload();
          },
          error: function() {
            // Handle errors and close loader
            Swal.fire(
              'Error!',
              'Something went wrong. Please try again.',
              'error'
            );
          }
        });
      }
    });
  }
</script>
<script>
  function disapproved(disapproveid) {
    // Add Sweet Alert confirmation
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to disapprove this loan?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Disapprove it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Show a loading indicator
        Swal.fire({
          title: 'Processing...',
          text: 'Please wait while the loan is being disapproved.',
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading(); // Start the loader
          }
        });

        // Perform the AJAX call
        $.ajax({
          url: 'controllers/loanapproval.php',
          type: 'POST',
          data: { disapproveid: disapproveid },
          success: function(data) {
           //location reload
            location.reload();
            
          },
          error: function() {
            // Handle errors and close loader
            Swal.fire(
              'Error!',
              'Something went wrong. Please try again.',
              'error'
            );
          }
        });
      }
    });
  }
</script>

<?php
include 'includes/footer.php';
?>