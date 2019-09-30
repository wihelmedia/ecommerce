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
      <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addsubmenu" id="modalLabel1">Add New Submenu</a>
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
      <!-- modal addsubmenu -->
      <div class="modal fade" id="addsubmenu" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel2">Add Submenu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post" id="form">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                </div>
                <div class="form-group">
                  <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">Select Menu</option>
                    <?php foreach ($menu as $m) : ?>
                      <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" checked>
                    <label for="is_active" class="form-check-label">Active?</label>
                  </div>
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
              <th>Title</th>
              <!-- <th>Menu</th> -->
              <th>Url</th>
              <th>Icon</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($subMenu as $sm) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $sm['title']; ?></td>
                <!-- <td><?= $sm['menu']; ?></td> -->
                <td><?= $sm['url']; ?></td>
                <td><?= $sm['icon']; ?></td>
                <td><?= $sm['is_active']; ?></td>
                <td>
                  <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                  <a href="" class="badge badge-success" data-toggle="modal" data-target="#addsubmenu" data-id="<?= $sm['id']; ?>">Edit</a>
                  <a href="<?= base_url(); ?>menu/deleteSubMenu/<?= $sm['id']; ?>" class="badge badge-danger submenu">Delete</a>
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