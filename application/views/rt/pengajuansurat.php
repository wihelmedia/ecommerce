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
            <div class="modal fade" id="delpesan" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaluser6">Detail Pesan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('rt/detailsurat'); ?>" method="post" id="form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" disabled name="id" id="id" placeholder="Id" value="<?= $surat1['id']; ?>" />
                                    <?= form_error('id'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" disabled name="no_hp" id="no_hp" placeholder="No. HP" value="<?= $surat1['no_hp']; ?>" />
                                    <?= form_error('no_hp'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" disabled name="no_ktp" id="no_ktp" placeholder="No KTP" value="<?= $surat1['no_ktp']; ?>" />
                                    <?= form_error('no_ktp'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" disabled name="name" id="name" placeholder="Nama" value="<?= $surat1['name']; ?>" />
                                    <?= form_error('name'); ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $pil_keperluan = array(
                                        "" => "-- Pilihan --",
                                        "Mengurus KK" => "Mengurus KK",
                                        "Mengurus KTP" => "Mengurus KTP",
                                        "Mengurus Pindah Domisili" => "Mengurus Pindah Domisili",
                                        "Mengurus SKCK" => "Mengurus SKCK"
                                    );
                                    echo form_dropdown('keperluan', $pil_keperluan, $surat1['keperluan'], 'class="form-control" id="keperluan"');
                                    echo form_error('keperluan')
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" disabled name="date_created" id="date_created" placeholder="Date Created" value="<?= date("d/M/Y", strtotime($surat1['date_created'])); ?>" />
                                    <?= form_error('date_created'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" disabled name="status" id="status" placeholder="Status" value="<?= $surat1['status']; ?>" />
                                    <?= form_error('status'); ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                                <button type="submit" class="btn btn-warning" id="approvsurat">Disetujui</button>
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
                                    <a href="" class="badge badge-success delpesan" data-toggle="modal" data-target="#delpesan" data-id="<?= $s['id']; ?>">Detail</a>
                                    <a href="<?= base_url(); ?>rt/prosespesan/<?= $s['id']; ?>" class="badge badge-info">Proses</a>
                                    <a href="<?= base_url(); ?>rt/print/<?= $s['id']; ?>" class="badge badge-warning"><i class="fas fa-print fa-sm text-white-50"></i> Print</a>
                                    <a href="<?= base_url(); ?>rt/delpesan/<?= $s['id']; ?>" class="badge badge-danger">Delete</a>
                                    <a href="<?= base_url(); ?>rt/selesai/<?= $s['name']; ?>/<?= $s['no_hp']; ?>" class="badge badge-success">Selesai</a>
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