<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="controllers/addcontrollers.php" method="post" autocomplete="OFF">
                <div class="form-group mb-2">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="lastname" id="lastname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                  <label for="email">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                  <label for="email">Middle Name</label>
                    <input type="text" name="middlename" id="middlename" class="form-control">
                </div>
                <div class="form-group mb-2">
                  <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="email">Contact Number</label>
                    <input type="text" name="contact" id="contact" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                  <label for="email">Role</label>
                    <select name="role" id="role" class="form-control" required>
                      <option value="ADMIN">Admin</option>
                      <option value="EMPLOYEE">User</option>
                    </select>
                </div>
                 
                
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="user" class="btn btn-primary">Save user</button></form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>