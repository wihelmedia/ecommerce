<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(1)); ?></li>
      <li class="breadcrumb-item active" aria-current="page"><?= ucwords($this->uri->segment(2)); ?></li>
    </ol>
  </nav>
  <?= $this->session->userdata('msg'); ?>

  <div class="row">
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header text-warning">
          <?= $title; ?>
        </div>
        <div class="card-body">
          <?= form_open_multipart('user/changepassword'); ?>
          <div class="form-group row">
            <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
              <input type="password" name="current_password" id="current_password" class="form-control">
              <?= form_error('current_password', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="new_password1" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
              <input type="password" name="new_password1" id="new_password1" class="form-control">
              <?= form_error('new_password1', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="new_password2" class="col-sm-3 col-form-label">Repeat Password</label>
            <div class="col-sm-9">
              <input type="password" name="new_password2" id="new_password2" class="form-control">
              <?= form_error('new_password2', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <div class="col-sm-9">
              <button type="submit" name="button" class="btn btn-warning">Change Password</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->