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
    <?= form_open_multipart('rt/carikk'); ?>
    <div class="form-group">
        <input type="text" class="form-control" name="carikk" id="carikk" placeholder="Cari Anggota Keluarga Berdasarkan No. Kartu Keluarga" value="" />
        <?= form_error('carikk'); ?>
    </div>
    <button type="submit" class="btn btn-warning mb-5" id="addcarikk">Cari</button>
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addkar" id="modalLabel15">Tambah Kartu Keluarga</a>
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
            <div class="modal fade" id="addkar" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel16">Form Tambah Data Kartu Keluarga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/kartukeluarga'); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No. Kartu Keluarga" value="<?= $no_kk; ?>" />
                                <?= form_error('no_kk'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kpl_keluarga" id="kpl_keluarga" placeholder="Kepala Keluarga" value="<?= $kpl_keluarga; ?>" />
                                <?= form_error('kpl_keluarga'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $alamat; ?>" />
                                <?= form_error('alamat'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rt" id="rt" placeholder="RT" value="<?= $rt; ?>" />
                                <?= form_error('rt'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rw" id="rw" placeholder="RW" value="<?= $rw; ?>" />
                                <?= form_error('rw'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="desa_kel" id="desa_kel" placeholder="Desa/Kel" value="<?= $desa_kel; ?>" />
                                <?= form_error('desa_kel'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= $kecamatan; ?>" />
                                <?= form_error('kecamatan'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kab_kota" id="kab_kota" placeholder="Kabupaten/Kota" value="<?= $kab_kota; ?>" />
                                <?= form_error('kab_kota'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kd_pos" id="kd_pos" placeholder="Kode Pos" value="<?= $kd_pos; ?>" />
                                <?= form_error('kd_pos'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_prov = array(
                                    "" => "-- Pilihan --",
                                    "Kalimantan Timur" => "Kalimantan Timur"
                                );
                                echo form_dropdown('provinsi', $pil_prov, $provinsi, 'class="form-control" id="provinsi"');
                                echo form_error('provinsi')
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="addkk">Add</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="editkar" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel17">Form Edit Data Kartu Keluarga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/updatekartukeluarga'); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_kkedit" id="no_kkedit" placeholder="No. Kartu Keluarga" value="" />
                                <?= form_error('no_kkedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kpl_keluargaedit" id="kpl_keluargaedit" placeholder="Kepala Keluarga" value="" />
                                <?= form_error('kpl_keluargaedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamatedit" id="alamatedit" placeholder="Alamatedit" value="" />
                                <?= form_error('alamatedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rtedit" id="rtedit" placeholder="RT" value="" />
                                <?= form_error('rtedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rwedit" id="rwedit" placeholder="RW" value="" />
                                <?= form_error('rwedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="desa_keledit" id="desa_keledit" placeholder="Desa/Kel" value="" />
                                <?= form_error('desa_keledit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kecamatanedit" id="kecamatanedit" placeholder="Kecamatanedit" value="" />
                                <?= form_error('kecamatanedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kab_kotaedit" id="kab_kotaedit" placeholder="Kabupaten/Kota" value="" />
                                <?= form_error('kab_kotaedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kd_posedit" id="kd_posedit" placeholder="Kode Pos" value="" />
                                <?= form_error('kd_posedit'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_provedit = array(
                                    "" => "-- Pilihan --",
                                    "Kalimantan Timur" => "Kalimantan Timur"
                                );
                                echo form_dropdown('provinsiedit', $pil_provedit, '', 'class="form-control" id="provinsiedit"');
                                echo form_error('provinsiedit')
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="editkartu">Edit</button>
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
                            <th>No. Kartu Keluarga</th>
                            <th>Kepala Keluarga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kartukeluarga as $k) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $k['no_kk']; ?></td>
                                <td><?= $k['kpl_keluarga']; ?></td>
                                <td>
                                    <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                    <a href="" class="badge badge-success kartk" data-toggle="modal" data-target="#editkar" data-id="<?= $k['id_kk']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>rt/delkar/<?= $k['id_kk']; ?>" class="badge badge-danger" id="delkar">Delete</a>
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