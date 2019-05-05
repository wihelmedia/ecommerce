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
              <?= $this->session->flashdata('msg'); ?>
              <h5>Role : <?= $role_id['role']; ?></h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Menu</th>
                      <th>Access</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m): ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $m['menu']; ?></td>
                        <td>
                          <div class="form-check">
                            <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                            <input class="form-check-input" type="checkbox" <?= check_access($role_id['id'], $m['id']); ?>
                            data-role="<?= $role_id['id']; ?>" data-menu="<?= $m['id']; ?>">
                          </div>
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
