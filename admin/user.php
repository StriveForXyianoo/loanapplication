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
            <h1 class="m-0 text-dark">Manage Users   </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                    <h3 class="card-title">Client Information</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default">
                        Add Users
                      </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <?php
                                if($_SESSION['role']=='ADMIN'){
                                  ?>
                                  <th>Action</th>
                                  <?php
                                }
                                ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = "SELECT * FROM users";
                          $result = $conn->query($sql);
                          foreach($result as $row){
                            if($row['MIDDLENAME']==''){
                              $name = $row['LASTNAME'].', '.$row['FIRSTNAME'];
                            }else{
                              $name = $row['LASTNAME'].', '.$row['FIRSTNAME'].' '.$row['MIDDLENAME'];
                            }
                            ?>
                            <tr>
                              <td><?php echo $name; ?></td>
                              <td><?php echo $row['EMAILADDRESS']; ?></td>
                              <td><?php echo $row['ROLES']; ?></td>
                              <?php
                                if($_SESSION['role']=='ADMIN'){
                                  ?>
                                  <td>
                                    <button class="btn btn-danger btn-sm" onclick="uDelete(<?php echo $row['ID']; ?>)">Delete</button>
                                  </td>
                                  <?php
                                }
                              ?>
                              
                            </tr>
                            <?php
                          }
                          ?>
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
include 'modal.php';
include 'includes/script.php';
?>
<script>
  function uDelete(user){
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to delete this data?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        //goto delete.php
        $.ajax({
          type: "POST",
          url: "controllers/delete.php",
          data: {
            user: user
          },
          success: function(data) {
            if (data == "success") {
              Swal.fire(
                'Deleted! ',
                'Your file has been deleted.',
                'success'
              )
              setTimeout(() => {
                location.reload();
              }, 1000);
            } else {
              Swal.fire(
                'Error!',
                'There was an error deleting your file.',
                'error'
              )
            }
          }
        });
      }
    });
  }
</script>
<?php
include 'includes/footer.php';
?>