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
            <h1 class="m-0 text-dark">Manage Clients   </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Client Information</li>
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
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Client Status</th>
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
                          $csql = "SELECT * FROM `clientinformation`";
                          $cquery = mysqli_query($conn, $csql);
                          foreach($cquery as $c){
                            if($c['MIDDLENAME']==''){
                              $name = $c['LASTNAME'].', '.$c['FIRSTNAME'];
                            }else{
                              $name = $c['LASTNAME'].', '.$c['FIRSTNAME'].' '.$c['MIDDLENAME'][0];
                            }
                            ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $c['DEPARTMENT']; ?></td>
                                <td><?php echo $c['POSITION']; ?></td>
                                <td><?php echo $c['REGISTRATIONSTATUS']; ?></td>
                                <?php
                                if($_SESSION['role']=='ADMIN'){
                                  ?>
                                  <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#UpdateStatus<?php echo $c['ID']; ?>">Update Status</button>
                                  </td>
                                  <?php
                                }
                                ?>
                               
                                <div class="modal fade" id="UpdateStatus<?php echo $c['ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <?php
                                        $id = $c['ID'];
                                        $msql = "SELECT * FROM clientimage WHERE CLIENT_ID = '$id' AND `TYPE` = 'VALIDID'";
                                        $mquery = mysqli_query($conn, $msql);
                                        $vrow = mysqli_fetch_array($mquery);

                                        $msql2 = "SELECT * FROM clientimage WHERE CLIENT_ID = '$id' AND `TYPE` = 'USERPIC'";
                                        $mquery2 = mysqli_query($conn, $msql2);
                                        $urow = mysqli_fetch_array($mquery2);

                                        ?>
                                        <form action="controllers/updatestatus.php" method="post">
                                          <div class="row">
                                            <div class="col">
                                            <img src="../uploads/documents/<?php echo $vrow['FILEP']?>" class="img-thumbnail" alt="...">
                                            </div>
                                            
                                            <div class="col">
                                              <div class="form-group mb-2">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" readonly>
                                              </div>
                                              <div class="form-group mb-2">
                                                <label for="department" class="form-label">Department</label>
                                                <input type="text" class="form-control" id="department" name="department" value="<?php echo $c['DEPARTMENT']; ?>" readonly>
                                              </div>
                                              <div class="form-group mb-2">
                                                <label for="position" class="form-label">Position</label>
                                                <input type="text" class="form-control" id="position" name="position" value="<?php echo $c['POSITION']; ?>" readonly>
                                              </div>
                                              <div class="form-group mb-2">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                  <option value="APPROVED">APPROVED</option>
                                                  <option value="DENIED">DENIED</option>
                                                  <option value="BANNED">BANNED</option>
                                                </select>
                                              </div>
                                              <div class="form-group mb-2">
                                                <input type="hidden" name="id" value="<?php echo $c['ID']?>">
                                                <input type="hidden" name="email"  value="<?php echo $c['EMAIL']?>">
                                              <label for="status" class="form-label">Remark</label>
                                                <textarea name="remark" class="form-control" id=""></textarea>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="updatestatus" class="btn btn-primary">Save changes</button></form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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
include 'includes/script.php';
?>

<?php
include 'includes/footer.php';
?>