
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="includes/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="includes/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="includes/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="includes/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="includes/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="includes/assets/plugins/toastr/toastr.min.js"></script>
<!-- ChartJS -->
<script src="includes/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="includes/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="includes/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="includes/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="includes/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="includes/assets/plugins/moment/moment.min.js"></script>
<script src="includes/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="includes/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="includes/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="includes/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="includes/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="includes/assets/dist/js/pages/dashboard.js"></script>

<!-- DataTables -->
<script src="includes/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="includes/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
      //search box size and position
      "search": {
        "placeholder": "Search...",
        "className": "form-control-sm form-control",
      
      }
      
      

    });
    $('#example1_filter input')
        .attr('placeholder', 'Search...')
        .addClass('form-control-sm form-control'); 
  });
</script>
<?php
if (isset($_SESSION['msgstatus'])) {
  if ($_SESSION['msgstatus'] == 'success') {
    ?>
    <script>
      $(document).ready(function() {
        Swal.fire({
          title: 'Success',
          text: '<?php echo addslashes($_SESSION['msg']); ?>', // Wrapped in quotes and escaped
          icon: 'success',
          confirmButtonText: 'Ok'
        });
      });
    </script>
    <?php
  } else {
    ?>
    <script>
      $(document).ready(function() {
        Swal.fire({
          title: 'Error',
          text: '<?php echo addslashes($_SESSION['msg']); ?>', // Wrapped in quotes and escaped
          icon: 'error',
          confirmButtonText: 'Ok'
        });
      });
    </script>
    <?php
  }
  unset($_SESSION['msgstatus']);
}
?>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
