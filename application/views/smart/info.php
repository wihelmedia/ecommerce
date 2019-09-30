<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Info Kegiatan</h1>
        <?= $this->session->flashdata('msg'); ?>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- modal detailkegiatan -->
    <div class="modal fade" id="detailkgtn" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulkeg"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img class="img-profile rounded-circle" src="" style="width:30px;height:30px;">&nbsp;&nbsp;<small class="text-success" id="levelp"></small>
                            </div>
                            <div class="col-lg-6">
                                <i><small class="text-success text-right" id="datekeg"></small></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;height: 14rem;" src="" alt="">
                        </div>
                        <p class="text-justify" id="isikeg"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row center">
        <?php foreach ($kegiatan as $k) { ?>
            <div class="col-lg-4 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning"><?= $k['judul_kegiatan']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/' . $k['gambar_penulis']); ?>" style="width:30px;height:30px;">&nbsp;&nbsp;<small class="text-success"><?= ucwords($k['level']); ?></small>
                            </div>
                            <div class="col-lg-6">
                                <small class="text-success text-right"><i><?= date("d-F-Y", strtotime($k['date_created'])); ?></i></small>
                            </div>
                        </div>
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;height: 14rem;" src="<?= base_url('assets/img/info/' . $k['gambar']); ?>" alt="">
                        </div>
                        <p><?= $k['isi_kegiatan']; ?></p>
                        <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                        <a href="<?= base_url('smart/detailkegiatan/' . $k['id']); ?>" class="text-warning selengkapnya">Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?= $this->pagination->create_links(); ?>
</div> <!-- /.container-fluid -->