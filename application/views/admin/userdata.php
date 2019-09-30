<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(1)); ?></li>
      <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(2)); ?></li>
    </ol>
  </nav>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="" class="btn btn-warning" data-toggle="modal" data-target="#adduser" id="modaluser1">Add New User</a>
       <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-5 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="keyword" name="keyword">
          <div class="input-group-append">
            <button class="btn btn-warning" type="submit">
              <i class="fas fa-search fa-sm" name="submit"></i>
            </button>
          </div>
        </div>
      </form>
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
                  <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="No. KTP" value="">
                  <?= form_error('no_ktp'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name" placeholder="User Name" value="">
                  <?= form_error('name'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="email" name="email" placeholder="User Email" value="">
                  <?= form_error('email'); ?>
                </div>
                <!-- <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="image">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose Your Image</label>
                  </div>
                </div> -->
                <div class="form-group">
                  <input type="text" class="form-control" id="password1" name="password1" placeholder="User Password" value="">
                  <?= form_error('password'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="password2" name="password2" placeholder="Password Confirm" value="">
                  <?= form_error('password2'); ?>
                </div>
                <!-- <div class="form-group">
                  <input type="text" class="form-control" id="role_id" name="role_id" placeholder="User Role">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active?</label>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <input type="text" class="form-control" id="date_created" name="date_created" placeholder="Date Created">
                </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                <button type="submit" class="btn btn-warning" id="addusers">Add</button>
              </div>
            </form>
          </div>

        </div>
      </div>
      <!-- modal editadduser -->
      <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modaluser2">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('admin/updateuser'); ?>" method="post" id="form" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="no_ktpedit" name="no_ktpedit" placeholder="No. KTP" value="">
                  <?= form_error('no_ktpedit'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="nameedit" name="nameedit" placeholder="User Name" value="">
                  <?= form_error('nameedit'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="emailedit" name="emailedit" placeholder="User Email" value="">
                  <?= form_error('emailedit'); ?>
                </div>
                <!-- <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="image">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose Your Image</label>
                  </div>
                </div> -->
                <div class="form-group">
                  <input type="text" class="form-control" id="password1edit" name="password1edit" placeholder="User Password" value="">
                  <?= form_error('password1edit'); ?>
                </div>
                <!-- <div class="form-group">
                  <input type="text" class="form-control" id="role_id" name="role_id" placeholder="User Role">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active?</label>
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <input type="text" class="form-control" id="date_created" name="date_created" placeholder="Date Created">
                </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                <button type="submit" class="btn btn-primary" id="eddusers">Edit</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <!-- table-bordered" id="dataTable" width="100%" cellspacing="0 -->
        <table class="table" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Image</th>
              <th>Password</th>
              <th>Role_Id</th>
              <th>Is_Active</th>
              <th>Status</th>
              <th>Date_Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($userdata as $u) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $u['name']; ?></td>
                <td><?= $u['email']; ?></td>
                <td><?= $u['image']; ?></td>
                <td><?= $u['password']; ?></td>
                <td><?= $u['role_id']; ?></td>
                <td><?= $u['is_active']; ?></td>
                <td>
                  <?php if ($u['status'] == 1) : ?>
                    <p class="badge badge-success">Online</p>
                  <?php else : ?>
                    <p class="badge badge-secondary">Offline</p>
                  <?php endif; ?>
                </td>
                <td><?= $u['date_created']; ?></td>
                <td>
                  <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                  <a href="" class="badge badge-success editus" data-toggle="modal" data-target="#edituser" data-id="<?= $u['id']; ?>">Edit</a>
                  <a href="<?= base_url(); ?>admin/delUser/<?= $u['id']; ?>" class="badge badge-danger">Delete</a>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>

</div>
<!-- /.container-fluid -->