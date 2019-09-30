<head>
    <title>Kartu Keluarga</title>
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
    <font face="Arial" size="7">
        <p align="center"> <b>KARTU KELUARGA</b>
    </font><br>
    <font face="Arial" size="4"> <b>No. 67867</b> </p></font>
        <table align="center" border="0">
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Kepala Keluarga</td>
                <td>:</td>
                <td align="left">Maria Carlos</td>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</td>
                <td>:</td>
                <td align="left">Kongbeng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td>:</td>
                <td align="left">Jl. Poros</td>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kabupaten/Kota</td>
                <td>:</td>
                <td align="left">Kutai Timur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RT/RW</td>
                <td>:</td>
                <td align="left">010/000</td>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kode Pos</td>
                <td>:</td>
                <td align="left">75555&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desa/Kelurahan</td>
                <td>:</td>
                <td align="left">Makmur Jaya</td>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Provinsi</td>
                <td>:</td>
                <td align="left">Kalimantan Timur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
            <table border="1" cellpadding="7" align="center" width="1000">
            </thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Pendidikan</th>
                    <th>Jenis Pekerjaan</th>
                </tr>
                <tr bgcolor="#eaeaea">
                    <th></th>
                    <th>(1)</th>
                    <th>(2)</th>
                    <th>(3)</th>
                    <th>(4)</th>
                    <th>(5)</th>
                    <th>(6)</th>
                    <th>(7)</th>
                    <th>(8)</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php $i = 1; ?>
                <?php foreach($wargakk as $key) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= strtoupper($key['nama']); ?></td>
                    <td><?= $key['no_ktp']; ?></td>
                    <td>
                                    <?php
                                        if ($key['jk'] == 'L') {
                                            echo 'LAKI-LAKI';
                                        } else if ($key['jk'] == 'P') {
                                            echo 'PEREMPUAN';
                                        }
                                        ?>
                    </td>
                    <td><?= strtoupper($key['tempat_lahir']); ?></td>
                    <td><?= strtoupper($key['tgl_lahir']); ?></td>
                    <td><?= strtoupper($key['agama']); ?></td>
                    <td><?= strtoupper($key['pendidikan']); ?></td>
                    <td><?= strtoupper($key['pekerjaan']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
            <table border="1" cellpadding="7" align="center" width="1000">
            </thead>
                <tr>
                    <th>No</th>
                    <th>Status Perkawinan</th>
                    <th>Status Hubungan Dalam Keluarga</th>
                    <th>Kewarganegaraan</th>
                    <th colspan="2">
                        Dokumen Imigrasi
                        <table border="1" cellpadding="7" align="center">
                            <tbody>
                                <tr>
                                    <th>No. Paspor</th>
                                    <th>No. KITAS/KITAP</th>
                                </tr>
                            </tbody>
                        </table>
                    </th>
                    <th colspan="2">
                        Nama Orang Tua
                        <table border="1" cellpadding="7" align="center">
                            <tbody>
                                <tr>
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
                <tr bgcolor="#eaeaea">
                    <th></th>
                    <th>(9)</th>
                    <th>(10)</th>
                    <th>(11)</th>
                    <th>(12)</th>
                    <th>(13)</th>
                    <th>(14)</th>
                    <th>(15)</th>
                </tr>
            </thead>
            <tbody align="center">
            <?php $i = 1; ?>
            <?php foreach($wargakk as $kk) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= strtoupper($kk['status_kawin']); ?></td>
                    <td><?= strtoupper($kk['status_keluarga']); ?></td>
                    <td><?= strtoupper($kk['kewarganegaraan']); ?></td>
                    <td>-</td>
                    <td>-</td>
                    <td><?= strtoupper($kk['nm_ayah']); ?></td>
                    <td><?= strtoupper($kk['nm_ibu']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
</body>