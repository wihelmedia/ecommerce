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
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addm" id="modalLabel3">Add New Menu</a>
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
                    <form action="<?= base_url('menu'); ?>" method="post">
                      <div class="modal-body">
                        <div class="form-group">
                          <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                        <button type="submit" class="btn btn-primary" id="added">Add</button>
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
                      <th>Menu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($menu as $uMenu): ?>
                      <tr>
                        <td><?= $uMenu['id']; ?></td>
                        <td><?= $uMenu['menu']; ?></td>
                        <td>
                          <a href="" class="badge badge-success edit" data-toggle="modal" data-target="#addm" data-id="<?= $uMenu['id']; ?>">Edit</a>
                          <a href="<?= base_url(); ?>menu/delMenu/<?= $uMenu['id']; ?>" class="badge badge-danger">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
