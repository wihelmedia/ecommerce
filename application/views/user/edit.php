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
          <?= form_open_multipart('user/edit'); ?>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" name="email" id="email" class="form-control" value="<?= $user['email']; ?>" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Full name</label>
            <div class="col-sm-10">
              <input type="text" name="name" id="name" class="form-control" value="<?= $user['name']; ?>">
              <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-2">Picture</div>
            <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose Image</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" name="button" class="btn btn-warning">Edit</button>
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