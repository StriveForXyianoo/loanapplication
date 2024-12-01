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
            <h1 class="m-0 text-dark">Loan Management    </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loan</li>
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
          <div class="col-lg-4 col-sm-12 col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title text-center">Pending Loan</h3>
              </div>
              <div class="card-body">
                <?php
                $clientid = $_SESSION['id'];
                $plsql = "SELECT * FROM clientloan WHERE CLIENTID = '$clientid' AND STATUS = 'Pending'";
                $plresult = mysqli_query($conn, $plsql);
                if(mysqli_num_rows($plresult) > 0) {
                  foreach($plresult as $plrow){
                    ?>
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><?php $loanID= $plrow["LOANID"];
                          $lisql = "SELECT * FROM loantype WHERE ID = '$loanID'";
                          $liresult = mysqli_query($conn, $lisql);
                          $lirow = mysqli_fetch_assoc($liresult);
                          echo $lirow["LOANTYPE"]

                          ?></h3>
                        </div>
                        <div class="card-body">
                          <h6><?php echo "₱".number_format($plrow["LOANAMOUNT"],2,".",",")?></h6>
                          <p><?php echo date('F j, Y', strtotime($plrow["LOANDATE"]));?></p>
                          <p class="text-danger"><?php echo $plrow["STATUS"]?></p>
                         
                          <button onclick="loancancel(<?php echo $plrow['ID']?>)" class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                      </div>

                    <?php
                  }
                }else{
                  echo "<p class='text-center text-danger'>No Pending Loan</p>";
                }
                ?>
               
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-md-12">
            <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title text-center">Approved Loan</h3>
              </div>
              <div class="card-body">
              
              <?php
                $clientid = $_SESSION['id'];
                $plsql = "SELECT * FROM clientloan WHERE CLIENTID = '$clientid' AND STATUS = 'APPROVED'";
                $plresult = mysqli_query($conn, $plsql);
                if(mysqli_num_rows($plresult) > 0) {
                  foreach($plresult as $plrow){
                    ?>
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><?php $loanID= $plrow["LOANID"];
                          $lisql = "SELECT * FROM loantype WHERE ID = '$loanID'";
                          $liresult = mysqli_query($conn, $lisql);
                          $lirow = mysqli_fetch_assoc($liresult);
                          echo $lirow["LOANTYPE"]

                          ?></h3>
                        </div>
                        <div class="card-body">
                          <h6><?php echo "₱".number_format($plrow["LOANAMOUNT"],2,".",",")?></h6>
                          <p><?php echo date('F j, Y', strtotime($plrow["LOANDATE"]));?></p>
                          <p class="text-danger"><?php echo $plrow["STATUS"]?></p>

                        </div>
                      </div>

                    <?php
                  }
                }else{
                  echo "<p class='text-center text-danger'>No Approved Loan</p>";
                }
                ?>

              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12 col-md-12">
            <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title text-center">Done/Decline/Cancel Loan</h3>
              </div>
              <div class="card-body">

              <?php
                $clientid = $_SESSION['id'];
                $plsql = "SELECT * FROM clientloan WHERE CLIENTID = '$clientid' AND STATUS = 'DONE' OR STATUS = 'DECLINED'  OR STATUS = 'CANCELLED'";
                $plresult = mysqli_query($conn, $plsql);
                if(mysqli_num_rows($plresult) > 0) {
                  foreach($plresult as $plrow){
                    ?>
                     <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title"><?php $loanID= $plrow["LOANID"];
                          $lisql = "SELECT * FROM loantype WHERE ID = '$loanID'";
                          $liresult = mysqli_query($conn, $lisql);
                          $lirow = mysqli_fetch_assoc($liresult);
                          echo $lirow["LOANTYPE"]

                          ?></h3>
                        </div>
                        <div class="card-body">
                          <h6><?php echo "₱".number_format($plrow["LOANAMOUNT"],2,".",",")?></h6>
                          <p><?php echo date('F j, Y', strtotime($plrow["LOANDATE"]));?></p>
                          <p class="text-danger"><?php echo $plrow["STATUS"]?></p>
                          
                          
                        </div>
                      </div>

                    <?php
                  }
                }else{
                  echo "<p class='text-center text-danger'>No Done/Declined Loan</p>";
                }
                ?>

              </div>
            </div>
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
  function loancancel(cancelthisid){
    //add a  sweet alert confirmation and  loader
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to cancel this loan?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Cancel it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "controllers/cancelloan.php",
          data: {
            cancelthisid: cancelthisid
          },
          success: function(response){
            Swal.fire(
              'Cancelled!',
              'Your loan has been cancelled.',
              'success'
            ).then((result) => {
              location.reload();
            });
          }
        });
      }
    });

    
  }
</script>
<?php
include 'includes/footer.php';
?>