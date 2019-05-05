<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(1)); ?></li>
              <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(2)); ?></li>
            </ol>
          </nav>
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#adduser" id="modaluser1">Add New User</a>
              <?php if (validation_errors()) : ?>
                <div class="alert alert-danger col-sm-6 mx-auto mt-3" role="alert"><?= validation_errors(); ?></div>
              <?php endif; ?>
              <?= $this->session->flashdata('msg'); ?>
              <!-- modal adduser -->
              <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modaluser2">Add User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="<?= base_url('admin/addNewUser'); ?>" method="post" id="form" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="form-group">
                          <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="email" name="email" placeholder="User Email">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="image">Upload</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose Your Image</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="password" name="password" placeholder="User Password">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="role_id" name="role_id" placeholder="User Role">
                        </div>
                        <div class="form-group">
                          <div class="form-check">
                            <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input"checked>
                            <label for="is_active" class="form-check-label">Active?</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="date_created" name="date_created" placeholder="Date Created">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                        <button type="submit" class="btn btn-primary" id="addusers">Add</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Image</th>
                      <th>Password</th>
                      <th>Role_Id</th>
                      <th>Is_Active</th>
                      <th>Date_Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($userdata as $u): ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><?= $u['image']; ?></td>
                        <td><?= $u['password']; ?></td>
                        <td><?= $u['role_id']; ?></td>
                        <td><?= $u['is_active']; ?></td>
                        <td><?= $u['date_created']; ?></td>
                        <td>
                          <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                          <a href="" class="badge badge-success edituser" data-toggle="modal" data-target="#adduser" data-id="<?= $u['id']; ?>">Edit</a>
                          <a href="<?= base_url(); ?>admin/delUser/<?= $u['id']; ?>" class="badge badge-danger">Delete</a>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
