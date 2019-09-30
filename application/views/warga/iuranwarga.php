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
            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#iuran" id="modalLabel8">Add Iuran</a>
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
            <div class="modal fade" id="iuran" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel9">Form Input Data Iuran Warga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('warga/iuranwarga'); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <?php
                                $pil_thn = array(
                                    "" => "-- Pilihan --",
                                    "2019" => "2019",
                                    "2018" => "2018",
                                    "2017" => "2017"
                                );
                                echo form_dropdown('thn_iuran', $pil_thn, $thn_iuran, 'class="form-control" id="thn_iuran"');
                                echo form_error('thn_iuran')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_bul = array(
                                    "" => "-- Pilihan --",
                                    "Januari" => "Januari",
                                    "Februari" => "Februari",
                                    "Maret" => "Maret",
                                    "April" => "April",
                                    "Mei" => "Mei",
                                    "Juni" => "Juni",
                                    "Juli" => "Juli",
                                    "Agustus" => "Agustus",
                                    "September" => "September",
                                    "Oktober" => "Oktober",
                                    "November" => "November",
                                    "Desember" => "Desember"
                                );
                                echo form_dropdown('bulan', $pil_bul, $bulan, 'class="form-control" id="bulan"');
                                echo form_error('bulan')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_ket = array(
                                    "" => "-- Pilihan --",
                                    "Lunas" => "Lunas",
                                    "Belum Lunas" => "Belum Lunas"
                                );
                                echo form_dropdown('ket', $pil_ket, $ket, 'class="form-control" id="ket"');
                                echo form_error('ket')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_kk" id="nama_kk" placeholder="Nama KK" value="<?= $nama_kk; ?>" />
                                <?= form_error('nama_kk'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Rumah" value="<?= $alamat; ?>" />
                                <?= form_error('alamat'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_rumah" id="no_rumah" placeholder="Nomor Rumah" value="<?= $no_rumah; ?>" />
                                <?= form_error('no_rumah'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="iuran" id="iuran" placeholder="(Rp). Iuran" value="<?= $iuran; ?>" />
                                <?= form_error('iuran'); ?>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tgl_pembukuan" id="tgl_pembukuan" placeholder="Tanggal Pembukuan" value="<?= $tgl_pembukuan; ?>" />
                                <?= form_error('tgl_pembukuan'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="addiuran">Add</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="editiu" tabindex="-1" role="dialog" aria-labelledby="e">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel10">Form Edit Iuran Warga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open_multipart('warga/updateiuran'); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <?php
                                $pil_thnedit = array(
                                    "" => "-- Pilihan --",
                                    "2019" => "2019",
                                    "2018" => "2018",
                                    "2017" => "2017"
                                );
                                echo form_dropdown('thn_iuranedit', $pil_thnedit, '', 'class="form-control" id="thn_iuranedit"');
                                echo form_error('thn_iuranedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_buledit = array(
                                    "" => "-- Pilihan --",
                                    "Januari" => "Januari",
                                    "Februari" => "Februari",
                                    "Maret" => "Maret",
                                    "April" => "April",
                                    "Mei" => "Mei",
                                    "Juni" => "Juni",
                                    "Juli" => "Juli",
                                    "Agustus" => "Agustus",
                                    "September" => "September",
                                    "Oktober" => "Oktober",
                                    "November" => "November",
                                    "Desember" => "Desember"
                                );
                                echo form_dropdown('bulan', $pil_buledit, '', 'class="form-control" id="bulanedit"');
                                echo form_error('bulanedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $pil_ketedit = array(
                                    "" => "-- Pilihan --",
                                    "Lunas" => "Lunas",
                                    "Belum Lunas" => "Belum Lunas"
                                );
                                echo form_dropdown('ketedit', $pil_ketedit, '', 'class="form-control" id="ketedit"');
                                echo form_error('ketedit')
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama_kkedit" id="nama_kkedit" placeholder="Nama KK" value="" />
                                <?= form_error('nama_kkedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="alamatedit" id="alamatedit" placeholder="Alamat Rumah" value="" />
                                <?= form_error('alamatedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="no_rumahedit" id="no_rumahedit" placeholder="Nomor Rumah" value="" />
                                <?= form_error('no_rumahedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="iuranedit" id="iuranedit" placeholder="(Rp). Iuran" value="" />
                                <?= form_error('iuranedit'); ?>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tgl_pembukuanedit" id="tgl_pembukuanedit" placeholder="Tanggal Pembukuan" value="" />
                                <?= form_error('tgl_pembukuanedit'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                            <button type="submit" class="btn btn-warning" id="editiuran">Edit</button>
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
                            <th>Tahun Iuran</th>
                            <th>Bulan</th>
                            <th>Tanggal Pembukuan</th>
                            <th>Keterangan</th>
                            <th>Iuran</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Rumah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($iuran_warga as $r) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $r['thn_iuran']; ?></td>
                                <td><?= $r['bulan']; ?></td>
                                <td><?= $r['tgl_pembukuan']; ?></td>
                                <td><?= $r['ket']; ?></td>
                                <td><?= $r['iuran']; ?></td>
                                <td><?= $r['nama_kk']; ?></td>
                                <td><?= $r['alamat']; ?></td>
                                <td><?= $r['no_rumah']; ?></td>
                                <td>
                                    <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                                    <a href="" class="badge badge-success iura" data-toggle="modal" data-target="#editiu" data-id="<?= $r['id']; ?>">Edit</a>
                                    <a href="<?= base_url(); ?>warga/deliuran/<?= $r['id']; ?>" class="badge badge-danger" id="deliuran">Delete</a>
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