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
            <h1 class="m-0 text-dark">Beneficiary  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Beneficiary</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Beneficiaries</h3>
                </div>
                <div class="card-body">
                    <form action="controllers/bene" method="post">
                        <table class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Relationship</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <input type="hidden" name="id" value="<?php echo $_SESSION['id']?>">
                                <td><input type="text" name="name1" class="form-control" required></td>
                                <td><input type="text" name="relationship1" class="form-control" required></td>
                              
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><input type="text" name="name2" class="form-control" required></td>
                                <td><input type="text" name="relationship2" class="form-control" required></td>
                                
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><input type="text" name="name3" class="form-control" required></td>
                                <td><input type="text" name="relationship3" class="form-control" required></td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                               
                                <td>
                                    <button type="submit" name="benefile" class="btn btn-sm btn-success">Save Information</button>
                                    <button type="reset" class="btn btn-sm btn-danger">Clear</button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
include 'includes/script.php';
?>
<?php
include 'includes/footer.php';
?>