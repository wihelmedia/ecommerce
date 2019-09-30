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
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addm" id="modalLabel4">Add New Warga</a>
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
                            <h5 class="modal-title" id="modalLabel5">Form Tambah Data Warga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/datawarga'); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="No. KTP" value="<?= $no_ktp; ?>" />
                                <?= form_error('no_ktp'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_kk" id="no_kk" placeholder="No. KK" value="<?= $no_kk; ?>" />
                                <?= form_error('no_kk'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $nama; ?>" />
                                <?= form_error('nama'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_jk = array(
                                    "" => "-- Pilihan --",
                                    "L" => "Laki-Laki",
                                    "P" => "Perempuan"
                                );
                                echo form_dropdown('jk', $pil_jk, $jk, 'class="form-control" id="jk"');
                                echo form_error('jk')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= $tempat_lahir; ?>" />
                                <?= form_error('tempat_lahir'); ?>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $tgl_lahir; ?>" />
                                <?= form_error('tgl_lahir'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="golda" id="golda" placeholder="Golongan Darah" value="<?= $golda; ?>" />
                                <?= form_error('golda'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_agama = array(
                                    "" => "-- Pilihan --",
                                    "islam" => "Islam",
                                    "katholik" => "Katholik",
                                    "protestan" => "Protestan",
                                    "hindu" => "Hindu",
                                    "buddha" => "Budha",
                                    "konghucu" => "Konghucu"
                                );
                                echo form_dropdown('agama', $pil_agama, $agama, 'class="form-control" id="agama"');
                                echo form_error('agama')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_statuska = array(
                                    "" => "-- Pilihan --",
                                    "Kawin" => "Kawin",
                                    "Belum Kawin" => "Belum Kawin"
                                );
                                echo form_dropdown('status_kawin', $pil_statuska, $status_kawin, 'class="form-control" id="status_kawin"');
                                echo form_error('status_kawin')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_statuskel = array(
                                    "" => "-- Pilihan --",
                                    "Kepala Keluarga" => "Kepala Keluarga",
                                    "Famili Lain" => "Famili Lain",
                                    "Anak" => "Anak"
                                );
                                echo form_dropdown('status_keluarga', $pil_statuskel, $status_keluarga, 'class="form-control" id="status_keluarga"');
                                echo form_error('status_keluarga')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?= $status; ?>" />
                                <?= form_error('status'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" placeholder="Kewarganegaraan" value="WNI" />
                                <?= form_error('kewarganegaraan'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Pendidikan" value="<?= $pendidikan; ?>" />
                                <?= form_error('pendidikan'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?= $pekerjaan; ?>" />
                                <?= form_error('pekerjaan'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" value="<?= $no_hp; ?>" />
                                <?= form_error('no_hp'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ayah" id="nm_ayah" placeholder="Nama Ayah" value="<?= $nm_ayah; ?>" />
                                <?= form_error('nm_ayah'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ibu" id="nm_ibu" placeholder="Nama Ibu" value="<?= $nm_ibu; ?>" />
                                <?= form_error('nm_ibu'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?= $alamat; ?>" />
                                <?= form_error('alamat'); ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                <input type="text" class="form-control" name="no_rumah" id="no_rumah" placeholder="No. Rumah" value="<?= $no_rumah; ?>" />
                                <?= form_error('no_rumah'); ?>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Pilih Foto</label>
                                <?= form_error('image'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="addwarga">Add</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="editw" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel6">Form Edit Data Warga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('rt/updatewarga'); ?>
                        <div class="modal-body">
                            <div class="col-md-4">
                                <img src="" class="card-img mb-3 mx-auto" alt="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_ktpedit" id="no_ktpedit" placeholder="No. KTP" value="" />
                                <?= form_error('no_ktpedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_kkedit" id="no_kkedit" placeholder="No. KK" value="" />
                                <?= form_error('no_kkedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="namaedit" id="namaedit" placeholder="Nama" value="" />
                                <?= form_error('namaedit'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_jk = array(
                                    "" => "-- Pilihan --",
                                    "L" => "Laki-Laki",
                                    "P" => "Perempuan"
                                );
                                echo form_dropdown('jkedit', $pil_jk, '', 'class="form-control" id="jkedit"');
                                echo form_error('jkedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="tempat_lahiredit" id="tempat_lahiredit" placeholder="Tempat Lahir" value="" />
                                <?= form_error('tempat_lahiredit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tgl_lahiredit" id="tgl_lahiredit" placeholder="Tanggal Lahir" value="" />
                                <?= form_error('tgl_lahiredit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="goldaedit" id="goldaedit" placeholder="Golongan Darah" value="" />
                                <?= form_error('goldaedit'); ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_agama = array(
                                    "" => "-- Pilihan --",
                                    "islam" => "Islam",
                                    "katholik" => "Katholik",
                                    "protestan" => "Protestan",
                                    "hindu" => "Hindu",
                                    "buddha" => "Budha",
                                    "konghucu" => "Konghucu"
                                );
                                echo form_dropdown('agamaedit', $pil_agama, '', 'class="form-control" id="agamaedit"');
                                echo form_error('agamaedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_statuskaedit = array(
                                    "" => "-- Pilihan --",
                                    "Kawin" => "Kawin",
                                    "Belum Kawin" => "Belum Kawin"
                                );
                                echo form_dropdown('status_kawinedit', $pil_statuskaedit, '', 'class="form-control" id="status_kawinedit"');
                                echo form_error('status_kawinedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_statuskeledit = array(
                                    "" => "-- Pilihan --",
                                    "Kepala Keluarga" => "Kepala Keluarga",
                                    "Famili Lain" => "Famili Lain",
                                    "Anak" => "Anak"
                                );
                                echo form_dropdown('status_keluargaedit', $pil_statuskeledit, '', 'class="form-control" id="status_keluargaedit"');
                                echo form_error('status_keluargaedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="statusedit" id="statusedit" placeholder="Status" value="" />
                                <?= form_error('statusedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="kewarganegaraanedit" id="kewarganegaraanedit" placeholder="Kewarganegaraan" value="WNI" />
                                <?= form_error('kewarganegaraanedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pendidikanedit" id="pendidikanedit" placeholder="Pendidikan" value="" />
                                <?= form_error('pendidikanedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pekerjaanedit" id="pekerjaanedit" placeholder="Pekerjaan" value="" />
                                <?= form_error('pekerjaanedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_hpedit" id="no_hpedit" placeholder="No. HP" value="" />
                                <?= form_error('no_hpedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ayahedit" id="nm_ayahedit" placeholder="Nama Ayah" value="" />
                                <?= form_error('nm_ayahedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nm_ibuedit" id="nm_ibuedit" placeholder="Nama Ibu" value="" />
                                <?= form_error('nm_ibuedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamatedit" id="alamatedit" placeholder="Alamat" value="" />
                                <?= form_error('alamatedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                <input type="text" class="form-control" name="no_rumahedit" id="no_rumahedit" placeholder="No. Rumah" value="<?= $no_rumah; ?>" />
                                <?= form_error('no_rumahedit'); ?>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Pilih Foto</label>
                                <?= form_error('file'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="editwarga">Edit</button>
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
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>No. HP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($warga as $w) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $w['no_ktp']; ?></td>
                                <td><?= $w['nama']; ?></td>
                                <td>
                                    <?php
                                        if ($w['jk'] == 'L') {
                                            echo 'Laki-Laki';
                                        } else if ($w['jk'] == 'P') {
                                            echo 'Perempuan';
                                        }
                                        ?>
                                </td>
                                <td><?= $w['tempat_lahir']; ?></td>
                                <td><?= $w['tgl_lahir']; ?></td>
                                <td><?= $w['no_hp']; ?></td>
                                <td>
                                    <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                    <a href="" class="badge badge-success list" data-toggle="modal" data-target="#editw" data-id="<?= $w['no_ktp']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>rt/delwarga/<?= $w['no_ktp']; ?>" class="badge badge-danger" id="delwarga">Delete</a>
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