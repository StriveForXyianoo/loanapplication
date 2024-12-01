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
          <h1 class="m-0 text-dark">Apply Loan </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Apply Loan</li>
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

        <div class="col-lg-6">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title text-center">Apply Loan</h3>
            </div>
            <div class="card-body">

              <div class="form-group mb-2">
                <label for="loan">Loan Type</label>
                <select name="loantype" id="loantype" class="form-control">
                  <option value="" selected disabled>Select Type</option>
                  <?php
                  $sql = "SELECT * FROM loantype GROUP BY TPID";
                  $result = mysqli_query($conn, $sql);
                  foreach ($result as $row) {
                  ?>
                    <option value="<?= $row['TPID'] ?>"><?= $row['TPID'] ?></option>
                  <?php
                  }

                  ?>
                </select>
              </div>
              <div class="form-group mb-2">
                <label for="loan">Loan Name</label>
                <select name="loanname" id="loanname" class="form-control">

                </select>
              </div>
              <span class="badge bg-secondary" id="note"></span>
              <div class="form-group mb-2">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" disabled>
              </div>



              <div class="form-group mb-2">
                <button type="button" id="compute" class="btn btn-success btn-sm">View Computation</button>
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-outline card-success">
            <div class="card-body">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th colspan="2">Computation of Loan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Amount</td>
                    <td id="amountbarrow"></td>
                  </tr>
                  <tr>
                    <td>Terms (Month/s)</td>
                    <td id="term"></td>
                  </tr>
                  <tr>
                    <td>Interest</td>
                    <td id="interest"></td>
                  </tr>
                  <tr>
                    <td>Service Fee</td>
                    <td id="service"></td>
                  </tr>
                  <tr>
                    <td>CBU</td>
                    <td id="cbu"></td>
                  </tr>
                  <tr>
                    <td>Filling Fee</td>
                    <td id="filling"></td>
                  </tr>
                  <tr>
                    <td>Insurance</td>
                    <td id="insurance"></td>
                  </tr>
                  <tr>
                    <td>Net Proceed</td>
                    <td id="netpro"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Montly</td>
                    <td id="monthly"></td>
                  </tr>
                  <tr>
                    <!-- <form action="controllers/applyloan" method="post">
                            <input type="hidden" name="clientID" value="">
                            <input type="hidden" name="loanID" id="loannameID">
                            <input type="hidden" name="amount" id="loanamount">
                            <input type="hidden" name="term" id="loanterm">
                            <input type="hidden" name="interest" id="loaninterest">
                            <input type="hidden" name="service" id="loanservice">
                            <input type="hidden" name="cbu" id="loancbu">
                            <input type="hidden" name="filling" id="loanfilling">
                            <input type="hidden" name="insurance" id="loaninsurance">
                            <input type="hidden" name="netpro" id="loannetpro">
                            <td colspan="2">
                            <button  id="applyLoanButton" class="btn btn-sm btn-warning float-right">Submit Application</button>
                          </td>
                          </form> -->
                    <form id="loanForm">
                      <input type="hidden" name="clientID" value="<?= $_SESSION['id'] ?>">
                      <input type="hidden" name="loanID" id="loannameID">
                      <input type="hidden" name="amount" id="loanamount">
                      <input type="hidden" name="term" id="loanterm">
                      <input type="hidden" name="interest" id="loaninterest">
                      <input type="hidden" name="service" id="loanservice">
                      <input type="hidden" name="cbu" id="loancbu">
                      <input type="hidden" name="filling" id="loanfilling">
                      <input type="hidden" name="insurance" id="loaninsurance">
                      <input type="hidden" name="netpro" id="loannetpro">
                      <td colspan="2">
                        <button type="submit" id="applyLoanButton" class="btn btn-sm btn-warning float-right">Submit Application</button>
                      </td>

                    </form>


                  </tr>
                </tbody>
              </table>
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
  $(document).ready(function() {
    $('#loantype').change(function() {
      var loantype = $(this).val();

      // Make an AJAX request to fetch loan names
      $.ajax({
        url: 'fetchloan.php', // Path to your PHP script
        type: 'POST',
        data: {
          loantype: loantype
        },
        success: function(response) {
          // Populate the loanname dropdown with the response data
          $('#loanname').html(response);
          // alert(response);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#loanname').change(function() {
      var loanname = $(this).val();

      // Make an AJAX request to fetch information related to loanname
      $.ajax({
        url: 'fetchamount.php', // Path to your PHP script
        type: 'POST',
        data: {
          loanname: loanname
        },
        success: function(response) {
          // Display the fetched data in the #note span
          $('#note').text(response);
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", status, error);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#loanname').change(function() {
      var loanname = $(this).val();
      //clear the amount field
      $('#amount').val('');

      // Make an AJAX request to fetch information related to loanname
      $.ajax({
        url: 'fetchfix.php', // Path to your PHP script
        type: 'POST',
        data: {
          loanname: loanname
        },
        dataType: 'json', // Expect JSON response
        success: function(response) {
          if (response.FITT === "NOT") {
            // Enable the amount field
            $('#amount').prop('disabled', false);
          } else {
            // Disable and set the amount field
            $('#amount').prop('disabled', true).val(response.MAXAM);
          }
        }

      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#compute').click(function() {
      var loanname = $('#loanname').val();
      var amount = $('#amount').val();
      //1% as interest
      var interestab = 0.01;
      var servicefee = 0.07;
      var cbu = 0.04;
      var filling = 20;
      var insurance = 0.56;
      var addi = 0;
      //check if the amount is below 50000
      if (amount < 50000) {
        addi = 20;
      } else {
        addi = 0;
      }

      // Make an AJAX request to fetch information related to loanname
      $.ajax({
        url: 'fetchcompute.php', // Path to your PHP script
        type: 'POST',
        data: {
          loanname: loanname,
          amount: amount
        },
        dataType: 'json', // Expect JSON response
        success: function(response) {

          $('#amountbarrow').text(amount);
          $('#loanamount').val(amount);
          $('#loannameID').val(loanname);
          $('#term').text(response.TERM);
          $('#loanterm').val(response.TERM);
          var interest = (amount * interestab * response.TERM).toFixed(2);
          $('#interest').text(interest);
          $('#loaninterest').val(interest);
          var service = (amount * servicefee).toFixed(2);
          $('#service').text(service);
          $('#loanservice').val(service);

          var cbuamount = (amount * cbu).toFixed(2);
          $('#cbu').text(cbuamount);
          $('#loancbu').val(cbuamount);
          $('#filling').text(filling);
          $('#loanfilling').val(filling);
          var insuranceamount = (amount / 1000 * insurance * response.TERM + addi).toFixed(2);
          $('#insurance').text(insuranceamount);
          $('#loaninsurance').val(insuranceamount);
          var netproceed = (parseFloat(amount) - parseFloat(interest) - parseFloat(service) - parseFloat(cbuamount) - parseFloat(filling) - parseFloat(insuranceamount)).toFixed(2);
          $('#netpro').text(netproceed);
          $('#loannetpro').val(netproceed);
          $monthly = (amount / response.TERM).toFixed(2);
          $('#monthly').text($monthly);

        }
      });
    });
  });
</script>

<script>
$(document).ready(function() {
  $('#applyLoanButton').on('click', function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Collect form data
    var formData = $('#loanForm').serialize();

    // Send the data using AJAX
    $.ajax({
      type: 'POST',
      url: 'controllers/applyloan.php',
      data: formData,
      success: function(response) {
        //add sweet alert
        
          Swal.fire({
            icon: response.status,
            title: response.status,
            text: response.message
          });
          //redirect to the facerecognition page with the special order
          if(response.status == 'success'){
            window.location.href = 'face_recognition.php?specialorder='+response.specialorder;
          }
       
      },
      error: function(xhr, status, error) {
        // Handle errors
        alert('There was an error submitting your application');
      }
    });
  });
});
</script>
<?php
if(isset($_SESSION['status'])){
  ?>
  <script>
          Swal.fire({
            icon: '<?= $_SESSION['status'] ?>',
            title: '<?= $_SESSION['status'] ?>',
            text: '<?= $_SESSION['msg'] ?>'
          });
  </script>
  <?php
  unset($_SESSION['status']);
}
?>

<?php
include 'includes/footer.php';
?>