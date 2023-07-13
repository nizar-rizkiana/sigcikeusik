<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style>
        p,
        span,
        table {
            font-size: 12px
        }

        table {
            width: 100%;
            border: 1px solid #dee2e6;
        }

        table#tb-item tr th,
        table#tb-item tr td {
            border: 1px solid #000
        }
    </style>
</head>

<body>
    <table id="tb-item" cellpadding="4">
        <tr style="background-color:#a9a9a9">
            <th width="6%" style="height: 20px;text-align:center"><strong>No</strong></th>
            <th width="14%" style="height: 20px"><strong>Nama Sekolah</strong></th>
            <th width="8%" style="height: 20px"><strong>Jenjang</strong></th>
            <th width="18%" style="height: 20px"><strong>Email</strong></th>
            <th width="16%" style="height: 20px"><strong>Website</strong></th>
            <th width="28%" style="height: 20px;text-align:center"><strong>Alamat</strong></th>
            <th width="10%" style="height: 20px"><strong>Akreditasi</strong></th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach($sekolah as $s) : ?>
        <tr>
            <td style="height: 20px;text-align:center"><?= $no++ ?></td>
            <td style="height: 20px"><?= $s['nama_sekolah'] ?></td>
            <td style="height: 20px"><?= $s['jenjang'] ?></td>
            <td style="height: 20px"><?= $s['email'] ?></td>
            <td style="height: 20px"><?= $s['website'] ?></td>
            <td style="height: 20px"><?= $s['alamat'] ?></td>
            <td style="height: 20px;text-align:center"><?= $s['akreditasi'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <!-- <br>
    <br>
    <table cellpadding="4">
        <tr>
            <td width="50%" style="height: 20px;text-align:center">
                <p>&nbsp;</p>
            </td>
            <td width="50%" style="height: 20px;text-align:center">
                <p>Menes, <?= date('d M Y') ?></p>
                <p>Hormat kami,</p>
                <p></p>
                <p></p>
                <p></p>
                <p>Bagas Agung N</p>
            </td>
        </tr>
    </table> -->
</body>

</html>