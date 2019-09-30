<head>
    <title>Surat Pengantar RT</title>
    <style type="text/css">
        .upper {
            text-transform: uppercase;
        }

        .lower {
            text-transform: lowercase;
        }

        .cap {
            text-transform: capitalize;
        }

        .small {
            font-variant: small-caps;
        }

        @media print {
            body {
                display: block;
            }
        }
    </style>
</head>

<body bgcolor="white">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?= base_url('rt/pengajuan'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm ml-5"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>
    <form>
        <table align="center" border="0">
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center>PEMERINTAH KABUPATEN <?= strtoupper($kab_kota); ?></center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center>KECAMATAN <?= strtoupper($kecamatan); ?></center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center><b>DESA <?= strtoupper($desa_kel); ?></center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5.5">
                        <center><b>RT 0<?= strtoupper($rt); ?> RW 0<?= strtoupper($rw); ?> DUSUN <?= strtoupper($dusun); ?></b></center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="3">
                        <center>Alamat : <?= $alamat_kantor_desa; ?> Pos : <?= strtoupper($kd_pos); ?></center>
                    </font>
                </td>
            </tr>
        </table>
    </form>
    <hr size="3" noshade="8">
    <font face="Arial" size="5">
        <p align="center"> <u> <b>SURAT KETERANGAN PENGANTAR</b></u>
    </font><br>
    <font face="Arial" size="4"> Nomor: <?= strtoupper($nosurat_rt); ?> </p>
    </font>
    <form>
        <table align="center" border="0">
            <tr>
                <td align="left" colspan="3">Yang bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td>:</td>
                <td align="left"><?= $nm_ketua_rt; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                <td>:</td>
                <td align="left">Kepala Desa <?= $desa_kel; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td>:</td>
                <td align="left">Desa <?= $desa_kel; ?> RT.0<?= strtoupper($rt); ?>/0<?= strtoupper($rw); ?> Kec. <?= ucwords($kecamatan); ?></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" colspan="3">Dengan ini menerangkan bahwa :</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Lengkap</td>
                <td>:</td>
                <td align="left"><?= $nama; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis kelamin</td>
                <td>:</td>
                <?php
                if ($jk == 'L') {
                    $result = 'LAKI-LAKI';
                } elseif ($jk == 'P') {
                    $result = 'PEREMPUAN';
                }
                ?>
                <td align="left"><?= $result; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agama</td>
                <td>:</td>
                <td align="left"><?= strtoupper($agama); ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
                <td>:</td>
                <td align="left"><?= $status_kawin; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No NIK</td>
                <td>:</td>
                <td align="left"><?= $no_ktp; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat/Tanggal lahir</td>
                <td>:</td>
                <td align="left"><?= $tempat_lahir; ?>, <?= $tgl_lahir; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pekerjaan</td>
                <td>:</td>
                <td align="left"><?= $pekerjaan; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td>:</td>
                <td align="left">Desa <?= strtoupper($desa_kel); ?> RT 0<?= strtoupper($rt); ?>/0<?= strtoupper($rw); ?> Kec. <?= $kecamatan; ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keperluan</td>
                <td>:</td>
                <td align="left"><?= strtoupper($keperluan); ?></td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan</td>
                <td>:</td>
                <td align="left">Orang tersebut benar-benar warga Desa <?= $desa_kel; ?> berkelakuan baik dan belum pernah terkena tindak pidana apapun.</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berlaku tanggal</td>
                <td>:</td>
                <td align="left">Dimulai tanggal 25 sampai 30 Hari kedepan.</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" colspan="3">Orang tersebut di atas adalah benar penduduk Desa kami yang berdomisili <b>Status Tinggal</b>, Demikian surat keterangan ini di buat untuk digunakan seperlunya.</td>
            </tr>
        </table>
        <BR>
        <table align="center" border="0">
            <tr>
                <td>
                    Tanda tangan pemegang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Desa <?= $desa_kel; ?>
                </td>
            </tr>
            <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <font class="upper"><b><i><?= strtoupper($nama); ?></i></b></font>
                </td>
                <td align="right">
                    <font class="upper"><b><i><?= strtoupper($nm_ketua_rt); ?></i></b></font>
                </td>
            </tr>
            <tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    Mengetahui :
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    Camat <?= $kecamatan; ?>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <font class="upper"><b><i>(Ahmad Hartono, S.IP.,MM)</i></b></font>
                </td>
            </tr>
        </table>
    </form>
</body>