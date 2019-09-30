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
      <a href="" class="btn btn-warning" data-toggle="modal" data-target="#addkegiatan" id="modalLabel17">Tambahkan Kegiatan</a>
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
      <!-- modal addkegiatan -->
      <div class="modal fade" id="addkegiatan" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel2">Add Kegiatan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?= form_open_multipart('rt/info'); ?>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" placeholder="Judul Kegiatan" value="<?= $judul_kegiatan; ?>">
                <?= form_error('judul_kegiatan'); ?>
              </div>
              <div class="form-group">
                <textarea class="ckeditor" id="isi_kegiatan ckeditor" name="isi_kegiatan" value="<?= $isi_kegiatan; ?>"></textarea>
                <?= form_error('isi_kegiatan'); ?>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                <?= form_error('gambar'); ?>
              </div>
              <input type="hidden" name="gambar_penulis" value="<?= $user['image']; ?>" id="gambar_penulis">
              <?php
              if ($role_id == '1') {
                $role = 'admin';
              } elseif ($role_id == '3') {
                $role = 'rt';
              } elseif ($role_id == '4') {
                $role = 'warga';
              }
              ?>
              <input type="hidden" name="rol" value="<?= $role; ?>" id="rol">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
              <button type="submit" class="btn btn-warning" id="addkeg">Add</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- modal editkegiatan -->
      <div class="modal fade" id="editkegiatan" tabindex="-1" role="dialog" aria-labelledby="e">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel2">Edit Kegiatan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?= form_open_multipart('rt/updatekegiatan'); ?>
            <div class="modal-body">
              <input type="hidden" name="id" value="" id="idkeg">
              <div class="col-md-4">
                <img src="" class="card-img mb-3 mx-auto" alt="">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="judul_kegiatanedit" name="judul_kegiatanedit" placeholder="Judul Kegiatan" value="">
                <?= form_error('judul_kegiatanedit'); ?>
              </div>
              <div class="form-group">
                <textarea class="ckeditor" id="isi_kegiatanedit ckeditor" name="isi_kegiatanedit">
                </textarea>
                <?= form_error('isi_kegiatanedit'); ?>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="file">Pilih Gambar</label>
                <?= form_error('file'); ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
              <button type="submit" class="btn btn-warning" id="eddkeg">Edit</button>
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
              <th>Judul Kegiatan</th>
              <th>Isi Kegiatan</th>
              <th>Level</th>
              <th>Gambar</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kegiatan as $keg) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $keg['judul_kegiatan']; ?></td>
                <td><?= substr($keg['isi_kegiatan'], 0, 10); ?></td>
                <td><?= $keg['level']; ?></td>
                <td><?= $keg['gambar']; ?></td>
                <td><?= date("d/F/Y", strtotime($keg['date_created'])); ?></td>
                <td>
                  <input type="hidden" name="" value="<?= base_url(); ?>" id="hiddenbaseurl">
                  <a href="" class="badge badge-success keg" data-toggle="modal" data-target="#editkegiatan" data-id="<?= $keg['id']; ?>">Edit</a>
                  <a href="<?= base_url(); ?>rt/deletekegiatan/<?= $keg['id']; ?>" class="badge badge-danger kegiatandel">Delete</a>
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