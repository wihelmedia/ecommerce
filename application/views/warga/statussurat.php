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
            <!-- <a href="" class="btn btn-warning" data-toggle="modal" data-target="#adduser" id="modaluser1">Add New User</a> -->
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
                                        <input type="checkbox" name="is_active" value="1" id="is_active" class="form-check-input" checked>
                                        <label for="is_active" class="form-check-label">Active?</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="date_created" name="date_created" placeholder="Date Created">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                                <button type="submit" class="btn btn-warning" id="addusers">Add</button>
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
                            <th>Name</th>
                            <th>No. KTP</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                            <th>Date_Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($surat as $s) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $s['name']; ?></td>
                                <td><?= $s['no_ktp']; ?></td>
                                <td><?= $s['keperluan']; ?></td>
                                <td>
                                    <?php if ($s['status'] == 'N') : ?>
                                        <p class="text-danger">Belum setujui</p>
                                    <?php elseif ($s['status'] == 'P') : ?>
                                        <p class="text-primary">Sudah disetujui dan akan diproses</p>
                                    <?php elseif ($s['status'] == 'Y') : ?>
                                        <p class="text-success">Selesai diproses</p>
                                    <?php endif; ?>
                                </td>
                                <td><?= date("d/F/Y", strtotime($s['date_created'])); ?></td>
                                <td>
                                    <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                    <a href="" class="badge badge-success edituser" data-toggle="modal" data-target="#adduser" data-id="<?= $s['id']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>warga/delpesan/<?= $s['id']; ?>" class="badge badge-danger delsur">Delete</a>
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