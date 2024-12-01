<?php
include 'includes/header.php';
include 'includes/nav.php';
include 'includes/sidebar.php';
$id = $_GET['id'];
$sql = "SELECT * FROM clientloan WHERE ID = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$clientid = $row['CLIENTID'];
$clientsql = "SELECT * FROM clientinformation WHERE ID = '$clientid'";
$clientresult = $conn->query($clientsql);
$clientrow = $clientresult->fetch_assoc();


?>
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
    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">Loan Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Loan Amount</td>
                                    <td>
                                        <?php echo number_format($row['LOANAMOUNT'],2)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Term</td>
                                    <td>
                                        <?php echo $row['TERM']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Interest</td>
                                    <td>
                                        <?php echo number_format($row['INTEREST'],2)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CBU</td>
                                    <td>
                                        <?php echo number_format($row['CBU'],2)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Filling Fee</td>
                                    <td>
                                        <?php echo number_format($row['FILLING'],2)?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Net Proceed</td>
                                    <td>
                                        <?php echo number_format($row['NETPRO'],2)?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th colspan="2"> Client Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>
                                        <?php 
                                        if($clientrow['MIDDLENAME'] == ''){
                                            echo $clientrow['FIRSTNAME'].' '.$clientrow['LASTNAME'];
                                        }else{
                                            echo $clientrow['FIRSTNAME'].' '.$clientrow['MIDDLENAME'][0].'. '.$clientrow['LASTNAME'];
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td>
                                        <?php echo $clientrow['DEPARTMENT']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td>
                                        <?php echo $clientrow['POSITION']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loan Type</td>
                                    <td>
                                        <?php $id = $row['LOANID'];
                                        $lsql = "SELECT * FROM loantype WHERE ID = '$id'";
                                        $lresult = $conn->query($lsql);
                                        $lrow = $lresult->fetch_assoc();
                                        echo $lrow['TPID'].' / '.$lrow['LOANTYPE'];

                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loan Status</td>
                                    <td>
                                        <?php echo $row['STATUS']?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if($row['STATUS'] == 'APPROVED' || $row['STATUS'] == 'DONE'){
            ?>
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title text-center">Loan Payment</h3>
                    <?php
                    if($row['STATUS']!='DONE'){
                        ?>
                        <button  onclick="doneLoan(<?php echo $_GET['id'];?>)"  class=" float-right btn btn-warning btn-sm">Done Payment</button>
                        <?php
                    }
                    ?>
                </div>
                <div class="card-body">
                   <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <table class="table table-bordered table-stripped" id="example1">
                            <thead>
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ll = $_GET['id'];
                                $pysql = "SELECT * FROM paymentloan WHERE LOANID = '$ll' ORDER BY DATEPAYMENT ASC";
                                $pyresult = $conn->query($pysql);
                                foreach($pyresult as $pyrow){
                                    ?>
                                    <tr>
                                        <td><?php echo $pyrow['DATEPAYMENT']?></td>
                                        <td><?php echo number_format($pyrow['AMOUNT'],2)?></td>
                                        <td><?php echo $pyrow['REMARK']?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <form action="controllers/loanapproval.php" method="post">
                            <input type="hidden" name="id" value="<?php  echo $_GET['id']?>" >
                            <label for="Payment">Payment Date</label>
                            <input type="date" name="paymentdate" class="form-control" required>

                            <label for="Payment">Amount</label>
                            <input type="number" name="amount" class="form-control" required>
                            <label for="Payment">Remarks</label>
                            <textarea name="remarks" class="form-control"></textarea>
                            <?php
                            if($row['STATUS']!='DONE'){
                                ?>
                                <button type="submit" name="payment" class="btn btn-success btn-sm mt-2">Add Payment</button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                   </div> 
                   
                </div>
            </div>
            <?php
        }
        ?>
        
      </div>
    </section>
<?php
include 'includes/script.php';
?>
<script>
    function doneLoan(doneid){
        Swal.fire({
      title: 'Are you sure?',
      text: "You are about to mark this loan as done payment. This action is irreversible.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Mark it as done!'
    }).then((result) => {
      if (result.isConfirmed) {
        // Show a loading indicator
        Swal.fire({
          title: 'Processing...',
          text: 'Please wait',
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
          data: { doneid: doneid },
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