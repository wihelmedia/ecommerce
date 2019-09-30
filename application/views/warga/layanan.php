<div class='box'>
    <div class='box-header'>

        <h3 class='text-center'>MINTA SURAT PENGANTAR DARI RT ANDA</h3>
        <div class='box box-primary'>
            <form action="<?= base_url('warga/layanan_action'); ?>" method="post" id="form">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="no_ktp" id="no_ktp" placeholder="No KTP" value="<?= $no_ktp; ?>" />
                    <?= form_error('no_ktp'); ?>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="name" id="name" placeholder="Name" value="<?= $name; ?>" />
                    <?= form_error('name'); ?>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="no_hp" id="no_hp" placeholder="No. HP" value="<?= $no_hp; ?>" />
                    <?= form_error('no_hp'); ?>
                </div>
                <div class="form-group col-lg-12">
                    <?php
                    $pil_keperluan = array(
                        "" => "-- Pilihan --",
                        "Mengurus KK" => "Mengurus KK",
                        "Mengurus KTP" => "Mengurus KTP",
                        "Mengurus Pindah Domisili" => "Mengurus Pindah Domisili",
                        "Mengurus SKCK" => "Mengurus SKCK"
                    );
                    echo form_dropdown('keperluan', $pil_keperluan, '', 'class="form-control" id="keperluan"');
                    echo form_error('keperluan')
                    ?>
                    <button type="submit" class="btn btn-warning d-block mt-5">Ajukan Ke RT</button>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->