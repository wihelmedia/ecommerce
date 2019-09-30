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
      <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addm" id="modalLabel3">Add New Menu</a>
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
      <?= form_error('menu', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('msg'); ?>
      <div class="modal fade" id="addm" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel4">Add Menu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post" id="form">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                <button type="submit" class="btn btn-warning" id="add">Add</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Menu</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($menu as $uMenu) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $uMenu['menu']; ?></td>
                <td>
                  <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                  <a href="" class="badge badge-success edit" data-toggle="modal" data-target="#addm" data-id="<?= $uMenu['id']; ?>">Edit</a>
                  <a href="<?= base_url(); ?>menu/delMenu/<?= $uMenu['id']; ?>" class="badge badge-danger menu">Delete</a>
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