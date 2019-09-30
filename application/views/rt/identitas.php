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
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addident" id="modalLabel12">Change Identitas</a>
            <?= form_error('menu', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('msg'); ?>
            <div class="modal fade" id="addident" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel13">Form Tambah Data Identitas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/identitas'); ?>
                        <div class="modal-body">
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
                            <div class="form-group">
                                <input type="text" class="form-control" name="kab_kota" id="kab_kota" placeholder="Kabupaten/Kota" value="<?= $kab_kota; ?>" />
                                <?= form_error('kab_kota'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="<?= $kecamatan; ?>" />
                                <?= form_error('kecamatan'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="No. Telp Ketua RT" value="<?= $no_tlp; ?>" />
                                <?= form_error('no_tlp'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="desa_kel" id="desa_kel" placeholder="Desa/Kel" value="<?= $desa_kel; ?>" />
                                <?= form_error('desa_kel'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="dusun" id="dusun" placeholder="Dusun" value="<?= $dusun; ?>" />
                                <?= form_error('dusun'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat_kantor_desa" id="alamat_kantor_desa" placeholder="Alamat Kantor Desa" value="<?= $alamat_kantor_desa; ?>" />
                                <?= form_error('alamat_kantor_desa'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kd_pos" id="kd_pos" placeholder="Kode Pos" value="<?= $kd_pos; ?>" />
                                <?= form_error('kd_pos'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rw" id="rw" placeholder="RW" value="<?= $rw; ?>" />
                                <?= form_error('rw'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rt" id="rt" placeholder="RT" value="<?= $rt; ?>" />
                                <?= form_error('rt'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ketua_rt" id="nm_ketua_rt" placeholder="Nama Ketua RT" value="<?= $nm_ketua_rt; ?>" />
                                <?= form_error('nm_ketua_rt'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat_rumah_rt" id="alamat_rumah_rt" placeholder="Alamat Rumah RT" value="<?= $alamat_rumah_rt; ?>" />
                                <?= form_error('alamat_rumah_rt'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="addidentitas">Add</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="editident" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel14">Form Edit Data Identitas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/updateidentitas'); ?>
                        <div class="modal-body">
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
                            <div class="form-group">
                                <input type="text" class="form-control" name="kab_kotaedit" id="kab_kotaedit" placeholder="Kabupaten/Kota" value="" />
                                <?= form_error('kab_kotaedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kecamatanedit" id="kecamatanedit" placeholder="Kecamatan" value="" />
                                <?= form_error('kecamatanedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_tlpedit" id="no_tlpedit" placeholder="No. Telp Ketua RT" value="" />
                                <?= form_error('no_tlpedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="desa_keledit" id="desa_keledit" placeholder="Desa/Kel" value="" />
                                <?= form_error('desa_keledit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="dusunedit" id="dusunedit" placeholder="Dusun" value="" />
                                <?= form_error('dusunedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat_kantor_desaedit" id="alamat_kantor_desaedit" placeholder="Alamat Kantor Desa" value="" />
                                <?= form_error('alamat_kantor_desaedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kd_posedit" id="kd_posedit" placeholder="Kode Pos" value="" />
                                <?= form_error('kd_posedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rwedit" id="rwedit" placeholder="RW" value="" />
                                <?= form_error('rwedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="rtedit" id="rtedit" placeholder="RT" value="" />
                                <?= form_error('rtedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ketua_rtedit" id="nm_ketua_rtedit" placeholder="Nama Ketua RT" value="" />
                                <?= form_error('nm_ketua_rtedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat_rumah_rtedit" id="alamat_rumah_rtedit" placeholder="Alamat Rumah RT" value="" />
                                <?= form_error('alamat_rumah_rtedit'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="editidentitas">Edit</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Kecamatan</th>
                            <th>No. Telp</th>
                            <th>Desa/Kel</th>
                            <th>Dusun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($identitas as $id) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $id['provinsi']; ?></td>
                                <td><?= $id['kab_kota']; ?></td>
                                <td><?= $id['kecamatan']; ?></td>
                                <td><?= $id['no_tlp']; ?></td>
                                <td><?= $id['desa_kel']; ?></td>
                                <td><?= $id['dusun']; ?></td>
                                <td>
                                    <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                    <a href="" class="badge badge-success iden" data-toggle="modal" data-target="#editident" data-id="<?= $id['id']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>rt/delidentitas/<?= $id['id']; ?>" class="badge badge-danger" id="delidentitas">Delete</a>
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